<?php
session_start();
include '../include/db_conn.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $name = trim(htmlspecialchars($_POST['name']));
    $location = trim(htmlspecialchars($_POST['location']));
    $description = trim(htmlspecialchars($_POST['description']));
    $created_at = date('Y-m-d H:i:s');
    
    $response = ['status' => 'error', 'message' => ''];

    // Validate required fields
    if (empty($name) || empty($location) || empty($description)) {
        $response['message'] = 'All fields are required!';
        echo json_encode($response);
        exit;
    }

    // Check if company already exists
    $checkSql = "SELECT id FROM company WHERE name = :name";
    $checkStmt = $conn->prepare($checkSql);
    $checkStmt->bindParam(':name', $name);
    $checkStmt->execute();

    if ($checkStmt->rowCount() > 0) {
        $response['message'] = 'Company already exists!';
        echo json_encode($response);
        exit;
    }

    // Default logo path
    $logoPath = '../uploads/default_logo.png';

    // Handle logo upload if provided
    if (!empty($_FILES['logo']['name'])) {
        $uploadDir = '../uploads/';
        $fileName = time() . '_' . basename($_FILES['logo']['name']);
        $targetFilePath = $uploadDir . $fileName;
        $fileType = strtolower(pathinfo($targetFilePath, PATHINFO_EXTENSION));

        // Allowed file types
        $allowedTypes = ['jpg', 'jpeg', 'png'];

        if (!in_array($fileType, $allowedTypes)) {
            $response['message'] = 'Invalid file type! Only JPG, JPEG, and PNG allowed.';
            echo json_encode($response);
            exit;
        }

        // Check file size (2MB max)
        if ($_FILES['logo']['size'] > 2 * 1024 * 1024) {
            $response['message'] = 'File size exceeds 2MB!';
            echo json_encode($response);
            exit;
        }

        // Attempt to upload file
        if (move_uploaded_file($_FILES['logo']['tmp_name'], $targetFilePath)) {
            $logoPath = $targetFilePath;
        } else {
            $response['message'] = 'File upload failed.';
            echo json_encode($response);
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

        // Insert audit log
        $user_id = $_SESSION['staff_id'] ?? $_SESSION['admin_id'] ?? null;
        $full_name = ($_SESSION['first_name'] ?? '') . ' ' . ($_SESSION['last_name'] ?? 'Unknown');
        $ip_address = $_SERVER['REMOTE_ADDR'];
        $action = 'Create';
        $description_log = "Company '{$name}' created";
        $usertype = isset($_SESSION['staff_id']) ? 'staff' : (isset($_SESSION['admin_id']) ? 'admin' : 'unknown');

        $audit_sql = "INSERT INTO audit_log (user_id, full_name, action, description, ip_address, usertype) 
                      VALUES (:user_id, :full_name, :action, :description, :ip_address, :usertype)";
        $audit_stmt = $conn->prepare($audit_sql);
        $audit_stmt->bindParam(':user_id', $user_id);
        $audit_stmt->bindParam(':full_name', $full_name);
        $audit_stmt->bindParam(':action', $action);
        $audit_stmt->bindParam(':description', $description_log);
        $audit_stmt->bindParam(':ip_address', $ip_address);
        $audit_stmt->bindParam(':usertype', $usertype);
        $audit_stmt->execute();

        $response['status'] = 'success';
        $response['message'] = 'Company added successfully!';
    } catch (PDOException $e) {
        $response['message'] = 'Database error: ' . $e->getMessage();
    }

    // Return JSON response
    echo json_encode($response);
    exit;
}