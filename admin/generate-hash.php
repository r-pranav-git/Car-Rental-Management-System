<?php
$password = 'admin@12345';
$hashed_password = password_hash($password, PASSWORD_DEFAULT);
echo $hashed_password;
?>
