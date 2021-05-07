<?php
// define store so that we ca extends it peacefully
require_once __DIR__ . '/store.php';
class Cart extends Store{
   
    // count all user cart item
    function getCartNumber( $userID){
        $connection = $this->openConnection();
        $countRow = $connection->query('SELECT COUNT(userID) FROM cart WHERE userID = '.$userID.'')->fetchColumn(); 
       return $countRow;
    }//end getCartNumber functions
    
}
// instance variable cart
$cart=new Cart();
?>