<?php
    require('dbconn.php');
    $servername = getenv('IP');
	$username = getenv('C9_USER');
	$password = "";
	$database = "c9";
	$dbport = 3306;
	
    $json = array();
    

    $query = "SELECT * FROM EVENTS ORDER BY id";
    $results = mysqli_query($db, $query, MYSQLI_USE_RESULT);
    
    $test = $results->fetch_all(MYSQLI_ASSOC);
    echo json_encode($test);
?>