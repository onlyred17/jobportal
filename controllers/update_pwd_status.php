<?php
session_start();
include '../include/db_conn.php';

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $id = $_POST['id'];
    $status = $_POST['status'];

    // Validate input
    if (!in_array($status, ['approved', 'rejected', 'for_printing', 'for_release', 'released'])) {
        $_SESSION['message'] = ['type' => 'danger', 'text' => 'Invalid status selected.'];
        header('Location: ../views/view_admin_manage_pwd.php');
        exit();
    }

    // Fetch full name before updating
    $query = "SELECT full_name FROM pwd_registration WHERE id = :id";
    $stmt = $conn->prepare($query);
    $stmt->bindParam(':id', $id);
    $stmt->execute();
    $pwd = $stmt->fetch(PDO::FETCH_ASSOC);

    if ($pwd) {
        $full_name = $pwd['full_name'];

        // Update status in the database
        $query = "UPDATE pwd_registration SET status = :status WHERE id = :id";
        $stmt = $conn->prepare($query);
        $stmt->bindParam(':status', $status);
        $stmt->bindParam(':id', $id);
        
        if ($stmt->execute()) {
            $_SESSION['message'] = ['type' => 'success', 'text' => 'Status updated successfully.', 'full_name' => $full_name, 'status' => $status];
        } else {
            $_SESSION['message'] = ['type' => 'danger', 'text' => 'Failed to update status.'];
        }
    } else {
        $_SESSION['message'] = ['type' => 'danger', 'text' => 'PWD record not found.'];
    }

    header('Location: ../views/view_admin_pwd_registration.php');
    exit();
} else {
    $_SESSION['message'] = ['type' => 'danger', 'text' => 'Invalid request.'];
    header('Location: ../views/view_admin_pwd_registration.php');
    exit();
}
