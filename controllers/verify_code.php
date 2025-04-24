<?php
// Start session to hold error messages or any other session data
session_start();

// Include database connection (adjust the file path as necessary)
require_once '../include/db_conn.php';



$email = $_SESSION['email'];  // Assuming email is stored in session when sending the verification code

// If the form is submitted
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    // Get the entered verification code from the form
    $entered_code = $_POST['code'];

    // Fetch the stored verification code from the database
    $query = "SELECT verification_code FROM staff WHERE email = :email";
    $stmt = $conn->prepare($query);
    $stmt->bindParam(':email', $email, PDO::PARAM_STR);
    $stmt->execute();

    // Check if the email exists and the verification code is retrieved
    if ($stmt->rowCount() > 0) {
        $row = $stmt->fetch(PDO::FETCH_ASSOC);
        $stored_code = $row['verification_code'];

        // Check if the entered code matches the stored code
        if ($entered_code === (string)$stored_code) {
            // Code is correct, redirect to the password reset page
            header('Location: ../views/view_staff_reset_password.php');
            exit;
        } else {
            // Code is incorrect, show error message
            $_SESSION['error_message'] = 'The verification code you entered is incorrect. Please try again.';
            header('Location: ../views/view_staff_verify_code.php');
            exit;
        }
    } else {
        // Email does not exist or verification code not found in the database
        $_SESSION['error_message'] = 'The verification code is not valid. Please request a new one.';
        header('Location: ../views/view_staff_verify_code.php');
        exit;
    }
} else {
    // If the form wasn't submitted, redirect to the verification page
    header('Location: ../views/view_staff_verify_code.php');
    exit;
}
?>
