<?php
require_once("init.php");
// Check login
if(!isLoggedIn()){
    redirect("login.php");
}
// Check cart
if(!isset($_SESSION['cart']) || empty($_SESSION['cart'])){
    echo "Cart is empty!";
    exit();
}
$cart = $_SESSION['cart'];
$user_id = $_SESSION['user_id'];
// Handle checkout
if(isset($_POST['place_order'])){
    // Step 1: calculate total
    $total = 0;
    foreach($cart as $item){
        $total += $item['price'] * $item['qty'];
    }
    // Step 2: insert order
    $sql = "INSERT INTO orders (user_id, total, status, created_at)
            VALUES ('$user_id', '$total', 'Pending', NOW())";
    if(mysqli_query($conn, $sql)){
        $order_id = mysqli_insert_id($conn);
        // Step 3: insert order items
        foreach($cart as $item){
            $name = $item['name'];
            $price = $item['price'];
            $qty = $item['qty'];
            $sql2 = "INSERT INTO order_items (order_id, food_name, price, qty)
                     VALUES ('$order_id', '$name', '$price', '$qty')";
            mysqli_query($conn, $sql2);
        }
        // Step 4: clear cart
        $_SESSION['cart'] = [];
        echo "<script>
                alert('Order placed successfully!');
                window.location='dashboard.php';
              </script>";
    } else {
        echo "Error placing order!";
    }
}
?>
<!DOCTYPE html>
<html>
<head>
    <title>Checkout</title>
    <link rel="stylesheet" href="css/style.css">
</head>
<body>
<header class="navbar">
    <div class="logo">🍔 FoodExpress</div>
    <nav>
        <a href="index.php">Home</a>
        <a href="cart.php">Cart</a>
        <a href="dashboard.php">Dashboard</a>
        <a href="logout.php" class="btn">Logout</a>
    </nav>
</header>
<div style="padding:40px;">
    <h1>💳 Checkout</h1>
    <h3>Review your order before placing it</h3>
    <table border="1" cellpadding="10" style="width:100%;background:#fff;border-collapse:collapse;margin-top:20px;">
        <tr>
            <th>Food</th>
            <th>Price</th>
            <th>Qty</th>
            <th>Total</th>
        </tr>
        <?php
        $grandTotal = 0;
        foreach($cart as $item):
            $total = $item['price'] * $item['qty'];
            $grandTotal += $total;
        ?>
        <tr>
            <td><?php echo $item['name']; ?></td>
            <td><?php echo $item['price']; ?> TZS</td>
            <td><?php echo $item['qty']; ?></td>
            <td><?php echo $total; ?> TZS</td>
        </tr>
        <?php endforeach; ?>
    </table>
    <h2 style="margin-top:20px;">
        Total to Pay: <?php echo $grandTotal; ?> TZS
    </h2>
    <form method="POST">
        <button type="submit" name="place_order"
            style="padding:12px;background:green;color:white;border:none;margin-top:20px;">
            Place Order
        </button>
    </form>
</div>
<footer style="text-align:center;padding:15px;background:#222;color:white;">
    © <?php echo date("Y"); ?> FoodExpress
</footer>
</body>
</html>