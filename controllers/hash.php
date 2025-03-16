<?php
$password = 'staff1@2025';
$hashed_password = password_hash($password, PASSWORD_BCRYPT);
echo $hashed_password;
?>
