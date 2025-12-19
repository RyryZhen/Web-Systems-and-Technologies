<?php 
//login.php
session_start();
include("config.php"); 
?>

<?php
if(isset($_POST['login'])){
    $email = $_POST['email'];
    $password = $_POST['password'];

    $sql = "SELECT * FROM users WHERE email='$email'";
    $result = mysqli_query($conn, $sql) or die("SQL ERROR: " . mysqli_error($conn));

    if(mysqli_num_rows($result) == 1){
        $row = mysqli_fetch_assoc($result);

        if(password_verify($password, $row['password'])){
            $_SESSION['user'] = $row;
            header("Location: dashboard.php");
            exit;
        } else {
            echo "<script>alert('Incorrect Password!');</script>";
        }
    } else {
        echo "<script>alert('Email not found!');</script>";
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <title>Login</title>

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
      width: 400px;
      animation: fadeIn 0.4s ease;
    }

    h2 {
      text-align: center;
      margin-bottom: 25px;
      color: #333;
      letter-spacing: 1px;
    }

    input {
      width: 100%;
      padding: 12px;
      margin: 10px 0;
      border: 1px solid #ddd;
      border-radius: 8px;
      font-size: 15px;
      transition: 0.2s;
    }

    input:focus {
      border-color: #4a6cf7;
      box-shadow: 0 0 4px rgba(74, 108, 247, 0.3);
      outline: none;
    }

    button {
      width: 100%;
      background: #4a6cf7;
      padding: 12px;
      border: none;
      color: white;
      font-size: 16px;
      border-radius: 8px;
      cursor: pointer;
      margin-top: 10px;
      transition: 0.2s;
    }

    button:hover {
      background: #3b57d6;
    }

    .register-link {
      display: block;
      text-align: center;
      margin-top: 15px;
      color: #4a6cf7;
      text-decoration: none;
      font-size: 14px;
    }

    .register-link:hover {
      text-decoration: underline;
    }

    @keyframes fadeIn {
      from { opacity: 0; transform: translateY(10px); }
      to { opacity: 1; transform: translateY(0); }
    }
  </style>

</head>
<body>

  <div class="container">
    <h2>Login</h2>

    <form method="POST" autocomplete="off">
      <input type="email" name="email" required placeholder="E-mail" />
      <input type="password" name="password" required placeholder="Password" />
      <button name="login">Login</button>
    </form>

    <a href="register.php" class="register-link">Don't have an account? Register</a>
  </div>

</body>
</html>
