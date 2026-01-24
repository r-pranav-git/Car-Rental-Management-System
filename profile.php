<?php
session_start();
include 'database.php';

// Check if the user is logged in
if (!isset($_SESSION['userid'])) {
    header("Location: login.php");
    exit();
}

$userid = $_SESSION['userid'];

// Fetch user data from the database
$sql = "SELECT * FROM register WHERE userid = ?";
$stmt = $conn->prepare($sql);
$stmt->bind_param("i", $userid);
$stmt->execute();
$result = $stmt->get_result();

if ($result->num_rows === 0) {
    echo "No user found!";
    exit();
}

$user = $result->fetch_assoc();

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    // Get updated data from the form
    $name = $_POST['name'];
    $username = $_POST['username'];
    $phonenumber = $_POST['phonenumber'];
    $email = $_POST['email'];
    $current_password = $_POST['current_password'];
    $new_password = $_POST['new_password'];
    $confirmpassword = $_POST['confirmpassword'];

    // Check current password
    if (password_verify($current_password, $user['password'])) {
        // Update user data in the database
        $update_sql = "UPDATE register SET name=?, username=?, phonenumber=?, email=? WHERE userid=?";
        $update_stmt = $conn->prepare($update_sql);
        $update_stmt->bind_param("ssssi", $name, $username, $phonenumber, $email, $userid);
        
        if ($update_stmt->execute()) {
            echo "Profile updated successfully.";
        } else {
            echo "Error updating profile: " . $conn->error;
        }

        // Update password if a new password is provided
        if (!empty($new_password) && $new_password === $confirmpassword) {
            $hashed_password = password_hash($new_password, PASSWORD_DEFAULT); // Securely hash the password
            $password_sql = "UPDATE register SET password=? WHERE userid=?";
            $password_stmt = $conn->prepare($password_sql);
            $password_stmt->bind_param("si", $hashed_password, $userid);
            
            if ($password_stmt->execute()) {
                echo "Password updated successfully.";
                header("Location: index.php"); // Redirect to index.php upon successful update
                exit();
            } else {
                echo "Error updating password: " . $conn->error;
            }
        } elseif (!empty($new_password)) {
            echo "New passwords do not match.";
        }
    } else {
        echo "Current password is incorrect.";
    }
}

// Close connections
$stmt->close();
$conn->close();
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>User Profile</title>
    <style>
    body {
        font-family: Arial, sans-serif;
        margin: 0;
        padding: 0;
        background-color: #f4f4f4;
        display: flex;
        flex-direction: column;
        justify-content: center;
        align-items: center;
        height: 100vh; /* Full height to center vertically */
    }
    header {
        background-color: #333;
        padding: 15px;
        width: 100%;
        position: fixed;
        top: 0;
        left: 0;
        text-align: center;
    }
    nav ul {
        list-style-type: none;
        padding: 0;
        margin: 0;
    }
    nav ul li {
        display: inline;
        margin-right: 15px;
    }
    nav ul li a {
        color: white;
        text-decoration: none;
        font-weight: bold;
    }
    h1 {
        color: #333;
        text-align: center;
        margin-top: 80px; /* To push it below the fixed header */
        text-transform: uppercase; /* Makes the text uppercase */
    }
    form {
        background-color: white;
        width: 100%;
        max-width: 600px; /* Limit the form width */
        padding: 20px;
        border-radius: 5px;
        box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
        margin-top: 20px;
    }
    label {
        display: block;
        margin-bottom: 5px;
        font-weight: bold;
    }
    input[type="text"],
    input[type="email"],
    input[type="password"] {
        width: 100%;
        max-width: 500px; /* Limit the input width */
        padding: 10px;
        margin-bottom: 15px;
        border: 1px solid #ccc;
        border-radius: 4px;
        box-sizing: border-box; /* Prevents padding from increasing element size */
    }
    input[type="submit"] {
        background-color: #28a745;
        color: white;
        padding: 10px;
        border: none;
        border-radius: 4px;
        cursor: pointer;
        width: 100%;
        max-width: 500px; /* Adjust button width as well */
    }
    input[type="submit"]:hover {
        background-color: #218838;
    }
    </style>
</head>
<body>
    <header>
        <nav>
            <ul>
                <li><a href="index.php">Home</a></li>
                <li><a href="profile.php">Profile</a></li>
                <li><a href="logout.php">Logout</a></li>
            </ul>
        </nav>
    </header>

    <h1>User Profile</h1>
    <form method="POST">
        <label for="name">Name:</label>
        <input type="text" name="name" id="name" value="<?php echo htmlspecialchars($user['name']); ?>" required>

        <label for="username">Username:</label>
        <input type="text" name="username" id="username" value="<?php echo htmlspecialchars($user['username']); ?>" required>

        <label for="phonenumber">Phone Number:</label>
        <input type="text" name="phonenumber" id="phonenumber" value="<?php echo htmlspecialchars($user['phonenumber']); ?>">

        <label for="email">Email:</label>
        <input type="email" name="email" id="email" value="<?php echo htmlspecialchars($user['email']); ?>" required>

        <label for="current_password">Current Password:</label>
        <input type="password" name="current_password" id="current_password" required>

        <label for="new_password">New Password:</label>
        <input type="password" name="new_password" id="new_password">

        <label for="confirmpassword">Confirm New Password:</label>
        <input type="password" name="confirmpassword" id="confirmpassword">

        <input type="submit" value="Update Profile">
    </form>
</body>
</html>

