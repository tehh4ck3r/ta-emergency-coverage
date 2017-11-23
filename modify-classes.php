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
		<title>Modify Classes</title>
		<link rel="stylesheet" type="text/css" href="login-style.css">
	</head>
	<body>
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