<?php
// let session start 
session_start();
include "connection.php";
// checkout all product of if we received post named buy
if(isset($_POST['buy'])){
  // setting default time
  date_default_timezone_set('Asia/Manila');
  // getting date todays
  $today = date("F j, Y, g:i a");    
    $userID=$_SESSION['id'];
    $fullname=$_POST['fullname'];
    $type=$_POST['type'];
    $address=$_POST['address'];
    $total=$_POST['total'];
    $product=$_POST['allProducts'];
    $phone=$_POST['number'];
    // update cart status
    $updateCart="UPDATE cart SET status=1 WHERE userID='$userID'";
    $conn->query($updateCart);
    // inserting all cart details and user input for order details -->
    $sql = "INSERT INTO orders(userID, fullname,address,total,paymentMode,products,orderDate,number) 
    VALUES ('$userID','$fullname','$address','$total','$type','$product','$today','$phone')";
    if ($conn->query($sql) === TRUE) {
      // if success redirect to cart and defining order status placed
     header('location:../html/cart.php?cart='.$_GET['cart'].'');
$_SESSION['order-status']="placed";
    } else {
      // for debugging purposes
     echo "Error: " . $sql . "<br>" . $conn->error;
    }
}
