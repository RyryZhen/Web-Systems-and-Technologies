<?php
//admin/manage_users.php
include("../config/config.php");

// Check admin
if(!isset($_SESSION['user']) || $_SESSION['user']['role'] != 'admin'){
    header("Location: ../auth/login.php");
    exit;

    include("../config/config.php");



if(!isset($_GET['id'])){
    header("Location: manage_users.php");
    exit;
}

$id = (int)$_GET['id'];

// Delete user
mysqli_query($conn, "DELETE FROM users WHERE id=$id");

// Redirect back to user management
header("Location: manage_users.php?deleted=1");
exit;
}

$user = $_SESSION['user'];
$message = "";

// Handle search and filter
$search = $_GET['search'] ?? '';
$role_filter = $_GET['role'] ?? '';

// Build query dynamically
$query = "SELECT * FROM users WHERE 1";

if(!empty($search)){
    $search_safe = mysqli_real_escape_string($conn, $search);
    $query .= " AND (name LIKE '%$search_safe%' OR email LIKE '%$search_safe%')";
}

if(!empty($role_filter)){
    $role_safe = mysqli_real_escape_string($conn, $role_filter);
    $query .= " AND role='$role_safe'";
}

$query .= " ORDER BY role, name ASC";
$users = mysqli_query($conn, $query);
?>

<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="UTF-8">
<title>User Management</title>

<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
<link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.1/font/bootstrap-icons.css" rel="stylesheet">

<style>
body{
    background:#f5f7fb;
}

.page-header{
    background:linear-gradient(135deg,#1cc88a,#17a673);
    color:#fff;
    border-radius:16px;
    padding:24px;
}

.card{
    border-radius:16px;
}

.avatar{
    width:45px;
    height:45px;
    object-fit:cover;
    border-radius:50%;
    border:2px solid #dee2e6;
}

.signature{
    max-width:70px;
    border-radius:8px;
}

.table th{
    white-space:nowrap;
}
</style>
</head>

<body class="container mt-4">

<!-- ===== HEADER ===== -->
<div class="page-header d-flex justify-content-between align-items-center mb-4">
    <div>
        <h4 class="mb-1">User Management</h4>
        <small>Welcome, <?= htmlspecialchars($user['name']); ?> (Admin)</small>
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

<!-- ===== SEARCH & FILTER ===== -->
<div class="card shadow-sm mb-4">
    <div class="card-body">
        <form method="GET" class="row g-2 align-items-end">
            <div class="col-md-4">
                <label class="form-label">Search</label>
                <input type="text" name="search" class="form-control"
                       placeholder="Name or Email"
                       value="<?= htmlspecialchars($search) ?>">
            </div>

            <div class="col-md-3">
                <label class="form-label">Role</label>
                <select name="role" class="form-select">
                    <option value="">All Roles</option>
                    <option value="student" <?= $role_filter=='student'?'selected':'' ?>>Student</option>
                    <option value="faculty" <?= $role_filter=='faculty'?'selected':'' ?>>Faculty</option>
                    <option value="admin" <?= $role_filter=='admin'?'selected':'' ?>>Admin</option>
                </select>
            </div>

            <div class="col-md-2">
                <button class="btn btn-success w-100">
                    <i class="bi bi-search"></i> Search
                </button>
            </div>
        </form>
    </div>
</div>

<!-- ===== USERS TABLE ===== -->
<div class="card shadow-sm">
    <div class="card-body">
        <div class="table-responsive">
            <table class="table table-hover align-middle">
                <thead class="table-light">
                    <tr>
                        <th>Name</th>
                        <th>Email</th>
                        <th>Role</th>
                        <th>Profile</th>
                        <th>Signature</th>
                        <th class="text-center">Actions</th>
                    </tr>
                </thead>
                <tbody>
                <?php while($u = mysqli_fetch_assoc($users)): ?>
                    <tr>
                        <td class="fw-semibold"><?= htmlspecialchars($u['name']) ?></td>
                        <td><?= $u['email'] ?></td>
                        <td>
                            <span class="badge bg-secondary text-capitalize">
                                <?= $u['role'] ?>
                            </span>
                        </td>

                        <td>
                            <?php if(!empty($u['profile_pic'])): ?>
                                <img src="../uploads/profiles/<?= $u['profile_pic'] ?>" class="avatar">
                            <?php else: ?>
                                <span class="text-muted">N/A</span>
                            <?php endif; ?>
                        </td>

                        <td>
                            <?php if(!empty($u['signature'])): ?>
                                <img src="../uploads/signatures/<?= $u['signature'] ?>" class="signature">
                            <?php else: ?>
                                <span class="text-muted">N/A</span>
                            <?php endif; ?>
                        </td>

                        <td class="text-center">
                            <a href="edit_user.php?id=<?= $u['id'] ?>" class="btn btn-sm btn-outline-primary">
                                <i class="bi bi-pencil"></i>
                            </a>
                            <a href="delete_user.php?id=<?= $u['id'] ?>"
                               class="btn btn-sm btn-outline-danger"
                               onclick="return confirm('Delete this user?')">
                                <i class="bi bi-trash"></i>
                            </a>
                        </td>
                    </tr>
                <?php endwhile; ?>
                </tbody>
            </table>
        </div>
    </div>
</div>

</body>
</html>
