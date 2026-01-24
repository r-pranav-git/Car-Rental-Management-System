<?php
include 'database.php';

if(isset($_POST['submit'])) {
    //$name = mysqli_real_escape_string($conn, $_POST['name']);
    $username = mysqli_real_escape_string($conn, $_POST['username']);
    $email = mysqli_real_escape_string($conn, $_POST['email']);
    $password = $_POST['password'];
    $confirmpassword = $_POST['confirmpassword'];

    $duplicate = mysqli_query($conn, "SELECT * FROM register WHERE username='$username' OR email='$email'");
    if(mysqli_num_rows($duplicate) > 0) {
        echo "<script>alert('Username or Email has already been taken');</script>";
    } else {
        if($password == $confirmpassword) {
            $hashed_password = password_hash($password, PASSWORD_DEFAULT);
            $query = "INSERT INTO register(name, username, email, password) VALUES('$name', '$username', '$email', '$hashed_password')";
            if(mysqli_query($conn, $query)) {
                // Redirect to success page
                header("Location: login.php");
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
        background-image: url(bg_3.jpg);
        background-color: #cccccc00;
        overflow-x: hidden;
    }
    .container {
        max-width: 1200px;
        margin: 0 auto;
        padding: 50px;
    }
    .signup-form {
        background-color: #cccccc00;
        padding: 40px;
        border-radius: 20px;
        box-shadow: 0px 0px 20px rgba(0, 0, 0, 0);
        animation: fadeInDown 1s ease;
    }
    h2 {
        text-align: center;
        margin-bottom: 30px;
        color: #333;
    }
    label {
        font-weight: bold;
    }
    input[type="text"],
    input[type="email"],
    input[type="password"] {
        width: 100%;
        padding: 10px;
        margin: 10px 0;
        border: 1px solid #cccccc;
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
</style>
</head>
<body>

<div class="container">
    <div class="signup-form animate__animated animate__fadeInDown">
        <h2>Sign Up</h2>
        <form action="/submit_signup" method="post">
            <label for="username">Username</label>
            <input type="text" id="username" name="username" placeholder="Your username.." required>

            <label for="email">Email</label>
            <input type="email" id="email" name="email" placeholder="Your email.." required>

            <label for="password">Password</label>
            <input type="password" id="password" name="password" placeholder="Your password.." required>

            <input type="submit" value="Sign Up">
        </form>
    </div>
</div>

<script>
    // Smooth scrolling effect
    document.querySelectorAll('a[href^="#"]').forEach(anchor => {
        anchor.addEventListener('click', function (e) {
            e.preventDefault();

            document.querySelector(this.getAttribute('href')).scrollIntoView({
                behavior: 'smooth'
            });
        });
    });
</script>

</body>
</html>
