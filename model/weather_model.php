<?php
require_once "connection.php";

function get_today_weather_by_user($userId, $date) {
    global $conn;
    $sql = "SELECT * FROM users as u LEFT JOIN weather_info as w ON u.location = w.city WHERE u.id = ? AND w.forecast_date = ? LIMIT 1";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("is", $userId, $date);
    $stmt->execute();
    return $stmt->get_result();
}

function get_weather_by_city_and_date($city, $date) {
    global $conn;
    $sql = "SELECT 
        city,
        temperature,
        weather_condition,
        wind_speed,
        rain_chance,
        pressure,
        uv_index,
        TIME_FORMAT(sunrise, '%h:%i %p') as sunrise,
        TIME_FORMAT(sunset, '%h:%i %p') as sunset,
        latitude,
        longitude,
        forecast_date
    FROM weather_info 
    WHERE city LIKE ? 
    AND forecast_date = ? 
    LIMIT 1";
    $likeCity = "%$city%";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("ss", $likeCity, $date);
    $stmt->execute();
    return $stmt->get_result();
}

function get_forecast($city, $today, $sevenDaysLater) {
    global $conn;
    $sql = "SELECT forecast_date, temperature, weather_condition, rain_chance 
            FROM weather_info 
            WHERE city = ? 
            AND forecast_date BETWEEN ? AND ?
            ORDER BY forecast_date ASC
            LIMIT 7";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("sss", $city, $today, $sevenDaysLater);
    $stmt->execute();
    return $stmt->get_result();
}

function get_monthly_weather($city, $firstDay, $lastDay) {
    global $conn;
    $sql = "SELECT forecast_date, temperature, weather_condition, rain_chance 
            FROM weather_info 
            WHERE city = ? 
            AND forecast_date BETWEEN ? AND ?
            ORDER BY forecast_date";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("sss", $city, $firstDay, $lastDay);
    $stmt->execute();
    return $stmt->get_result();
}

function get_monthly_weather_conditions($city, $firstDay, $lastDay) {
    global $conn;
    $sql = "SELECT forecast_date, temperature, weather_condition 
            FROM weather_info 
            WHERE city = ? AND forecast_date BETWEEN ? AND ?
            ORDER BY forecast_date";
    
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("sss", $city, $firstDay, $lastDay);
    $stmt->execute();
    return $stmt->get_result();
}
