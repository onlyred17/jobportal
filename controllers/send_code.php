<?php
session_start();

// Include your database connection
include '../include/db_conn.php';

// Retrieve the email from the form submission
$email = $_POST['email'];
$_SESSION['email'] = $email;

// Check if the email exists in the staff table
$query = "SELECT * FROM staff WHERE email = :email";
$stmt = $conn->prepare($query);
$stmt->bindParam(':email', $email, PDO::PARAM_STR);
$stmt->execute();

if ($stmt->rowCount() == 0) {
    // If email doesn't exist, set the session message and redirect back
    $_SESSION['message'] = 'The email address you entered does not exist. Please try again.';
    header('Location: ../views/view_staff_forgot_password.php');
    exit;
}

// Fetch the staff member's full name (or any other necessary info)
$row = $stmt->fetch(PDO::FETCH_ASSOC);
$full_name = $row['full_name']; // Assuming 'full_name' is a column in your staff table

// Generate a random verification code
$verification_code = rand(100000, 999999);

// Update the verification code in the database for the staff member
$updateQuery = "UPDATE staff SET verification_code = :verification_code WHERE email = :email";
$updateStmt = $conn->prepare($updateQuery);
$updateStmt->bindParam(':verification_code', $verification_code, PDO::PARAM_INT);
$updateStmt->bindParam(':email', $email, PDO::PARAM_STR);
$updateStmt->execute();

if ($updateStmt->rowCount() == 0) {
    // If the update failed, redirect back with an error
    $_SESSION['message'] = 'Failed to store the verification code. Please try again later.';
    header('Location: ../views/view_staff_forgot_password.php');
    exit;
}

// Send email using PHPMailer (or your email service)
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

require '../vendor/autoload.php';

$mail = new PHPMailer(true);

try {
    // Set up SMTP with Brevo
    $mail->isSMTP();
    $mail->Host = 'smtp-relay.brevo.com';
    $mail->SMTPAuth = true;
    $mail->Username = 'jaredsonvicente1771@gmail.com'; // Your Brevo email
    $mail->Password = 'kWV40qgL9B7DGT5P'; // Your Brevo API Key
    $mail->SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS;
    $mail->Port = 587;

    // Set the "from" email and name
    $mail->setFrom('pwdportal@gmail.com', 'PWD Reset Password');
    $mail->addAddress($email, $full_name); // Recipient's email

    // Set email content
    $mail->isHTML(true);
    $mail->Subject = 'Password Reset Request';
    $mail->Body = "Dear $full_name,<br><br>" . 
                  "You requested a password reset. Please use the following verification code to proceed:<br><br>" . 
                  "<strong>$verification_code</strong><br><br>" . 
                  "If you didn't request this, please ignore this email.<br><br>" . 
                  "Best regards,<br>Password Reset Team";

    // Send the email
    $mail->send();

  
    header('Location: ../views/view_staff_verify_code.php');
    exit;

} catch (Exception $e) {
    // Handle the error
    $_SESSION['message'] = 'Message could not be sent. Mailer Error: ' . $mail->ErrorInfo;
    header('Location: ../views/view_staff_forgot_password.php');
    exit;
}
?>
