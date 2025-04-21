<?php
session_start();
include '../include/db_conn.php'; // Include database connection

if (!isset($_SESSION['usertype'])) {
    // Redirect to a default login page if usertype is not set
    header("Location: ../views/view_staff_login.php");
    exit;
}

// Get user details before destroying the session
$user_id = $_SESSION['admin_id'] ?? $_SESSION['staff_id'] ?? null;
$full_name = ($_SESSION['first_name'] ?? '') . ' ' . ($_SESSION['last_name'] ?? '');
$usertype = $_SESSION['usertype'];
$ip_address = $_SERVER['REMOTE_ADDR']; // Get user's IP address
$action = 'Logout';
$description_log = "User logged out.";

// Insert into audit log before destroying session
if ($user_id) {
    try {
        $audit_sql = "INSERT INTO audit_log (user_id, full_name, action, description, ip_address, usertype) 
                      VALUES (:user_id, :full_name, :action, :description, :ip_address, :usertype)";
        $audit_stmt = $conn->prepare($audit_sql);
        $audit_stmt->bindParam(':user_id', $user_id);
        $audit_stmt->bindParam(':full_name', $full_name);
        $audit_stmt->bindParam(':action', $action);
        $audit_stmt->bindParam(':description', $description_log);
        $audit_stmt->bindParam(':ip_address', $ip_address);
        $audit_stmt->bindParam(':usertype', $usertype);
        $audit_stmt->execute();
    } catch (PDOException $e) {
        error_log("Audit log error: " . $e->getMessage()); // Log the error instead of displaying it
    }
}

// Destroy session
session_unset();
session_destroy();

// Redirect based on user type
if ($usertype === 'admin') {
    header("Location: ../views/view_admin_login.php");
} elseif ($usertype === 'super_admin') {
    header("Location: ../views/view_super_admin_login.php");
} else {
    header("Location: ../views/view_staff_login.php"); // Default login page
}
exit;
?>
