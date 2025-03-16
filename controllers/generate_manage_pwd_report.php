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
$query = "SELECT id, full_name, address, contact_number, email, birthdate, disability_type 
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

// Create new PDF instance
$pdf = new TCPDF();
$pdf->SetTitle('PWD List Report');
$pdf->AddPage();

// Set header
$pdf->SetFont('helvetica', 'B', 16);
$pdf->Cell(0, 10, 'Registered PWD List', 0, 1, 'C');
$pdf->Ln(10);

// Printed By Details
$pdf->SetFont('helvetica', '', 12);
$pdf->Cell(0, 10, "Printed By: $firstName $lastName", 0, 1, 'L');
$pdf->Cell(0, 10, "Printed Date: $printedDate", 0, 1, 'L');
$pdf->Ln(5);
$pdf->Cell(0, 10, 'Search Term: ' . ($searchQuery ? $searchQuery : 'None'), 0, 1, 'L');
$pdf->Ln(10);

// Table Header Styling
$pdf->SetFont('helvetica', 'B', 11);
$pdf->SetFillColor(200, 200, 200);

// Adjusted column widths
$widths = [
    40, // Full Name
    45, // Address (Wider for wrapping)
    25, // Contact
    40, // Email
    20, // Birthdate
    30  // Disability Type
];

$headers = ['Full Name', 'Address', 'Contact', 'Email', 'Birthdate', 'Disability Type'];

// Print table headers
foreach ($headers as $i => $header) {
    $pdf->Cell($widths[$i], 8, $header, 1, 0, 'C', true);
}
$pdf->Ln();

// Populate table rows
$pdf->SetFont('helvetica', '', 10);

foreach ($pwd_registrations as $pwd) {
    $rowHeight = 8; // Default row height

    // Get max number of lines in a row (to ensure proper height)
    $maxLines = max(
        $pdf->getNumLines($pwd['full_name'], $widths[0]),
        $pdf->getNumLines($pwd['address'], $widths[1]),
        $pdf->getNumLines($pwd['email'], $widths[3]),
        $pdf->getNumLines($pwd['disability_type'], $widths[5])
    );

    $rowHeight = $maxLines * 6; // Multiply by line height for consistent row spacing

    // Print each cell
    $pdf->MultiCell($widths[0], $rowHeight, $pwd['full_name'], 1, 'L', false, 0);
    $pdf->MultiCell($widths[1], $rowHeight, $pwd['address'], 1, 'L', false, 0);
    $pdf->Cell($widths[2], $rowHeight, $pwd['contact_number'], 1, 0, 'C');
    $pdf->MultiCell($widths[3], $rowHeight, $pwd['email'], 1, 'L', false, 0);
    $pdf->Cell($widths[4], $rowHeight, $pwd['birthdate'], 1, 0, 'C');
    $pdf->MultiCell($widths[5], $rowHeight, $pwd['disability_type'], 1, 'L', false, 1);
}

// Clear output buffer before sending PDF
ob_end_clean();

// Output PDF
$pdf->Output('pwd_registration_report.pdf', 'I');

?>
