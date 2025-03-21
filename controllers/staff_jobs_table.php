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

// Get filter inputs
$startDate = isset($_GET['start_date']) ? $_GET['start_date'] : '';
$endDate = isset($_GET['end_date']) ? $_GET['end_date'] : '';
$statusFilter = isset($_GET['status']) ? $_GET['status'] : '';

// Prepare query with optional filters
$query = "SELECT * FROM jobs WHERE 1=1";
$params = [];

if (!empty($startDate) && !empty($endDate)) {
    $query .= " AND posted_date BETWEEN :start_date AND :end_date";
    $params[':start_date'] = $startDate;
    $params[':end_date'] = $endDate;
}

if (!empty($statusFilter)) {
    $query .= " AND status = :status";
    $params[':status'] = $statusFilter;
}

// Ensure sorting from latest to old by posted_date DESC
$query .= " ORDER BY posted_date DESC";

try {
    $stmt = $conn->prepare($query);
    $stmt->execute($params);
    $jobs = $stmt->fetchAll(PDO::FETCH_ASSOC);

    // 🚀 Debugging: Ensure $jobs is an array
    if (!is_array($jobs)) {
        die("Error: Jobs data is not an array.");
    }
} catch (PDOException $e) {
    die("Database error: " . $e->getMessage());
}
?>
