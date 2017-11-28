<?php
	/* inputtime.php: handles the user-facing portion of recording TA availability.
	 * 
	 * Takes user input for a date and time and whether they are or are not available
	 * during that time and submits them via POST request.
	 */

	require('auth.php');
	require('inputtime-serv.php');
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

		<?php require('navbar.php');?>

		<title>TA Change Times</title>
	</head>
	<body class="body-bg">
		<div class="header">
			<h2>Modify Times</h2>
		</div>
		<div class="content">
			<form action="inputtime.php" method="post">
				<?php include('errors.php');?>
				<div class="input-group">
					<label>Date</label>
					<input type="date" name="date">
				</div>
				<div class="input-group">
					<label>Time</label>
					<select name="time">
						<option value="9to12">09:15-12:00</option>
						<option value="2to5">02:15-05:00</option>
						<option value="5to8">05:15-08:00</option>
						<option value="allday">All of the above</option>
					</select>
				</div>
				<div class="radio">
					<label><input type="radio" name="availgroup" value="avail">I am available for labs occurring at this time on the above date</label>
					<label><input type="radio" name="availgroup" value="unavail">I am NOT available labs occurring at this time on the above date</label>
				</div>
				<div class="input-group">
					<button type="submit" class="btn" name="ta_times">Submit</button>
				</div>
			</form>
		</div>
	</body>
</html>