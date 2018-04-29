<!DOCTYPE html>
<html>
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1">
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.1.0/css/bootstrap.min.css">
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.0/umd/popper.min.js"></script>
  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.1.0/js/bootstrap.min.js"></script>
  <link rel="stylesheet" type="text/css" href="style.css">
<title>Login Page</title>
</head>
<body>

<?php 
session_start();
?>

<!-- HEADER STARTS -->
<div class="header">
    <div class="container-fluid">
        <div class="row">
            <div class="col"> <h1>Emazon</h1> </div>
            <div class="col">
            	<a href="search.php" class="btn btn-dark" role="button">Search</a>
            </div>
            <div class="col">
            	 <a href="index.php" class="btn btn-dark" role="button">Home</a>
            </div>
        </div>
    </div>
</div>
<!-- HEADER ENDS -->

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