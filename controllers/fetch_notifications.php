<?php
session_start();
require '../include/db_conn.php'; // Adjust path to your database connection file

if ($_SESSION['user_type'] !== 'admin') {
    echo json_encode(['error' => 'Unauthorized']);
    exit;
}

try {
    // Prepare and execute the query using PDO
    $stmt = $pdo->prepare("SELECT id, full_name, created_at FROM pwd_registration ORDER BY created_at DESC LIMIT 5");
    $stmt->execute();
    
    $notifications = [];
    while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
        $notifications[] = [
            'id' => $row['id'],
            'message' => "New PWD registration: " . $row['full_name'],
            'timestamp' => $row['created_at']
        ];
    }

    echo json_encode($notifications);
} catch (PDOException $e) {
    echo json_encode(['error' => 'Database error: ' . $e->getMessage()]);
}
?>
