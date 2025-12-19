<?php
include("../config/config.php");

$message = "";

if(isset($_POST['register'])){
    $name = trim($_POST['name']);
    $email = trim($_POST['email']);
    $password = $_POST['password'];
    $role = $_POST['role'];

    if(empty($name) || empty($email) || empty($password) || empty($role)){
        $message = "<div class='alert alert-danger'>All fields are required.</div>";
    } elseif(!filter_var($email, FILTER_VALIDATE_EMAIL)){
        $message = "<div class='alert alert-danger'>Invalid email format.</div>";
    } elseif(!isset($_FILES['profile_pic']) || $_FILES['profile_pic']['error'] !== 0 ||
             !isset($_FILES['signature']) || $_FILES['signature']['error'] !== 0){
        $message = "<div class='alert alert-danger'>Please upload both profile picture and signature.</div>";
    } else {
        $pass_hash = password_hash($password, PASSWORD_DEFAULT);

        $profile = basename($_FILES['profile_pic']['name']);
        $signature = basename($_FILES['signature']['name']);

        if(!is_dir("../uploads/profiles")) mkdir("../uploads/profiles", 0777, true);
        if(!is_dir("../uploads/signatures")) mkdir("../uploads/signatures", 0777, true);

        $profile_path = "../uploads/profiles/$profile";
        $signature_path = "../uploads/signatures/$signature";

        if(move_uploaded_file($_FILES['profile_pic']['tmp_name'], $profile_path) &&
           move_uploaded_file($_FILES['signature']['tmp_name'], $signature_path)){

            $stmt = $conn->prepare("INSERT INTO users (role,name,email,password,profile_pic,signature) VALUES (?, ?, ?, ?, ?, ?)");
            $stmt->bind_param("ssssss", $role, $name, $email, $pass_hash, $profile, $signature);

            if($stmt->execute()){
                header("Location: login.php");
                exit;
            } else {
                $message = "<div class='alert alert-danger'>Database error: ".$stmt->error."</div>";
            }
        } else {
            $message = "<div class='alert alert-danger'>Failed to upload files. Check folder permissions.</div>";
        }
    }
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="UTF-8">
<title>Register</title>
<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
<style>
    body{
        min-height:100vh;
        background:linear-gradient(135deg,#f5f7fa,#e4e9f2);
        display:flex;
        align-items:center;
        justify-content:center;
    }
    .register-card{
        width:100%;
        max-width:520px;
        background:#fff;
        border-radius:16px;
        padding:32px;
        box-shadow:0 20px 40px rgba(0,0,0,.08);
    }
    .register-title{
        font-weight:600;
        text-align:center;
        margin-bottom:6px;
    }
    .register-subtitle{
        text-align:center;
        font-size:.9rem;
        color:#6c757d;
        margin-bottom:24px;
    }
    .form-control, .form-select{
        border-radius:10px;
        padding:10px 12px;
    }
    .btn-register{
        border-radius:10px;
        padding:10px;
        font-weight:500;
    }
    label{ font-size:.85rem; color:#495057; }
</style>
</head>
<body>

<div class="register-card">

    <?php include("header.php"); ?>

    <h4 class="register-title">Create an Account</h4>
    <div class="register-subtitle">Fill in the details to register</div>

    <?= $message ?>

    <form method="POST" enctype="multipart/form-data">
        <div class="mb-3">
            <input class="form-control" name="name" placeholder="Full Name" required>
        </div>
        <div class="mb-3">
            <input class="form-control" name="email" type="email" placeholder="Email" required>
        </div>
        <div class="mb-3">
            <input class="form-control" name="password" type="password" placeholder="Password" required>
        </div>

        <div class="mb-3">
            <label>Profile Picture</label>
            <input class="form-control" type="file" name="profile_pic" required>
        </div>

        <div class="mb-3">
            <label>Signature</label>
            <input class="form-control" type="file" name="signature" required>
        </div>

        <div class="mb-4">
            <select class="form-select" name="role" required>
                <option value="">Select Role</option>
                <option value="student">Student</option>
                <option value="faculty">Faculty</option>
            </select>
        </div>

        <div class="d-grid">
            <button class="btn btn-primary btn-register" name="register">Register</button>
        </div>
    </form>
</div>

</body>
</html>