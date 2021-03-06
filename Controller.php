<?php
include "DatabaseAdapter.php";
session_start();

unset($_SESSION['LoginFailed']);
unset($_SESSION['RegisterFailed']);

/*
 * Basic search
 */
if (isset($_GET['search'])) {
    
    $arrayName = $theDBA->searchByString($_GET["search"]);
    
    if (isset($_GET['max_price']) && isset($_GET['min_price']))
        $arrayPrice = $theDBA->searchByPrice($_GET["min_price"], $_GET["max_price"]);
    
    if (isset($_GET['category'])) {
        
        if ($_GET['category'] === 'All')
            $arrayCate = $theDBA->searchByCategory("All");
        else
            $arrayCate = $theDBA->searchByCategory($_GET["category"]);
    }
    
    $array = array();
    
    // merge 3 arrys
    foreach ($arrayName as $e) {
        if (in_array($e, $arrayPrice) && in_array($e, $arrayCate))
            array_push($array, $e);
    }
    
    $toReturn = "<h2> Search Results: </h2><br><br>";
    
    for ($i = 0; $i < count($array); $i ++) {
        $toReturn .= "<div class='product'>";
        $toReturn .= "<a href='product.php?product=" . $array[$i]["name"] . "' data-ajax='false'><h3>" . $array[$i]["name"] . "</h3></a> <p>-" . $array[$i]["category"] . "</p>";
        $toReturn .= "<p>" . $array[$i]["description"] . "</p>";
        $toReturn .= "Price: " . $array[$i]["price"] . "&nbsp&nbsp&nbsp" . "<button onclick='addToCart({$array[$i]["id"]})'>Add to Cart</button>&nbsp";
        $toReturn .= "<input type='number' id='{$array[$i]["id"]}' min='1' max='9' value='1' maxlength='1' size='2'>";
        $toReturn .= "</div><br>";
    }
    $toReturn .= "<br><br>";
    
    echo json_encode($toReturn);
}

/*
 * returns a product will all formatting
 */
if (isset($_GET["product"])) {
    $arr = $theDBA->getProduct($_GET["product"]);
    
    $toReturn = "<h1>" . $arr[0]["name"] . "</h1><br>";
    $toReturn .= "<img class='productImg' src='img/" . $_GET["product"] . ".jpg' alt='Product Image'>";
    $toReturn .= "<div style='float:right;'><b>" . $arr[0]["category"] . "</b><br><br><div class='description'>" . $arr[0]["description"] . "</div><br><br>";
    $toReturn .= "Price: " . $arr[0]["price"] . "<br>" . "<button onclick='addToCart({$arr[0]["id"]})'>Add to Cart</button>&nbsp";
    $toReturn .= "<input type='number' id='{$arr[0]["id"]}' min='1' max='9' value='1' maxlength='1' size='2'>";
    $toReturn .= "</div>";
    
    echo json_encode($toReturn);
}

/*
 *
 */
if (isset($_GET["userOrders"])) {
    $arr = $theDBA->getOrders($_SESSION['user']);
    
    $toReturn = "";
    
    if (count($arr) === 0)
        $toReturn = "<b>There are no orders from this user.</b>";
    
    $currentOrderId = 0;
    $i = 0;
    while ($i < count($arr)) {
        $currentOrderId = $arr[$i]["id"];
        $toReturn .= "<div><b>Order #: </b> " . $arr[$i]["id"] . "</div>";
        $toReturn .= "<div><b>Date: </b> " . $arr[$i]["date"] . "</div>";
        $orderTotal =  $theDBA->getOrderTotal($arr[$i]["id"]);
        
        $toReturn .= "<div><b>Products:</b><br>";
        while($i < count($arr) && $currentOrderId === $arr[$i]["id"]){
            $product = $theDBA->getProductById( $arr[$i]["product_id"]);
            $toReturn .= "&nbsp&nbsp&nbsp&nbsp<b>Name: </b> <a href='product.php?product=".$product[0]["name"]."' data-ajax='false'>" . $product[0]["name"]."</a>&nbsp&nbsp&nbsp".
                         "<b>Value: </b> ". $product[0]["price"] . "&nbsp&nbsp&nbsp".
                         "<b>Quantity: </b> " . $arr[$i]["quantity"] . "<br>";
            $i++;
        }
        $toReturn .= "</div>";
        $toReturn .= "---------------------<br>";
        $toReturn .= "<div><b>Total: </b>$" . $orderTotal. "</div><br>";
        $toReturn .= "<hr>";
    }
    
    echo json_encode($toReturn);
}

/*
 * Get current user's cart
 */
if (isset($_GET['getCart']) && isset($_SESSION['user'])) {
    
    $array = $theDBA->getCart($_SESSION['user']);
    
    if (empty($array)) {
        $toReturn = "<h2> Cart: EMPTY </h2><br>";
    } else {
        $toReturn = "<h2> Cart: </h2><br><br>";
        for ($i = 0; $i < count($array); $i ++) {
            
            $product = $theDBA->getProductById($array[$i]['product_id']);
            
            $toReturn .= "<div class='product'>";
            $toReturn .= "<h3><a href='product.php?product=".$product[0]["name"]."' data-ajax='false'>" . $product[0]["name"] . "</a></h3> <p>-" . 
                          $product[0]["category"] . "</p>";
            $toReturn .= "<p>" . $product[0]["description"] . "</p>";
            $toReturn .= "Price: " . $product[0]["price"] . "<br>";
            $toReturn .= "<p> Quantity: &nbsp {$array[$i]['quantity']} </p>&nbsp&nbsp&nbsp";
            $toReturn .= "<button onclick='removeItem({$product[0]["id"]})'>Remove</button>&nbsp";
            $toReturn .= "</div><br>";
        }
    }
    
    $cartTotal = $theDBA->getCartTotal($_SESSION['user']);
    $toReturn .= "<div class='cartTotal'><h3>Total:".$cartTotal . "<br><br><br></h3></div>";
    
    
    echo json_encode($toReturn);
}

/*
 * remove item
 */

if (isset($_GET['removeFromCart']) && isset($_SESSION['user'])) {
    
    $theDBA->removeFromCart($_SESSION['user'], $_GET['prod_id']);
}

/*
 * checkout
 */
if (isset($_GET['checkout']) && isset($_SESSION['user'])) {
    
    $theDBA->checkout($_SESSION['user']);
    $theDBA->giveNewCart($_SESSION['user']);
}

/*
 * Add item to cart
 */
if (isset($_GET['addToCart']) && isset($_SESSION['user'])) {
    $theDBA->addToCart($_SESSION['user'], $_GET['id'], $_GET['quantity']);
    
    echo json_encode(true);
}
else if(isset($_GET['addToCart'])){
    echo json_encode(false);
}
    
/*
 * Registering a new user
 */
else if (isset($_POST['newUsername']) && isset($_POST['newPassword'])) {
    $isCorrect = $theDBA->addUser($_POST['newUsername'], $_POST['newPassword']);
    if ($isCorrect == true) {
        header("Location:index.php");
    } else {
        $_SESSION['RegisterFailed'] = "Username Already Exists";
        header("Location:register.php");
    }
}
/*
 * Logging in an user
 */
else if (isset($_POST['username']) && isset($_POST['password'])) {
    $isCorrect = $theDBA->verifyCredentials($_POST['username'], $_POST["password"]);
    
    if ($isCorrect == true) {
        $_SESSION["user"] = $_POST['username'];
        header("Location:index.php");
    } else {
        $_SESSION['LoginFailed'] = "Invalid Credentials";
        header("Location:login.php");
    }
}
?>