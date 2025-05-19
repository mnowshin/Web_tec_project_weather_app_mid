<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Weather App - Saved Locations</title>
    <link rel="stylesheet" href="../views/dashboard.css">
</head>
<body>
    <div class="top-bar">
        <h2>Saved Locations</h2>
        <div class="user-profile" onclick="toggleDropdown()">
            <img src="../views/assets/user-placeholder.png" alt="User Photo" class="user-photo">
            <span id="username">User</span>
            <div id="userDropdown" class="dropdown">
                <button onclick="logout()">Logout</button>
            </div>
        </div>
    </div>
    <div class="main-layout">
        <div class="sidebar">
            <h3>Menu</h3>
            <ul>
                <li><a href="dashboard.php">Dashboard</a></li>
                <li><a href="../views/map.html">Map</a></li>
                <li><a href="saved-locations.php">Saved Locations</a></li>
                <li><a href="../views/calendar.html">Calendar</a></li>
            </ul>
        </div>
        <div class="content-area">
            <div class="dashboard-container">
                <h3>Saved Locations</h3>
                <ul class="location-list">
                    <li>Megajam Barat, Tegal</li>
                    <li>Jakarta, Indonesia</li>
                    <li>Bandung, Indonesia</li>
                </ul>
                <a href="dashboard.php" class="back-btn">Back to Dashboard</a>
            </div>
        </div>
    </div>
    <footer class="footer">
        <p>Powered by webTec_Project_aiub</p>
    </footer>
    <script src="../views/dashboard.js"></script>
</body>
</html>
