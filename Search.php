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
<title>Search Page</title>
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
            	<a href="search.php" class="btn btn-dark" role="button">Clear Search</a>
            </div>
            <div class="col" style="text-align:right;margin:auto;">
                <?php 
                if(isset($_SESSION["user"])){
                    echo '<a href="cart.php" class="btn btn-dark" role="button">Cart</a>';
                    echo '&nbsp';
                    echo '<a href="logout.php" class="btn btn-dark" role="button">Logout</a>';
                }
                else{
                    echo '<a href="login.php" class="btn btn-dark" role="button">Login</a>';
                    echo '&nbsp';
                    echo '<a href="register.php" class="btn btn-dark" role="button">Register</a>';
                }
                ?>	
            	<a href="index.php" class="btn btn-dark" role="button">Home</a>
            </div>
        </div>
    </div>
</div>
<!-- HEADER ENDS -->


<footer class="myFooter">
<p>Emazon @Copyright 2018 By Alexis Tinoco and Chun Wu</p>
</footer>
</body>
</html>