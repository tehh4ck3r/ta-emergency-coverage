<?php
	require('dbconn.php');
	require('errors.php');

	$errors = array(); 

	if (isset($_POST['delete_class'])) {
		// receive all input values from the form
		$section_id = mysqli_real_escape_string($db, $_POST['section_id']);
		$date = mysqli_real_escape_string($db, $_POST['date']);
		$timeinput = mysqli_real_escape_string($db, $_POST['time']);
	
		// form validation: ensure that the form is correctly filled
		if (empty($section_id)) { array_push($errors, "Section ID is required"); }
		if (empty($date)) { array_push($errors, "Date is required"); }
		if (empty($timeinput)) { array_push($errors, "Time is required"); }
		
		$starttime = '00:00:00';
		$endtime = '00:00:00';
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
			$query = 'DELETE FROM CLASSES WHERE section_id = ? AND section_date = ? AND start_time = ?';
			$stmt = $db->stmt_init();
			if (!$stmt->prepare($query)) {
				die("Faied to prepare statement: ".$query);
			} else {
				$stmt->bind_param('iss', $section_id, $date, $starttime);
			}
			if(!$stmt->execute()) {
				die("Error in statement execution: ".$stmt->error);
			}
				
			$stmt->close();
		}
	}
?>