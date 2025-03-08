<?php
include '..//include/db_conn.php'; // Include the database connection file

$response = ['status' => 'error', 'message' => 'An error occurred.'];

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Sanitize and validate inputs
    $first_name = htmlspecialchars($_POST['first_name']);
    $last_name = htmlspecialchars($_POST['last_name']);
    $email = filter_var($_POST['email'], FILTER_SANITIZE_EMAIL);
    $password = password_hash($_POST['password'], PASSWORD_BCRYPT);
    $company_name = htmlspecialchars($_POST['company_name']);
    $location = htmlspecialchars($_POST['location']);
    $company_description = htmlspecialchars($_POST['company_description']);

    // Validate email
    if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
        $response['message'] = "Invalid email format.";
        echo json_encode($response);
        exit;
    }

    // Handle company logo upload
    $company_logo = 'default_company_logo.jpg'; // Default logo
    if (isset($_FILES['company_logo']) && $_FILES['company_logo']['error'] == UPLOAD_ERR_OK) {
        $upload_dir = '../uploads/company_logos/'; // Directory to store uploaded logos
        if (!is_dir($upload_dir)) {
            mkdir($upload_dir, 0755, true); // Create the directory if it doesn't exist
        }

        $file_name = basename($_FILES['company_logo']['name']);
        $file_path = $upload_dir . $file_name;

        // Move the uploaded file to the desired directory
        if (move_uploaded_file($_FILES['company_logo']['tmp_name'], $file_path)) {
            $company_logo = $file_path; // Use the uploaded logo path
        } else {
            $response['message'] = "Failed to upload company logo.";
            echo json_encode($response);
            exit;
        }
    }

    try {
        $conn->beginTransaction();

        // Check if the email already exists
        $stmt = $conn->prepare("SELECT id FROM employers WHERE email = :email");
        $stmt->execute([':email' => $email]);
        if ($stmt->fetch(PDO::FETCH_ASSOC)) {
            $response['message'] = "An employer with this email already exists.";
            echo json_encode($response);
            exit;
        }

        // Check if the company already exists
        $stmt = $conn->prepare("SELECT id FROM companies WHERE company_name = :company_name");
        $stmt->execute([':company_name' => $company_name]);
        $company = $stmt->fetch(PDO::FETCH_ASSOC);

        if ($company) {
            $company_id = $company['id'];
        } else {
            // Insert new company
            $stmt = $conn->prepare("INSERT INTO companies (company_name, location, company_logo, company_description) VALUES (:company_name, :location, :company_logo, :company_description)");
            $stmt->execute([
                ':company_name' => $company_name,
                ':location' => $location,
                ':company_logo' => $company_logo, // Use the dynamic logo path
                ':company_description' => $company_description
            ]);
            $company_id = $conn->lastInsertId();
        }

        // Insert employer with default profile picture
        $default_profile_pic = '../images/default_profile.jpg'; // Default profile picture
        $stmt = $conn->prepare("INSERT INTO employers (first_name, last_name, email, password, profile_pic) VALUES (:first_name, :last_name, :email, :password, :profile_pic)");
        $stmt->execute([
            ':first_name' => $first_name,
            ':last_name' => $last_name,
            ':email' => $email,
            ':password' => $password,
            ':profile_pic' => $default_profile_pic // Insert default profile picture
        ]);
        $employer_id = $conn->lastInsertId();

        // Link employer to company
        $stmt = $conn->prepare("INSERT INTO employer_company (employer_id, company_id) VALUES (:employer_id, :company_id)");
        $stmt->execute([
            ':employer_id' => $employer_id,
            ':company_id' => $company_id
        ]);

        $conn->commit();
        $response = ['status' => 'success', 'message' => 'Registration successful!'];
    } catch (PDOException $e) {
        $conn->rollBack();
        $response['message'] = "Error: " . $e->getMessage();
    }
}

header('Content-Type: application/json');
echo json_encode($response);
?>