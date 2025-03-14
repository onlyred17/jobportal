<?php
if (session_status() === PHP_SESSION_NONE) {
    session_start();
}
include '../include/db_conn.php';

// Check if the ID and data are provided
if (isset($_POST['name'], $_POST['location'], $_POST['description'], $_GET['id'])) {
    $id = $_GET['id'];
    $name = $_POST['name'];
    $location = $_POST['location'];
    $description = $_POST['description'];

    // Fetch company name before updating
    $query = "SELECT name FROM company WHERE id = :id";
    $stmt = $conn->prepare($query);
    $stmt->bindParam(':id', $id);
    $stmt->execute();
    $company = $stmt->fetch(PDO::FETCH_ASSOC);

    $companyName = $company ? $company['name'] : 'Unknown';

    // Handle file upload if a new logo is provided
    $logoPath = null;
    if (isset($_FILES['logo']) && $_FILES['logo']['error'] == 0) {
        $targetDir = "../uploads/";  // Directory to store the uploaded logo
        $logoFileName = basename($_FILES["logo"]["name"]);
        $targetFile = $targetDir . $logoFileName;
        
        // Move uploaded file to the target directory
        if (move_uploaded_file($_FILES["logo"]["tmp_name"], $targetFile)) {
            $logoPath = $targetFile;
        } else {
            $_SESSION['message'] = [
                'type' => 'danger',
                'text' => "Error uploading the logo."
            ];
            header('Location: ../views/view_staff_company_table.php');
            exit();
        }
    }

    // Prepare the update query
    $query = "UPDATE company SET name = :name, location = :location, description = :description" . ($logoPath ? ", logo = :logo" : "") . " WHERE id = :id";
    $stmt = $conn->prepare($query);

    // Bind parameters
    $stmt->bindParam(':name', $name);
    $stmt->bindParam(':location', $location);
    $stmt->bindParam(':description', $description);
    $stmt->bindParam(':id', $id);

    if ($logoPath) {
        $stmt->bindParam(':logo', $logoPath);
    }

    // Execute the query and check if successful
    if ($stmt->execute()) {
        $_SESSION['message'] = [
            'type' => 'success',
            'text' => "Company '{$companyName}' updated successfully!"
        ];
    } else {
        $_SESSION['message'] = [
            'type' => 'danger',
            'text' => "Error updating company '{$companyName}'."
        ];
    }

    // Redirect back to the company list page
    header('Location: ../views/view_staff_company_table.php');
    exit();
}