<?php
	require('dbconn.php');
	require('errors.php');

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
				$time = '00:09:15';
				break;
			case '12to2':
				$time = '00:12:15';
				break;
			case '2to5':
				$time = '00:14:15';
				break;
			case '5to8':
				$time = '00:17:15';
				break;
		}

		if (count($errors) == 0 && $avail == 'on') {
			$username = $_SESSION['username'];
			
			$query = "SELECT section_id, section_date, start_time, end_time 
						FROM CLASSES WHERE section_date = '$date' AND start_time = '$time'";
			$results = mysqli_query($db, $query, MYSQLI_USE_RESULT);
			
			$resultarray = array();
			
			foreach($results as $i) {
				array_push($resultarray, $i);
			}

			$results->close();
			
			foreach($resultarray as $i){
				$section_id = $i['section_id'];
				$section_date = $i['section_date'];
				$start_time = $i['start_time'];
				$end_time = $i['end_time'];
				
				$query2 = "INSERT INTO STUDENTAVAIL (username, section_id, section_date, start_time, avail_start, avail_end) 
							VALUES('$username', $section_id, '$section_date', '$start_time', '$start_time', '$end_time')";
				
				mysqli_query($db, $query2);
			}
		}
	}
?>