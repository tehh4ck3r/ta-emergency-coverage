<?php
	require('auth.php');
	require('inputtime-serv.php');
?>
<!DOCTYPE html>
<html>
<head>
	<!-- <meta charset="utf-8">
  	<meta name="viewport" content="width=device-width, initial-scale=1">
  	<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
  	<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
  	<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
	<title>Login</title>
	<link rel="stylesheet" type="text/css" href="login-style.css"> -->
	<title>TA Change Times</title>
	<link rel="stylesheet" type="text/css" href="login-style.css">
</head>
<body>
	<div class="header">
		<h2>Modify Times</h2>
	</div>
	
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
					<option value="12to2">12:15-02:00</option>
					<option value="2to5">02:15-05:00</option>
					<option value="5to8">05:15-08:00</option>
					<?php /*
						require('dbconn.php');
						$query = "SELECT first, last, username FROM USERS WHERE role = 'ta'";
						$results = mysqli_query($db, $query, MYSQLI_USE_RESULT);
						foreach ($results as $i) {
							echo('<option value="'.$i['username'].'">'.$i['first'].' '.$i['last'].'</option>');
						} */
					?>
				</select>
		</div>
		<div class="radio">
 		<label><input type="radio" name="avail">I am available for labs occurring at this time on the above date</label>
		</div>
		<div class="radio">
  		<label><input type="radio" name="unavail">I am NOT available labs occurring at this time on the above date</label>
		</div>
		<div class="input-group">
			<button type="submit" class="btn" name="ta_times">Submit</button>
		</div>
	</form>
</body>
</html>	
