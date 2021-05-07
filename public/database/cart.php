<?php
require_once __DIR__ . '/store.php';
class Cart extends Store{
   
    
    function getCartNumber( $userID){
        $connection = $this->openConnection();
        $countRow = $connection->query('SELECT COUNT(userID) FROM cart WHERE userID = '.$userID.'')->fetchColumn(); 
       return $countRow;
    }//end getCartNumber functions
    
}
$cart=new Cart();
?>