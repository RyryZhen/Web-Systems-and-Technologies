<?php
// admin/header.php - shared admin navigation
// Assumes session is started and $_SESSION['user'] is available
if (!isset($_SESSION)) session_start();
$adminName = $_SESSION['user']['full_name'] ?? 'Admin';
?>

<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="UTF-8">
<title>Admin Panel</title>

<style>
/* =========================
   GLOBAL RESET
========================= */
* {
  box-sizing: border-box;
  margin: 0;
  padding: 0;
}

/* =========================
   BODY
========================= */
body {
  font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
  background-color: #f0f2f5;
  padding-top: 80px; /* space for fixed navbar */
}

/* =========================
   TOP NAVBAR
========================= */
nav.top-navbar {
  position: fixed;
  top: 0;
  left: 0;
  width: 100%;
  min-height: 80px;
  background-color: #ffffff;
  display: flex;
  align-items: center;
  justify-content: space-between;
  padding: 0 1.5rem;
  box-shadow: 0 6px 20px rgba(15, 23, 42, 0.1);
  z-index: 1000;
}

/* Admin name */
.nav-brand {
  font-weight: 700;
  font-size: 1rem;
  color: #0f172a;
  white-space: nowrap;
}

/* Nav links container */
.nav-links {
  display: flex;
  gap: 0.5rem;
  flex-wrap: wrap;
  justify-content: flex-end;
}

/* Nav links */
.nav-links a {
  text-decoration: none;
  background-color: #CFE7F3;
  color: #0f172a;
  padding: 0.45rem 0.75rem;
  border-radius: 8px;
  font-weight: 600;
  font-size: 0.85rem;
  box-shadow: 0 4px 10px rgba(15, 23, 42, 0.08);
  transition: transform 0.15s ease, box-shadow 0.15s ease;
  text-align: center;
  white-space: nowrap;
}

.nav-links a:hover {
  transform: translateY(-2px);
  box-shadow: 0 8px 18px rgba(15, 23, 42, 0.15);
}

/* Logout emphasis */
.nav-links a.logout {
  background-color: #fde68a;
  color: #78350f;
}

/* =========================
   MAIN CONTENT
========================= */
main {
  padding: 2rem;
  max-width: 1200px;
  margin: auto;
}

main h2,
main h3 {
  color: #333;
}

/* =========================
   FORMS
========================= */
form {
  margin: 1rem 0 2rem 0;
  display: flex;
  flex-direction: column;
  gap: 0.5rem;
}

form input[type="file"],
form button {
  padding: 0.5rem;
  font-size: 1rem;
}

form button {
  width: fit-content;
  background-color: #ffd700;
  border: none;
  border-radius: 6px;
  cursor: pointer;
  font-weight: bold;
  box-shadow: 0 4px 6px rgba(0, 0, 0, 0.2);
  transition: transform 0.1s, box-shadow 0.2s;
}

form button:hover {
  transform: translateY(-2px);
  box-shadow: 0 6px 10px rgba(0, 0, 0, 0.3);
}

/* =========================
   TABLES
========================= */
table {
  width: 100%;
  border-collapse: collapse;
  background-color: #fff;
  border-radius: 8px;
  overflow: hidden;
  box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
}

th,
td {
  padding: 0.75rem;
  text-align: left;
}

th {
  background-color: #CFE7F3;
  color: #0f172a;
  font-weight: 700;
}

tr:nth-child(even) {
  background-color: #f7f7f7;
}

tr:hover {
  background-color: #e0e7ff;
}

/* =========================
   IMAGES
========================= */
img {
  border-radius: 6px;
}

/* =========================
   RESPONSIVE
========================= */
@media (max-width: 900px) {
  nav.top-navbar {
    flex-direction: column;
    align-items: flex-start;
    padding: 0.75rem;
    gap: 0.5rem;
  }

  body {
    padding-top: 140px;
  }

  .nav-links {
    justify-content: center;
    width: 100%;
  }

  .nav-links a {
    width: 100%;
  }
}
</style>
</head>

<body>

<!-- =========================
     TOP NAVBAR
========================= -->
<nav class="top-navbar">
  <span class="nav-brand">
    <?= htmlspecialchars($adminName); ?>
  </span>

  <div class="nav-links">
    <a href="dashboard.php">Dashboard</a>
    <a href="users.php">Manage Users</a>
    <a href="departments.php">Manage Departments</a>
    <a href="programs.php">Manage Programs</a>
    <a href="theses.php">Approve Theses</a>
    <a href="archives.php">Archives</a>
    <a href="activity_logs.php">Activity Logs</a>
    <a href="backup.php">Backup & Restore</a>
    <a href="export.php">Export Reports</a>
    <a href="profile.php">Profile</a>
    <a href="../auth/logout.php" class="logout">Logout</a>
  </div>
</nav>
