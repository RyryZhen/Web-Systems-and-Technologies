<?php
//admin/edit_user.php
include("../config/config.php");

if(!isset($_SESSION['user']) || $_SESSION['user']['role'] != 'admin'){
    header("Location: ../auth/login.php");
    exit;
}

$id = (int)$_GET['id'];
$res = mysqli_query($conn, "SELECT * FROM users WHERE id=$id");
$user = mysqli_fetch_assoc($res);
$message = "";

if(isset($_POST['update'])){
    $name = $_POST['name'];
    $email = $_POST['email'];
    $role = $_POST['role'];

    mysqli_query($conn, "UPDATE users SET name='$name', email='$email', role='$role' WHERE id=$id");

    if(isset($_FILES['profile_pic']) && $_FILES['profile_pic']['name']){
        $profile_name = time()."_".$_FILES['profile_pic']['name'];
        move_uploaded_file($_FILES['profile_pic']['tmp_name'], "../uploads/profiles/".$profile_name);
        mysqli_query($conn, "UPDATE users SET profile_pic='$profile_name' WHERE id=$id");
    }

    if(isset($_FILES['signature']) && $_FILES['signature']['name']){
        $sig_name = time()."_".$_FILES['signature']['name'];
        move_uploaded_file($_FILES['signature']['tmp_name'], "../uploads/signatures/".$sig_name);
        mysqli_query($conn, "UPDATE users SET signature='$sig_name' WHERE id=$id");
    }

    $message = "<div class='alert alert-success'>User updated successfully.</div>";
}
?>

<h4>Edit User</h4>
<?= $message ?>
<form method="POST" enctype="multipart/form-data">
    <input type="text" name="name" value="<?= $user['name'] ?>" class="form-control mb-2" required>
    <input type="email" name="email" value="<?= $user['email'] ?>" class="form-control mb-2" required>
    <select name="role" class="form-select mb-2">
        <option value="student" <?= $user['role']=='student'?'selected':'' ?>>Student</option>
        <option value="faculty" <?= $user['role']=='faculty'?'selected':'' ?>>Faculty</option>
        <option value="admin" <?= $user['role']=='admin'?'selected':'' ?>>Admin</option>
    </select>
    <label>Profile Picture</label>
    <input type="file" name="profile_pic" class="form-control mb-2">
    <label>Signature</label>
    <input type="file" name="signature" class="form-control mb-2">
    <button name="update" class="btn btn-primary">Update User</button>
</form>
