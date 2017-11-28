<?php
	/* register-serv.php: handles the server-side portion of registering users.
	 * 
	 * Takes user input for username, first and last name, email, phone, password, 
	 * primary notification method, and role and stores it in the database. 
	 */

	require('dbconn.php');

	$errors = array(); 

	// if we recieved the right POST request
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

		// form validation: ensure that the form is correctly filled
		if (empty($username)) { array_push($errors, "Username is required"); }
		if (empty($firstname)) { array_push($errors, "First name is required"); }
		if (empty($lastname)) { array_push($errors, "Last name is required"); }
		if (empty($email)) { array_push($errors, "Email is required"); }
		if (empty($phone)) { array_push($errors, "Phone Number is required"); }
		if (empty($password_1)) { array_push($errors, "Password is required"); }
		if (empty($role)) { array_push($errors, "User type is required"); }

		if ($password_1 != $password_2) { array_push($errors, "The two passwords do not match"); }

		// register user if there are no errors in the form
		if (count($errors) == 0) {
			$password = md5($password_1);	//encrypt the password before saving in the database

			$query = "INSERT INTO USERS (username, password, email, phone, notify, role, first, last) 
					  VALUES(?, ?, ?, ?, ?, ?, ?, ?)"; // using prepared statements

			$stmt = $db->stmt_init();

			// die if the statement wasn't successfully prepared
			if (!$stmt->prepare($query)) {
				die("Faied to prepare statement: ".$query);
			} else {
				$stmt->bind_param('sssissss', $username, $password, $email, $phone, $notify, $role, $firstname, $lastname); // bind the input parameters to the query
			} 

			// if the statement did not execute successfully, die and print the error
			if(!$stmt->execute()) {
				die("Error in statement execution: ".$stmt->error);
			}	

			$stmt->close();

			// redirect to login page
			header('location: login.php');
		}
	}
?>