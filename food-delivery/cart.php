<?php
require_once("init.php");
// Initialize cart if not exists
if(!isset($_SESSION['cart'])){
    $_SESSION['cart'] = [];
}
// Remove item
if(isset($_GET['remove'])){
    $id = $_GET['remove'];
    unset($_SESSION['cart'][$id]);
    redirect("cart.php");
}
// Clear cart
if(isset($_GET['clear'])){
    $_SESSION['cart'] = [];
    redirect("cart.php");
}
$cart = $_SESSION['cart'];
?>
<!DOCTYPE html>
<html>
<head>
    <title>My Cart</title>
    <link rel="stylesheet" href="css/style.css">
</head>
<body>
<header class="navbar">
    <div class="logo">🍔 FoodExpress</div>
    <nav>
        <a href="index.php">Home</a>
        <a href="dashboard.php">Dashboard</a>
        <a href="logout.php" class="btn">Logout</a>
    </nav>
</header>
<div style="padding:40px;">
    <h1>🛒 My Cart</h1>
    <?php if(empty($cart)): ?>
        <p>Your cart is empty 😢</p>
    <?php else: ?>
        <table border="1" cellpadding="10" style="width:100%;background:#fff;border-collapse:collapse;">
            <tr>
                <th>Food</th>
                <th>Price</th>
                <th>Quantity</th>
                <th>Total</th>
                <th>Action</th>
            </tr>
            <?php
            $grandTotal = 0;
            foreach($cart as $id => $item):
                $total = $item['price'] * $item['qty'];
                $grandTotal += $total;
            ?>
            <tr>
                <td><?php echo $item['name']; ?></td>
                <td><?php echo $item['price']; ?> TZS</td>
                <td><?php echo $item['qty']; ?></td>
                <td><?php echo $total; ?> TZS</td>
                <td>
                    <a href="cart.php?remove=<?php echo $id; ?>" style="color:red;">Remove</a>
                </td>
            </tr>
            <?php endforeach; ?>
        </table>
        <h2 style="margin-top:20px;">
            Grand Total: <?php echo $grandTotal; ?> TZS
        </h2>
        <br>
        <a href="checkout.php" style="background:green;color:white;padding:10px;text-decoration:none;">
            Proceed to Checkout
        </a>
        <a href="cart.php?clear=1" style="background:red;color:white;padding:10px;text-decoration:none;margin-left:10px;">
            Clear Cart
        </a>
    <?php endif; ?>
</div>
<footer style="text-align:center;padding:15px;background:#222;color:white;">
    © <?php echo date("Y"); ?> FoodExpress
</footer>
</body>
</html>