<?php
session_start();
require_once  "../config.php";
// Check if user is logged in
if (!isset($_SESSION['user_id'])) {
    header("Location: ".BASE_URL."/controller/index.php");
    exit();
}
?>