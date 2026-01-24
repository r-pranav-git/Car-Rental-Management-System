<?php
// Start the session
session_start();

// Include the database connection file
require_once 'database.php';

// Check if the user is logged in
if (!isset($_SESSION['loggedin']) || $_SESSION['loggedin'] !== true) {
    // If not logged in, redirect to the login page
    header("Location: login.php");
    exit();
}

// Check if the car details are provided in the URL
if (!isset($_GET['carName'])) {
    die("Car details are missing!");
}

// Retrieve the car details from the URL
$carName = $_GET['carName'];

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <title>Book a Car</title>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    
    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="css/bootstrap.min.css">
    <!-- Your custom CSS -->
    <style>
        /* Custom styles here */
        .form-container {
            margin-top: 100px; /* Adjust this value as needed */
        }
    </style>
</head>
<body>
    <!-- Navigation Bar -->
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
                    <li class="nav-item"><a href="services.php" class="nav-link">Services</a></li>
                    <li class="nav-item"><a href="pricing.php" class="nav-link">Pricing</a></li>
                    <li class="nav-item active"><a href="car.php" class="nav-link">Cars</a></li>
                    <li class="nav-item"><a href="blog.php" class="nav-link">Blog</a></li>
                    <li class="nav-item"><a href="contact.php" class="nav-link">Contact</a></li>
                    <li class="nav-item"><a href="login.php" class="nav-link">Login</a></li>
                </ul>
            </div>
        </div>
    </nav>
    <!-- END nav -->
    
    <!-- Hero Section -->
    <section class="hero-wrap hero-wrap-2 js-fullheight" style="background-image: url('images/bg_3.jpg');" data-stellar-background-ratio="0.5">
        <div class="container form-container">
            <div class="row justify-content-center">
                <div class="col-lg-8 ftco-animate">
                    <div class="text-center">
                        <h1 class="mb-4">Book a Car</h1>
                    </div>
                    <form action="process_booking.php" method="POST">
                        <div class="form-group">
                            <label for="car">Car</label>
                            <input type="text" id="car" name="carName" class="form-control" value="<?php echo htmlspecialchars($carName); ?>" readonly>
                        </div>
                        <!-- <div class="form-group">
                            <label for="rental-type">Choose Rental Type</label>
                            <select id="rental-type" name="rateType" class="form-control" required>
                                <option value="standard">Standard</option>
                                <option value="premium">Premium</option>
                            </select>
                        </div> -->
                        <div class="form-group">
                            <label for="name">Name</label>
                            <input type="text" class="form-control" id="name" name="name" required>
                        </div>
                        <div class="form-group">
                            <label for="email">Email</label>
                            <input type="email" class="form-control" id="email" name="email" required>
                        </div>
                        <div class="form-group">
                            <label for="phone">Phone</label>
                            <input type="tel" class="form-control" id="phone" name="phone" required>
                        </div>
                        <div class="form-group">
                            <label for="pickupDate">Pick-up Date</label>
                            <input type="date" class="form-control" id="pickupDate" name="pickupDate" required>
                        </div>
                        <div class="form-group">
                            <label for="dropoffDate">Drop-off Date</label>
                            <input type="date" class="form-control" id="dropoffDate" name="dropoffDate" required>
                        </div>
                        <button type="submit" class="btn btn-primary">Book Now</button>
                    </form>
                </div>
            </div>
        </div>
    </section>
    
    <!-- jQuery and Bootstrap JS -->
    <script src="js/jquery.min.js"></script>
    <script src="js/bootstrap.min.js"></script>
</body>
</html>
