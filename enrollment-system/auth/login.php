<?php include("../config/config.php"); ?>
<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="UTF-8">
<title>Login</title>
<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
<style>
    body {
        min-height: 100vh;
        background: linear-gradient(135deg, #f5f7fa, #e4e9f2);
        display: flex;
        align-items: center;
        justify-content: center;
    }
    .login-card {
        width: 100%;
        max-width: 420px;
        background: #fff;
        border-radius: 16px;
        padding: 32px;
        box-shadow: 0 20px 40px rgba(0,0,0,.08);
    }
    .login-title {
        font-weight: 600;
        text-align: center;
        margin-bottom: 4px;
    }
    .login-subtitle {
        text-align: center;
        font-size: .9rem;
        color: #6c757d;
        margin-bottom: 24px;
    }
    .form-control {
        border-radius: 10px;
        padding: 10px 12px;
    }
    .btn-login {
        border-radius: 10px;
        padding: 10px;
        font-weight: 500;
    }
</style>
</head>
<body>

<div class="login-card">

    <?php include("header.php"); ?>

    <h4 class="login-title">Welcome Back</h4>
    <div class="login-subtitle">Please sign in to your account</div>

    <form method="POST" autocomplete="off">
        <div class="mb-3">
            <input class="form-control" name="email" placeholder="Email">
        </div>
        <div class="mb-3">
            <input class="form-control" name="password" type="password" placeholder="Password">
        </div>
        <div class="d-grid">
            <button class="btn btn-success btn-login" name="login">Login</button>
        </div>
    </form>

    <?php
    if(isset($_POST['login'])){
      $email = $_POST['email'];
      $pass = $_POST['password'];

      $res = mysqli_query($conn,"SELECT * FROM users WHERE email='$email'");
      $user = mysqli_fetch_assoc($res);

      if($user && password_verify($pass, $user['password'])){
        $_SESSION['user'] = $user;
        header("Location: ../admin/dashboard.php");

        if($user['role']=="admin") header("Location: ../admin/dashboard.php");
        if($user['role']=="faculty") header("Location: ../faculty/dashboard.php");
        if($user['role']=="student") header("Location: ../student/dashboard.php");
      } else {
        echo "<div class='alert alert-danger mt-3 text-center'>Invalid login</div>";
      }
    }
    ?>

</div>

</body>
</html>