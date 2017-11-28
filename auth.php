<?php
	/* auth.php: used to ensure users are logged in. 
	 * 
	 * Starts a PHP session, then checks if their username, (hashed) password,
	 * and role are set. If not, redirect them to the login page.
	 */
	session_start();
	if (!isset($_SESSION['username']) && !isset($_SESSION['password']) && !isset($_SESSION['role'])) {
		header('location: login.php');
	}
?>