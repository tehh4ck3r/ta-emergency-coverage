<?php
	/* userprofile.php: handles the user-facing portion of the user profile page.
	 * 
	 * Displays a list of the logged-in user's upcoming labs and availability.
	 */
	require('auth.php');
?>
<!DOCTYPE html>
<html>
	<head>
		<meta charset="utf-8">
		<meta name="viewport" content="width=device-width, initial-scale=1">
		
		<link rel="stylesheet" type="text/css" href="css/common.css">
		<link rel="stylesheet" type="text/css" href="css/navbar.css">
		<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
		
		<script src="https://code.jquery.com/jquery-3.2.1.min.js"></script>
		<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>

		<?php require('navbar.php');?> <!-- Navbar -->
		
		<title>User Profile</title>
	</head>
	
	<body class="body-bg">	
		<!-- Header -->
		<div class="header">
			<h2>User Profile</h2>
		</div>

		<!-- Content -->
		<div class="content">
			<!-- Show list of labs and availability via PHP -->
			<?php require('userprofile-serv.php'); ?>
		</div>
	</body>
</html>