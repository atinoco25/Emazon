<?php

class DatabaseAdaptor {
    
    private $DB;
    
    public function __construct(){
        $db = 'mysql:dbname=quotes;host=127.0.0.1;charset=utf8';
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
    
    //addUser
    
    //verifyUser
    
    
    
    
    
}

$db = new DatabaseAdaptor();


