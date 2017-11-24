<?php
	require('dbconn.php');
	
	$query = "SELECT * FROM EVENTS ORDER BY id";
	
	$stmt = $db->stmt_init();
	
	if (!$stmt->prepare($query)) {
		die("Faied to prepare statement: ".$query);
	} 
	
	if(!$stmt->execute()) {
		die("Error in statement execution: ".$stmt->error);
	}
	
	$results = $stmt->get_result();
	$stmt->close();
	$result_array = $results->fetch_all(MYSQLI_ASSOC);

	echo json_encode($result_array);
?>