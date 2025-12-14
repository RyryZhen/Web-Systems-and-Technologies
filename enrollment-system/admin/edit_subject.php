<?php
//admin/edit_subject.php
include("../config/config.php");

if(!isset($_SESSION['user']) || $_SESSION['user']['role'] != 'admin'){
    header("Location: ../auth/login.php");
    exit;
}

$id = (int)$_GET['id'];
$res = mysqli_query($conn, "SELECT * FROM subjects WHERE id=$id");
$subject = mysqli_fetch_assoc($res);
$message = "";

if(isset($_POST['update'])){
    $code = $_POST['code'];
    $name = $_POST['name'];
    mysqli_query($conn, "UPDATE subjects SET code='$code', name='$name' WHERE id=$id");

    // Update prerequisites
    mysqli_query($conn, "DELETE FROM prerequisites WHERE subject_id=$id");
    if(isset($_POST['prerequisites'])){
        foreach($_POST['prerequisites'] as $pre){
            mysqli_query($conn, "INSERT INTO prerequisites(subject_id, prerequisite_id) VALUES($id,$pre)");
        }
    }
    $message = "<div class='alert alert-success'>Subject updated successfully.</div>";
}

$all_subjects = mysqli_query($conn, "SELECT * FROM subjects WHERE id != $id");
$subject_prereqs = [];
$preq = mysqli_query($conn, "SELECT prerequisite_id FROM prerequisites WHERE subject_id=$id");
while($p = mysqli_fetch_assoc($preq)){
    $subject_prereqs[] = $p['prerequisite_id'];
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="UTF-8">
<title>Edit Subject</title>
<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
<link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.1/font/bootstrap-icons.css" rel="stylesheet">
<style>
body {
    background: #eef2f7;
    font-family: 'Segoe UI', sans-serif;
}

.container {
    max-width: 700px;
    margin-top: 50px;
}

.card {
    border-radius: 12px;
    box-shadow: 0 6px 18px rgba(0,0,0,0.06);
    padding: 25px;
}

.card h4 {
    color: #4e73df;
    margin-bottom: 20px;
    font-weight: 600;
}

.form-control, .form-select {
    border-radius: 8px;
    padding: 10px 12px;
}

.btn-custom {
    border-radius: 8px;
    padding: 8px 20px;
    font-weight: 500;
}

.alert {
    border-radius: 8px;
}
</style>
</head>
<body>
<div class="container">

    <div class="card">
       <div class="d-flex justify-content-between align-items-center mb-3">
    <h4>Edit Subject</h4>
    <a href="manage_subjects.php" class="btn btn-outline-secondary btn-sm">
        <i class="bi bi-arrow-left"></i> Back
    </a>
</div>
        <?= $message ?>
        <form method="POST">
            <div class="mb-3">
                <label class="form-label">Subject Code</label>
                <input type="text" name="code" value="<?= htmlspecialchars($subject['code']) ?>" required class="form-control">
            </div>

            <div class="mb-3">
                <label class="form-label">Subject Name</label>
                <input type="text" name="name" value="<?= htmlspecialchars($subject['name']) ?>" required class="form-control">
            </div>

            <div class="mb-3">
                <label class="form-label">Prerequisites</label>
                <select multiple name="prerequisites[]" class="form-select">
                    <?php while($s = mysqli_fetch_assoc($all_subjects)): ?>
                        <option value="<?= $s['id'] ?>" <?= in_array($s['id'], $subject_prereqs) ? 'selected':'' ?>>
                            <?= htmlspecialchars($s['code']) ?> - <?= htmlspecialchars($s['name']) ?>
                        </option>
                    <?php endwhile; ?>
                </select>
                <small class="text-muted">Hold Ctrl (Cmd on Mac) to select multiple.</small>
            </div>

            <div class="d-grid">
                <button class="btn btn-primary btn-custom" name="update">
                    <i class="bi bi-save"></i> Update Subject
                </button>
            </div>
        </form>
    </div>

</div>
</body>
</html>
