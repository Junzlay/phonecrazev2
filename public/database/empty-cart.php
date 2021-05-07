<?php
session_start();
// remove all cart items
include('connection.php');
$userid=$_SESSION['id'];
// query to delete all cart items for user cart
$sql = "DELETE FROM cart WHERE userID LIKE $userid";
if ($conn->query($sql) === TRUE) {
  // if succeed redirect to cart/
    header('location:../html/cart.php');
  } else {
    echo "Error deleting all item: " . $conn->error;
  }
?>