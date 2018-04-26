<!DOCTYPE html>
<html>
<head>
<meta charset="UTF-8">
<link rel="stylesheet" type="text/css" href="style.css" />
<title>Login Page</title>
</head>
<body>

<?php 
session_start();
?>

<h3>Login</h3>
<div class="form">
	<form action="controller.php" method="POST">
		<p> User ID: <input type="text" name="ID"></p>
		<p> Password: <input type="password" name="password"></p>
	<button type="submit" name="login" value="Login">Login</button><br><br>
	</form>

	<?php
	
	if( isset(  $_SESSION['loginFailed']))
	    echo   $_SESSION['loginFailed'];   
    
	?>
</div>

</body>
</html>