<?php
// define our cdn and other important files
include('header.php');
// include connection and navbar
include_once('../database/connection.php');
include "nav-login.php";
// session for order status if cancel or placed
if(isset($_SESSION['order-status'])){
  // if session order status placed
  if($_SESSION['order-status']=="placed"){
    echo "<script type='text/javascript'>toastr.success('Your order was successfully placed')</script>";
  }
  // if session order status cancel
  if($_SESSION['order-status']=="cancel"){
    echo "<script type='text/javascript'>toastr.info('Your order was succesfully cancelled')</script>";
  }
  unset($_SESSION['order-status']);//unset this session
}
?>

<?php
// Inner join two tables (cart and product) by its userID
$isExistOrder=false; //defining if already exists
$id = $_SESSION['id'];
$allTotal = 0;
$allItems = "";
$items = array();//initialize array to store products item
$sql = "SELECT * FROM cart ca
INNER JOIN product prod
ON ca.productID = prod.productID WHERE ca.userID=$id";
$result = $conn->query($sql);

// getting the details of the order
$order = mysqli_query($conn, "SELECT * FROM orders WHERE userID=$id");
$isExist  = mysqli_fetch_array($order);//fetch all data from orders
if (is_array($isExist)) {
  // storing all data in variable so that we can display it if the user asks for it
  $address=$isExist['address'];
  $name=$isExist['fullname'];
  $type=$isExist['paymentMode'];
  $products=$isExist['products'];
  $total=$isExist['total'];
  $phone=$isExist['number'];
  $tracenumber=$isExist['orderID'];
  $orderDate=$isExist['orderDate'];
  $isExistOrder=true;//set to true as its default is false
}

?>
<!-- calling our css file for styling  -->
<style>
  <?php include_once('../../src/css/cart.css'); ?>
  <?php include_once('../../src/css/popout.css'); ?>
</style>
<!-- link our js file for interaction -->
<script src="../../src/js/popout.js"></script>

<!-- displaying all user cart items by its quantity, total, product name and and also quantity can be set -->
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
            // displaying cart items from database
            while ($row = $result->fetch_assoc()) {
              $allTotal += $row['total']; //add all cart total and store it in alltotal variable
              $items[] = $row['productName'].'='.$row['quantity']; //storing all products that user added to cart and its quantity
          ?>
              <tr class="item-row pa">

                <td class="cart-item pa">
                  <table>
                    <tr>
                      <td><img src="<?= $row['productCover'] ?>" class="" style="width:80px" alt="" /></td>
                      <td>
                        <p class="item-name"><?= $row['productName'] ?></p>
                        <p class="small <?=$row['status']==1?'text-success':'text-info'?>"><?=$row['status']==1?'Order Placed':'Interested'?></p>
                        <p><a class="small text-danger <?=$isExistOrder && $row['status']==1?'d-none':'d-block'?>" href="../database/remove-item.php?cart=<?=$row['cartID'] ?>">Remove Item</a></p>
                      </td>
                    </tr>
                  </table>
                </td>

                <td class="cart-item-price">
                  <p>$<?= number_format($row['price'], 0) ?></p>
                </td>

                <td class="cart-item-quantity">
                  <!-- enable if not order otherwise disabled quantity input -->
                    <input type="number" class="span1 quantity" <?=$isExistOrder && $row['status']==1?'disabled':'enabled'?> value="<?= $row['quantity'] ?>" />
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
          $allItems = implode(", ", $items);//converting the array to return a strings
          ?>

        </table>
      </div>

    </div>
  </div>
</div>
<!-- end for displaying user cart items -->


<!-- button to show order details -->
<button style="width: 150px;right:0" data-toggle="modal" data-target="#orderDetails" class="float-right mr-4 ml-auto btn btn-info mb-4 fixed-bottom <?=$isExist?'d-block':'d-none'?>">Order Details</button>
<!-- show modal order details -->
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
        <!-- show order details that we store earlier above -->
      <p class="font-weight-bold">Products: <span class="small font-weight-bold"><?=$products?></span> </p>
      <p class="font-weight-bold">Fullname: <?=$name?></p>
        <p class="font-weight-bold">Address: <?=$address?></p>
        <p class="font-weight-bold">Phone Number: <?=$phone?></p>
        <p class="font-weight-bold">Payment Mode: <?=$type?></p>
        <p class="font-weight-bold">Date Order: <?=$orderDate?></p>
        <p class="font-weight-bold">Order Total: $<?=number_format($total)?></p>
      </div>
      <div class="modal-footer">
      <p class="font-weight-bold float-left mr-auto">Trace Code: <?=$tracenumber?></p>
        <!-- btton to cancel order form -->
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
  <!-- making form for our customers and ask them to fill it up so that they can order -->
  <form action="../database/buyProduct.php?cart=<?=$item?>" class="form" method="post">
  <div class="form-group">
    <label for="exampleInputEmail1">Fullname</label>
    <input type="text" name="fullname" required class="form-control fullname" aria-describedby="emailHelp" placeholder="Enter Full Name">
   </div>
   <div class="form-group">
    <label for="exampleInputEmail1">Phone Number</label>
    <input type="text" name="number" required class="form-control number"  aria-describedby="emailHelp" placeholder="Enter number">
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
    <!-- hide our products items and the total amount of the order items -->
   <input type="hidden" name="allProducts" value="<?=$allItems;?>">
   <input type="hidden" name="total" value="<?=$allTotal;?>">
   <!-- end hiding form -->
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
          <!-- button to checkout added cart items</> -->
        <button type="submit" name="buy"  class="btn  pull-right btn-primary buyBtn">Buy Now<i class=" ml-2 fa fa-caret-right"></i></button>
        </div>
     
    </div>
    </form>
  </div>
</div>
<!-- end for our order form-->


<script>
// prevent repeat form submission
  if (window.history.replaceState) {
    window.history.replaceState(null, null, window.location.href);
  }
  $(document).ready(function() {
    // toast configurations
    toastr.options = {
  "debug": false,
  "positionClass": "toast-top-full-width",
  "onclick": null,
  "fadeIn": 300,
  "fadeOut": 1000,
  "timeOut": 5000,
  "extendedTimeOut": 1000
}
// checkout button
    $(".buyBtn").click(function() {
      if($('.fullname').val()!="" || $('.address').val()!=""){
        toastr.info('You order has been Processed\nPlease Wait...')
      }
      
    });//end checkout button


    // cancel orders
    $(".cancel").click(function() {
      
        toastr.info('Cancelling order...\nPlease Wait...')
      
    });//end cancel

    // change product order quantity ajax
    $('.quantity').on("change", function() {
      var hide = $(this).closest('tr');//find the closest of this quantity class
      var id = hide.find(".cartId").val(); //get and store cartid
      var prodPrice = hide.find(".price").val();//get and store price
      var quantity = hide.find(".quantity").val();//get and store quantitty
      location.reload(true);
      $.ajax({
        // action to update quantity
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
      })
      location.reload(true);
    })
  })
</script>
                    
