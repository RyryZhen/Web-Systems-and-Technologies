<?php
//admin/edit_user.php
include("../config/config.php");

if(!isset($_SESSION['user']) || $_SESSION['user']['role'] != 'admin'){
    header("Location: ../auth/login.php");
    exit;
}

$message = ""; // initialize $message
$user = null; // initialize $user

$id = isset($_GET['id']) ? (int)$_GET['id'] : 0;

if($id > 0){
    $res = mysqli_query($conn, "SELECT * FROM users WHERE id=$id");
    if($res && mysqli_num_rows($res) > 0){
        $user = mysqli_fetch_assoc($res);
    } else {
        $message = "<div class='alert alert-danger'>User not found.</div>";
    }
} else {
    $message = "<div class='alert alert-danger'>Invalid user ID.</div>";
}

if(isset($_POST['update']) && $user){
    $name = mysqli_real_escape_string($conn, $_POST['name']);
    $email = mysqli_real_escape_string($conn, $_POST['email']);
    $role = mysqli_real_escape_string($conn, $_POST['role']);

    mysqli_query($conn, "UPDATE users SET name='$name', email='$email', role='$role' WHERE id=$id");

    if(isset($_FILES['profile_pic']) && $_FILES['profile_pic']['name']){
        $profile_name = time()."_".$_FILES['profile_pic']['name'];
        move_uploaded_file($_FILES['profile_pic']['tmp_name'], "../uploads/profiles/".$profile_name);
        mysqli_query($conn, "UPDATE users SET profile_pic='$profile_name' WHERE id=$id");
        $user['profile_pic'] = $profile_name; // update $user array
    }

    if(isset($_FILES['signature']) && $_FILES['signature']['name']){
        $sig_name = time()."_".$_FILES['signature']['name'];
        move_uploaded_file($_FILES['signature']['tmp_name'], "../uploads/signatures/".$sig_name);
        mysqli_query($conn, "UPDATE users SET signature='$sig_name' WHERE id=$id");
        $user['signature'] = $sig_name; // update $user array
    }

    $message = "<div class='alert alert-success'>User updated successfully.</div>";
}
?>


<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<title>Edit User</title>
<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
<style>
    body {
        background-color: #f8f9fa;
        font-family: Arial, sans-serif;
    }
    .container {
        max-width: 600px;
        margin: 50px auto;
        background: #fff;
        padding: 30px;
        border-radius: 10px;
        box-shadow: 0px 4px 15px rgba(0,0,0,0.1);
    }
    h4 {
        margin-bottom: 25px;
        font-weight: 600;
        text-align: center;
    }
    .form-label {
        font-weight: 500;
    }
    .btn-primary {
        width: 100%;
    }
    .alert {
        margin-bottom: 20px;
    }
</style>
</head>
<body>

<div class="container">
    <h4>Edit User</h4>
    <!-- Success or error message -->
    <?= $message ?>

    <!-- Back Button -->
    <a href="manage_users.php" class="btn btn-secondary mb-3">← Back to Users</a>

    <form method="POST" enctype="multipart/form-data">
        <div class="mb-3">
            <label class="form-label">Full Name</label>
            <input type="text" name="name" value="<?= $user['name'] ?>" class="form-control" required>
        </div>

        <div class="mb-3">
            <label class="form-label">Email Address</label>
            <input type="email" name="email" value="<?= $user['email'] ?>" class="form-control" required>
        </div>

        <div class="mb-3">
            <label class="form-label">Role</label>
            <select name="role" class="form-select">
                <option value="student" <?= $user['role']=='student'?'selected':'' ?>>Student</option>
                <option value="faculty" <?= $user['role']=='faculty'?'selected':'' ?>>Faculty</option>
                <option value="admin" <?= $user['role']=='admin'?'selected':'' ?>>Admin</option>
            </select>
        </div>

        <div class="mb-3">
            <label class="form-label">Profile Picture</label>
            <input type="file" name="profile_pic" class="form-control">
            <?php if($user['profile_pic']): ?>
                <img src="../uploads/profiles/<?= $user['profile_pic'] ?>" alt="Profile Picture" class="img-thumbnail mt-2" style="width:100px;">
            <?php endif; ?>
        </div>

        <div class="mb-3">
            <label class="form-label">Signature</label>
            <input type="file" name="signature" class="form-control">
            <?php if($user['signature']): ?>
                <img src="../uploads/signatures/<?= $user['signature'] ?>" alt="Signature" class="img-thumbnail mt-2" style="width:100px;">
            <?php endif; ?>
        </div>

        <button name="update" class="btn btn-primary">Update User</button>
    </form>
</div>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
