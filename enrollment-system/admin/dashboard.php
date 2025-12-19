<?php
//admin/dashboard.php
include("../config/config.php");

if (!isset($_SESSION['user']) || $_SESSION['user']['role'] !== 'admin') {
   header("Location: ../auth/login.php");
    exit;
}

$user = $_SESSION['user'];
?>

<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="UTF-8">
<title>Admin Dashboard</title>

<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
<link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.1/font/bootstrap-icons.css" rel="stylesheet">

<style>
body {
    background: #f5f7fb;
}

.dashboard-header {
    background: linear-gradient(135deg, #4e73df, #224abe);
    color: #fff;
    padding: 25px;
    border-radius: 12px;
}

.dashboard-card {
    border-radius: 16px;
    transition: 0.3s ease;
}

.dashboard-card:hover {
    transform: translateY(-5px);
    box-shadow: 0 10px 25px rgba(0,0,0,0.1);
}

.icon-box {
    width: 55px;
    height: 55px;
    border-radius: 12px;
    display: flex;
    align-items: center;
    justify-content: center;
    font-size: 1.5rem;
}
</style>
</head>

<body class="container mt-4">

<!-- ===== HEADER ===== -->
<div class="dashboard-header d-flex justify-content-between align-items-center mb-4">
    <div>
        <h3 class="mb-1">Admin Dashboard</h3>
        <small>System Administration Panel</small>
    </div>

    <a href="../auth/logout.php" class="btn btn-light">
        <i class="bi bi-box-arrow-right"></i> Logout
    </a>
</div>

<!-- ===== WELCOME CARD ===== -->
<div class="card shadow-sm mb-4 dashboard-card">
    <div class="card-body">
        <h4 class="mb-2">Welcome, <?= htmlspecialchars($user['name']); ?> 👋</h4>
        <p class="text-muted mb-0">
            You are logged in as <strong>Administrator</strong>. Use the tools below to manage the system.
        </p>
    </div>
</div>

<!-- ===== ACTION CARDS ===== -->
<div class="row g-4">

    <div class="col-md-4">
        <div class="card dashboard-card shadow-sm h-100">
            <div class="card-body d-flex align-items-center">
                <div class="icon-box bg-primary text-white me-3">
                    <i class="bi bi-book"></i>
                </div>
                <div>
                    <h6 class="mb-1">Manage Subjects</h6>
                    <p class="text-muted small mb-2">
                        Add subjects, assign faculty, and manage prerequisites.
                    </p>
                    <a href="manage_subjects.php" class="btn btn-sm btn-primary">
                        Open
                    </a>
                </div>
            </div>
        </div>
    </div>

    <div class="col-md-4">
        <div class="card dashboard-card shadow-sm h-100">
            <div class="card-body d-flex align-items-center">
                <div class="icon-box bg-success text-white me-3">
                    <i class="bi bi-people"></i>
                </div>
                <div>
                    <h6 class="mb-1">Manage Users</h6>
                    <p class="text-muted small mb-2">
                        View, edit, and manage system users.
                    </p>
                    <a href="manage_users.php" class="btn btn-sm btn-success">
                        Open
                    </a>
                </div>
            </div>
        </div>
    </div>

    <div class="col-md-4">
        <div class="card dashboard-card shadow-sm h-100">
            <div class="card-body d-flex align-items-center">
                <div class="icon-box bg-warning text-dark me-3">
                    <i class="bi bi-person-circle"></i>
                </div>
                <div>
                    <h6 class="mb-1">Profile</h6>
                    <p class="text-muted small mb-2">
                        Update your admin profile and credentials.
                    </p>
                    <a href="profile.php" class="btn btn-sm btn-warning">
                        Open
                    </a>
                </div>
            </div>
        </div>
    </div>

</div>

</body>
</html>
