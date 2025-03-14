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
    // Fetch admin details
    $sql = "SELECT admin_id, email, password, first_name, last_name, profile_pic FROM admin WHERE email = :email";
    $stmt = $conn->prepare($sql);
    $stmt->bindParam(':email', $email);
    $stmt->execute();
    $admin = $stmt->fetch(PDO::FETCH_ASSOC);

    if (!$admin) {
        echo json_encode(['status' => 'error', 'message' => 'Email not found.']);
        exit;
    }

    // Verify password
    if (!password_verify($password, $admin['password'])) {
        echo json_encode(['status' => 'error', 'message' => 'Incorrect password.']);
        exit;
    }

    // Login successful
    session_start();
    $_SESSION['admin_id'] = $admin['admin_id']; // Store admin ID
    $_SESSION['email'] = $admin['email']; // Store admin email
    $_SESSION['first_name'] = $admin['first_name']; // Store first name
    $_SESSION['last_name'] = $admin['last_name']; // Store last name
    $_SESSION['profile_pic'] = $admin['profile_pic']; // Store profile picture
    $userType = isset($_SESSION['usertype']) ? $_SESSION['usertype'] : 'admin'; // Default to 'admin'

  // Insert into audit log for admin login
$full_name = $admin['first_name'] . ' ' . $admin['last_name'];
$ip_address = $_SERVER['REMOTE_ADDR']; // Get the user's IP address
$action = 'Login'; // Action type
$description = 'Admin logged in successfully'; // Description of the action
$usertype = 'admin'; // Set the usertype to 'admin'

// Insert into audit log
$audit_sql = "INSERT INTO audit_log (user_id, full_name, action, description, ip_address, usertype) 
              VALUES (:user_id, :full_name, :action, :description, :ip_address, :usertype)";
$audit_stmt = $conn->prepare($audit_sql);
$audit_stmt->bindParam(':user_id', $admin['admin_id']);
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
