<?php
	require('dbconn.php');

	$errors = array(); 

	// REGISTER USER
	if (isset($_POST['add_class'])) {
		// receive all input values from the form
		$department = mysqli_real_escape_string($db, $_POST['department']);
		$catalognum = mysqli_real_escape_string($db, $_POST['catalognum']);
		$section_id = mysqli_real_escape_string($db, $_POST['section_id']);
		$date = mysqli_real_escape_string($db, $_POST['date']);
		$timeinput = mysqli_real_escape_string($db, $_POST['time']);
		
		$datetoken = mysqli_real_escape_string($db, $_POST['date']);
		$year = strtok($datetoken, "-");
		$month = strtok("-");
		
		switch ($month) {
			case 1:
			case 2:
			case 3:
				$quarter = 'W';
				break;
			case 4:
			case 5:
			case 6:
				$quarter = 'S';
				break;
			case 9:
			case 10:
			case 11:
			case 12:
				$quarter = 'F';
				break;
			default:
				$quarter = 'F';
		}

		$ta = mysqli_real_escape_string($db, $_POST['ta']);

		// form validation: ensure that the form is correctly filled
		if (empty($department)) { array_push($errors, "Department is required"); }
		if (empty($catalognum)) { array_push($errors, "Catalog number is required"); }
		if (empty($section_id)) { array_push($errors, "Section ID is required"); }
		if (empty($date)) { array_push($errors, "Date is required"); }
		if (empty($timeinput)) { array_push($errors, "Time is required"); }
		
		$starttime = '00:00:00';
		$endtime = '00:00:00';
		switch ($timeinput) {
			case '9to12':
				$starttime = '09:15:00';
				$endtime = '12:00:00';
				break;
			case '2to5':
				$starttime = '14:15:00';
				$endtime = '17:00:00';
				break;
			case '5to8':
				$starttime = '17:15:00';
				$endtime = '20:00:00';
				break;
		}
		
		$class_name = $department.' '.$catalognum;
		$professor = $_SESSION['username'];

		// add class if there are no errors in the form
		if (count($errors) == 0) {
			$query = "INSERT INTO CLASSES (class_name, section_id, section_date, start_time, end_time, quarter, year, ta, professor) 
					  VALUES(?, ?, ?, ?, ?, ?, ?, ?, ?)";
			
			$stmt = $db->stmt_init();
			if (!$stmt->prepare($query)) {
				die("Faied to prepare statement: ".$query);
			} else {
				$stmt->bind_param('sissssiss', $class_name, $section_id, $date, $starttime, $endtime, $quarter, $year, $ta, $professor);
			}

			if(!$stmt->execute()) {
				die("Error in statement execution: ".$stmt->error);
			}	
		
			$stmt->close();
		}
	}
?>