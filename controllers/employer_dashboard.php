<?php
session_start();
include '../include/db_conn.php'; // Include the database connection file

// Check if the user is logged in
if (!isset($_SESSION['employer_id'])) {
    header('Location: ../employer_login.php');
    exit;
}

// Fetch data for the dashboard
$employer_id = $_SESSION['employer_id'];

// Step 1: Fetch the company_id of the logged-in employer from the employer_company table
$stmt = $conn->prepare("SELECT company_id FROM employer_company WHERE employer_id = :employer_id");
$stmt->execute([':employer_id' => $employer_id]);
$employer_company = $stmt->fetch(PDO::FETCH_ASSOC);

if (!$employer_company) {
    die("Employer not associated with any company.");
}

$company_id = $employer_company['company_id'];

// Step 2: Fetch total jobs posted by the company
$stmt = $conn->prepare("SELECT COUNT(*) as total_jobs FROM jobs WHERE company_id = :company_id");
$stmt->execute([':company_id' => $company_id]);
$total_jobs = $stmt->fetch(PDO::FETCH_ASSOC)['total_jobs'];

// Step 3: Fetch total jobs posted by the logged-in employer
$stmt = $conn->prepare("SELECT COUNT(*) as employer_jobs FROM jobs WHERE employer_id = :employer_id");
$stmt->execute([':employer_id' => $employer_id]);
$employer_jobs = $stmt->fetch(PDO::FETCH_ASSOC)['employer_jobs'];

// Step 4: Fetch active jobs posted by the company
$stmt = $conn->prepare("SELECT COUNT(*) as active_jobs FROM jobs WHERE company_id = :company_id AND status = 'active'");
$stmt->execute([':company_id' => $company_id]);
$active_jobs = $stmt->fetch(PDO::FETCH_ASSOC)['active_jobs'];

// Step 5: Fetch closed jobs posted by the company
$stmt = $conn->prepare("SELECT COUNT(*) as closed_jobs FROM jobs WHERE company_id = :company_id AND status = 'closed'");
$stmt->execute([':company_id' => $company_id]);
$closed_jobs = $stmt->fetch(PDO::FETCH_ASSOC)['closed_jobs'];

// Step 6: Fetch monthly data for graphs (jobs posted by the company)
$stmt = $conn->prepare("
    SELECT 
        DATE_FORMAT(posted_date, '%b') as month, 
        COUNT(*) as jobs_posted 
    FROM jobs 
    WHERE company_id = :company_id 
    GROUP BY month 
    ORDER BY posted_date
");
$stmt->execute([':company_id' => $company_id]);
$jobsData = $stmt->fetchAll(PDO::FETCH_ASSOC);

// Prepare data for graphs
$months = ['Jan', 'Feb', 'Mar', 'Apr', 'May', 'Jun', 'Jul', 'Aug', 'Sep', 'Oct', 'Nov', 'Dec'];
$jobsPosted = array_fill_keys($months, 0);

foreach ($jobsData as $job) {
    $jobsPosted[$job['month']] = $job['jobs_posted'];
}
?>