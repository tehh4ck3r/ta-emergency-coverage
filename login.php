<?php
	/* login.php: handles the user-facing portion of logging in.
	 * 
	 * Takes user input for username and password and submits them via POST request.
	 */

	require('login-serv.php');

	// if user is already logged in, redirect to calendar
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
		<!-- Header -->
		<div class="header">
			<h2>Login</h2>
		</div>

		<!-- Content -->
		<div class="content">
			<form action="login.php" method="post">
				<?php include('errors.php'); ?> <!-- Used to display errors -->
				
				<!-- Username input -->
				<div class="input-group">
					<label>Username</label>
					<input type="text" name="username">
				</div>

				<!-- Password input -->
				<div class="input-group">
					<label>Password</label>
					<input type="password" name="password">
				</div>

				<!-- Submit form -->
				<div class="input-group">
					<button type="submit" class="btn" name="login_user">Login</button>
				</div>
			</form>
			<!-- Register if not a member -->
			<p>Not yet a member? <a href="register.php">Register</a></p>
		</div>
	</body>
</html>	