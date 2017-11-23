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

		<nav class="navbar navbar-inverse">
			<div class="container-fluid" style="width:100%">
				<div class="navbar-header">
					<a class="navbar-brand" href="calendar.php"><span class="glyphicon glyphicon-home"></span></a>
				</div>
				<ul class="nav navbar-nav" style="display:inline">
					<li><a href="inputtime.php">Edit Availability</a></li>
					<li><a href="ta-list.php">Find Replacements</a></li>
					<?php 
						if ($_SESSION['role'] == 'prof') {
							echo('<li><a href="modify-classes.php">Add Classes</a></li>');
							echo('<li><a href="delete-classes.php">Remove Classes</a></li>');
						}
					?>
				</ul>
				<ul class="nav navbar-nav navbar-right" style= "display:inline">
					<li><a href="logout.php"><span class="glyphicon glyphicon-log-in"></span> Logout</a></li>
					<?php echo('<li><a> <span class="glyphicon glyphicon-user" ></span> '.$_SESSION['username'].'</a></li>'); ?>
					<!-- if time should i add modal? ...that when you click on username it display status ta or prof? -->
				</ul>
			</div>
		</nav>
		
		<title>TA List</title>
	</head>
	
	<body class="body-bg">	
		<!--The Big Pink-->
		<div class="header">
			<h2>List of Teaching Assistants</h2>
		</div>

		<!--The content-->
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

		<!--Notify Professors if there is one day left-->
		<!--query db for time and send echo notification through email-->
	</body>
</html>