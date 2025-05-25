<?php
session_start();
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login - Weather App</title>
    <link rel="stylesheet" href="views/register.css">
</head>
<body>
    <div class="login-container">
        <?php 
        if (isset($_SESSION['register_success'])) {
            echo '<div class="success-message">' . htmlspecialchars($_SESSION['register_success']) . '</div>';
            unset($_SESSION['register_success']);
        }
        ?>
        <div class="form-container">
            <h2>Login to Your Account</h2>
            <form id="loginForm" action="login.php" method="POST">
                <div class="form-wrapper">
                    <div class="input-group">
                        <label for="userid">UserID</label>
                        <input type="text" id="userid" name="userid" required>
                        <span class="error" id="useridError"></span>
                    </div>
                    <div class="input-group">
                        <label for="password">Password</label>
                        <input type="password" id="password" name="password" required>
                        <span class="error" id="passwordError"></span>
                    </div>
                </div>
                <button type="submit">Login</button>
            </form>
            <div class="login-link">
                <p>Don't have an account? <a href="register.php">Register here</a></p>
            </div>
        </div>
    </div>
</body>
</html>