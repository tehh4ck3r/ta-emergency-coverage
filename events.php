<?php
	/* events.php: serves events for the calendar.
	 * 
	 * Returns the rows of the EVENTS table in the database
	 * as a JSON object. 
	 */

	require('dbconn.php');
	
	$query = "SELECT * FROM EVENTS ORDER BY id"; // using prepared statements
	
	$stmt = $db->stmt_init();
	
	// die if the statement wasn't successfully prepared
	if (!$stmt->prepare($query)) {
		die("Faied to prepare statement: ".$query);
	} 
	
	// if the statement did not execute successfully, die and print the error
	if(!$stmt->execute()) {
		die("Error in statement execution: ".$stmt->error);
	}
	
	// get the results of the query
	$results = $stmt->get_result();
	$result_array = $results->fetch_all(MYSQLI_ASSOC);
	
	$stmt->close();

	// return the results in a JSON object.
	echo json_encode($result_array);
?>