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

// $sql = "SELECT * FROM users
//         WHERE fullname LIKE '%$keyword%'
//            OR email LIKE '%$keyword%'
//         ORDER BY $sort $order";

$sql = "SELECT * FROM users WHERE 1"; // start with true condition
if(!empty($keyword)){
    $sql .= " AND (fullname LIKE '%$keyword%' OR email LIKE '%$keyword%')";
}
if(!empty($filter_type)){
    $sql .= " AND user_type='$filter_type'";
}
$sql .= " ORDER BY $sort $order";

$result = mysqli_query($conn,$sql);
?>

<head>
   <link rel="stylesheet" href="style.css">
</head>
  <?php include("header.php"); ?>

<div style="padding: 0 20%;">
  

<form method="GET" 
      style="margin-bottom: 15px; display: flex; align-items: center; gap: 10px;">
    
<div  style="margin-bottom: 15px; display: flex; align-items: center; gap: 10px;">
    <input 
        type="text" 
        name="search"
        value="<?php echo htmlspecialchars($keyword); ?>" 
        placeholder="Search by name or email"
        style="width: 80% !important; height: 35px !important; padding: 5px 10px !important; font-size: 14px;"
    >
     <select name="filter_type">
        <option value="">All Users</option>
        <option value="faculty" <?php if(isset($_GET['filter_type']) && $_GET['filter_type'] == 'faculty') echo 'selected'; ?>>Faculty</option>
        <option value="admin" <?php if(isset($_GET['filter_type']) && $_GET['filter_type'] == 'admin') echo 'selected'; ?>>Admin</option>
    </select>


    <button type="submit"
        style="height: 35px !important; padding: 0 15px !important; font-size: 14px; width: 80px;">
        Search
    </button>

</div>
</form>




<table border="1" cellpadding="5">
<tr>
   <th>
    <a href="?sort=fullname&order=ASC" style="text-decoration:none; color:white;">Name A-Z</a> | 
    <a href="?sort=fullname&order=DESC" style="text-decoration:none; color:white;">Z-A</a>
</th>
<th>
    <a href="?sort=email&order=ASC" style="text-decoration:none; color:white;">Email A-Z</a> | 
    <a href="?sort=email&order=DESC" style="text-decoration:none; color:black;">Z-A</a>
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


</div>


