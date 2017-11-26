<?php 
	require('login-serv.php');
	if (isset($_SESSION['username']) && isset($_SESSION['password']) && isset($_SESSION['role'])) {
		header('location: calendar.php');
	}
?>
<!DOCTYPE html>
<html>
	<head>
		<link rel="stylesheet" type="text/css" href="css/common.css">
		<link rel="stylesheet" type="text/css" href="css/navbar.css">
		<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
		
		<script src="https://code.jquery.com/jquery-3.2.1.min.js"></script>
		<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
		
		<title>Login</title>
	</head>
	<body class="body-bg">
		<!--things to add:-->
		<!--security: add professor add code?-->
		<div class="header">
			<h2>Login</h2>
		</div>
		<div class="content">
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
		</div>
	</body>
</html>	