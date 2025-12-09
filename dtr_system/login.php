<?php 
//login.php
session_start();
include("config.php"); ?>

<?php
if(isset($_POST['login'])){
    $email = $_POST['email'];
    $password = $_POST['password'];

    $sql = "SELECT * FROM users WHERE email='$email'";
    //$sql = "INSERT INTO users(email, password) VALUES ($email, $password)";
    $result = mysqli_query($conn, $sql) or die("SQL ERROR: " . mysqli_error($conn));

    if(mysqli_num_rows($result) == 1){
        $row = mysqli_fetch_assoc($result);

        if(password_verify($password, $row['password'])){
            $_SESSION['user'] = $row;
            header("Location: dashboard.php");
            exit;
        } else {
            echo "Incorrect password!";
        }
    } else {
        echo "<script>alert('Email not found!');</script>";

    }
}
?>
<head>
   <link rel="stylesheet" href="style.css">
</head>
<body>
    <?php include("header.php"); ?>
    
<div class="container">


<form method="POST" autocomplete="off">
    Email: <input type="email" name="email"><br><br>
    Password: <input type="password" name="password"><br><br>
    <button name="login">Login</button>
</form>
</div>

    

</body>


