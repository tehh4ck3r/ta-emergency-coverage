<?php
	/* find-replacement-serv.php: handles the server-side portion of showing 
	 * available replacement TAs.
	 * 
	 * Takes user input for a date and time and returns a list of TAs 
	 * who are available at that time.
	 */
	
	require('dbconn.php');
	$errors = array(); 
	require('errors.php');
	
	// if we recieved the right POST request
	if (isset($_POST['replacements'])) {
		// recieve all input values from the form
		$date = mysqli_real_escape_string($db, $_POST['date']);
		$timeinput = mysqli_real_escape_string($db, $_POST['time']);
		
		// form validation: ensure that the form is correctly filled
		if (empty($date)) { array_push($errors, "Date is required"); }
		if (empty($timeinput)) { array_push($errors, "Time is required"); }
		
		// based on form input, select the correct starting time of the lab
		$time = '00:00:00';
		switch ($timeinput) {
			case '9to12':
				$time = '09:15:00';
				break;
			case '2to5':
				$time = '14:15:00';
				break;
			case '5to8':
				$time = '17:15:00';
				break;
		}
		
		// show replacements if there are no errors in the form
		if (count($errors) == 0) {
			$query = "SELECT first, last, email, phone, notify FROM USERS NATURAL JOIN STUDENTAVAIL 
						WHERE username != ? AND role = 'ta' AND date = ? AND avail_start = ?"; // using prepared statements

			$stmt = $db->stmt_init();

			// die if the statement wasn't successfully prepared
			if (!$stmt->prepare($query)) {
				die("Faied to prepare statement: ".$query);
			} else {
				$stmt->bind_param('sss', $_SESSION['username'], $date, $time); // bind the input parameters to the query
			}
			
			// if the statement did not execute successfully, die and print the error
			if(!$stmt->execute()) {
				die("Error in statement execution: ".$stmt->error);
			}
			
			// get the results
			$results = $stmt->get_result();

			// display them in table format
			echo ('<table class="table table-striped">');
			echo ('<tr> <th>Name</th> <th>Email</th> <th>Phone</th> <th>Primary Contact</th> </tr>');

			// display each row in the result set
			foreach ($results as $i) {
				echo('<tr>');
				echo('<td>'.$i['first'].' '. $i['last'].'</td>'); // first and last name
				echo('<td>'. $i['email'].'</td>'); // email
				echo('<td>'. $i['phone']. '</td>');  // phone number
				
				// Display the TA's preferred method of contact
				if ($i['notify'] == 'phone') {
					echo('<td>Phone</td>');
				} else {
					echo('<td><a href="mailto:'.$i['email'].'?subject=Lab TA Replacement">Email</a></td>'); // if email, create a hyperlink to send email
				}

				echo("</tr>");
			}
			echo("</table>");

			$stmt->close();
		}
	}
?>