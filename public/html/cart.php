<?php
include('header.php');
include_once('../database/connection.php');
include "nav-login.php";

if(isset($_SESSION['order-status'])){
  if($_SESSION['order-status']=="placed"){
    echo "<script type='text/javascript'>toastr.success('Your order was successfully placed')</script>";
  }
  if($_SESSION['order-status']=="cancel"){
    echo "<script type='text/javascript'>toastr.warning('Your order was succesfully cancelled')</script>";
  }
  unset($_SESSION['order-status']);
}
?>

<?php
// Inner join two tables (cart and product)
$isExistOrder=false;
$id = $_SESSION['id'];
$allTotal = 0;
$allItems = "";
$items = array();
$sql = "SELECT * FROM cart ca
INNER JOIN product prod
ON ca.productID = prod.productID WHERE ca.userID=$id";
$result = $conn->query($sql);

// getting the details of the order
$order = mysqli_query($conn, "SELECT * FROM orders WHERE userID=$id");
$isExist  = mysqli_fetch_array($order);
if (is_array($isExist)) {
  $address=$isExist['address'];
  $name=$isExist['fullname'];
  $type=$isExist['paymentMode'];
  $products=$isExist['products'];
  $total=$isExist['total'];
  $orderDate=$isExist['orderDate'];
  $isExistOrder=true;
}

?>

<style>
  <?php include_once('../../src/css/cart.css'); ?>
  <?php include_once('../../src/css/popout.css'); ?>
</style>

<script src="../../src/js/popout.js"></script>


<div class="container">
  <div class="block">

    <div class="span12">

      <div class="wrapper-no-padding shopping-cart">
        <div class="container-fluid ">
        <h5 class="slab-font  <?= isset($_GET['cart']) > 0 ? 'float-left' : 'text-center'; ?> ">You Have <?= isset($_GET['cart']) > 0 ? $_GET['cart'] : '0'; ?> items In Your Cart</h5>
        <img src="../../src/img/empty.png" alt="" class="img-fluid mt-4 w-50 mx-auto  <?= isset($_GET['cart']) > 0 ? 'd-none' : 'd-block'; ?> " >
          <a class="btn btn-danger btn-sm mt-3 float-right <?=(isset($_GET['cart']) > 0 && !$isExistOrder)?'d-block':'d-none'?>" href="../database/empty-cart.php">Empty Cart</a>
        </div>
        <table class="cart-table">

          <tr class="heading heading-font" <?= isset($_GET['cart']) == '0' ? 'style="display:none;"' : ''; ?>>
            <th class="cart-item pl">Cart Items</th>
            <th class="cart-item-price">Price</th>
            <th class="cart-item-quantity">Quantity</th>
            <th class="cart-item-total pr">Total</th>
          </tr>
          <?php
          if ($result->num_rows > 0) {
            while ($row = $result->fetch_assoc()) {
              $allTotal += $row['total'];
              $items[] = $row['productName'].'='.$row['quantity'];
          ?>
              <tr class="item-row pa">

                <td class="cart-item pa">
                  <table>

                    <tr>
                      <td><img src="<?= $row['productCover'] ?>" class="" style="width:80px" alt="" /></td>
                      <td>
                        <p class="item-name"><?= $row['productName'] ?></p>
                        <p class="small <?=$row['status']==1?'text-success':'text-info'?>"><?=$row['status']==1?'Order Placed':'Interested'?></p>
                        <p><a class="small text-danger <?=$isExistOrder?'d-none':'d-block'?>" href="../database/remove-item.php?cart=<?= $row['cartID'] ?>">Remove Item</a></p>
                      </td>
                    </tr>
                  </table>
                </td>

                <td class="cart-item-price">
                  <p>$<?= number_format($row['price'], 0) ?></p>
                </td>

                <td class="cart-item-quantity">
                    <input type="number" class="span1 quantity" <?=$isExistOrder?'disabled':'enabled'?> value="<?= $row['quantity'] ?>" />
                    <input type="hidden" class="cartId" name="cartID" value="<?= $row['cartID'] ?>">
                    <input type="hidden" class="price" name="price" value="<?= $row['price'] ?>">
               
                </td>

                <td class="cart-item-total slab-font pr">
                  <p>$<?= number_format($row['total'], 0) ?></p>
                </td>
              </tr>
          <?php
            }
          }
          $allItems = implode(", ", $items);
          ?>

        </table>
      </div>

    </div>
  </div>
</div>

<button style="width: 150px;right:0" data-toggle="modal" data-target="#orderDetails" class="float-right mr-4 ml-auto btn btn-info mb-4 fixed-bottom <?=$isExist?'d-block':'d-none'?>">Order Details</button>
<!-- show order details -->
<div class="modal fade" id="orderDetails" tabindex="-1" role="dialog" aria-labelledby="orderDetailsLabel" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel"> Order Details</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
      <p class="font-weight-bold">Products: <span class="small font-weight-bold"><?=$products?></span> </p>
      <p class="font-weight-bold">Fullname: <?=$name?></p>
        <p class="font-weight-bold">Address: <?=$address?></p>
        <p class="font-weight-bold">Payment Mode: <?=$type?></p>
        <p class="font-weight-bold">Date Order: <?=$orderDate?></p>
        <p class="font-weight-bold">Order Total: $<?=number_format($total)?></p>
      </div>
      <div class="modal-footer">
        <a type="button" href="../database/cancelOrder.php?cart=<?=$item?>" class="btn btn-danger cancel" >Cancel Order</a>
        <button type="button" data-dismiss="modal" class="btn btn-primary">Ok</button>
      </div>
    </div>
  </div>
</div>
<!-- end order details -->

<!-- order button -->
<div class="popout" <?= isset($_GET['cart']) == '0'? 'style="display:none;"' : ''; ?>>
<div class="<?=$isExist?'d-none':'btn'?>   text-center">
    Checkout
  </div>
  <div class="panel container bg-light p-4">
  <p><span class="font-weight-bold">Products:</span>  <?=$allItems?></p>
  <hr>
  <form action="../database/buyProduct.php?cart=<?=$item?>" class="form" method="post">
  <div class="form-group">
    <label for="exampleInputEmail1">Fullname</label>
    <input type="text" name="fullname" required class="form-control fullname" aria-describedby="emailHelp" placeholder="Enter Full Name">
   </div>
  <div class="form-group">
    <label for="exampleInputEmail1">Address</label>
    <input type="text" name="address" required class="form-control address"  aria-describedby="emailHelp" placeholder="Enter address">
    </div>
  <div class="form-group">
    <label for="exampleInputEmail1">Payment Type</label>
    <select name="type" id="" class="form-control">
      <option value="COD">Cash on Delivery</option>
    </select>
    </div>
   <input type="hidden" name="allProducts" value="<?=$allItems;?>">
   <input type="hidden" name="total" value="<?=$allTotal;?>">
    <div class="wrapper-no-padding">
      <table class="cart-table">

        <tr>
          <td class="key">Shipping</td>
          <td class="value text-dark">Calculate</td>
        </tr>
        <tr class="total">
          <td class="key">Order Total</td>
          <td class="value slab-font">$<?= number_format($allTotal) ?></td>
        </tr>
      </table>
       </div>
    <div class="panel-body ">
     
        <div class="clearfix pa buyBtn">
        <button type="submit" name="buy"  class="btn  pull-right btn-primary buyBtn">Buy Now<i class=" ml-2 fa fa-caret-right"></i></button>
        </div>
     
    </div>
    </form>
  </div>
</div>
<!-- end order button -->


<script>
  if (window.history.replaceState) {
    window.history.replaceState(null, null, window.location.href);
  }
  $(document).ready(function() {
    toastr.options = {
  "debug": false,
  "positionClass": "toast-top-full-width",
  "onclick": null,
  "fadeIn": 300,
  "fadeOut": 1000,
  "timeOut": 5000,
  "extendedTimeOut": 1000
}
    $(".buyBtn").click(function() {
      if($('.fullname').val()!="" || $('.address').val()!=""){
        toastr.info('You order has been Processed\nPlease Wait...')
      }
      
    });
    $(".cancel").click(function() {
      
        toastr.info('Cancelling order...\nPlease Wait...')
    
      
    });

    // change product order quantity ajax
    $('.quantity').on("change", function() {
      var hide = $(this).closest('tr');
      var id = hide.find(".cartId").val();
      var prodPrice = hide.find(".price").val();
      var quantity = hide.find(".quantity").val();
      location.reload(true);
      $.ajax({
        url: "../database/action.php",
        method: "POST",
        cache: false,
        data: {
          prodQuantity: quantity,
          cartID: id,
          price: prodPrice
        },
        success:function(response) {
          console.log(response);
        }
      }),
      location.reload(true);
    })
  })
</script>
                    