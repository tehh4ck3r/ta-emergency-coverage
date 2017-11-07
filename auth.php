<?php
	session_start();
	if (!isset($_SESSION['username']) && !isset($_SESSION['password']) && !isset($_SESSION['role'])) {
		header('location: login.php');
	}
?>