<?php
global $conn;
require_once "check_auth.php";
require_once "../config.php";
require_once "../model/location_model.php";

$userId = $_SESSION['user_id'] ?? 0;
$message = '';
$error = '';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    if (isset($_POST['action'])) {
        if ($_POST['action'] === 'add' && !empty($_POST['city'])) {
            $city = trim($_POST['city']);
            $lat = $_POST['latitude'] ?? null;
            $lng = $_POST['longitude'] ?? null;
            
            if (!location_exists($userId, $city)) {
                if (save_location($userId, $city, $lat, $lng)) {
                    $message = "Location saved successfully!";
                } else {
                    $error = "Failed to save location";
                }
            } else {
                $error = "Location already saved";
            }
        } elseif ($_POST['action'] === 'delete' && !empty($_POST['location_id'])) {
            if (delete_location($userId, $_POST['location_id'])) {
                $message = "Location removed successfully!";
            } else {
                $error = "Failed to remove location";
            }
        }
    }
}

$savedLocations = get_saved_locations($userId);
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Weather App - Saved Locations</title>
    <link rel="stylesheet" href="<?= BASE_URL ?>/views/dashboard.css">
    <link rel="stylesheet" href="<?= BASE_URL ?>/views/saved-locations.css">
</head>
<body>
    <div class="top-bar">
        <h2>Saved Locations</h2>
        <?php include '../views/shared_dropdown.php'; ?>
    </div>
    <div class="main-layout">
        <div class="sidebar" id="sidebar">
            <?php include '../views/side_bar.php'?>
        </div>
        <div class="content-area">
            <div class="dashboard-container">
                <div class="location-container">
                    <form method="POST" class="add-location-form" onsubmit="return validateLocationForm()">
                        <input type="hidden" name="action" value="add">
                        <input type="text" name="city" id="city" placeholder="Enter city name" required>
                        <button type="submit">Add Location</button>
                    </form>

                    <?php if ($message): ?>
                        <div class="success-message"><?= htmlspecialchars($message) ?></div>
                    <?php endif; ?>
                    <?php if ($error): ?>
                        <div class="error-message"><?= htmlspecialchars($error) ?></div>
                    <?php endif; ?>

                    <div class="locations-list">
                        <?php if ($savedLocations->num_rows > 0): ?>
                            <?php while ($location = $savedLocations->fetch_assoc()): ?>
                                <div class="location-item">
                                    <div class="location-info">
                                        <div class="location-header">
                                            <span class="location-name"><?= htmlspecialchars($location['city']) ?></span>
                                            <span class="coordinates">
                                                <?php if ($location['latitude'] && $location['longitude']): ?>
                                                    <?= number_format($location['latitude'], 4) ?>°N, 
                                                    <?= number_format($location['longitude'], 4) ?>°E
                                                <?php endif; ?>
                                            </span>
                                        </div>
                                        
                                        <?php if (isset($location['temperature'])): ?>
                                            <div class="current-weather-info">
                                                <div class="main-weather">
                                                    <span class="temp"><?= number_format($location['temperature'], 1) ?>°C</span>
                                                    <span class="condition"><?= htmlspecialchars($location['weather_condition']) ?></span>
                                                </div>
                                                <div class="weather-details">
                                                    <div class="weather-item">
                                                        <img src="<?= BASE_URL ?>/assets/wind.png" alt="Wind">
                                                        <span><?= $location['wind_speed'] ?> km/h</span>
                                                    </div>
                                                    <div class="weather-item">
                                                        <img src="<?= BASE_URL ?>/assets/rain.png" alt="Rain">
                                                        <span><?= $location['rain_chance'] ?>%</span>
                                                    </div>
                                                    <div class="weather-item">
                                                        <img src="<?= BASE_URL ?>/assets/pressure.png" alt="Pressure">
                                                        <span><?= $location['pressure'] ?> hPa</span>
                                                    </div>
                                                </div>
                                                <div class="sun-info">
                                                    <span>☀️ <?= $location['sunrise'] ?></span>
                                                    <span>🌙 <?= $location['sunset'] ?></span>
                                                </div>
                                            </div>
                                        <?php else: ?>
                                            <p class="no-weather">No weather data available</p>
                                        <?php endif; ?>
                                    </div>
                                    <div class="location-actions">
    
                                        <form method="POST" style="display: inline;">
                                            <input type="hidden" name="action" value="delete">
                                            <input type="hidden" name="location_id" value="<?= $location['id'] ?>">
                                            <button type="submit" class="delete-btn" onclick="return confirm('Are you sure?')">
                                                Delete
                                            </button>
                                        </form>
                                    </div>
                                </div>
                            <?php endwhile; ?>
                        <?php else: ?>
                            <p class="no-locations">No saved locations yet.</p>
                        <?php endif; ?>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <footer class="footer">
        <p>Powered by webTec_Project_aiub</p>
    </footer>
    <script src="<?= BASE_URL ?>/views/saved-locations.js"></script>
</body>
</html>
