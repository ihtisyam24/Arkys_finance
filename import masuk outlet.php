<?php
require 'function.php';
require 'vendor/autoload.php'; // Pastikan PhpSpreadsheet sudah diinstall via Composer

use PhpOffice\PhpSpreadsheet\IOFactory;

if (!isset($_SESSION['level'])) {
    header('Location: login.php');
    exit();
}

$message = '';
$error = '';

// Proses import jika form disubmit
if (isset($_POST['import'])) {
    if (isset($_FILES['excel_file']) && $_FILES['excel_file']['error'] == 0) {
        $file = $_FILES['excel_file']['tmp_name'];
        $fileName = $_FILES['excel_file']['name'];
        $fileExtension = pathinfo($fileName, PATHINFO_EXTENSION);

        // Validasi format file
        if (in_array($fileExtension, ['xlsx', 'xls', 'csv'])) {
            try {
                // Load file Excel
                $spreadsheet = IOFactory::load($file);
                $worksheet = $spreadsheet->getActiveSheet();
                $rows = $worksheet->toArray();

                $success_count = 0;
                $error_count = 0;
                $error_details = [];

                // Skip header row (mulai dari baris ke-2)
                for ($i = 1; $i < count($rows); $i++) {
                    $row = $rows[$i];

                    // Skip baris kosong
                    if (empty($row[0]) && empty($row[1]) && empty($row[2]) && empty($row[3])) {
                        continue;
                    }

                    $namabarang1 = trim($row[0]);
                    $transaksi = trim($row[1]);
                    $keterangan1 = trim($row[2]);
                    $qty1 = (int)$row[3];
                    $outletasal = trim($row[4]);
                    $outlet = trim($row[5]);

                    // Validasi data
                    if (empty($namabarang1) || empty($transaksi) || empty($keterangan1) || $qty1 <= 0 || empty($outletasal) || empty($outlet)) {
                        $error_count++;
                        $error_details[] = "Baris " . ($i + 1) . ": Data tidak lengkap atau qty tidak valid";
                        continue;
                    }

                    // Cari ID barang berdasarkan nama
                    $query_barang = mysqli_query($conn, "SELECT idbarang1 FROM stockoutlet WHERE namabarang1 = '$namabarang1'");

                    if (mysqli_num_rows($query_barang) > 0) {
                        $data_barang = mysqli_fetch_array($query_barang);
                        $idbarang1 = $data_barang['idbarang1'];

                        // Get idoutlet from session for logged-in user
                        $idoutlet = isset($_SESSION['idoutlet']) && !empty($_SESSION['idoutlet']) ? $_SESSION['idoutlet'] : 'NULL';

                        // Insert ke tabel masukoutlet
                        $insert_masuk = mysqli_query($conn, "INSERT INTO masukoutlet (idbarang1, transaksi, keterangan1, qty1, outletasal, outlet, idoutlet) VALUES ('$idbarang1', '$transaksi', '$keterangan1', '$qty1', '$outletasal', '$outlet', $idoutlet)");

                        if ($insert_masuk) {
                            // Update stok barang outlet
                            $update_stock = mysqli_query($conn, "UPDATE stockoutlet SET stock1 = stock1 + $qty1 WHERE idbarang1 = '$idbarang1'");

                            if ($update_stock) {
                                $success_count++;
                            } else {
                                $error_count++;
                                $error_details[] = "Baris " . ($i + 1) . ": Gagal update stok untuk $namabarang1";
                            }
                        } else {
                            $error_count++;
                            $error_details[] = "Baris " . ($i + 1) . ": Gagal insert data masuk untuk $namabarang1";
                        }
                    } else {
                        $error_count++;
                        $error_details[] = "Baris " . ($i + 1) . ": Barang '$namabarang1' tidak ditemukan dalam database";
                    }
                }

                // Set pesan hasil
                if ($success_count > 0) {
                    $message = "Berhasil import $success_count data barang masuk outlet.";
                }
                if ($error_count > 0) {
                    $error = "Gagal import $error_count data. Detail error: " . implode(", ", $error_details);
                }
            } catch (Exception $e) {
                $error = "Error membaca file: " . $e->getMessage();
            }
        } else {
            $error = "Format file tidak didukung. Gunakan file .xlsx, .xls, atau .csv";
        }
    } else {
        $error = "Pilih file untuk diimport";
    }
}

// Download template Excel
if (isset($_GET['download_template'])) {
    $spreadsheet = new \PhpOffice\PhpSpreadsheet\Spreadsheet();
    $sheet = $spreadsheet->getActiveSheet();

    // Set header
    $sheet->setCellValue('A1', 'Nama Barang');
    $sheet->setCellValue('B1', 'Kode Transaksi');
    $sheet->setCellValue('C1', 'Keterangan');
    $sheet->setCellValue('D1', 'Jumlah (Qty)');
    $sheet->setCellValue('E1', 'Outlet Asal');
    $sheet->setCellValue('F1', 'Outlet Tujuan');

    // Set contoh data
    $sheet->setCellValue('A2', 'Bimoli');
    $sheet->setCellValue('B2', 'TRX-001');
    $sheet->setCellValue('C2', 'Barang masuk dari supplier');
    $sheet->setCellValue('D2', '50');
    $sheet->setCellValue('E2', 'Gudang Pusat');
    $sheet->setCellValue('F2', 'Outlet A');

    $sheet->setCellValue('A3', 'Garam');
    $sheet->setCellValue('B3', 'TRX-002');
    $sheet->setCellValue('C3', 'Transfer antar outlet');
    $sheet->setCellValue('D3', '25');
    $sheet->setCellValue('E3', 'Outlet B');
    $sheet->setCellValue('F3', 'Outlet A');

    // Styling header
    $sheet->getStyle('A1:F1')->getFont()->setBold(true);
    $sheet->getStyle('A1:F1')->getFill()->setFillType(\PhpOffice\PhpSpreadsheet\Style\Fill::FILL_SOLID)->getStartColor()->setRGB('CCCCCC');

    // Auto size kolom
    foreach (range('A', 'F') as $col) {
        $sheet->getColumnDimension($col)->setAutoSize(true);
    }

    // Output file
    $writer = IOFactory::createWriter($spreadsheet, 'Xlsx');

    header('Content-Type: application/vnd.openxmlformats-officedocument.spreadsheetml.sheet');
    header('Content-Disposition: attachment;filename="template_import_masuk_outlet.xlsx"');
    header('Cache-Control: max-age=0');

    $writer->save('php://output');
    exit();
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no" />
    <title>Import Barang Masuk Outlet - STOK BARANG</title>
    <link href="img/logo.png" rel="icon">
    <link href="css/styles.css" rel="stylesheet" />
    <link href="https://cdn.datatables.net/1.10.20/css/dataTables.bootstrap4.min.css" rel="stylesheet" crossorigin="anonymous" />
    <script src="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.1/js/all.min.js" crossorigin="anonymous"></script>
</head>

<body class="sb-nav-fixed">
    <nav class="sb-topnav navbar navbar-expand navbar-dark bg-dark">
        <a class="navbar-brand" href="index.php">ARKYS SMASH CHICKEN</a>
        <button class="btn btn-link btn-sm order-1 order-lg-0" id="sidebarToggle" href="#"><i class="fas fa-bars"></i></button>
        <ul class="navbar-nav ml-auto ml-md-0">
            <li class="nav-item dropdown">
                <a class="nav-link dropdown-toggle" id="userDropdown" href="#" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false"><i class="fas fa-user fa-fw"></i></a>
                <div class="dropdown-menu dropdown-menu-right" aria-labelledby="userDropdown">
                    <div class="dropdown-divider"></div>
                    <a class="dropdown-item" href="logout.php">Logout</a>
                </div>
            </li>
        </ul>
    </nav>

    <div id="layoutSidenav">
        <div id="layoutSidenav_nav">
            <?php require 'menu.php'; ?>
        </div>
        <div id="layoutSidenav_content">
            <main>
                <div class="container-fluid">
                    <div class="mt-4 p-5 bg-info text-white rounded">
                        <h1>Import Barang Masuk Outlet</h1>
                        <p>Upload file Excel untuk import data barang masuk outlet secara batch</p>
                    </div>

                    <ol class="breadcrumb mb-4">
                        <li class="breadcrumb-item"><a href="index.php">Dashboard</a></li>
                        <li class="breadcrumb-item"><a href="masukoutlet.php">Barang Masuk Outlet</a></li>
                        <li class="breadcrumb-item active">Import</li>
                    </ol>

                    <?php if ($message): ?>
                        <div class="alert alert-success alert-dismissible fade show" role="alert">
                            <?= $message ?>
                            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                            </button>
                        </div>
                    <?php endif; ?>

                    <?php if ($error): ?>
                        <div class="alert alert-danger alert-dismissible fade show" role="alert">
                            <?= $error ?>
                            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                            </button>
                        </div>
                    <?php endif; ?>

                    <div class="row">
                        <div class="col-md-8">
                            <div class="card mb-4">
                                <div class="card-header">
                                    <i class="fas fa-upload mr-1"></i>
                                    Upload File Excel
                                </div>
                                <div class="card-body">
                                    <form method="post" enctype="multipart/form-data">
                                        <div class="form-group">
                                            <label for="excel_file">Pilih File Excel:</label>
                                            <input type="file" class="form-control-file" id="excel_file" name="excel_file" accept=".xlsx,.xls,.csv" required>
                                            <small class="form-text text-muted">Format yang didukung: .xlsx, .xls, .csv (Maksimal 5MB)</small>
                                        </div>
                                        <button type="submit" name="import" class="btn btn-primary">
                                            <i class="fas fa-upload"></i> Import Data
                                        </button>
                                        <a href="masukoutlet.php" class="btn btn-secondary">
                                            <i class="fas fa-arrow-left"></i> Kembali
                                        </a>
                                        <a href="?download_template=1" class="btn btn-success">
                                            <i class="fas fa-download"></i> Download Template
                                        </a>
                                    </form>
                                </div>
                            </div>
                        </div>

                        <div class="col-md-4">
                            <div class="card mb-4">
                                <div class="card-header">
                                    <i class="fas fa-info-circle mr-1"></i>
                                    Petunjuk Import
                                </div>
                                <div class="card-body">
                                    <h6>Format File Excel:</h6>
                                    <table class="table table-sm table-bordered">
                                        <thead>
                                            <tr>
                                                <th>Kolom</th>
                                                <th>Keterangan</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <tr>
                                                <td>A</td>
                                                <td>Nama Barang</td>
                                            </tr>
                                            <tr>
                                                <td>B</td>
                                                <td>Kode Transaksi</td>
                                            </tr>
                                            <tr>
                                                <td>C</td>
                                                <td>Keterangan</td>
                                            </tr>
                                            <tr>
                                                <td>D</td>
                                                <td>Jumlah (Qty)</td>
                                            </tr>
                                            <tr>
                                                <td>E</td>
                                                <td>Outlet Asal</td>
                                            </tr>
                                            <tr>
                                                <td>F</td>
                                                <td>Outlet Tujuan</td>
                                            </tr>
                                        </tbody>
                                    </table>

                                    <div class="alert alert-warning mt-3">
                                        <small>
                                            <strong>Perhatian:</strong><br>
                                            • Nama barang harus sesuai dengan yang ada di database stockoutlet<br>
                                            • Jumlah harus berupa angka positif<br>
                                            • Semua kolom wajib diisi<br>
                                            • Baris pertama akan diabaikan (header)
                                        </small>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- Preview Data Barang -->
                    <div class="card mb-4">
                        <div class="card-header">
                            <i class="fas fa-list mr-1"></i>
                            Data Barang Outlet yang Tersedia
                        </div>
                        <div class="card-body">
                            <div class="table-responsive">
                                <table class="table table-bordered table-sm" id="dataTable" width="100%" cellspacing="0">
                                    <thead>
                                        <tr>
                                            <th>ID</th>
                                            <th>Nama Barang</th>
                                            <th>Keterangan</th>
                                            <th>Stok Saat Ini</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <?php
                                        // Filter by outlet for Leader/Kapten and Kepala Gudang
                                        $whereClause = '';
                                        if (isset($_SESSION['level']) && ($_SESSION['level'] == 'Leader/Kapten' || $_SESSION['level'] == 'Kepala Gudang')) {
                                            if (isset($_SESSION['idoutlet']) && !empty($_SESSION['idoutlet'])) {
                                                $idoutlet = $_SESSION['idoutlet'];
                                                $whereClause = "where idoutlet='$idoutlet'";
                                            }
                                        }

                                        $query_stock = mysqli_query($conn, "SELECT * FROM stockoutlet " . $whereClause . " ORDER BY namabarang1");
                                        while ($data = mysqli_fetch_array($query_stock)) {
                                            echo "<tr>";
                                            echo "<td>" . $data['idbarang1'] . "</td>";
                                            echo "<td>" . $data['namabarang1'] . "</td>";
                                            echo "<td>" . $data['keterangan1'] . "</td>";
                                            echo "<td>" . $data['stock1'] . "</td>";
                                            echo "</tr>";
                                        }
                                        ?>
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>
            </main>

            <footer class="py-4 bg-light mt-auto">
                <div class="container-fluid">
                    <div class="d-flex align-items-center justify-content-between small">
                        <div class="text-muted">Copyright &copy; Muhammad Yusuf 2025</div>
                    </div>
                </div>
            </footer>
        </div>
    </div>

    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.5.3/dist/js/bootstrap.bundle.min.js" crossorigin="anonymous"></script>
    <script src="js/scripts.js"></script>
    <script src="https://cdn.datatables.net/1.10.20/js/jquery.dataTables.min.js" crossorigin="anonymous"></script>
    <script src="https://cdn.datatables.net/1.10.20/js/dataTables.bootstrap4.min.js" crossorigin="anonymous"></script>
    <script>
        $(document).ready(function() {
            $('#dataTable').DataTable();
        });
    </script>
</body>

</html>