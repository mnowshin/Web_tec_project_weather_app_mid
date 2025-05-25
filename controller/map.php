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
    <link rel="stylesheet" href="<?= BASE_URL ?>/views/map.css">
</head>
<body>
<div class="top-bar">
    <h2>Weather Map</h2>
    <?php include '../views/shared_dropdown.php'; ?>
</div>
<div class="main-layout">
    <div class="sidebar" id="sidebar">
        <?php include '../views/side_bar.php'?>
    </div>
    <div class="content-area">
        <div class="dashboard-container">
            <div class="container">
                <h1>Weather Map</h1>
                <div class="controls">
                    <label for="layerSelect">Select Weather Layer:</label>
                    <select id="layerSelect" onchange="updateMap()">
                        <option value="temperature-2m" selected>Temperature</option>
                        <option value="precipitation">Precipitation</option>
                        <option value="wind">Wind</option>
                        <option value="clouds">Clouds</option>
                    </select>
                </div>
                <iframe id="mapIframe" src="https://www.ventusky.com/?p=23.64;91.34;6&l=temperature-2m" frameborder="0"></iframe>
            </div>
        </div>
    </div>
</div>
<footer class="footer">
    <p>Powered by webTec_Project_aiub</p>
</footer>
<script src="<?= BASE_URL ?>/views/map.js"></script>
<script src="<?= BASE_URL ?>/views/dashboard.js"></script>
</body>
</html>
