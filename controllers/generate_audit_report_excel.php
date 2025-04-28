<?php
session_start();
include '../include/db_conn.php';
require '../vendor/autoload.php';

use PhpOffice\PhpSpreadsheet\Spreadsheet;
use PhpOffice\PhpSpreadsheet\Writer\Xlsx;
use PhpOffice\PhpSpreadsheet\Style\NumberFormat;

try {
    // Fetch all records from the audit_log table
    $stmt = $conn->prepare("SELECT user_id, full_name, action, description, created_at, usertype FROM audit_log");
    $stmt->execute();
    $auditLogs = $stmt->fetchAll(PDO::FETCH_ASSOC);

    // Create a new Spreadsheet object
    $spreadsheet = new Spreadsheet();
    $sheet = $spreadsheet->getActiveSheet();

    // Set the header row
    $sheet->setCellValue('A1', 'User ID');
    $sheet->setCellValue('B1', 'Full Name');
    $sheet->setCellValue('C1', 'Action');
    $sheet->setCellValue('D1', 'Description');
    $sheet->setCellValue('E1', 'Date');
    $sheet->setCellValue('F1', 'User Type');

    // Format the headers to be bold
    $sheet->getStyle('A1:F1')->getFont()->setBold(true);

    // Populate the data rows
    $row = 2; // Start from the second row
    foreach ($auditLogs as $log) {
        $sheet->setCellValue('A' . $row, $log['user_id']);
        $sheet->setCellValue('B' . $row, $log['full_name']);
        $sheet->setCellValue('C' . $row, $log['action']);
        $sheet->setCellValue('D' . $row, $log['description']);
        
        // Format the date to a readable format (e.g., 'Y-m-d H:i:s')
        $sheet->setCellValue('E' . $row, \PhpOffice\PhpSpreadsheet\Shared\Date::PHPToExcel(new DateTime($log['created_at'])));
        $sheet->getStyle('E' . $row)->getNumberFormat()->setFormatCode('yyyy-mm-dd hh:mm:ss');
        
        $sheet->setCellValue('F' . $row, $log['usertype']);
        $row++;
    }

    // Set column widths
    foreach (range('A', 'F') as $column) {
        $sheet->getColumnDimension($column)->setAutoSize(true);
    }

    // Create the writer and output the file
    $writer = new Xlsx($spreadsheet);
    $fileName = 'Audit_Log_Report.xlsx';
    header('Content-Type: application/vnd.openxmlformats-officedocument.spreadsheetml.sheet');
    header('Content-Disposition: attachment;filename="' . $fileName . '"');
    header('Cache-Control: max-age=0');
    $writer->save('php://output');
    exit;

} catch (PDOException $e) {
    die("Database error: " . $e->getMessage());
}
?>
