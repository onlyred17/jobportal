<?php
session_start();
require_once '../include/db_conn.php';

// Check if the email session is set
if (!isset($_SESSION['email']) || empty($_SESSION['email'])) {
    $_SESSION['error_message'] = 'No email found. Please request a password reset.';
    header('Location: ../views/view_super_admin_forgot_password.php');
    exit;
}

$email = $_SESSION['email'];

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $newPassword = $_POST['new_password'];
    $confirmPassword = $_POST['confirm_password'];

    // Check if passwords match
    if ($newPassword !== $confirmPassword) {
        $_SESSION['error_message'] = 'Passwords do not match.';
        header('Location: ../views/view_super_admin_reset_password.php');
        exit;
    }

    // Hash the new password
    $hashedPassword = password_hash($newPassword, PASSWORD_DEFAULT);

    // Prepare the SQL statement
    $stmt = $conn->prepare("UPDATE super_admin SET password = :password, verification_code = NULL WHERE email = :email");
    $stmt->bindParam(':password', $hashedPassword);
    $stmt->bindParam(':email', $email);

    // Execute the statement and check for success
    if ($stmt->execute()) {
        unset($_SESSION['email']);
        $_SESSION['message'] = 'Password reset successful. You can now log in.';
        header('Location: ../views/view_super_admin_reset_password.php');
        exit;
    } else {
        $_SESSION['error_message'] = 'Failed to update password. Please try again.';
        header('Location: ../views/view_super_admin_reset_password.php');
        exit;
    }
}

?>
