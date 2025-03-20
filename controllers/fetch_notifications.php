<?php
session_start();
require '../include/db_conn.php'; // Ensure this file initializes a PDO connection

try {
    // Fetch all notifications but differentiate seen/unseen
    $stmt = $conn->prepare("SELECT id, full_name, created_at, seen 
                            FROM pwd_registration 
                            WHERE status = 'pending' 
                            ORDER BY created_at DESC");
    $stmt->execute();
    $notifications = $stmt->fetchAll(PDO::FETCH_ASSOC);

    // Count only unseen notifications
    $countUnseen = count(array_filter($notifications, fn($notif) => $notif['seen'] == 0));

    echo json_encode([
        'notifications' => $notifications,
        'count' => $countUnseen // Only count unseen ones
    ]);
} catch (PDOException $e) {
    echo json_encode(['error' => $e->getMessage()]);
}
?>
