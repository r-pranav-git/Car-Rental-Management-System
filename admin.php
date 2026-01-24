<?php
session_start();

// Check if user is logged in and is an admin
if (!isset($_SESSION['username']) || $_SESSION['role'] !== 'admin') {
    header("Location: login.php"); // Redirect unauthorized users to login page
    exit();
}

include 'database.php';

// Query to fetch all users
$query_users = "SELECT * FROM users";
$result_users = mysqli_query($conn, $query_users);

// Query to fetch all feedbacks
$query_feedbacks = "SELECT * FROM feedbacks";
$result_feedbacks = mysqli_query($conn, $query_feedbacks);

// Query to fetch all bookings
$query_bookings = "SELECT * FROM bookings";
$result_bookings = mysqli_query($conn, $query_bookings);
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Admin Panel</title>
    <!-- Include your CSS stylesheets and other dependencies here -->
    <style>
        body {
            font-family: Arial, sans-serif;
            background-color: #f9f9f9;
            margin: 0;
            padding: 20px;
        }
        .container {
            max-width: 1200px;
            margin: 0 auto;
            background-color: #fff;
            padding: 20px;
            box-shadow: 0 0 10px rgba(0,0,0,0.1);
            border-radius: 5px;
        }
        h1 {
            text-align: center;
            margin-bottom: 30px;
        }
        h2 {
            margin-top: 30px;
        }
        table {
            width: 100%;
            border-collapse: collapse;
            margin-top: 20px;
        }
        table, th, td {
            border: 1px solid #ddd;
        }
        th, td {
            padding: 10px;
            text-align: left;
        }
        th {
            background-color: #f2f2f2;
        }
        ul {
            list-style-type: none;
            padding: 0;
        }
        li {
            margin-bottom: 10px;
        }
        a {
            text-decoration: none;
            color: #333;
            padding: 5px 10px;
            background-color: #f2f2f2;
            border-radius: 5px;
        }
        a:hover {
            background-color: #e0e0e0;
        }
    </style>
</head>
<body>
    <div class="container">
        <h1>Welcome, <?php echo $_SESSION['username']; ?> (Admin)</h1>
        
        <h2>Users</h2>
        <table>
            <thead>
                <tr>
                    <th>ID</th>
                    <th>Username</th>
                    <th>Email</th>
                    <th>Role</th>
                </tr>
            </thead>
            <tbody>
                <?php while ($row = mysqli_fetch_assoc($result_users)) { ?>
                    <tr>
                        <td><?php echo $row['id']; ?></td>
                        <td><?php echo $row['username']; ?></td>
                        <td><?php echo $row['email']; ?></td>
                        <td><?php echo $row['role']; ?></td>
                    </tr>
                <?php } ?>
            </tbody>
        </table>
        
        <h2>User Feedbacks</h2>
        <ul>
            <?php while ($row = mysqli_fetch_assoc($result_feedbacks)) { ?>
                <li>
                    <strong>User ID:</strong> <?php echo $row['user_id']; ?><br>
                    <strong>Message:</strong> <?php echo $row['message']; ?><br>
                    <strong>Timestamp:</strong> <?php echo $row['timestamp']; ?>
                </li>
            <?php } ?>
        </ul>
        
        <h2>User Bookings</h2>
        <table>
            <thead>
                <tr>
                    <th>ID</th>
                    <th>User ID</th>
                    <th>Vehicle ID</th>
                    <th>Booking Date</th>
                    <th>Status</th>
                </tr>
            </thead>
            <tbody>
                <?php while ($row = mysqli_fetch_assoc($result_bookings)) { ?>
                    <tr>
                        <td><?php echo $row['id']; ?></td>
                        <td><?php echo $row['user_id']; ?></td>
                        <td><?php echo $row['vehicle_id']; ?></td>
                        <td><?php echo $row['booking_date']; ?></td>
                        <td><?php echo $row['status']; ?></td>
                    </tr>
                <?php } ?>
            </tbody>
        </table>

        <a href="logout.php">Logout</a> <!-- Link to logout.php to handle logout -->
    </div>
</body>
</html>
