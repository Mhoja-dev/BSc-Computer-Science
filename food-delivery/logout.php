<?php
require_once("init.php");
// Kutoa user kwenye session (logout)
session_unset();
session_destroy();
// Kurudisha login page
redirect("login.php");
?>