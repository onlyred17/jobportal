<?php
session_start();
include '../include/db_conn.php'; // Include the database connection file

// Check if the user is logged in
if (!isset($_SESSION['staff_id'])) {
    header('Location: ../views/view_staff_login.php');
    exit;
}

$staff_id = $_SESSION['staff_id']; // Logged-in staff ID

// Fetch all jobs posted in the jobs table
$stmt = $conn->prepare("SELECT * FROM jobs ORDER BY posted_date DESC");
$stmt->execute();
$all_jobs = $stmt->fetchAll(PDO::FETCH_ASSOC);

// Fetch jobs posted by the logged-in staff
$stmt = $conn->prepare("SELECT * FROM jobs WHERE staff_id = :staff_id ORDER BY posted_date DESC");
$stmt->execute([':staff_id' => $staff_id]);
$staff_jobs = $stmt->fetchAll(PDO::FETCH_ASSOC);

// Fetch job statistics for the logged-in staff
$stmt = $conn->prepare("SELECT 
        COUNT(*) as total_jobs,
        SUM(CASE WHEN status = 'Open' THEN 1 ELSE 0 END) as active_jobs,
        SUM(CASE WHEN status = 'Closed' THEN 1 ELSE 0 END) as closed_jobs
    FROM jobs");
$stmt->execute();
$job_stats = $stmt->fetch(PDO::FETCH_ASSOC);

// Fetch total jobs posted by the logged-in staff
$jobs_posted_by_you = count($staff_jobs);

// Fetch total jobs posted by others
$stmt = $conn->prepare("SELECT COUNT(*) as jobs_posted_by_others FROM jobs WHERE staff_id != :staff_id");
$stmt->execute([':staff_id' => $staff_id]);
$jobs_posted_by_others = $stmt->fetch(PDO::FETCH_ASSOC)['jobs_posted_by_others'];

// Fetch monthly job posting data for graphs
$stmt = $conn->prepare("
    SELECT DATE_FORMAT(posted_date, '%b') as month, COUNT(*) as jobs_posted
    FROM jobs 
    WHERE staff_id = :staff_id 
    GROUP BY month 
    ORDER BY posted_date
");
$stmt->execute([':staff_id' => $staff_id]);
$jobsData = $stmt->fetchAll(PDO::FETCH_ASSOC);

// Prepare data for graphs
$months = ['Jan', 'Feb', 'Mar', 'Apr', 'May', 'Jun', 'Jul', 'Aug', 'Sep', 'Oct', 'Nov', 'Dec'];
$jobsPosted = array_fill_keys($months, 0);

foreach ($jobsData as $job) {
    $jobsPosted[$job['month']] = $job['jobs_posted'];
}
// Weekly job posting count for the staff
$stmt = $conn->prepare("
    SELECT WEEK(posted_date) as week, COUNT(*) as jobs_posted
    FROM jobs 
    WHERE staff_id = :staff_id 
    GROUP BY week
    ORDER BY week
");
$stmt->execute([':staff_id' => $staff_id]);
$weeklyData = $stmt->fetchAll(PDO::FETCH_ASSOC);

// Prepare weekly job data for the graph (just the total count of jobs posted in each week)
$weeks = array();
$jobsPostedWeekly = array_fill_keys($weeks, 0);
foreach ($weeklyData as $job) {
    $weeks[] = 'Week ' . $job['week']; // Add labels for weeks
    $jobsPostedWeekly[] = $job['jobs_posted']; // Store the count of jobs posted
}

// Daily job posting count for the staff
$stmt = $conn->prepare("
    SELECT DAYOFYEAR(posted_date) as day, COUNT(*) as jobs_posted
    FROM jobs 
    WHERE staff_id = :staff_id 
    GROUP BY day
    ORDER BY day
");
$stmt->execute([':staff_id' => $staff_id]);
$dailyData = $stmt->fetchAll(PDO::FETCH_ASSOC);

// Prepare daily job data for the graph (just the total count of jobs posted in each day)
$days = array();
$jobsPostedDaily = array_fill_keys($days, 0);
foreach ($dailyData as $job) {
    $days[] = 'Day ' . $job['day']; // Add labels for days
    $jobsPostedDaily[] = $job['jobs_posted']; // Store the count of jobs posted
}

?>
