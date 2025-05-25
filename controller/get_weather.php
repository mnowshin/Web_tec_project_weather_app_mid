<?php
require_once "../config.php";
require_once "../model/weather_model.php";

header('Content-Type: application/json');

if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['city'])) {
    $city = $_POST['city'];
    $date = date('Y-m-d');
    $result = get_weather_by_city_and_date($city, $date);

    if ($result && $result->num_rows > 0) {
        $weatherData = $result->fetch_assoc();
        $response = [
            'success' => true,
            'data' => [
                'city' => $weatherData['city'],
                'temperature' => floatval($weatherData['temperature']),
                'weather_condition' => $weatherData['weather_condition'],
                'wind_speed' => floatval($weatherData['wind_speed']),
                'rain_chance' => intval($weatherData['rain_chance']),
                'pressure' => intval($weatherData['pressure']),
                'uv_index' => floatval($weatherData['uv_index']),
                'sunrise' => $weatherData['sunrise'],
                'sunset' => $weatherData['sunset'],
                'coordinates' => [
                    'lat' => floatval($weatherData['latitude']),
                    'lon' => floatval($weatherData['longitude'])
                ],
                'forecast_date' => $weatherData['forecast_date']
            ]
        ];
        echo json_encode($response);
    } else {
        echo json_encode([
            'success' => false,
            'message' => 'No weather data found for ' . htmlspecialchars($city)
        ]);
    }
} else {
    echo json_encode([
        'success' => false,
        'message' => 'Invalid request'
    ]);
}
