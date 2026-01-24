<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Booking Confirmation</title>
    <link rel="stylesheet" href="css/bootstrap.min.css">
</head>
<body>
    <div class="container">
        <h2>Booking Confirmation</h2>
        <?php
        if (isset($_GET['car']) && isset($_GET['rental_type'])) {
            $car = htmlspecialchars($_GET['car']);
            $rentalType = htmlspecialchars($_GET['rental_type']);
            echo "<p>You have chosen to book a $car on a $rentalType basis.</p>";
        } else {
            echo "<p>Invalid booking request.</p>";
        }
        ?>
        <a href="car.html" class="btn btn-primary">Back to Cars</a>
    </div>
    <script src="js/jquery.min.js"></script>
    <script src="js/bootstrap.min.js"></script>
</body>
</html>
