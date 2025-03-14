<?php
session_start();
include '../include/db_conn.php'; // Ensure database connection

if (isset($_GET['id']) && isset($_GET['status'])) {
    $jobId = $_GET['id'];
    $status = $_GET['status'];

    try {
        // Fetch the job title before updating
        $fetchQuery = "SELECT title FROM jobs WHERE id = :id";
        $fetchStmt = $conn->prepare($fetchQuery);
        $fetchStmt->bindParam(':id', $jobId, PDO::PARAM_INT);
        $fetchStmt->execute();
        $job = $fetchStmt->fetch(PDO::FETCH_ASSOC);

        if ($job) {
            $jobTitle = htmlspecialchars($job['title']); // Prevent XSS

            // Update the job status
            $updateQuery = "UPDATE jobs SET status = :status WHERE id = :id";
            $updateStmt = $conn->prepare($updateQuery);
            $updateStmt->bindParam(':status', $status, PDO::PARAM_STR);
            $updateStmt->bindParam(':id', $jobId, PDO::PARAM_INT);

            if ($updateStmt->execute()) {
                $staffId = $_SESSION['staff_id']; // Assuming staff ID is stored in session
                
                // Fetch the staff's full name from the session
                $staffFullName = isset($_SESSION['first_name']) && isset($_SESSION['last_name']) 
                                 ? $_SESSION['first_name'] . ' ' . $_SESSION['last_name'] 
                                 : 'Unknown Staff'; // Fallback if no name is found

                // Log the update in the audit log
                $auditAction = "Job Status Update"; 
                $auditDescription = "Job status for '{$jobTitle}' updated to '{$status}' by {$staffFullName}";
                $ipAddress = $_SERVER['REMOTE_ADDR']; // Get the user's IP address
                $usertype = 'staff'; // User type (staff)

                // Insert the audit log entry with the full name
                $auditSql = "
                    INSERT INTO audit_log 
                    (user_id, action, description, ip_address, usertype, full_name) 
                    VALUES 
                    (:user_id, :action, :description, :ip_address, :usertype, :full_name)
                ";
                $auditStmt = $conn->prepare($auditSql);

                // Bind parameters for the audit log
                $auditStmt->bindParam(':user_id', $staffId);
                $auditStmt->bindParam(':action', $auditAction);
                $auditStmt->bindParam(':description', $auditDescription);
                $auditStmt->bindParam(':ip_address', $ipAddress);
                $auditStmt->bindParam(':usertype', $usertype);
                $auditStmt->bindParam(':full_name', $staffFullName); // Bind the full_name here
                $timestamp = date('Y-m-d H:i:s');  // Current timestamp

                // Execute the audit log insert statement
                $auditStmt->execute();

                // Set success message
                $_SESSION['message'] = [
                    'type' => 'success',
                    'text' => "Job '<strong>{$jobTitle}</strong>' status updated to <strong>{$status}</strong> successfully by <strong>{$staffFullName}</strong>!"
                ];
            } else {
                $_SESSION['message'] = [
                    'type' => 'danger',
                    'text' => "Error updating status for job '<strong>{$jobTitle}</strong>'. Please try again."
                ];
            }
        } else {
            $_SESSION['message'] = [
                'type' => 'danger',
                'text' => "Job not found. Please try again."
            ];
        }
    } catch (PDOException $e) {
        $_SESSION['message'] = [
            'type' => 'danger',
            'text' => 'Database error: ' . $e->getMessage()
        ];
    }
} else {
    $_SESSION['message'] = [
        'type' => 'danger',
        'text' => 'Invalid request. Please try again.'
    ];
}

// Redirect back to job listings page
header("Location: ../views/view_staff_jobs_table.php");
exit();
?>
