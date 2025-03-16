<?php
require_once '../vendor/autoload.php'; // Load Composer's autoloader
require_once '../include/db_conn.php'; // Include your database connection

// Prevent output before PDF generation
ob_start();

// Retrieve filters from GET request
$date_from = $_GET['date_from'] ?? '';
$date_to = $_GET['date_to'] ?? '';
$searchQuery = $_GET['search'] ?? '';

// Debugging: Print the search term and filters
error_log("Date From: " . $date_from);
error_log("Date To: " . $date_to);
error_log("Search Query: " . $searchQuery);

// Fetch the logged-in user's information (assuming session or authentication is used)
session_start();
$staffId = $_SESSION['staff_id'] ?? 'Unknown';
$firstName = $_SESSION['first_name'] ?? 'Unknown';
$lastName = $_SESSION['last_name'] ?? '';

// Get the current date and time
$printedDate = date("Y-m-d H:i:s");

// Fetch filtered data from the database using PDO
$query = "SELECT * FROM pwd_registration WHERE status IN ('pending', 'approved', 'rejected', 'for printing', 'for release', 'released', 'rejected')";
$params = [];

// Apply date filters
if (!empty($date_from) && !empty($date_to)) {
    $query .= " AND DATE(created_at) BETWEEN :date_from AND :date_to";
    $params[':date_from'] = $date_from;
    $params[':date_to'] = $date_to;
} elseif (!empty($date_from)) {
    $query .= " AND DATE(created_at) >= :date_from";
    $params[':date_from'] = $date_from;
} elseif (!empty($date_to)) {
    $query .= " AND DATE(created_at) <= :date_to";
    $params[':date_to'] = $date_to;
}

// Apply search filter
if (!empty($searchQuery)) {
    $query .= " AND (full_name LIKE :search OR address LIKE :search OR disability_type LIKE :search OR status LIKE :search)";
    $params[':search'] = "%$searchQuery%";
}

// Debugging: Print the final query and parameters
error_log("Final Query: " . $query);
error_log("Query Parameters: " . print_r($params, true));

$stmt = $conn->prepare($query);
$stmt->execute($params);
$pwd_registrations = $stmt->fetchAll(PDO::FETCH_ASSOC);

// Debugging: Print the fetched results
error_log("Fetched Results: " . print_r($pwd_registrations, true));

// Include TCPDF
require_once '../vendor/tecnickcom/tcpdf/tcpdf.php';

// Create new PDF instance
$pdf = new TCPDF();
$pdf->SetTitle('PWD Registration Report');
$pdf->AddPage();

// Set header
$pdf->SetFont('helvetica', 'B', 16);
$pdf->Cell(0, 10, 'PWD Registration Report', 0, 1, 'C');
$pdf->Ln(5);

// Printed By Details
$pdf->SetFont('helvetica', '', 12);
$pdf->Cell(0, 10, "Printed By: $firstName $lastName", 0, 1, 'L');
$pdf->Cell(0, 10, "Printed Date: $printedDate", 0, 1, 'L');
$pdf->Ln(5);

// Filters Applied
$pdf->Cell(0, 10, 'Date Range: ' . ($date_from ? $date_from : 'Not specified') . ' to ' . ($date_to ? $date_to : 'Not specified'), 0, 1, 'L');
$pdf->Cell(0, 10, 'Search Term: ' . ($searchQuery ? $searchQuery : 'None'), 0, 1, 'L');
$pdf->Ln(10);

// Table Header Styling
$pdf->SetFont('helvetica', 'B', 12);
$pdf->SetFillColor(200, 200, 200); // Light gray background for header
$pdf->Cell(60, 10, 'Full Name', 1, 0, 'C', true);
$pdf->Cell(50, 10, 'Address', 1, 0, 'C', true);
$pdf->Cell(50, 10, 'Disability Type', 1, 0, 'C', true);
$pdf->Cell(40, 10, 'Status', 1, 1, 'C', true);

$pdf->SetFont('helvetica', '', 11);

// Populate table rows
foreach ($pwd_registrations as $pwd) {
    $pdf->Cell(60, 10, $pwd['full_name'], 1, 0, 'C');
    $pdf->Cell(50, 10, $pwd['address'], 1, 0, 'C');
    $pdf->Cell(50, 10, $pwd['disability_type'], 1, 0, 'C');
    $pdf->Cell(40, 10, $pwd['status'], 1, 1, 'C');
}

// Clear output buffer before sending PDF
ob_end_clean();

// Output PDF
$pdf->Output('pwd_registration_report.pdf', 'I');
?>