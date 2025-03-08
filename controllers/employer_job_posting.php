<?php
session_start();
include '../include/db_conn.php'; // Include the database connection file

// Check if the user is logged in
if (!isset($_SESSION['employer_id'])) {
    echo json_encode(['status' => 'error', 'message' => 'You must be logged in to post a job.']);
    exit;
}

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Sanitize and validate inputs
    $jobTitle = htmlspecialchars($_POST['jobTitle']);
    $jobDescription = htmlspecialchars($_POST['jobDescription']);
    $jobLocation = htmlspecialchars($_POST['jobLocation']);
    $jobType = htmlspecialchars($_POST['jobType']);
    $salary = htmlspecialchars($_POST['salary']);
    $requirements = htmlspecialchars($_POST['requirements']);
    $employerId = $_SESSION['employer_id'];

    try {
        // Fetch the company_id of the logged-in employer
        $stmt = $conn->prepare("SELECT company_id FROM employer_company WHERE employer_id = :employer_id");
        $stmt->execute([':employer_id' => $employerId]);
        $employerCompany = $stmt->fetch(PDO::FETCH_ASSOC);

        if (!$employerCompany) {
            echo json_encode(['status' => 'error', 'message' => 'Employer not associated with any company.']);
            exit;
        }

        $companyId = $employerCompany['company_id'];

        // Insert the job posting into the database
        $stmt = $conn->prepare("
            INSERT INTO jobs (company_id, title, description, status, posted_date, employer_id, requirements, salary, job_type)
            VALUES (:company_id, :title, :description, :status, :posted_date, :employer_id, :requirements, :salary, :job_type)
        ");

        // Set default values for status and posted_date
        $status = 'active'; // Default status
        $postedDate = date('Y-m-d H:i:s'); // Current timestamp

        $stmt->execute([
            ':company_id' => $companyId,
            ':title' => $jobTitle,
            ':description' => $jobDescription,
            ':status' => $status,
            ':posted_date' => $postedDate,
            ':employer_id' => $employerId,
            ':requirements' => $requirements,
            ':salary' => $salary,
            ':job_type' => $jobType
        ]);

        // Return a success response
        echo json_encode(['status' => 'success', 'message' => 'Job posted successfully!']);
        exit;
    } catch (PDOException $e) {
        // Handle database errors
        echo json_encode(['status' => 'error', 'message' => 'Database error: ' . $e->getMessage()]);
        exit;
    }
} else {
    // Handle invalid request method
    echo json_encode(['status' => 'error', 'message' => 'Invalid request method.']);
    exit;
}
?>