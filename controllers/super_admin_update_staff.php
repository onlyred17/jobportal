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
    header("Location: ../views/view_super_admin_manage_staff.php");
    exit();
}

// Validate inputs
if (!isset($_POST['staff_id'], $_POST['status'])) {
    $_SESSION['message'] = ['type' => 'danger', 'text' => 'Missing required fields.'];
    header("Location: ../views/view_super_admin_manage_staff.php");
    exit();
}

$staff_id = filter_var($_POST['staff_id'], FILTER_VALIDATE_INT);
$status = trim($_POST['status']);
$valid_statuses = ['Active', 'Inactive'];

if (!$staff_id || !in_array($status, $valid_statuses)) {
    $_SESSION['message'] = ['type' => 'danger', 'text' => 'Invalid staff ID or status.'];
    header("Location: ../views/view_super_admin_manage_staff.php");
    exit();
}

try {
    // Fetch the staff member's name before updating
    $query = "SELECT first_name, last_name FROM staff WHERE staff_id = :staff_id";
    $stmt = $conn->prepare($query);
    $stmt->bindParam(':staff_id', $staff_id, PDO::PARAM_INT);
    $stmt->execute();
    $staff = $stmt->fetch(PDO::FETCH_ASSOC);

    if (!$staff) {
        $_SESSION['message'] = ['type' => 'danger', 'text' => 'Staff member not found.'];
        header("Location: ../views/view_super_admin_manage_staff.php");
        exit();
    }

    $staff_name = $staff['first_name'] . ' ' . $staff['last_name'];

    // Update staff status
    $sql = "UPDATE staff SET status = :status WHERE staff_id = :staff_id";
    $stmt = $conn->prepare($sql);
    $stmt->bindParam(':status', $status, PDO::PARAM_STR);
    $stmt->bindParam(':staff_id', $staff_id, PDO::PARAM_INT);

    if ($stmt->execute()) {
        // Log the status update
        $super_admin_id = $_SESSION['super_admin_id'];
        $super_admin_name = $_SESSION['first_name'] . ' ' . $_SESSION['last_name'];
        $ip_address = $_SERVER['REMOTE_ADDR'];
        $action = "STATUS_UPDATE";
        $description = "Super Admin $super_admin_name (ID: $super_admin_id) set $staff_name (ID: $staff_id) to $status.";

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
            'text' => "Staff status updated successfully.",
            'full_name' => $staff_name
        ];
    } else {
        $_SESSION['message'] = ['type' => 'danger', 'text' => 'Failed to update staff status.'];
    }
} catch (PDOException $e) {
    $_SESSION['message'] = ['type' => 'danger', 'text' => 'Database error: ' . $e->getMessage()];
}

// Redirect back to manage staff page
header("Location: ../views/view_super_admin_manage_staff.php");
exit();
