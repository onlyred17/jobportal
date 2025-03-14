<?php
session_start();
include '../include/db_conn.php';

// Check if the ID is provided
if (isset($_GET['id'])) {
    $id = $_GET['id'];

    // Fetch the company name before deletion
    $query = "SELECT name FROM company WHERE id = :id";
    $stmt = $conn->prepare($query);
    $stmt->bindParam(':id', $id);
    $stmt->execute();
    $company = $stmt->fetch(PDO::FETCH_ASSOC);

    // Check if the company exists
    if ($company) {
        $companyName = $company['name'];

        // Prepare the delete query
        $query = "DELETE FROM company WHERE id = :id";
        $stmt = $conn->prepare($query);
        $stmt->bindParam(':id', $id);

        // Execute the query and check if successful
        if ($stmt->execute()) {
            $_SESSION['message'] = [
                'type' => 'success',
                'text' => "Company '{$companyName}' deleted successfully!"
            ];
        } else {
            $_SESSION['message'] = [
                'type' => 'danger',
                'text' => "Error deleting company '{$companyName}'."
            ];
        }
    } else {
        $_SESSION['message'] = [
            'type' => 'warning',
            'text' => "Company not found."
        ];
    }

    // Redirect back to the company list page
    header('Location: ../views/view_staff_company_table.php');
    exit();
}