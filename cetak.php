<?php

require_once __DIR__ . '/vendor/autoload.php';
require 'function.php';

$ambilsemuadatastock = mysqli_query($conn, "SELECT * FROM stock");

$html = '<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Stock Barang</title>
    <link rel="stylesheet" href="css/print.css">
</head>
<body>
    <h1>Stock Barang</h1>
    <table border="1" cellpadding="10" cellspacing="0">
        <tr>
            <th>No.</th>
            
            <th>Nama Barang</th>
            <th>Stock</th>
            <th>Kategori</th>
            <th>Keterangan</th>
            <th>Harga</th>
        </tr>';

$search = isset($_GET['search']) ? "WHERE namabarang LIKE '%" . $_GET['search'] . "%'" : '';
$ambilsemuadatastock = mysqli_query($conn, "SELECT * FROM stock " . $search);
$i = 1;
while ($data = mysqli_fetch_array($ambilsemuadatastock)) {
    $namabarang = $data['namabarang'];
    $stock = $data['stock'];
    $kategori = $data['kategori'];
    $keterangan = $data['keterangan'];
    $Harga = $data['Harga'];
    $idb = $data['idbarang'];
    
   
    $html .= '<tr>
        <td>' . $i++ . '</td>
        
        <td>' . $namabarang . '</td>
        <td>' . $stock . '</td>
        <td>' . $kategori . '</td>
        <td>' . $keterangan . '</td>
        <td>' . $Harga . '</td>        
    </tr>';
}

$html .= '</table>
    </body>
    </html>';

$mpdf = new \Mpdf\Mpdf();
$mpdf->WriteHTML($html);
$mpdf->Output("Daftar-mahasiswa.pdf", 'I');
?>
