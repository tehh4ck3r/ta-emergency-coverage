<?php
	require('auth.php');
	require('dbconn.php');
?>
<!DOCTYPE html>
<html>
	<head>
		<meta charset="utf-8">
		<meta name="viewport" content="width=device-width, initial-scale=1">
		
		<link rel="stylesheet" type="text/css" href="calendar-style.css">
		<link rel="stylesheet" type="text/css" href="legend-style.css">
		<link rel="stylesheet" type="text/css" href="login-style.css">
		<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/fullcalendar/3.7.0/fullcalendar.css" />
		<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
		
		<script src="https://code.jquery.com/jquery-3.2.1.min.js"></script>
		<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
		<script src="https://cdnjs.cloudflare.com/ajax/libs/moment.js/2.19.2/moment.min.js"></script>
		<script src="https://cdnjs.cloudflare.com/ajax/libs/fullcalendar/3.7.0/fullcalendar.min.js"></script>
		
		<!-- <script src="js/lib/modernizr-2.6.2-respond-1.1.0.min.js"></script> -->
		<!-- <script src="http://ajax.googleapis.com/ajax/libs/jquery/1.9.1/jquery.min.js></script> -->
		<!-- <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/4.0.0-alpha.6/css/bootstrap.css" /> -->
		<!-- <script src="https://cdnjs.cloudflare.com/ajax/libs/jqueryui/1.12.1/jquery-ui.min.js"></script> -->

		<nav class="navbar navbar-inverse">
			<div class="container-fluid" style="width:100%">
				<div class="navbar-header">
					<a class="navbar-brand" href="calendar.php"><span class="glyphicon glyphicon-home"></span></a>
				</div>
				<ul class="nav navbar-nav" style="display:inline">
					<li><a href="inputtime.php">Edit Availability</a></li>
					<li><a href="ta-list.php">Notify</a></li>
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
	</head>

	<body>
		<script src="calendar.js"></script>
		<div class = 'cont'>
			<div id='calendar'></div>
			<div class='my-legend'>
				<div class='legend-title'>Section Times</div>
				<div class='legend-scale'>
					<ul class='section-times'>
						<li><span style='background:#B30838;'></span>9:15-12:00</li>
						<li><span style='background:#FEBE10;'></span>2:15-5:00</li>
						<li><span style='background:#A7A586;'></span>5:15-8:00</li>
						<li><span style='background:#FB8072;'></span>Other</li>
					</ul>
				</div>
			</div>
		</div>
	</body>
</html>