<div class="user-profile" onclick="toggleDropdown(event)">
    <span id="username"><?php echo htmlspecialchars($_SESSION['username'] ?? 'User'); ?></span>
    <img src="<?= BASE_URL ?>/assets/person.png" alt="User Photo" class="user-photo">
    <div id="userDropdown" class="dropdown">
        <a href="profile.php">
            <img src="<?= BASE_URL ?>/assets/user.png" alt="Profile">
            My Profile
        </a>
        <a href="change_password.php">
            <img src="<?= BASE_URL ?>/assets/changepassword.png" alt="Change Password">
            Change Password
        </a>
        <a href="logout.php">
            <img src="<?= BASE_URL ?>/assets/logout.png" alt="Logout">
            Logout
        </a>
    </div>
</div>
