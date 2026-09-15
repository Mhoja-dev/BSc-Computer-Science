<?php
require_once("init.php");
// Protect page
if(!isLoggedIn()){
    redirect("login.php");
}
// Only admin allowed
if($_SESSION['role'] != "admin"){
    echo "Access Denied!";
    exit();
}
// ADD FOOD
if(isset($_POST['add_food'])){
    $name = mysqli_real_escape_string($conn, $_POST['name']);
    $price = mysqli_real_escape_string($conn, $_POST['price']);
    $sql = "INSERT INTO foods (name, price)
            VALUES ('$name', '$price')";
    mysqli_query($conn, $sql);
}
// DELETE FOOD
if(isset($_GET['delete'])){
    $id = $_GET['delete'];
    mysqli_query($conn, "DELETE FROM foods WHERE id='$id'");
}
?>
<!DOCTYPE html>
<html>
<head>
    <title>Admin Panel</title>
    <link rel="stylesheet" href="css/style.css">
</head>
<body>
<header class="navbar">
    <div class="logo">⚙️ Admin Panel</div>
    <nav>
        <a href="index.php">Home</a>
        <a href="dashboard.php">Dashboard</a>
        <a href="logout.php" class="btn">Logout</a>
    </nav>
</header>
<div style="padding:40px;">
    <h1>👨‍💼 Admin Dashboard</h1>
    <!-- ADD FOOD FORM -->
    <div style="background:#fff;padding:20px;margin-top:20px;border-radius:10px;">
        <h2>Add Food 🍔</h2>
        <form method="POST">
            <input type="text" name="name" placeholder="Food Name" required
                style="width:100%;padding:10px;margin:10px 0;">
            <input type="number" name="price" placeholder="Price" required
                style="width:100%;padding:10px;margin:10px 0;">
            <button type="submit" name="add_food"
                style="padding:10px;background:green;color:white;border:none;">
                Add Food
            </button>
        </form>
    </div>
    <!-- FOOD LIST -->
    <div style="margin-top:30px;background:#fff;padding:20px;border-radius:10px;">
        <h2>Foods List</h2>
        <table border="1" cellpadding="10" style="width:100%;border-collapse:collapse;">
            <tr>
                <th>ID</th>
                <th>Name</th>
                <th>Price</th>
                <th>Action</th>
            </tr>
            <?php
            $result = mysqli_query($conn, "SELECT * FROM foods");
            while($row = mysqli_fetch_assoc($result)):
            ?>
            <tr>
                <td><?php echo $row['id']; ?></td>
                <td><?php echo $row['name']; ?></td>
                <td><?php echo $row['price']; ?> TZS</td>
                <td>
                    <a href="admin.php?delete=<?php echo $row['id']; ?>"
                       style="color:red;">Delete</a>
                </td>
            </tr>
            <?php endwhile; ?>
        </table>
    </div>
</div>
</body>
</html>