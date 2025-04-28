<?php
session_start();
include '../include/db_conn.php';
require '../vendor/autoload.php';

use PhpOffice\PhpSpreadsheet\Spreadsheet;
use PhpOffice\PhpSpreadsheet\Writer\Xlsx;
use PhpOffice\PhpSpreadsheet\Style\NumberFormat;

try {
    // Fetch all PWD registrations from the registered_pwd table
    $stmt = $conn->prepare("SELECT full_name, address, contact_number, email, birthdate, disability_type FROM registered_pwd");
    $stmt->execute();
    $pwdRegistrations = $stmt->fetchAll(PDO::FETCH_ASSOC);

    // Create a new Spreadsheet object
    $spreadsheet = new Spreadsheet();
    $sheet = $spreadsheet->getActiveSheet();

    // Set the header row
    $sheet->setCellValue('A1', 'Full Name');
    $sheet->setCellValue('B1', 'Address');
    $sheet->setCellValue('C1', 'Contact Number');
    $sheet->setCellValue('D1', 'Email');
    $sheet->setCellValue('E1', 'Birthdate');
    $sheet->setCellValue('F1', 'Disability Type');

    // Populate the data rows
    $row = 2; // Start from the second row
    foreach ($pwdRegistrations as $registration) {
        $sheet->setCellValue('A' . $row, $registration['full_name']);
        $sheet->setCellValue('B' . $row, $registration['address']);
        $sheet->setCellValue('C' . $row, $registration['contact_number']);
        $sheet->setCellValue('D' . $row, $registration['email']);
        $sheet->setCellValue('E' . $row, $registration['birthdate']);
        $sheet->setCellValue('F' . $row, $registration['disability_type']);
        $row++;
    }

    // Set column widths
    foreach (range('A', 'F') as $column) {
        $sheet->getColumnDimension($column)->setAutoSize(true);
    }

    // Create the writer and output the file
    $writer = new Xlsx($spreadsheet);
    $fileName = 'Registered_PWD_Report.xlsx';
    header('Content-Type: application/vnd.openxmlformats-officedocument.spreadsheetml.sheet');
    header('Content-Disposition: attachment;filename="' . $fileName . '"');
    header('Cache-Control: max-age=0');
    $writer->save('php://output');
    exit;

} catch (PDOException $e) {
    die("Database error: " . $e->getMessage());
}
?>
