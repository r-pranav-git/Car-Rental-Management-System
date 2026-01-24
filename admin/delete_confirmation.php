<!DOCTYPE html>
<html>
<head>
    <title>Delete Confirmation</title>
</head>
<body>
    <?php

    session_start();

    if (isset($_GET['message'])) {
        $message = urldecode($_GET['message']);
        echo "<p>$message</p>";
    }

    if (!isset($_SESSION['userid'])) {
        // $message = urldecode($_GET['message']);
        echo "<p> You have been logged out. Please <a href='project\vehicle\login.php'>login <a> again.</p>";
    }else{
        echo"<a href='project\vehicle\index.html'> Go back to Home Page</a>";
    }


    ?>
    <a href="customers.php">Go back to Customer Page</a>
</body>
</html>