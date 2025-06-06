<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Weather App - Dashboard</title>
    <link rel="stylesheet" href="dashboard.css">
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
</head>
<body>
    <div class="top-bar">
        <h2>Weather Dashboard</h2>
        <div class="user-profile" onclick="toggleDropdown(event)">
            <span id="username">User</span>
            <img src="assets/person.png" alt="User Photo" class="user-photo">
            <div id="userDropdown" class="dropdown">
                <button onclick="logout()">Logout</button>
            </div>
        </div>
    </div>
    <div class="main-layout">
        <div class="sidebar" id="sidebar">
            <button class="toggle-btn" onclick="toggleSidebar()">
                <img src="assets/toggle.png" alt="Toggle Menu" class="toggle-icon">
            </button>
            <div class="sidebar-content">
                <ul>
                    <li>
                        <a href="map.html">
                            <img src="assets/map.png" alt="Map Icon" class="weather-icon"> Map
                        </a>
                    </li>
                    <li>
                        <a href="saved-locations.html">
                            <img src="assets/saved-location.png" alt="Saved Locations Icon" class="weather-icon"> Saved Locations
                        </a>
                    </li>
                    <li>
                        <a href="calendar.html">
                            <img src="assets/calendar.png" alt="Calendar Icon" class="weather-icon"> Calendar
                        </a>
                    </li>
                </ul>
            </div>
        </div>
        <div class="content-area">
            <div class="dashboard-container">
                <div class="search-bar">
                    <input type="text" id="cityInput" placeholder="Search location here">
                    <button onclick="searchWeather()">Search</button>
                </div>
                <div class="main-content">
                    <div class="left-section">
                        <div class="weather-content">
                            <div class="overview">
                                <h3>Today overview</h3>
                                <div class="overview-item">
                                    <span>Wind Speed</span>
                                    <span>12km/h</span>
                                </div>
                                <div class="overview-item">
                                    <span>Rain Chance</span>
                                    <span>24%</span>
                                </div>
                                <div class="overview-item">
                                    <span>Pressure</span>
                                    <span>720 hPa</span>
                                </div>
                                <div class="overview-item">
                                    <span>UV Index</span>
                                    <span>2.3</span>
                                </div>
                            </div>
                            <div class="current-weather">
                                <div class="location-time">
                                    <h3>Megajam Barat</h3>
                                    <p>Tegal, Indonesia <span>08:54 AM</span></p>
                                </div>
                                <div class="weather-main">
                                    <p class="temperature">20°C</p>
                                    <p class="condition">Dramatic Cloudy</p>
                                </div>
                                <div class="additional-info">
                                    <div class="info-item">
                                        <span>Chance of rain</span>
                                        <div class="progress-bar">
                                            <div class="progress" style="width: 44%;"></div>
                                        </div>
                                    </div>
                                    <div class="info-item">
                                        <span>Sunrise & Sunset</span>
                                        <div>
                                            <p>Sunrise <span>4:20 AM</span> (4 hours ago)</p>
                                            <p>Sunset <span>5:50 PM</span> (in 9 hours)</p>
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
    <script src="dashboard.js"></script>
</body>
</html>