<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Weather App - Calendar</title>
    <link rel="stylesheet" href="../views/dashboard.css">
    <link rel="stylesheet" href="../views/calender.css">
</head>
<body>
    <div class="top-bar">
        <h2>Weather Calendar</h2>
        <div class="user-profile" onclick="toggleDropdown()">
            <img src="../views/assets/user-placeholder.png" alt="User Photo" class="user-photo">
            <span id="username">User</span>
            <div id="userDropdown" class="dropdown">
                <button onclick="logout()">Logout</button>
            </div>
        </div>
    </div>
    <div class="main-layout">
        <div id="sidebar"></div>
        <div class="content-area">
            <div class="dashboard-container">
                <div class="location-controls">
                    <label for="locationSelect">Select Location:</label>
                    <select id="locationSelect" onchange="updateLocation()"></select>
                </div>
                <div class="calendar-container">
                    <div class="calendar-controls">
                        <button onclick="previousMonth()">Previous</button>
                        <span id="monthYear"></span>
                        <button onclick="nextMonth()">Next</button>
                    </div>
                    <table id="calendar"></table>
                </div>
                <div class="selected-date">
                    <p>Selected Date: <span id="selectedDate"></span></p>
                </div>
                <div id="notification" class="notification">
                    <span id="notificationText"></span>
                    <button class="close-btn" onclick="dismissNotification()">✕</button>
                </div>
            </div>
        </div>
    </div>
    <footer class="footer">
        <p>Powered by webTec_Project_aiub</p>
    </footer>
    <script src="../views/include.js"></script>
    <script src="../views/dashboard.js"></script>
    <script src="../views/calender.js"></script>
</body>
</html>
