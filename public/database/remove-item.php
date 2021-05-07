<?php
session_start();
// remove specified item
 require_once('../database/cart.php');
$cartid=$_GET['cart'];
$sql = "DELETE FROM cart WHERE cartID=$cartid";
$result=$cart->openConnection()->query($sql) ;
$item=$cart->getCartNumber($_SESSION['id']);
    header('location:../html/cart.php?cart='.$item.'');
 
?>