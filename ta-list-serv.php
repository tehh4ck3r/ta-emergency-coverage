<!DOCTYPE html>
<html>
<head>
	<title>TA List</title>
	<link rel="stylesheet" type="text/css" href="login-style.css">
</head>

<?php
//JUST COPY AND PASTE FROM HERE 
    $servername = getenv('IP');
    $username = getenv('C9_USER');
    $password = "";
    $database = "c9";
    $dbport = 3306;

    // Create connection
    $db = new mysqli($servername, $username, $password, $database, $dbport);

    // Check connection
    if ($db->connect_error) {
        die("Connection failed: " . $db->connect_error);
    } 
    // echo "Connected successfully (".$db->host_info.")";
    //TO HERE 
    
    $query = "SELECT first, last from USERS where role = 'ta'";
    $results = mysqli_query($db, $query, MYSQLI_USE_RESULT);
    echo('<b><b>List of TAs <br/></b></b>');
    foreach ($results as $i) {
        echo($i['first'].' '. $i['last']);
        echo("<br/>");
    }
?>