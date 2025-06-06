<?php
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

var_dump($_FILES);

require '../vendor/autoload.php'; // Load PHPMailer
include '../include/db_conn.php'; // Include the database connection file

session_start(); // Start session to get logged-in user's ID

$loggedInAdminID = $_SESSION['admin_id'];

// Function to generate a random unique Application ID
function generateApplicationID($conn) {
    do {
        $application_id = 'APP_' . strtoupper(bin2hex(random_bytes(4)));  // 8-character unique ID
        $stmt = $conn->prepare("SELECT COUNT(*) FROM pwd_registration WHERE application_id = ?");
        $stmt->execute([$application_id]);
    } while ($stmt->fetchColumn() > 0);

    return $application_id;
}

// Get form data
$full_name = $_POST['full_name'];
$birthdate = $_POST['birthdate'];
$disability_type = $_POST['disability_type'];
$address = $_POST['address'];
$contact_number = $_POST['contact_number'];
$email = $_POST['email'];
$valid_id_type = $_POST['valid_id_type']; // New field for valid ID type

// File upload directory
$target_dir = "../applications/";

// Function to handle file uploads
function uploadFile($file, $target_dir) {
    $allowed_types = ['jpg', 'jpeg', 'png', 'pdf'];
    $file_name = time() . "_" . basename($file["name"]);
    $target_file = $target_dir . $file_name;
    $file_type = strtolower(pathinfo($target_file, PATHINFO_EXTENSION));

    if (!in_array($file_type, $allowed_types)) {
        return ["error" => "Invalid file type! Only JPG, PNG, and PDF allowed."];
    }

    if (move_uploaded_file($file["tmp_name"], $target_file)) {
        return ["success" => $target_file];
    } else {
        return ["error" => "Error uploading file."];
    }
}

// Upload Proof of PWD
$proof_result = uploadFile($_FILES["proof_of_pwd"], $target_dir);
if (isset($proof_result["error"])) {
    header("Location: ../views/pwd_registration.php?message=" . $proof_result["error"]);
    exit();
}
$proof_of_pwd = $proof_result["success"];

// Upload Valid ID (Front)
$valid_id_front_result = uploadFile($_FILES["valid_id1"], $target_dir);
if (isset($valid_id_front_result["error"])) {
    header("Location: ../views/pwd_registration.php?message=" . $valid_id_front_result["error"]);
    exit();
}
$valid_id_front = $valid_id_front_result["success"];

// Upload Valid ID (Back)
$valid_id_back_result = uploadFile($_FILES["valid_id2"], $target_dir);
if (isset($valid_id_back_result["error"])) {
    header("Location: ../views/pwd_registration.php?message=" . $valid_id_back_result["error"]);
    exit();
}
$valid_id_back = $valid_id_back_result["success"];

try {
    // Check if email already exists and get its status
    $check_email = $conn->prepare("SELECT * FROM pwd_registration WHERE email = ?");
    $check_email->execute([$email]);
    $existing_record = $check_email->fetch(PDO::FETCH_ASSOC);

    if ($existing_record) {
        // If the status is not 'Rejected', prevent re-application
        if ($existing_record['status'] != 'Rejected') {
            header("Location: ../views/pwd_registration.php?message=This email is already registered.");
            exit();
        }
    }

    // Validate full contact number format: +639xxxxxxxxx
    $contact_number = trim($contact_number); // Remove extra spaces

    if (!preg_match('/^\+639\d{9}$/', $contact_number)) {
        header("Location: ../views/pwd_registration.php?message=Invalid contact number! Must start with +639 and be followed by 9 digits.");
        exit();
    }

    // Generate a unique Application ID
    $application_id = generateApplicationID($conn);

    // Insert data into database
    $stmt = $conn->prepare("INSERT INTO pwd_registration (
        application_id, full_name, birthdate, disability_type, address, contact_number, email,
        valid_id_type, proof_of_pwd, valid_id, valid_id_back, status, created_at, updated_at
    ) VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?,?, 'Pending', NOW(), NOW())");
    
    $stmt->execute([
        $application_id, $full_name, $birthdate, $disability_type, $address, $contact_number, $email,
        $valid_id_type, $proof_of_pwd, $valid_id_front, $valid_id_back
    ]);
    
    // Insert a new notification
    $stmt_notification = $conn->prepare("INSERT INTO notifications (message, created_at) VALUES (?, NOW())");
    $stmt_notification->execute(["New PWD registration from $full_name"]);
    $notification_id = $conn->lastInsertId();

    // Notify all admins
    $stmt_admins = $conn->prepare("SELECT admin_id FROM admin");
    $stmt_admins->execute();
    $admins = $stmt_admins->fetchAll(PDO::FETCH_ASSOC);

    foreach ($admins as $admin) {
        if (isset($admin['admin_id']) && !empty($admin['admin_id'])) {
            $stmt_admin_notification = $conn->prepare("INSERT INTO notification_admin (notification_id, admin_id, seen, created_at) VALUES (?, ?, 0, NOW())");
            $stmt_admin_notification->execute([$notification_id, $admin['admin_id']]);
        } else {
            error_log("Admin ID is missing or invalid.");
        }
    }

    // Send email
    $mail = new PHPMailer(true);
    try {
        $mail->isSMTP();
        $mail->Host = 'smtp-relay.brevo.com';
        $mail->SMTPAuth = true;
        $mail->Username = 'jaredsonvicente1771@gmail.com'; // Your Brevo email
        $mail->Password = 'kWV40qgL9B7DGT5P'; // Your Brevo API Key
        $mail->SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS;
        $mail->Port = 587;

        $mail->setFrom('your_brevo_email@example.com', 'PWD Registration');
        $mail->addAddress($email, $full_name);

        $mail->isHTML(true);
        $mail->Subject = 'PWD Registration Confirmation';
        $mail->Body = "Dear $full_name,<br><br>" . 
                      "Your application has been received successfully! Your Application ID is <strong>$application_id</strong>.<br><br>" . 
                      "You have submitted a <strong>$valid_id_type</strong> as your valid ID.<br><br>" . 
                      "We will review your application and notify you of the next steps soon.<br><br>" . 
                      "Best regards,<br>PWD Registration Team";

        $mail->send();
    } catch (Exception $e) {
        error_log("Email sending failed: " . $mail->ErrorInfo);
    }

    // Redirect with success message
    header("Location: ../views/pwd_registration.php?message=Registration successful! Your Application ID is $application_id");
} catch (PDOException $e) {
    header("Location: ../views/pwd_registration.php?message=Error: " . $e->getMessage());
}

$conn = null; // Close the connection
?>
