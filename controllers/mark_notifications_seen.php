<?php
session_start();
require '../include/db_conn.php'; // Ensure this file initializes a PDO connection

try {
    // Mark all unseen notifications as seen
    $stmt = $conn->prepare("UPDATE pwd_registration SET seen = 1 WHERE seen = 0 AND status = 'pending'");
    $stmt->execute();

    echo json_encode(['success' => true]);
} catch (PDOException $e) {
    echo json_encode(['error' => $e->getMessage()]);
}
?>
