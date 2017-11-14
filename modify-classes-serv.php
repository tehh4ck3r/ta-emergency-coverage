<?php
	require('dbconn.php');
	require('errors.php');

	$errors = array(); 

	// REGISTER USER
	if (isset($_POST['add_class'])) {
		// receive all input values from the form
		$department = mysqli_real_escape_string($db, $_POST['department']);
		$catalognum = mysqli_real_escape_string($db, $_POST['catalognum']);
		$section_id = mysqli_real_escape_string($db, $_POST['section_id']);
		$date = mysqli_real_escape_string($db, $_POST['date']);
		$starttime = mysqli_real_escape_string($db, $_POST['starttime']);
		$endtime = mysqli_real_escape_string($db, $_POST['endtime']);
		
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
				$quarter = 'W';
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
		$role = mysqli_real_escape_string($db, $_POST['role']);

		// form validation: ensure that the form is correctly filled
		if (empty($department)) { array_push($errors, "Department is required"); }
		if (empty($catalognum)) { array_push($errors, "Catalog number is required"); }
		if (empty($section_id)) { array_push($errors, "Section ID is required"); }
		if (empty($date)) { array_push($errors, "Date is required"); }
		if (empty($starttime)) { array_push($errors, "Start time is required"); }
		if (empty($endtime)) { array_push($errors, "End time is required"); }
		
		$class_name = $department.' '.$catalognum;
		$professor = $_SESSION['username'];

		// add class if there are no errors in the form
		if (count($errors) == 0) {
			$query = "INSERT INTO CLASSES (class_name, section_id, section_date, start_time, end_time, quarter, year, ta, professor) 
					  VALUES('$class_name', '$section_id', '$date', '$starttime', '$endtime', '$quarter', '$year', '$ta', '$professor')";
			mysqli_query($db, $query);
		}
	}
?>