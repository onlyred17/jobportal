<?php
require_once '../vendor/autoload.php'; // Load Composer's autoloader
require_once '../include/db_conn.php'; // Include your database connection
session_start(); // Start session to get user details

// Prevent output before PDF generation
ob_start();

// Get user details (who printed the report)
$staffId = $_SESSION['staff_id'] ?? 'Unknown';
$firstName = $_SESSION['first_name'] ?? 'Unknown';
$lastName = $_SESSION['last_name'] ?? 'Unknown';

// Retrieve filters from GET request
$startDate = $_GET['start_date'] ?? '';
$endDate = $_GET['end_date'] ?? '';
$statusFilter = $_GET['status'] ?? '';
$searchQuery = $_GET['search'] ?? '';

// Fetch filtered data from the database using PDO
$query = "SELECT j.company_name, j.title, j.status, j.posted_date, 
                 s.staff_id, s.first_name, s.last_name 
          FROM jobs j
          LEFT JOIN staff s ON j.staff_id = s.staff_id
          WHERE 1=1";
$params = [];

// Apply filters dynamically
if (!empty($startDate)) {
    $query .= " AND j.posted_date >= :startDate";
    $params[':startDate'] = $startDate;
}
if (!empty($endDate)) {
    $query .= " AND j.posted_date <= :endDate";
    $params[':endDate'] = $endDate;
}
if (!empty($statusFilter)) {
    $query .= " AND j.status = :status";
    $params[':status'] = $statusFilter;
}
if (!empty($searchQuery)) {
    $query .= " AND (j.company_name LIKE :search OR j.title LIKE :search)";
    $params[':search'] = "%$searchQuery%";
}

$stmt = $conn->prepare($query);
$stmt->execute($params);
$results = $stmt->fetchAll(PDO::FETCH_ASSOC);

// Include TCPDF
require_once '../vendor/tecnickcom/tcpdf/tcpdf.php';

// Create new PDF instance
$pdf = new TCPDF();
$pdf->SetTitle('Job Listings Report');
$pdf->AddPage();

// Set header
$pdf->SetFont('helvetica', 'B', 16);
$pdf->Cell(0, 10, 'Job Listings Report', 0, 1, 'C');
$pdf->Ln(5);

// Printed by details
$printedDate = date('Y-m-d H:i:s');
$pdf->SetFont('helvetica', '', 12);
$pdf->Cell(0, 10, 'Printed By: ' . $firstName . ' ' . $lastName . ' (ID: ' . $staffId . ')', 0, 1, 'L');
$pdf->Cell(0, 10, 'Printed Date: ' . $printedDate, 0, 1, 'L');
$pdf->Ln(3);

// Add filter details to the PDF
$pdf->Cell(0, 10, 'Filters Applied:', 0, 1, 'L');
$pdf->Cell(0, 10, 'Start Date: ' . ($startDate ? $startDate : 'Not specified'), 0, 1, 'L');
$pdf->Cell(0, 10, 'End Date: ' . ($endDate ? $endDate : 'Not specified'), 0, 1, 'L');
$pdf->Cell(0, 10, 'Status: ' . ($statusFilter ? $statusFilter : 'All'), 0, 1, 'L');
$pdf->Cell(0, 10, 'Search Term: ' . ($searchQuery ? $searchQuery : 'None'), 0, 1, 'L');
$pdf->Ln(10);

// Table Header
$pdf->SetFont('helvetica', 'B', 12);
$pdf->Cell(50, 10, 'Company Name', 1, 0, 'C');
$pdf->Cell(60, 10, 'Job Title', 1, 0, 'C');
$pdf->Cell(30, 10, 'Status', 1, 0, 'C');
$pdf->Cell(40, 10, 'Posted Date', 1, 1, 'C');

$pdf->SetFont('helvetica', '', 12);

// Populate table rows
foreach ($results as $row) {
    $pdf->Cell(50, 10, $row['company_name'], 1, 0, 'C');
    $pdf->Cell(60, 10, $row['title'], 1, 0, 'C');
    $pdf->Cell(30, 10, $row['status'], 1, 0, 'C');
    $pdf->Cell(40, 10, $row['posted_date'], 1, 1, 'C');
}

// Clear any output buffer before sending PDF
ob_end_clean();

// Output PDF
$pdf->Output('job_listings_report.pdf', 'I');
?>
