<?php
	/* dbconn.php: used to connect to the MySQL database.
	 * 
	 * Uses PHP's mysqli interface to establish a database connection 
	 * to a MySQL database.
	 */
	
	/* C9 Database */
	$servername = getenv('IP');
	$username = getenv('C9_USER');
	$password = "";
	$database = "c9";
	$dbport = 3306;

	// Create connection
	$db = new mysqli($servername, $username, $password, $database, $dbport);
	
	/* EDC Database
	$servername = "dbserver.engr.scu.edu";
	$username = "kmahajan";
	$password = "00001103126";
	$database = "sdb_kmahajan";

	// Create connection
	$db = new mysqli($servername, $username, $password, $database); */
	
	// Check connection
	if ($db->connect_error) {
		die("Connection failed: " . $db->connect_error);
	}
	// echo "Connected successfully (".$db->host_info.")";
?>