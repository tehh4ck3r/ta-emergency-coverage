<?php
	/* userprofile-serv.php: handles the server-side portion of the user
	 * profile page.
	 * 
	 * Queries the database for a list of logged-in user's upcoming 
	 * labs and availability and outputs them in HTML tables.
	 */
	require('dbconn.php');

	// get the logged in user
	$username = $_SESSION['username'];

	/* Display Upcoming Labs */
	$query = "SELECT class_name, section_date, start_time, end_time FROM CLASSES WHERE ta = ? AND section_date >= CURDATE()"; // using prepared statements

	$stmt = $db->stmt_init();

	// die if the statement wasn't successfully prepared 
	if (!$stmt->prepare($query)) {
		die("Faied to prepare statement: ".$query);
	} else {
		$stmt->bind_param('s', $username); // bind the input parameters to the query
	}

	// if the statement did not execute successfully, die and print the error
	if(!$stmt->execute()) {
		die("Error in statement execution: ".$stmt->error);
	}

	// get the results 
	$results = $stmt->get_result();

	// display them in table format
	echo('<h2><u>Your Upcoming Labs</u></h2><br/>');
	echo ('<table class="table table-striped">');
	echo ('<tr> <th>Class</th> <th>Date</th> <th>Start Time</th> <th>End Time</th> </tr>');

	// display each row in the result set
	foreach ($results as $i) {
		echo('<tr>');
		echo('<td>'.$i['class_name'].'</td>'); // class name
		echo('<td>'. $i['section_date'].'</td>'); // date
		echo('<td>'. $i['start_time']. '</td>'); // start time
		echo('<td>'. $i['end_time']. '</td>'); // end time
		echo("</tr>");
	}
	echo("</table>");

	$stmt->close();

	/* Display Availability */
	$query = "SELECT date, avail_start, avail_end FROM STUDENTAVAIL WHERE username = ? AND date >= CURDATE()"; // using prepared statements
	
	$stmt = $db->stmt_init();
	
	// die if the statement wasn't successfully prepared 
	if (!$stmt->prepare($query)) {
		die("Faied to prepare statement: ".$query);
	} else {
		$stmt->bind_param('s', $username); // bind the input parameters to the query
	}

	// if the statement did not execute successfully, die and print the error
	if(!$stmt->execute()) {
		die("Error in statement execution: ".$stmt->error);
	}

	// get the results
	$results = $stmt->get_result();

	// display them in table format
	echo('<h2><u>Your Upcoming Availability</u></h2><br/>');
	echo ('<table class="table table-striped">');
	echo ('<tr> <th>Date</th> <th>Start Time</th> <th>End Time</th> </tr>');

	// display each row in the result set
	foreach ($results as $i) {
		echo('<tr>');
		echo('<td>'. $i['date'].'</td>'); // date
		echo('<td>'. $i['avail_start']. '</td>'); // availability start time
		echo('<td>'. $i['avail_end']. '</td>'); // availability end time
		echo("</tr>");
	}
	echo("</table>");

	$stmt->close();
?>