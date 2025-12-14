<?php
//admin_users.php
include("config.php");

if($_SESSION['user']['user_type'] != 'admin'){
    echo "ACCESS DENIED";
    exit;
}

if (isset($_GET['delete_id'])) {
    $delete_id = $_GET['delete_id'];

    if ($delete_id == $_SESSION['user']['id']) {
        echo "<script>alert('You cannot delete your own account!');</script>";
    } else {
        mysqli_query($conn, "DELETE FROM users WHERE id = $delete_id");
        echo "<script>alert('User deleted successfully!');</script>";
    }

    echo "<script>window.location='admin_users.php';</script>";
    exit;
}

$keyword = "";
if(isset($_GET['search'])){
    $keyword = $_GET['search'];
}

$sort = "fullname";
$order = "ASC";
if(isset($_GET['sort'])){
    $sort = $_GET['sort'];
    $order = $_GET['order'];
}

$filter_type = isset($_GET['filter_type']) ? $_GET['filter_type'] : "";

$sql = "SELECT * FROM users WHERE 1"; 
if(!empty($keyword)){
    $sql .= " AND (fullname LIKE '%$keyword%' OR email LIKE '%$keyword%')";
}
if(!empty($filter_type)){
    $sql .= " AND user_type='$filter_type'";
}
$sql .= " ORDER BY $sort $order";

$result = mysqli_query($conn,$sql);
?>

<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="UTF-8" />
<meta name="viewport" content="width=device-width, initial-scale=1.0" />
<title>Admin Users</title>
<style>
body {
    font-family: Arial, sans-serif;
    background: #f5f7fb;
    margin: 0;
    display: flex;
    justify-content: center;
    align-items: flex-start;
    min-height: 100vh;
    padding: 40px 0;
}

.container {
    background: #ffffff;
    padding: 30px 40px;
    border-radius: 16px;
    box-shadow: 0 8px 20px rgba(0,0,0,0.1);
    width: 800px;
    animation: fadeIn 0.4s ease;
}

h2 {
    text-align: center;
    margin-bottom: 25px;
    color: #333;
    letter-spacing: 1px;
}

form {
    display: flex;
    align-items: center;
    gap: 10px;
    margin-bottom: 20px;
    flex-wrap: wrap;
}

form input, form select {
    padding: 8px 10px;
    font-size: 14px;
    border-radius: 8px;
    border: 1px solid #ddd;
    flex: 1 1 200px;
    transition: 0.2s;
}

form input:focus, form select:focus {
    border-color: #4a6cf7;
    box-shadow: 0 0 4px rgba(74,108,247,0.3);
    outline: none;
}

form button {
    background: #4a6cf7;
    border: none;
    color: white;
    padding: 10px 15px;
    font-size: 14px;
    border-radius: 8px;
    cursor: pointer;
    transition: 0.2s;
}

form button:hover {
    background: #3b57d6;
}

table {
    width: 100%;
    border-collapse: collapse;
    margin-top: 10px;
}

table th, table td {
    padding: 10px;
    text-align: left;
}

table th {
    background-color: #4a6cf7;
    color: white;
}

table tr:nth-child(even) {
    background-color: #f2f2f2;
}

table a img {
    vertical-align: middle;
    cursor: pointer;
}

@keyframes fadeIn {
    from { opacity: 0; transform: translateY(10px);}
    to { opacity: 1; transform: translateY(0);}
}
</style>
</head>
<body>

<div class="container">

<h2>Admin - Manage Users       </h2>


<form method="GET">
    <input 
        type="text" 
        name="search"
        value="<?php echo htmlspecialchars($keyword); ?>" 
        placeholder="Search by name or email"
    >
    <select name="filter_type">
        <option value="">All Users</option>
        <option value="faculty" <?php if(isset($_GET['filter_type']) && $_GET['filter_type'] == 'faculty') echo 'selected'; ?>>Faculty</option>
        <option value="admin" <?php if(isset($_GET['filter_type']) && $_GET['filter_type'] == 'admin') echo 'selected'; ?>>Admin</option>
    </select>
    <button type="submit">Search</button>
</form>

<table border="1">
<tr>
    <th>
        <a href="?sort=fullname&order=ASC" style="text-decoration:none; color:white;">Name A-Z</a> | 
        <a href="?sort=fullname&order=DESC" style="text-decoration:none; color:white;">Z-A</a>
    </th>
    <th>
        <a href="?sort=email&order=ASC" style="text-decoration:none; color:white;">Email A-Z</a> | 
        <a href="?sort=email&order=DESC" style="text-decoration:none; color:white;">Z-A</a>
    </th>
    <th>User Type</th>
    <th>Action</th>
</tr>

<?php while($row = mysqli_fetch_assoc($result)): ?>
<tr>
    <td><?php echo $row['fullname']; ?></td>
    <td><?php echo $row['email']; ?></td>
    <td><?php echo $row['user_type']; ?></td>
    <td>
        <a href="admin_users.php?delete_id=<?php echo $row['id']; ?>" 
           onclick="return confirm('Are you sure you want to delete this user?');">
           <img src="delete.png" alt="Delete" width="20" height="20">
        </a>
    </td>
</tr>
<?php endwhile; ?>
</table>
<?php include("header.php"); ?>

</div>

</body>
</html>
