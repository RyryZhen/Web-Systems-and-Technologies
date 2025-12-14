<?php
include("../config/config.php");

// Redirect if not student
if(!isset($_SESSION['user']) || $_SESSION['user']['role'] != 'student'){
    header("Location: ../auth/login.php");
    exit;
}


$user = $_SESSION['user'];
$student_id = $user['id'];

$message = "";


// Handle Enrollment
if(isset($_POST['enroll'])){
    $subject_id = (int)$_POST['subject_id'];

    // Check if a faculty is assigned to this subject
    $faculty_check = mysqli_query($conn, "SELECT faculty_id FROM subject_faculty WHERE subject_id=$subject_id");
    $faculty_row = mysqli_fetch_assoc($faculty_check);

    if(!$faculty_row || !$faculty_row['faculty_id']){
        // No faculty assigned
        $message = "<div class='alert alert-warning'>Cannot enroll: No instructor assigned for this subject yet.</div>";
    } else {
        // Check if already enrolled
        $check_existing = mysqli_query($conn, "SELECT * FROM enrollments WHERE student_id=$student_id AND subject_id=$subject_id");
        if(mysqli_num_rows($check_existing) > 0){
            $message = "<div class='alert alert-warning'>You are already enrolled in this subject.</div>";
        } else {
            // Check prerequisites
            $pre = mysqli_query($conn, "SELECT prerequisite_id FROM prerequisites WHERE subject_id=$subject_id");
            $can_enroll = true;
            while($p = mysqli_fetch_assoc($pre)){
                $prereq_id = $p['prerequisite_id'];
                $check = mysqli_query($conn, "SELECT * FROM enrollments WHERE student_id=$student_id AND subject_id=$prereq_id AND status='completed'");
                if(mysqli_num_rows($check) == 0){
                    $can_enroll = false;
                    $prereq_sub = mysqli_query($conn, "SELECT code FROM subjects WHERE id=$prereq_id");
                    $prereq_code = mysqli_fetch_assoc($prereq_sub)['code'];
                    $message = "<div class='alert alert-danger'>Cannot enroll: prerequisite {$prereq_code} not completed.</div>";
                    break;
                }
            }

            if($can_enroll){
                mysqli_query($conn, "INSERT INTO enrollments(student_id, subject_id, status) VALUES($student_id, $subject_id, 'enrolled')");
                $message = "<div class='alert alert-success'>Successfully enrolled in the subject.</div>";
            }
        }
    }
}


// Fetch all subjects
$all_subjects = mysqli_query($conn, "
    SELECT * FROM subjects 
    WHERE id NOT IN (
        SELECT subject_id FROM enrollments WHERE student_id=$student_id
    )
    ORDER BY code ASC
");

// Fetch enrolled subjects
$enrolled = mysqli_query($conn, "
    SELECT s.code, s.name, e.status, e.grade
    FROM enrollments e
    JOIN subjects s ON e.subject_id = s.id
    WHERE e.student_id=$student_id
    ORDER BY s.code ASC
");



?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Student Dashboard</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body class="container mt-4">

<div class="d-flex justify-content-between align-items-center mb-3">
    <h3>Welcome, <?= htmlspecialchars($user['name']); ?></h3>
    <div>
        <img src="../uploads/profiles/<?= $user['profile_pic']; ?>" width="50" height="50" class="rounded-circle">
        <a href="../auth/logout.php" class="btn btn-danger ms-2">Logout</a>
    </div>
</div>

<h4>Enroll in Subject</h4>
<form method="POST" class="row g-2 mb-3">
    <div class="col-md-8">
    <input list="subject_list" name="subject_id" class="form-control" placeholder="Select or type subject" required>
    <datalist id="subject_list">
        <?php 
        mysqli_data_seek($all_subjects, 0); // reset pointer if already iterated
        while($s = mysqli_fetch_assoc($all_subjects)): ?>
            <option value="<?= $s['id'] ?>"><?= $s['code'] ?> - <?= $s['name'] ?></option>
        <?php endwhile; ?>
    </datalist>
</div>

    <div class="col-md-2">
        <button class="btn btn-primary" name="enroll">Enroll</button>
    </div>
</form>


<?= $message ?>

<hr>
<h4>My Enrolled Subjects</h4>
<table class="table table-bordered table-hover">
    <thead class="table-dark">
        <tr>
            <th>Code</th>
            <th>Description</th>
            <th>Status</th>
            <th>Grade</th>
        </tr>
    </thead>
    <tbody>
    <?php while($row = mysqli_fetch_assoc($enrolled)): ?>
        <tr>
            <td><?= $row['code']; ?></td>
            <td><?= $row['name']; ?></td>
           <td>
    <?php if($row['status']=='enrolled'): ?>
        <span class="badge bg-warning text-dark">Enrolled</span>
    <?php else: ?>
        <span class="badge bg-success">Completed</span>
    <?php endif; ?>
</td>
<td>
    <?= $row['grade'] ?? '-' ?>
</td>

        </tr>
    <?php endwhile; ?>
    </tbody>
</table>

</body>
</html>
