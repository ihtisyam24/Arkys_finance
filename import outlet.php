<?php
require 'function.php';

// Cek apakah user sudah login
if (!isset($_SESSION['level'])) {
    header('Location: login.php');
    exit();
}

// Library untuk membaca Excel
require_once 'vendor/autoload.php'; // Pastikan sudah install PhpSpreadsheet via Composer

use PhpOffice\PhpSpreadsheet\IOFactory;

$message = '';
$error = '';

// Proses import Excel
if (isset($_POST['import'])) {
    $targetDir = "uploads/";
    $fileName = basename($_FILES["excel_file"]["name"]);
    $targetFilePath = $targetDir . $fileName;
    $fileType = pathinfo($targetFilePath, PATHINFO_EXTENSION);

    // Validasi file Excel
    if (in_array($fileType, ['xls', 'xlsx'])) {
        // Upload file
        if (move_uploaded_file($_FILES["excel_file"]["tmp_name"], $targetFilePath)) {
            try {
                // Load file Excel
                $spreadsheet = IOFactory::load($targetFilePath);
                $worksheet = $spreadsheet->getActiveSheet();
                $rows = $worksheet->toArray();

                $successCount = 0;
                $errorCount = 0;
                $errorMessages = [];

                // Loop mulai dari baris ke-2 (skip header)
                for ($i = 1; $i < count($rows); $i++) {
                    $row = $rows[$i];

                    // Validasi data tidak kosong
                    if (!empty($row[0]) && !empty($row[1]) && !empty($row[2])) {
                        $namabarang1 = mysqli_real_escape_string($conn, $row[0]);
                        $keterangan1 = mysqli_real_escape_string($conn, $row[1]);
                        $stock1 = (int)$row[2];
                        $kategori1 = mysqli_real_escape_string($conn, $row[3]);
                        $Harga1 = !empty($row[4]) ? (int)$row[4] : 0;
                        $idoutlet = !empty($row[5]) ? (int)$row[5] : (isset($_SESSION['idoutlet']) && !empty($_SESSION['idoutlet']) ? $_SESSION['idoutlet'] : 'NULL');
                        $stockfisik1 = !empty($row[6]) ? (int)$row[6] : 0;
                        $stocksisa1 = !empty($row[7]) ? (int)$row[7] : 0;

                        // Validasi stock minimal 0
                        if ($stock1 < 0) {
                            $errorMessages[] = "Baris " . ($i + 1) . ": Stock tidak boleh negatif";
                            $errorCount++;
                            continue;
                        }

                        // Cek apakah barang sudah ada
                        $checkQuery = "SELECT * FROM stockoutlet WHERE namabarang1 = '$namabarang1'";
                        $checkResult = mysqli_query($conn, $checkQuery);

                        if (mysqli_num_rows($checkResult) > 0) {
                            // Update stock jika barang sudah ada
                            $updateQuery = "UPDATE stockoutlet SET stock1 = stock1 + $stock1, keterangan1 = '$keterangan1', kategori1 = '$kategori1', Harga1 = $Harga1, idoutlet = $idoutlet, stockfisik1 = $stockfisik1, stocksisa1 = $stocksisa1 WHERE namabarang1 = '$namabarang1'";

                            if (mysqli_query($conn, $updateQuery)) {
                                $successCount++;
                            } else {
                                $errorMessages[] = "Baris " . ($i + 1) . ": Gagal update - " . mysqli_error($conn);
                                $errorCount++;
                            }
                        } else {
                            // Insert barang baru
                            $insertQuery = "INSERT INTO stockoutlet (namabarang1, keterangan1, stock1, kategori1, Harga1, idoutlet, stockfisik1, stocksisa1) VALUES ('$namabarang1', '$keterangan1', $stock1, '$kategori1', $Harga1, $idoutlet, $stockfisik1, $stocksisa1)";

                            if (mysqli_query($conn, $insertQuery)) {
                                $successCount++;
                            } else {
                                $errorMessages[] = "Baris " . ($i + 1) . ": Gagal insert - " . mysqli_error($conn);
                                $errorCount++;
                            }
                        }
                    } else {
                        $errorMessages[] = "Baris " . ($i + 1) . ": Data tidak lengkap (Nama Barang, Keterangan, dan Stock wajib diisi)";
                        $errorCount++;
                    }
                }

                // Hapus file setelah diproses
                unlink($targetFilePath);

                // Set pesan hasil
                if ($successCount > 0) {
                    $message = "Import berhasil! $successCount data berhasil diproses.";
                }
                if ($errorCount > 0) {
                    $error = "Terdapat $errorCount error:\n" . implode("\n", $errorMessages);
                }
            } catch (Exception $e) {
                $error = "Error membaca file Excel: " . $e->getMessage();
                unlink($targetFilePath);
            }
        } else {
            $error = "Error upload file.";
        }
    } else {
        $error = "Hanya file Excel (.xls atau .xlsx) yang diperbolehkan.";
    }
}

// Download template Excel
if (isset($_GET['download_template'])) {
    // Buat file template Excel
    $spreadsheet = new \PhpOffice\PhpSpreadsheet\Spreadsheet();
    $sheet = $spreadsheet->getActiveSheet();

    // Set header
    $sheet->setCellValue('A1', 'Nama Barang');
    $sheet->setCellValue('B1', 'Keterangan');
    $sheet->setCellValue('C1', 'Stock');
    $sheet->setCellValue('D1', 'Kategori');
    $sheet->setCellValue('E1', 'Harga');
    $sheet->setCellValue('F1', 'ID Outlet');
    $sheet->setCellValue('G1', 'Stock Fisik');
    $sheet->setCellValue('H1', 'Stock Sisa');

    // Set contoh data
    $sheet->setCellValue('A2', 'Bimoli');
    $sheet->setCellValue('B2', 'Keterangan barang 1');
    $sheet->setCellValue('C2', '100');
    $sheet->setCellValue('D2', 'Makanan');
    $sheet->setCellValue('E2', '50000');
    $sheet->setCellValue('F2', '');
    $sheet->setCellValue('G2', '0');
    $sheet->setCellValue('H2', '0');

    $sheet->setCellValue('A3', 'Garam');
    $sheet->setCellValue('B3', 'Keterangan barang 2');
    $sheet->setCellValue('C3', '50');
    $sheet->setCellValue('D3', 'Minuman');
    $sheet->setCellValue('E3', '25000');
    $sheet->setCellValue('F3', '');
    $sheet->setCellValue('G3', '0');
    $sheet->setCellValue('H3', '0');

    // Styling header
    $sheet->getStyle('A1:H1')->getFont()->setBold(true);
    $sheet->getStyle('A1:H1')->getFill()->setFillType(\PhpOffice\PhpSpreadsheet\Style\Fill::FILL_SOLID)->getStartColor()->setRGB('CCCCCC');

    // Auto size kolom
    foreach (range('A', 'H') as $col) {
        $sheet->getColumnDimension($col)->setAutoSize(true);
    }

    // Output file
    $writer = IOFactory::createWriter($spreadsheet, 'Xlsx');

    header('Content-Type: application/vnd.openxmlformats-officedocument.spreadsheetml.sheet');
    header('Content-Disposition: attachment;filename="template_import_stockoutlet.xlsx"');
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
    <title>Import Excel - STOCK BARANG OUTLET</title>
    <link href="img/logo.png" rel="icon">
    <link href="css/styles.css" rel="stylesheet" />
    <script src="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.1/js/all.min.js" crossorigin="anonymous"></script>
    <style>
        .import-container {
            max-width: 900px;
            margin: 30px auto;
            padding: 30px;
            background: white;
            border-radius: 15px;
            box-shadow: 0 5px 30px rgba(0, 0, 0, 0.1);
        }

        .header-section {
            text-align: center;
            margin-bottom: 30px;
            padding-bottom: 20px;
            border-bottom: 2px solid #f8f9fa;
        }

        .header-section h2 {
            color: #495057;
            font-weight: 600;
            margin-bottom: 10px;
        }

        .header-section p {
            color: #6c757d;
            font-size: 16px;
        }

        .drag-drop-area {
            border: 3px dashed #007bff;
            border-radius: 15px;
            padding: 50px 20px;
            text-align: center;
            background: linear-gradient(145deg, #f8f9fa, #e9ecef);
            margin: 30px 0;
            transition: all 0.3s ease;
            cursor: pointer;
            position: relative;
            overflow: hidden;
        }

        .drag-drop-area::before {
            content: '';
            position: absolute;
            top: -50%;
            left: -50%;
            width: 200%;
            height: 200%;
            background: linear-gradient(45deg, transparent, rgba(0, 123, 255, 0.1), transparent);
            transform: rotate(45deg);
            transition: all 0.6s ease;
            opacity: 0;
        }

        .drag-drop-area:hover {
            background: linear-gradient(145deg, #e3f2fd, #bbdefb);
            border-color: #0056b3;
            transform: translateY(-2px);
            box-shadow: 0 8px 25px rgba(0, 123, 255, 0.15);
        }

        .drag-drop-area:hover::before {
            opacity: 1;
            animation: shimmer 1.5s ease-in-out infinite;
        }

        @keyframes shimmer {
            0% {
                transform: translateX(-100%) translateY(-100%) rotate(45deg);
            }

            100% {
                transform: translateX(100%) translateY(100%) rotate(45deg);
            }
        }

        .drag-drop-area.dragover {
            background: linear-gradient(145deg, #e8f5e8, #c8e6c9);
            border-color: #28a745;
            transform: scale(1.02);
        }

        .drag-drop-content {
            position: relative;
            z-index: 2;
        }

        .drag-drop-icon {
            font-size: 4rem;
            color: #007bff;
            margin-bottom: 20px;
            transition: all 0.3s ease;
        }

        .drag-drop-area:hover .drag-drop-icon {
            transform: scale(1.1);
            color: #0056b3;
        }

        .file-input {
            display: none;
        }

        .instructions {
            background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
            color: white;
            padding: 25px;
            border-radius: 10px;
            margin: 30px 0;
            box-shadow: 0 4px 15px rgba(102, 126, 234, 0.3);
        }

        .instructions h5 {
            color: white;
            margin-bottom: 15px;
            font-weight: 600;
        }

        .instructions ol {
            margin-bottom: 0;
        }

        .instructions li {
            margin-bottom: 8px;
            line-height: 1.5;
        }

        .alert {
            padding: 20px;
            margin: 25px 0;
            border-radius: 10px;
            border: none;
            box-shadow: 0 2px 10px rgba(0, 0, 0, 0.1);
        }

        .alert-success {
            background: linear-gradient(135deg, #d4edda, #c3e6cb);
            color: #155724;
        }

        .alert-danger {
            background: linear-gradient(135deg, #f8d7da, #f5c6cb);
            color: #721c24;
        }

        .alert-info {
            background: linear-gradient(135deg, #d1ecf1, #bee5eb);
            color: #0c5460;
        }

        .btn {
            padding: 12px 30px;
            border-radius: 8px;
            font-weight: 500;
            transition: all 0.3s ease;
            border: none;
            text-decoration: none;
            display: inline-block;
            cursor: pointer;
        }

        .btn-success {
            background: linear-gradient(135deg, #28a745, #20c997);
            color: white;
        }

        .btn-success:hover {
            background: linear-gradient(135deg, #218838, #1ab394);
            transform: translateY(-2px);
            box-shadow: 0 5px 15px rgba(40, 167, 69, 0.4);
        }

        .btn-primary {
            background: linear-gradient(135deg, #007bff, #6610f2);
            color: white;
        }

        .btn-primary:hover {
            background: linear-gradient(135deg, #0056b3, #520dc2);
            transform: translateY(-2px);
            box-shadow: 0 5px 15px rgba(0, 123, 255, 0.4);
        }

        .btn-secondary {
            background: linear-gradient(135deg, #6c757d, #5a6268);
            color: white;
        }

        .btn-secondary:hover {
            background: linear-gradient(135deg, #545b62, #484e53);
            transform: translateY(-2px);
            box-shadow: 0 5px 15px rgba(108, 117, 125, 0.4);
        }

        .btn-lg {
            padding: 15px 40px;
            font-size: 16px;
        }

        .template-section {
            background: #f8f9fa;
            padding: 25px;
            border-radius: 10px;
            margin: 25px 0;
            text-align: center;
        }

        .file-info-card {
            background: white;
            border: 1px solid #dee2e6;
            border-radius: 10px;
            padding: 20px;
            margin-top: 20px;
            box-shadow: 0 2px 10px rgba(0, 0, 0, 0.05);
        }

        .progress-bar {
            width: 100%;
            height: 6px;
            background: #e9ecef;
            border-radius: 3px;
            overflow: hidden;
            margin: 15px 0;
        }

        .progress-fill {
            height: 100%;
            background: linear-gradient(90deg, #007bff, #28a745);
            width: 0%;
            transition: width 0.3s ease;
        }

        .feature-grid {
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(250px, 1fr));
            gap: 20px;
            margin: 30px 0;
        }

        .feature-card {
            background: white;
            padding: 20px;
            border-radius: 10px;
            box-shadow: 0 2px 10px rgba(0, 0, 0, 0.05);
            border-left: 4px solid #007bff;
            transition: all 0.3s ease;
        }

        .feature-card:hover {
            transform: translateY(-3px);
            box-shadow: 0 5px 20px rgba(0, 0, 0, 0.1);
        }

        .feature-icon {
            font-size: 2rem;
            color: #007bff;
            margin-bottom: 10px;
        }

        @media (max-width: 768px) {
            .import-container {
                margin: 15px;
                padding: 20px;
            }

            .drag-drop-area {
                padding: 30px 15px;
            }

            .btn-lg {
                padding: 12px 25px;
                font-size: 14px;
                width: 100%;
                margin-bottom: 10px;
            }
        }
    </style>
</head>

<body>
    <div class="import-container">
        <div class="header-section">
            <h2><i class="fas fa-file-excel"></i> Import Data Stock Outlet dari Excel</h2>
            <p>Upload file Excel untuk menambah atau update data stock barang outlet secara batch</p>
        </div>

        <?php if ($message): ?>
            <div class="alert alert-success">
                <i class="fas fa-check-circle"></i> <?= htmlspecialchars($message) ?>
            </div>
        <?php endif; ?>

        <?php if ($error): ?>
            <div class="alert alert-danger">
                <i class="fas fa-exclamation-triangle"></i>
                <pre style="white-space: pre-wrap; margin: 10px 0 0 0; font-family: inherit;"><?= htmlspecialchars($error) ?></pre>
            </div>
        <?php endif; ?>

        <div class="feature-grid">
            <div class="feature-card">
                <div class="feature-icon"><i class="fas fa-download"></i></div>
                <h6>Template Siap Pakai</h6>
                <p>Download template Excel dengan format yang sudah sesuai dan contoh data.</p>
            </div>
            <div class="feature-card">
                <div class="feature-icon"><i class="fas fa-sync-alt"></i></div>
                <h6>Update Otomatis</h6>
                <p>Jika barang sudah ada, stock akan ditambahkan secara otomatis.</p>
            </div>
            <div class="feature-card">
                <div class="feature-icon"><i class="fas fa-shield-alt"></i></div>
                <h6>Validasi Data</h6>
                <p>Sistem akan memvalidasi data dan memberikan laporan error yang detail.</p>
            </div>
        </div>

        <div class="instructions">
            <h5><i class="fas fa-info-circle"></i> Petunjuk Penggunaan</h5>
            <ol>
                <li><strong>Download Template:</strong> Klik tombol "Download Template Excel" untuk mendapatkan format yang benar</li>
                <li><strong>Isi Data:</strong> Lengkapi data sesuai dengan kolom yang tersedia di template</li>
                <li><strong>Kolom Wajib:</strong> Nama Barang, Keterangan, dan Stock harus diisi</li>
                <li><strong>Kolom Opsional:</strong> Kategori, Harga, ID Outlet, Stock Fisik, dan Stock Sisa boleh dikosongkan (jika ID Outlet kosong, akan menggunakan outlet user yang login)</li>
                <li><strong>Hapus Contoh:</strong> Hapus baris contoh data sebelum melakukan import</li>
                <li><strong>Upload File:</strong> Drag & drop atau pilih file Excel yang sudah diisi</li>
            </ol>
        </div>


        <div class="text-center mb-4">
            <a href="?download_template=1" class="btn btn-success">
                <i class="fas fa-download"></i> Download Template Excel
            </a>
        </div>

        <form method="post" enctype="multipart/form-data">
            <div class="drag-drop-area" id="dragDropArea">
                <i class="fas fa-cloud-upload-alt fa-3x text-primary mb-3"></i>
                <h4>Drag & Drop File Excel di sini</h4>
                <p class="text-muted">atau klik untuk pilih file</p>
                <input type="file" name="excel_file" id="excelFile" class="file-input" accept=".xls,.xlsx" required>
                <button type="button" class="btn btn-primary" onclick="document.getElementById('excelFile').click()">
                    <i class="fas fa-file-excel"></i> Pilih File Excel
                </button>
            </div>

            <div id="fileInfo" class="mt-3" style="display: none;">
                <div class="alert alert-info">
                    <strong>File yang dipilih:</strong> <span id="fileName"></span>
                </div>
            </div>

            <div class="text-center">
                <button type="submit" name="import" class="btn btn-primary btn-lg">
                    <i class="fas fa-upload"></i> Import Data
                </button>
                <a href="stockoutlet.php" class="btn btn-secondary btn-lg ml-2">
                    <i class="fas fa-arrow-left"></i> Kembali ke Stock Outlet
                </a>
            </div>
        </form>
    </div>

    <script>
        // Drag and drop functionality
        const dragDropArea = document.getElementById('dragDropArea');
        const fileInput = document.getElementById('excelFile');
        const fileInfo = document.getElementById('fileInfo');
        const fileName = document.getElementById('fileName');

        dragDropArea.addEventListener('click', () => {
            fileInput.click();
        });

        dragDropArea.addEventListener('dragover', (e) => {
            e.preventDefault();
            dragDropArea.classList.add('dragover');
        });

        dragDropArea.addEventListener('dragleave', () => {
            dragDropArea.classList.remove('dragover');
        });

        dragDropArea.addEventListener('drop', (e) => {
            e.preventDefault();
            dragDropArea.classList.remove('dragover');

            const files = e.dataTransfer.files;
            if (files.length > 0) {
                fileInput.files = files;
                showFileInfo(files[0]);
            }
        });

        fileInput.addEventListener('change', (e) => {
            if (e.target.files.length > 0) {
                showFileInfo(e.target.files[0]);
            }
        });

        function showFileInfo(file) {
            fileName.textContent = file.name;
            fileInfo.style.display = 'block';
        }
    </script>
</body>

</html>