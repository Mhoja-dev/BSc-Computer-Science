<?php
require_once("init.php");
// Protect page (only logged users)
if(!isLoggedIn()){
    redirect("login.php");
}
// Get user data
$user = $_SESSION['username'];
$role = $_SESSION['role'];
?>
<!DOCTYPE html>
<html>
<head>
    <title>Dashboard</title>
    <link rel="stylesheet" href="css/style.css">
</head>
<body>
<!-- NAVBAR -->
<header class="navbar">
    <div class="logo">🍔 FoodExpress</div>
    <nav>
        <a href="index.php">Home</a>
        <a href="dashboard.php">Dashboard</a>
        <a href="logout.php" class="btn">Logout</a>
    </nav>
</header>
<!-- DASHBOARD CONTENT -->
<div style="padding:40px;">
    <h1>Welcome, <?php echo $user; ?> 👋</h1>
    <p>You are logged in as:
        <b style="color:green;">
            <?php echo strtoupper($role); ?>
        </b>
    </p>
    <!-- USER SECTION -->
    <?php if($role == "user"): ?>
        <div style="margin-top:20px;background:#fff;padding:20px;border-radius:10px;box-shadow:0 2px 10px rgba(0,0,0,0.1);">
            <h2>Your Actions</h2>
            <ul>
                <li><a href="index.php">🍕 Browse Foods</a></li>
                <li><a href="cart.php">🛒 View Cart</a></li>
                <li><a href="orders.php">📦 My Orders</a></li>
            </ul>
        </div>
    <?php endif; ?>
    <!-- ADMIN SECTION -->
    <?php if($role == "admin"): ?>
        <div style="margin-top:20px;background:#fff;padding:20px;border-radius:10px;box-shadow:0 2px 10px rgba(0,0,0,0.1);">
            <h2>Admin Panel ⚙️</h2>
            <ul>
                <li><a href="admin.php">Manage Foods</a></li>
                <li><a href="orders.php">View Orders</a></li>
                <li><a href="users.php">Manage Users</a></li>
            </ul>
        </div>
    <?php endif; ?>
</div>
<!-- FOOTER -->
<footer style="text-align:center;padding:15px;background:#222;color:white;">
    © <?php echo date("Y"); ?> FoodExpress
</footer>
</body>
</html>