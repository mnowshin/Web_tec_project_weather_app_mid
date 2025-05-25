<?php
require_once "connection.php";

function get_emergency_contacts_by_category($category = null) {
    global $conn;
    
    if ($category) {
        $sql = "SELECT * FROM emergency_contacts WHERE category = ? ORDER BY organization";
        $stmt = $conn->prepare($sql);
        $stmt->bind_param("s", $category);
    } else {
        $sql = "SELECT * FROM emergency_contacts ORDER BY category, organization";
        $stmt = $conn->prepare($sql);
    }
    
    $stmt->execute();
    return $stmt->get_result();
}

function get_contact_categories() {
    global $conn;
    $sql = "SELECT DISTINCT category FROM emergency_contacts ORDER BY category";
    return $conn->query($sql);
}
