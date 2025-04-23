<?php
session_start();
include '../include/db_conn.php';
require '../vendor/phpmailer/phpmailer/src/Exception.php';
require '../vendor/phpmailer/phpmailer/src/PHPMailer.php';
require '../vendor/phpmailer/phpmailer/src/SMTP.php';

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

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
            $email = $pwd['email'];
            $address = $pwd['address'];
            $contact_number = $pwd['contact_number'];
            $birthdate = $pwd['birthdate'];
            $disability_type = $pwd['disability_type'];

            // Update status in the database
            $updateQuery = "UPDATE pwd_registration SET status = :status WHERE id = :id";
            $stmt = $conn->prepare($updateQuery);
            $stmt->bindParam(':status', $status, PDO::PARAM_STR);
            $stmt->bindParam(':id', $id, PDO::PARAM_INT);

            if ($stmt->execute()) {
                // Insert into registered_pwd if status is Released
                if ($status === 'Released') {
                    $insertQuery = "INSERT INTO registered_pwd (full_name, address, contact_number, email, birthdate, disability_type)
                                    VALUES (:full_name, :address, :contact_number, :email, :birthdate, :disability_type)";
                    $insertStmt = $conn->prepare($insertQuery);
                    $insertStmt->bindParam(':full_name', $full_name);
                    $insertStmt->bindParam(':address', $address);
                    $insertStmt->bindParam(':contact_number', $contact_number);
                    $insertStmt->bindParam(':email', $email);
                    $insertStmt->bindParam(':birthdate', $birthdate);
                    $insertStmt->bindParam(':disability_type', $disability_type);
                    $insertStmt->execute();
                }

                // Send email notification using PHPMailer and Brevo SMTP
                $mail = new PHPMailer(true);
                try {
                    $mail->isSMTP();
                    $mail->Host = 'smtp-relay.brevo.com';
                    $mail->SMTPAuth = true;
                    $mail->Username = 'jaredsonvicente1771@gmail.com'; // Your Brevo sender email
                    $mail->Password = 'kWV40qgL9B7DGT5P'; // Your Brevo SMTP API Key
                    $mail->SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS;
                    $mail->Port = 587;

                    $mail->setFrom('pwdportal@gmail.com', 'PWD Registration');
                    $mail->addAddress($email, $full_name);

                    $mail->isHTML(true);
                    $mail->Subject = 'PWD ID Status Update';
                    $mail->Body = "
                        <p>Hello <strong>$full_name</strong>,</p>
                        <p>Your PWD ID status has been updated to: <strong>$status</strong>.</p>
                        <p>Thank you for your patience.<br><br>Best regards,<br>PWD Registration Team</p>
                    ";

                    $mail->send();
                } catch (Exception $e) {
                    error_log("Email sending failed: " . $mail->ErrorInfo);
                    $_SESSION['message'] = ['type' => 'danger', 'text' => 'Failed to send email notification.'];
                }

                // Log the action in the audit log
                $adminFirstName = $_SESSION['first_name'] ?? '';
                $adminLastName = $_SESSION['last_name'] ?? '';
                $adminId = $_SESSION['admin_id'] ?? null;
                $adminFullName = $adminFirstName . ' ' . $adminLastName;

                $auditAction = "PWD Status Update";
                $auditDescription = "Status for PWD '$full_name' updated to '$status' by $adminFullName";
                $ipAddress = $_SERVER['REMOTE_ADDR'];
                $usertype = 'admin';
                $timestamp = date('Y-m-d H:i:s');

                $auditSql = "
                    INSERT INTO audit_log 
                    (user_id, action, description, ip_address, usertype, full_name) 
                    VALUES 
                    (:user_id, :action, :description, :ip_address, :usertype, :full_name)
                ";
                $auditStmt = $conn->prepare($auditSql);
                $auditStmt->bindParam(':user_id', $adminId);
                $auditStmt->bindParam(':action', $auditAction);
                $auditStmt->bindParam(':description', $auditDescription);
                $auditStmt->bindParam(':ip_address', $ipAddress);
                $auditStmt->bindParam(':usertype', $usertype);
                $auditStmt->bindParam(':full_name', $adminFullName);
                $auditStmt->execute();

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
