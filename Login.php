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
            <div class="col" style="text-align:center;margin:auto;">
            	<form action="search.php" method="POST">
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
    <input type="text" class="form-control" placeholder="Enter username" id="username" name="username">
  	</div>
  	<div class="form-group">
    <label for="pwd">Password:</label>
    <input type="password" class="form-control" placeholder="Enter password" id="pwd" id="pwd">
 	</div>
  	<button type="submit" class="btn btn-primary" name="register" value="Registe">Submit</button>
	</form>

	<?php
	
	if( isset(  $_SESSION['loginFailed']))
	    echo   $_SESSION['loginFailed'];   
    
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