<?php
$servername = "localhost";
$username = "root";
$password = "123456789";
$dbname = "weather_app";

// Create connection
$conn = new mysqli($servername, $username, $password, $dbname);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}
// ...existing code for queries or further logic...
?>
