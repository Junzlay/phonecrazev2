<?php
session_start();
// remove specified cart item
 require_once('../database/cart.php');
$cartid=$_GET['cart'];
// query to delete item from cart
$sql = "DELETE FROM cart WHERE cartID=$cartid";
$result=$cart->openConnection()->query($sql) ;
$item=$cart->getCartNumber($_SESSION['id']);
// redirect to cart with its new count
header('location:../html/cart.php?cart='.$item.'');
 
?>