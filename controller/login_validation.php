<?php
session_start();

$username = $_POST['username'] ?? '';
$password = $_POST['password'] ?? '';
$error = '';

if (strlen($username) < 6) {
    $error = 'Username must be at least 6 characters long';
} elseif (strlen($password) < 6) {
    $error = 'Password must be at least 6 characters long';
} else {
    $_SESSION['username'] = $username;
    header("Location: /controller/dashboard.view.php");
    exit();
}

$_SESSION['login_error'] = $error;
header("Location: /");
exit();
