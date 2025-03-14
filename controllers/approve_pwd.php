<?php
session_start();
include '../include/db_conn.php';

if (isset($_GET['id']) && isset($_GET['full_name'])) {
    $id = $_GET['id'];
    $full_name = urldecode($_GET['full_name']);

    // Update the status to approved
    $query = "UPDATE pwd_registration SET status = 'approved' WHERE id = ?";
    $stmt = $conn->prepare($query);
    
    if ($stmt->execute([$id])) {
        $_SESSION['message'] = [
            'type' => 'success',
            'text' => "PWD registration for $full_name has been approved.",
        ];
    } else {
        $_SESSION['message'] = [
            'type' => 'danger',
            'text' => "Failed to approve PWD registration for $full_name.",
        ];
    }
}

header("Location: ../views/view_admin_pwd_registration.php");
exit;
