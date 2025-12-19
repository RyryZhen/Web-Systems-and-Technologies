<?php 
include("config.php"); 

$current_page = basename($_SERVER['PHP_SELF']);
?>

<br><br>
<div class="header" style="text-align: center;">

    <div class="header-links" style="display: flex; justify-content: center; gap: 10px; flex-wrap: wrap;">

        <?php if(isset($_SESSION['user'])): ?>

<?php if($current_page == "dashboard.php"): ?>
    <a href="delete_account.php" class="btn-link" 
       onclick="return confirm('Are you sure you want to delete your account?');">
       Delete Account
    </a>
<?php endif; ?>


            <a href="logout.php" class="btn-link">Logout</a>

            <?php if($_SESSION['user']['user_type'] == 'admin'): ?>
                <a href="admin_users.php" class="btn-link">Manage Users</a>
            <?php endif; ?>

            <?php if($current_page == "admin_users.php"): ?>
                <a href="dashboard.php" class="btn-link">Back</a>
            <?php endif; ?>

        <?php else: ?>

            <?php if($current_page == "login.php"): ?>
                <a href="register.php" class="btn-link">Register</a>
            <?php elseif($current_page == "register.php"): ?>
                <a href="login.php" class="btn-link">Login</a>
            <?php else: ?>
                <a href="login.php" class="btn-link">Login</a>
                <a href="register.php" class="btn-link">Register</a>
            <?php endif; ?>

        <?php endif; ?>

    </div>
</div>

<style>
/* Button-like links */
.btn-link {
    display: inline-block;
    padding: 8px 14px;
    border-radius: 8px;
    background-color: #b1bdecff;
    color: white;
    text-decoration: none;
    font-weight: 500;
    transition: 0.2s;
}

.btn-link:hover {
    background-color: #3b57d6;
}
</style>
