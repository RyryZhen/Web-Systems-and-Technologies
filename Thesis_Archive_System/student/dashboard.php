<?php
include("../config/db.php"); // Make sure this starts session and connects DB

// Check if student is logged in
if (!isset($_SESSION['user']) || $_SESSION['user']['role'] !== 'student') {
    header("Location: ../auth/login.php");
    exit;
}

$student = $_SESSION['user'];

// Shared profile upload handlers (so inline form posts are handled)
// include_once(__DIR__ . '/profile_actions.php');

?>

<!DOCTYPE html>
<html>

<head>
    <title>Student Dashboard</title>
    <?php include('header.php') ?>
    <link rel="stylesheet" type="text/css" href="../style.css">
</head>

<body>


    <main>
        <h1 class="welcome-title">Welcome, <?= htmlspecialchars($student['full_name']); ?></h1>
        <h2>Student Dashboard</h2>


        <div class="profile-card">
            <div class="profile-section compact-profile">
                <?php if (!empty($student['profile_picture'])): ?>
                    <img src="../uploads/profiles/<?= htmlspecialchars($student['profile_picture']); ?>" alt="Profile" class="profile-pic">
                <?php else: ?>
                    <div class="profile-placeholder">No Profile Picture</div>
                <?php endif; ?>

                <?php if (!empty($student['signature'])): ?>
                    <img src="../uploads/signatures/<?= htmlspecialchars($student['signature']); ?>" alt="Signature" class="signature-img" style="margin-top:1rem;">
                <?php else: ?>
                    <div class="profile-placeholder" style="margin-top:1rem;">No Signature</div>
                <?php endif; ?>

                <p style="margin-top:1rem;"><a href="profile.php"><button class="upload-btn">Update Profile</button></a></p>
            </div>
        </div>

        <hr>

        <!-- Thesis Submissions -->
        <h3>My Thesis Submissions</h3>

        <?php
        // Fetch student's submissions (use JOINs and check for DB errors)
        $author_id = (int)$student['user_id'];
        $sql = "SELECT t.*, d.department_name, p.program_name,\n    (SELECT decision FROM approvals a WHERE a.thesis_id=t.thesis_id ORDER BY a.decision_date DESC LIMIT 1) AS approval_status\n    FROM theses t\n    LEFT JOIN departments d ON t.department_id = d.department_id\n    LEFT JOIN programs p ON t.program_id = p.program_id\n    WHERE t.author_id = {$author_id}\n    ORDER BY t.thesis_id DESC";
        $theses = mysqli_query($conn, $sql);
        if (!$theses) {
            error_log('DB error (student/dashboard.php): ' . mysqli_error($conn) . ' -- SQL: ' . $sql);
            echo '<p class="error">Unable to load your submissions. Please contact the administrator.</p>';
            $theses = null; // avoid passing bool to fetch functions
        }
        ?>

        <table>
            <tr>
                <th>ID</th>
                <th>Title</th>
                <th>Department</th>
                <th>Program</th>
                <th>Status</th>
                <th>Actions</th>
            </tr>
            <?php if ($theses): while ($t = mysqli_fetch_assoc($theses)): ?>
                    <tr>
                        <td><?= $t['thesis_id']; ?></td>
                        <td><?= htmlspecialchars($t['title']); ?></td>
                        <td><?= htmlspecialchars($t['department_name'] ?? ''); ?></td>
                        <td><?= htmlspecialchars($t['program_name'] ?? ''); ?></td>
                        <td><?= htmlspecialchars($t['approval_status'] ?? 'Pending'); ?></td>
                        <td>
                            <!-- Links to update or view files -->
                            <a href="edit_thesis.php?id=<?= $t['thesis_id']; ?>">Edit</a> |
                            <a href="view_thesis.php?id=<?= $t['thesis_id']; ?>">View Files</a>
                        </td>
                    </tr>
                <?php endwhile;
            else: ?>
                <tr>
                    <td colspan="6">No submissions found.</td>
                </tr>
            <?php endif; ?>
        </table>

        <hr>

        <!-- Notes for integration -->
        <!--
1. submit.php: page to upload new thesis + metadata (title, abstract, keywords, department, program, adviser)
2. edit_thesis.php: page to update submission before approval
3. view_thesis.php: list all files uploaded for this thesis, allow download
4. Ensure proper validation for file types, sizes, and store in `files` table
5. Optional: implement search/filter by title, year, adviser for own submissions
6. Log all actions in activity_logs table
-->
    </main>
</body>

</html>