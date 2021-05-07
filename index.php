
<!-- define header for our bootstrap cdn and other links -->
<?php include_once('public/html/header.php');?>
<?php
// if user login already logged in -->
if(isset($_SESSION['id'])){
  header('location:public/html/shop.php?page=1');
}
?>
<?php include "public/html/nav-login.php";
?>
<style>
<?php include_once('src/css/index-nav.css');?>
<?php include_once('src/css/footer.css');?>
</style>

<!-- header for landing page -->
  <section>
    <div class="container mt-4 ">
      <div class="row align-items-center">
        <div class="col-lg-6 order-lg-2">
          <div class="(p-5)">
            <img class="img-fluid img-header"
              src="src/img/intro_head.png" alt="">
          </div>
        </div>
        <div class="col-lg-6 order-lg-1 mt-4">
          <div class="header-display">
            <h2 class="display-4 title-header">Your dream phone is here</h2>
            <p class="lead text-justify">Get the latest OPPO unit that you once dream of here at PhoneCraze. We offer the best phones with quality at a pocket-friendly prize. Go and Get the phone that match your needs! </p>
            <button class="btn signinBtn" onclick="window.location.href='public/html/signup.php'">Get Started</button>
          </div>
        </div>
      </div>
    </div>
  </section>
<!-- end header -->


  <!-- <br><br><br><br><br> -->
  <br>
  <section2 class=" ">
    <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 1440 320">
      <path fill="#DDDBFB" fill-opacity="1"
        d="M0,288L80,256C160,224,320,160,480,149.3C640,139,800,181,960,208C1120,235,1280,245,1360,250.7L1440,256L1440,320L1360,320C1280,320,1120,320,960,320C800,320,640,320,480,320C320,320,160,320,80,320L0,320Z">
      </path>
    </svg>
    <div class="container-fluid intro2 text-dark" style="background-color: #DDDBFB;">
      <div class="container">
        <div class="row align-items-center">
          <div class="col-lg-6 order-lg-2">
            <div class="">
              <img class="img-fluid img-header" src="src/img/intro_second.png" alt="Intro Image">
            </div>
          </div>
          <div class="col-lg-6 order-lg-1">
            <div class="header-display">
              <h2 class="display-4 title-header text-dark">Just a click away</h2>
              <p class="lead text-dark text-justify">Experience a faster transactions. PhoneCraze typically replies in a minute with a very approachable and friendly staffs. So, have your dream oppo unit in less than a week after transactions being placed. You can also visit our physical store located at <u>Nasipit, Talamban Cebu City</u> and see for yourself the best that we have.    </p>
            </div>
          </div>
        </div>
      </div>
    </div>
    <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 1440 320">
      <path fill="#DDDBFB" fill-opacity="1"
        d="M0,96L120,85.3C240,75,480,53,720,64C960,75,1200,117,1320,138.7L1440,160L1440,0L1320,0C1200,0,960,0,720,0C480,0,240,0,120,0L0,0Z">
      </path>
    </svg>
  </section2>
<div class="container">
  <div class="row">
  <div class="col-sm-4">
    <div class="card">
      <div class="card-body mx-auto">
        <h2 class="text-center">Oppo A12</h2>
        <img src="https://fdn2.gsmarena.com/vv/pics/oppo/oppo-a12-1.jpg" alt="" class="img-fluid" width="200" height="200">
      </div>
    </div>
  </div>
  <div class="col-sm-4">
    <div class="card"> 
    <h2 class="text-center">Opp Reno</h2>
      <div class="card-body mx-auto">
      <img src="data:image/jpeg;base64,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" alt="" class="img-fluid" width="200" height="200">
      </div>
    </div>
  </div>

  <div class="col-sm-4">
    <div class="card">
    <h2 class="text-center">Oppo A35</h2>
      <div class="card-body mx-auto">
        
      <!-- <img src="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" alt="" class="img-fluid" width="200" height="200"> -->
      <img src="https://i0.wp.com/everytechever.com/wp-content/uploads/2021/04/oppo-a35.jpg?fit=1000%2C600&ssl=1" alt="" class="img-fluid">  
    </div>
    </div>
  </div>
</div>
</div>

  <br>
  <footer class="footer-distributed">
			<div class="footer-left">
				<!-- <h3>Company<span>logo</span></h3> -->
                <div class="row"> 
                  
                  <img src="logo.png" style="margin-left:30px"> 
                  
               </div>
    
				<p class="footer-company-name">PhoneCraze ©2021</p>
			</div>

			<div class="footer-center">

				<div>
					<i class="fa fa-map-marker"></i>
					<p style="color:black"><span>Nasipit Talamban</span> Cebu City,Philippines</p>
				</div>

				<div>
					<i class="fa fa-phone"></i>
					<p  style="color:black">+63985 452 4548</p>
				</div>

				<div>
					<i class="fa fa-envelope"></i>
					<p ><a href="greenplanthom:support@gmail.com">phonecraze@gmail.com</a></p>
				</div>

			</div>

			<div class="footer-right">

				<p class="footer-company-about ">
					<span>About the Store company</span>
					PhoneCraze is a company that caters the needs and demands of every mobile phone lovers in the country. We offer quality service and gorgeous variety of andorid  devices at a very negotiable price you've never imagined. 
				</p>

				<div class="footer-icons">

					<a href="#"><i class="fa fa-facebook"></i></a>
					<a href="https://publish.twitter.com/"><i class="fa fa-twitter"></i></a>
					<a href="https://ph.linkedin.com"><i class="fa fa-linkedin"></i></a>
					<a href="#"><i class="fa fa-github"></i></a>

                  

				</div>

			</div>
      <div class="made-with-love">
    Made with
    <i>♥</i> by
    <a target="_blank" href="https://codepen.io/Junzlay">PN Group 4</a>
</div>
		</footer>
 
  
</body>