<?php
session_start();
$error = $_SESSION['login_error'] ?? '';
unset($_SESSION['login_error']);
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Weather App - Login</title>
    <link rel="stylesheet" href="../views/login.css">
</head>
<body>
   <div class="login-wrapper">
    <div class="login-container">
        <div class="left-section">
            <h1>Weather App  <img src="../views/assets/weather.png" alt="Weather Icon" class="weather-icon"></h1>
            <p>Get the latest weather updates at your fingertips.</p>
        </div>
        <div class="right-section">
            <div class="form-container">
                <h2>Login</h2>
                <form method="post" action="login_validation.php" onsubmit="return validateForm(event);">
                    <div class="input-group">
                        <label for="username">Username</label>
                        <input type="text" id="username" name="username" placeholder="Enter your username" required>
                        <span id="usernameError" class="error"></span>
                    </div>
                    <div class="input-group">
                        <label for="password">Password</label>
                        <input type="password" id="password" name="password" placeholder="Enter your password" required>
                        <span id="passwordError" class="error"></span>
                    </div>
                    <?php if ($error): ?>
                        <span class="error"><?= htmlspecialchars($error) ?></span>
                    <?php endif; ?>
                    <button type="submit">Login</button>
                </form>
                <p class="register-link">Don't have an account? <a href="register.php">Register</a></p>
            </div>
        </div>
    </div>
   </div>
   <script src="../views/login_validation.js"></script>
</body>
</html>
