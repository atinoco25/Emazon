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
<title><?php echo $_GET["product"];?></title>
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
            	  <?php 
            if(isset($_SESSION["user"])){
                echo '<a href="cart.php" class="btn btn-dark" role="button" data-ajax="false">Cart</a>';
                echo '&nbsp';
                echo '<a href="logout.php" class="btn btn-dark" role="button" data-ajax="false">Logout</a>';
            }
            else{
                echo '<a href="login.php" class="btn btn-dark" role="button" data-ajax="false">Login</a>';
                echo '&nbsp';
                echo '<a href="register.php" class="btn btn-dark" role="button" data-ajax="false">Register</a>';
            }
            ?>
            	 <a href="index.php" class="btn btn-dark" role="button">Home</a>
            </div>
        </div>
    </div>
</div>
<!-- HEADER ENDS -->
<br>
<br>
<!-- Product Code Starts -->
<div class="container-fluid">
<div class="row">
<div class="col-sm-3"></div>
<div class="col-sm-6">
<div class="containerForm" style="height: 300px;">
	<div id="toChange"></div>
</div></div></div></div>
<!-- Product code ends -->
<footer class="myFooter">
<p>Emazon @Copyright 2018 By Alexis Tinoco and Chun Wu</p>
</footer>
</body>
<script>
function drawProduct(){
	var elementToChange = document.getElementById("toChange");
	var ajax = new XMLHttpRequest();
	var product = <?php echo json_encode($_GET["product"]);?>;
	
	ajax.open("GET", "Controller.php?product=" + product, true);

	ajax.send();
	ajax.onreadystatechange = function() {
		if (ajax.readyState == 4 && ajax.status == 200) {
			var product = JSON.parse(ajax.responseText);
			elementToChange.innerHTML = product;
		}
	}; // End anonymous function
}

function addToCart(itemID){
	var ajax = new XMLHttpRequest();
	var quan = document.getElementById(itemID).value;
	ajax.open("GET", "Controller.php?addToCart=True"
							   + "&id=" 	  + itemID
							   + "&quantity=" + quan
							   , true);

	ajax.send();
}
drawProduct();
</script>
</html>