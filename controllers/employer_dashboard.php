<?php
session_start();

// Check if the user is logged in
if (!isset($_SESSION['employer_id'])) {
    header('Location: ../employer_login.php');
    exit;
}

// Fetch data for graphs (example data)
$applicationsData = [12, 19, 3, 5, 2, 3]; // Replace with database query
$jobsData = [5, 10, 7, 12, 8, 15]; // Replace with database query

// Include the view
include '../views/view_employer_dashboard.php';
?>