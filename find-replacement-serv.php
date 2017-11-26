<?php
	require('dbconn.php');
	require('errors.php');
	$errors = array(); 
	
	if (isset($_POST['replacements'])) {
		$date = $_POST['date'];
		$timeinput = mysqli_real_escape_string($db, $_POST['time']);
		
		if (empty($date)) { array_push($errors, "Date is required"); }
		if (empty($timeinput)) { array_push($errors, "Time is required"); }
		
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
			case 'allday':
				$time = 'allday';
				break;
		}
		
		if (count($errors) == 0) {
			$query = "SELECT first, last, email, phone, notify FROM USERS NATURAL JOIN STUDENTAVAIL 
						WHERE username != ? AND role = 'ta' AND date = ? AND avail_start = ?";
			$stmt = $db->stmt_init();
			if (!$stmt->prepare($query)) {
				die("Faied to prepare statement: ".$query);
			} else {
				$stmt->bind_param('sss', $_SESSION['username'], $date, $time);
			}
			
			if(!$stmt->execute()) {
				die("Error in statement execution: ".$stmt->error);
			}
			
			$results = $stmt->get_result();
			echo ('<table class="table table-striped">');
			echo ('<tr> <th>Name</th> <th>Email</th> <th>Phone</th> <th>Primary Contact</th> </tr>');
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
		}
	}
?>