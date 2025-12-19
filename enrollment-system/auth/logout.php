<?php
session_start();
$_SESSION = [];              // Clear all session variables
session_unset();             // Unset session
session_destroy();           // Destroy the session
header("Location: login.php"); // Redirect to login page
exit;
?>
