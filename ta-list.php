<?php
	require('dbconn.php');
	require('auth.php');
?>
<!DOCTYPE html>
<html>
	<head>
		<meta charset="utf-8">
		<meta name="viewport" content="width=device-width, initial-scale=1">
		<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
		<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
		<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>

		<title>TA List</title>
		<link rel="stylesheet" type="text/css" href="login-style.css">
	</head>
	
	<body style = "background-image:url('https://upload.wikimedia.org/wikipedia/commons/f/f5/Scumission.jpg')">
	<!--nav bar	-->
	<nav class="navbar navbar-inverse">
	  <div class="container-fluid">
	    <div class="navbar-header">
	      <a class="navbar-brand glyphicon glyphicon-home" href="calendar.php">Ta</a>
	    </div>
	    <ul class="nav navbar-nav" style="display:inline">
	      <li><a href="inputtime.php">Schedule</a></li>
	      <li><a href="ta-list.php">Notify</a></li>
	    </ul>
	    <ul class="nav navbar-nav navbar-right">
	      <li><a href="logout.php"><span class="glyphicon glyphicon-log-in"></span> logout</a></li>
	       <?php echo('<li><a href="login.php"> <span class="glyphicon glyphicon-user"></span>'.$_SESSION['username'].'</a></li>'); ?>
	    </ul>
	  </div>
	</nav>
	
	<!--The Big Pink-->
	<div class="header">
			<h2>List of Teaching Assistants</h2>
	</div>
	
	<!--The content-->
		<div class="content">
			<?php
				$query = "SELECT first, last, email, phone, notify from USERS where role = 'ta'";
				$results = mysqli_query($db, $query, MYSQLI_USE_RESULT);
				echo('<h2><u>List of TAs</u></h2><br/>');
				echo ('<table class="table table-striped">');
				echo ('<tr> <th>Name</th> <th>email</th> <th>phone</th> <th>primary-contact</th> </tr>');
				foreach ($results as $i) {
					echo('<tr>');
					echo('<td>'.$i['first'].' '. $i['last'].'</td>');
					echo('<td>'. $i['email'].'</td>');
					echo('<td>'. $i['phone']. '</td>');
					if ($i['notify'] == 'phone') {
						echo('<td>Phone</td>');
					} else {
						echo('<td><a href="mailto:'.$i['email'].'?$subject=Lab TA Replacement">Email</a></td>');
					}
					echo("</tr>");
				}
			?>
		</div>
			<!--Notify Professors if there is one day left-->
				<!--query db for time and send echo notification through email-->
	</body>
</html>