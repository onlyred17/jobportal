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

// Function to generate a random Application ID
function generateApplicationID($conn) {
    // Generate a random string (you can adjust the length and format as needed)
    $application_id = 'APP_' . strtoupper(bin2hex(random_bytes(4)));  // 8 characters random ID

    // Check if the generated Application ID already exists
    $stmt = $conn->prepare("SELECT COUNT(*) FROM pwd_registration WHERE application_id = ?");
    $stmt->execute([$application_id]);

    // If the ID exists, generate a new one
    if ($stmt->fetchColumn() > 0) {
        return generateApplicationID($conn);
    }

    return $application_id;
}

// Get form data
$full_name = $_POST['full_name'];
$birthdate = $_POST['birthdate'];
$disability_type = $_POST['disability_type'];
$address = $_POST['address'];
$contact_number = $_POST['contact_number'];
$email = $_POST['email'];

// Handle file upload
$target_dir = "../applications/";
$file_name = time() . "_" . basename($_FILES["proof_of_pwd"]["name"]);
$target_file = $target_dir . $file_name;
$file_type = strtolower(pathinfo($target_file, PATHINFO_EXTENSION));

$allowed_types = ['jpg', 'jpeg', 'png', 'pdf'];

if (!in_array($file_type, $allowed_types)) {
    header("Location: ../views/pwd_registration.php?message=Invalid file type! Only JPG, PNG, and PDF allowed.");
    exit();
}

if (move_uploaded_file($_FILES["proof_of_pwd"]["tmp_name"], $target_file)) {
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
        $stmt = $conn->prepare("INSERT INTO pwd_registration (application_id, full_name, birthdate, disability_type, address, contact_number, email, proof_of_pwd, status) 
                                VALUES (?, ?, ?, ?, ?, ?, ?, ?, 'Pending')");
        $stmt->execute([$application_id, $full_name, $birthdate, $disability_type, $address, $contact_number, $email, $target_file]);

        // Redirect with the Application ID in the message
        header("Location: ../views/pwd_registration.php?message=Registration successful! Your Application ID is $application_id. Please save your application ID.");
    } catch (PDOException $e) {
        header("Location: ../views/pwd_registration.php?message=Error: " . $e->getMessage());
    }
} else {
    header("Location: ../views/pwd_registration.php?message=Error uploading file.");
}

$conn = null; // Close the connection
?>
