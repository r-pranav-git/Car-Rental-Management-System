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

    <section class="ftco-section ftco-cart">
        <div class="container">
            <div class="row">
                <div class="col-md-12 ftco-animate">
                    <div class="car-list">
                        <table class="table">
                            <thead class="thead-primary">
                                <tr class="text-center">
                                    <th>&nbsp;</th>
                                    <th>&nbsp;</th>
                                    <th class="bg-primary heading">Per Hour Rate</th>
                                    <th class="bg-dark heading">Per Day Rate</th>
                                    <th class="bg-black heading">Leasing</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php
                                // Check if there are results
                                if ($result->num_rows > 0) {
                                    // Output data for each row
                                    while($row = $result->fetch_assoc()) {
                                        echo '<tr class="">';
                                        echo '<td class="car-image"><div class="img" style="background-image:url(' . $row["image_url"] . ');"></div></td>';
                                        echo '<td class="product-name">';
                                        echo '<h3>' . $row["car_name"] . '</h3>';
                                        echo '<p class="mb-0 rated">';
                                        echo '<span>rated:</span>';
                                        echo '<span class="ion-ios-star"></span>';
                                        echo '<span class="ion-ios-star"></span>';
                                        echo '<span class="ion-ios-star"></span>';
                                        echo '<span class="ion-ios-star"></span>';
                                        echo '<span class="ion-ios-star"></span>';
                                        echo '</p>';
                                        echo '</td>';
                                        
                                        // Hourly Rate
                                        echo '<td class="price">';
                                        echo '<p class="btn-custom"><a href="book.php?carName=' . urlencode($row["car_name"]) . '&rateType=per%20hour">Rent a car</a></p>';
                                        echo '<div class="price-rate">';
                                        echo '<h3><span class="num"><small class="currency">$</small> ' . $row["price_per_hour"] . '</span><span class="per">/per hour</span></h3>';
                                        echo '</div>';
                                        echo '</td>';
                                        
                                        // Daily Rate
                                        echo '<td class="price">';
                                        echo '<p class="btn-custom"><a href="book.php?carName=' . urlencode($row["car_name"]) . '&rateType=per%20day">Rent a car</a></p>';
                                        echo '<div class="price-rate">';
                                        echo '<h3><span class="num"><small class="currency">$</small> ' . $row["price_per_day"] . '</span><span class="per">/per day</span></h3>';
                                        echo '</div>';
                                        echo '</td>';
                                        
                                        // Monthly Rate
                                        echo '<td class="price">';
                                        echo '<p class="btn-custom"><a href="book.php?carName=' . urlencode($row["car_name"]) . '&rateType=per%20month">Rent a car</a></p>';
                                        echo '<div class="price-rate">';
                                        echo '<h3><span class="num"><small class="currency">$</small> ' . $row["price_per_month"] . '</span><span class="per">/per month</span></h3>';
                                        echo '</div>';
                                        echo '</td>';
                                        echo '</tr>';
                                    }
                                } else {
                                    echo '<tr><td colspan="5" class="text-center">No cars available</td></tr>';
                                }
                                // Close the database connection
                                $conn->close();
                                ?>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </section>

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
