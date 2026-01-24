<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<title>Registration Successful</title>
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/animate.css/4.1.1/animate.min.css">
<style>
    body {
        font-family: Arial, sans-serif;
        margin: 0;
        padding: 0;
        background-color: #f9f9f9;
        overflow-x: hidden;
    }
    .container {
        max-width: 1200px;
        margin: 0 auto;
        padding: 50px;
    }
    .success-message {
        background-color: #fff;
        padding: 40px;
        border-radius: 20px;
        box-shadow: 0px 0px 20px rgba(0, 0, 0, 0.1);
        text-align: center;
        animation: fadeInDown 1s ease;
    }
    h2 {
        color: #333;
    }
    a {
        color: #4CAF50;
        text-decoration: none;
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
    <div class="success-message animate__animated animate__fadeInDown">
        <h2>Registration Successful</h2>
        <p>Your account has been successfully created.</p>
        <p><a href="login.php">Click here to login</a></p>
    </div>
</div>

</body>
</html>
