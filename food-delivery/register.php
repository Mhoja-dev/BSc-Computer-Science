<?php
require_once("init.php");
// If already logged in
if(isLoggedIn()){
    redirect("dashboard.php");
}
$error = "";
$success = "";
if(isset($_POST['register'])){
    $username = mysqli_real_escape_string($conn, $_POST['username']);
    $email = mysqli_real_escape_string($conn, $_POST['email']);
    $password = mysqli_real_escape_string($conn, $_POST['password']);
    $confirm = mysqli_real_escape_string($conn, $_POST['confirm']);
    // Check empty
    if($username == "" || $email == "" || $password == ""){
        $error = "All fields are required!";
    }
    else if($password != $confirm){
        $error = "Passwords do not match!";
    }
    else{
        // Check if user exists
        $check = "SELECT * FROM users WHERE username='$username' OR email='$email'";
        $res = mysqli_query($conn, $check);
        if(mysqli_num_rows($res) > 0){
            $error = "Username or Email already exists!";
        }
        else{
            // Insert user (NOTE: plain password for learning)
            $sql = "INSERT INTO users (username, email, password, role)
                    VALUES ('$username', '$email', '$password', 'user')";
            if(mysqli_query($conn, $sql)){
                $success = "Account created successfully! You can login now.";
            } else {
                $error = "Something went wrong!";
            }
        }
    }
}
?>
<!DOCTYPE html>
<html>
<head>
    <title>Register</title>
    <link rel="stylesheet" href="css/style.css">
</head>
<body>
<div style="max-width:400px;margin:60px auto;background:#fff;padding:20px;border-radius:10px;box-shadow:0 2px 10px rgba(0,0,0,0.2);">
    <h2 style="text-align:center;">Register</h2>
    <?php if($error != ""): ?>
        <p style="color:red;text-align:center;"><?php echo $error; ?></p>
    <?php endif; ?>
    <?php if($success != ""): ?>
        <p style="color:green;text-align:center;"><?php echo $success; ?></p>
    <?php endif; ?>
    <form method="POST">
        <input type="text" name="username" placeholder="Username" required style="width:100%;padding:10px;margin:8px 0;">
        <input type="email" name="email" placeholder="Email" required style="width:100%;padding:10px;margin:8px 0;">
        <input type="password" name="password" placeholder="Password" required style="width:100%;padding:10px;margin:8px 0;">
        <input type="password" name="confirm" placeholder="Confirm Password" required style="width:100%;padding:10px;margin:8px 0;">
        <button type="submit" name="register" style="width:100%;padding:10px;background:#ff4d00;color:white;border:none;">
            Register
        </button>
    </form>
    <p style="text-align:center;margin-top:10px;">
        Already have account? <a href="login.php">Login</a>
    </p>
</div>
</body>
</html>