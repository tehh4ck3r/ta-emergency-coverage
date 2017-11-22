<?php
	require('auth.php');
	if ($_SESSION['role'] != "prof") {
		header("HTTP/1.1 403 Forbidden" );
		exit;
	}
	require('delete-classes-serv.php');
	$errors = array();
?>
<!DOCTYPE html>
<html>
	<head>
		<title>Delete Classes</title>
		<link rel="stylesheet" type="text/css" href="login-style.css">
	</head>
	<body>
		<div class="header">
			<h2>Delete Classes</h2>
		</div>
		<form action="delete-classes.php" method="post">
			<?php include('errors.php'); ?>
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
			<div>
				<input type="submit" class="btn" name="delete_class" value="Delete Class">
			</div>
		</form>
	</body>
</html>