<?php
require_once '../vendor/autoload.php'; // Load Composer's autoloader
require_once '../include/db_conn.php'; // Include your database connection

// Retrieve search term from GET request
$searchQuery = $_GET['search'] ?? '';

// Fetch the logged-in user's information (assuming session or authentication is used)
session_start();
$staffId = $_SESSION['staff_id'] ?? 'Unknown';
$firstName = $_SESSION['first_name'] ?? 'Unknown';
$lastName = $_SESSION['last_name'] ?? '';

// Get the current date and time
$printedDate = date("Y-m-d H:i:s");

// Fetch filtered data from the database using PDO
$query = "SELECT * FROM company WHERE 1=1";
$params = [];

if (!empty($searchQuery)) {
    $query .= " AND (name LIKE :search OR location LIKE :search OR description LIKE :search)";
    $params[':search'] = "%$searchQuery%";
}

$stmt = $conn->prepare($query);
$stmt->execute($params);
$companies = $stmt->fetchAll(PDO::FETCH_ASSOC);

// Include TCPDF
require_once '../vendor/tecnickcom/tcpdf/tcpdf.php';

// Create new PDF instance
$pdf = new TCPDF();
$pdf->SetTitle('Company List Report');
$pdf->AddPage();

// Set header
$pdf->SetFont('helvetica', 'B', 16);
$pdf->Cell(0, 10, 'Company List Report', 0, 1, 'C');
$pdf->Ln(5);

// Printed By Details
$pdf->SetFont('helvetica', '', 12);
$pdf->Cell(0, 10, "Printed By: $firstName $lastName (ID: $staffId)", 0, 1, 'L');
$pdf->Cell(0, 10, "Printed Date: $printedDate", 0, 1, 'L');
$pdf->Ln(5);

// Search Filter
$pdf->Cell(0, 10, 'Search Term: ' . ($searchQuery ? $searchQuery : 'None'), 0, 1, 'L');
$pdf->Ln(5);

// Table Header Styling
$pdf->SetFont('helvetica', 'B', 12);
$pdf->SetFillColor(220, 220, 220); // Light gray background for header
$colWidths = [50, 40, 90]; // Adjusted column widths for better layout

$pdf->Cell($colWidths[0], 10, 'Company Name', 1, 0, 'C', true);
$pdf->Cell($colWidths[1], 10, 'Location', 1, 0, 'C', true);
$pdf->Cell($colWidths[2], 10, 'Description', 1, 1, 'C', true);

$pdf->SetFont('helvetica', '', 11);

// Populate table rows with alternating row colors
$fill = false;
foreach ($companies as $company) {
    $pdf->SetFillColor(240, 240, 240); // Light gray for alternate rows
    
    // Get the max row height based on the description
    $descriptionHeight = $pdf->getStringHeight($colWidths[2], $company['description']);
    $rowHeight = max(10, $descriptionHeight); // Ensure minimum height of 10
    
    $x = $pdf->GetX();
    $y = $pdf->GetY();

    // Print Name and Location normally
    $pdf->Cell($colWidths[0], $rowHeight, $company['name'], 1, 0, 'C', $fill);
    $pdf->Cell($colWidths[1], $rowHeight, $company['location'], 1, 0, 'C', $fill);

    // Print Description with MultiCell and manually adjust position
    $pdf->SetXY($x + $colWidths[0] + $colWidths[1], $y); // Move to description column position
    $pdf->MultiCell($colWidths[2], $rowHeight, $company['description'], 1, 'L', $fill);
    
    // Reset cursor to the correct position for the next row
    $pdf->SetXY($x, $y + $rowHeight);
    
    // Toggle row color
    $fill = !$fill;
}

// Clear output buffer before sending PDF
ob_end_clean();

// Output PDF
$pdf->Output('company_list_report.pdf', 'I');
?>
