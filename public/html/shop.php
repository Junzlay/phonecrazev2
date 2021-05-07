
<?php 
include('header.php');

require_once('../database/store.php');

if(!isset($_SERVER['HTTP_REFERER'])){
  header( 'HTTP/1.0 403 Forbidden', TRUE, 403 );
  die( header( 'location: ../../index.php' ) );
}else{
  $product = $store->getAllProducts();
}

?>
<?php include "nav-login.php";?>
<style>
<?php include_once('../../src/css/top-choice.css');?>
</style>


<div class="container ">
<h2 class="ml-4 font-weight-bold" style="color: #6C63FF;">New Release</h2>
</div>

<div class='o-c'>
  
  <div class='c-crds'>
  <?php 

function limitWords($text, $limit) {
  $word_arr = explode(" ", $text);

  if (count($word_arr) > $limit) {
      $words = implode(" ", array_slice($word_arr , 0, $limit) ) . ' ...';
      return $words;
  }
  return $text;
}

foreach($product as $item){
    ?>

    <div class='c-crd'>
      <a class='c-crd__wrap' href='view-product.php?id=<?php echo $item['productID']?>&page=2'>
        <div class='c-crd__img'>
          <img src="<?php echo $item['productCover'];?>">
        </div>
        <div class='c-crd__btm'>
          <h2><?php echo $item['productName'];?></h2>
        <?php echo limitWords($item['productDescription'],20);?>
        </div>
        <div class="float-bottom">
          <h3 class="float-right mr-4">$<?=number_format($item['productPrice'])?></h3>
        </div>
      </a>
    </div>
    <?php }

?>
  </div>
</div>



<h3 class="made_by">Made with ♡ by PN Group 4</h3>