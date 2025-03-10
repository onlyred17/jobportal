<?php
if (session_status() === PHP_SESSION_NONE) {
    session_start();
}

include '../include/db_conn.php';

// Check if the user is logged in
if (!isset($_SESSION['staff_id'])) {
    header('Location: ../views/view_staff_login.php');
    exit;
}

// Get start and end dates
$startDate = isset($_GET['start_date']) ? $_GET['start_date'] : '';
$endDate = isset($_GET['end_date']) ? $_GET['end_date'] : '';

try {
    if (!empty($startDate) && !empty($endDate)) {
        $stmt = $conn->prepare("SELECT * FROM jobs WHERE posted_date BETWEEN :start_date AND :end_date ORDER BY posted_date DESC");
        $stmt->bindParam(':start_date', $startDate);
        $stmt->bindParam(':end_date', $endDate);
    } else {
        $stmt = $conn->prepare("SELECT * FROM jobs ORDER BY posted_date DESC");
    }

    $stmt->execute();
    $jobs = $stmt->fetchAll(PDO::FETCH_ASSOC);

    // 🚀 Debugging: Ensure $jobs is an array
    if (!is_array($jobs)) {
        die("Error: Jobs data is not an array.");
    }
} catch (PDOException $e) {
    die("Database error: " . $e->getMessage());
}
?>
