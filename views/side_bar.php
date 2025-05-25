<button class="toggle-btn" onclick="toggleSidebar()">
    <img src="<?= BASE_URL ?>/assets/toggle.png" alt="Toggle Menu" class="toggle-icon">
</button>
<div class="sidebar-content">
    <ul>
        <li>
            <a href="dashboard.php">
                <img src="<?= BASE_URL ?>/assets/dashboard.png" alt="Dashboard Icon" class="weather-icon"> Dashboard
            </a>
        </li>
        <li>
            <a href="map.php">
                <img src="<?= BASE_URL ?>/assets/map.png" alt="Map Icon" class="weather-icon"> Map
            </a>
        </li>
        <li>
            <a href="saved-locations.php">
                <img src="<?= BASE_URL ?>/assets/saved-location.png" alt="Saved Locations Icon" class="weather-icon"> Saved Locations
            </a>
        </li>
        <li>
            <a href="calender.php">
                <img src="<?= BASE_URL ?>/assets/calendar.png" alt="Calendar Icon" class="weather-icon"> Calendar
            </a>
        </li>
        <li>
            <a href="disaster-contacts.php">
                <img src="<?= BASE_URL ?>/assets/emergency.png" alt="Emergency Icon" class="weather-icon"> Emergency Contacts
            </a>
        </li>
    </ul>
    <div class="contact-us-wrapper">
        <a href="contact.php" class="contact-us-btn">
            <img src="<?= BASE_URL ?>/assets/contact.png" alt="Contact Icon" class="weather-icon"> Contact Us
        </a>
    </div>
</div>