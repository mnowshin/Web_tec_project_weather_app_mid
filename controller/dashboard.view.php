<?php
global $conn;
require_once "check_auth.php";
require_once "../config.php";
require_once "../model/weather_model.php";

$userId = $_SESSION['user_id'] ?? 0;
$userInfo = null;
$todayInfo = null;
$date = date('Y-m-d');
$result = get_today_weather_by_user($userId, $date);
if ($result && $result->num_rows > 0) {
    $userInfo = $result->fetch_assoc();
    $todayInfo = $userInfo;
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Weather App - Dashboard</title>
    <link rel="stylesheet" href="<?= BASE_URL ?>/views/dashboard.css">
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
</head>
<body>
    <div class="top-bar">
        <h2>Weather Dashboard</h2>
        <?php include '../views/shared_dropdown.php'; ?>
    </div>
    <div class="main-layout">
        <div class="sidebar" id="sidebar">
            <?php include '../views/side_bar.php'?>
        </div>
        <div class="content-area">
            <div class="dashboard-container">
                <input type="hidden" id="userLocation" value="<?php echo htmlspecialchars($todayInfo['city'] ?? $userInfo['location'] ?? 'Dhaka, Bangladesh'); ?>">
                <div class="search-bar">
                    <input type="text" id="cityInput" placeholder="Search location here">
                    <button id="searchBtn">Search</button>
                </div>
                <div class="main-content">
                    <div class="left-section">
                        <div class="weather-content">
                            <div class="overview">
                                <h3>Today overview</h3>
                                <div class="overview-item">
                                    <span>Wind Speed</span>
                                    <span><?php echo $userInfo['wind_speed']??0;?> km/h</span>
                                </div>
                                <div class="overview-item">
                                    <span>Rain Chance</span>
                                    <span><?php echo $userInfo['rain_chance']??0; ?>%</span>
                                </div>
                                <div class="overview-item">
                                    <span>Pressure</span>
                                    <span><?php echo $userInfo['pressure']?? 0 ;?> hPa</span>
                                </div>
                                <div class="overview-item">
                                    <span>UV Index</span>
                                    <span><?php echo $userInfo['uv_index']?? 0; ?></span>
                                </div>
                            </div>
                            <div class="current-weather">
                                <div class="location-time">
                                    <h3><?php echo $todayInfo['location'] ?? "" ;?> <span><span><?php echo date('h:i A'); ?></span></span></h3>
                                </div>
                                <div class="weather-main">
                                    <p class="temperature"><?php echo $todayInfo['temperature'] ?? 0; ?>°C</p>
                                    <p class="condition"><?php echo $todayInfo['weather_condition']??""; ?></p>
                                </div>
                                <div class="additional-info">
                                    <div class="info-item">
                                        <span>Chance of rain</span>
                                        <div class="progress-bar">
                                            <div class="progress" style="width: <?php echo $todayInfo['rain_chance']??0; ?>%;"></div>
                                        </div>
                                    </div>
                                    <div class="info-item">
                                        <span>Sunrise & Sunset</span>
                                        <div>
                                            <p>
                                                Sunrise
                                                <span><?php echo date("h:i A", strtotime($todayInfo['sunrise'])) ?? '00:00 AM'; ?></span>
                                            </p>
                                            <p>
                                                Sunset
                                                <span><?php echo date("h:i A", strtotime($todayInfo['sunset'])) ?? '00:00 AM'; ?></span>
                                            </p>
                                        </div>
                                    </div>
                                </div>
                                <button class="next-day-btn" onclick="showNextDay()">Next Day Weather</button>
                            </div>
                        </div>
                        <div class="chart-section">
                            <h3>Average Weekly Temperature</h3>
                            <canvas id="temperatureChart"></canvas>
                        </div>
                    </div>
                    <div class="forecast-section">
                        <h3>Next 7 Days Forecast</h3>
                        <div class="forecast-list" id="forecastList"></div>
                    </div>
                </div>
                <div id="notification" class="notification"></div>
            </div>
        </div>
    </div>
    <footer class="footer">
        <p>Powered by webTec_Project_aiub</p>
    </footer>

    <script src="<?= BASE_URL ?>/views/dashboard.js"></script>
</body>
</html>