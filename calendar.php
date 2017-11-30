<?php
	/* calendar.php: Serves as main landing page for system.
	 * 
	 * Displays the calendar and the navbar.
	 */
	require('auth.php');
?>
<!DOCTYPE html>
<html>
	<head>
		<meta charset="utf-8">
		<meta name="viewport" content="width=device-width, initial-scale=1">
		
		<link rel="stylesheet" type="text/css" href="css/calendar-style.css">
		<link rel="stylesheet" type="text/css" href="css/common.css">
		<link rel="stylesheet" type="text/css" href="css/navbar.css">
		<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/fullcalendar/3.7.0/fullcalendar.css"> <!-- Required by calendar -->
		<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
		
		<script src="https://code.jquery.com/jquery-3.2.1.min.js"></script> <!-- Required by calendar and by bootstrap -->
		<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
		<script src="https://cdnjs.cloudflare.com/ajax/libs/moment.js/2.19.2/moment.min.js"></script> <!-- Required by calendar -->
		<script src="https://cdnjs.cloudflare.com/ajax/libs/fullcalendar/3.7.0/fullcalendar.min.js"></script> <!-- Required by calendar -->

		<?php require('navbar.php');?> <!-- Navbar -->

		<title>TA Emergency Coverage System</title>
	</head>

	<body>
		<script src="calendar.js"></script> <!-- Put in the calendar's JavaScript -->
		
		<!-- The calendar -->
		<div class="cont">
			<div id="calendar"></div>
		</div>
	</body>
</html>