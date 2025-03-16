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
    // Fetch staff details
    $sql = "SELECT staff_id, email, password, first_name, last_name, profile_pic FROM staff WHERE email = :email";
    $stmt = $conn->prepare($sql);
    $stmt->bindParam(':email', $email);
    $stmt->execute();
    $staff = $stmt->fetch(PDO::FETCH_ASSOC);

    if (!$staff) {
        echo json_encode(['status' => 'error', 'message' => 'Email not found.']);
        exit;
    }

    // Verify password
    if (!password_verify($password, $staff['password'])) {
        echo json_encode(['status' => 'error', 'message' => 'Incorrect password.']);
        exit;
    }

    // Login successful
    session_start();
    $_SESSION['staff_id'] = $staff['staff_id']; // Correct column name
    $_SESSION['email'] = $staff['email']; // Store staff email in session
    $_SESSION['first_name'] = $staff['first_name']; // Store first name in session
    $_SESSION['last_name'] = $staff['last_name']; // Store last name in session
    $_SESSION['profile_pic'] = $staff['profile_pic']; // Store profile picture in session
    $userType = isset($_SESSION['usertype']) ? $_SESSION['usertype'] : 'staff'; // Default to 'staff'

 // Insert into audit log
$full_name = $staff['first_name'] . ' ' . $staff['last_name'];
$ip_address = $_SERVER['REMOTE_ADDR']; // Get the user's IP address
$action = 'Login'; // Action type
$description = 'User logged in successfully'; // Description of the action
$usertype = 'staff'; // Add the usertype (staff in this case)

// Insert into audit log
$audit_sql = "INSERT INTO audit_log (user_id, full_name, action, description, ip_address, usertype) 
              VALUES (:user_id, :full_name, :action, :description, :ip_address, :usertype)";
$audit_stmt = $conn->prepare($audit_sql);
$audit_stmt->bindParam(':user_id', $staff['staff_id']);
$audit_stmt->bindParam(':full_name', $full_name);
$audit_stmt->bindParam(':action', $action);
$audit_stmt->bindParam(':description', $description);
$audit_stmt->bindParam(':ip_address', $ip_address);
$audit_stmt->bindParam(':usertype', $usertype); // Bind the usertype
$audit_stmt->execute();

    echo json_encode(['status' => 'success', 'message' => 'Login successful!']);
} catch (PDOException $e) {
    // Handle database errors
    echo json_encode(['status' => 'error', 'message' => 'Database error: ' . $e->getMessage()]);
}
?>
