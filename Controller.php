<?php
include "DatabaseAdapter.php";
session_start();

unset($_SESSION['LoginFailed'] );
unset($_SESSION['RegisterFailed'] );

/*
 * Basic search
 */
if(isset($_GET['search'])){
    $array = $theDBA->search($_GET["search"]);
    $toReturn ="<h2> Search Results: </h2><br><br>";
    
    for($i = 0; $i < count($array); $i++){
        $toReturn .= "<div class='product'>";
        $toReturn .= "<h3>".$array[$i]["name"]."</h3> <p>-".$array[$i]["category"]."</p>";
        $toReturn .= "<p>".$array[$i]["description"]."</p>";
        $toReturn .= "Price: " . $array[$i]["price"] . "&nbsp&nbsp&nbsp<button>Add to order</button>&nbsp";
        $toReturn .= "<input type='number' min='1' max='9' value='1' maxlength='1' size='2'>";
        $toReturn .= "</div><br>";
    }
    echo json_encode($toReturn);
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