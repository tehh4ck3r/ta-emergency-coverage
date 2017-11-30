<?php
	/* dbconn.php: used to connect to the MySQL database.
	 * 
	 * Uses PHP's mysqli interface to establish a database connection 
	 * to a MySQL database.
	 */
	
	/* EDC Database */
	$servername = "dbserver.engr.scu.edu";
	$username = "YOUR_USERNAME";
	$password = "YOUR_PASSWORD";
	$database = "YOUR_DATABASE_NAME";

	// Create connection
	$db = new mysqli($servername, $username, $password, $database);
	
	// Check connection
	if ($db->connect_error) {
		die("Connection failed: " . $db->connect_error);
	}
?>