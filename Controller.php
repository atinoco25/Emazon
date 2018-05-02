<?php
include "DatabaseAdapter.php";
session_start();

unset($_SESSION['LoginFailed'] );
unset($_SESSION['RegisterFailed'] );

/*
 * Basic search
 */
if(isset($_GET['search'])){
    
    $arrayName = $theDBA->searchByString($_GET["search"]);
    
    if(isset($_GET['max_price']) && isset($_GET['min_price']))
        $arrayPrice = $theDBA->searchByPrice($_GET["min_price"], $_GET["max_price"]);
        
    if(isset($_GET['category'])){
        
        if($_GET['category'] === 'All')
            $arrayCate = $theDBA->searchByCategory("All");
        else
            $arrayCate = $theDBA->searchByCategory($_GET["category"]);
    }
    
    $array = array();
    
    //merge 3 arrys
    foreach($arrayName as $e){
        if(in_array($e, $arrayPrice) && in_array($e, $arrayCate))
            array_push($array, $e);
    }
        
    $toReturn ="<h2> Search Results: </h2><br><br>";
    
    for($i = 0; $i < count($array); $i++){
        $toReturn .= "<div class='product'>";
        $toReturn .= "<a href='product.php?product=".$array[$i]["name"]."' data-ajax='false'><h3>".$array[$i]["name"]."</h3></a> <p>-".$array[$i]["category"]."</p>";
        $toReturn .= "<p>".$array[$i]["description"]."</p>";
        $toReturn .= "Price: " . $array[$i]["price"] . "&nbsp&nbsp&nbsp" . 
                     "<button onclick='addToCart({$array[$i]["id"]})'>Add to Cart</button>&nbsp";
        $toReturn .= "<input type='number' id='{$array[$i]["id"]}' min='1' max='9' value='1' maxlength='1' size='2'>";
        $toReturn .= "</div><br>";
    }

    
    echo json_encode($toReturn);
}

/*
 * returns a product will all formatting
 */
if(isset($_GET["product"])){
    $arr = $theDBA->getProduct($_GET["product"]);
    
    $toReturn = "<h1>".$arr[0]["name"]."</h1>";
    $toReturn .= "<div style='float:right;'>".$arr[0]["description"] ."<br>";
    $toReturn .= "Price: " . $arr[0]["price"] . "&nbsp&nbsp&nbsp" .
        "<button onclick='addToCart({$arr[0]["id"]})'>Add to Cart</button>&nbsp";
    $toReturn .= "<input type='number' id='{$arr[0]["id"]}' min='1' max='9' value='1' maxlength='1' size='2'>";
    $toReturn .= "</div>";
    
    echo json_encode($toReturn);
}

/*
 * Get current user's cart
 */
if(isset($_GET['getCart']) && isset($_SESSION['user'])){
    
    $array = $theDBA->getCart($_SESSION['user']);
    
    if(empty($array)){
        $toReturn ="<h2> Cart: EMPTY </h2><br>";
    }else{
        $toReturn ="<h2> Cart: </h2><br><br>";
        for($i = 0; $i < count($array); $i++){
            
            $product = $theDBA->getProductById($array[$i]['product_id']);
            
            $toReturn .= "<div class='product'>";
            $toReturn .= "<h3>".$product[0]["name"]."</h3> <p>-".$product[0]["category"]."</p>";
            $toReturn .= "<p>".$product[0]["description"]."</p>";
            $toReturn .= "Price: " . $product[0]["price"] . "<br>";
            $toReturn .= "<p> Quantity: &nbsp {$array[$i]['quantity']} </p>";
            $toReturn .= "</div><br>";
        }
    }
    echo json_encode($toReturn);
}

/*
 * Add item to cart
 */
if(isset($_GET['addToCart']) && isset($_SESSION['user'])){
    $theDBA->addToCart($_SESSION['user'], $_GET['id'], $_GET['quantity']);
    header('Location: cart.php');
}

/*
 * Registering a new user
 */
else if(isset($_POST['newUsername']) && isset($_POST['newPassword'])){
    $isCorrect = $theDBA->addUser($_POST['newUsername'], $_POST['newPassword']);
    if($isCorrect == true){
        header("Location:index.php");
    }
    else{
        $_SESSION['RegisterFailed'] = "Username Already Exists";
        header("Location:register.php");
    }
}

/*
 * Logging in an user
 */
else if(isset($_POST['username']) && isset($_POST['password'])){
    $isCorrect = $theDBA->verifyCredentials($_POST['username'], $_POST["password"]);
    
    if($isCorrect == true){
        $_SESSION["user"] = $_POST['username'];
        header("Location:index.php");
    }
    else{
        $_SESSION['LoginFailed'] = "Invalid Credentials";
        header("Location:login.php");
    }
}
?>