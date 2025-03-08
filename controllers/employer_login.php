<?php
// Include database connection
include '..//include/db_conn.php';

// Get form data
$email = $_POST['email'];
$password = $_POST['password'];

// Validate inputs
if (empty($email) || empty($password)) {
    echo json_encode(['status' => 'error', 'message' => 'Email and password are required.']);
    exit;
}

try {
    // Fetch employer details
    $sql = "SELECT id, email, password, first_name, last_name, profile_pic FROM employers WHERE email = :email";
    $stmt = $conn->prepare($sql);
    $stmt->bindParam(':email', $email);
    $stmt->execute();
    $employer = $stmt->fetch(PDO::FETCH_ASSOC);

    if (!$employer) {
        echo json_encode(['status' => 'error', 'message' => 'Email not found.']);
        exit;
    }

    // Verify password
    if (!password_verify($password, $employer['password'])) {
        echo json_encode(['status' => 'error', 'message' => 'Incorrect password.']);
        exit;
    }

    // Login successful
    session_start();
    $_SESSION['employer_id'] = $employer['id']; // Store employer ID in session
    $_SESSION['email'] = $employer['email']; // Store employer email in session
    $_SESSION['first_name'] = $employer['first_name']; // Store first name in session
    $_SESSION['last_name'] = $employer['last_name']; // Store last name in session
    $_SESSION['profile_pic'] = $employer['profile_pic']; // Store profile picture in session

    echo json_encode(['status' => 'success', 'message' => 'Login successful!']);
} catch (PDOException $e) {
    // Handle database errors
    echo json_encode(['status' => 'error', 'message' => 'Database error: ' . $e->getMessage()]);
}
?>