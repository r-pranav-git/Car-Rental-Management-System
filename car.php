<?php
// Include the database connection
include 'database.php';

// Fetch car details from the database
$sql = "SELECT car_id, car_name, brand, price_per_hour, price_per_day, price_per_month, image_url FROM cars";
$result = $conn->query($sql);
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <title>Car Rental Management System</title>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    
    <!-- Stylesheets -->
    <link href="https://fonts.googleapis.com/css?family=Poppins:200,300,400,500,600,700,800&display=swap" rel="stylesheet">
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
</head>
<body>
    <nav class="navbar navbar-expand-lg navbar-dark ftco_navbar bg-dark ftco-navbar-light" id="ftco-navbar">
        <div class="container">
            <a class="navbar-brand" href="index.phpl">Vehicle<span>Rental</span></a>
            <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#ftco-nav" aria-controls="ftco-nav" aria-expanded="false" aria-label="Toggle navigation">
                <span class="oi oi-menu"></span> Menu
            </button>

            <div class="collapse navbar-collapse" id="ftco-nav">
                <ul class="navbar-nav ml-auto">
                    <li class="nav-item"><a href="index.phpl" class="nav-link">Home</a></li>
                    <li class="nav-item"><a href="about.phpl" class="nav-link">About</a></li>
                    <li class="nav-item"><a href="services.phpl" class="nav-link">Services</a></li>
                    <li class="nav-item active"><a href="pricing.php" class="nav-link">Pricing</a></li>
                    <li class="nav-item"><a href="car.phpl" class="nav-link">Cars</a></li>
                    <li class="nav-item"><a href="blog.phpl" class="nav-link">Blog</a></li>
                    <li class="nav-item"><a href="contact.phpl" class="nav-link">Contact</a></li>
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
                    <p class="breadcrumbs"><span class="mr-2"><a href="index.html">Home <i class="ion-ios-arrow-forward"></i></a></span> <span>Pricing <i class="ion-ios-arrow-forward"></i></span></p>
                    <h1 class="mb-3 bread">Pricing</h1>
                </div>
            </div>
        </div>
    </section>
    <!-- Main Content Section -->
<div class="container">
    <h1>Available Cars</h1>
    <div class="row">
        <?php
        if ($result->num_rows > 0) {
            // Output data for each car
            while ($row = $result->fetch_assoc()) {
                echo '<div class="col-md-4">';
                echo '  <div class="car-wrap rounded">';
                echo '    <div class="img rounded d-flex align-items-end" style="background-image: url(' . $row["image_url"] . ');">';
                echo '    </div>';
                echo '    <div class="text">';
                echo '      <h2 class="mb-0"><a href="car_details.php?car_id=' . $row["car_id"] . '">' . $row["car_name"] . '</a></h2>';
                echo '      <span class="brand">' . $row["brand"] . '</span>';
                echo '      <div class="d-flex mb-3">';
                echo '        <p class="price ml-auto">₹' . $row["price_per_hour"] . ' <span>/hour</span></p>';
                echo '        <p class="price ml-auto">₹' . $row["price_per_day"] . ' <span>/day</span></p>';
                echo '        <p class="price ml-auto">₹' . $row["price_per_month"] . ' <span>/month</span></p>';
                echo '      </div>';
                echo '      <p class="d-flex mb-0 d-block"><a href="book.php?car_id=' . $row["car_id"] . '" class="btn btn-primary py-2 mr-1">Book now</a> <a href="car_details.php?car_id=' . $row["car_id"] . '" class="btn btn-secondary py-2 ml-1">Details</a></p>';
                echo '    </div>';
                echo '  </div>';
                echo '</div>';
            }
        } else {
            echo "<p>No cars available at the moment.</p>";
        }
        ?>
    </div>
</div>
    

    <footer class="ftco-footer ftco-bg-dark ftco-section">
        <div class="container">
            <div class="col-md-12 text-center">
                <p>&copy; <script>document.write(new Date().getFullYear());</script> All rights reserved | This template is made with <i class="ion-ios-heart" aria-hidden="true"></i> by <a href="https://colorlib.com" target="_blank">Colorlib.com</a></p>
            </div>
        </div>
    </footer>

    <!-- JavaScript files -->
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

