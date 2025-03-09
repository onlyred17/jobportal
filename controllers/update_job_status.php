<?php
// Include the database connection
include '../include/db_conn.php';  // Make sure this path is correct

// Check if the 'id' and 'status' parameters are present
if (isset($_GET['id']) && isset($_GET['status'])) {
    $jobId = $_GET['id'];
    $status = $_GET['status'];

    // Validate the status to be either 'Open' or 'Closed'
    if ($status !== 'Open' && $status !== 'Closed') {
        die("Invalid status");
    }

    // Prepare the SQL query to update the job status
    $query = "UPDATE jobs SET status = :status WHERE id = :id";

    // Prepare the statement
    $stmt = $conn->prepare($query);  // Use $conn here instead of $pdo

    // Bind the parameters
    $stmt->bindParam(':status', $status);
    $stmt->bindParam(':id', $jobId);

    // Execute the query
    if ($stmt->execute()) {
        // Redirect to the job listings page with a success message
        header("Location: ../views/view_staff_jobs_table.php?status_update=success");
    } else {
        // Redirect with an error message
        header("Location: ../views/view_staff_jobs_table.php?status_update=error");
    }
} else {
    // Redirect if 'id' or 'status' parameters are not provided
    header("Location: ../views/view_staff_jobs_table.php?status_update=missing_parameters");
}
exit();
?>
