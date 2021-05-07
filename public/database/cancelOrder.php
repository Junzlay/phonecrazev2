<?php
session_start();
include "connection.php";
// cance order product 
    $userID=$_SESSION['id'];
    // query to update cart status back to 0 if cancelled
    $updateCart="UPDATE cart SET status=0 WHERE userID='$userID'";
    $conn->query($updateCart);//execute update cart
    // query to delete order product
    $sql = "DELETE FROM orders WHERE userID='$userID'";
    if ($conn->query($sql) === TRUE) {//executing
        // redirect to cart and session order status cancel
        $_SESSION['order-status']="cancel";
     header('location:../html/cart.php?cart='.$_GET['cart'].'');
    } else {
         // for debugging purposes
       echo "Error: " . $sql . "<br>" . $conn->error;
    }
?>