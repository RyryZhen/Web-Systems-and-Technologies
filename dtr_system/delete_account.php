<?php
//delete_account.php
include("config.php");

if(!isset($_SESSION['user'])){
    header("Location: login.php");
    exit;
}

$id = $_SESSION['user']['id'];

mysqli_query($conn, "DELETE FROM users WHERE id=$id");

session_unset();
session_destroy();

echo "<script>alert('Account deleted successfully'); window.location='register.php';</script>";
?>
