<?php
require_once "connection.php";

function get_saved_locations($userId) {
    global $conn;
    $today = date('Y-m-d');
    
    $sql = "SELECT sl.*, 
            wi.temperature, wi.weather_condition, wi.rain_chance,
            wi.wind_speed, wi.pressure, wi.uv_index,
            TIME_FORMAT(wi.sunrise, '%h:%i %p') as sunrise,
            TIME_FORMAT(wi.sunset, '%h:%i %p') as sunset
            FROM saved_locations sl 
            LEFT JOIN weather_info wi ON sl.city = wi.city 
            AND wi.forecast_date = ?
            WHERE sl.user_id = ? 
            ORDER BY sl.created_at DESC";
            
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("si", $today, $userId);
    $stmt->execute();
    return $stmt->get_result();
}

function save_location($userId, $city) {
    global $conn;
    // First get coordinates and format from weather_info
    $sql = "SELECT DISTINCT city, latitude, longitude 
            FROM weather_info 
            WHERE city LIKE ? 
            LIMIT 1";
    
    $stmt = $conn->prepare($sql);
    $citySearch = "%$city%";
    $stmt->bind_param("s", $citySearch);
    $stmt->execute();
    $result = $stmt->get_result();
    $weatherInfo = $result->fetch_assoc();
    
    if ($weatherInfo) {
        $fullCity = $weatherInfo['city']; // This will be "City, Country" format
        $sql = "INSERT INTO saved_locations (user_id, city, latitude, longitude) 
                VALUES (?, ?, ?, ?)";
        $stmt = $conn->prepare($sql);
        $stmt->bind_param("isdd", $userId, $fullCity, 
                         $weatherInfo['latitude'], $weatherInfo['longitude']);
        return $stmt->execute();
    }
    return false;
}

function delete_location($userId, $locationId) {
    global $conn;
    $sql = "DELETE FROM saved_locations WHERE id = ? AND user_id = ?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("ii", $locationId, $userId);
    return $stmt->execute();
}

function location_exists($userId, $city) {
    global $conn;
    $sql = "SELECT id FROM saved_locations WHERE user_id = ? AND city = ?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("is", $userId, $city);
    $stmt->execute();
    return $stmt->get_result()->num_rows > 0;
}
