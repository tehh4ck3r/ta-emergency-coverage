<?php include('new_user_serv.php') ?>
<!DOCTYPE html>
<html>
<head>
	<title>Sign Up</title>
	<link rel="stylesheet" type="text/css" href="login-style.css">
</head>


<form action="new_user_login.php" method = "post">
  <?php include('errors.php'); ?>

		<div class="input-group">
			<label>Username</label>
			<input type="text" name="username" value="<?php echo $username; ?>" required> 
		</div>
		<div class="input-group">
			<label>First Name</label>
			<input type="text" name="firstname" value="<?php echo $firstname; ?>" required>
		</div>
		<div class="input-group">
			<label>Last Name</label>
			<input type="text" name="lastname" value="<?php echo $lastname; ?>" required>
		</div>
		<div class="input-group">
			<label>Email</label>
			<input type="email" name="email" value="<?php echo $email; ?>"required> 
		</div>
		<div class="input-group">
			<label>Phone Number</label>
			<input type="tel" name="phone" value="<?php echo $phone; ?>" required>
		</div>
		<div class="input-group">
			<label>Password</label>
			<input type="password" name="password_1">
		</div>
		<div class="input-group">
			<label>Confirm password</label>
			<input type="password" name="password_2">
		</div>
			<div class="input-group">
			<label>Primary Notification</label>
			<Select name="notify">
      		<Option Value="phone"> Phone </Option>
     		<Option Value="email"> Email </Option></Select>
		</div>
			<div class="input-group">
			<label>User Type</label>
			<Select name="role">  
      		<Option Value="ta"> TA </Option>
      		<Option Value="prof"> Professor  </Option></Select>
		</div>
		<div class="input-group">
			<button type="submit" class="btn" name="reg_user">Register</button>
		</div>
		<p>
			Already a member? <a href="login.php">Sign in</a>
		</p>
  
</form> 

</body>
</html>
    