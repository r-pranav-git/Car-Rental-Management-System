<?php
include 'database.php';

if(isset($_POST['submit'])) {
    $name = $_POST['name'];
    $username = $_POST['username'];
    $phone_number = $_POST['phone_number'];
    $email = $_POST['email'];
    $password = $_POST['password'];
    $confirmpassword = $_POST['confirmpassword'];
    $role = 'user'; // Default role for new users

    // Allowed email domains
    $allowed_domains = ['gmail.com', 'yahoo.com', 'outlook.com', 'hotmail.com'];
    $email_domain = substr(strrchr($email, "@"), 1);

    // Validate inputs
    if(empty($name) || empty($username) || empty($phone_number) || empty($email) || empty($password) || empty($confirmpassword)) {
        echo "<script>alert('All fields must be filled out');</script>";
    } elseif(strlen($phone_number) < 10) {
        echo "<script>alert('Phone number must contain minimum 10 digits');</script>";
    } elseif(strlen($password) < 8) {
        echo "<script>alert('Password must contain minimum 8 characters');</script>";
    } elseif($password != $confirmpassword) {
        echo "<script>alert('Passwords do not match');</script>";
    } elseif(!in_array($email_domain, $allowed_domains)) {
        echo "<script>alert('Email domain is not allowed');</script>";
    } else {
        // Check for duplicate username or email
        $stmt = $conn->prepare("SELECT * FROM register WHERE username=? OR email=?");
        $stmt->bind_param("ss", $username, $email);
        $stmt->execute();
        $result = $stmt->get_result();
        if($result->num_rows > 0) {
            echo "<script>alert('Username or Email has already been taken');</script>";
        } else {
            // Hash the password
            $hashed_password = password_hash($password, PASSWORD_DEFAULT);
            // Insert user into database
            $stmt = $conn->prepare("INSERT INTO register(name, username, phonenumber, email, password) VALUES(?, ?, ?, ?, ?)");
            $stmt->bind_param("sssss", $name, $username, $phone_number, $email, $hashed_password);
            if($stmt->execute()) {
                // Redirect to success page
                header("Location: success.php");
                exit();
            } else {
                echo "<script>alert('Error in registration');</script>";
            }
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
        font-family: 'Helvetica Neue', Arial, sans-serif;
        margin: 0;
        padding: 0;
        background-image: url(https://images.pexels.com/photos/116675/pexels-photo-116675.jpeg);
        background-color: #f0f2f5;
        background-size: cover;
        background-position: center;
        display: flex;
        justify-content: center;
        align-items: center;
        height: 100vh;
    }
    .container {
        max-width: 500px;
        width: 100%;
        padding: 20px;
        background-color: rgba(255, 255, 255, 0.85);
        border-radius: 10px;
        box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);
        animation: fadeInDown 1s ease;
    }
    .signup-form {
        display: flex;
        flex-direction: column;
    }
    h1 {
        text-align: center;
        margin-bottom: 20px;
        color: #333;
    }
    label {
        font-weight: bold;
        margin-bottom: 5px;
        color: #555;
    }
    input[type="text"],
    input[type="tel"],
    input[type="email"],
    input[type="password"] {
        width: 100%;
        padding: 10px;
        margin: 10px 0;
        border: 1px solid #ddd;
        border-radius: 5px;
        box-sizing: border-box;
        font-size: 16px;
        color: #333;
    }
    input[type="submit"] {
        background-color: #007bff;
        color: white;
        padding: 14px 20px;
        margin: 20px 0;
        border: none;
        border-radius: 5px;
        cursor: pointer;
        width: 100%;
        font-size: 16px;
        transition: background-color 0.3s ease;
    }
    input[type="submit"]:hover {
        background-color: #0056b3;
    }
    input[type="password"]:focus,
    input[type="text"]:focus,
    input[type="tel"]:focus,
    input[type="email"]:focus {
        border-color: #007bff;
        outline: none;
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
    .toggle-icon {
        position: absolute;
        right: 10px;
        top: 10px;
        cursor: pointer;
    }
    .password-container {
        position: relative;
    }
</style>
</head>
<body>

<div class="container">
    <div class="signup-form animate_animated animate_fadeInDown">
        <h1>Register</h1>
        <form action="register.php" method="post" onsubmit="return validateForm()">
            <label for="name">Name</label>
            <input type="text" id="name" name="name" placeholder="Your name.." required>
            
            <label for="username">Username</label>
            <input type="text" id="username" name="username" placeholder="Your username.." required>
            
            <label for="phone_number">Phone number</label>
            <input type="tel" id="phone_number" name="phone_number" placeholder="Your phone number.." required>

            <label for="email">Email</label>
            <input type="email" id="email" name="email" placeholder="Your email.." required>
            
            <label for="password">Password</label>
            <div class="password-container">
                <input type="password" id="password" name="password" placeholder="Your password.." required>
                <span class="toggle-icon" id="togglePassword" onclick="togglePasswordVisibility()">👁</span>
            </div>
            <small>(password must contain minimum 8 characters)</small><br><br>

            <label for="confirmpassword">Confirm Password</label>
            <div class="password-container">
                <input type="password" id="confirmpassword" name="confirmpassword" placeholder="Confirm your password.." required>
                <span class="toggle-icon" id="toggleConfirmPassword" onclick="toggleConfirmPasswordVisibility()">👁</span>
            </div>

            <input type="submit" name="submit" value="Register">
        </form>
    </div>
</div>

<script>
function validateForm() {
    var name = document.getElementById("name").value;
    var username = document.getElementById("username").value;
    var phone_number = document.getElementById("phone_number").value;
    var email = document.getElementById("email").value;
    var password = document.getElementById("password").value;
    var confirmPassword = document.getElementById("confirmpassword").value;

    // Basic required field validation
    if (name.trim() == '' || username.trim() == '' || phone_number.trim() == '' || email.trim() == '' || password.trim() == '' || confirmPassword.trim() == '') {
        alert("All fields must be filled out");
        return false;
    }

    // Phone number minimum 10 digits
    if (phone_number.length < 10) {
        alert("Phone number must contain minimum 10 digits");
        return false;
    }

    // Password minimum 8 characters
    if (password.length < 8 || confirmPassword.length < 8) {
        alert("Password must contain minimum 8 characters");
        return false;
    }

    // Password matching validation
    if (password != confirmPassword) {
        alert("Passwords do not match");
        return false;
    }

    // Email domain validation
    var allowedDomains = ['gmail.com', 'yahoo.com', 'outlook.com', 'hotmail.com'];
    var emailDomain = email.substring(email.lastIndexOf("@") + 1);
    if (!allowedDomains.includes(emailDomain)) {
        alert("Email domain is not allowed");
        return false;
    }

    return true; // Form will submit if validation passes
}

function togglePasswordVisibility() {
    var passwordField = document.getElementById("password");
    var toggleIcon = document.getElementById("togglePassword");

    if (passwordField.type === "password") {
        passwordField.type = "text";
        toggleIcon.textContent = "🔒"; // Change icon to locked
    } else {
        passwordField.type = "password";
        toggleIcon.textContent = "👁"; // Change icon to eye symbol
    }
}

function toggleConfirmPasswordVisibility() {
    var confirmPasswordField = document.getElementById("confirmpassword");
    var toggleIcon = document.getElementById("toggleConfirmPassword");

    if (confirmPasswordField.type === "password") {
        confirmPasswordField.type = "text";
        toggleIcon.textContent = "🔒"; // Change icon to locked
    } else {
        confirmPasswordField.type = "password";
        toggleIcon.textContent = "👁"; // Change icon to eye symb<?php
include 'database.php';

if (isset($_POST['submit'])) {
    $name = $_POST['name'];
    $username = $_POST['username'];
    $phone_number = $_POST['phone_number'];
    $email = $_POST['email'];
    $password = $_POST['password'];
    $confirmpassword = $_POST['confirmpassword'];
    $role = 'user'; // Default role for new users

    // Allowed email domains
    $allowed_domains = ['gmail.com', 'yahoo.com', 'outlook.com', 'hotmail.com'];
    $email_domain = substr(strrchr($email, "@"), 1);

    // Validate inputs
    if (empty($name) || empty($username) || empty($phone_number) || empty($email) || empty($password) || empty($confirmpassword)) {
        echo "<script>alert('All fields must be filled out');</script>";
    } elseif (strlen($phone_number) < 10) {
        echo "<script>alert('Phone number must contain minimum 10 digits');</script>";
    } elseif (strlen($password) < 8) {
        echo "<script>alert('Password must contain minimum 8 characters');</script>";
    } elseif ($password != $confirmpassword) {
        echo "<script>alert('Passwords do not match');</script>";
    } elseif (!in_array($email_domain, $allowed_domains)) {
        echo "<script>alert('Email domain is not allowed');</script>";
    } else {
        // Check for duplicate username or email
        $stmt = $conn->prepare("SELECT * FROM register WHERE username=? OR email=?");
        $stmt->bind_param("ss", $username, $email);
        $stmt->execute();
        $result = $stmt->get_result();
        if ($result->num_rows > 0) {
            echo "<script>alert('Username or Email has already been taken');</script>";
        } else {
            // Hash the password
            $hashed_password = password_hash($password, PASSWORD_DEFAULT);
            // Insert user into database
            $stmt = $conn->prepare("INSERT INTO register(name, username, phonenumber, email, password) VALUES(?, ?, ?, ?, ?)");
            $stmt->bind_param("sssss", $name, $username, $phone_number, $email, $hashed_password);
            if ($stmt->execute()) {
                // Redirect to success page
                header("Location: success.php");
                exit();
            } else {
                echo "<script>alert('Error in registration');</script>";
            }
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
        font-family: 'Helvetica Neue', Arial, sans-serif;
        margin: 0;
        padding: 0;
        background-image: url(https://images.pexels.com/photos/116675/pexels-photo-116675.jpeg);
        background-color: #f0f2f5;
        background-size: cover;
        background-position: center;
        display: flex;
        justify-content: center;
        align-items: center;
        height: 100vh;
    }
    .container {
        max-width: 500px;
        width: 100%;
        padding: 20px;
        background-color: rgba(255, 255, 255, 0.85);
        border-radius: 10px;
        box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);
        animation: fadeInDown 1s ease;
    }
    .signup-form {
        display: flex;
        flex-direction: column;
    }
    h1 {
        text-align: center;
        margin-bottom: 20px;
        color: #333;
    }
    label {
        font-weight: bold;
        margin-bottom: 5px;
        color: #555;
    }
    input[type="text"],
    input[type="tel"],
    input[type="email"],
    input[type="password"] {
        width: 100%;
        padding: 10px;
        margin: 10px 0;
        border: 1px solid #ddd;
        border-radius: 5px;
        box-sizing: border-box;
        font-size: 16px;
        color: #333;
    }
    input[type="submit"] {
        background-color: #007bff;
        color: white;
        padding: 14px 20px;
        margin: 20px 0;
        border: none;
        border-radius: 5px;
        cursor: pointer;
        width: 100%;
        font-size: 16px;
        transition: background-color 0.3s ease;
    }
    input[type="submit"]:hover {
        background-color: #0056b3;
    }
    input[type="password"]:focus,
    input[type="text"]:focus,
    input[type="tel"]:focus,
    input[type="email"]:focus {
        border-color: #007bff;
        outline: none;
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
    .toggle-icon {
        position: absolute;
        right: 10px;
        top: 10px;
        cursor: pointer;
    }
    .password-container {
        position: relative;
    }
    .error {
        color: red;
        font-size: 12px;
        margin-top: -10px;
        margin-bottom: 10px;
    }
</style>
</head>
<body>

<div class="container">
    <div class="signup-form animate_animated animate_fadeInDown">
        <h1>Register</h1>
        <form action="register.php" method="post" onsubmit="return validateForm()">
            <label for="name">Name</label>
            <input type="text" id="name" name="name" placeholder="Your name.." required>
            <span id="nameError" class="error"></span>
            
            <label for="username">Username</label>
            <input type="text" id="username" name="username" placeholder="Your username.." required>
            <span id="usernameError" class="error"></span>
            
            <label for="phone_number">Phone number</label>
            <input type="tel" id="phone_number" name="phone_number" placeholder="Your phone number.." required>
            <span id="phoneError" class="error"></span>

            <label for="email">Email</label>
            <input type="email" id="email" name="email" placeholder="Your email.." required>
            <span id="emailError" class="error"></span>
            
            <label for="password">Password</label>
            <div class="password-container">
                <input type="password" id="password" name="password" placeholder="Your password.." required>
                <span class="toggle-icon" id="togglePassword" onclick="togglePasswordVisibility()">👁</span>
            </div>
            <span id="passwordError" class="error"></span>
            <small>(password must contain minimum 8 characters)</small><br><br>

            <label for="confirmpassword">Confirm Password</label>
            <div class="password-container">
                <input type="password" id="confirmpassword" name="confirmpassword" placeholder="Confirm your password.." required>
                <span class="toggle-icon" id="toggleConfirmPassword" onclick="toggleConfirmPasswordVisibility()">👁</span>
            </div>
            <span id="confirmPasswordError" class="error"></span>

            <input type="submit" name="submit" value="Register">
        </form>
    </div>
</div>

<script>
document.getElementById("phone_number").addEventListener("input", function() {
    const phone = this.value;
    const phoneError = document.getElementById("phoneError");
    if (phone.length < 10) {
        phoneError.textContent = "Phone number must contain minimum 10 digits.";
    } else {
        phoneError.textContent = "";
    }
});

document.getElementById("email").addEventListener("input", function() {
    const email = this.value;
    const emailError = document.getElementById("emailError");
    const allowedDomains = ['gmail.com', 'yahoo.com', 'outlook.com', 'hotmail.com'];
    const emailDomain = email.substring(email.lastIndexOf("@") + 1);
    if (!allowedDomains.includes(emailDomain)) {
        emailError.textContent = "Email domain is not allowed.";
    } else {
        emailError.textContent = "";
    }
});

document.getElementById("password").addEventListener("input", function() {
    const password = this.value;
    const passwordError = document.getElementById("passwordError");
    if (password.length < 8) {
        passwordError.textContent = "Password must contain minimum 8 characters.";
    } else {
        passwordError.textContent = "";
    }
});

document.getElementById("confirmpassword").addEventListener("input", function() {
    const password = document.getElementById("password").value;
    const confirmPassword = this.value;
    const confirmPasswordError = document.getElementById("confirmPasswordError");
    if (confirmPassword !== password) {
        confirmPasswordError.textContent = "Passwords do not match.";
    } else {
        confirmPasswordError.textContent = "";
    }
});

function togglePasswordVisibility() {
    const passwordField = document.getElementById("password");
    const toggleIcon = document.getElementById("togglePassword");
    if (passwordField.type === "password") {
        passwordField.type = "text";
        toggleIcon.textContent = "🙈"; // Change icon to show password is visible
    } else {
        passwordField.type = "password";
        toggleIcon.textContent = "👁"; // Change icon to hide password
    }
}

function toggleConfirmPasswordVisibility() {
    const confirmPasswordField = document.getElementById("confirmpassword");
    const toggleIcon = document.getElementById("toggleConfirmPassword");
    if (confirmPasswordField.type === "password") {
        confirmPasswordField.type = "text";
        toggleIcon.textContent = "🙈"; // Change icon to show password is visible
    } else {
        confirmPasswordField.type = "password";
        toggleIcon.textContent = "👁"; // Change icon to hide password
    }
}

function validateForm() {
    let isValid = true;

    const name = document.getElementById("name").value;
    const username = document.getElementById("username").value;
    const phone_number = document.getElementById("phone_number").value;
    const email = document.getElementById("email").value;
    const password = document.getElementById("password").value;
    const confirmpassword = document.getElementById("confirmpassword").value;

    if (name === "" || username === "" || phone_number === "" || email === "" || password === "" || confirmpassword === "") {
        alert("All fields must be filled out");
        isValid = false;
    }

    if (phone_number.length < 10) {
        alert("Phone number must contain minimum 10 digits.");
        isValid = false;
    }

    if (password.length < 8) {
        alert("Password must contain minimum 8 characters.");
        isValid = false;
    }

    if (password !== confirmpassword) {
        alert("Passwords do not match.");
        isValid = false;
    }

    const allowedDomains = ['gmail.com', 'yahoo.com', 'outlook.com', 'hotmail.com'];
    const emailDomain = email.substring(email.lastIndexOf("@") + 1);
    if (!allowedDomains.includes(emailDomain)) {
        alert("Email domain is not allowed.");
        isValid = false;
    }

    return isValid;
}
</script>

</body>
</html>
