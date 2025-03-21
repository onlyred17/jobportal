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
$date_from = $_GET['date_from'] ?? '';
$date_to = $_GET['date_to'] ?? '';
$searchQuery = $_GET['search'] ?? '';

// Fetch filtered data from the database using PDO
$query = "SELECT full_name, address, disability_type, status, created_at FROM pwd_registration WHERE status IN ('pending', 'approved', 'rejected', 'for printing', 'for release', 'released', 'rejected')";
$params = [];

if (!empty($date_from)) {
    $query .= " AND DATE(created_at) >= :date_from";
    $params[':date_from'] = $date_from;
}
if (!empty($date_to)) {
    $query .= " AND DATE(created_at) <= :date_to";
    $params[':date_to'] = $date_to;
}
if (!empty($searchQuery)) {
    $query .= " AND (full_name LIKE :search OR address LIKE :search OR disability_type LIKE :search OR status LIKE :search)";
    $params[':search'] = "%$searchQuery%";
}

$query .= " ORDER BY full_name ASC";
$stmt = $conn->prepare($query);
$stmt->execute($params);
$pwd_registrations = $stmt->fetchAll(PDO::FETCH_ASSOC);

// Include TCPDF
require_once '../vendor/tecnickcom/tcpdf/tcpdf.php';

// Create new PDF instance in landscape mode
$pdf = new TCPDF('L', 'mm', 'A4', true, 'UTF-8', false);
$pdf->SetCreator('PWD Registration System');
$pdf->SetAuthor($firstName . ' ' . $lastName);
$pdf->SetTitle('PWD Registration Report');
$pdf->SetSubject('PWD Registration Report');

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
$pdf->Cell(0, 15, 'PWD REGISTRATION REPORT', 0, 1, 'C');
$pdf->Ln(2);

// Report information section
$pdf->SetFont('helvetica', '', 10);
$pdf->SetTextColor(44, 62, 80);
$pdf->SetFillColor(248, 249, 250);
$pdf->SetDrawColor($borderColor[0], $borderColor[1], $borderColor[2]);

$printedDate = date('Y-m-d H:i:s');
$pdf->Cell(0, 10, 'Printed By: ' . $firstName . ' ' . $lastName . ' (ID: ' . $staffId . ')', 0, 1, 'L');
$pdf->Cell(0, 10, 'Printed Date: ' . $printedDate, 0, 1, 'L');
$pdf->Ln(5);

// Table Headers
$pdf->SetFont('helvetica', 'B', 11);
$pdf->SetFillColor($headerBgColor[0], $headerBgColor[1], $headerBgColor[2]);
$pdf->SetTextColor($headerTextColor[0], $headerTextColor[1], $headerTextColor[2]);
$pdf->SetDrawColor($borderColor[0], $borderColor[1], $borderColor[2]);

$colWidths = [80, 90, 60, 50];

$pdf->Cell($colWidths[0], 10, 'Full Name', 1, 0, 'C', true);
$pdf->Cell($colWidths[1], 10, 'Address', 1, 0, 'C', true);
$pdf->Cell($colWidths[2], 10, 'Disability Type', 1, 0, 'C', true);
$pdf->Cell($colWidths[3], 10, 'Status', 1, 1, 'C', true);

$pdf->SetTextColor(44, 62, 80);
$pdf->SetFont('helvetica', '', 10);

$fill = false;

// Loop through records and add to table
foreach ($pwd_registrations as $pwd) {
    $pdf->SetFillColor($fill ? $alternateRowColor[0] : 255, $fill ? $alternateRowColor[1] : 255, $fill ? $alternateRowColor[2] : 255);
    
    $pdf->Cell($colWidths[0], 8, htmlspecialchars($pwd['full_name']), 1, 0, 'L', $fill);
    $pdf->Cell($colWidths[1], 8, htmlspecialchars($pwd['address']), 1, 0, 'L', $fill);
    $pdf->Cell($colWidths[2], 8, htmlspecialchars($pwd['disability_type']), 1, 0, 'L', $fill);
    $pdf->Cell($colWidths[3], 8, htmlspecialchars($pwd['status']), 1, 1, 'C', $fill);
    
    $fill = !$fill;
}

// Footer
$pdf->SetY(-15);
$pdf->SetFont('helvetica', 'I', 8);
$pdf->Cell(0, 10, 'Page ' . $pdf->getAliasNumPage() . ' of ' . $pdf->getAliasNbPages(), 0, 0, 'C');

// Output the PDF
ob_end_clean();
$pdf->Output('pwd_registration_report.pdf', 'I');
?>
