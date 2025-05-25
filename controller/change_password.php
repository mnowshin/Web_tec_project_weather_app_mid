<?php
require_once "check_auth.php";
require_once "../config.php";
require_once "../model/user_model.php";

$error = '';
$success = '';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $currentPassword = $_POST['current_password'] ?? '';
    $newPassword = $_POST['new_password'] ?? '';
    $confirmPassword = $_POST['confirm_password'] ?? '';
    $userId = $_SESSION['user_id'];

    if (strlen($newPassword) < 8) {
        $error = 'New password must be at least 8 characters long';
    } elseif ($newPassword !== $confirmPassword) {
        $error = 'New passwords do not match';
    } elseif (!verify_current_password($userId, $currentPassword)) {
        $error = 'Current password is incorrect';
    } else {
        if (update_user_password($userId, $newPassword)) {
            $success = 'Password updated successfully';
            echo "<script>
                setTimeout(function() {
                    window.location.href = 'dashboard.view.php';
                }, 2000);
            </script>";
        } else {
            $error = 'Failed to update password';
        }
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Change Password - Weather App</title>
    <link rel="stylesheet" href="<?= BASE_URL ?>/views/dashboard.css">
    <link rel="stylesheet" href="<?= BASE_URL ?>/views/change_password.css">
</head>
<body>
    <div class="top-bar">
        <h2>Change Password</h2>
        <?php include '../views/shared_dropdown.php'; ?>
    </div>
    <div class="main-layout">
        <div class="sidebar" id="sidebar">
            <?php include '../views/side_bar.php'?>
        </div>
        <div class="content-area">
            <div class="password-container">
                <form id="changePasswordForm" method="POST" onsubmit="return validateForm()">
                    <?php if ($error): ?>
                        <div class="error-message"><?= htmlspecialchars($error) ?></div>
                    <?php endif; ?>
                    <?php if ($success): ?>
                        <div class="success-message"><?= htmlspecialchars($success) ?></div>
                    <?php endif; ?>
                    
                    <div class="form-group">
                        <label for="current_password">Current Password</label>
                        <input type="password" id="current_password" name="current_password" required>
                        <span class="error" id="currentPasswordError"></span>
                    </div>

                    <div class="form-group">
                        <label for="new_password">New Password</label>
                        <input type="password" id="new_password" name="new_password" required>
                        <span class="error" id="newPasswordError"></span>
                    </div>

                    <div class="form-group">
                        <label for="confirm_password">Confirm New Password</label>
                        <input type="password" id="confirm_password" name="confirm_password" required>
                        <span class="error" id="confirmPasswordError"></span>
                    </div>

                    <button type="submit" class="submit-btn">Change Password</button>
                </form>
            </div>
        </div>
    </div>
    <script src="<?= BASE_URL ?>/views/change_password.js"></script>
</body>
</html>
