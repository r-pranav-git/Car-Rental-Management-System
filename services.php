<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Car Rental Management System</title>
  
  <!-- External Stylesheets -->
  <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Poppins:200,300,400,500,600,700,800&display=swap">
  <link rel="stylesheet" href="css/open-iconic-bootstrap.min.css">
  <link rel="stylesheet" href="css/animate.css">
  <link rel="stylesheet" href="css/owl.carousel.min.css">
  <link rel="stylesheet" href="css/owl.theme.default.min.css">
  <link rel="stylesheet" href="css/magnific-popup.css">
  <link rel="stylesheet" href="css/aos.css">
  <link rel="stylesheet" href="css/ionicons.min.css">
  <link rel="stylesheet" href="css/bootstrap-datepicker.css">
  <link rel="stylesheet" href="css/jquery.timepicker.css">
  <link rel="stylesheet" href="css/flaticon.css">
  <link rel="stylesheet" href="css/icomoon.css">
  <link rel="stylesheet" href="css/style.css">

  <!-- Inline Styles -->
  <style>
    body {
      font-family: 'Poppins', Arial, sans-serif;
      background-color: #f9f9f9;
      color: #333;
      font-weight: 400;
    }
    .navbar-brand span {
      font-weight: 600;
    }
    .navbar-nav .nav-link {
      color: #fff;
      font-weight: 500;
      padding: 8px 15px;
    }
    .navbar-nav .nav-link:hover {
      background-color: rgba(255, 255, 255, 0.1);
      border-radius: 5px;
    }
    .hero-wrap {
      background-image: url('images/bg_3.jpg');
      background-size: cover;
      background-position: center center;
      position: relative;
      color: #fff;
      text-align: center;
      padding: 100px 0;
    }
    .hero-wrap .breadcrumbs {
      color: #fff;
      margin-bottom: 20px;
    }
    .hero-wrap .breadcrumbs a {
      color: #fff;
      text-decoration: none;
    }
    .hero-wrap .breadcrumbs .ion-ios-arrow-forward {
      margin: 0 10px;
    }
    .hero-wrap h1.bread {
      font-size: 40px;
      margin-bottom: 0;
    }
    .ftco-section {
      padding: 60px 0;
    }
    .services {
      background-color: #fff;
      padding: 30px;
      border-radius: 10px;
      box-shadow: 0px 0px 20px rgba(0, 0, 0, 0.1);
      text-align: center;
      margin-bottom: 30px;
    }
    .services .heading {
      font-size: 20px;
      font-weight: 600;
      color: #333;
    }
    .services p {
      color: #777;
      line-height: 1.6;
    }
    .ftco-intro {
      background-image: url(images/bg_3.jpg);
      background-size: cover;
      background-position: center center;
      position: relative;
      color: #fff;
      text-align: center;
      padding: 100px 0;
    }
    .ftco-intro h2 {
      font-size: 36px;
      font-weight: 600;
      margin-bottom: 30px;
    }
    .ftco-intro .btn-primary {
      background-color: #4CAF50;
      border-color: #4CAF50;
      font-size: 18px;
      padding: 12px 40px;
      font-weight: 500;
    }
    .ftco-footer {
      background-color: #333;
      color: #fff;
      padding: 50px 0;
    }
    .ftco-footer h2 {
      font-size: 24px;
      font-weight: 600;
      margin-bottom: 20px;
    }
    .ftco-footer p {
      color: #777;
    }
    .ftco-footer ul {
      list-style: none;
      padding: 0;
    }
    .ftco-footer ul li {
      margin-bottom: 10px;
    }
    .ftco-footer ul li a {
      color: #fff;
      text-decoration: none;
    }
    .ftco-footer ul li a:hover {
      color: #4CAF50;
    }
    .ftco-footer .block-23 ul {
      padding-left: 0;
      margin-top: 20px;
    }
    .ftco-footer .block-23 li {
      margin-bottom: 10px;
      display: flex;
      align-items: center;
    }
    .ftco-footer .block-23 li .icon {
      color: #4CAF50;
      margin-right: 10px;
    }
    .ftco-footer .block-23 li .text {
      color: #777;
    }
    .ftco-footer .block-23 li a {
      color: #777;
      text-decoration: none;
    }
    .ftco-footer .block-23 li a:hover {
      color: #4CAF50;
    }
    .copyright {
      background-color: #222;
      color: #fff;
      text-align: center;
      padding: 20px 0;
      font-size: 14px;
    }
  </style>
</head>
<body>
  
  <nav class="navbar navbar-expand-lg navbar-dark ftco_navbar bg-dark ftco-navbar-light" id="ftco-navbar">
    <div class="container">
      <a class="navbar-brand" href="index.php">Vehicle<span>Rental</span></a>
      <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#ftco-nav" aria-controls="ftco-nav" aria-expanded="false" aria-label="Toggle navigation">
        <span class="oi oi-menu"></span> Menu
      </button>

      <div class="collapse navbar-collapse" id="ftco-nav">
        <ul class="navbar-nav ml-auto">
          <li class="nav-item"><a href="index.php" class="nav-link">Home</a></li>
          <li class="nav-item"><a href="about.php" class="nav-link">About</a></li>
          <li class="nav-item active"><a href="services.php" class="nav-link">Services</a></li>
          <li class="nav-item"><a href="pricing.php" class="nav-link">Pricing</a></li>
          <li class="nav-item"><a href="car.php" class="nav-link">Cars</a></li>
          <li class="nav-item"><a href="blog.php" class="nav-link">Blog</a></li>
          <li class="nav-item"><a href="contact.php" class="nav-link">Contact</a></li>
          <li class="nav-item"><a href="login.php" class="nav-link">Login</a></li>
        </ul>
      </div>
    </div>
  </nav>
  <!-- END nav -->
  
  <section class="hero-wrap hero-wrap-2 js-fullheight" style="background-image: url('images/bg_3.jpg');" data-stellar-background-ratio="0.5">
    <div class="overlay"></div>
    <div class="container">
      <div class="row no-gutters slider-text js-fullheight align-items-end justify-content-start">
        <div class="col-md-9 ftco-animate pb-5">
          <p class="breadcrumbs"><span class="mr-2"><a href="index.php">Home <i class="ion-ios-arrow-forward"></i></a></span> <span>Services <i class="ion-ios-arrow-forward"></i></span></p>
          <h1 class="mb-3 bread">Our Services</h1>
        </div>
      </div>
    </div>
  </section>

  <section class="ftco-section">
    <div class="container">
      <div class="row justify-content-center mb-5">
        <div class="col-md-7 text-center heading-section ftco-animate">
          <span class="subheading">Services</span>
          <h2 class="mb-3">Our Latest Services</h2>
        </div>
      </div>
      <div class="row">
        <div class="col-md-3">
          <div class="services services-2 w-100 text-center">
            <div class="icon d-flex align-items-center justify-content-center"><span class="flaticon-route"></span></div>
            <div class="text w-100">
              <h3 class="heading mb-2">Wedding Ceremony</h3>
              <p>Make your special day unforgettable with our luxury car rentals tailored for weddings.</p>
            </div>
          </div>
        </div>
        <div class="col-md-3">
          <div class="services services-2 w-100 text-center">
            <div class="icon d-flex align-items-center justify-content-center"><span class="flaticon-route"></span></div>
            <div class="text w-100">
              <h3 class="heading mb-2">Corporate Events</h3>
              <p>Arrive in style and comfort at your next corporate event with our reliable car rental service.</p>
            </div>
          </div>
        </div>
        <div class="col-md-3">
          <div class="services services-2 w-100 text-center">
            <div class="icon d-flex align-items-center justify-content-center"><span class="flaticon-route"></span></div>
            <div class="text w-100">
              <h3 class="heading mb-2">Airport Transfer</h3>
              <p>Start and end your journey stress-free with our prompt and comfortable airport transfer services.</p>
            </div>
          </div>
        </div>
        <div class="col-md-3">
          <div class="services services-2 w-100 text-center">
            <div class="icon d-flex align-items-center justify-content-center"><span class="flaticon-route"></span></div>
            <div class="text w-100">
              <h3 class="heading mb-2">City Tour</h3>
              <p>Explore the city at your own pace with our affordable and flexible city tour car rentals.</p>
            </div>
          </div>
        </div>
      </div>
    </div>
  </section>

  <section class="ftco-intro" style="background-image: url(images/bg_3.jpg);">
    <div class="container">
      <div class="row justify-content-center">
        <div class="col-md-10 text-center">
          <h2 class="mb-3">Experience Comfort and Style</h2>
          <p class="mb-5">Discover a seamless travel experience with our premium car rental services. Book your ride today!</p>
          <p><a href="#" class="btn btn-primary px-4 py-3">Get Started</a></p>
        </div>
      </div>
    </div>
  </section>

  <footer class="ftco-footer ftco-section">
    <div class="container">
      <div class="row mb-5">
        <div class="col-md">
          <div class="ftco-footer-widget mb-4">
            <h2 class="ftco-heading-2 logo"><a href="#">Vehicle<span>Rental</span></a></h2>
            <p>Discover a seamless travel experience with our premium car rental services. Book your ride today!</p>
            <ul class="ftco-footer-social list-unstyled float-md-left float-lft mt-5">
              <li class="ftco-animate"><a href="#"><span class="icon-twitter"></span></a></li>
              <li class="ftco-animate"><a href="#"><span class="icon-facebook"></span></a></li>
              <li class="ftco-animate"><a href="#"><span class="icon-instagram"></span></a></li>
            </ul>
          </div>
        </div>
        <div class="col-md">
          <div class="ftco-footer-widget mb-4 ml-md-5">
            <h2 class="ftco-heading-2">Quick Links</h2>
            <ul class="list-unstyled">
              <li><a href="index.php" class="py-2 d-block">Home</a></li>
              <li><a href="about.php" class="py-2 d-block">About</a></li>
              <li><a href="services.php" class="py-2 d-block">Services</a></li>
              <li><a href="pricing.php" class="py-2 d-block">Pricing</a></li>
              <li><a href="car.php" class="py-2 d-block">Cars</a></li>
              <li><a href="blog.php" class="py-2 d-block">Blog</a></li>
              <li><a href="contact.php" class="py-2 d-block">Contact</a></li>
         <!--    <li><a href="#" class="py-2 d-block">Privacy</a></li>-->
            </ul>
          </div>
        </div>
        <div class="col-md">
          <div class="ftco-footer-widget mb-4">
            <h2 class="ftco-heading-2">Recent Blog</h2>
            <div class="block-21 mb-4 d-flex">
              <a class="blog-img mr-4" style="background-image: url(images/image_1.jpg);"></a>
              <div class="text">
                <h3 class="heading"><a href="#">Even the all-powerful Pointing has no control about</a></h3>
                <div class="meta">
                  <div><a href="#"><span class="icon-calendar"></span> July 12, 2023</a></div>
                  <div><a href="#"><span class="icon-person"></span> Admin</a></div>
                  <div><a href="#"><span class="icon-chat"></span> 19</a></div>
                </div>
              </div>
            </div>
            <div class="block-21 mb-4 d-flex">
              <a class="blog-img mr-4" style="background-image: url(images/image_2.jpg);"></a>
              <div class="text">
                <h3 class="heading"><a href="#">Even the all-powerful Pointing has no control about</a></h3>
                <div class="meta">
                  <div><a href="#"><span class="icon-calendar"></span> July 12, 2023</a></div>
                  <div><a href="#"><span class="icon-person"></span> Admin</a></div>
                  <div><a href="#"><span class="icon-chat"></span> 19</a></div>
                </div>
              </div>
            </div>
          </div>
        </div>
        <div class="col-md">
          <div class="ftco-footer-widget mb-4">
            <h2 class="ftco-heading-2">Office</h2>
            <div class="block-23 mb-3">
              <ul>
                <li><span class="icon icon-map-marker"></span><span class="text">203 Fake St. Mountain View, San Francisco, California, USA</span></li>
                <li><a href="#"><span class="icon icon-phone"></span><span class="text">+2 392 3929 210</span></a></li>
                <li><a href="#"><span class="icon icon-envelope"></span><span class="text"><span class="__cf_email__" data-cfemail="d7bab2bab799b0b8b8bfbabbb8a3bab6bebaf4b9b5b7">[email&#160;protected]</span></span></a></li>
              </ul>
            </div>
          </div>
        </div>
      </div>
      <div class="row">
        <div class="col-md-12 text-center">
          <p><!-- Link back to Colorlib can't be removed. Template is licensed under CC BY 3.0. -->
           </p>
        </div>
      </div>
    </div>
  </footer>

  <div class="bg-top">
    <div class="container">
      <div class="row justify-content-center">
        <div class="col-md-7">
          <p>&copy; <!-- Link back to Colorlib can't be removed. Template is licensed under CC BY 3.0. --> All rights reserved | This website is made with <i class="icon-heart" aria-hidden="true"></i> by <a href="https://colorlib.com" target="_blank">Colorlib</a></p>
        </div>
      </div>
    </div>
  </div>

  <script src="js/jquery.min.js"></script>
  <script src="js/jquery-migrate-3.0.1.min.js"></script>
  <script src="js/popper.min.js"></script>
  <script src="js/bootstrap.min.js"></script>
  <script src="js/jquery.easing.1.3.js"></script>
  <script src="js/jquery.waypoints.min.js"></script>
  <script src="js/jquery.stellar.min.js"></script>
  <script src="js/owl.carousel.min.js"></script>
  <script src="js/jquery.magnific-popup.min.js"></script>
  <script src="js/aos.js"></script>
  <script src="js/jquery.animateNumber.min.js"></script>
  <script src="js/bootstrap-datepicker.js"></script>
  <script src="js/jquery.timepicker.min.js"></script>
  <script src="js/scrollax.min.js"></script>
  <script src="js/main.js"></script>

</body>
</html>
