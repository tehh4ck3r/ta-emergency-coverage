<?php
	require('dbconn.php');
	require('errors.php');
	session_start();

	$errors = array(); 

	// LOGIN USER
	if (isset($_POST['login_user'])) {
		$username = mysqli_real_escape_string($db, $_POST['username']);
		$password = mysqli_real_escape_string($db, $_POST['password']);
		
		if (empty($username)) {
			array_push($errors, "Username is required");
		}
		if (empty($password)) {
			array_push($errors, "Password is required");
		}

		if (count($errors) == 0) {
			$password = md5($password);
			$query = "SELECT ROLE FROM USERS WHERE username=? AND password=?";
			$stmt = $db->stmt_init();
			if (!$stmt->prepare($query)) {
				die("Faied to prepare statement: ".$query);
			} else {
				$stmt->bind_param('ss', $username, $password);
			}

			if(!$stmt->execute()) {
				die("Error in statement execution: ".$stmt->error);
			}
			
			$results = $stmt->get_result();

			if (mysqli_num_rows($results) == 1) {
				$_SESSION['username'] = $username;
				$_SESSION['password'] = $password;
				$row = mysqli_fetch_row($results);
				$_SESSION['role'] = $row[0];
				header('location: ta-list.php');
			} else {
				array_push($errors, "Wrong username/password combination");
			}
		}
	}
?>