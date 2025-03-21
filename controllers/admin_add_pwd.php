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
        $admin_id = $_SESSION['admin_id']; // Admin who is adding
        $full_name = $_POST['full_name'];
        $address = $_POST['address'];
        $contact_number = $_POST['contact_number'];
        $email = $_POST['email'];
        $birthdate = $_POST['birthdate'];
        $disability_type = $_POST['disability_type'];

        // Prepare SQL statement for insertion
        $sql = "INSERT INTO pwd_registration (admin_id, full_name, address, contact_number, email, birthdate, disability_type) 
                VALUES (:admin_id, :full_name, :address, :contact_number, :email, :birthdate, :disability_type)";
        
        $stmt = $pdo->prepare($sql);

        // Bind parameters
        $stmt->bindParam(':admin_id', $admin_id, PDO::PARAM_INT);
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
            $action = "Added PWD";
            $description = "Admin $admin_name (ID: $admin_id) added PWD $full_name.";
            
            $audit_sql = "INSERT INTO audit_log (user_id, full_name, action, description, ip_address, usertype) 
                          VALUES (:user_id, :full_name, :action, :description, :ip_address, 'admin')";
            
            $audit_stmt = $pdo->prepare($audit_sql);
            $audit_stmt->bindParam(':user_id', $admin_id);
            $audit_stmt->bindParam(':full_name', $admin_name);
            $audit_stmt->bindParam(':action', $action);
            $audit_stmt->bindParam(':description', $description);
            $audit_stmt->bindParam(':ip_address', $ip_address);
            $audit_stmt->execute();

            // Redirect with success message
            header("Location: ../views/view_admin_manage_pwd.php?success=PWD added successfully");
            exit();
        } else {
            header("Location: ../views/view_admin_manage_pwd?error=Failed to add PWD");
            exit();
        }
    } catch (PDOException $e) {
        die("Database error: " . $e->getMessage());
    }
} else {
    header("Location:../views/view_admin_manage_pwd");
    exit();
}
?>
