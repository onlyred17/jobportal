<?php
session_start();
include '../include/db_conn.php';
require '../vendor/autoload.php';

use PhpOffice\PhpSpreadsheet\Spreadsheet;
use PhpOffice\PhpSpreadsheet\Writer\Xlsx;
use PhpOffice\PhpSpreadsheet\Style\NumberFormat;

try {
    // Fetch all PWD registrations from the pwd_registration table
    $stmt = $conn->prepare("SELECT full_name, birthdate, disability_type, address, contact_number, email, application_id, created_at FROM pwd_registration");
    $stmt->execute();
    $pwdRegistrations = $stmt->fetchAll(PDO::FETCH_ASSOC);

    // Create a new Spreadsheet object
    $spreadsheet = new Spreadsheet();
    $sheet = $spreadsheet->getActiveSheet();

    // Set the header row
    $sheet->setCellValue('A1', 'Full Name');
    $sheet->setCellValue('B1', 'Birthdate');
    $sheet->setCellValue('C1', 'Disability Type');
    $sheet->setCellValue('D1', 'Address');
    $sheet->setCellValue('E1', 'Contact Number');
    $sheet->setCellValue('F1', 'Email');
    $sheet->setCellValue('G1', 'Application ID');
    $sheet->setCellValue('H1', 'Registration Date');


    // Populate the data rows
    $row = 2; // Start from the second row
    foreach ($pwdRegistrations as $registration) {
        $sheet->setCellValue('A' . $row, $registration['full_name']);
        $sheet->setCellValue('B' . $row, $registration['birthdate']);
        $sheet->setCellValue('C' . $row, $registration['disability_type']);
        $sheet->setCellValue('D' . $row, $registration['address']);
        $sheet->setCellValue('E' . $row, $registration['contact_number']);
        $sheet->setCellValue('F' . $row, $registration['email']);
        $sheet->setCellValue('G' . $row, $registration['application_id']);
        $sheet->setCellValue('H' . $row, $registration['created_at']);

        $row++;
    }

    // Set column widths
    foreach (range('A', 'H') as $column) {
        $sheet->getColumnDimension($column)->setAutoSize(true);
    }

    // Create the writer and output the file
    $writer = new Xlsx($spreadsheet);
    $fileName = 'PWD_Registration_Report.xlsx';
    header('Content-Type: application/vnd.openxmlformats-officedocument.spreadsheetml.sheet');
    header('Content-Disposition: attachment;filename="' . $fileName . '"');
    header('Cache-Control: max-age=0');
    $writer->save('php://output');
    exit;

} catch (PDOException $e) {
    die("Database error: " . $e->getMessage());
}
?>
