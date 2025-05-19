<?php
$nameError = $useridError = $emailError = $locationError = $countryError = $passwordError = $numberError = '';
$name = $userid = $email = $location = $country = $password = $number = '';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $name = trim($_POST['name'] ?? '');
    $userid = trim($_POST['userid'] ?? '');
    $email = trim($_POST['email'] ?? '');
    $location = trim($_POST['location'] ?? '');
    $country = trim($_POST['country'] ?? '');
    $password = $_POST['password'] ?? '';
    $number = trim($_POST['number'] ?? '');

    $isValid = true;

    if ($name === '') {
        $nameError = 'Name is required';
        $isValid = false;
    }
    if ($userid === '') {
        $useridError = 'UserID is required';
        $isValid = false;
    }
    if ($email === '' || !filter_var($email, FILTER_VALIDATE_EMAIL)) {
        $emailError = 'Enter a valid email address';
        $isValid = false;
    }
    if ($location === '') {
        $locationError = 'Location is required';
        $isValid = false;
    }
    if ($country === '') {
        $countryError = 'Country is required';
        $isValid = false;
    }
    // Password: 8+ chars, upper, lower, number, special char
    if ($password === '') {
        $passwordError = 'Password is required';
        $isValid = false;
    } elseif (!preg_match('/^(?=.*[a-z])(?=.*[A-Z])(?=.*\d)(?=.*[!@#$%^&*]).{8,}$/', $password)) {
        $passwordError = 'Password must be 8+ chars, uppercase, lowercase, number, special char';
        $isValid = false;
    }
    if ($number === '' || !preg_match('/^\d{10,12}$/', $number)) {
        $numberError = 'Enter a valid phone number (10-12 digits)';
        $isValid = false;
    }

    if ($isValid) {
        // Registration success (no DB, so just redirect to login)
        header("Location: ../index.php?register=success");
        exit();
    }
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Weather App - Register</title>
    <link rel="stylesheet" href="../views/register.css">
</head>
<body>
    <div class="register-container">
        <!-- <div class="left-section">
            <h1>Weather App <img src="../views/assets/weather.png" alt="Weather Icon" class="weather-icon"></h1>
            <p>Join us to get personalized weather updates!</p>
        </div> -->
        <div class="right-section">
            <div class="form-container">
                <h2>Register</h2>
                <form method="post" action="register.php" onsubmit="return validateRegistration(event);">
                    <div class="input-group">
                        <label for="name">Name</label>
                        <input type="text" id="name" name="name" placeholder="Enter your full name" value="<?= htmlspecialchars($name) ?>" required>
                        <span id="nameError" class="error"><?= $nameError ?></span>
                    </div>
                    <div class="input-group">
                        <label for="userid">UserID</label>
                        <input type="text" id="userid" name="userid" placeholder="Enter your UserID" value="<?= htmlspecialchars($userid) ?>" required>
                        <span id="useridError" class="error"><?= $useridError ?></span>
                    </div>
                    <div class="input-group">
                        <label for="email">Email</label>
                        <input type="email" id="email" name="email" placeholder="Enter your email" value="<?= htmlspecialchars($email) ?>" required>
                        <span id="emailError" class="error"><?= $emailError ?></span>
                    </div>
                    <div class="input-group">
                        <label for="location">Location</label>
                        <input type="text" id="location" name="location" placeholder="Enter your city" value="<?= htmlspecialchars($location) ?>" required>
                        <span id="locationError" class="error"><?= $locationError ?></span>
                    </div>
                    <div class="input-group">
                        <label for="country">Country</label>
                        <input type="text" id="country" name="country" placeholder="Enter your country" value="<?= htmlspecialchars($country) ?>" required>
                        <span id="countryError" class="error"><?= $countryError ?></span>
                    </div>
                    <div class="input-group">
                        <label for="password">Password</label>
                        <input type="password" id="password" name="password" placeholder="Enter your password" required>
                        <span id="passwordError" class="error"><?= $passwordError ?></span>
                    </div>
                    <div class="input-group">
                        <label for="number">Phone Number</label>
                        <input type="tel" id="number" name="number" placeholder="Enter your phone number" value="<?= htmlspecialchars($number) ?>" required>
                        <span id="numberError" class="error"><?= $numberError ?></span>
                    </div>
                    <button type="submit">Register</button>
                </form>
                <p class="login-link">Already have an account? <a href="../index.php">Login</a></p>
            </div>
        </div>
    </div>
    <script src="../views/register.js"></script>
</body>
</html>
