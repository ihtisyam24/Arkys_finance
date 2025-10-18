<?php
require 'function.php';
if (!isset($_SESSION['level'])) {
    // Redirect to the login page if the user is not logged in
    header('Location: login.php');
    exit(); // add exit after header to stop execution
}
?>


<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no" />
    <meta name="description" content="" />
    <meta name="author" content="" />
    <title>Beban Pokok Penjualan</title>
    <link href="img/logo.png" rel="icon">
    <link href="img/logo.png" rel="apple-touch-icon">
    <link href="css/styles.css" rel="stylesheet" />
    <link href="https://cdn.datatables.net/1.10.20/css/dataTables.bootstrap4.min.css" rel="stylesheet" crossorigin="anonymous" />
    <script src="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.1/js/all.min.js" crossorigin="anonymous"></script>
</head>

<body class="sb-nav-fixed">
    <nav class="sb-topnav navbar navbar-expand navbar-dark bg-dark">
        <a class="navbar-brand" href="index.php">ARKYS SMASH CHICKEN </a>
        <button class="btn btn-link btn-sm order-1 order-lg-0" id="sidebarToggle" href="#"><i class="fas fa-bars"></i></button>
        <!-- Navbar Search-->
        <form method="get" action="stock.php" class="d-none d-md-inline-block form-inline ml-auto mr-0 mr-md-3 my-2 my-md-0">
            <div class="input-group">
                <input name="search" class="form-control" type="text" placeholder="Search for..." aria-label="Search" aria-describedby="basic-addon2" />
                <div class="input-group-append">
                    <button class="btn btn-primary" type="submit"><i class="fas fa-search"></i></button>
                </div>
            </div>
        </form>
        <!-- Navbar-->
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
                    <div style="background: url(img/) no-repeat center center fixed; -webkit-background-size: cover; -moz-background-size: cover; -o-background-size: cover; background-size: cover;" class="mt-4 p-5 bg-success text-black rounded">
                        <h1>Beban Pokok Penjualan</h1>
                        <p>Semangat kerjanya dan semoga harimu menyenangkan :) </p>
                    </div>
                    
                    <ol class="breadcrumb mb-4">
                    </ol>
                    <div class="card mb-4">
                        <div class="card-header">
                            <!-- Button to Open the Modal -->
                            <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#myModal">
                                Tambah Laporan
                            </button>
                            <a href="export.php" target="_blank" class="btn btn-info"> Export Laporan </a>
                            </button>
                            <a href="import.php" target="_blank" class="btn btn-info"> Import Laporan </a>
                            </button>
                        </div>
                        <div class="card-body">
                           
                            <div class="table-responsive">
                                <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                                    <thead>
                                        <tr>
                                            <th>No.</th>
                                            <th>Tanggal</th>
                                            <th>Nama Outlet</th>
                                            <th>Outlet</th>
                                            <th>Persediaan Awal</th>
                                            <th>Belanja Produksi</th>
                                            <th>Persediaan Akhir</th>
                                            <th>Persediaan Akhir Murni</th>
                                            <th>Total Harga Pokok Penjualan</th>
                                            <th>Total Sales</th>
                                            <th>Laba Kotor</th>
                                            <th>Aksi</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <?php
                                        $search = isset($_GET['search']) ? "where k.outlet2 LIKE '%" . $_GET['search'] . "%'" : '';
                                        $ambilsemuadatastock = mysqli_query($conn, "select k.*, o.namaoutlet from keuangan k LEFT JOIN outlet o ON k.idoutlet = o.idoutlet " . $search);
                                        $i = 1;
                                        while ($data = mysqli_fetch_array($ambilsemuadatastock)) {
                                            $tanggal2 = $data['tanggal2'];
                                            $outlet2 = $data['outlet2'];
                                            $persediaanawal = $data['persediaanawal'];
                                            $belanjaproduksi = $data['belanjaproduksi'];
                                            $persediaanakhir = $data['persediaanakhir'];
                                            $persediaanakhirmurni = $data['persediaanakhirmurni'];
                                            $totalhargapokokpenjualan = $data['totalhargapokokpenjualan'];
                                            $total = $data['total'];
                                            $labakotor= $data['labakotor'];
                                            $idkeu = $data['idkeuangan'];
                                            $idoutlet = $data['idoutlet'];
                                            $namaoutlet = $data['namaoutlet'];
                                            $outletDisplay = $idoutlet ? $idoutlet . '-' . $namaoutlet : '-';
                                            //cek

                                            $base_url = "http://" . $_SERVER['SERVER_NAME'] . '/stokbarang/';

                                        ?>
                                            <tr>
                                                <td><?= $i++; ?></td>
                                                <td><?= $tanggal2; ?></td>
                                                <td><?= $outlet2; ?></a></td>
                                                <td><?= $outletDisplay; ?></td>
                                                <td>Rp <?= number_format($persediaanawal, 0, ',', '.'); ?></td>
                                                <td>Rp <?= number_format($belanjaproduksi, 0, ',', '.'); ?></td>
                                                <td>Rp <?= number_format($persediaanakhir, 0, ',', '.'); ?></td>
                                                <td>Rp <?= number_format($persediaanakhirmurni, 0, ',', '.'); ?></td>
                                                <td>Rp <?= number_format($totalhargapokokpenjualan, 0, ',', '.'); ?></td>
                                                <td>Rp <?= number_format($total, 0, ',', '.'); ?></td>
                                                <td>Rp <?= number_format($labakotor, 0, ',', '.'); ?></td>
                                                <td>
                                                    <button type="button" class="btn btn-warning" data-toggle="modal" data-target="#edit<?= $idkeu; ?>">
                                                        Edit
                                                    </button>
                                                    <button type="button" class="btn btn-danger" data-toggle="modal" data-target="#delete<?= $idkeu; ?>">
                                                        Delete
                                                    </button>
                                                </td>
                                            </tr>
                                            <!-- edit modal modal -->
                                            <div class="modal fade" id="edit<?= $idkeu; ?>">
                                                <div class="modal-dialog">
                                                    <div class="modal-content">
                                                        <!-- Modal Header -->
                                                        <div class="modal-header">
                                                            <h4 class="modal-title">Edit Barang</h4>
                                                            <button type="button" class="close" data-dismiss="modal">&times;</button>
                                                        </div>
                                                        <!-- Modal body -->
                                                        <form method="post" enctype="multipart/form-data">
                                                            <div class="modal-body">
                                                                <input type="text" name="tanggal2" value="<?= $tanggal2; ?>" class="form-control" required>
                                                                <br>
                                                                <input type="text" name="outlet2" value="<?= $outlet2; ?>" class="form-control" required>
                                                                <br>
                                                                <input type="number" name="persediaanawal" placeholder="Persediaan Awal" alue="<?= $persediaanawal; ?>" class="form-control" required>
                                                                <br>
                                                                <input type="number" name="belanjaproduksi" placeholder="Belanja Produksi" alue="<?= $belanjaproduksi; ?>" class="form-control" required>
                                                                <br>
                                                                <label for="persediaanakhir">persediaanakhir</label>
                                                                <input type="number" name="persediaanakhir" placeholder="Persediaan Akhir" alue="<?= $persediaanakhir; ?>" class="form-control" required>
                                                                <br>
                                                                <input type="number" name="persediaanakhirmurni" placeholder="Persediaan Akhir Murni" alue="<?= $persediaanakhirmurni; ?>" class="form-control" required>
                                                                <br>
                                                                <input type="number" name="total" placeholder="Total Sales" alue="<?= $total; ?>" class="form-control" required>
                                                                <br>
                                                                <br>
                                                                <input type="hidden" name="idkeuangan" value="<?= $idkeu; ?>">
                                                                <button type="submit" class="btn btn-primary" name="updatebeban">Submit</button>
                                                            </div>
                                                        </form>
                                                    </div>
                                                </div>
                                            </div>
                                            <!-- delete modal modal -->
                                            <div class="modal fade" id="delete<?= $idkeu; ?>">
                                                <div class="modal-dialog">
                                                    <div class="modal-content">
                                                        <!-- Modal Header -->
                                                        <div class="modal-header">
                                                            <h4 class="modal-title">HAPUS BARANG YANG DIPILIH?</h4>
                                                            <button type="button" class="close" data-dismiss="modal">&times;</button>
                                                        </div>
                                                        <!-- Modal body -->
                                                        <form method="post">
                                                            <div class="modal-body">
                                                                Apakah anda yakin ingin menghapus <?= $outlet2; ?> | <?= $tanggal2; ?>?
                                                                <br>
                                                                <input type="hidden" name="idbebanpokok" value="<?= $idkeu; ?>">
                                                                <br>
                                                                <button type="submit" class="btn btn-danger" name="hapusbeban">Hapus</button>
                                                            </div>
                                                        </form>
                                                    </div>
                                                </div>
                                            </div>
                                        <?php
                                        };
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
                        <div class="text-muted">Copyright &copy; MUHAMMAD YUSUF</div>
                    </div>
                </div>
            </footer>
        </div>
    </div>
    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.5.3/dist/js/bootstrap.bundle.min.js" crossorigin="anonymous"></script>
    <script src="js/scripts.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/2.8.0/Chart.min.js" crossorigin="anonymous"></script>
    <script src="assets/demo/chart-area-demo.js"></script>
    <script src="assets/demo/chart-bar-demo.js"></script>
    <script src="https://cdn.datatables.net/1.10.20/js/jquery.dataTables.min.js" crossorigin="anonymous"></script>
    <script src="https://cdn.datatables.net/1.10.20/js/dataTables.bootstrap4.min.js" crossorigin="anonymous"></script>
    <script src="assets/demo/datatables-demo.js"></script>
    <script>
        // Mendapatkan elemen input
        var stockInput = document.getElementById("stockInput");

        // Menambahkan event listener untuk mengontrol panjang maksimum
        stockInput.addEventListener("input", function() {
            if (stockInput.value.length > 5) {
                stockInput.value = stockInput.value.slice(0, 5);
            }
        });
    </script>
</body>

<!-- The Modal -->
<div class="modal fade" id="myModal">
    <div class="modal-dialog">
        <div class="modal-content">

            <!-- Modal Header -->
            <div class="modal-header">
                <h4 class="modal-title">Tambah Beban Pokok Penjualan</h4>
                <button type="button" class="close" data-dismiss="modal">&times;</button>
            </div>

            <!-- Modal body -->
            <!-- <form method= "post" enctype="multipart-form-data"> -->
            <form method="post" enctype='multipart/form-data'>

                <div class="modal-body">
                    <input type="text" name="tanggal2" placeholder="Tanggal" class="form-control" required>
                    <br>
                    <input type="text" name="outlet2" placeholder="Nama Outlet" class="form-control" required>
                    <br>
                    <input type="number" name="persediaanawal" placeholder="Persediaan Awal" class="form-control" required>
                    <br>
                    <input type="number" name="belanjaproduksi" placeholder="Belanja Produksi" class="form-control" required>
                    <br>
                    <input type="number" name="persediaanakhir" placeholder="persediaanakhir" class="form-control" required>
                    <br>
                    <input type="number" name="persediaanakhirmurni" placeholder="Persediaan Akhir Murni" class="form-control " required>
                    <br>
                    <button type="submit" class="btn btn-primary" name="addnewkeuangan">submit</button>
                </div>
            </form>


        </div>
    </div>
</div>



</html>