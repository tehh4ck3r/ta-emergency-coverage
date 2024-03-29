<?php
	/* find-replacement.php: handles the user-facing portion of finding replacement TAs.
	 * 
	 * Takes user input for a date and time and submits them via POST request.
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
		
		<title>TA Replacement Notification</title>
	</head>
	
	<body class="body-bg">
		<!-- Header -->
		<div class="header">
			<h2>Find Replacement Teaching Assistants</h2>
		</div>

		<!-- Content -->
		<div class="content">
			<form action="find-replacement.php" method="post">
				
				<!-- Date input -->
				<div class="input-group">
					<label>Date</label>
					<input type="date" name="date">
				</div>

				<!-- Time input -->
				<div class="input-group">
					<label>Time</label>
					<select name="time">
						<option value="9to12">09:15-12:00</option>
						<option value="2to5">02:15-05:00</option>
						<option value="5to8">05:15-08:00</option>
					</select>
				</div>

				<!-- Submit form -->
				<div class="input-group">
					<button type="submit" class="btn" name="replacements">Submit</button>
				</div>
			</form>

			<!-- Display results via PHP -->
			<?php require('find-replacement-serv.php'); ?> 
		</div>
	</body>
</html>