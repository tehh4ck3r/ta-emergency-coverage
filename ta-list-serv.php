<?php
	require('dbconn.php');
	$query = "SELECT first, last, email, phone, notify from USERS where role = 'ta'";

	$stmt = $db->stmt_init();

	if (!$stmt->prepare($query)) {
		die("Faied to prepare statement: ".$query);
	} 

	if(!$stmt->execute()) {
		die("Error in statement execution: ".$stmt->error);
	}

	$results = $stmt->get_result();

	echo('<h2><u>List of TAs</u></h2><br/>');
	echo ('<table class="table table-striped">');
	echo ('<tr> <th>Name</th> <th>email</th> <th>phone</th> <th>primary-contact</th> </tr>');
	foreach ($results as $i) {
		echo('<tr>');
		echo('<td>'.$i['first'].' '. $i['last'].'</td>');
		echo('<td>'. $i['email'].'</td>');
		echo('<td>'. $i['phone']. '</td>');
		if ($i['notify'] == 'phone') {
			echo('<td>Phone</td>');
		} else {
			echo('<td><a href="mailto:'.$i['email'].'?$subject=Lab TA Replacement">Email</a></td>');
		}
		echo("</tr>");
	}
	echo("</table>");
	$stmt->close();
?>