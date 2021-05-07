<?php
// update quantity and total for cart table 
include "connection.php";
if(isset($_POST['prodQuantity'])){
    $quantity=$_POST['prodQuantity'];
    $cartId=$_POST['cartID'];
    $price=$_POST['price'];
  $total = (int)$quantity * intval($price);
  $sql="UPDATE cart SET quantity='$quantity',total='$total' WHERE cartID='$cartId'";
  if ($conn->query($sql) === TRUE) {
    echo "success";
  } else {
    session_start();
    $_SESSION['err']= $conn->error;
  }

}
    
    ?>
    
