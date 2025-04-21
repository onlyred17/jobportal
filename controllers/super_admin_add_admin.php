<?php
session_start();
include '../include/db_conn.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $first_name = trim($_POST['first_name']);
    $last_name = trim($_POST['last_name']);
    $email = trim($_POST['email']);
    $password = password_hash($_POST['password'], PASSWORD_DEFAULT); // Secure password
    $created_at = date('Y-m-d H:i:s');
    $status = 'active'; // Default status
    $usertype = 'admin'; // Default user type
    $profilePicPath = '../images/default_profile.jpg'; // Default profile picture

    // Check if admin email already exists
    $checkSql = "SELECT admin_id FROM admin WHERE email = :email";
    $checkStmt = $conn->prepare($checkSql);
    $checkStmt->bindParam(':email', $email);
    $checkStmt->execute();

    if ($checkStmt->rowCount() > 0) {
        $_SESSION['message'] = ['type' => 'error', 'text' => 'Admin with this email already exists!'];
        header('Location: ../views/view_super_admin_manage_admin.php');
        exit;
    }

    // Insert into database
    try {
        $sql = "INSERT INTO admin (first_name, last_name, email, password, profile_pic, created_at, status, usertype) 
                VALUES (:first_name, :last_name, :email, :password, :profile_pic, :created_at, :status, :usertype)";
        $stmt = $conn->prepare($sql);
        $stmt->bindParam(':first_name', $first_name);
        $stmt->bindParam(':last_name', $last_name);
        $stmt->bindParam(':email', $email);
        $stmt->bindParam(':password', $password);
        $stmt->bindParam(':profile_pic', $profilePicPath);
        $stmt->bindParam(':created_at', $created_at);
        $stmt->bindParam(':status', $status);
        $stmt->bindParam(':usertype', $usertype);
        $stmt->execute();

        $_SESSION['message'] = ['type' => 'success', 'text' => 'Admin added successfully!'];

        // Insert into audit log for admin creation
        $user_id = isset($_SESSION['super_admin_id']) ? $_SESSION['super_admin_id'] : null;
        $full_name = isset($_SESSION['first_name']) && isset($_SESSION['last_name']) ? $_SESSION['first_name'] . ' ' . $_SESSION['last_name'] : 'Unknown';
        $ip_address = $_SERVER['REMOTE_ADDR'];
        $action = 'Create';
        $description_log = "Admin '{$first_name} {$last_name}' added";
        $usertype = 'super_admin';

        // Insert the audit log
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
        $_SESSION['message'] = ['type' => 'error', 'text' => 'Database error: ' . $e->getMessage()];
    }

    // Redirect to avoid form resubmission
    header('Location: ../views/view_super_admin_manage_admin.php');
    exit;
}
