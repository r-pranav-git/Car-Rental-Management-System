<?php
include 'database.php';

if (isset($_POST['submit'])) {
    $name = mysqli_real_escape_string($conn, $_POST['name']);
    $username = mysqli_real_escape_string($conn, $_POST['username']);
    $phonenumber = mysqli_real_escape_string($conn, $_POST['phonenumber']); // Ensure this matches HTML
    $email = mysqli_real_escape_string($conn, $_POST['email']);
    $password = $_POST['password'];
    $confirmpassword = $_POST['confirmpassword'];

    $duplicate = mysqli_query($conn, "SELECT * FROM register WHERE username='$username' OR email='$email'");
    if (mysqli_num_rows($duplicate) > 0) {
        echo "<script>alert('Username or Email has already been taken');</script>";
    } else {
        if ($password === $confirmpassword) {
            $hashed_password = password_hash($password, PASSWORD_DEFAULT);
            $query = "INSERT INTO register(name, username, phonenumber, email, password) VALUES('$name', '$username', '$phonenumber', '$email', '$hashed_password')";
            if (mysqli_query($conn, $query)) {
                // Redirect to success page
                header("Location: success.php");
                exit();
            } else {
                echo "<script>alert('Error in registration');</script>";
            }
        } else {
            echo "<script>alert('Passwords do not match');</script>";
        }
    }
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<title>Sign Up</title>
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/animate.css/4.1.1/animate.min.css">
<style>
    body {
        font-family: Arial, sans-serif;
        margin: 0;
        padding: 0;
        background-image: url(images/about.jpg);
        background-color: #f9f9f9;
        background-size: cover;
        background-position: center;
        overflow-x: hidden;
    }
    .container {
        max-width: 1200px;
        margin: 0 auto;
        padding: 50px;
    }
    .signup-form {
        background-color: transparent;
        padding: 40px;
        border-radius: 20px;
        box-shadow: 0px 0px 20px rgba(0, 0, 0, 0.1);
        animation: fadeInDown 1s ease;
    }
    h1 {
        text-align: center;
        margin-bottom: 30px;
        color: #333;
    }
    label {
        font-size: medium;
        font-weight: bolder;
    }
    input[type="text"],
    input[type="tel"],
    input[type="email"],
    input[type="password"] {
        width: 100%;
        padding: 10px;
        margin: 10px 0;
        border: 1px solid #ccc;
        border-radius: 5px;
        box-sizing: border-box;
    }
    input[type="submit"] {
        background-color: #4CAF50;
        color: white;
        padding: 14px 20px;
        margin: 20px 0 10px;
        border: none;
        border-radius: 5px;
        cursor: pointer;
        width: 100%;
        font-size: 16px;
        transition: all 0.3s ease;
    }
    input[type="submit"]:hover {
        background-color: #45a049;
    }
    @keyframes fadeInDown {
        0% {
            opacity: 0;
            transform: translateY(-20px);
        }
        100% {
            opacity: 1;
            transform: translateY(0);
        }
    }
    .error-message {
        color: red;
        font-size: 14px;
        margin-top: 5px;
    }
</style>
</head>
<body>

<div class="container">
    <div class="signup-form animate__animated animate__fadeInDown">
        <h1>Register</h1>
        <form action="register.php" method="post" onsubmit="return validateForm()">
            <label for="name">Name</label>
            <input type="text" id="name" name="name" placeholder="Your name.." required>
            
            <label for="username">Username</label>
            <input type="text" id="username" name="username" placeholder="Your username.." required>
            
            <label for="phonenumber">Phone number</label>
            <input type="tel" id="phonenumber" name="phonenumber" placeholder="Your phone number.." required>
            <span id="phonenumberError" class="error-message"></span>

            <label for="email">Email</label>
            <input type="email" id="email" name="email" placeholder="Your email.." required>
            
            <label for="password">Password</label>
            <input type="password" id="password" name="password" placeholder="Your password.." required>
            <small>(password must contain minimum 8 characters)</small><br><br>

            <label for="confirmpassword">Confirm Password</label>
            <input type="password" id="confirmpassword" name="confirmpassword" placeholder="Confirm your password.." required>
            <span id="passwordError" class="error-message"></span>

            <input type="submit" name="submit" value="Register">
        </form>
    </div>
</div>

<script>
    function validateForm() {
        var name = document.getElementById("name").value;
        var username = document.getElementById("username").value;
        var phonenumber = document.getElementById("phonenumber").value;
        var email = document.getElementById("email").value;
        var password = document.getElementById("password").value;
        var confirmPassword = document.getElementById("confirmpassword").value;

        // Basic required field validation
        if (name.trim() === '' || username.trim() === '' || phonenumber.trim() === '' || email.trim() === '' || password.trim() === '' || confirmPassword.trim() === '') {
            alert("All fields must be filled out");
            return false;
        }

        // Phone number validation
        var phonenumberError = document.getElementById("phonenumberError");
        phonenumberError.innerHTML = "";
        if (phonenumber.length < 8) {
            phonenumberError.innerHTML = "Phone number must contain minimum 8 digits";
            return false;
        }

        // Password validation
        var passwordError = document.getElementById("passwordError");
        passwordError.innerHTML = "";
        if (password !== confirmPassword) {
            passwordError.innerHTML = "Passwords do not match";
            return false;
        }

        return true; // Form will submit if validation passes
    }
</script>

</body>
</html>
