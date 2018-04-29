<!DOCTYPE html>
<html lang="en">
<head>
<title>Emazon</title>
<meta charset="utf-8">
<meta name="viewport" content="width=device-width, initial-scale=1">
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.1.0/css/bootstrap.min.css">
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.0/umd/popper.min.js"></script>
  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.1.0/js/bootstrap.min.js"></script>
  <link rel="stylesheet" type="text/css" href="style.css">
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
            <?php 
            if(isset($_SESSION["user"])){
                echo '<a href="cart.php" class="btn btn-dark" role="button">Cart</a>';
                echo '&nbsp';
                echo '<a class="btn btn-dark" role="button">Logout</a>';
            }
            else{
                echo '<a href="login.php" class="btn btn-dark" role="button">Login</a>';
                echo '&nbsp';
                echo '<a href="register.php" class="btn btn-dark" role="button">Register</a>';
            }
            ?>
            </div>
        </div>
    </div>
</div>
<!-- HEADER ENDS -->
<br>
<br>
<div class="container-fluid">
    <div class="row">
        <div class="col-md-4"></div>
        <div class="col-md-8">
            
        <!-- CAROUSEL CODE STARTS-->
        <div id="demo" class="carousel slide" style="width:50%;" data-ride="carousel">
        
          <!-- Indicators -->
          <ul class="carousel-indicators">
            <li data-target="#demo" data-slide-to="0" class="active"></li>
            <li data-target="#demo" data-slide-to="1"></li>
            <li data-target="#demo" data-slide-to="2"></li>
          </ul>
        
          <!-- The slideshow -->
          <div class="carousel-inner">
            <div class="carousel-item active">
              <img src="img/dailySpecials.jpg" width="500px" height="300px">
              <div class="carousel-caption">
          		</div>
            </div>
            <div class="carousel-item">
              <img src="img/hammer.jpg" width="500px" height="300px" alt="Chicago">
              <div class="carousel-caption">
                  <h3>Hammer</h3>
                  <p>Get a hammer for only $6.99!</p>
              </div>
            </div>
            <div class="carousel-item">
              <img src="img/chipsSnacks.jpg" width="500px" height="300px">
              <div class="carousel-caption">
                  <h3>Chips!</h3>
                  <p>Get all these chips for only $6.99!</p>
              </div>
            </div>
          </div>
        
          <!-- Left and right controls -->
          <a class="carousel-control-prev" href="#demo" data-slide="prev">
            <span class="carousel-control-prev-icon"></span>
          </a>
          <a class="carousel-control-next" href="#demo" data-slide="next">
            <span class="carousel-control-next-icon"></span>
          </a>
        </div>
        <!-- CAROUSEL CODE ENDS -->
        </div>
    </div>
    
    <div class="row"></div>
</div>
</body>
</html>