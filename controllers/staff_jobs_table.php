<?php
session_start();
include '../include/db_conn.php'; // Include the database connection file

// Check if the user is logged in
if (!isset($_SESSION['staff_id'])) {
    header(header: 'Location: ../views/view_staff_login.php');
    exit;
}

// Check if start and end dates are provided
$startDate = isset($_GET['start_date']) ? $_GET['start_date'] : '';
$endDate = isset($_GET['end_date']) ? $_GET['end_date'] : '';

// Modify the query to apply date filter if both start and end dates are provided
if ($startDate && $endDate) {
    // Assuming your jobs table has a 'posted_date' column in 'YYYY-MM-DD' format
    $stmt = $conn->prepare("SELECT * FROM jobs WHERE posted_date BETWEEN :start_date AND :end_date ORDER BY posted_date DESC");
    $stmt->bindParam(':start_date', $startDate);
    $stmt->bindParam(':end_date', $endDate);
} else {
    // If no date filter, fetch all jobs
    $stmt = $conn->prepare("SELECT * FROM jobs ORDER BY posted_date DESC");
}

// Execute the query and fetch all jobs
$stmt->execute();
$jobs = $stmt->fetchAll(PDO::FETCH_ASSOC);
?>
