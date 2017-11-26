<?php
	require('auth.php');
?>
<!DOCTYPE html>
<html>
	<head>
		<meta charset="utf-8">
		<meta name="viewport" content="width=device-width, initial-scale=1">
		
		<link rel="stylesheet" type="text/css" href="css/calendar-style.css">
		<link rel="stylesheet" type="text/css" href="css/legend-style.css">
		<link rel="stylesheet" type="text/css" href="css/common.css">
		<link rel="stylesheet" type="text/css" href="css/navbar.css">
		<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/fullcalendar/3.7.0/fullcalendar.css">
		<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
		
		<script src="https://code.jquery.com/jquery-3.2.1.min.js"></script>
		<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
		<script src="https://cdnjs.cloudflare.com/ajax/libs/moment.js/2.19.2/moment.min.js"></script>
		<script src="https://cdnjs.cloudflare.com/ajax/libs/fullcalendar/3.7.0/fullcalendar.min.js"></script>
		
		<!-- <script src="js/lib/modernizr-2.6.2-respond-1.1.0.min.js"></script> -->
		<!-- <script src="http://ajax.googleapis.com/ajax/libs/jquery/1.9.1/jquery.min.js></script> -->
		<!-- <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/4.0.0-alpha.6/css/bootstrap.css" /> -->
		<!-- <script src="https://cdnjs.cloudflare.com/ajax/libs/jqueryui/1.12.1/jquery-ui.min.js"></script> -->

		<?php require('navbar.php');?>

		<title>TA Emergency Coverage System</title>
	</head>

	<body>
		<script src="calendar.js"></script>
		<div class="cont">
			<div id="calendar"></div>
			<!-- <div class="my-legend">
				<div class="legend-title">Section Times</div>
				<div class="legend-scale">
					<ul class="section-times">
						<li><span style='background:#B30838;'></span>9:15-12:00</li>
						<li><span style='background:#FEBE10;'></span>2:15-5:00</li>
						<li><span style='background:#A7A586;'></span>5:15-8:00</li>
						<li><span style='background:#FB8072;'></span>Other</li>
					</ul>
				</div>
			</div> -->
		</div>
	</body>
</html>