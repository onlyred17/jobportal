<?php
require_once '../vendor/autoload.php'; // Load Composer's autoloader
require_once '../include/db_conn.php'; // Include your database connection

// Prevent output before PDF generation
ob_start();
session_start();

// Get user details (who printed the report)
$staffId = $_SESSION['staff_id'] ?? 'Unknown';
$firstName = $_SESSION['first_name'] ?? 'Unknown';
$lastName = $_SESSION['last_name'] ?? 'Unknown';

// Get the current date and time
$printedDate = date("Y-m-d H:i:s");

// Retrieve search term from GET request
$searchQuery = $_GET['search'] ?? '';

// Fetch only released PWD registrations
$query = "SELECT full_name, address, contact_number, email, birthdate, disability_type 
          FROM pwd_registration 
          WHERE status IN ('released')";
$params = [];

if (!empty($searchQuery)) {
    $query .= " AND (full_name LIKE :search OR address LIKE :search OR contact_number LIKE :search OR email LIKE :search OR disability_type LIKE :search)";
    $params[':search'] = "%$searchQuery%";
}

$stmt = $conn->prepare($query);
$stmt->execute($params);
$pwd_registrations = $stmt->fetchAll(PDO::FETCH_ASSOC);

// Include TCPDF
require_once '../vendor/tecnickcom/tcpdf/tcpdf.php';

// Create new PDF instance in landscape mode
$pdf = new TCPDF('L', 'mm', 'A4', true, 'UTF-8', false);
$pdf->SetCreator('PWD Registration System');
$pdf->SetAuthor($firstName . ' ' . $lastName);
$pdf->SetTitle('PWD List Report');
$pdf->SetSubject('Registered PWD List');

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
$pdf->Cell(0, 15, 'REGISTERED PWD LIST', 0, 1, 'C');
$pdf->Ln(2);

// Report information section
$pdf->SetFont('helvetica', '', 10);
$pdf->SetTextColor(44, 62, 80);
$pdf->Cell(0, 10, 'Printed By: ' . $firstName . ' ' . $lastName . ' (ID: ' . $staffId . ')', 0, 1, 'L');
$pdf->Cell(0, 10, 'Printed Date: ' . $printedDate, 0, 1, 'L');
$pdf->Ln(5);

// Table Headers
$pdf->SetFont('helvetica', 'B', 11);
$pdf->SetFillColor($headerBgColor[0], $headerBgColor[1], $headerBgColor[2]);
$pdf->SetTextColor($headerTextColor[0], $headerTextColor[1], $headerTextColor[2]);
$pdf->SetDrawColor($borderColor[0], $borderColor[1], $borderColor[2]);

$colWidths = [50, 60, 30, 55, 30, 50];

$pdf->Cell($colWidths[0], 10, 'Full Name', 1, 0, 'C', true);
$pdf->Cell($colWidths[1], 10, 'Address', 1, 0, 'C', true);
$pdf->Cell($colWidths[2], 10, 'Contact', 1, 0, 'C', true);
$pdf->Cell($colWidths[3], 10, 'Email', 1, 0, 'C', true);
$pdf->Cell($colWidths[4], 10, 'Birthdate', 1, 0, 'C', true);
$pdf->Cell($colWidths[5], 10, 'Disability Type', 1, 1, 'C', true);

$pdf->SetTextColor(44, 62, 80);
$pdf->SetFont('helvetica', '', 10);

$fill = false;

// Loop through records and add to table
foreach ($pwd_registrations as $pwd) {
    $pdf->SetFillColor($fill ? $alternateRowColor[0] : 255, $fill ? $alternateRowColor[1] : 255, $fill ? $alternateRowColor[2] : 255);
    
    $pdf->Cell($colWidths[0], 8, htmlspecialchars($pwd['full_name']), 1, 0, 'L', $fill);
    $pdf->Cell($colWidths[1], 8, htmlspecialchars($pwd['address']), 1, 0, 'L', $fill);
    $pdf->Cell($colWidths[2], 8, $pwd['contact_number'], 1, 0, 'C', $fill);
    $pdf->Cell($colWidths[3], 8, htmlspecialchars($pwd['email']), 1, 0, 'L', $fill);
    $pdf->Cell($colWidths[4], 8, $pwd['birthdate'], 1, 0, 'C', $fill);
    $pdf->Cell($colWidths[5], 8, htmlspecialchars($pwd['disability_type']), 1, 1, 'L', $fill);
    
    $fill = !$fill;
}

// Footer
$pdf->SetY(-15);
$pdf->SetFont('helvetica', 'I', 8);
$pdf->Cell(0, 10, 'Page ' . $pdf->getAliasNumPage() . ' of ' . $pdf->getAliasNbPages(), 0, 0, 'C');

// Output the PDF
ob_end_clean();
$pdf->Output('pwd_list_report.pdf', 'I');
?>
