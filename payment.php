<?php
session_start(); // Start the session
include 'database.php'; // Include your database connection

// Check if the user is logged in
if (!isset($_SESSION['userid'])) {
    // Redirect to login page if not logged in
    header("Location: login.php");
    exit();
}

// Now you can use the session variables
$userid = $_SESSION['userid']; // This variable is not used directly in the SQL anymore
$username = $_SESSION['username']; // Retrieve username from session
$error = ""; // Initialize error variable

// Check if the form is submitted
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $accountName = trim($_POST['accountName']);
    $accountNumber = trim($_POST['accountNumber']);
    $bankName = trim($_POST['bankName']);
    $ifscCode = trim($_POST['ifscCode']);

    // Server-side validation
    if (empty($accountName) || empty($accountNumber) || empty($bankName) || empty($ifscCode)) {
        $error = "All fields are required.";
    } elseif (!preg_match("/^[A-Za-z\s]+$/", $accountName)) {
        $error = "Account name must contain only letters and spaces.";
    } elseif (!preg_match("/^\d{9,18}$/", $accountNumber)) {
        $error = "Account number must be between 9 and 18 digits.";
    } elseif (!preg_match("/^[A-Z]{4}0[A-Z0-9]{6}$/", $ifscCode)) {
        $error = "Invalid IFSC code format.";
    } else {
        // Prepare an SQL statement (remove userid from here)
        $stmt = $conn->prepare("INSERT INTO payment (accountName, accountNumber, bankName, ifscCode, username) VALUES (?, ?, ?, ?, ?)");
        $stmt->bind_param("sssss", $accountName, $accountNumber, $bankName, $ifscCode, $username); // Include username in bind_param

        // Execute the statement and check for errors
        if ($stmt->execute() === TRUE) {
            // Redirect to success page
            header("Location: success2.php");
            exit();
        } else {
            $error = "Error: " . $stmt->error;
        }

        // Close the statement
        $stmt->close();
    }
}

// Close the database connection
$conn->close();
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Payment Form</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            background-color: #f0f2f5;
            padding: 20px;
            display: flex;
            justify-content: center;
            align-items: center;
            height: 100vh;
            margin: 0;
        }
        .form-container {
            background-color: #fff;
            border-radius: 8px;
            box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);
            padding: 30px;
            max-width: 400px;
            width: 100%;
        }
        h2 {
            text-align: center;
            color: #333;
            margin-bottom: 20px;
        }
        h3 {
            text-align: center;
            color: #4CAF50; /* Green color for the payment heading */
            margin-bottom: 15px;
            font-size: 24px; /* Larger font size for emphasis */
        }
        label {
            display: block;
            margin-bottom: 5px;
            color: #555;
        }
        input[type="text"], input[type="number"], input[type="submit"] {
            width: calc(100% - 22px);
            padding: 10px;
            margin-bottom: 15px;
            border: 1px solid #ccc;
            border-radius: 4px;
            font-size: 16px;
        }
        input[type="text"]:disabled {
            background-color: #e9ecef; /* Gray background for disabled input */
        }
        input[type="submit"] {
            background-color: #4CAF50;
            color: white;
            border: none;
            cursor: pointer;
            transition: background-color 0.3s ease;
        }
        input[type="submit"]:hover {
            background-color: #45a049;
        }
        .error-message {
            color: red;
            text-align: center;
            margin-top: 10px;
        }
    </style>
</head>
<body>
    <div class="form-container">
        <h2>Welcome, <?php echo htmlspecialchars($username); ?></h2>
        <h3>Payment Details</h3> <!-- Added heading for payment -->
        <form action="payment.php" method="POST">
            <label for="accountName">Account Name:</label>
            <input type="text" id="accountName" name="accountName" required>

            <label for="accountNumber">Account Number:</label>
            <input type="text" id="accountNumber" name="accountNumber" required>

            <label for="bankName">Bank Name:</label>
            <input type="text" id="bankName" name="bankName" required>

            <label for="ifscCode">IFSC Code:</label>
            <input type="text" id="ifscCode" name="ifscCode" required>

            <input type="submit" value="Submit Payment">
            <?php if ($error) { echo "<p class='error-message'>$error</p>"; } ?> <!-- Error message styled -->
        </form>
    </div>
</body>
</html>
