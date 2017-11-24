<?php
	require('dbconn.php');
	
	$username = $_SESSION['username'];
	$query = "SELECT class_name, section_date, start_time, end_time FROM CLASSES WHERE ta = ? AND section_date >= CURDATE()";
	$stmt = $db->stmt_init();
	if (!$stmt->prepare($query)) {
		die("Faied to prepare statement: ".$query);
	} else {
		$stmt->bind_param('s', $username);
	}
	if(!$stmt->execute()) {
		die("Error in statement execution: ".$stmt->error);
	}

	$results = $stmt->get_result();
	echo('<h2><u>Your Upcoming Labs</u></h2><br/>');
	echo ('<table class="table table-striped">');
	echo ('<tr> <th>Class</th> <th>Date</th> <th>Start Time</th> <th>End Time</th> </tr>');
	foreach ($results as $i) {
		echo('<tr>');
		echo('<td>'.$i['class_name'].'</td>');
		echo('<td>'. $i['section_date'].'</td>');
		echo('<td>'. $i['start_time']. '</td>');
		echo('<td>'. $i['end_time']. '</td>');
		echo("</tr>");
	}
	$stmt->close();
?>