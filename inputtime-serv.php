<?php
	require('dbconn.php');
	$errors = array();
	
	function putInTime($indate, $intime, $indb) {
		global $errors;
		$username = $_SESSION['username'];
		$start_time = $intime;
		
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

		$query = "INSERT INTO STUDENTAVAIL (username, date, avail_start, avail_end) VALUES(?, ?, ?, ?)";
		$stmt = $indb->stmt_init();
		if (!$stmt->prepare($query)) {
			die("Faied to prepare statement: ".$query);
		} else {
			$stmt->bind_param('ssss', $username, $indate, $start_time, $end_time);
		}

		if(!$stmt->execute()) {
				die("Error in statement execution: ".$stmt->error);
		}

		$stmt->close();
	}
	
	function removeTime($indate, $intime, $indb) {
		global $errors;
		$username = $_SESSION['username'];
		$start_time = $intime;
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
		
		$query = "DELETE FROM STUDENTAVAIL WHERE username = ? AND date = ? AND avail_start = ?";
		$stmt = $indb->stmt_init();
		if (!$stmt->prepare($query)) {
			die("Faied to prepare statement: ".$query);
		} else {
			$stmt->bind_param('sss', $username, $indate, $start_time);
		}
		
		if(!$stmt->execute()) {
				die("Error in statement execution: ".$stmt->error);
		}
		
		$stmt->close();
	}

	if (isset($_POST['ta_times'])) {
		$date = mysqli_real_escape_string($db, $_POST['date']);
		$timeinput = mysqli_real_escape_string($db, $_POST['time']);
		$avail = mysqli_real_escape_string($db, $_POST['availgroup']);

		if (empty($date)) { array_push($errors, "Date is required"); }
		if (empty($avail)) { array_push($errors, "Availability is required"); }
		
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

		if (count($errors) == 0 && $avail == 'avail') {
			if ($time == 'allday') {
				$timearray = array('09:15:00', '14:15:00', '17:15:00');
				for ($i = 0; $i < 3; $i++) {
					putInTime($date, $timearray[$i], $db);
				}
			}
			else {
				putInTime($date, $time, $db);
			}
		}
		
		if (count($errors) == 0 && $avail == 'unavail') {
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
?>