<?php
//profile.php
include("../config/config.php");

// Check admin
if(!isset($_SESSION['user']) || $_SESSION['user']['role'] != 'admin'){
    header("Location: ../auth/login.php");
    exit;
}

$user = $_SESSION['user'];
$message = "";
?>

<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="UTF-8">
<title>Admin Profile</title>

<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
<link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.1/font/bootstrap-icons.css" rel="stylesheet">

<style>
body{
    background:#f5f7fb;
}

.profile-header{
    background:linear-gradient(135deg,#4e73df,#224abe);
    color:white;
    border-radius:14px;
    padding:25px;
}

.profile-card{
    border-radius:18px;
}

.profile-img{
    width:120px;
    height:120px;
    object-fit:cover;
    border-radius:50%;
    border:4px solid #fff;
    box-shadow:0 4px 10px rgba(0,0,0,.15);
}

.signature-img{
    max-width:260px;
    border:1px dashed #ccc;
    padding:10px;
    border-radius:10px;
    background:#fff;
}
</style>
</head>

<body class="container mt-4">

<!-- ===== HEADER ===== -->
<div class="profile-header d-flex justify-content-between align-items-center mb-4">
    <div>
        <h4 class="mb-1">Admin Profile</h4>
        <small>Account Information</small>
    </div>

    <div>
        <a href="../admin/dashboard.php" class="btn btn-light btn-sm me-2">
            <i class="bi bi-arrow-left"></i> Back
        </a>
        <a href="../auth/logout.php" class="btn btn-danger btn-sm">
            <i class="bi bi-box-arrow-right"></i> Logout
        </a>
    </div>
</div>

<?= $message ?>

<!-- ===== PROFILE CARD ===== -->
<div class="card shadow-sm profile-card p-4">
    <div class="card-body text-center">

        <h5 class="fw-bold mb-3"><?= htmlspecialchars($user['name']); ?></h5>
        <p class="text-muted mb-4">Administrator</p>

        <!-- Profile Picture -->
        <div class="mb-4">
            <p class="fw-semibold mb-2">Profile Picture</p>
            <?php if(!empty($user['profile_pic'])): ?>
                <img src="../uploads/profiles/<?= $user['profile_pic'] ?>" class="profile-img">
            <?php else: ?>
                <span class="text-muted">No profile picture uploaded</span>
            <?php endif; ?>
        </div>

        <!-- Signature -->
        <div class="mb-4">
            <p class="fw-semibold mb-2">Signature</p>
            <?php if(!empty($user['signature'])): ?>
                <img src="../uploads/signatures/<?= $user['signature'] ?>" class="signature-img">
            <?php else: ?>
                <span class="text-muted">No signature uploaded</span>
            <?php endif; ?>
        </div>

        <hr class="my-4">

        <!-- Action Button -->
        <a href="update_profile.php" class="btn btn-primary px-4">
            <i class="bi bi-pencil-square"></i> Update Profile
        </a>

    </div>
</div>

</body>
</html>
