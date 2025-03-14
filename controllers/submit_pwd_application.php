<?php
$host = 'localhost';
$dbname = 'job_portal';
$username = 'root';
$password = '';

try {
    $conn = new PDO("mysql:host=$host;dbname=$dbname", $username, $password);
    $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
} catch (PDOException $e) {
    die("Database connection failed: " . $e->getMessage());
}

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

// File upload directories
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

// Upload Valid ID
$valid_id_result = uploadFile($_FILES["valid_id"], $target_dir);
if (isset($valid_id_result["error"])) {
    header("Location: ../views/pwd_registration.php?message=" . $valid_id_result["error"]);
    exit();
}
$valid_id = $valid_id_result["success"];

try {
    // Check if email already exists
    $check_email = $conn->prepare("SELECT * FROM pwd_registration WHERE email = ?");
    $check_email->execute([$email]);

    if ($check_email->rowCount() > 0) {
        header("Location: ../views/pwd_registration.php?message=Email is already registered!");
        exit();
    }

    // Generate a unique Application ID
    $application_id = generateApplicationID($conn);

    // Insert data into database with status 'Pending'
    $stmt = $conn->prepare("
        INSERT INTO pwd_registration (application_id, full_name, birthdate, disability_type, address, contact_number, email, proof_of_pwd, valid_id, status, created_at, updated_at) 
        VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, 'Pending', NOW(), NOW())
    ");
    $stmt->execute([$application_id, $full_name, $birthdate, $disability_type, $address, $contact_number, $email, $proof_of_pwd, $valid_id]);

    // Redirect with Application ID in message
    header("Location: ../views/pwd_registration.php?message=Registration successful! Your Application ID is $application_id. Please save your application ID.");
} catch (PDOException $e) {
    header("Location: ../views/pwd_registration.php?message=Error: " . $e->getMessage());
}

$conn = null; // Close the connection
?>
