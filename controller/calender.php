<?php
require_once "check_auth.php";

require_once "../config.php";


?>


<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Weather Map</title>
    <link rel="stylesheet" href="<?= BASE_URL ?>/views/dashboard.css">
    <link rel="stylesheet" href="<?= BASE_URL ?>/views/calender.css">
</head>
<body>
<div class="top-bar">
    <h2>Weather Calendar</h2>
    <?php include '../views/shared_dropdown.php'; ?>
</div>
<div class="main-layout">
    <div class="sidebar" id="sidebar">
        <?php include '../views/side_bar.php'?>
    </div>
    <div class="content-area">
                <div class="dashboard-container">
                    <div class="location-controls">
                        <label for="locationSelect">Select Location:</label>
                        <select id="locationSelect" onchange="updateLocation()">
                            <option value="Dhaka, Bangladesh">Dhaka, Bangladesh</option>
                            <option value="Chittagong, Bangladesh">Chittagong, Bangladesh</option>
                            <option value="Sylhet, Bangladesh">Sylhet, Bangladesh</option>
                            <option value="Rajshahi, Bangladesh">Rajshahi, Bangladesh</option>
                            <option value="Khulna, Bangladesh">Khulna, Bangladesh</option>
                            <option value="Barisal, Bangladesh">Barisal, Bangladesh</option>
                            <option value="Rangpur, Bangladesh">Rangpur, Bangladesh</option>
                            <option value="Mymensingh, Bangladesh">Mymensingh, Bangladesh</option>
                            <option value="Cox's Bazar, Bangladesh">Cox's Bazar, Bangladesh</option>
                            <option value="Comilla, Bangladesh">Comilla, Bangladesh</option>
                        </select>
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
<script src="<?= BASE_URL ?>/views/calender.js"></script>
<script src="<?= BASE_URL ?>/views/dashboard.js"></script>
</body>
</html>

