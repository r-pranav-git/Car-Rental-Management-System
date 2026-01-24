<?php
// Include database connection
include 'database.php';

// Initialize an array to hold driver details
$drivers = [];
$error_messages = [];

// Handle form submission
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $name = $_POST['name'];
    $license_number = $_POST['license_number'];
    $email = $_POST['email'];
    $phone = $_POST['phone'];

    // Simple validation
    if (!preg_match('/^[A-Za-z0-9]{5,10}$/', $license_number)) {
        $error_messages[] = 'License number must be 5-10 alphanumeric characters!';
    } elseif (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
        $error_messages[] = 'Invalid email format!';
    } elseif (!preg_match('/^\d{10}$/', $phone)) {
        $error_messages[] = 'Phone number must be 10 digits!';
    } else {
        // Check if the license number already exists
        $stmt = $conn->prepare("SELECT * FROM drivers WHERE license_number = ?");
        $stmt->bind_param("s", $license_number);
        $stmt->execute();
        $result = $stmt->get_result();

        if ($result->num_rows > 0) {
            $error_messages[] = 'License number already exists!';
        } else {
            // Insert driver details into the database
            $stmt = $conn->prepare("INSERT INTO drivers (name, license_number, email, phone) VALUES (?, ?, ?, ?)");
            $stmt->bind_param("ssss", $name, $license_number, $email, $phone);
            
            if ($stmt->execute()) {
                echo "<script>alert('Driver registered successfully!');</script>";
            } else {
                $error_messages[] = 'Error: ' . $stmt->error;
            }
            $stmt->close();
        }
    }
}

// Retrieve driver details from the database
$result = $conn->query("SELECT * FROM drivers");
if ($result) {
    while ($row = $result->fetch_assoc()) {
        $drivers[] = $row;
    }
}

$conn->close();
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Driver Registration</title>
    <link href="https://fonts.googleapis.com/css?family=Poppins:200,300,400,500,600,700,800&display=swap" rel="stylesheet">
    <style>
        body {
            font-family: 'Poppins', sans-serif;
            background-color: #f8f9fa;
            margin: 0;
            padding: 0;
        }
        .container {
            max-width: 800px;
            margin: 20px auto;
            padding: 20px;
            background: #ffffff;
            border-radius: 5px;
            box-shadow: 0 2px 10px rgba(0, 0, 0, 0.1);
        }
        h2 {
            text-align: center;
            margin-bottom: 20px;
        }
        .form-group {
            margin-bottom: 15px;
        }
        .form-group label {
            display: block;
            margin-bottom: 5px;
            font-weight: bold;
        }
        .form-group input {
            width: 100%;
            padding: 10px;
            border: 1px solid #ced4da;
            border-radius: 4px;
            box-sizing: border-box;
            transition: border-color 0.3s;
        }
        .form-group input:focus {
            border-color: #007bff;
            outline: none;
        }
        .btn {
            background-color: #007bff;
            color: white;
            padding: 10px 15px;
            border: none;
            border-radius: 4px;
            cursor: pointer;
            transition: background-color 0.3s;
        }
        .btn:hover {
            background-color: #0056b3;
        }
        .error-message {
            color: red;
            margin: 10px 0;
        }
        table {
            width: 100%;
            border-collapse: collapse;
            margin-top: 20px;
        }
        table, th, td {
            border: 1px solid #ced4da;
        }
        th, td {
            padding: 10px;
            text-align: left;
        }
        th {
            background-color: #f2f2f2;
        }
        tr:nth-child(even) {
            background-color: #f9f9f9;
        }
        tr:hover {
            background-color: #f1f1f1;
        }
    </style>
    <script>
        let detailsFetched = false; // Track if details have been fetched

        function fetchDriverDetails() {
            const licenseNumber = document.getElementById('license_number').value;
            if (licenseNumber.length > 0 && !detailsFetched) {
                fetch(`fetch_driver.php?license_number=${licenseNumber}`)
                    .then(response => response.json())
                    .then(data => {
                        if (data.success) {
                            document.getElementById('name').value = data.driver.name;
                            document.getElementById('email').value = data.driver.email;
                            document.getElementById('phone').value = data.driver.phone;
                            detailsFetched = true; // Prevent further autofill
                        } else {
                            alert('No driver found with that license number.');
                        }
                    })
                    .catch(error => console.error('Error fetching driver details:', error));
            } else if (licenseNumber.length === 0) {
                // Clear fields if license number is empty
                document.getElementById('name').value = '';
                document.getElementById('email').value = '';
                document.getElementById('phone').value = '';
                detailsFetched = false; // Reset autofill tracking
            }
        }
    </script>
</head>
<body>

<div class="container">
    <h2>Driver Registration Form</h2>

    <?php if (!empty($error_messages)): ?>
        <div class="error-message">
            <?php foreach ($error_messages as $error): ?>
                <p><?php echo htmlspecialchars($error); ?></p>
            <?php endforeach; ?>
        </div>
    <?php endif; ?>

    <form method="POST" action="">
        <div class="form-group">
            <label for="name">Full Name</label>
            <input type="text" name="name" id="name" required>
        </div>
        <div class="form-group">
            <label for="license_number">License Number</label>
            <input type="text" name="license_number" id="license_number" required oninput="fetchDriverDetails()">
        </div>
        <div class="form-group">
            <label for="email">Email</label>
            <input type="email" name="email" id="email" required>
        </div>
        <div class="form-group">
            <label for="phone">Phone Number</label>
            <input type="tel" name="phone" id="phone" required>
        </div>
        <button type="submit" class="btn">Register</button>
    </form>

    <h2>Registered Drivers</h2>

    <table>
        <thead>
            <tr>
                <th>Name</th>
                <th>License Number</th>
                <th>Email</th>
                <th>Phone</th>
            </tr>
        </thead>
        <tbody>
            <?php if (count($drivers) > 0): ?>
                <?php foreach ($drivers as $driver): ?>
                    <tr>
                        <td><?php echo htmlspecialchars($driver['name']); ?></td>
                        <td><?php echo htmlspecialchars($driver['license_number']); ?></td>
                        <td><?php echo htmlspecialchars($driver['email']); ?></td>
                        <td><?php echo htmlspecialchars($driver['phone']); ?></td>
                    </tr>
                <?php endforeach; ?>
            <?php else: ?>
                <tr>
                    <td colspan="4">No drivers registered yet.</td>
                </tr>
            <?php endif; ?>
        </tbody>
    </table>
</div>

</body>
</html>
