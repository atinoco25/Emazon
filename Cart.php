<!DOCTYPE html>
<html>
<head>
<meta charset="UTF-8">
<meta charset="utf-8">
<meta name="viewport" content="width=device-width, initial-scale=1">

<!--New style -->
	<link rel="stylesheet" href="https://code.jquery.com/mobile/1.4.5/jquery.mobile-1.4.5.min.css">
    <script src="https://code.jquery.com/jquery-1.11.3.min.js"></script>
    <script src="https://code.jquery.com/mobile/1.4.5/jquery.mobile-1.4.5.min.js"></script>
    
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.1.0/css/bootstrap.min.css">
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.0/umd/popper.min.js"></script>
 
  <link rel="stylesheet" type="text/css" href="style.css">
  
  
<title>Cart</title>
</head>
<body>
<script>
function getCart(){
	var elementToChange = document.getElementById("toChange");
	var ajax = new XMLHttpRequest();
	ajax.open("GET", "Controller.php?getCart=True", true);
	ajax.send();
	ajax.onreadystatechange = function() {
		if (ajax.readyState == 4 && ajax.status == 200) {
			var products = JSON.parse(ajax.responseText);
			elementToChange.innerHTML = products;
		}
	}; // End anonymous function
}
function removeItem(prod_id){
	
	var ajax = new XMLHttpRequest();
	ajax.open("GET", "Controller.php?removeFromCart=True"
			   							+ "&prod_id=" + prod_id
 											, true);
	ajax.send();
	getCart();	
}
function checkout(){
	var ajax = new XMLHttpRequest();
	ajax.open("GET", "Controller.php?checkout=True", true);
	ajax.send();
	getCart();	
}
</script>



<?php 
include "DatabaseAdapter.php";
session_start();
?>

<!-- HEADER STARTS -->
<div class="header">
    <div class="container-fluid">
        <div class="row">
            <div class="col" ><a class="logo" href="index.php">Emazon</a> </div>
            <div class="col" style="text-align:center;margin:auto;">
            	<form action="search.php" method="POST" data-ajax="false">
            		<input type="text" name="toSearch" placeholder="Enter product">
            		<button type="submit" class="btn btn-dark" name="search" value="Search">Search</button>
            	</form>
            </div>
            <div class="col" style="text-align:right;margin:auto;">
            <?php 
                if(isset($_SESSION['user']) && !empty($theDBA->getCart($_SESSION['user'])))
                   echo '<a href="payment.php" class="btn btn-dark" role="button" onclick="checkout()">Checkout</a>';
            ?>
           	 	
            	<a href="index.php" class="btn btn-dark" role="button">Home</a>
            </div>
        </div>
    </div>
</div>
<!-- HEADER ENDS -->

<div id="toChange"></div>

<script >
getCart();
getCart();
</script>

<footer class="myFooter">
<p>Emazon @Copyright 2018 By Alexis Tinoco and Chun Wu</p>
</footer>


</body>
</html>