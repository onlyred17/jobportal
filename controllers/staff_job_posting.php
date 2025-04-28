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
    $jobTitle = trim(htmlspecialchars($_POST['jobTitle']));
    $jobDescription = trim(htmlspecialchars($_POST['jobDescription']));
    $jobType = trim(htmlspecialchars($_POST['jobType']));
    $salary = trim(htmlspecialchars($_POST['salary']));
    $requirements = trim(htmlspecialchars($_POST['requirements']));
    $staffId = $_SESSION['staff_id'];

    $companyId = isset($_POST['company_id']) ? intval($_POST['company_id']) : 0;

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
        $companyLocation = $company['location'];

        // Insert the job posting
        $stmt = $conn->prepare("
            INSERT INTO jobs (company_id, company_name, company_logo, location, title, description, status, posted_date, staff_id, requirements, salary, job_type)
            VALUES (:company_id, :company_name, :company_logo, :company_location, :title, :description, :status, :posted_date, :staff_id, :requirements, :salary, :job_type)
        ");

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

        // Fetch all contact numbers from both tables
        $stmt = $conn->prepare("SELECT contact_number FROM pwd_registration");
        $stmt->execute();
        $contactNumbers = $stmt->fetchAll(PDO::FETCH_COLUMN);

        $stmt = $conn->prepare("SELECT contact_number FROM registered_pwd");
        $stmt->execute();
        $contactNumbersRegistered = $stmt->fetchAll(PDO::FETCH_COLUMN);

        // Combine all numbers
        $allContactNumbers = array_merge($contactNumbers, $contactNumbersRegistered);

        // Just use the numbers as they are, already formatted with +63
        $formattedNumbers = $allContactNumbers;

        if (!empty($formattedNumbers)) {
            // Send SMS via TextBee API
            $baseUrl = 'https://api.textbee.dev/api/v1';
            $apiKey = '';
            $deviceId = '';

            error_log("Preparing to send SMS to " . count($formattedNumbers) . " recipients");

            try {
                $ch = curl_init();
                curl_setopt($ch, CURLOPT_URL, "$baseUrl/gateway/devices/$deviceId/send-sms");
                curl_setopt($ch, CURLOPT_POST, 1);

                $postData = json_encode([
                    'recipients' => $formattedNumbers,
                    'message' => "New Job Opportunity: $jobTitle at $companyName. Location: $companyLocation. Job Type: $jobType. Visit our portal for details."
                ]);
                error_log("SMS API POST data: " . $postData);

                curl_setopt($ch, CURLOPT_POSTFIELDS, $postData);
                curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
                curl_setopt($ch, CURLOPT_SSL_VERIFYHOST, false);
                curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
                curl_setopt($ch, CURLOPT_HTTPHEADER, [
                    'Content-Type: application/json',
                    'x-api-key: ' . $apiKey,
                ]);

                $response = curl_exec($ch);
                error_log("SMS API Response: " . $response);

                $httpCode = curl_getinfo($ch, CURLINFO_HTTP_CODE);
                error_log("SMS API HTTP Status Code: " . $httpCode);

                if (curl_errno($ch)) {
                    error_log('Curl error: ' . curl_error($ch));
                }

                curl_close($ch);
                error_log("SMS sending process completed");
            } catch (Exception $e) {
                error_log("Exception during SMS sending: " . $e->getMessage());
            }
        }

        // Insert into audit log
        $jobTitleForLog = $jobTitle;
        $staffFullName = $_SESSION['first_name'] . ' ' . $_SESSION['last_name'];
        $ipAddress = $_SERVER['REMOTE_ADDR'];
        $action = 'Job Posting';
        $descriptionLog = "Job posted: $jobTitleForLog at $companyName by $staffFullName";
        $usertype = 'staff';

        $auditSql = "INSERT INTO audit_log (user_id, action, description, ip_address, usertype, full_name)
                     VALUES (:user_id, :action, :description, :ip_address, :usertype, :full_name)";
        $auditStmt = $conn->prepare($auditSql);
        $auditStmt->execute([ 
            ':user_id' => $staffId,
            ':action' => $action,
            ':description' => $descriptionLog,
            ':ip_address' => $ipAddress,
            ':usertype' => $usertype,
            ':full_name' => $staffFullName,
        ]);

        // Send email notifications
        $stmt = $conn->prepare("SELECT email FROM pwd_registration");
        $stmt->execute();
        $emails = $stmt->fetchAll(PDO::FETCH_COLUMN);

        $stmt = $conn->prepare("SELECT email FROM registered_pwd");
        $stmt->execute();
        $emailsRegistered = $stmt->fetchAll(PDO::FETCH_COLUMN);

        $allEmails = array_merge($emails, $emailsRegistered);

        $mail = new PHPMailer(true);
        try {
            $mail->isSMTP();
            $mail->Host = 'smtp-relay.brevo.com';
            $mail->SMTPAuth = true;
            $mail->Username = 'jaredsonvicente1771@gmail.com';
            $mail->Password = 'kWV40qgL9B7DGT5P';
            $mail->SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS;
            $mail->Port = 587;

            $mail->setFrom('pwdportal@gmail.com', 'PWD Job Portal');
            $mail->isHTML(true);
            $mail->Subject = 'New Job Opportunity: ' . $jobTitle;
            $mail->Body = "<h3>New Job Posted</h3>
                <p><strong>Title:</strong> $jobTitle</p>
                <p><strong>Company:</strong> $companyName</p>
                <p><strong>Location:</strong> $companyLocation</p>
                <p><strong>Type:</strong> $jobType</p>
                <p><strong>Requirements:</strong> $requirements</p><br>
                <p>Visit our job portal for more details: http://localhost/jobportal/views/pwd_landing_page.php#home</p>";

            foreach ($allEmails as $email) {
                $mail->addAddress($email);
                $mail->send();
                $mail->clearAddresses(); // Reset for next email
            }
        } catch (Exception $e) {
            error_log("Email sending failed: " . $mail->ErrorInfo);
        }

        // Fetch new jobs count
        $query = "SELECT COUNT(*) FROM jobs WHERE posted_date > NOW() - INTERVAL 1 DAY";
        $stmt = $conn->prepare($query);
        $stmt->execute();
        $newJobsCount = $stmt->fetchColumn();

        echo json_encode(['status' => 'success', 'message' => 'Job posted successfully! Email and SMS sent', 'newJobsCount' => $newJobsCount]);
        exit;
    } catch (PDOException $e) {
        echo json_encode(['status' => 'error', 'message' => 'Database error: ' . $e->getMessage()]);
        exit;
    }
}
?>
