<!DOCTYPE html>
<html>
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1">

<!--New style -->
	<link rel="stylesheet" href="https://code.jquery.com/mobile/1.4.5/jquery.mobile-1.4.5.min.css">
    <script src="https://code.jquery.com/jquery-1.11.3.min.js"></script>
    <script src="https://code.jquery.com/mobile/1.4.5/jquery.mobile-1.4.5.min.js"></script>
        
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
            <div class="col"> <a class="logo" href="index.php">Emazon</a> </div>
            <div class="col" style="text-align:center;margin:auto;">
            	<form action="search.php" method="POST" data-ajax="false">
            		<input type="text" name="toSearch" placeholder="Enter product">
            		<button type="submit" class="btn btn-dark" name="search" value="Search">Search</button>
            	</form>
            </div>
            <div class="col" style="text-align:right;margin:auto;">
            	 <a href="register.php" class="btn btn-dark" role="button">Register</a>
            	 <a href="index.php" class="btn btn-dark" role="button">Home</a>
            </div>
        </div>
    </div>
</div>
<!-- HEADER ENDS -->
<br>
<br>
<div class="container-fluid">
<div class="row">
<div class="col-sm-4"></div>
<div class="col-sm-4">
<div class="containerForm">
<h2>Login</h2>
<br>
<div class="form">
	<form action="controller.php" method="POST">
  	<div class="form-group">
    <label for="username">Username:</label>
    <input type="text" class="form-control" placeholder="Enter username" name="username" required>
  	</div>
  	<div class="form-group">
    <label for="pwd">Password:</label>
    <input type="password" class="form-control" placeholder="Enter password" name="password" required>
 	</div>
  	<button type="submit" class="btn btn-primary" name="login" value="Login">Login</button>
	</form>

	<?php
	
	if( isset(  $_SESSION['LoginFailed'])){
	    echo   $_SESSION['LoginFailed'];   
	    unset($_SESSION['LoginFailed']);
	}
    
	?>
</div>
</div>
</div>
</div>
</div>

<footer class="myFooter">
<p>Emazon @Copyright 2018 By Alexis Tinoco and Chun Wu</p>
</footer>
</body>
</html>