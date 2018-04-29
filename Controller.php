<?php
include "DatabaseAdapter.php";
session_start();

unset($_SESSION['LoginFailed'] );
unset($_SESSION['RegisterFailed'] );


if(isset($_POST['newUsername']) && isset($_POST['newPassword'])){
    $isCorrect = $theDBA->addUser($_POST['newUsername'], $_POST['newPassword']);
    if($isCorrect == true){
        header("Location:index.php");
    }
    else{
        $_SESSION['RegisterFailed'] = "Username Already Exists";
        header("Location:register.php");
    }
}

if(isset($_POST['username']) && isset($_POST['password'])){
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