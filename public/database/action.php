<?php
// update quantity and total for cart table 
include "connection.php";
// is we get reiquest post product quantity
if(isset($_POST['prodQuantity'])){
    $quantity=$_POST['prodQuantity'];
    $cartId=$_POST['cartID'];
    $price=$_POST['price'];
    // multiply qunatity by its total
  $total = (int)$quantity * intval($price);
  $sql="UPDATE cart SET quantity='$quantity',total='$total' WHERE cartID='$cartId'";
  if ($conn->query($sql) === TRUE) {
    // if success 
    echo "success";
  } else {
     // for debugging purposes
   echo $conn->error;
  }

}
    //endif for change qunatity
    ?>
    
