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
        $query = "SELECT full_name, address, contact_number, email, birthdate, disability_type FROM pwd_registration WHERE id = :id";
        $stmt = $conn->prepare($query);
        $stmt->bindParam(':id', $id, PDO::PARAM_INT);
        $stmt->execute();
        $pwd = $stmt->fetch(PDO::FETCH_ASSOC);

        if ($pwd) {
            $full_name = $pwd['full_name'];
            $address = $pwd['address'];
            $contact_number = $pwd['contact_number'];
            $email = $pwd['email'];
            $birthdate = $pwd['birthdate'];
            $disability_type = $pwd['disability_type'];

            // Update status in the database
            $query = "UPDATE pwd_registration SET status = :status WHERE id = :id";
            $stmt = $conn->prepare($query);
            $stmt->bindParam(':status', $status, PDO::PARAM_STR);
            $stmt->bindParam(':id', $id, PDO::PARAM_INT);
            
            if ($stmt->execute()) {
                // If status is "Released", insert into registered_pwd
                if ($status === 'Released') {
                    // Insert the record into the registered_pwd table
                    $insertQuery = "INSERT INTO registered_pwd (full_name, address, contact_number, email, birthdate, disability_type)
                                    VALUES (:full_name, :address, :contact_number, :email, :birthdate, :disability_type)";
                    $insertStmt = $conn->prepare($insertQuery);

                    $insertStmt->bindParam(':full_name', $full_name);
                    $insertStmt->bindParam(':address', $address);
                    $insertStmt->bindParam(':contact_number', $contact_number);
                    $insertStmt->bindParam(':email', $email);
                    $insertStmt->bindParam(':birthdate', $birthdate);
                    $insertStmt->bindParam(':disability_type', $disability_type);

                    // Execute the insertion
                    $insertStmt->execute();
                }

                // Fetch admin's first name and last name from session
                $adminFirstName = $_SESSION['first_name']; // Assuming admin first name is stored in session
                $adminLastName = $_SESSION['last_name']; // Assuming admin last name is stored in session
                
                // Concatenate first name and last name to form full name
                $adminFullName = $adminFirstName . ' ' . $adminLastName;

                // Log the action in the audit log
                $adminId = $_SESSION['admin_id']; // Assuming admin ID is stored in session
                $auditAction = "PWD Status Update";
                $auditDescription = "Status for PWD '$full_name' updated to '$status' by $adminFullName";
                $ipAddress = $_SERVER['REMOTE_ADDR']; // Get the admin's IP address
                $usertype = 'admin'; // User type (admin)
                $timestamp = date('Y-m-d H:i:s'); // Current timestamp

                // Insert the audit log entry
                $auditSql = "
                    INSERT INTO audit_log 
                    (user_id, action, description, ip_address, usertype, full_name) 
                    VALUES 
                    (:user_id, :action, :description, :ip_address, :usertype, :full_name)
                ";
                $auditStmt = $conn->prepare($auditSql);

                // Bind parameters for the audit log
                $auditStmt->bindParam(':user_id', $adminId);
                $auditStmt->bindParam(':action', $auditAction);
                $auditStmt->bindParam(':description', $auditDescription);
                $auditStmt->bindParam(':ip_address', $ipAddress);
                $auditStmt->bindParam(':usertype', $usertype);
                $auditStmt->bindParam(':full_name', $adminFullName); // Bind the full name

                // Execute the audit log insert statement
                $auditStmt->execute();

                // Set success message
                $_SESSION['message'] = [
                    'type' => 'success',
                    'text' => "Status updated successfully for $full_name."
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
?>
