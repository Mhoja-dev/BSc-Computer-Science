<?php
require_once("init.php");
?>
<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="UTF-8">
<title>Food Delivery System</title>
<link rel="stylesheet" href="css/style.css">
<script defer src="js/main.js"></script>
</head>
<body>
<!-- NAVBAR -->
<header class="navbar">
    <div class="logo">🍔 FoodExpress</div>
    <nav>
        <a href="index.php">Home</a>
        <a href="#foods">Foods</a>
        <a href="#about">About</a>
        <a href="#contact">Contact</a>
        <?php if(isLoggedIn()): ?>
            <a href="dashboard.php">Dashboard</a>
            <a href="logout.php" class="btn">Logout</a>
        <?php else: ?>
            <a href="login.php" class="btn">Login</a>
        <?php endif; ?>
    </nav>
</header>
<!-- HERO SECTION -->
<section class="hero">
    <div class="hero-text">
        <h1>Delicious Food Delivered Fast 🍕</h1>
        <p>Order your favorite meals online easily and quickly</p>
        <form class="search-box">
            <input type="text" placeholder="Search food...">
            <button type="button">Search</button>
        </form>
        <a href="#foods" class="btn-main">Order Now</a>
    </div>
</section>
<!-- FEATURED FOODS -->
<section id="foods" class="foods-section">
    <h2>Popular Foods</h2>
    <div class="food-grid">
        <div class="food-card">
            <img src="https://images.unsplash.com/photo-1600891964599-f61ba0e24092">
            <h3>Burger</h3>
            <p>TZS 10,000</p>
            <button>Add to Cart</button>
        </div>
        <div class="food-card">
            <img src="https://images.unsplash.com/photo-1605478371310-1a3b2a1c1c1c">
            <h3>Pizza</h3>
            <p>TZS 15,000</p>
            <button>Add to Cart</button>
        </div>
        <div class="food-card">
            <img src="https://images.unsplash.com/photo-1546069901-ba9599a7e63c">
            <h3>Chicken</h3>
            <p>TZS 12,000</p>
            <button>Add to Cart</button>
        </div>
    </div>
</section>
<!-- ABOUT -->
<section id="about" class="about">
    <h2>About Us</h2>
    <p>
        FoodExpress is a modern food delivery system built for fast and reliable food ordering.
        We connect customers with their favorite restaurants in seconds.
    </p>
</section>
<!-- CONTACT -->
<section id="contact" class="contact">
    <h2>Contact Us</h2>
    <form>
        <input type="text" placeholder="Your Name">
        <input type="email" placeholder="Your Email">
        <textarea placeholder="Message"></textarea>
        <button type="submit">Send</button>
    </form>
</section>
<!-- FOOTER -->
<footer>
    <p>© <?php echo date("Y"); ?> FoodExpress. All Rights Reserved.</p>
</footer>
</body>
</html>