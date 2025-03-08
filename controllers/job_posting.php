<?php
session_start();

// Check if the user is logged in
if (!isset($_SESSION['employer_id'])) {
    header('Location: ../employer_login.php');
    exit;
}

// Handle form submission
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $jobTitle = $_POST['jobTitle'];
    $jobDescription = $_POST['jobDescription'];
    $jobLocation = $_POST['jobLocation'];
    // Save to database (add your logic here)
}

// Include the view
include '../views/view_job_posting.php';
?>