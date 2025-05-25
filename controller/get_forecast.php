<?php
require_once "../config.php";
require_once "../model/weather_model.php";

header('Content-Type: application/json');

if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['city'])) {
    $city = $_POST['city'];
    $today = date('Y-m-d');
    $sevenDaysLater = date('Y-m-d', strtotime('+6 days'));

    $result = get_forecast($city, $today, $sevenDaysLater);

    $forecast = [];
    while ($row = $result->fetch_assoc()) {
        $forecast[] = [
            'date' => date('M d, Y', strtotime($row['forecast_date'])),
            'temperature' => number_format($row['temperature'], 1) . '°C',
            'condition' => $row['weather_condition'],
            'rainChance' => $row['rain_chance'] . '%'
        ];
    }

    echo json_encode([
        'success' => true,
        'data' => $forecast
    ]);
} else {
    echo json_encode([
        'success' => false,
        'message' => 'Invalid request'
    ]);
}
