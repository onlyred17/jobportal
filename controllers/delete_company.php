<?php
session_start();
include '../include/db_conn.php';

// Check if the ID is provided
if (isset($_GET['id'])) {
    $id = $_GET['id'];

    // Fetch the company name before deletion
    $query = "SELECT name FROM company WHERE id = :id";
    $stmt = $conn->prepare($query);
    $stmt->bindParam(':id', $id);
    $stmt->execute();
    $company = $stmt->fetch(PDO::FETCH_ASSOC);

    // Check if the company exists
    if ($company) {
        $companyName = $company['name'];

        // Prepare the delete query
        $query = "DELETE FROM company WHERE id = :id";
        $stmt = $conn->prepare($query);
        $stmt->bindParam(':id', $id);

        // Execute the query and check if successful
        if ($stmt->execute()) {
            $_SESSION['message'] = [
                'type' => 'success',
                'text' => "Company '{$companyName}' deleted successfully!"
            ];

            // Insert into audit log for company deletion
            $user_id = isset($_SESSION['staff_id']) ? $_SESSION['staff_id'] : (isset($_SESSION['admin_id']) ? $_SESSION['admin_id'] : null);
            $full_name = isset($_SESSION['first_name']) && isset($_SESSION['last_name']) ? $_SESSION['first_name'] . ' ' . $_SESSION['last_name'] : 'Unknown';
            $ip_address = $_SERVER['REMOTE_ADDR']; // Get the user's IP address
            $action = 'Delete'; // Action type
            $description = "Company '{$companyName}' deleted"; // Description of the action

            // Check the user type (staff or admin)
            $usertype = isset($_SESSION['staff_id']) ? 'staff' : (isset($_SESSION['admin_id']) ? 'admin' : 'unknown');

            // Insert the audit log
            $audit_sql = "INSERT INTO audit_log (user_id, full_name, action, description, ip_address, usertype) 
                          VALUES (:user_id, :full_name, :action, :description, :ip_address, :usertype)";
            $audit_stmt = $conn->prepare($audit_sql);
            $audit_stmt->bindParam(':user_id', $user_id);
            $audit_stmt->bindParam(':full_name', $full_name);
            $audit_stmt->bindParam(':action', $action);
            $audit_stmt->bindParam(':description', $description);
            $audit_stmt->bindParam(':ip_address', $ip_address);
            $audit_stmt->bindParam(':usertype', $usertype); // Bind the usertype
            $audit_stmt->execute();
        } else {
            $_SESSION['message'] = [
                'type' => 'danger',
                'text' => "Error deleting company '{$companyName}'."
            ];
        }
    } else {
        $_SESSION['message'] = [
            'type' => 'warning',
            'text' => "Company not found."
        ];
    }

    // Redirect back to the company list page
    header('Location: ../views/view_staff_company_table.php');
    exit();
}
