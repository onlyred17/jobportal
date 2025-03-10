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
                $_SESSION['message'] = [
                    'type' => 'success',
                    'text' => "Job '<strong>{$jobTitle}</strong>' status updated to <strong>{$status}</strong> successfully!"
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
