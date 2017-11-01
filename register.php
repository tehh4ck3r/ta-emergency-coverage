<?php 
	require('register-serv.php');
?>
<!DOCTYPE html>
<html>
	<head>
		<title>Sign Up</title>
		<link rel="stylesheet" type="text/css" href="login-style.css">
	</head>
	<body>
		<div class="header">
			<h2>Sign Up</h2>
		</div>
		<form action="register.php" method="post">
			<?php include('errors.php'); ?>
			<div class="input-group">
				<label>Username</label>
				<input type="text" name="username"> 
			</div>
			<div class="input-group">
				<label>First Name</label>
				<input type="text" name="firstname">
			</div>
			<div class="input-group">
				<label>Last Name</label>
				<input type="text" name="lastname">
			</div>
			<div class="input-group">
				<label>Email</label>
				<input type="email" name="email">
			</div>
			<div class="input-group">
				<label>Phone Number</label>
				<input type="tel" name="phone">
			</div>
			<div class="input-group">
				<label>Password</label>
				<input type="password" name="password_1">
			</div>
			<div class="input-group">
				<label>Confirm Password</label>
				<input type="password" name="password_2">
			</div>
				<div class="input-group">
				<label>Primary Notification</label>
				<select name="notify">
				<option Value="phone">Phone</option>
				<option Value="email">Email</option></select>
			</div>
				<div class="input-group">
				<label>Role</label>
				<select name="role">  
				<option Value="ta">Teaching Assistant</option>
				<option Value="prof">Professor</option></select>
			</div>
			<div>
				<input type="submit" class="btn" name="reg_user" value="Register">
			</div>
			<p>Already a member? <a href="login.php">Sign in</a></p>
		</form> 
	</body>
</html>
    