<?php
require 'function.php';
require 'vendor/autoload.php';

use PhpOffice\PhpSpreadsheet\Spreadsheet;
use PhpOffice\PhpSpreadsheet\Writer\Xlsx;
use PhpOffice\PhpSpreadsheet\Style\Alignment;
use PhpOffice\PhpSpreadsheet\Style\Border;
use PhpOffice\PhpSpreadsheet\Style\Fill;

if (!isset($_SESSION['level'])) {
    header('Location: login.php');
    exit();
}

// Buat spreadsheet baru
$spreadsheet = new Spreadsheet();
$sheet = $spreadsheet->getActiveSheet();

// Set judul sheet
$sheet->setTitle('Template Barang Masuk');

// Header
$headers = ['Nama Barang', 'Keterangan', 'Jumlah (Qty)', 'Penerima'];
$sheet->fromArray($headers, null, 'A1');

// Style untuk header
$headerStyle = [
    'font' => [
        'bold' => true,
        'color' => ['rgb' => 'FFFFFF']
    ],
    'fill' => [
        'fillType' => Fill::FILL_SOLID,
        'startColor' => ['rgb' => '4472C4']
    ],
    'alignment' => [
        'horizontal' => Alignment::HORIZONTAL_CENTER,
        'vertical' => Alignment::VERTICAL_CENTER
    ],
    'borders' => [
        'allBorders' => [
            'borderStyle' => Border::BORDER_THIN
        ]
    ]
];

$sheet->getStyle('A1:D1')->applyFromArray($headerStyle);

// Set lebar kolom
$sheet->getColumnDimension('A')->setWidth(20);
$sheet->getColumnDimension('B')->setWidth(25);
$sheet->getColumnDimension('C')->setWidth(15);
$sheet->getColumnDimension('D')->setWidth(20);

// Contoh data
$exampleData = [
    ['Bimoli', 'Minyak goreng 1L', 10, 'Bagian Gudang Budi'],
    ['Indomie', 'Mie instant ayam bawang', 50, 'Bagian Gudang Tata'],
    ['Daia', 'Deterjen bubuk 1kg', 20, 'Bagian Gudang Budi']
];

$sheet->fromArray($exampleData, null, 'A2');

// Style untuk data contoh
$dataStyle = [
    'borders' => [
        'allBorders' => [
            'borderStyle' => Border::BORDER_THIN
        ]
    ],
    'alignment' => [
        'vertical' => Alignment::VERTICAL_CENTER
    ]
];

$sheet->getStyle('A2:D4')->applyFromArray($dataStyle);

// Tambah sheet kedua untuk daftar barang yang tersedia
$sheet2 = $spreadsheet->createSheet();
$sheet2->setTitle('Daftar Barang Tersedia');

// Header untuk sheet kedua
$headers2 = ['ID Barang', 'Nama Barang', 'Keterangan', 'Stok Saat Ini'];
$sheet2->fromArray($headers2, null, 'A1');
$sheet2->getStyle('A1:D1')->applyFromArray($headerStyle);

// Ambil data barang dari database
$query_stock = mysqli_query($conn, "SELECT * FROM stock ORDER BY namabarang");
$row = 2;
while ($data = mysqli_fetch_array($query_stock)) {
    $sheet2->setCellValue('A' . $row, $data['idbarang']);
    $sheet2->setCellValue('B' . $row, $data['namabarang']);
    $sheet2->setCellValue('C' . $row, $data['keterangan']);
    $sheet2->setCellValue('D' . $row, $data['stock']);
    $row++;
}

// Set lebar kolom untuk sheet kedua
$sheet2->getColumnDimension('A')->setWidth(12);
$sheet2->getColumnDimension('B')->setWidth(25);
$sheet2->getColumnDimension('C')->setWidth(30);
$sheet2->getColumnDimension('D')->setWidth(15);

// Style untuk data sheet kedua
if ($row > 2) {
    $sheet2->getStyle('A2:D' . ($row - 1))->applyFromArray($dataStyle);
}

// Kembali ke sheet pertama
$spreadsheet->setActiveSheetIndex(0);

// Set properties dokumen
$spreadsheet->getProperties()
    ->setCreator("ARKYS SMASH CHICKEN")
    ->setLastModifiedBy("ARKYS SMASH CHICKEN")
    ->setTitle("Template Import Barang Masuk")
    ->setSubject("Template Import")
    ->setDescription("Template untuk import data barang masuk")
    ->setKeywords("template import barang masuk")
    ->setCategory("Template");

// Output file
$filename = 'Template_Import_Barang_Masuk_' . date('Y-m-d') . '.xlsx';

header('Content-Type: application/vnd.openxmlformats-officedocument.spreadsheetml.sheet');
header('Content-Disposition: attachment;filename="' . $filename . '"');
header('Cache-Control: max-age=0');

$writer = new Xlsx($spreadsheet);
$writer->save('php://output');
exit;
?>