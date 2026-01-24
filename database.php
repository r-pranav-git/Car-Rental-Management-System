<?php

$hostName = "localhost";
$dbUser = "root";
$dbPassword = "";
$dbName = "vehicle";
$conn = mysqli_connect($hostName, $dbUser, $dbPassword, $dbName);

if (!$conn) {
    die("Could not connect: " . mysqli_connect_error());
}
// echo "Successfully connected"; 

?>
