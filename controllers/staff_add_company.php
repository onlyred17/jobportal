<?php
session_start();
include '../include/db_conn.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $name = trim($_POST['name']);
    $location = trim($_POST['location']);
    $description = trim($_POST['description']);
    $created_at = date('Y-m-d H:i:s');

    // Check if company already exists
    $checkSql = "SELECT id FROM company WHERE name = :name";
    $checkStmt = $conn->prepare($checkSql);
    $checkStmt->bindParam(':name', $name);
    $checkStmt->execute();

    if ($checkStmt->rowCount() > 0) {
        $_SESSION['message'] = ['type' => 'error', 'text' => 'Company already exists!'];
        header('Location: ../views/view_staff_add_company.php');
        exit;
    }

    // Handle logo upload
    $logoPath = '../uploads/default_logo.png'; // Default logo
    if (!empty($_FILES['logo']['name'])) {
        $uploadDir = '../uploads/';
        $fileName = time() . '_' . basename($_FILES['logo']['name']);
        $targetFilePath = $uploadDir . $fileName;
        $fileType = strtolower(pathinfo($targetFilePath, PATHINFO_EXTENSION));

        // Allowed file types
        $allowedTypes = ['jpg', 'jpeg', 'png'];

        if (!in_array($fileType, $allowedTypes)) {
            $_SESSION['message'] = ['type' => 'error', 'text' => 'Invalid file type! Only JPG, JPEG, and PNG allowed.'];
            header('Location: ../views/view_staff_add_company.php');
            exit;
        }

        if ($_FILES['logo']['size'] > 2 * 1024 * 1024) { // Max 2MB
            $_SESSION['message'] = ['type' => 'error', 'text' => 'File size exceeds 2MB!'];
            header('Location: ../views/view_staff_add_company.php');
            exit;
        }

        if (move_uploaded_file($_FILES['logo']['tmp_name'], $targetFilePath)) {
            $logoPath = $targetFilePath;
        } else {
            $_SESSION['message'] = ['type' => 'error', 'text' => 'File upload failed.'];
            header('Location: ../views/view_staff_add_company.php');
            exit;
        }
    }

    // Insert into database
    try {
        $sql = "INSERT INTO company (name, logo, location, description, created_at) 
                VALUES (:name, :logo, :location, :description, :created_at)";
        $stmt = $conn->prepare($sql);
        $stmt->bindParam(':name', $name);
        $stmt->bindParam(':logo', $logoPath);
        $stmt->bindParam(':location', $location);
        $stmt->bindParam(':description', $description);
        $stmt->bindParam(':created_at', $created_at);
        $stmt->execute();

        $_SESSION['message'] = ['type' => 'success', 'text' => 'Company added successfully!'];

        // Insert into audit log for company creation
        $user_id = isset($_SESSION['staff_id']) ? $_SESSION['staff_id'] : (isset($_SESSION['admin_id']) ? $_SESSION['admin_id'] : null);
        $full_name = isset($_SESSION['first_name']) && isset($_SESSION['last_name']) ? $_SESSION['first_name'] . ' ' . $_SESSION['last_name'] : 'Unknown';
        $ip_address = $_SERVER['REMOTE_ADDR']; // Get the user's IP address
        $action = 'Create'; // Action type
        $description_log = "Company '{$name}' created"; // Description of the action

        // Check the user type (staff or admin)
        $usertype = isset($_SESSION['staff_id']) ? 'staff' : (isset($_SESSION['admin_id']) ? 'admin' : 'unknown');

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
    header('Location: ../views/view_staff_add_company.php');
    exit;
}
