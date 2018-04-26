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
    
    public function getUser($username){
        $stmt = $this->DB->prepare("SELECT * FROM users where username = \"$username\"");
        $stmt->execute ();
        return $stmt->fetchAll ( PDO::FETCH_ASSOC );
    }
    
    public function createUser($name, $pwd){
        $user = $this->getUser($name);
        if(count($user) != 0)
            $_SESSION['registerFailed'] = "Account name already exists";
        else{
            $hash = password_hash($pwd, PASSWORD_DEFAULT);
            $stmt = $this->DB->prepare("insert into users(username, hash) " .
                               "values(\"$name\", \"$hash\");");
            $stmt->execute ();
        }
    }
    
    public function verifyCredentials($name, $pwd){
        $user = $this->getUser($name);
        if(count($user) == 0)
            $_SESSION['loginFailed'] = "Error, username not found";
        else{
            if(password_verify($pwd, $user[0]['hash']))
                $_SESSION['loginSuccess'] = "Hi, " . $name; 
            else
                $_SESSION['loginFailed'] = "Error, incorrect password";
        }
            
    }
    
    public function getAllQuotes(){
        $stmt = $this->DB->prepare("SELECT * FROM quotations ORDER BY rating DESC");
        $stmt->execute ();
        return $stmt->fetchAll ( PDO::FETCH_ASSOC );
    }
    
    public function flag($id){
        $stmt = $this->DB->prepare("update quotations set flagged = 1 " .
        "where id = $id");  
        $stmt->execute ();
    }
    
    public function addQuote($quote, $author){
        $stmt =  $this->DB->prepare("insert into quotations(quote, author, rating, flagged) " .
                                    "values(\"$quote\", \"$author\", 0, 0);");      
        $stmt->execute ();
    }
    
    public function changeRating($id, $delta){
        $stmt = $this->DB->prepare("update quotations set rating = rating + $delta " .
                                   "where id = $id"); 
        $stmt->execute ();
    }
    
    public function unflagAll(){
        $stmt = $this->DB->prepare("update quotations set flagged = 0");
        $stmt->execute ();
    } 
}

$db = new DatabaseAdaptor();


