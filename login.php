<?php 
	require('login-serv.php');	
	session_start();
?>
<!DOCTYPE html>
<html>
	<head>
		<title>Login</title>
		<link rel="stylesheet" type="text/css" href="login-style.css">
	</head>
	<body>
		<div class="header">
			<h2>Login</h2>
		</div>
		<form action="login.php" method="post">
			<?php include('errors.php'); ?>
			<div class="input-group">
				<label>Username</label>
				<input type="text" name="username">
			</div>
			<div class="input-group">
				<label>Password</label>
				<input type="password" name="password">
			</div>
			<div>
				<input type="submit" class="btn" name="login_user" value="Login">
			</div>
			<p>Not yet a member? <a href="register.php">Register</a></p>
		</form>
	</body>
</html>	