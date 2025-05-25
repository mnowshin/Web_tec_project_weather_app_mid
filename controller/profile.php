<?php
require_once "check_auth.php";
require_once "../config.php";
require_once "../model/user_model.php";

$userId = $_SESSION['user_id'] ?? 0;
$userInfo = get_user_profile($userId);

if ($userInfo === false) {
    // Handle error case
    $error = "Unable to fetch user profile. Please try again later.";
    $userInfo = [
        'name' => '',
        'email' => '',
        'location' => '',
        'phone' => '',
        'username' => ''
    ];
}

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $name = trim($_POST['name'] ?? '');
    $email = trim($_POST['email'] ?? '');
    $location = trim($_POST['location'] ?? '');
    $number = trim($_POST['number'] ?? '');

    if (empty($name) || empty($email) || empty($location) || empty($number)) {
        $error = "All fields are required";
    } elseif (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
        $error = "Invalid email format";
    } elseif (!preg_match("/^[0-9]{10,12}$/", $number)) {
        $error = "Invalid phone number format";
    } else {
        $result = update_user_profile($userId, $name, $email, $location, $number);
        if ($result) {
            $success = "Profile updated successfully!";
            $userInfo = get_user_profile($userId); // Refresh user info
            echo "<script>
                setTimeout(function() {
                    window.location.href = 'dashboard.view.php';
                }, 2000);
            </script>";
        } else {
            $error = "Failed to update profile";
        }
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>My Profile - Weather App</title>
    <link rel="stylesheet" href="<?= BASE_URL ?>/views/dashboard.css">
    <link rel="stylesheet" href="<?= BASE_URL ?>/views/profile.css">
</head>
<body>
    <div class="top-bar">
        <h2>My Profile</h2>
        <?php include '../views/shared_dropdown.php'; ?>
    </div>
    <div class="main-layout">
        <div class="sidebar" id="sidebar">
            <?php include '../views/side_bar.php'?>
        </div>
        <div class="content-area">
            <div class="profile-container">
                <div class="profile-card">
                    <div class="profile-header">
                        <img src="<?= BASE_URL ?>/assets/person.png" alt="Profile" class="profile-photo">
                        <h2><?php echo htmlspecialchars($userInfo['name']); ?></h2>
                    </div>
                    
                    <form id="profileForm" method="POST" onsubmit="return validateProfileForm()">
                        <?php if (isset($success)): ?>
                            <div class="success-message"><?php echo $success; ?></div>
                        <?php endif; ?>
                        <?php if (isset($error)): ?>
                            <div class="error-message"><?php echo $error; ?></div>
                        <?php endif; ?>

                        <div class="form-group">
                            <label for="name">Full Name</label>
                            <input type="text" id="name" name="name" 
                                   value="<?php echo htmlspecialchars($userInfo['name']); ?>">
                            <span class="error" id="nameError"></span>
                        </div>

                        <div class="form-group">
                            <label for="email">Email</label>
                            <input type="email" id="email" name="email" 
                                   value="<?php echo htmlspecialchars($userInfo['email']); ?>">
                            <span class="error" id="emailError"></span>
                        </div>

                        <div class="form-group">
                            <label for="location">Location</label>
                            <input type="text" id="location" name="location" 
                                   value="<?php echo htmlspecialchars($userInfo['location']); ?>">
                            <span class="error" id="locationError"></span>
                        </div>

                        <div class="form-group">
                            <label for="number">Phone Number (10-12 digits)</label>
                            <input type="tel" id="number" name="number" 
                                   value="<?php echo htmlspecialchars($userInfo['number']); ?>"
                                   pattern="[0-9]{10,12}" required>
                            <span class="error" id="numberError"></span>
                        </div>

                        <button type="submit" class="save-btn">Save Changes</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
    <footer class="footer">
        <p>Powered by webTec_Project_aiub</p>
    </footer>
    <script src="<?= BASE_URL ?>/views/profile.js"></script>
</body>
</html>
