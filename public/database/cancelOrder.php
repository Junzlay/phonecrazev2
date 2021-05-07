<?php
session_start();
include "connection.php";
// cance order product 
    $userID=$_SESSION['id'];
    $updateCart="UPDATE cart SET status=0 WHERE userID='$userID'";
    $conn->query($updateCart);
    $sql = "DELETE FROM orders WHERE userID='$userID'";
    if ($conn->query($sql) === TRUE) {
        $_SESSION['order-status']="cancel";
     header('location:../html/cart.php?cart='.$_GET['cart'].'');
    } else {
       echo "Error: " . $sql . "<br>" . $conn->error;
    }
?>