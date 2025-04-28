<?php
session_start();
include_once '../include/db_conn.php';

// Check if job ID is provided
if (!isset($_GET['id']) || empty($_GET['id'])) {
    $_SESSION['message'] = [
        'type' => 'danger',
        'text' => 'Job ID is required.'
    ];
    header('Location: ../views/archived_jobs.php');
    exit;
}

$jobId = $_GET['id'];

try {
    // Start transaction
    $conn->beginTransaction();
    
    // Update job status from Archived to Open
    $query = "UPDATE jobs SET status = 'Open' WHERE id = :job_id";
    $stmt = $conn->prepare($query);
    $stmt->bindParam(':job_id', $jobId);
    $stmt->execute();
    
    // Check if the update was successful
    if ($stmt->rowCount() > 0) {
        // Commit the transaction
        $conn->commit();
        
        $_SESSION['message'] = [
            'type' => 'success',
            'text' => 'Job has been restored successfully.'
        ];
    } else {
        // If no rows were affected, rollback the transaction
        $conn->rollBack();
        
        $_SESSION['message'] = [
            'type' => 'danger',
            'text' => 'Failed to restore job. Job not found or already restored.'
        ];
    }
    
} catch (PDOException $e) {
    // Roll back the transaction on error
    $conn->rollBack();
    
    $_SESSION['message'] = [
        'type' => 'danger',
        'text' => 'Database error: ' . $e->getMessage()
    ];
}

// Redirect back to archived jobs page
header('Location: ../views/archived_jobs.php');
exit;
?>