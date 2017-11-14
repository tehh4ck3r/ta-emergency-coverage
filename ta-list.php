<?php
	require('dbconn.php');
	require('auth.php');
?>
<!DOCTYPE html>
<html>
	<head>
		<title>TA List</title>
		<link rel="stylesheet" type="text/css" href="login-style.css">
	</head>
	<body>
		<div class="header">
			<h2>List of Teaching Assistants</h2>
		</div>
		<div class="content">
			<?php
				$query = "SELECT first, last, email, phone, notify from USERS where role = 'ta'";
				$results = mysqli_query($db, $query, MYSQLI_USE_RESULT);
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
			?>
		</div>
	</body>
</html>