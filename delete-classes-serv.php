<?php
	/* delete-classes-serv.php: handles the server-side portion of deleting classes. 
	 * 
	 * Takes user input for a section ID, date, and time for a class, then deletes the
	 * corresponding class from the database.
	 */

	require('dbconn.php');

	$errors = array(); 

	// if we recieved the right POST request
	if (isset($_POST['delete_class'])) {
		// receive all input values from the form
		$section_id = mysqli_real_escape_string($db, $_POST['section_id']);
		$date = mysqli_real_escape_string($db, $_POST['date']);
		$timeinput = mysqli_real_escape_string($db, $_POST['time']);
	
		// form validation: ensure that the form is correctly filled
		if (empty($section_id)) { array_push($errors, "Section ID is required"); }
		if (empty($date)) { array_push($errors, "Date is required"); }
		if (empty($timeinput)) { array_push($errors, "Time is required"); }
		
		// based on form input, select the correct starting time of the lab
		$starttime = '00:00:00';
		switch ($timeinput) {
			case '9to12':
				$starttime = '09:15:00';
				break;
			case '2to5':
				$starttime = '14:15:00';
				break;
			case '5to8':
				$starttime = '17:15:00';
				break;
		}
		
		// remove class if there are no errors in the form
		if (count($errors) == 0) {
			$query = 'DELETE FROM CLASSES WHERE section_id = ? AND section_date = ? AND start_time = ?'; // using prepared statements
			
			$stmt = $db->stmt_init();

			// die if the statement wasn't successfully prepared
			if (!$stmt->prepare($query)) {
				die("Faied to prepare statement: ".$query);
			} else {
				$stmt->bind_param('iss', $section_id, $date, $starttime); // bind the input parameters to the query
			}

			// if the statement did not execute successfully, die and print the error
			if(!$stmt->execute()) {
				die("Error in statement execution: ".$stmt->error);
			}
				
			$stmt->close();
		}
	}
?>