<?php
	/* logout.php: logs a user out.
	 * 
	 * Unsets all session variables and then destroys the session.
	 */
	
	session_start();
	session_unset(); // unset all session variables
	session_destroy(); // destroy the session
	header('location: login.php'); // redirect to login page
?>