<?php
session_start();

// Check if the user is logged in, if not redirect to the login page
if (!isset($_SESSION['loggedin']) || $_SESSION['loggedin'] !== true) {
    header("Location: login.php?error=login_required");
    exit;
}

// Include the database connection file
include 'database.php';

// Check if the required parameters are provided in the URL
if (!isset($_GET['carName']) || !isset($_GET['rateType'])) {
    die("Car details are missing! Ensure the URL contains 'carName' and 'rateType' parameters.");
}

// Retrieve and sanitize the parameters from the URL
$carName = isset($_GET['carName']) ? htmlspecialchars($_GET['carName']) : '';
$rateType = isset($_GET['rateType']) ? htmlspecialchars($_GET['rateType']) : '';

// Retrieve car details from the database using the car name
$sql = "SELECT car_id, car_name, price_per_hour, price_per_day, price_per_month FROM cars WHERE car_name = ?";
$stmt = $conn->prepare($sql);
$stmt->bind_param("s", $carName);
$stmt->execute();
$result = $stmt->get_result();

if ($result->num_rows === 0) {
    die("Car not found!");
}

$car = $result->fetch_assoc();
$car_id = $car['car_id'];
$pricePerHour = $car['price_per_hour'];
$pricePerDay = $car['price_per_day'];
$pricePerMonth = $car['price_per_month'];

// Retrieve the phone number of the logged-in user from the register table
$userId = $_SESSION['userid']; // Assuming userid is stored in the session
$sql = "SELECT phonenumber FROM register WHERE userid = ?";
$stmt = $conn->prepare($sql);
$stmt->bind_param("i", $userId);
$stmt->execute();
$result = $stmt->get_result();

if ($result->num_rows === 0) {
    die("User details not found!");
}

$user = $result->fetch_assoc();
$phoneNumber = $user['phonenumber']; // Get the user's phone number

// If form is submitted, process the booking
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Retrieve logged-in user details from the session
    $name = $_SESSION['username'];
    $email = $_SESSION['email']; // Assuming email is stored in the session
    $phone = isset($_POST['phone']) ? htmlspecialchars($_POST['phone']) : '';
    $pickupDate = isset($_POST['pickupDate']) ? htmlspecialchars($_POST['pickupDate']) : '';
    $dropoffDate = isset($_POST['dropoffDate']) ? htmlspecialchars($_POST['dropoffDate']) : '';

    // Validate email format
    if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
        die("Invalid email format.");
    }

    // Calculate the number of days between pickup and dropoff
    $pickup = new DateTime($pickupDate);
    $dropoff = new DateTime($dropoffDate);

    // Ensure the drop-off date is after the pick-up date
    if ($dropoff <= $pickup) {
        die("Drop-off date must be after the pick-up date.");
    }

    // Determine the rate per unit based on the selected rate type
    switch ($rateType) {
        case 'per hour':
            $ratePerUnit = $pricePerHour;
            break;
        case 'per day':
            $ratePerUnit = $pricePerDay;
            break;
        case 'per month':
            $ratePerUnit = $pricePerMonth;
            break;
        default:
            die("Invalid rate type selected.");
    }

    // Calculate the total number of units based on the rate type
    $interval = $pickup->diff($dropoff);
    if ($rateType == 'per hour') {
        $totalUnits = ($interval->days * 24) + $interval->h; // Convert days to hours
    } elseif ($rateType == 'per day') {
        $totalUnits = $interval->days;
    } else {
        $totalUnits = ceil($interval->days / 30); // Estimate the number of months
    }

    // Calculate the total payment
    $totalPayment = $totalUnits * $ratePerUnit;

    // Check if the car is already booked for the selected dates
    $sql = "SELECT * FROM bookings WHERE car_id = ? AND pickupDate <= ? AND dropoffDate >= ?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("iss", $car_id, $dropoffDate, $pickupDate);
    $stmt->execute();
    $result = $stmt->get_result();

    if ($result->num_rows > 0) {
        die("This car is already booked for the selected dates.");
    }

    // Insert booking details into the database
    $sql = "INSERT INTO bookings (car_id, rateType, name, email, phone, pickupDate, dropoffDate, totalPayment) VALUES (?, ?, ?, ?, ?, ?, ?, ?)";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("issssssd", $car_id, $rateType, $name, $email, $phone, $pickupDate, $dropoffDate, $totalPayment);
    $stmt->execute();

    // Assume the booking is successful
    $_SESSION['message'] = "Booking successful for $carName ($rateType). Total payment: $$totalPayment";
    header("Location: confirmation.php");
    exit();
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <title>Car Booking</title>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <link rel="stylesheet" href="css/bootstrap.min.css">
</head>
<body>
<nav class="navbar navbar-expand-lg navbar-light">
    <div class="container">
        <a class="navbar-brand" href="index.php">DRIVE<span> EASY</span></a>
    </div>
</nav>

<div class="container">
    <h2 class="mt-5">Book a Car</h2>
    <p>Car: <?php echo htmlspecialchars($carName); ?></p>

    <form method="POST" action="book.php?carName=<?php echo urlencode($carName); ?>&rateType=<?php echo urlencode($rateType); ?>">
        <div class="form-group">
            <label for="name">Name</label>
            <input type="text" class="form-control" id="name" name="name" value="<?php echo htmlspecialchars($_SESSION['username'] ?? ''); ?>" readonly>
        </div>
        <div class="form-group">
            <label for="email">Email</label>
            <input type="email" class="form-control" id="email" name="email" value="<?php echo htmlspecialchars($_SESSION['email'] ?? ''); ?>" readonly>
        </div>
        <div class="form-group">
            <label for="phone">Phone</label>
            <input type="text" class="form-control" id="phone" name="phone" value="<?php echo htmlspecialchars($phoneNumber ?? ''); ?>" required>
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

<script src="js/jquery.min.js"></script>
<script src="js/bootstrap.bundle.min.js"></script>
<script>
    document.getElementById('pickupDate').addEventListener('change', function() {
        validateDates();
    });
    document.getElementById('dropoffDate').addEventListener('change', function() {
        validateDates();
    });

    function validateDates() {
        const pickupDate = document.getElementById('pickupDate').value;
        const dropoffDate = document.getElementById('dropoffDate').value;
        const today = new Date();
        today.setHours(0, 0, 0, 0);  // Ignore the time portion of today's date

        if (new Date(pickupDate) < today) {
            alert('The pick-up date cannot be in the past.');
            document.getElementById('pickupDate').value = ''; // Clear the invalid date
        }

        if (dropoffDate && new Date(pickupDate) >= new Date(dropoffDate)) {
            alert('Drop-off date must be after the pick-up date.');
            document.getElementById('dropoffDate').value = ''; // Clear the invalid drop-off date
        }
    }
</script>
</body>
</html>
