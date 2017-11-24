<?php
	require('dbconn.php');
	require('auth.php');
?>
<!DOCTYPE html>
<html>
	<head>
		<meta charset="utf-8">
		<meta name="viewport" content="width=device-width, initial-scale=1">
		
		<link rel="stylesheet" type="text/css" href="/css/common.css">
		<link rel="stylesheet" type="text/css" href="/css/navbar.css">
		<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
		
		<script src="https://code.jquery.com/jquery-3.2.1.min.js"></script>
		<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>

		<?php require('navbar.php');?>
		
		<title>User Profile</title>
	</head>
	
	<body class="body-bg">	
		<!--The Big Pink-->
		<div class="header">
			<h2>User Profile</h2>
		</div>

		<!--The content-->
		<div class="content">
			<?php
				$username = $_SESSION['username'];
				$query = "SELECT class_name, section_date, start_time, end_time FROM CLASSES WHERE ta = '$username' AND section_date >= CURDATE()";
				echo $query;
				$results = mysqli_query($db, $query, MYSQLI_USE_RESULT);
				echo('<h2><u>Your Upcoming Labs</u></h2><br/>');
				echo ('<table class="table table-striped">');
				echo ('<tr> <th>Class</th> <th>Date</th> <th>Start Time</th> <th>End Time</th> </tr>');
				foreach ($results as $i) {
					echo('<tr>');
					echo('<td>'.$i['class_name'].'</td>');
					echo('<td>'. $i['section_date'].'</td>');
					echo('<td>'. $i['start_time']. '</td>');
					echo('<td>'. $i['end_time']. '</td>');
					echo("</tr>");
				}
			?>
		</div>
	</body>
</html>