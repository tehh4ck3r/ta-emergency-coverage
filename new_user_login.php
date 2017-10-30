<?php

?>
<!DOCTYPE html>
<html lang="en">
<head>
<title>First Sign up </title>
</head>
<body>

<form action="new_user_login.php" method = "post">
  SCU Username:<br>
  <input type="text" name="name">
  <br>
  Password:<br>
  <input type="text" name="pwd">
  <br>
  E-mail:<br>
  <input type="email" name="email">
  <br>
  Cell Number: <br>
  <input type="tel" name="phone">
  <br>
  Please Select Primary Contact Option:<br>
  <Select Notification Method="Notify Me">  
  <OPTION Value="phone"> phone 
  <OPTION Value="email"> email  
  </Select>
  <br>
  <input type="submit" value="Sign Up">
  
</form> 

</body>
</html>
    