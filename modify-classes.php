<?php
	/* modify-classes.php: handles the user-facing portion of adding classes. 
	 * 
	 * Takes user input for a a department, catalog number, section ID, date, time,
	 * and default TA, and submits them via POST request.
	 */

	require('auth.php');

	// prevent non-professors from accessing the page
	if ($_SESSION['role'] != "prof") {
		header("HTTP/1.1 403 Forbidden" );
		exit;
	}

	require('modify-classes-serv.php');
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

		<title>Modify Classes</title>
	</head>
	<body class="body-bg">
		<!-- Header -->
		<div class="header">
			<h2>Add Classes</h2>
		</div>

		<!-- Content -->
		<div class="content">
			<form action="modify-classes.php" method="post">
				<?php include('errors.php'); ?> <!-- Used to display errors -->

				<!-- Department input -->
				<div class="input-group">
					<label>Department</label>
					<input type="text" name="department"> 
				</div>
				
				<!-- Catalog number input-->
				<div class="input-group">
					<label>Catalog Number</label>
					<input type="text" name="catalognum">
				</div>
				
				<!-- Section ID input -->
				<div class="input-group">
					<label>Section ID</label>
					<input type="text" name="section_id">
				</div>
				
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

				<!-- Repeat yes/no checkbox -->
				<div class="checkbox">
					<label><input type="checkbox" name="repeatornot" value="yes">Repeat once per week?</label>
				</div>
				
				<!-- Repeat end date input -->
				<div class="input-group">
					<label>Repeat until date:</label>
					<input type="date" name="repeatdate">
				</div>
				
				<!-- Default TA input -->
				<div class="input-group">
					<label>TA</label>
					<select name="ta">
						<?php
							// select an available TA from all the TAs in the system 

							require('dbconn.php');

							$query = "SELECT first, last, username FROM USERS WHERE role = 'ta'"; // using prepared statements
							
							$stmt = $db->stmt_init();

							// die if the statement wasn't successfully prepared
							if (!$stmt->prepare($query)) {
								die("Faied to prepare statement: ".$query);
							}

							// if the statement did not execute successfully, die and print the error
							if(!$stmt->execute()) {
								die("Error in statement execution: ".$stmt->error);
							}

							// get results
							$results = $stmt->get_result();

							// return results in the dropdown select
							foreach ($results as $i) {
								echo('<option value="'.$i['username'].'">'.$i['first'].' '.$i['last'].'</option>');
							}
						?>
					</select>
				</div>
				
				<!-- Submit form -->
				<div class="input-group">
					<button type="submit" class="btn" name="add_class">Add Class</button>
				</div>
			</form>
		</div>
	</body>
</html>