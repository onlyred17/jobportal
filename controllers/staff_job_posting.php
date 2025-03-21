<?php
session_start();
include '../include/db_conn.php';
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;
require '../vendor/autoload.php'; // Load PHPMailer

// Check if the user is logged in
if (!isset($_SESSION['staff_id'])) {
    echo json_encode(['status' => 'error', 'message' => 'User not logged in']);
    exit;
}

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Sanitize and validate inputs
    $jobTitle = trim(htmlspecialchars($_POST['jobTitle']));
    $jobDescription = trim(htmlspecialchars($_POST['jobDescription']));
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
        $stmt = $conn->prepare("SELECT name, logo, location FROM company WHERE id = :company_id");
        $stmt->execute([':company_id' => $companyId]);
        $company = $stmt->fetch(PDO::FETCH_ASSOC);

        if (!$company) {
            echo json_encode(['status' => 'error', 'message' => 'Selected company does not exist.']);
            exit;
        }

        $companyName = $company['name'];
        $companyLogo = $company['logo'];
        $companyLocation = $company['location']; // Fetch company location

        // Insert the job posting into the database
        $stmt = $conn->prepare("
        INSERT INTO jobs (company_id, company_name, company_logo, location, title, description, status, posted_date, staff_id, requirements, salary, job_type)
        VALUES (:company_id, :company_name, :company_logo, :company_location, :title, :description, :status, :posted_date, :staff_id, :requirements, :salary, :job_type)
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
            ':job_type' => $jobType,
            ':company_location' => $companyLocation,

            
        ]);

        // Fetch the new job count after posting
        $query = "SELECT COUNT(*) FROM jobs WHERE posted_date > NOW() - INTERVAL 1 DAY";
        $stmt = $conn->prepare($query);
        $stmt->execute();
        $newJobsCount = $stmt->fetchColumn();  // Get the number of new jobs

        // Insert into audit log
        $jobTitleForLog = $jobTitle;
        $staffFullName = $_SESSION['first_name'] . ' ' . $_SESSION['last_name']; // Full name from session
        $ipAddress = $_SERVER['REMOTE_ADDR']; // Get the user's IP address
        $action = 'Job Posting'; // Action type
        $descriptionLog = "Job posted: " . $jobTitleForLog . " at " . $companyName . " by " . $staffFullName;
        $usertype = 'staff'; // User type (staff)

        // Insert the audit log
        $auditSql = "INSERT INTO audit_log (user_id, action, description, ip_address, usertype, full_name)
                     VALUES (:user_id, :action, :description, :ip_address, :usertype, :full_name)";
        $auditStmt = $conn->prepare($auditSql);
        $auditStmt->bindParam(':user_id', $staffId);
        $auditStmt->bindParam(':action', $action);
        $auditStmt->bindParam(':description', $descriptionLog);
        $auditStmt->bindParam(':ip_address', $ipAddress);
        $auditStmt->bindParam(':usertype', $usertype);
        $auditStmt->bindParam(':full_name', $staffFullName);
        $auditStmt->execute();

        // Fetch all PWD registered applicants' emails
        $stmt = $conn->prepare("SELECT email FROM pwd_registration");
        $stmt->execute();
        $emails = $stmt->fetchAll(PDO::FETCH_COLUMN);

        // Send email notification
        $mail = new PHPMailer(true);
        try {
            $mail->isSMTP();
            $mail->Host = 'smtp-relay.brevo.com'; // Brevo SMTP server
            $mail->SMTPAuth = true;
            $mail->Username = 'jaredsonvicente1771@gmail.com'; // Your Brevo email
            $mail->Password = 'kWV40qgL9B7DGT5P'; // Your Brevo API Key
            $mail->SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS;
            $mail->Port = 587;

            $mail->setFrom('your_brevo_email@example.com', 'PWD Job Portal');
            $mail->isHTML(true);
            $mail->Subject = 'New Job Opportunity: ' . $jobTitle;
            $mail->Body = "<h3>New Job Posted</h3>
            <p><strong>Title:</strong> $jobTitle</p>
            <p><strong>Company:</strong> $companyName</p>
            <p><strong>Location:</strong> $companyLocation</p> <!-- Use company location -->
            <p><strong>Salary:</strong> $salary</p>
            <p><strong>Type:</strong> $jobType</p>
            <p><strong>Requirements:</strong> $requirements</p><br>
            <p>Visit our job portal to view more Jobs!</p>";


            // Send email to each PWD applicant
            foreach ($emails as $email) {
                $mail->addAddress($email);
                $mail->send();
                $mail->clearAddresses(); // Clear previous recipients for the next loop
            }
        } catch (Exception $e) {
            error_log("Email sending failed: " . $mail->ErrorInfo);
        }

        // Send the new job count back in the response
        echo json_encode(['status' => 'success', 'message' => 'Job posted successfully! Email notifications sent.', 'newJobsCount' => $newJobsCount]);
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
