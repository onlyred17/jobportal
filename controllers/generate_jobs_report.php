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
$query = "SELECT j.company_name, j.title, j.status, j.posted_date FROM jobs j WHERE 1=1";
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

$query .= " ORDER BY j.company_name ASC"; // Sort alphabetically by company name
$stmt = $conn->prepare($query);
$stmt->execute($params);
$results = $stmt->fetchAll(PDO::FETCH_ASSOC);

// Include TCPDF
require_once '../vendor/tecnickcom/tcpdf/tcpdf.php';

// Create new PDF instance in landscape mode
$pdf = new TCPDF('L', 'mm', 'A4', true, 'UTF-8', false);
$pdf->SetCreator('Job Listings System');
$pdf->SetAuthor($firstName . ' ' . $lastName);
$pdf->SetTitle('Job Listings Report');
$pdf->SetSubject('Job Listings Report');

// Remove default header/footer
$pdf->setPrintHeader(false);
$pdf->setPrintFooter(false);

// Set margins
$pdf->SetMargins(15, 15, 15);
$pdf->SetAutoPageBreak(true, 15);

// Add a page
$pdf->AddPage();

// Set colors
$headerBgColor = [52, 152, 219]; // Blue
$headerTextColor = [255, 255, 255]; // White
$alternateRowColor = [240, 248, 255]; // Light blue
$borderColor = [189, 195, 199]; // Gray

// Header
$pdf->SetFont('helvetica', 'B', 20);
$pdf->SetTextColor(44, 62, 80);
$pdf->Cell(0, 15, 'JOB LISTINGS REPORT', 0, 1, 'C');
$pdf->Ln(2);

// Report information section
$pdf->SetFont('helvetica', '', 10);
$pdf->SetTextColor(44, 62, 80);
$pdf->SetFillColor(248, 249, 250);
$pdf->SetDrawColor($borderColor[0], $borderColor[1], $borderColor[2]);

// Printed by details
$printedDate = date('Y-m-d H:i:s');
$pdf->Cell(0, 10, 'Printed By: ' . $firstName . ' ' . $lastName . ' (ID: ' . $staffId . ')', 0, 1, 'L');
$pdf->Cell(0, 10, 'Printed Date: ' . $printedDate, 0, 1, 'L');
$pdf->Ln(5);

// Table Headers
$pdf->SetFont('helvetica', 'B', 11);
$pdf->SetFillColor($headerBgColor[0], $headerBgColor[1], $headerBgColor[2]);
$pdf->SetTextColor($headerTextColor[0], $headerTextColor[1], $headerTextColor[2]);
$pdf->SetDrawColor($borderColor[0], $borderColor[1], $borderColor[2]);

$colWidths = [70, 90, 40, 50];

$pdf->Cell($colWidths[0], 10, 'Company Name', 1, 0, 'C', true);
$pdf->Cell($colWidths[1], 10, 'Job Title', 1, 0, 'C', true);
$pdf->Cell($colWidths[2], 10, 'Status', 1, 0, 'C', true);
$pdf->Cell($colWidths[3], 10, 'Posted Date', 1, 1, 'C', true);

$pdf->SetTextColor(44, 62, 80);
$pdf->SetFont('helvetica', '', 10);

$fill = false;

// Loop through records and add to table
foreach ($results as $row) {
    $pdf->SetFillColor($fill ? $alternateRowColor[0] : 255, $fill ? $alternateRowColor[1] : 255, $fill ? $alternateRowColor[2] : 255);
    
    $pdf->Cell($colWidths[0], 8, htmlspecialchars($row['company_name']), 1, 0, 'L', $fill);
    $pdf->Cell($colWidths[1], 8, htmlspecialchars($row['title']), 1, 0, 'L', $fill);
    $pdf->Cell($colWidths[2], 8, $row['status'], 1, 0, 'C', $fill);
    $pdf->Cell($colWidths[3], 8, $row['posted_date'], 1, 1, 'C', $fill);
    
    $fill = !$fill;
}

// Footer
$pdf->SetY(-15);
$pdf->SetFont('helvetica', 'I', 8);
$pdf->Cell(0, 10, 'Page ' . $pdf->getAliasNumPage() . ' of ' . $pdf->getAliasNbPages(), 0, 0, 'C');

// Output the PDF
ob_end_clean();
$pdf->Output('job_listings_report.pdf', 'I');
?>