<?php 
//register.php
session_start();
include("config.php"); ?>

<?php
if(isset($_POST['register'])){
    $fullname = $_POST['fullname'];
    $email = $_POST['email'];
    $user_type = $_POST['user_type'];
    $password = password_hash($_POST['password'], PASSWORD_DEFAULT);


    $pic = "";
    if(isset($_FILES['picture'])){
        $pic = "uploads/" . time() . "_" . $_FILES['picture']['name'];
        move_uploaded_file($_FILES['picture']['tmp_name'], $pic);
    }

    $sql = "INSERT INTO users(fullname,email,password,user_type,picture)
            VALUES('$fullname','$email','$password','$user_type','$pic')";
    mysqli_query($conn,$sql);

    echo "<script>
        alert('Registration Successful! You may login.');
        window.location='login.php';
      </script>";
}


?>
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <title>Register</title>
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

    input, select {
      width: 100%;
      padding: 12px;
      margin: 10px 0;
      border: 1px solid #ddd;
      border-radius: 8px;
      font-size: 15px;
      transition: 0.2s;
    }

    input:focus, select:focus {
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

    .login-link {
      display: block;
      text-align: center;
      margin-top: 15px;
      color: #4a6cf7;
      text-decoration: none;
      font-size: 14px;
    }

    .login-link:hover {
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

    <h2>Create an Account</h2>

    <form action="" method="POST" enctype="multipart/form-data" autocomplete="off">
      <input type="text" name="fullname" required placeholder="Full Name" />
      <input type="email" name="email" required placeholder="E-mail" />
      <input type="password" name="password" required placeholder="Password" />

      <select name="user_type">
        <option value="faculty">Faculty</option>
        <option value="admin">Admin</option>
      </select>

      <label>Profile Picture</label>
      <input type="file" name="picture" required />

      <button name="register">Register</button>
    </form>

    <a href="login.php" class="login-link">Already registered? Login</a>
  </div>
</body>
</html>
 