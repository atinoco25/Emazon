<?php

class DatabaseAdaptor {
    
    /*
     *  LIST OF FUNCTIONS:
     * 
     *      searchByString($str)
     *      searchByPrice($min, $max)
     *      searchByCategory($category)
     *      getCart($username)
     *      addToCart($username, $product_id, $quantity)
     *      getOrder($username)
     *      checkout($username) //Calls removeCart()
     *      removeCart($username)
     *      getNewCart()
     *      addUser()
     *      verifyCredentials($userName, $psw)
     * 
     */
    
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
    public function searchByString($toSearch){
        $array = explode(" ", $toSearch);
        $prepareStatement = "select * from products where name like '%" . $array[0] . "%' or description like '%" . $array[0] . "%' ";
        for($i = 1; $i < count($array); $i++){
            $prepareStatement .= "or name like '%" . $array[$i] . "%' or description like '%" . $array[$i] . "%' ";
        }
        $stmt = $this->DB->prepare($prepareStatement);
        $stmt->execute();
        $arr = $stmt->fetchAll ( PDO::FETCH_ASSOC );
        
        return $arr;
    }
    //searchByPrice
    public function searchByPrice($min, $max){
        $prepareStatement = "select * from products where price >= $min AND price <= $max";
        $stmt = $this->DB->prepare($prepareStatement);
        $stmt->execute();
        $arr = $stmt->fetchAll ( PDO::FETCH_ASSOC );
        
        return $arr;
    }
    
    //getProductById
    public function getProductById($id){
        
        $prepareStatement = "select * from products where id = $id";
        $stmt = $this->DB->prepare($prepareStatement);
        $stmt->execute();
        $arr = $stmt->fetchAll ( PDO::FETCH_ASSOC );
        
        return $arr;
    }
    
    
    //searchByCatagory
    public function searchByCategory($category){
        if($category === 'All')
            $prepareStatement = "select * from products";
        else
            $prepareStatement = "select * from products where category like '$category'";
        
        $stmt = $this->DB->prepare($prepareStatement);
        $stmt->execute();
        $arr = $stmt->fetchAll ( PDO::FETCH_ASSOC );
        
        return $arr;
    }
    
    //getCart
    public function getCart($username){
        $prepareStatement1 = "select * from users where username like '$username'";
        $stmt = $this->DB->prepare($prepareStatement1);
        $stmt->execute();
        $arr = $stmt->fetchAll ( PDO::FETCH_ASSOC );
        
        $prepareStatement2 = "select * from carts where id = {$arr[0]['cart_id']}";
        $stmt = $this->DB->prepare($prepareStatement2);
        $stmt->execute();
        $cart = $stmt->fetchAll ( PDO::FETCH_ASSOC );
        
        return $cart;
    }
    
    public function addToCart($username, $product_id, $quan){
        $prepareStatement1 = "select * from users where username like '$username'";
        $stmt = $this->DB->prepare($prepareStatement1);
        $stmt->execute();
        $user = $stmt->fetchAll ( PDO::FETCH_ASSOC );
        
        $prepareStatement2 = "select * from products where id = $product_id";
        $stmt = $this->DB->prepare($prepareStatement2);
        $stmt->execute();
        $item = $stmt->fetchAll ( PDO::FETCH_ASSOC );
        
        $prepareStatement3 = "select * from carts where id = {$user[0]['cart_id']} AND "
                                              ."product_id = {$product_id}";
        $stmt = $this->DB->prepare($prepareStatement3);
        $stmt->execute();
        $exist = $stmt->fetchAll ( PDO::FETCH_ASSOC );
        
        if(empty($exist)){
            $prepareStatement4 = "insert into carts(                   id,        product_id, quantity)"
                                           ."values({$user[0]['cart_id']},  {$item[0]['id']},    $quan)";
            $stmt = $this->DB->prepare($prepareStatement4);
            $stmt->execute();
        }else{
            $totalQ = $exist[0]['quantity'] + $quan;
            $prepareStatement4 = "update carts set quantity = $totalQ " 
                                ."where id = {$user[0]['cart_id']} AND product_id = {$product_id}";
                $stmt = $this->DB->prepare($prepareStatement4);
                $stmt->execute();
        }
    }
    
    //remove item from cart
    public function removeFromCart($username, $product_id){
        $prepareStatement1 = "select * from users where username like '$username'";
        $stmt = $this->DB->prepare($prepareStatement1);
        $stmt->execute();
        $user = $stmt->fetchAll ( PDO::FETCH_ASSOC );
        
        $prepareStatement2 = "delete from carts where id = {$user[0]['cart_id']} AND product_id = $product_id";
        $stmt = $this->DB->prepare($prepareStatement2);
        $stmt->execute();
        
    }
    
    //getOrders
    public function getOrders($username){
        $prepareStatement1 = "select * from users where username like '$username'";
        $stmt = $this->DB->prepare($prepareStatement1);
        $stmt->execute();
        $arr = $stmt->fetchAll ( PDO::FETCH_ASSOC );
        
        $prepareStatement2 = "select * from orders where user_id = {$arr[0]['id']}";
        
        $stmt = $this->DB->prepare($prepareStatement2);
        $stmt->execute();
        $cart = $stmt->fetchAll ( PDO::FETCH_ASSOC );
        
        return $cart;
    }
    
    //checkout sends the cart to the list of all orders
    public function checkout($username){
        
        $prepareStatement1 = "select * from users where username like '$username'";
        $stmt = $this->DB->prepare($prepareStatement1);
        $stmt->execute();
        $arr = $stmt->fetchAll ( PDO::FETCH_ASSOC );
        
        $prepareStatement2 = "select * from carts where id = {$arr[0]['cart_id']}";
        $stmt = $this->DB->prepare($prepareStatement2);
        $stmt->execute();
        $cart = $stmt->fetchAll ( PDO::FETCH_ASSOC );
        
        foreach($cart as $item){
            
            $prepareStatement3 = "insert into orders(           id,           user_id,             product_id,            quantity,              date)"
                                            ."values({$item['id']},   {$arr[0]['id']},  {$item['product_id']}, {$item['quantity']}, CURRENT_TIMESTAMP)";
            $stmt = $this->DB->prepare($prepareStatement3);
            $stmt->execute();
            
        }
        
        $this->removeCart($username);
    }
    
    //give a new cart number to the user
    public function giveNewCart($username){
        
        $newCartID = $this->getNewCart();
        $prepareStatement = "update users set cart_id = $newCartID where username like '$username'";
        $stmt = $this->DB->prepare($prepareStatement);
        $stmt->execute();
        
    }
    
    //removeCart
    //Remove all item in users cart
    public function removeCart($username){
    
        $prepareStatement1 = "select * from users where username like '$username'";
        $stmt = $this->DB->prepare($prepareStatement1);
        $stmt->execute();
        $arr = $stmt->fetchAll ( PDO::FETCH_ASSOC );
        
        $prepareStatement2 = "delete from carts where id = {$arr[0]['cart_id']}";
        
        $stmt = $this->DB->prepare($prepareStatement2);
        $stmt->execute();
        
    }
    
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
    
    //get a single product with the given name
    public function getProduct($name){
        $stmt = $this->DB->prepare( 'SELECT * FROM products WHERE name="' . $name.'"');
        $stmt->execute ();
        $arr = $stmt->fetchAll ( PDO::FETCH_ASSOC );
        
        return $arr;
    }
    
    //get the total price of an order
    public function getOrderTotal($orderId){
        $stmt = $this->DB->prepare( 'SELECT * FROM orders WHERE id="' . $orderId.'"');
        $stmt->execute ();
        $arr = $stmt->fetchAll ( PDO::FETCH_ASSOC );
        
        $total = 0;
        for($i = 0; $i < count($arr); $i++){
            $product = $this->getProductById($arr[$i]["product_id"]);
            $total = $product[0]["price"] * $arr[$i]["quantity"] + $total;
        }
        
        return $total;
    }
    
    //get the total price of an order
    public function getCartTotal($user){
        $userId = $this->getCart($user);
        
        $stmt = $this->DB->prepare('SELECT * FROM carts WHERE id="' . $userId[0]["id"] . '"');
        $stmt->execute();
        $arr = $stmt->fetchAll(PDO::FETCH_ASSOC);
        
        $total = 0;
        for ($i = 0; $i < count($arr); $i ++) {
            $product = $this->getProductById($arr[$i]["product_id"]);
            $total = $product[0]["price"] * $arr[$i]["quantity"] + $total;
         }
        
        return $total;
    }
}

$theDBA = new DatabaseAdaptor();
?>