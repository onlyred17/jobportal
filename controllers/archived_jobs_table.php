<?php
// Include database connection
include_once '../include/db_conn.php';

try {
    // Prepare SQL query to get archived jobs
    $query = "SELECT j.id, j.title, j.posted_date, j.archived_date, c.name as company_name
              FROM jobs j
              INNER JOIN company c ON j.company_id = c.id
              WHERE j.status = 'Archived'";
    
  
    
    $query .= " ORDER BY j.archived_date DESC";
    
    $stmt = $conn->prepare($query);
    

    
    // Execute the query
    $stmt->execute();
    
    // Fetch all archived jobs
    $archivedJobs = $stmt->fetchAll(PDO::FETCH_ASSOC);
    
} catch (PDOException $e) {
    // Handle database errors
    $_SESSION['message'] = [
        'type' => 'danger',
        'text' => 'Database error: ' . $e->getMessage()
    ];
    $archivedJobs = [];
}
?>