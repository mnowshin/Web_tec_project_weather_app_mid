<?php
global $conn;
session_start();
require_once '../model/connection.php'; // Uses $conn from mysqli_connect()

$username = trim($_POST['username'] ?? '');
$password = trim($_POST['password'] ?? '');
$error = '';

if (strlen($username) < 6) {
    $error = 'Username must be at least 6 characters long.';
} elseif (strlen($password) < 6) {
    $error = 'Password must be at least 6 characters long.';
} else {
    $stmt = $conn->prepare("SELECT id, username, password FROM users WHERE username = ?");
    $stmt->bind_param("s", $username);
    $stmt->execute();

    $result = $stmt->get_result();
    if ($result && $user = $result->fetch_assoc()) {
        if (password_verify($password, $user['password'])) {
            // Login successful
            $_SESSION['user_id'] = $user['id'];
            $_SESSION['username'] = $user['username'];

            // Optional: Remember user with cookie for 7 days
            setcookie("remember_user", $user['username'], time() + (7 * 24 * 60 * 60), "/");

            header("Location: ./dashboard.php");
            exit();
        } else {
            $error = "Invalid username or password.";
        }
    } else {
        $error = "Invalid username or password.";
    }

    $stmt->close();
}

$_SESSION['login_error'] = $error;
header("Location: ./index.php");
exit();
