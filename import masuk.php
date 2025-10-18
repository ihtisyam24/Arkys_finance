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

                    $namabarang = trim($row[0]);
                    $keterangan = trim($row[1]);
                    $qty = (int)$row[2];
                    $penerima = trim($row[3]);

                    // Validasi data
                    if (empty($namabarang) || empty($keterangan) || $qty <= 0 || empty($penerima)) {
                        $error_count++;
                        $error_details[] = "Baris " . ($i + 1) . ": Data tidak lengkap atau qty tidak valid";
                        continue;
                    }

                    // Cari ID barang berdasarkan nama
                    $query_barang = mysqli_query($conn, "SELECT idbarang FROM stock WHERE namabarang = '$namabarang'");

                    if (mysqli_num_rows($query_barang) > 0) {
                        $data_barang = mysqli_fetch_array($query_barang);
                        $idbarang = $data_barang['idbarang'];

                        // Get idoutlet from session for logged-in user
                        $idoutlet = isset($_SESSION['idoutlet']) && !empty($_SESSION['idoutlet']) ? $_SESSION['idoutlet'] : 'NULL';

                        // Insert ke tabel masuk
                        $insert_masuk = mysqli_query($conn, "INSERT INTO masuk (idbarang, keterangan, qty, penerima, idoutlet) VALUES ('$idbarang', '$keterangan', '$qty', '$penerima', $idoutlet)");

                        if ($insert_masuk) {
                            // Update stok barang
                            $update_stock = mysqli_query($conn, "UPDATE stock SET stock = stock + $qty WHERE idbarang = '$idbarang'");

                            if ($update_stock) {
                                $success_count++;
                            } else {
                                $error_count++;
                                $error_details[] = "Baris " . ($i + 1) . ": Gagal update stok untuk $namabarang";
                            }
                        } else {
                            $error_count++;
                            $error_details[] = "Baris " . ($i + 1) . ": Gagal insert data masuk untuk $namabarang";
                        }
                    } else {
                        $error_count++;
                        $error_details[] = "Baris " . ($i + 1) . ": Barang '$namabarang' tidak ditemukan dalam database";
                    }
                }

                // Set pesan hasil
                if ($success_count > 0) {
                    $message = "Berhasil import $success_count data barang masuk.";
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
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no" />
    <title>Import Barang Masuk - STOK BARANG</title>
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
                        <h1>Import Barang Masuk</h1>
                        <p>Upload file Excel untuk import data barang masuk secara batch</p>
                    </div>

                    <ol class="breadcrumb mb-4">
                        <li class="breadcrumb-item"><a href="index.php">Dashboard</a></li>
                        <li class="breadcrumb-item"><a href="masuk.php">Barang Masuk</a></li>
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
                                        <a href="masuk.php" class="btn btn-secondary">
                                            <i class="fas fa-arrow-left"></i> Kembali
                                        </a>
                                        <a href="download_template_masuk.php" class="btn btn-success">
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
                                                <td>Keterangan</td>
                                            </tr>
                                            <tr>
                                                <td>C</td>
                                                <td>Jumlah (Qty)</td>
                                            </tr>
                                            <tr>
                                                <td>D</td>
                                                <td>Penerima</td>
                                            </tr>
                                        </tbody>
                                    </table>

                                    <div class="alert alert-warning mt-3">
                                        <small>
                                            <strong>Perhatian:</strong><br>
                                            • Nama barang harus sesuai dengan yang ada di database<br>
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
                            Data Barang yang Tersedia
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
                                        $query_stock = mysqli_query($conn, "SELECT * FROM stock ORDER BY namabarang");
                                        while ($data = mysqli_fetch_array($query_stock)) {
                                            echo "<tr>";
                                            echo "<td>" . $data['idbarang'] . "</td>";
                                            echo "<td>" . $data['namabarang'] . "</td>";
                                            echo "<td>" . $data['keterangan'] . "</td>";
                                            echo "<td>" . $data['stock'] . "</td>";
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