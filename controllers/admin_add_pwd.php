<?php
require_once '../include/db_conn.php';
session_start();

// Ensure the admin is logged in
if (!isset($_SESSION['admin_id']) || $_SESSION['usertype'] !== 'admin') {
    header("Location: ../login.php");
    exit();
}

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    try {
        // Get form data
        $full_name = $_POST['full_name'];
        $address = $_POST['address'];
        $contact_number = $_POST['contact_number'];
        $email = $_POST['email'];
        $birthdate = $_POST['birthdate'];
        $disability_type = $_POST['disability_type'];

        // Check if the email already exists in the database
        $check_email_sql = "SELECT COUNT(*) FROM registered_pwd WHERE email = :email";
        $check_email_stmt = $conn->prepare($check_email_sql);
        $check_email_stmt->bindParam(':email', $email);
        $check_email_stmt->execute();
        $email_count = $check_email_stmt->fetchColumn();

        if ($email_count > 0) {
            // Redirect with error message if email already exists
            header("Location: ../views/view_admin_manage_pwd.php?error=Email already exists");
            exit();
        }

        // Prepare SQL statement for insertion into registered_pwd table
        $sql = "INSERT INTO registered_pwd (full_name, address, contact_number, email, birthdate, disability_type) 
                VALUES (:full_name, :address, :contact_number, :email, :birthdate, :disability_type)";
        
        $stmt = $conn->prepare($sql); // Using $conn to prepare the query

        // Bind parameters
        $stmt->bindParam(':full_name', $full_name);
        $stmt->bindParam(':address', $address);
        $stmt->bindParam(':contact_number', $contact_number);
        $stmt->bindParam(':email', $email);
        $stmt->bindParam(':birthdate', $birthdate);
        $stmt->bindParam(':disability_type', $disability_type);

        // Execute query
        if ($stmt->execute()) {
            // Insert audit log
            $admin_name = $_SESSION['first_name'] . ' ' . $_SESSION['last_name'];
            $ip_address = $_SERVER['REMOTE_ADDR'];
            $action = "Added PWD to registered list";
            $description = "Admin $admin_name added PWD $full_name to the registered list.";
            
            $audit_sql = "INSERT INTO audit_log (user_id, full_name, action, description, ip_address, usertype) 
                          VALUES (:user_id, :full_name, :action, :description, :ip_address, 'admin')";
            
            $audit_stmt = $conn->prepare($audit_sql); // Using $conn to prepare the audit query
            $audit_stmt->bindParam(':user_id', $_SESSION['admin_id']); // Bind admin ID from session
            $audit_stmt->bindParam(':full_name', $admin_name);
            $audit_stmt->bindParam(':action', $action);
            $audit_stmt->bindParam(':description', $description);
            $audit_stmt->bindParam(':ip_address', $ip_address);
            $audit_stmt->execute();

            // Redirect with success message
            header("Location: ../views/view_admin_manage_pwd.php?success=PWD added to registered list successfully");
            exit();
        } else {
            // Redirect with error message if query execution fails
            header("Location: ../views/view_admin_manage_pwd.php?error=Failed to add PWD to registered list");
            exit();
        }
    } catch (PDOException $e) {
        die("Database error: " . $e->getMessage());
    }
} else {
    header("Location: ../views/view_admin_manage_pwd.php");
    exit();
}
