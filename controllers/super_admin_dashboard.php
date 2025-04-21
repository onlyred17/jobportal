<?php
session_start();
include '../include/db_conn.php'; // Database connection

// Check if the user is logged in as super admin
if (!isset($_SESSION['super_admin_id'])) {
    header('Location: ../views/view_super_admin_login.php');
    exit;
}

$super_admin_id = $_SESSION['super_admin_id'];

// Fetch total staff
$stmt = $conn->prepare("SELECT COUNT(*) as total_staff FROM staff WHERE status = 'active'");
$stmt->execute();
$staff_stats = $stmt->fetch(PDO::FETCH_ASSOC);

// Fetch total admins
$stmt = $conn->prepare("SELECT COUNT(*) as total_admins FROM admin");
$stmt->execute();
$admin_stats = $stmt->fetch(PDO::FETCH_ASSOC);

// Fetch total jobs
$stmt = $conn->prepare("SELECT COUNT(*) as total_jobs FROM jobs");
$stmt->execute();
$job_stats = $stmt->fetch(PDO::FETCH_ASSOC);

// Fetch open and closed jobs
$stmt = $conn->prepare("SELECT 
    SUM(CASE WHEN status = 'open' THEN 1 ELSE 0 END) AS open_jobs,
    SUM(CASE WHEN status = 'closed' THEN 1 ELSE 0 END) AS closed_jobs
FROM jobs");
$stmt->execute();
$job_status = $stmt->fetch(PDO::FETCH_ASSOC);

// Fetch total companies
$stmt = $conn->prepare("SELECT COUNT(*) as total_companies FROM company");
$stmt->execute();
$company_stats = $stmt->fetch(PDO::FETCH_ASSOC);

// Fetch daily, weekly, and monthly job postings
$jobPostings = [];
$timeFrames = [
    'daily' => "DATE(posted_date) = CURDATE()",
    'weekly' => "YEARWEEK(posted_date) = YEARWEEK(CURDATE())",
    'monthly' => "MONTH(posted_date) = MONTH(CURDATE()) AND YEAR(posted_date) = YEAR(CURDATE())"
];

foreach ($timeFrames as $key => $condition) {
    $stmt = $conn->prepare("SELECT COUNT(*) as count FROM jobs WHERE $condition");
    $stmt->execute();
    $jobPostings[$key] = $stmt->fetch(PDO::FETCH_ASSOC)['count'] ?? 0;
}

// Store all stats in an array
$super_admin_stats = [
    'total_staff' => $staff_stats['total_staff'] ?? 0,
    'total_admins' => $admin_stats['total_admins'] ?? 0,
    'total_jobs' => $job_stats['total_jobs'] ?? 0,
    'open_jobs' => $job_status['open_jobs'] ?? 0,
    'closed_jobs' => $job_status['closed_jobs'] ?? 0,
    'total_companies' => $company_stats['total_companies'] ?? 0,
    'job_postings' => $jobPostings
];
?>