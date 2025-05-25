<?php
require_once "../config.php";
require_once "../model/weather_model.php";

header('Content-Type: application/json');

function getWeatherIcon($condition) {
    $condition = strtolower($condition);
    $iconMap = [
        'sunny' => 'sunny.png',
        'clear' => 'sunny.png',
        'rainy' => 'rainy.png',
        'rain' => 'rainy.png',
        'cloudy' => 'cloudy.png',
        'partly cloudy' => 'cloudy.png',
        'thunderstorm' => 'storm.png',
        'storm' => 'storm.png',
        'snow' => 'snow.png',
        'mist' => 'mist.png',
        'haze' => 'mist.png',
        'fog' => 'mist.png'
    ];
    
    foreach ($iconMap as $key => $icon) {
        if (strpos($condition, $key) !== false) {
            return $icon;
        }
    }
    return 'default.png';
}

if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['city'])) {
    $cityWithCountry = $_POST['city'];
    $month = intval($_POST['month']);
    $year = intval($_POST['year']);
    $firstDay = date('Y-m-d', mktime(0, 0, 0, $month, 1, $year));
    $lastDay = date('Y-m-t', mktime(0, 0, 0, $month, 1, $year));

    $result = get_monthly_weather($cityWithCountry, $firstDay, $lastDay);

    $weatherData = [];
    while ($row = $result->fetch_assoc()) {
        $date = new DateTime($row['forecast_date']);
        $weatherData[$row['forecast_date']] = [
            'temperature' => number_format($row['temperature'], 1),
            'condition' => $row['weather_condition'],
            'rain_chance' => $row['rain_chance'],
            'formattedDate' => $date->format('j M'),
            'dayName' => $date->format('D'),
            'weatherIcon' => getWeatherIcon($row['weather_condition'])
        ];
    }

    echo json_encode([
        'success' => true,
        'data' => $weatherData
    ]);
} else {
    echo json_encode([
        'success' => false,
        'message' => 'Invalid request'
    ]);
}
