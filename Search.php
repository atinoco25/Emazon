<!DOCTYPE html>
<html>
<head>
<meta charset="UTF-8">

<meta name="viewport" content="width=device-width, initial-scale=1">

	<link rel="stylesheet" href="https://code.jquery.com/mobile/1.4.5/jquery.mobile-1.4.5.min.css">
    <script src="https://code.jquery.com/jquery-1.11.3.min.js"></script>
    <script src="https://code.jquery.com/mobile/1.4.5/jquery.mobile-1.4.5.min.js"></script>

  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.1.0/css/bootstrap.min.css">
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.0/umd/popper.min.js"></script>
  
  <link rel="stylesheet" type="text/css" href="style.css">
<title>Search Page</title>
</head>
<body>
<script>

function gosearch(){

	var elementToChange = document.getElementById("toChange");
	var ajax = new XMLHttpRequest();
	var textToSearch = 
	<?php 
	if(!isset($_POST["toSearch"]))
	    echo json_encode("");
	else
	   echo json_encode($_POST["toSearch"]); ?>;
	var min = document.getElementById("price-min").value;
	var max = document.getElementById("price-max").value;
	var category = document.getElementById("category");
	var selected = category.options[category.selectedIndex].value
	
	ajax.open("GET", "Controller.php?search=" + textToSearch
							   + "&min_price=" + min
							   + "&max_price=" + max
							   +  "&category=" + selected
							   , true);

	ajax.send();
	ajax.onreadystatechange = function() {
		if (ajax.readyState == 4 && ajax.status == 200) {
			var products = JSON.parse(ajax.responseText);
			elementToChange.innerHTML = products;
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
	ajax.onreadystatechange = function() {
		if (ajax.readyState == 4 && ajax.status == 200) {
			var answer = JSON.parse(ajax.responseText);
			if(answer == true){
				alert("Added to cart!");
			}
			else{
				alert("You need to log in first!");
			}
		}
	}; // End anonymous function
}
</script>

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
            		<button type="submit" class="btn btn-dark" name="search" value="Search">New Search</button>
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
<div class="searchOptions">
    <div data-role="rangeslider">
        <label for="price-min">Price:</label>
        <input type="range" name="price-min" id="price-min" value="0" min="0" max="150">
        <label for="price-max">Price:</label>
        <input type="range" name="price-max" id="price-max" value="150" min="0" max="150">
    </div>
    <label for="category">Category</label>
    <select id="category">
      <option selected="selected">All</option>
      <option>Hardwares</option>
      <option>Tools</option>
      <option>Food</option>
      <option>Phone Accessories</option>
    </select>
    <div class="col" style="text-align:center;margin:auto;">
    	<a href="search.php" class="btn btn-dark" role="button" onclick="gosearch()">Update Search</a>
    </div>
</div>

<div id="toChange"></div>

<script >
gosearch();
gosearch();
</script>


<footer class="myFooter">
<p>Emazon @Copyright 2018 By Alexis Tinoco and Chun Wu</p>
</footer>

</body>
</html>