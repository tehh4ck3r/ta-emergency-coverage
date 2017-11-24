<nav class="navbar navbar-inverse">
	<div class="container-fluid" style="width:100%">
		<div class="navbar-header">
			<a class="navbar-brand" href="calendar.php"><span class="glyphicon glyphicon-home"></span></a>
		</div>
		<ul class="nav navbar-nav" style="display:inline">
		<?php 
				if ($_SESSION['role'] == 'prof') {
					echo('<li><a href="ta-list.php">View All Teaching Assistants</a></li>');
					echo('<li><a href="modify-classes.php">Add Classes</a></li>');
					echo('<li><a href="delete-classes.php">Remove Classes</a></li>');
				}
				else {
					echo('<li><a href="inputtime.php">Edit Availability</a></li>');
					echo('<li><a href="find-replacement.php">Find Replacements</a></li>');
				}
			?>
		</ul>
		<ul class="nav navbar-nav navbar-right" style= "display:inline">
			<li><a href="logout.php"><span class="glyphicon glyphicon-log-in"></span> Logout</a></li>
			<?php echo('<li><a href="userprofile.php"><span class="glyphicon glyphicon-user" ></span>'.$_SESSION['username'].'</a></li>'); ?>
			<!-- if time should i add modal? ...that when you click on username it display status ta or prof? -->
		</ul>
	</div>
</nav>