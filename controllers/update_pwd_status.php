<?php
session_start();
include '../include/db_conn.php';

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $id = $_POST['id'] ?? null;
    $status = $_POST['status'] ?? '';

    // Define valid statuses
    $valid_statuses = ['Approved', 'Rejected', 'For Printing', 'For Release', 'Released'];

    // Validate input
    if (!$id || !in_array($status, $valid_statuses)) {
        $_SESSION['message'] = ['type' => 'danger', 'text' => 'Invalid request. Please select a valid status.'];
        header('Location: ../views/view_admin_pwd_registration.php');
        exit();
    }

    try {
        // Fetch full name before updating
        $query = "SELECT full_name FROM pwd_registration WHERE id = :id";
        $stmt = $conn->prepare($query);
        $stmt->bindParam(':id', $id, PDO::PARAM_INT);
        $stmt->execute();
        $pwd = $stmt->fetch(PDO::FETCH_ASSOC);

        if ($pwd) {
            $full_name = $pwd['full_name'];

            // Update status in the database
            $query = "UPDATE pwd_registration SET status = :status WHERE id = :id";
            $stmt = $conn->prepare($query);
            $stmt->bindParam(':status', $status, PDO::PARAM_STR);
            $stmt->bindParam(':id', $id, PDO::PARAM_INT);
            
            if ($stmt->execute()) {
                $_SESSION['message'] = [
                    'type' => 'success',
                    'text' => "Status updated successfully for $full_name.",
                    'full_name' => $full_name,
                    'status' => $status
                ];
            } else {
                $_SESSION['message'] = ['type' => 'danger', 'text' => 'Failed to update status.'];
            }
        } else {
            $_SESSION['message'] = ['type' => 'danger', 'text' => 'PWD record not found.'];
        }
    } catch (PDOException $e) {
        $_SESSION['message'] = ['type' => 'danger', 'text' => 'Database error: ' . $e->getMessage()];
    }

    header('Location: ../views/view_admin_pwd_registration.php');
    exit();
} else {
    $_SESSION['message'] = ['type' => 'danger', 'text' => 'Invalid request method.'];
    header('Location: ../views/view_admin_pwd_registration.php');
    exit();
}
