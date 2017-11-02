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
				$query = "SELECT first, last from USERS where role = 'ta'";
				$results = mysqli_query($db, $query, MYSQLI_USE_RESULT);
				echo('<h2><u>List of TAs</u></h2><br/>');
				foreach ($results as $i) {
					echo($i['first'].' '. $i['last']);
					echo("<br/>");
				}
			?>
		</div>
	</body>
</html>