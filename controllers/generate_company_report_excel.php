<?php
session_start();
include '../include/db_conn.php';
require '../vendor/autoload.php';

use PhpOffice\PhpSpreadsheet\Spreadsheet;
use PhpOffice\PhpSpreadsheet\Writer\Xlsx;
use PhpOffice\PhpSpreadsheet\Style\NumberFormat;

try {
    // Fetch all companies from the company table
    $stmt = $conn->prepare("SELECT name, location, description FROM company");
    $stmt->execute();
    $companies = $stmt->fetchAll(PDO::FETCH_ASSOC);

    // Create a new Spreadsheet object
    $spreadsheet = new Spreadsheet();
    $sheet = $spreadsheet->getActiveSheet();

    // Set the header row
    $sheet->setCellValue('A1', 'Company Name');
    $sheet->setCellValue('B1', 'Location');
    $sheet->setCellValue('C1', 'Description');

    // Populate the data rows
    $row = 2; // Start from the second row
    foreach ($companies as $company) {
        $sheet->setCellValue('A' . $row, $company['name']);
        $sheet->setCellValue('B' . $row, $company['location']);
        $sheet->setCellValue('C' . $row, $company['description']);
        $row++;
    }

    // Set column widths
    foreach (range('A', 'C') as $column) {
        $sheet->getColumnDimension($column)->setAutoSize(true);
    }

    // Create the writer and output the file
    $writer = new Xlsx($spreadsheet);
    $fileName = 'Company_Report.xlsx';
    header('Content-Type: application/vnd.openxmlformats-officedocument.spreadsheetml.sheet');
    header('Content-Disposition: attachment;filename="' . $fileName . '"');
    header('Cache-Control: max-age=0');
    $writer->save('php://output');
    exit;

} catch (PDOException $e) {
    die("Database error: " . $e->getMessage());
}
?>
