<?php
session_start();
include '../include/db_conn.php';

// Check if super admin is logged in
if (!isset($_SESSION['super_admin_id']) || $_SESSION['usertype'] !== 'super_admin') {
    $_SESSION['message'] = ['type' => 'danger', 'text' => 'Unauthorized access.'];
    header("Location: ../login.php");
    exit();
}

// Check if form was submitted
if ($_SERVER["REQUEST_METHOD"] !== "POST") {
    $_SESSION['message'] = ['type' => 'danger', 'text' => 'Invalid request method.'];
    header("Location: ../views/view_super_admin_manage_admin.php");
    exit();
}

// Validate inputs
if (!isset($_POST['admin_id'], $_POST['status'])) {
    $_SESSION['message'] = ['type' => 'danger', 'text' => 'Missing required fields.'];
    header("Location: ../views/view_super_admin_manage_admin.php");
    exit();
}

$admin_id = filter_var($_POST['admin_id'], FILTER_VALIDATE_INT);
$status = trim($_POST['status']);
$valid_statuses = ['Active', 'Inactive'];

if (!$admin_id || !in_array($status, $valid_statuses)) {
    $_SESSION['message'] = ['type' => 'danger', 'text' => 'Invalid admin ID or status.'];
    header("Location: ../views/view_super_admin_manage_admin.php");
    exit();
}

try {
    // Fetch the admin's name before updating
    $query = "SELECT first_name, last_name FROM admin WHERE admin_id = :admin_id";
    $stmt = $conn->prepare($query);
    $stmt->bindParam(':admin_id', $admin_id, PDO::PARAM_INT);
    $stmt->execute();
    $admin = $stmt->fetch(PDO::FETCH_ASSOC);

    if (!$admin) {
        $_SESSION['message'] = ['type' => 'danger', 'text' => 'Admin not found.'];
        header("Location: ../views/view_super_admin_manage_admin.php");
        exit();
    }

    $admin_name = $admin['first_name'] . ' ' . $admin['last_name'];

    // Update admin status
    $sql = "UPDATE admin SET status = :status WHERE admin_id = :admin_id";
    $stmt = $conn->prepare($sql);
    $stmt->bindParam(':status', $status, PDO::PARAM_STR);
    $stmt->bindParam(':admin_id', $admin_id, PDO::PARAM_INT);

    if ($stmt->execute()) {
        // Log the status update
        $super_admin_id = $_SESSION['super_admin_id'];
        $super_admin_name = $_SESSION['first_name'] . ' ' . $_SESSION['last_name'];
        $ip_address = $_SERVER['REMOTE_ADDR'];
        $action = "STATUS_UPDATE";
        $description = "Super Admin $super_admin_name (ID: $super_admin_id) set $admin_name (ID: $admin_id) to $status.";

        $log_sql = "INSERT INTO audit_log (user_id, full_name, action, description, ip_address, usertype, created_at) 
                    VALUES (:user_id, :full_name, :action, :description, :ip_address, 'super_admin', NOW())";
        $log_stmt = $conn->prepare($log_sql);
        $log_stmt->bindParam(':user_id', $super_admin_id, PDO::PARAM_INT);
        $log_stmt->bindParam(':full_name', $super_admin_name, PDO::PARAM_STR);
        $log_stmt->bindParam(':action', $action, PDO::PARAM_STR);
        $log_stmt->bindParam(':description', $description, PDO::PARAM_STR);
        $log_stmt->bindParam(':ip_address', $ip_address, PDO::PARAM_STR);
        $log_stmt->execute();

        $_SESSION['message'] = [
            'type' => 'success',
            'text' => "Admin status updated successfully.",
            'full_name' => $admin_name
        ];
    } else {
        $_SESSION['message'] = ['type' => 'danger', 'text' => 'Failed to update admin status.'];
    }
} catch (PDOException $e) {
    $_SESSION['message'] = ['type' => 'danger', 'text' => 'Database error: ' . $e->getMessage()];
}

// Redirect back to manage admin page
header("Location: ../views/view_super_admin_manage_admin.php");
exit();
