<?php
require 'vendor/autoload.php'; // Include PhpSpreadsheet autoload file
use PhpOffice\PhpSpreadsheet\Spreadsheet;
use PhpOffice\PhpSpreadsheet\Writer\Xlsx;




// Create a new Spreadsheet object
$spreadsheet = new Spreadsheet();

// Set the active sheet
$sheet = $spreadsheet->getActiveSheet();

// Set the column headers
$headers = [
    'SODIENTHOAI',
    'LOAIVE',
    'KETQUAQUAY',
    'THOIGIANQUAY',
    'tenkhachhang',
];
foreach ($headers as $index => $header) {
    $sheet->setCellValueByColumnAndRow($index + 1, 1, $header);
}

// $servername = "localhost";
// $username = "hdad8728ce_data";
// $password = "admin1234";
// $dbname = "hdad8728ce_data";

$servername = "localhost";
$username = "root";
$password = "";
$dbname = "hdad8728ce_data";

// Query the database and fetch the data
$conn = mysqli_connect($servername , $username, $password, $dbname);
if (!$conn) {
    die("Connection failed: " . mysqli_connect_error());
}

$sql = "SELECT SODIENTHOAI, LOAIVE, KETQUAQUAY, THOIGIANQUAY, tenkhachhang FROM ketqua";
$result = mysqli_query($conn, $sql);

// Add data to the sheet
$rowNumber = 2;
while ($row = mysqli_fetch_assoc($result)) {
    $sheet->setCellValueByColumnAndRow(1, $rowNumber, $row['SODIENTHOAI']);
    $sheet->setCellValueByColumnAndRow(2, $rowNumber, $row['LOAIVE']);
    $sheet->setCellValueByColumnAndRow(3, $rowNumber, $row['KETQUAQUAY']);
    $sheet->setCellValueByColumnAndRow(4, $rowNumber, $row['THOIGIANQUAY']);
    $sheet->setCellValueByColumnAndRow(5, $rowNumber, $row['tenkhachhang']);
    $rowNumber++;
}

// Set the file name and headers
$filename = 'ketqua.xlsx';
header('Content-Type: application/vnd.openxmlformats-officedocument.spreadsheetml.sheet');
header('Content-Disposition: attachment; filename="' . $filename . '"');
header('Cache-Control: max-age=0');

// Create the Xlsx writer and save the file to the output
$writer = new Xlsx($spreadsheet);
$writer->save('php://output');
exit();