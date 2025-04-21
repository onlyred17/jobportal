<?php
session_start();
require '../include/db_conn.php'; // Ensure this file initializes a PDO connection

try {
    // Get the logged-in admin's ID from the session
    $admin_id = $_SESSION['admin_id']; // Ensure this session variable is set

    // Mark the notifications as seen for this specific admin
    $stmt = $conn->prepare("UPDATE notification_admin SET seen = 1 WHERE admin_id = ? AND seen = 0");
    $stmt->execute([$admin_id]);

    echo json_encode(['success' => true]);
} catch (PDOException $e) {
    echo json_encode(['error' => $e->getMessage()]);
}
?>
