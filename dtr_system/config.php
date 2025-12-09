<?php
//config.php
$conn = mysqli_connect("localhost", "root", "", "log");

if(!$conn){
    die("Connection failed: " . mysqli_connect_error());
}


if (session_status() === PHP_SESSION_NONE) {
    session_start();
}
?>
