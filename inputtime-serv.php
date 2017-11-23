<?php
	require('dbconn.php');
	require('errors.php');
	
	function putInTime($indate, $intime, $indb) {
		$query = "SELECT section_id, section_date, start_time, end_time 
					FROM CLASSES WHERE section_date = '$indate' AND start_time = '$intime'";
		
		echo($query.'<br>');
		$results = mysqli_query($indb, $query, MYSQLI_USE_RESULT);
		$resultarray = array();
		
		foreach($results as $i) {
			array_push($resultarray, $i);
		}
		
		$results->close();
		
		foreach($resultarray as $i){
			$username = $_SESSION['username'];
			$section_id = $i['section_id'];
			$section_date = $i['section_date'];
			$start_time = $i['start_time'];
			$end_time = $i['end_time'];
			
			$query2 = "INSERT INTO STUDENTAVAIL (username, section_id, section_date, start_time, avail_start, avail_end) 
						VALUES('$username', $section_id, '$section_date', '$start_time', '$start_time', '$end_time')";
			
			echo($query2.'<br>');
			mysqli_query($indb, $query2) or die(mysqli_error($indb));
		}
	}
	
	$errors = array(); 

	if (isset($_POST['ta_times'])) {
		$date = mysqli_real_escape_string($db, $_POST['date']);
		$timeinput = mysqli_real_escape_string($db, $_POST['time']);
		$avail = mysqli_real_escape_string($db, $_POST['avail']);
		$unavail = mysqli_real_escape_string($db, $_POST['unavail']);

		if (empty($date)) { array_push($errors, "Date is required"); }
		if (empty($avail) && empty($unavail)) { array_push($errors, "Availability is required"); }
		
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

		if (count($errors) == 0 && $avail == 'on') {
			$username = $_SESSION['username'];
			
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
	}
?>