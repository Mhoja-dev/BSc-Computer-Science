<?php
// =====================================
// Initialize Food Delivery System
// =====================================
// Start Session
if(session_status()==PHP_SESSION_NONE){
    session_start();
}
// Include Database
require_once("db.php");
// Website Information
$siteName = "Food Delivery System";
$currency = "TZS";
// Current Date
$currentDate = date("Y-m-d");
$currentTime = date("H:i:s");
// Logged User
$userID = $_SESSION['user_id'] ?? "";
$username = $_SESSION['username'] ?? "";
$email = $_SESSION['email'] ?? "";
// Function to check login
function isLoggedIn(){
    return isset($_SESSION['user_id']);
}
// Function to redirect
function redirect($page){
    header("Location: ".$page);
    exit();
}
?>