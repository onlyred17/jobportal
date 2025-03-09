<?php
session_start();
include '../include/db_conn.php';

// Check if the user is logged in
if (!isset($_SESSION['staff_id'])) {
    echo json_encode(['status' => 'error', 'message' => 'User not logged in']);
    exit;
}

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Sanitize and validate inputs
    $jobTitle = trim(htmlspecialchars($_POST['jobTitle']));
    $jobDescription = trim(htmlspecialchars($_POST['jobDescription']));
    $jobLocation = trim(htmlspecialchars($_POST['jobLocation']));
    $jobType = trim(htmlspecialchars($_POST['jobType']));
    $salary = trim(htmlspecialchars($_POST['salary']));
    $requirements = trim(htmlspecialchars($_POST['requirements']));
    $staffId = $_SESSION['staff_id'];

    // Get the selected company ID from the form
    $companyId = isset($_POST['company_id']) ? intval($_POST['company_id']) : 0;

    // Validate company ID
    if ($companyId <= 0) {
        echo json_encode(['status' => 'error', 'message' => 'Invalid company selection.']);
        exit;
    }

    try {
        // Fetch company details
        $stmt = $conn->prepare("SELECT name, logo FROM company WHERE id = :company_id");
        $stmt->execute([':company_id' => $companyId]);
        $company = $stmt->fetch(PDO::FETCH_ASSOC);

        if (!$company) {
            echo json_encode(['status' => 'error', 'message' => 'Selected company does not exist.']);
            exit;
        }

        $companyName = $company['name'];
        $companyLogo = $company['logo'];

        // Insert the job posting into the database
        $stmt = $conn->prepare("
            INSERT INTO jobs (company_id, company_name, company_logo, title, description, status, posted_date, staff_id, requirements, salary, job_type)
            VALUES (:company_id, :company_name, :company_logo, :title, :description, :status, :posted_date, :staff_id, :requirements, :salary, :job_type)
        ");

        // Set default values for status and posted_date
        $status = 'open';
        $postedDate = date('Y-m-d H:i:s');

        $stmt->execute([
            ':company_id' => $companyId,
            ':company_name' => $companyName,
            ':company_logo' => $companyLogo,
            ':title' => $jobTitle,
            ':description' => $jobDescription,
            ':status' => $status,
            ':posted_date' => $postedDate,
            ':staff_id' => $staffId,
            ':requirements' => $requirements,
            ':salary' => $salary,
            ':job_type' => $jobType
        ]);

        // Fetch the new job count after posting
        $query = "SELECT COUNT(*) FROM jobs WHERE posted_date > NOW() - INTERVAL 1 DAY";
        $stmt = $conn->prepare($query);
        $stmt->execute();
        $newJobsCount = $stmt->fetchColumn();  // Get the number of new jobs

        // Send the new job count back in the response
        echo json_encode(['status' => 'success', 'message' => 'Job posted successfully!', 'newJobsCount' => $newJobsCount]);
        exit;
    } catch (PDOException $e) {
        echo json_encode(['status' => 'error', 'message' => 'Database error: ' . $e->getMessage()]);
        exit;
    }
} else {
    echo json_encode(['status' => 'error', 'message' => 'Invalid request method.']);
    exit;
}
?>
