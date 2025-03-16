<?php
session_start();
include '../include/db_conn.php';

// Redirect if not logged in
if (!isset($_SESSION['admin_id'])) {
    header('Location: login.php');
    exit;
}


try {
    // Fetch admin details
    $sql = "SELECT first_name, last_name, contact_number, profile_pic FROM admin WHERE admin_id = :admin_id";
    $stmt = $conn->prepare($sql);
    $stmt->bindParam(':admin_id', $_SESSION['admin_id']);
    $stmt->execute();
    $admin = $stmt->fetch(PDO::FETCH_ASSOC);

    if (!$admin) {
        die("admin member not found.");
    }
} catch (PDOException $e) {
    die("Database error: " . $e->getMessage());
}

// Handle form submission
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Ensure fields are set
    $first_name = isset($_POST['firstName']) ? trim($_POST['firstName']) : $admin['first_name'];
    $last_name = isset($_POST['lastName']) ? trim($_POST['lastName']) : $admin['last_name'];
    $contact_number = isset($_POST['contactNumber']) ? trim($_POST['contactNumber']) : $admin['contact_number'];
    $profile_pic_path = $admin['profile_pic']; // Default to existing profile pic

    // Handle profile picture upload
    if (!empty($_FILES['profilePic']['name'])) {
        $uploadDir = '../uploads/';
        $fileName = time() . '_' . basename($_FILES['profilePic']['name']); // Unique filename
        $targetFilePath = $uploadDir . $fileName;
        $fileType = strtolower(pathinfo($targetFilePath, PATHINFO_EXTENSION));

        // Allowed file types
        $allowedTypes = ['jpg', 'jpeg', 'png'];
        if (in_array($fileType, $allowedTypes) && $_FILES['profilePic']['size'] < 2 * 1024 * 1024) { // Max 2MB
            if (move_uploaded_file($_FILES['profilePic']['tmp_name'], $targetFilePath)) {
                $profile_pic_path = $targetFilePath; // Update new profile pic path
            }
        }
    }

    // Update the database
    try {
        $sql = "UPDATE admin 
                SET first_name = :first_name, 
                    last_name = :last_name, 
                    contact_number = :contact_number, 
                    profile_pic = :profile_pic 
                WHERE admin_id = :admin_id";
        $stmt = $conn->prepare($sql);
        $stmt->bindParam(':first_name', $first_name);
        $stmt->bindParam(':last_name', $last_name);
        $stmt->bindParam(':contact_number', $contact_number);
        $stmt->bindParam(':profile_pic', $profile_pic_path);
        $stmt->bindParam(':admin_id', $_SESSION['admin_id']);
        $stmt->execute();

        // Update session variables
        $_SESSION['first_name'] = $first_name;
        $_SESSION['last_name'] = $last_name;
        $_SESSION['profile_pic'] = $profile_pic_path;
        $_SESSION['message1'] = ['type' => 'success', 'text' => 'Profile updated successfully!'];

        // Audit Log: What was edited
        $user_id = $_SESSION['admin_id'];
        $full_name = $first_name . ' ' . $last_name;
        $ip_address = $_SERVER['REMOTE_ADDR']; // Get the user's IP address
        $action = 'Update'; // Action type
        $description_log = "admin profile updated: ";

        // Specify what fields were updated
        $editedFields = [];
        if ($first_name !== $admin['first_name']) {
            $editedFields[] = "First Name";
        }
        if ($last_name !== $admin['last_name']) {
            $editedFields[] = "Last Name";
        }
        if ($contact_number !== $admin['contact_number']) {
            $editedFields[] = "Contact Number";
        }
        if ($profile_pic_path !== $admin['profile_pic']) {
            $editedFields[] = "Profile Picture";
        }

        // Append the edited fields to the description
        $description_log .= implode(', ', $editedFields);

        $usertype = 'admin'; // User type (admin)

        // Insert the audit log
        $audit_sql = "INSERT INTO audit_log (user_id, full_name, action, description, ip_address, usertype) 
                      VALUES (:user_id, :full_name, :action, :description, :ip_address, :usertype)";
        $audit_stmt = $conn->prepare($audit_sql);
        $audit_stmt->bindParam(':user_id', $user_id);
        $audit_stmt->bindParam(':full_name', $full_name);
        $audit_stmt->bindParam(':action', $action);
        $audit_stmt->bindParam(':description', $description_log);
        $audit_stmt->bindParam(':ip_address', $ip_address);
        $audit_stmt->bindParam(':usertype', $usertype); // Bind the usertype
        $audit_stmt->execute();

    } catch (PDOException $e) {
        $_SESSION['message'] = ['type' => 'error', 'text' => 'Database error: ' . $e->getMessage()];
    }

    // Redirect to avoid resubmission
    header('Location: ../views/view_admin_edit_profile.php');
    exit;
}
?>
