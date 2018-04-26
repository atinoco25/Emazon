<!DOCTYPE html>
<html>
<head>
<meta charset="UTF-8">
<link rel="stylesheet" type="text/css" href="style.css" />
<title>Register Page</title>
</head>
<body>

<?php 
session_start();
?>

<h3>Register</h3>
<div class="form">
	<form action="controller.php" method="POST">
		<p>User ID: <input type="text" name="ID"></p>
		<p>Password: <input type="password" name="password"></p>
	<button type="submit" name="register" value="Register">Register</button> <br> <br>
	</form>

	<?php
	
	if( isset(  $_SESSION['registerFailed']))
	    echo   $_SESSION['registerFailed'];   
    
	?>
</div>

</body>
</html>