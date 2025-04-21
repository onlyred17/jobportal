<?php
// Include database connection
include '../include/db_conn.php';

// Get form data
$email = $_POST['email'];
$password = $_POST['password'];

// Validate inputs
if (empty($email) || empty($password)) {
    echo json_encode(['status' => 'error', 'message' => 'Email and password are required.']);
    exit;
}

try {
    // Fetch super_admin details
    $sql = "SELECT super_admin_id, email, password, first_name, last_name, profile_pic FROM super_admin WHERE email = :email";
    $stmt = $conn->prepare($sql);
    $stmt->bindParam(':email', $email);
    $stmt->execute();
    $super_admin = $stmt->fetch(PDO::FETCH_ASSOC);

    if (!$super_admin) {
        echo json_encode(['status' => 'error', 'message' => 'Email not found.']);
        exit;
    }

    // Verify password
    if (!password_verify($password, $super_admin['password'])) {
        echo json_encode(['status' => 'error', 'message' => 'Incorrect password.']);
        exit;
    }

    // Login successful
    session_start();
    $_SESSION['super_admin_id'] = $super_admin['super_admin_id']; // Store admin ID
    $_SESSION['email'] = $super_admin['email']; // Store admin email
    $_SESSION['first_name'] = $super_admin['first_name']; // Store first name
    $_SESSION['last_name'] = $super_admin['last_name']; // Store last name
    $_SESSION['profile_pic'] = $super_admin['profile_pic']; // Store profile picture
    $_SESSION['usertype'] = 'super_admin'; // Explicitly set usertype to 'admin'
  // Insert into audit log for admin login
$full_name = $super_admin['first_name'] . ' ' . $super_admin['last_name'];
$ip_address = $_SERVER['REMOTE_ADDR']; // Get the user's IP address
$action = 'Login'; // Action type
$description = 'Super Admin logged in successfully'; // Description of the action
$usertype = 'super_admin'; // Set the usertype to 'admin'

// Insert into audit log
$audit_sql = "INSERT INTO audit_log (user_id, full_name, action, description, ip_address, usertype) 
              VALUES (:user_id, :full_name, :action, :description, :ip_address, :usertype)";
$audit_stmt = $conn->prepare($audit_sql);
$audit_stmt->bindParam(':user_id', $super_admin['super_admin_id']);
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
