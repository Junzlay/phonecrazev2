<?php
session_start();
// remove all cart items
include('connection.php');
$userid=$_SESSION['id'];
$sql = "DELETE FROM cart WHERE userID LIKE $userid";
if ($conn->query($sql) === TRUE) {
    header('location:../html/cart.php');
  } else {
    echo "Error deleting all item: " . $conn->error;
  }
?>