<?php
$servername = "localhost";
$username = "root";
$password = "123456789";  // Your MySQL password
$dbname = "weather_app";

try {
    $conn = mysqli_connect($servername, $username, $password, $dbname);
    
    if (!$conn) {
        throw new Exception("Connection failed: " . mysqli_connect_error());
    }
    
    // Set charset to ensure proper character handling
    mysqli_set_charset($conn, "utf8mb4");
    
} catch (Exception $e) {
    die("Database connection failed: " . $e->getMessage());
}
?>
