<?php
session_start();
include '../include/db_conn.php'; // Database connection

// Check if the user is logged in as staff
if (!isset($_SESSION['staff_id'])) {
    header('Location: ../views/view_staff_login.php');
    exit;
}

$staff_id = $_SESSION['staff_id'];

// Fetch job statistics
$job_stats = [];
if ($conn) {
    // Total jobs
    $total_jobs_query = "SELECT COUNT(*) as total_jobs FROM jobs";
    $total_jobs_result = $conn->prepare($total_jobs_query);
    $total_jobs_result->execute();
    $total_jobs_data = $total_jobs_result->fetch(PDO::FETCH_ASSOC);
    $job_stats['total_jobs'] = $total_jobs_data['total_jobs'] ?? 0;
    
    // Active jobs
    $active_jobs_query = "SELECT COUNT(*) as active_jobs FROM jobs WHERE status = 'Open'";
    $active_jobs_result = $conn->prepare($active_jobs_query);
    $active_jobs_result->execute();
    $active_jobs_data = $active_jobs_result->fetch(PDO::FETCH_ASSOC);
    $job_stats['active_jobs'] = $active_jobs_data['active_jobs'] ?? 0;
    
    // Closed jobs
    $closed_jobs_query = "SELECT COUNT(*) as closed_jobs FROM jobs WHERE status = 'Closed'";
    $closed_jobs_result = $conn->prepare($closed_jobs_query);
    $closed_jobs_result->execute();
    $closed_jobs_data = $closed_jobs_result->fetch(PDO::FETCH_ASSOC);
    $job_stats['closed_jobs'] = $closed_jobs_data['closed_jobs'] ?? 0;
    
    // Jobs posted by current staff (with status)
    $staff_jobs_query = "SELECT j.title, j.description, j.posted_date, j.status, j.company_name 
                         FROM jobs j
                         WHERE j.staff_id = :staff_id 
                         ORDER BY j.posted_date DESC";
    $staff_jobs_result = $conn->prepare($staff_jobs_query);
    $staff_jobs_result->bindParam(':staff_id', $staff_id);
    $staff_jobs_result->execute();
    $staff_jobs = $staff_jobs_result->fetchAll(PDO::FETCH_ASSOC);
    
    // Calculate jobs posted by others
    $jobs_posted_by_others = $job_stats['total_jobs'] - count($staff_jobs);
    
    // Fetch recent job posts from this staff member
    $recent_jobs_query = "SELECT j.staff_id, j.title, j.description, j.posted_date, j.status, j.company_name, s.first_name AS staff_name 
                          FROM jobs j 
                          LEFT JOIN staff s ON j.staff_id = s.staff_id 
                          WHERE j.staff_id = :staff_id 
                          ORDER BY j.posted_date DESC 
                          LIMIT 4";
    $recent_jobs_result = $conn->prepare($recent_jobs_query);
    $recent_jobs_result->bindParam(':staff_id', $staff_id);
    $recent_jobs_result->execute();
    $recent_jobs = $recent_jobs_result->fetchAll(PDO::FETCH_ASSOC);
}

// Monthly job postings
$months = ['Jan', 'Feb', 'Mar', 'Apr', 'May', 'Jun', 'Jul', 'Aug', 'Sep', 'Oct', 'Nov', 'Dec'];
$jobsPosted = array_fill_keys($months, 0);

if ($conn) {
    $monthly_jobs_query = "
        SELECT DATE_FORMAT(posted_date, '%b') as month, COUNT(*) as jobs_posted
        FROM jobs 
        GROUP BY month 
        ORDER BY MIN(posted_date)
    ";
    $monthly_jobs_result = $conn->prepare($monthly_jobs_query);
    $monthly_jobs_result->execute();
    $monthly_jobs_data = $monthly_jobs_result->fetchAll(PDO::FETCH_ASSOC);
    
    foreach ($monthly_jobs_data as $job) {
        $jobsPosted[$job['month']] = $job['jobs_posted'];
    }
}

// Weekly job postings (last 4 weeks)
$weeks = [];
$jobsPostedWeekly = [];

if ($conn) {
    $weekly_jobs_query = "
        SELECT WEEK(posted_date) as week_num, 
               CONCAT('Week ', WEEK(posted_date) - WEEK(DATE_SUB(CURDATE(), INTERVAL 4 WEEK)) + 1) as week_label,
               COUNT(*) as jobs_posted
        FROM jobs 
        WHERE posted_date >= DATE_SUB(CURDATE(), INTERVAL 4 WEEK)
        GROUP BY week_num
        ORDER BY week_num
    ";
    $weekly_jobs_result = $conn->prepare($weekly_jobs_query);
    $weekly_jobs_result->execute();
    $weekly_jobs_data = $weekly_jobs_result->fetchAll(PDO::FETCH_ASSOC);
    
    foreach ($weekly_jobs_data as $job) {
        $weeks[] = $job['week_label'];
        $jobsPostedWeekly[] = $job['jobs_posted'];
    }
}

// Daily job postings (last 7 days)
$days = [];
$jobsPostedDaily = [];

if ($conn) {
    $daily_jobs_query = "
        SELECT DATE_FORMAT(posted_date, '%a') as day_name, 
               COUNT(*) as jobs_posted
        FROM jobs 
        WHERE posted_date >= DATE_SUB(CURDATE(), INTERVAL 7 DAY)
        GROUP BY day_name
        ORDER BY FIELD(day_name, 'Mon', 'Tue', 'Wed', 'Thu', 'Fri', 'Sat', 'Sun')
    ";
    $daily_jobs_result = $conn->prepare($daily_jobs_query);
    $daily_jobs_result->execute();
    $daily_jobs_data = $daily_jobs_result->fetchAll(PDO::FETCH_ASSOC);
    
    foreach ($daily_jobs_data as $job) {
        $days[] = $job['day_name'];
        $jobsPostedDaily[] = $job['jobs_posted'];
    }
}
?>
