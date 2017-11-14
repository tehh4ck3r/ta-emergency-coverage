<?php
	require('dbconn.php');
	require('errors.php');

	$errors = array(); 

	// REGISTER USER
	if (isset($_POST['delete_class'])) {
		// receive all input values from the form
		$section_id = mysqli_real_escape_string($db, $_POST['section_id']);
		$date = mysqli_real_escape_string($db, $_POST['date']);
		$starttime = mysqli_real_escape_string($db, $_POST['starttime']);
	
		// form validation: ensure that the form is correctly filled
		if (empty($section_id)) { array_push($errors, "Section ID is required"); }
		if (empty($date)) { array_push($errors, "Date is required"); }
		if (empty($starttime)) { array_push($errors, "Start time is required"); }

		// add class if there are no errors in the form
		if (count($errors) == 0) {
			$query = "DELETE FROM CLASSES
			            WHERE section_id = $section_id AND section_date = '$date' AND start_time = '$starttime'";
			mysqli_query($db, $query);
		}
	}
?>