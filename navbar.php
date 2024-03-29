<!-- 
	/* navbar.php: the navigation bar that is displayed once logging in. 
	 * 
	 * Contains links to the various web pages in the system. Links differ
	 * if you are a professor or a TA.
	 */
-->
<nav class="navbar navbar-inverse">
	<div class="container-fluid" style="width:100%">
		
		<!-- Navbar header -->
		<div class="navbar-header">
			<!-- Home page icon -->
			<a class="navbar-brand" href="calendar.php"><span class="glyphicon glyphicon-home"></span></a>
		</div>

		<!-- Navbar body -->
		<ul class="nav navbar-nav" style="display:inline">
		<?php
				// if user is a professor, show the professor-only links; else, show TA links
				if ($_SESSION['role'] == 'prof') {
					echo('<li><a href="ta-list.php">View All Teaching Assistants</a></li>');
					echo('<li><a href="modify-classes.php">Add Classes</a></li>');
					echo('<li><a href="delete-classes.php">Remove Classes</a></li>');
				} else {
					echo('<li><a href="inputtime.php">Edit Availability</a></li>');
					echo('<li><a href="find-replacement.php">Find Replacements</a></li>');
				}
			?>
		</ul>

		<!-- Navbar right -->
		<ul class="nav navbar-nav navbar-right" style= "display:inline">
			<!-- Display user icon next to username -->
			<?php echo('<li><a href="userprofile.php"><span class="glyphicon glyphicon-user" ></span> '.$_SESSION['username'].'</a></li>'); ?>
			
			<!-- Logout button -->
			<li><a href="logout.php"><span class="glyphicon glyphicon-log-in"></span> Logout</a></li>
		</ul>
	</div>
</nav>