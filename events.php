<?php
	require('dbconn.php');
	
	$query = "SELECT * FROM EVENTS ORDER BY id";
	
	$results = mysqli_query($db, $query, MYSQLI_USE_RESULT);
	
	$result_array = $results->fetch_all(MYSQLI_ASSOC);

	echo json_encode($result_array);
?>