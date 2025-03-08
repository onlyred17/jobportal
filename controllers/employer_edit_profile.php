<?php
session_start();

// Check if the user is logged in
if (!isset($_SESSION['employer_id'])) {
    header('Location: ../views/view_employer_login.php');
    exit;
}

// Handle form submission
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $firstName = $_POST['firstName'];
    $lastName = $_POST['lastName'];
    $email = $_POST['email'];
    $companyName = $_POST['companyName'];
    // Save to database (add your logic here)
}

// Include the view
include '../views/edit_profile.php';
?>