<?php

// Check if the user is logged in
if (!isset($_SESSION['staff_id'])) {
    header('Location: ../views/view_staff_login.php');
    exit;
}

// Fetch employer details from the session
$employerId = $_SESSION['staff_id']; // Assuming staff_id is stored in the session
$firstName = $_SESSION['first_name'] ?? 'Staff';
$lastName = $_SESSION['last_name'] ?? '';
$profilePicture = $_SESSION['profile_pic'] ?? '../images/default-profile.jpg';

$employerName = trim("$firstName $lastName");

// Connect to the database
include '../include/db_conn.php';

// Fetch the 5 most recent jobs posted in the last 24 hours (or any other condition)
$query = "SELECT * FROM jobs WHERE posted_date > NOW() - INTERVAL 1 DAY ORDER BY posted_date DESC LIMIT 5"; // Adjust the query as needed
$stmt = $conn->prepare($query);
$stmt->execute();
$newJobs = $stmt->fetchAll(PDO::FETCH_ASSOC);

// Count the number of new jobs (notifications)
$newJobsCount = count($newJobs);

// Store the notification count in the session to display it on other pages
$_SESSION['newJobsCount'] = $newJobsCount;
?>
