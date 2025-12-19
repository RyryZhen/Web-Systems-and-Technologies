<?php
// dashboard.php
session_start();
include("config.php");

if(!isset($_SESSION['user'])){
    header("Location: login.php");
    exit;
}

$user = $_SESSION['user'];
$picture = (!empty($user['picture'])) ? $user['picture'] : "default.png";
?>
<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="UTF-8">
<title>Dashboard</title>
<meta name="viewport" content="width=device-width, initial-scale=1.0" />

<style>
    body {
        font-family: Arial, sans-serif;
        background: #f5f7fb;
        margin: 0;
        display: flex;
        justify-content: center;
        align-items: center;
        height: 100vh;
    }

    .container {
        background: #ffffff;
        padding: 40px;
        border-radius: 16px;
        box-shadow: 0 8px 20px rgba(0, 0, 0, 0.1);
        width: 420px;
        animation: fadeIn 0.4s ease;
        text-align: center;
    }

    h2 {
        margin-bottom: 20px;
        color: #333;
        letter-spacing: 1px;
    }

    .profile-img {
        width: 130px;
        height: 130px;
        border-radius: 50%;
        object-fit: cover;
        margin-bottom: 15px;
        border: 3px solid #4a6cf7;
    }

    .info-box {
        text-align: left;
        margin-top: 20px;
        font-size: 15px;
    }

    b {
        color: #4a6cf7;
    }

    .logout-btn {
        margin-top: 25px;
        width: 100%;
        background: #4a6cf7;
        padding: 12px;
        border: none;
        color: white;
        font-size: 16px;
        border-radius: 8px;
        cursor: pointer;
        transition: 0.2s;
    }

    .logout-btn:hover {
        background: #3b57d6;
    }

    @keyframes fadeIn {
        from { opacity: 0; transform: translateY(10px); }
        to { opacity: 1; transform: translateY(0); }
    }
</style>
</head>

<body>

<div class="container">
      

    <h2>Hello, <?php echo htmlspecialchars($user['fullname']); ?>!</h2>

    <img src="<?php echo htmlspecialchars($picture); ?>" class="profile-img" alt="Profile Picture">

    <div class="info-box">
        <p><b>Email:</b> <?php echo htmlspecialchars($user['email']); ?></p>
        <p><b>User Type:</b> <?php echo htmlspecialchars($user['user_type']); ?></p>
    </div>

    <form action="logout.php" method="POST">
        <?php include("header.php"); ?>
    </form>

</div>

</body>

</html>
