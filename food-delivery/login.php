<?php
require_once("init.php");
// If already logged in redirect
if(isLoggedIn()){
    redirect("dashboard.php");
}
$error = "";
if(isset($_POST['login'])){
    $username = mysqli_real_escape_string($conn, $_POST['username']);
    $password = mysqli_real_escape_string($conn, $_POST['password']);
    // Check user in database
    $sql = "SELECT * FROM users WHERE username='$username' LIMIT 1";
    $result = mysqli_query($conn, $sql);
    if(mysqli_num_rows($result) > 0){
        $user = mysqli_fetch_assoc($result);
        // Check password (plain for now - we can upgrade later)
        if($password == $user['password']){
            $_SESSION['user_id'] = $user['id'];
            $_SESSION['username'] = $user['username'];
            $_SESSION['email'] = $user['email'];
            $_SESSION['role'] = $user['role'];
            redirect("dashboard.php");
        } else {
            $error = "Wrong password!";
        }
    } else {
        $error = "User not found!";
    }
}
?>
<!DOCTYPE html>
<html>
<head>
    <title>Login</title>
    <link rel="stylesheet" href="css/style.css">
</head>
<body>
<div style="max-width:400px;margin:80px auto;background:#fff;padding:20px;border-radius:10px;box-shadow:0 2px 10px rgba(0,0,0,0.2);">
    <h2 style="text-align:center;">Login</h2>
    <?php if($error != ""): ?>
        <p style="color:red;text-align:center;"><?php echo $error; ?></p>
    <?php endif; ?>
    <form method="POST">
        <input type="text" name="username" placeholder="Username" required style="width:100%;padding:10px;margin:10px 0;">
        <input type="password" name="password" placeholder="Password" required style="width:100%;padding:10px;margin:10px 0;">
        <button type="submit" name="login" style="width:100%;padding:10px;background:#ff4d00;color:white;border:none;">
            Login
        </button>
    </form>
    <p style="text-align:center;margin-top:10px;">
        Don't have account? <a href="register.php">Register</a>
    </p>
</div>
</body>
</html>