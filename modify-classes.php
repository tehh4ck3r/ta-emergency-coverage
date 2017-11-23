<?php
	require('auth.php');
	if ($_SESSION['role'] != "prof") {
		header("HTTP/1.1 403 Forbidden" );
		exit;
	}
	require('modify-classes-serv.php');
	$errors = array();
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

		<title>Modify Classes</title>
	</head>
	<body class="body-bg">
		<div class="header">
			<h2>Add Classes</h2>
		</div>
		
		<form action="modify-classes.php" method="post">
			<?php include('errors.php'); ?>
			<div class="input-group">
				<label>Department</label>
				<input type="text" name="department"> 
			</div>
			
			<div class="input-group">
				<label>Catalog Number</label>
				<input type="text" name="catalognum">
			</div>
			
			<div class="input-group">
				<label>Section ID</label>
				<input type="text" name="section_id">
			</div>
			
			<div class="input-group">
				<label>Date</label>
				<input type="date" name="date">
			</div>
			
			<div class="input-group">
				<label>Start Time</label>
				<input type="text" name="starttime">
			</div>
			
			<div class="input-group">
				<label>End Time</label>
				<input type="text" name="endtime">
			</div>
			
			<div class="input-group">
				<label>TA</label>
				<select name="ta">
					<?php
						require('dbconn.php');
						$query = "SELECT first, last, username FROM USERS WHERE role = 'ta'";
						$results = mysqli_query($db, $query, MYSQLI_USE_RESULT);
						foreach ($results as $i) {
							echo('<option value="'.$i['username'].'">'.$i['first'].' '.$i['last'].'</option>');
						}
					?>
				</select>
			</div>
			
			<div>
				<input type="submit" class="btn" name="add_class" value="Add Class">
			</div>
		</form>
	</body>
</html>