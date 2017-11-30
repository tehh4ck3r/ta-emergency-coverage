<?php
	/* ta-list.php: handles the user-facing portion of the TA list page.
	 * 
	 * Displays a list of all TAs in the system.
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
		
		<title>TA List</title>
	</head>
	
	<body class="body-bg">	
		<!-- Header -->
		<div class="header">
			<h2>List of Teaching Assistants</h2>
		</div>

		<!-- Content -->
		<div class="content">
			<!-- Show list of TAs via PHP -->
			<?php require('ta-list-serv.php'); ?>
		</div>
	</body>
</html>