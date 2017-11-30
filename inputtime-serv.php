<?php
	/* inputtime-serv.php: handles the server-side portion of recording 
	 * TA availability.
	 * 
	 * Takes user input for a date and time and whether they are or are not 
	 * available during that time. If yes, stores it in the database, if no,
	 * removes it from database.
	 */

	require('dbconn.php');
	$errors = array();
	
	/* putInTime($indate, $intime, $indb): records an available time in the DB.
	 *
	 * $indate: the date for which the user is available.
	 * $intime: the time for which the user is available. 
	 * $indb: a mysqli object representing the database to store the info.
	 */
	function putInTime($indate, $intime, $indb) {
		global $errors;
		$username = $_SESSION['username']; // get the username
		$start_time = $intime; // get the start time of the availability
		
		// based on the start time, select the corresponding end time of the availability. 
		switch ($intime) {
			case '09:15:00':
				$end_time = '12:00:00';
				break;
			case '14:15:00':
				$end_time = '17:00:00';
				break;
			case '17:15:00':
				$end_time = '20:00:00';
				break;
		}

		$query = "INSERT INTO STUDENTAVAIL (username, date, avail_start, avail_end) VALUES(?, ?, ?, ?)"; // using prepared statements

		$stmt = $indb->stmt_init();

		// die if the statement wasn't successfully prepared
		if (!$stmt->prepare($query)) {
			die("Faied to prepare statement: ".$query);
		} else {
			$stmt->bind_param('ssss', $username, $indate, $start_time, $end_time); // bind the input parameters to the query
		}

		// if the statement did not execute successfully, die and print the error
		if(!$stmt->execute()) {
			die("Error in statement execution: ".$stmt->error);
		}

		$stmt->close();
	}
	
	/* removeTime($indate, $intime, $indb): removes a time from the DB.
	 *
	 * $indate: the date for which the user is not available.
	 * $intime: the time for which the user is not available. 
	 * $indb: a mysqli object representing the database to store the info.
	 */
	function removeTime($indate, $intime, $indb) {
		global $errors;
		$username = $_SESSION['username']; // get the username
		$start_time = $intime; // get the start time of the unavailability

		// based on the start time, select the corresponding end time of the unavailability. 
		switch ($intime) {
			case '09:15:00':
				$end_time = '12:00:00';
				break;
			case '14:15:00':
				$end_time = '17:00:00';
				break;
			case '17:15:00':
				$end_time = '20:00:00';
				break;
		}
		
		$query = "DELETE FROM STUDENTAVAIL WHERE username = ? AND date = ? AND avail_start = ?"; // using prepared statements

		$stmt = $indb->stmt_init();

		// if the statement did not execute successfully, die and print the error
		if (!$stmt->prepare($query)) {
			die("Faied to prepare statement: ".$query);
		} else {
			$stmt->bind_param('sss', $username, $indate, $start_time); // bind the input parameters to the query
		}
		
		// if the statement did not execute successfully, die and print the error
		if(!$stmt->execute()) {
				die("Error in statement execution: ".$stmt->error);
		}
		
		$stmt->close();
	}

	// if we recieved the right POST request
	if (isset($_POST['ta_times'])) {
		// recieve all input values from the form
		$date = mysqli_real_escape_string($db, $_POST['date']);
		$timeinput = mysqli_real_escape_string($db, $_POST['time']);
		$avail = mysqli_real_escape_string($db, $_POST['availgroup']);
		$repeatornot = mysqli_real_escape_string($db, $_POST['repeatornot']);
		$repeatuntil = mysqli_real_escape_string($db, $_POST['repeatdate']);

		// form validation: ensure that the form is correctly filled
		if (empty($date)) { array_push($errors, "Date is required"); }
		if (preg_match("/^[0-9]{4}-(0[1-9]|1[0-2])-(0[1-9]|[1-2][0-9]|3[0-1])$/", $date) === 0) { array_push($errors, "Date must be in format YYYY-MM-DD"); }
		if (empty($avail)) { array_push($errors, "Availability is required"); }
		if (($repeatornot == 'yes') && empty($repeatuntil)) { array_push($errors, "Repeat date is required"); }
		
		// based on form input, select the correct starting time of the availability
		$time = '00:00:00';
		switch ($timeinput) {
			case '9to12':
				$time = '09:15:00';
				break;
			case '2to5':
				$time = '14:15:00';
				break;
			case '5to8':
				$time = '17:15:00';
				break;
			case 'allday':
				$time = 'allday';
				break;
		}

		// submit availability if there are no errors
		if (count($errors) == 0 && $avail == 'avail') {
			if ($repeatornot == 'yes') {
				// create date objects for the loop
				$startrepeatdate = new DateTime($date);
				$endrepeatdate= new DateTime($repeatuntil);
				
				// while our starting date is before the ending date for the repeat
				while($startrepeatdate < $endrepeatdate) {
					// convert back to a string to put it in the db
					$datestring = $startrepeatdate->format('Y-m-d');
					
					// if the all day option is selected, submit all 3 lab times
					if ($time == 'allday') {
						$timearray = array('09:15:00', '14:15:00', '17:15:00');
						for ($i = 0; $i < 3; $i++) {
							putInTime($datestring, $timearray[$i], $db);
						}
					} else {
						putInTime($datestring, $time, $db);
					}
					
					// repeat 1 time a week so increment the date by 7 days
					$startrepeatdate->add(new DateInterval('P7D'));
				}
			} else {
				// if the all day option is selected, submit all 3 lab times
				if ($time == 'allday') {
					$timearray = array('09:15:00', '14:15:00', '17:15:00');
					for ($i = 0; $i < 3; $i++) {
						putInTime($date, $timearray[$i], $db);
					}
				} else {
					putInTime($date, $time, $db);
				}
			}
		}
		
		// submit unavailability if there are no errors
		if (count($errors) == 0 && $avail == 'unavail') {
			if ($repeatornot == 'yes') {
				// create date objects for the loop
				$startrepeatdate = new DateTime($date);
				$endrepeatdate= new DateTime($repeatuntil);
				
				// while our starting date is before the ending date for the repeat
				while($startrepeatdate < $endrepeatdate) {
					// convert back to a string to put it in the db
					$datestring = $startrepeatdate->format('Y-m-d');
					
					// if the all day option is selected, submit all 3 lab times
					if ($time == 'allday') {
						$timearray = array('09:15:00', '14:15:00', '17:15:00');
						for ($i = 0; $i < 3; $i++) {
							removeTime($datestring, $timearray[$i], $db);
						}
					} else {
						removeTime($datestring, $time, $db);
					}
					
					// repeat 1 time a week so increment the date by 7 days
					$startrepeatdate->add(new DateInterval('P7D'));
				}
			} else {
				// if the all day option is selected, submit all 3 lab times
				if ($time == 'allday') {
					$timearray = array('09:15:00', '14:15:00', '17:15:00');
					for ($i = 0; $i < 3; $i++) {
						removeTime($date, $timearray[$i], $db);
					}
				} else {
					removeTime($date, $time, $db);
				}
			}
		}
	}
?>