<?php

class DatabaseAdaptor {
    
    private $DB;
    
    public function __construct() {
        $db = 'mysql:dbname=emazon;host=127.0.0.1;charset=utf8';
        $user = 'root';
        $password = '';
        
        try {
            $this->DB = new PDO ( $db, $user, $password );
            $this->DB->setAttribute ( PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION );
        } catch ( PDOException $e ) {
            echo ('Error establishing Connection');
            exit ();
        }
    }
    
    //searchByName
    
    //searchByPrice
    
    //searchByCatagory
    
    //getCart
    
    //getOrders
    
    //checkout
    
    //removeCart
    
    
    //New cart
    //Due to some problemsm, I decided to get the next cart number this way, instead of using max in sql
    public function getNewCart(){
        $stmt = $this->DB->prepare( "select * from users order by cart_id DESC");
        $stmt->execute();
        $arr = $stmt->fetchAll ( PDO::FETCH_ASSOC );
        return $arr[0]["cart_id"] + 1; 
    }
    
    //addUser- This function will add a username if the username is not in the database
    public function addUser($username, $password){
        $stmt = $this->DB->prepare( "SELECT * FROM users WHERE username = '" . $username ."'");
        $stmt->execute ();
        $arr = $stmt->fetchAll ( PDO::FETCH_ASSOC );
        
        if(count($arr) == 0){
            
            $hashPsw = password_hash($password, PASSWORD_DEFAULT);
            $cartId = $this->getNewCart();
            $stmt2 = $this->DB->prepare('insert into users(username, hash, cart_id) values ("'.$username .'", "'.$hashPsw.'", ' . $cartId .')');
            $stmt2->execute ();
            return true;
        }
        else{
            return false;
        }
    }
    
    //verifyUser-> this function will return true if he password matches the user, otherwise if not
    public function verifyCredentials($userName, $psw){
        $stmt = $this->DB->prepare( 'SELECT * FROM users WHERE username="' . $userName.'"');
        $stmt->execute ();
        $arr = $stmt->fetchAll ( PDO::FETCH_ASSOC );
        
        if(count($arr) > 0){
            if(password_verify($psw, $arr[0]["hash"]) == true){
                return true;
            }
        }
        return false;
    }
    
    
    
    
}

$theDBA = new DatabaseAdaptor();

