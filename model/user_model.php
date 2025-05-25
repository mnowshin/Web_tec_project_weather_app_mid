<?php
require_once "connection.php";

function verify_current_password($userId, $currentPassword) {
    global $conn;
    $sql = "SELECT password FROM users WHERE id = ?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("i", $userId);
    $stmt->execute();
    $result = $stmt->get_result();
    
    if ($row = $result->fetch_assoc()) {
        return password_verify($currentPassword, $row['password']);
    }
    return false;
}

function update_user_password($userId, $newPassword) {
    global $conn;
    $hashedPassword = password_hash($newPassword, PASSWORD_DEFAULT);
    $sql = "UPDATE users SET password = ? WHERE id = ?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("si", $hashedPassword, $userId);
    return $stmt->execute();
}

function get_user_profile($userId) {
    global $conn;
    
    $sql = "SELECT id, name, username, email, number, location FROM users WHERE id = ?";
    $stmt = $conn->prepare($sql);
    
    if (!$stmt) {
        error_log("Prepare failed: " . $conn->error);
        return false;
    }
    
    $stmt->bind_param("i", $userId);
    if (!$stmt->execute()) {
        error_log("Execute failed: " . $stmt->error);
        return false;
    }
    
    $result = $stmt->get_result();
    if (!$result) {
        error_log("Getting result failed: " . $stmt->error);
        return false;
    }
    
    $user = $result->fetch_assoc();
    $stmt->close();
    
    return $user;
}

function update_user_profile($userId, $name, $email, $location, $number) {
    global $conn;
    $sql = "UPDATE users SET name = ?, email = ?, location = ?, number = ? WHERE id = ?";
    $stmt = $conn->prepare($sql);
    if (!$stmt) {
        error_log("Prepare failed: " . $conn->error);
        return false;
    }
    
    $stmt->bind_param("ssssi", $name, $email, $location, $number, $userId);
    $success = $stmt->execute();
    $stmt->close();
    return $success;
}
