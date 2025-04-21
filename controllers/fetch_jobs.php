<?php
include '../include/db_conn.php'; // Include the database connection file

// Get parameters from the request
$page = isset($_GET['page']) ? (int)$_GET['page'] : 1; // Default to page 1
$limit = 6; // Limit of jobs per page
$start = ($page - 1) * $limit;
$search = isset($_GET['search']) ? $_GET['search'] : '';
$job_type = isset($_GET['job_type']) ? $_GET['job_type'] : '';

// Build the query with optional filters
$query = "SELECT * FROM jobs WHERE 
          (title LIKE :search OR 
           location LIKE :search OR 
           job_type LIKE :search OR 
           company_name LIKE :search)";

// Apply job type filter if specified
if ($job_type != '') {
    $query .= " AND job_type = :job_type";
}

// Order by latest (assuming 'id' is the primary key and auto-incremented)
$query .= " ORDER BY id DESC";

// Add pagination
$query .= " LIMIT :start, :limit";

// Prepare and execute the query for fetching jobs
$stmt = $conn->prepare($query);

// Bind parameters
$stmt->bindValue(':search', "%$search%", PDO::PARAM_STR);
if ($job_type != '') {
    $stmt->bindValue(':job_type', $job_type, PDO::PARAM_STR);
}
$stmt->bindValue(':start', $start, PDO::PARAM_INT);
$stmt->bindValue(':limit', $limit, PDO::PARAM_INT);

// Execute the query
$stmt->execute();
$jobs = $stmt->fetchAll(PDO::FETCH_ASSOC);

// Get the total number of jobs for pagination
$totalQuery = "SELECT COUNT(*) FROM jobs WHERE 
               (title LIKE :search OR 
                location LIKE :search OR 
                job_type LIKE :search OR 
                company_name LIKE :search)";

if ($job_type != '') {
    $totalQuery .= " AND job_type = :job_type";
}

$totalStmt = $conn->prepare($totalQuery);
$totalStmt->bindValue(':search', "%$search%", PDO::PARAM_STR);
if ($job_type != '') {
    $totalStmt->bindValue(':job_type', $job_type, PDO::PARAM_STR);
}

$totalStmt->execute();
$totalJobs = $totalStmt->fetchColumn();

// Calculate the total number of pages
$totalPages = ceil($totalJobs / $limit);

// Send the data as JSON
if (count($jobs) > 0) {
    echo json_encode([
        'status' => 'success',
        'data' => $jobs,
        'totalPages' => $totalPages,
        'currentPage' => $page
    ]);
} else {
    echo json_encode([
        'status' => 'no_jobs',
        'message' => 'No available jobs found matching your search.'
    ]);
}
?>
