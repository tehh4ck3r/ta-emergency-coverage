<?php
	// Set up params for database connection
	$dsn = 'mysql:host=dbserver.engr.scu.edu;dbname=sdb_kmahajan';
	$uname = 'kmahajan';
	$pwd = '00001103126';

	try {
		$db_conn = new PDO($dsn, $uname, $pwd);
	} catch (PDOException $e) {
		echo 'DB Connection Error: ' . $e->getMessage();
	}
?>