<?php
// Include the database connection
include '../include/db_conn.php';  // Ensure this path is correct

// Fetch recent activities
$query = "SELECT full_name, action, description, ip_address, DATE(created_at) as date, TIME(created_at) as time, usertype
          FROM audit_log 
          ORDER BY created_at DESC LIMIT 5"; // Adjust the limit as needed

$stmt = $conn->prepare($query);
$stmt->execute();

// Fetch the results
$recent_activities = $stmt->fetchAll(PDO::FETCH_ASSOC);
?>
