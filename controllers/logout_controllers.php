<?php
session_start();

if (!isset($_SESSION['usertype'])) {
    // Redirect to a default login page if usertype is not set
    header("Location: ../views/view_staff_login.php");
    exit;
}

// Get user type
$usertype = $_SESSION['usertype'];

// Destroy session
session_unset();
session_destroy();

// Redirect based on user type
if ($usertype === 'admin') {
    header("Location: ../views/view_admin_login.php");
} elseif ($usertype === 'employer') {
    header("Location: ../views/view_employer_login.php");
} else {
    header("Location: ../views/view_staff_login.php"); // Default login page
}
exit;
?>
