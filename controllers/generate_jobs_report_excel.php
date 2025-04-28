<?php
session_start();
include '../include/db_conn.php';
require '../vendor/autoload.php';

use PhpOffice\PhpSpreadsheet\Spreadsheet;
use PhpOffice\PhpSpreadsheet\Writer\Xlsx;
use PhpOffice\PhpSpreadsheet\Style\NumberFormat;

try {
    // Fetch all job postings from the database
    $stmt = $conn->prepare("SELECT * FROM jobs");
    $stmt->execute();
    $jobs = $stmt->fetchAll(PDO::FETCH_ASSOC);

    // Create a new Spreadsheet object
    $spreadsheet = new Spreadsheet();
    $sheet = $spreadsheet->getActiveSheet();

    // Set the header row
    $sheet->setCellValue('A1', 'Job Title');
    $sheet->setCellValue('B1', 'Company Name');
    $sheet->setCellValue('C1', 'Location');
    $sheet->setCellValue('D1', 'Job Type');
    $sheet->setCellValue('E1', 'Salary');
    $sheet->setCellValue('F1', 'Requirements');
    $sheet->setCellValue('G1', 'Status');
    $sheet->setCellValue('H1', 'Posted Date');

    // Populate the data rows
    $row = 2; // Start from the second row
    foreach ($jobs as $job) {
        $sheet->setCellValue('A' . $row, $job['title']);
        $sheet->setCellValue('B' . $row, $job['company_name']);
        $sheet->setCellValue('C' . $row, $job['location']);
        $sheet->setCellValue('D' . $row, $job['job_type']);
        $sheet->setCellValue('E' . $row, $job['salary']);
        $sheet->setCellValue('F' . $row, $job['requirements']);
        $sheet->setCellValue('G' . $row, $job['status']);
        $sheet->setCellValue('H' . $row, $job['posted_date']);
        $row++;
    }

    // Set column widths
    foreach (range('A', 'H') as $column) {
        $sheet->getColumnDimension($column)->setAutoSize(true);
    }

    // Create the writer and output the file
    $writer = new Xlsx($spreadsheet);
    $fileName = 'Job_Postings_Report.xlsx';
    header('Content-Type: application/vnd.openxmlformats-officedocument.spreadsheetml.sheet');
    header('Content-Disposition: attachment;filename="' . $fileName . '"');
    header('Cache-Control: max-age=0');
    $writer->save('php://output');
    exit;

} catch (PDOException $e) {
    die("Database error: " . $e->getMessage());
}
?>
