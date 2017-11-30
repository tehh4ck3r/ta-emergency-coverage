<?php
	/* ta-list-serv.php: handles the server-side portion of showing 
	 * a list of all TAs in the system.
	 * 
	 * Queries the database for a list of all TAs registered and
	 * outputs them in an HTML table.
	 */
	
	require('dbconn.php');
	$query = "SELECT first, last, email, phone, notify from USERS where role = 'ta'"; // using prepared statements

	$stmt = $db->stmt_init(); 

	// die if the statement wasn't successfully prepared
	if (!$stmt->prepare($query)) {
		die("Faied to prepare statement: ".$query);
	} 

	// if the statement did not execute successfully, die and print the error
	if(!$stmt->execute()) {
		die("Error in statement execution: ".$stmt->error);
	}

	// get the results
	$results = $stmt->get_result();

	// display them in table format
	echo('<h2><u>List of TAs</u></h2><br/>');
	echo ('<table class="table table-striped">');
	echo ('<tr> <th>Name</th> <th>Email</th> <th>Phone</th> <th>Primary Contact</th> </tr>');

	// display each row in the result set
	foreach ($results as $i) {
		echo('<tr>');
		echo('<td>'.$i['first'].' '. $i['last'].'</td>'); // first and last name
		echo('<td>'. $i['email'].'</td>'); // email
		echo('<td>'. $i['phone']. '</td>'); // phone number

		// Display the TA's preferred method of contact
		if ($i['notify'] == 'phone') {
			echo('<td>Phone</td>');
		} else {
			echo('<td><a href="mailto:'.$i['email'].'?$subject=Lab TA Replacement">Email</a></td>'); // if email, create a hyperlink to send email
		}
		echo("</tr>");
	}
	echo("</table>");
	
	$stmt->close();
?>