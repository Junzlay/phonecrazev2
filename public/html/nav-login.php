<?php 
// starting session
session_start();
// if user already login
if(isset($_SESSION['id'])){
  // getting cart count of user
  require_once('../database/cart.php');
  $item=$cart->getCartNumber($_SESSION['id']);
}
?>
<!-- css include -->
<style>
  <?php include_once('../../src/css/index-nav.css'); ?>
  <?php include_once('../../src/css/nav-header.css'); ?>
</style>
<nav class="navbar navbar-expand-lg navbar-light bg-transparent" id="nav">
  <h3 class="p-4"><a class="text-secondary font-weight-bold brand" href="#">PhoneCraze</a></h3>
  <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarNavAltMarkup" aria-controls="navbarNavAltMarkup" aria-expanded="false" aria-label="Toggle navigation">
    <span class="navbar-toggler-icon"></span>
  </button>
  <div class="collapse navbar-collapse" id="navbarNavAltMarkup">
    <div class="navbar-nav ml-auto p-4">

      <a class="nav-item nav-link  ml-4 home " href="<?php echo (isset($_GET['page']) == 1) ? '../../index.php"' : '#' ?>" <?php echo (isset($_SESSION['status']) == 1) ? 'style="display:none;"' : '' ?>>Home </a>
    
      <a class="nav-item nav-link top ml-4" href="<?=(isset($_GET['page']) == 2 || isset($_GET['cart']) )?'shop.php?page=1':'public/html/shop.php?page=1'?>" <?php echo (isset($_SESSION['status']) == 1) && (isset($_GET['page'])==1) ? 'style="color:#00F;"' : 'gray' ?>>Shop</a>

      <a href="cart.php<?=$item>0?'?cart='.$item.'':''?>" id="cart" class="nav-item nav-link top ml-4" <?php echo (isset($_SESSION['status']) == 0) ? 'style="display:none;"' : '' ?> <?php echo (isset($_GET['cart']))  ? 'style="color:#00F;"' : 'gray' ?>><i class="fa fa-shopping-cart"></i> Cart <span class="badge"><?=$item?></span></a>
      <div class="dropdown accountNav" <?php echo (isset($_SESSION['status']) == 0) ? 'style="display:none;"' : '' ?>>
        <button class="btn btn- dropdown-toggle " type="button" id="dropdownMenu2" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
          <img src="https://thumbs.dreamstime.com/b/vector-icon-user-avatar-web-site-mobile-app-man-face-flat-style-social-network-profile-45836554.jpg" class="avatar rounded-circle" style="width: 35px;" alt="Avatar"><span class="text-secondary"><?php echo $_SESSION["name"]; ?></span> 
        </button>
        <div class="dropdown-menu" aria-labelledby="dropdownMenu2" style="z-index: 1;">
          <div class="account-info-header border-bottom">
            <p class="my-0 pl-3 pb-2 text-secondary"><small>Account ID: <?php echo $_SESSION['id']; ?></small></p>
          </div>
          <a href="user-account.html" class="dropdown-item "><i class="fa fa-user-o m-2"></i> Account</a></a>
          <a href="../database/logout.php" class="dropdown-item text-danger "><i class="fa fa-sign-out m-2"></i> Logout</a></a>
        </div>
      </div>
      <a href="<?php echo (isset($_GET['page']) ==1) ? 'login.php"' : 'public/html/login.php' ?>" class="" <?php echo (isset($_SESSION['status']) == 1) ? 'style="display:none;"' : '' ?>><button class="btn ml-4 loginBtn">Login</button></a>
    </div>

  </div>
</nav>