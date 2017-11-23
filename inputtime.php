<?php
	require('auth.php');
	require('inputtime-serv.php');
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

		<title>TA Change Times</title>
	</head>
	<body>
		<div class="header">
			<h2>Modify Times</h2>
		</div>
		<form action="inputtime.php" method="post">
			<?php include('errors.php');?>
			<div class="input-group">
				<label>Date</label>
				<input type="date" name="date">
			</div>
			<div class="input-group">
				<label>Time</label>
				<select name="time">
					<option value="9to12">09:15-12:00</option>
					<option value="12to2">12:15-02:00</option>
					<option value="2to5">02:15-05:00</option>
					<option value="5to8">05:15-08:00</option>
				</select>
			</div>
			<div class="radio">
				<label><input type="radio" name="avail">I am available for labs occurring at this time on the above date</label>
			</div>
			<div class="radio">
				<label><input type="radio" name="unavail">I am NOT available labs occurring at this time on the above date</label>
			</div>
			<div class="input-group">
				<button type="submit" class="btn" name="ta_times">Submit</button>
			</div>
		</form>
	</body>
</html>