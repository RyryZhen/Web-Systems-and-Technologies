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
  font-family: "Segoe UI", Tahoma, Geneva, Verdana, sans-serif;
  background-color: #f8fafc;
  padding-top: 72px; /* space for fixed navbar */
}

/* =========================
   TOP NAVBAR
========================= */
nav.top-navbar {
  position: fixed;
  top: 0;
  left: 0;
  width: 100%;
  height: 72px;
  background-color: #ffffff;
  display: flex;
  align-items: center;
  justify-content: space-between;
  padding: 0 1.75rem;
  box-shadow: 0 6px 20px rgba(15, 23, 42, 0.08);
  z-index: 1000;
}

/* Admin name */
.nav-brand {
  font-size: 1rem;
  font-weight: 700;
  color: #0f172a;
}

/* Nav links container */
.nav-links {
  display: flex;
  gap: 0.75rem;
}

/* Nav buttons */
.nav-links a {
  text-decoration: none;
  background-color: #eaf2ff;
  color: #0f172a;
  padding: 0.5rem 1rem;
  border-radius: 8px;
  font-weight: 600;
  font-size: 0.95rem;
  box-shadow: 0 4px 12px rgba(15, 23, 42, 0.08);
  transition: transform 0.15s ease, box-shadow 0.15s ease;
}

.nav-links a:hover {
  transform: translateY(-2px);
  box-shadow: 0 10px 22px rgba(15, 23, 42, 0.14);
}

/* Logout button */
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
  color: #0f172a;
}

/* =========================
   FORMS
========================= */
form {
  margin: 1rem 0 2rem 0;
  display: flex;
  flex-direction: column;
  gap: 0.6rem;
}

form input[type="file"],
form button {
  padding: 0.6rem;
  font-size: 0.95rem;
}

form button {
  width: fit-content;
  background-color: #3b82f6;
  color: #ffffff;
  border: none;
  border-radius: 8px;
  cursor: pointer;
  font-weight: 700;
  box-shadow: 0 6px 18px rgba(15, 23, 42, 0.12);
  transition: transform 0.15s ease, box-shadow 0.15s ease;
}

form button:hover {
  transform: translateY(-2px);
  box-shadow: 0 10px 26px rgba(15, 23, 42, 0.18);
}

/* =========================
   TABLES
========================= */
table {
  width: 100%;
  border-collapse: collapse;
  background-color: #ffffff;
  border-radius: 12px;
  overflow: hidden;
  box-shadow: 0 8px 24px rgba(15, 23, 42, 0.06);
}

th,
td {
  padding: 0.75rem;
  text-align: left;
}

th {
  background-color: #f1f5f9;
  color: #0f172a;
  font-weight: 700;
}

tr:nth-child(even) {
  background-color: #f8fafc;
}

tr:hover {
  background-color: #eaf2ff;
}

/* =========================
   IMAGES
========================= */
img {
  border-radius: 8px;
}

/* =========================
   RESPONSIVE
========================= */
@media (max-width: 768px) {
  nav.top-navbar {
    flex-direction: column;
    height: auto;
    padding: 0.75rem;
    gap: 0.5rem;
  }

  body {
    padding-top: 120px;
  }

  .nav-links {
    flex-wrap: wrap;
    justify-content: center;
    width: 100%;
  }

  .nav-links a {
    width: 100%;
    text-align: center;
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
    <a href="users.php">Manage Students</a>
    <a href="theses.php">Manage Theses</a>
    <a href="profile.php">Profile</a>
    <a href="../auth/logout.php" class="logout">Logout</a>
  </div>
</nav>
