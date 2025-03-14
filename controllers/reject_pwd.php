<?php
session_start();
include '../include/db_conn.php';

if (isset($_GET['id']) && isset($_GET['full_name'])) {
    $id = $_GET['id'];
    $full_name = urldecode($_GET['full_name']);

    // Update the status to rejected
    $query = "UPDATE pwd_registration SET status = 'rejected' WHERE id = ?";
    $stmt = $conn->prepare($query);
    
    if ($stmt->execute([$id])) {
        $_SESSION['message'] = [
            'type' => 'warning',
            'text' => "PWD registration for $full_name has been rejected.",
        ];
    } else {
        $_SESSION['message'] = [
            'type' => 'danger',
            'text' => "Failed to reject PWD registration for $full_name.",
        ];
    }
}

header("Location: ../views/view_admin_pwd_registration.php");
exit;
