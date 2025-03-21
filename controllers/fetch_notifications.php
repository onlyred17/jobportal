<?php
session_start();
require '../include/db_conn.php'; // Ensure this file initializes a PDO connection

try {
    // Get the logged-in admin's ID from the session
    $admin_id = $_SESSION['admin_id']; // Ensure this session variable is set

    // Fetch notifications for this admin, along with the seen status
    $stmt = $conn->prepare("SELECT n.notification_id, n.message, n.created_at, na.seen 
                            FROM notifications n
                            JOIN notification_admin na ON n.notification_id = na.notification_id
                            WHERE na.admin_id = ?
                            ORDER BY n.created_at DESC");
    $stmt->execute([$admin_id]);
    $notifications = $stmt->fetchAll(PDO::FETCH_ASSOC);

    // Count only unseen notifications for this admin
    $countUnseen = count(array_filter($notifications, fn($notif) => $notif['seen'] == 0));

    // Return notifications and the count of unseen notifications
    echo json_encode([
        'notifications' => $notifications,
        'unseen_count' => $countUnseen // Only count unseen ones
    ]);
} catch (PDOException $e) {
    echo json_encode(['error' => $e->getMessage()]);
}
?>
