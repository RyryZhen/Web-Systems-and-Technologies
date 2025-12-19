<?php
include("../config/config.php");

// Check admin
// if(!isset($_SESSION['user']) || $_SESSION['user']['role'] != 'admin'){
//     header("Location: ../auth/login.php");
//     exit;
// }

$user = $_SESSION['user'];
$message = "";

if(isset($_POST['add_subject'])){
    $code = mysqli_real_escape_string($conn, $_POST['code']);
    $name = mysqli_real_escape_string($conn, $_POST['name']);

    $check = mysqli_query($conn, "SELECT * FROM subjects WHERE code='$code'");
    if(mysqli_num_rows($check) == 0){
        mysqli_query($conn, "INSERT INTO subjects (code, name) VALUES ('$code', '$name')");
        $message = "<div class='alert alert-success'>Subject added successfully.</div>";
    } else {
        $message = "<div class='alert alert-warning'>Subject code already exists.</div>";
    }
}

if(isset($_POST['assign_faculty'])){
    $subject_id = (int)$_POST['subject_id'];
    $faculty_id = (int)$_POST['faculty_id'];

    $check = mysqli_query($conn, "SELECT * FROM subject_faculty WHERE subject_id=$subject_id");
    if(mysqli_num_rows($check) > 0){
        mysqli_query($conn, "UPDATE subject_faculty SET faculty_id=$faculty_id WHERE subject_id=$subject_id");
    } else {
        mysqli_query($conn, "INSERT INTO subject_faculty(subject_id, faculty_id) VALUES($subject_id, $faculty_id)");
    }

    $message = "<div class='alert alert-success'>Faculty assigned successfully!</div>";
}

if(isset($_POST['assign_prerequisite'])){
    $subject_id = (int)$_POST['subject_id'];
    $prereq_id  = (int)$_POST['prerequisite_id'];

    if($subject_id === $prereq_id){
        $message = "<div class='alert alert-danger'>A subject cannot be its own prerequisite.</div>";
    } else {
        $check = mysqli_query($conn,"SELECT * FROM prerequisites WHERE subject_id=$subject_id AND prerequisite_id=$prereq_id");
        if(mysqli_num_rows($check) == 0){
            mysqli_query($conn,"INSERT INTO prerequisites(subject_id, prerequisite_id) VALUES($subject_id, $prereq_id)");
            $message = "<div class='alert alert-success'>Prerequisite assigned successfully.</div>";
        } else {
            $message = "<div class='alert alert-warning'>Prerequisite already exists.</div>";
        }
    }
}

$subject_result = mysqli_query($conn, "
    SELECT s.id, s.code, s.name, f.name AS faculty_name, f.id AS faculty_id, GROUP_CONCAT(p.prerequisite_id) AS prereqs
    FROM subjects s
    LEFT JOIN subject_faculty sf ON s.id = sf.subject_id
    LEFT JOIN users f ON sf.faculty_id = f.id AND f.role='faculty'
    LEFT JOIN prerequisites p ON s.id = p.subject_id
    GROUP BY s.id
");

$subjects = [];
while($row = mysqli_fetch_assoc($subject_result)){
    $subjects[] = $row;
}

$faculties = mysqli_query($conn, "SELECT id, name FROM users WHERE role='faculty'");
?>
<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="UTF-8">
<title>Admin – Subjects</title>
<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
<link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.1/font/bootstrap-icons.css" rel="stylesheet">
<style>
body { 
    background: #eef2f7; 
    font-family: 'Segoe UI', sans-serif;
}

.page-header {
    background: #4e73df;
    color: #fff;
    border-radius: 12px;
    padding: 25px 30px;
    box-shadow: 0 6px 15px rgba(0,0,0,0.1);
    margin-bottom: 30px;
}

.page-header h4 {
    margin-bottom: 0.2rem;
    font-weight: 600;
}

.card {
    border-radius: 12px;
    box-shadow: 0 6px 18px rgba(0,0,0,0.06);
    margin-bottom: 25px;
}

.card h6 {
    font-weight: 600;
    color: #4e73df;
}

.btn-custom {
    border-radius: 8px;
    padding: 6px 16px;
}

.table thead {
    background: #f8f9fc;
    border-bottom: 2px solid #dee2e6;
}

.table th, .table td {
    vertical-align: middle;
}

.table-hover tbody tr:hover {
    background: #f1f3f8;
}

.action-btns a {
    margin-right: 6px;
    border-radius: 6px;
    font-size: 0.85rem;
}

</style>
</head>
<body>

<div class="container py-4">

    <!-- Header -->
    <div class="page-header d-flex justify-content-between align-items-center">
        <div>
            <h4>Admin Dashboard</h4>
            <small>Welcome, <?= htmlspecialchars($user['name']); ?></small>
        </div>
        <div>
            <a href="dashboard.php" class="btn btn-light btn-sm me-2">
                <i class="bi bi-arrow-left"></i> Back
            </a>
            <a href="../auth/logout.php" class="btn btn-danger btn-sm">
                <i class="bi bi-box-arrow-right"></i> Logout
            </a>
        </div>
    </div>

    <?= $message ?>

    <!-- Add Subject -->
    <div class="card">
        <div class="card-body">
            <h6>Add Subject</h6>
            <form method="POST" class="row g-3">
                <div class="col-md-3">
                    <input type="text" name="code" class="form-control" placeholder="Subject Code" required>
                </div>
                <div class="col-md-7">
                    <input type="text" name="name" class="form-control" placeholder="Subject Name" required>
                </div>
                <div class="col-md-2 d-grid">
                    <button name="add_subject" class="btn btn-success btn-custom">
                        <i class="bi bi-plus-lg"></i> Add
                    </button>
                </div>
            </form>
        </div>
    </div>

    <!-- Assign Faculty -->
    <div class="card">
        <div class="card-body">
            <h6>Assign Faculty</h6>
            <form method="POST" class="row g-3">
                <div class="col-md-5">
                    <select name="subject_id" class="form-select" required>
                        <option value="">Select Subject</option>
                        <?php foreach($subjects as $s): ?>
                            <option value="<?= $s['id'] ?>"><?= $s['code'] ?> – <?= $s['name'] ?> (<?= $s['faculty_name'] ?? 'No faculty' ?>)</option>
                        <?php endforeach; ?>
                    </select>
                </div>
                <div class="col-md-5">
                    <select name="faculty_id" class="form-select" required>
                        <option value="">Select Faculty</option>
                        <?php while($f = mysqli_fetch_assoc($faculties)): ?>
                            <option value="<?= $f['id'] ?>"><?= $f['name'] ?></option>
                        <?php endwhile; ?>
                    </select>
                </div>
                <div class="col-md-2 d-grid">
                    <button name="assign_faculty" class="btn btn-primary btn-custom">
                        <i class="bi bi-person-plus"></i> Assign
                    </button>
                </div>
            </form>
        </div>
    </div>

    <!-- Assign Prerequisite -->
    <div class="card">
        <div class="card-body">
            <h6>Assign Prerequisite</h6>
            <form method="POST" class="row g-3">
                <div class="col-md-5">
                    <select name="subject_id" class="form-select" required>
                        <option value="">Select Subject</option>
                        <?php foreach($subjects as $s): ?>
                            <option value="<?= $s['id'] ?>"><?= $s['code'] ?> – <?= $s['name'] ?></option>
                        <?php endforeach; ?>
                    </select>
                </div>
                <div class="col-md-5">
                    <select name="prerequisite_id" class="form-select" required>
                        <option value="">Select Prerequisite</option>
                        <?php foreach($subjects as $s): ?>
                            <option value="<?= $s['id'] ?>"><?= $s['code'] ?> – <?= $s['name'] ?></option>
                        <?php endforeach; ?>
                    </select>
                </div>
                <div class="col-md-2 d-grid">
                    <button name="assign_prerequisite" class="btn btn-warning btn-custom">
                        <i class="bi bi-bookmark-plus"></i> Assign
                    </button>
                </div>
            </form>
        </div>
    </div>

    <!-- Subjects Table -->
    <div class="card">
        <div class="card-body p-0">
            <div class="table-responsive">
                <table class="table table-hover align-middle mb-0">
                    <thead class="table-light">
                        <tr>
                            <th>Code</th>
                            <th>Name</th>
                            <th>Faculty</th>
                            <th>Prerequisites</th>
                            <th class="text-end">Actions</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php foreach($subjects as $s): ?>
                            <tr>
                                <td><?= $s['code'] ?></td>
                                <td><?= $s['name'] ?></td>
                                <td><?= $s['faculty_name'] ?? '<span class="text-muted">None</span>' ?></td>
                                <td>
                                    <?php
                                    if($s['prereqs']){
                                        $ids = explode(',', $s['prereqs']);
                                        $codes = [];
                                        foreach($ids as $pid){
                                            $r = mysqli_query($conn, "SELECT code FROM subjects WHERE id=$pid");
                                            $codes[] = mysqli_fetch_assoc($r)['code'];
                                        }
                                        echo implode(', ', $codes);
                                    } else {
                                        echo '<span class="text-muted">—</span>';
                                    }
                                    ?>
                                </td>
                                <td class="text-end action-btns">
                                    <a href="edit_subject.php?id=<?= $s['id'] ?>" class="btn btn-outline-primary btn-sm">
                                        <i class="bi bi-pencil"></i> Edit
                                    </a>
                                    <a href="delete_subject.php?id=<?= $s['id'] ?>" class="btn btn-outline-danger btn-sm"
                                       onclick="return confirm('Delete this subject?')">
                                        <i class="bi bi-trash"></i> Delete
                                    </a>
                                </td>
                            </tr>
                        <?php endforeach; ?>
                    </tbody>
                </table>
            </div>
        </div>
    </div>

</div>

</body>
</html>
