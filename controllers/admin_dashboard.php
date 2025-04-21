<?php
session_start();
include '../include/db_conn.php'; // Database connection

// Check if the user is logged in as admin
if (!isset($_SESSION['admin_id'])) {
    header('Location: ../views/view_admin_login.php');
    exit;
}

$admin_id = $_SESSION['admin_id'];

// Fetch total stats
$stmt = $conn->prepare("SELECT COUNT(*) as total_pwd_registrations FROM pwd_registration");
$stmt->execute();
$pwd_stats = $stmt->fetch(PDO::FETCH_ASSOC);

$stmt = $conn->prepare("SELECT COUNT(*) as total_staff, 
    SUM(CASE WHEN status = 'Active' THEN 1 ELSE 0 END) as active_staff 
    FROM staff"); // Updated table reference
$stmt->execute();
$staff_stats = $stmt->fetch(PDO::FETCH_ASSOC);

$stmt = $conn->prepare("SELECT COUNT(*) as total_jobs FROM jobs");
$stmt->execute();
$job_stats = $stmt->fetch(PDO::FETCH_ASSOC);

// Monthly PWD registrations
$stmt = $conn->prepare("
    SELECT DATE_FORMAT(created_at, '%b') as month, COUNT(*) as registrations
    FROM pwd_registration
    GROUP BY month ORDER BY MIN(created_at)
");
$stmt->execute();
$pwdData = $stmt->fetchAll(PDO::FETCH_ASSOC);

// Monthly job postings
$stmt = $conn->prepare("
    SELECT DATE_FORMAT(posted_date, '%b') as month, COUNT(*) as jobs_posted
    FROM jobs 
    GROUP BY month ORDER BY MIN(posted_date)
");
$stmt->execute();
$jobsData = $stmt->fetchAll(PDO::FETCH_ASSOC);

// Initialize month arrays
$months = ['Jan', 'Feb', 'Mar', 'Apr', 'May', 'Jun', 'Jul', 'Aug', 'Sep', 'Oct', 'Nov', 'Dec'];
$pwdRegistrations = array_fill_keys($months, 0);
$jobPostings = array_fill_keys($months, 0);

// Fill arrays with real data
foreach ($pwdData as $pwd) {
    $pwdRegistrations[$pwd['month']] = $pwd['registrations'];
}

foreach ($jobsData as $job) {
    $jobPostings[$job['month']] = $job['jobs_posted'];
}

// Store all stats in an array
$admin_stats = [
    'total_pwd_registrations' => $pwd_stats['total_pwd_registrations'] ?? 0,
    'total_staff' => $staff_stats['total_staff'] ?? 0,
    'active_staff' => $staff_stats['active_staff'] ?? 0,
    'total_jobs' => $job_stats['total_jobs'] ?? 0
];
?>
