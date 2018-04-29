<!DOCTYPE html>
<html>
<head>
<meta charset="UTF-8">
<meta charset="utf-8">
<meta name="viewport" content="width=device-width, initial-scale=1">
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.1.0/css/bootstrap.min.css">
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.0/umd/popper.min.js"></script>
  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.1.0/js/bootstrap.min.js"></script>
  <link rel="stylesheet" type="text/css" href="style.css">
<title>Register Page</title>
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
            <div class="col" style="text-align:center;">
            	<a href="search.php" class="btn btn-dark" role="button">Search</a>
            </div>
            <div class="col" style="text-align:right;">
            	 <a href="index.php" class="btn btn-dark" role="button">Home</a>
            	 <a href="login.php" class="btn btn-dark" role="button">Login</a>
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
<h2>Register</h2>
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
	
	if( isset(  $_SESSION['registerFailed']))
	    echo   $_SESSION['registerFailed']; 
    
	?>
</div>
</div>
</div>
</div>
</div>

</body>
</html>