<?php
//dashboard.php
include("config.php");

if(!isset($_SESSION['user'])){
    header("Location: login.php");
    exit;
}

$user = $_SESSION['user'];
?>

<head>
   <link rel="stylesheet" href="style.css">
</head>

<?php include("header.php"); ?>
<div class="container">



<h2>Welcome, <?php echo $user['fullname']; ?></h2>
<img src="<?php echo $user['picture']; ?>" width="120" height="120"><br><br>

Email: <?php echo $user['email']; ?><br>
User Type: <?php echo $user['user_type']; ?><br><br>



</div>
