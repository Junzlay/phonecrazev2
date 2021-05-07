<?php
session_start();
include "connection.php";
// checkout all product 
if(isset($_POST['buy'])){
  date_default_timezone_set('Asia/Manila');
  $today = date("F j, Y, g:i a");    
    $userID=$_SESSION['id'];
    $fullname=$_POST['fullname'];
    $type=$_POST['type'];
    $address=$_POST['address'];
    $total=$_POST['total'];
    $product=$_POST['allProducts'];
    $updateCart="UPDATE cart SET status=1 WHERE userID='$userID'";
    $conn->query($updateCart);
    $sql = "INSERT INTO orders(userID, fullname,address,total,paymentMode,products,orderDate) 
    VALUES ('$userID','$fullname','$address','$total','$type','$product','$today')";
    if ($conn->query($sql) === TRUE) {
     header('location:../html/cart.php?cart='.$_GET['cart'].'');
$_SESSION['order-status']="placed";
   
    } else {
     echo "Error: " . $sql . "<br>" . $conn->error;
    }
}
