<?php
session_start();
require_once '../include/db_conn.php';

// Check if job ID is provided
if (!isset($_GET['id']) || empty($_GET['id'])) {
    $_SESSION['message'] = [
        'type' => 'danger',
        'text' => 'Invalid job ID provided.'
    ];
    header('Location: ../views/view_staff_jobs_table.php');
    exit;
}

$jobId = $_GET['id'];

// Update job status to 'Archived' and set archived_date
try {
    $query = "UPDATE jobs SET status = 'Archived', archived_date = NOW() WHERE id = :id";
    $stmt = $conn->prepare($query);
    $stmt->bindParam(':id', $jobId);

    if ($stmt->execute()) {
        $_SESSION['message'] = [
            'type' => 'success',
            'text' => 'Job has been archived successfully!'
        ];
    } else {
        $_SESSION['message'] = [
            'type' => 'danger', 
            'text' => 'Failed to archive job.'
        ];
    }
} catch (PDOException $e) {
    $_SESSION['message'] = [
        'type' => 'danger',
        'text' => 'Database error: ' . $e->getMessage()
    ];
}

// Redirect back to jobs page
header('Location: ../views/view_staff_jobs_table.php');
exit;
?>
