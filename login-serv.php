<?php
	/* login-serv.php: handles the server-side portion of logging in.
	 * 
	 * Takes user input for username and password and verifies that 
	 * the information matches what is in the database. 
	 */

	require('dbconn.php');
	session_start();

	$errors = array(); 

	// if we recieved the right POST request
	if (isset($_POST['login_user'])) {
		// recieve all input values from the form
		$username = mysqli_real_escape_string($db, $_POST['username']);
		$password = mysqli_real_escape_string($db, $_POST['password']);
		
		// form validation: ensure that the form is correctly filled
		if (empty($username)) { array_push($errors, "Username is required"); }
		if (empty($password)) { array_push($errors, "Password is required"); }

		// begin logging in if there are no errors
		if (count($errors) == 0) {
			$password = md5($password); // hash the password for security 
			
			$query = "SELECT ROLE FROM USERS WHERE username=? AND password=?"; // using prepared statements
			
			$stmt = $db->stmt_init();

			// die if the statement wasn't successfully prepared
			if (!$stmt->prepare($query)) {
				die("Faied to prepare statement: ".$query);
			} else {
				$stmt->bind_param('ss', $username, $password); // bind the input parameters to the query
			}

			// if the statement did not execute successfully, die and print the error
			if(!$stmt->execute()) {
				die("Error in statement execution: ".$stmt->error);
			}
			
			// get the results
			$results = $stmt->get_result();

			// if we have just 1 result (i.e. successful login)
			if (mysqli_num_rows($results) == 1) {
				$_SESSION['username'] = $username; // set the username in the session
				$_SESSION['password'] = $password; // set the password in the session
				
				$row = mysqli_fetch_row($results); // set the role in the session
				$_SESSION['role'] = $row[0];

				header('location: calendar.php'); // redirect to calendar
			} else {
				array_push($errors, "Wrong username/password combination");
			}
		}
	}
?>