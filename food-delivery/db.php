<?php
// =====================================
// Food Delivery System
// Database Connection
// =====================================
$host = "localhost";
$user = "root";
$password = "";
$database = "food_delivery";
// Create Connection
$conn = mysqli_connect($host, $user, $password, $database);
// Check Connection
if (!$conn) {
    die("Connection Failed : " . mysqli_connect_error());
}
// Character Encoding
mysqli_set_charset($conn, "utf8");
// Timezone
date_default_timezone_set("Africa/Dar_es_Salaam");
?>