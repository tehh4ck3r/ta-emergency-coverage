<?php
session_start();

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

// variable declaration
$username = "";
$email    = "";
$errors = array(); 
$_SESSION['success'] = "";

// connect to database
// $db = mysqli_connect('localhost', 'root', '', 'registration'); //check how to add in c9

// REGISTER USER
if (isset($_POST['reg_user'])) {
	// receive all input values from the form
	$username = mysqli_real_escape_string($db, $_POST['username']);
	$firstname = mysqli_real_escape_string($db, $_POST['firstname']);
	$lastname = mysqli_real_escape_string($db, $_POST['lastname']);
	$email = mysqli_real_escape_string($db, $_POST['email']);
	$phone = mysqli_real_escape_string($db, $_POST['phone']);
	$password_1 = mysqli_real_escape_string($db, $_POST['password_1']);
	$password_2 = mysqli_real_escape_string($db, $_POST['password_2']);
	$notify = mysqli_real_escape_string($db, $_POST['notify']);
	$role = mysqli_real_escape_string($db, $_POST['role']);
	
	echo $_POST['role'];

	// form validation: ensure that the form is correctly filled
	if (empty($username)) { array_push($errors, "Username is required"); }
	if (empty($firstname)) { array_push($errors, "First name is required"); }
	if (empty($lastname)) { array_push($errors, "Last name is required"); }
	if (empty($email)) { array_push($errors, "Email is required"); }
	if (empty($phone)) { array_push($errors, "Phone Number is required"); }
	if (empty($password_1)) { array_push($errors, "Password is required"); }
	if (empty($role)) { array_push($errors, "User type is required"); }

	if ($password_1 != $password_2) {
		array_push($errors, "The two passwords do not match");
	}

	// register user if there are no errors in the form
	if (count($errors) == 0) {
		$password = md5($password_1);//encrypt the password before saving in the database
		$query = "INSERT INTO USERS (username, password, email, phone, notify, role, first, last) 
				  VALUES('$username', '$password', '$email', '$phone', '$notify', '$role', '$firstname', '$lastname')";
		mysqli_query($db, $query);

		$_SESSION['username'] = $username;
		$_SESSION['success'] = "You are now logged in";
		header('location: index.php');
	}

}

?>