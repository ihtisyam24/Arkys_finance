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
    <title>STOK BARANG</title>
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
        <form method="get" action="stockoutlet.php" class="d-none d-md-inline-block form-inline ml-auto mr-0 mr-md-3 my-2 my-md-0">
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
                        <h1>Barang Keluar Outlet</h1>
                        <p>Semangat kerjanya dan semoga harimu menyenangkan :) </p>
                    </div>
                    
                    <ol class="breadcrumb mb-4">

                    </ol>
                    <div class="card mb-4">
                        <div class="card-header">
                            <!-- Button to Open the Modal -->
                            <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#myModal">
                                Tambah Barang
                            </button>
                            <a href="export keluar.php" class="btn btn-info"> Export Laporan </a>
                            <form method="GET" class="form-inline">
                                <input class="form-control" type="date" name="tgl" value="" style="margin-right:15px" />
                                <input type="submit" class="btn btn-sm btn-info" value="cek" />
                            </form>
                        </div>
                        <div class="card-body">
                            <div class="table-responsive">
                                <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                                    <thead>
                                        <tr>
                                            <th>Tanggal keluar</th>
                                            <th>Kode Transaksi</th>
                                            <th>Nama Barang</th>
                                            <th>Keterangan</th>
                                            <th>Jumlah</th>
                                            <th>Gudang Asal</th>
                                            <th>Gudang Tujuan</th>
                                            <th>Outlet</th>
                                            <th>Aksi</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <?php
                                        // Filter by outlet for Leader/Kapten and Kepala Gudang
                                        $outletFilter = '';
                                        if (isset($_SESSION['level']) && ($_SESSION['level'] == 'Leader/Kapten' || $_SESSION['level'] == 'Kepala Gudang')) {
                                            if (isset($_SESSION['idoutlet']) && !empty($_SESSION['idoutlet'])) {
                                                $idoutlet = $_SESSION['idoutlet'];
                                                $outletFilter = " AND k.idoutlet='$idoutlet'";
                                            }
                                        }

                                        $tgl1 = isset($_GET['tgl1']) ? "AND DATE(tanggal1) = '" . $_GET['tgl1'] . "'" : '';
                                        $ambilsemuadatastock = mysqli_query($conn, "select k.*, s.namabarang1, o.namaoutlet from keluaroutlet k LEFT JOIN stockoutlet s ON s.idbarang1 = k.idbarang1 LEFT JOIN outlet o ON k.idoutlet = o.idoutlet where 1=1 $tgl1 $outletFilter");
                                        while ($data = mysqli_fetch_array($ambilsemuadatastock)) {
                                            $tanggal1 = $data['tanggal1'];
                                            $transaksi = $data['transaksi'];
                                            $namabarang1 = $data['namabarang1'];
                                            $keterangan1 = $data['keterangan1'];
                                            $qty1 = $data['qty1'];
                                            $outlet = $data['outlet'];
                                            $outlettujuan = $data['outlettujuan'];
                                            $idb1 = $data['idbarang1'];
                                            $idk1 = $data['idkeluar1'];
                                            $idoutletData = $data['idoutlet'];
                                            $namaoutlet = $data['namaoutlet'];
                                            $outletDisplay = $idoutletData ? $idoutletData . '-' . $namaoutlet : '-';

                                        ?>
                                            <tr>
                                                <td><?= $tanggal1; ?></td>
                                                <td><?= $transaksi; ?></td>
                                                <td><?= $namabarang1; ?></td>
                                                <td><?= $keterangan1 ?></td>
                                                <td><?= $qty1; ?></td>
                                                <td><?= $outlet; ?></td>
                                                <td><?= $outlettujuan; ?></td>
                                                <td><?= $outletDisplay; ?></td>

                                                <td>
                                                    <button type="button" class="btn btn-warning" data-toggle="modal" data-target="#edit<?= $idb1; ?>">
                                                        Edit
                                                    </button>
                                                    <button type="button" class="btn btn-danger" data-toggle="modal" data-target="#delete<?= $idb1; ?>">
                                                        Delete
                                                    </button>
                                                </td>

                                            </tr>
                                            <!-- edit modal modal -->
                                            <div class="modal fade" id="edit<?= $idb1; ?>">
                                                <div class="modal-dialog">
                                                    <div class="modal-content">

                                                        <!-- Modal Header -->
                                                        <div class="modal-header">
                                                            <h4 class="modal-title">Edit Barang</h4>
                                                            <button type="button" class="close" data-dismiss="modal">&times;</button>
                                                        </div>

                                                        <!-- Modal body -->
                                                        <form method="post">
                                                            <div class="modal-body">
                                                                <input type="text" name="namabarang1" value="<?= $namabarang1; ?>" class="form-control" required>
                                                                <br>
                                                                <input type="text" name="keterangan1" value="<?= $keterangan1; ?>" class="form-control" required>
                                                                <br>
                                                                <input type="text" name="qty1" value="<?= $qty1; ?>" class="form-control" required>
                                                                <br>
                                                                <br>
                                                                <input type="text" name="outlet" value="<?= $outlet; ?>" class="form-control" required>
                                                                <br>
                                                                <input type="text" name="outlettujuan" value="<?= $outlettujuan; ?>" class="form-control" required>
                                                                <br>
                                                                <input type="hidden" name="idbarang1" value="<?= $idb1; ?>">
                                                                <input type="hidden" name="idkeluar1" value="<?= $idk1; ?>">
                                                                <button type="submit" class="btn btn-primary" name="updatebarangkeluar1">submit</button>
                                                            </div>
                                                        </form>


                                                    </div>
                                                </div>
                                            </div>


                                            <!-- delete modal modal -->
                                            <div class="modal fade" id="delete<?= $idb1; ?>">
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
                                                                Apakah anda yakin ingin menghapus <?= $namabarang1; ?> | <?= $keterangan1; ?>?
                                                                <br>
                                                                <input type="hidden" name="idbarang1" value="<?= $idb1; ?>">
                                                                <input type="hidden" name="qty1" value="<?= $qty1; ?>">
                                                                <input type="hidden" name="idkeluar1" value="<?= $idk1; ?>">
                                                                <br>
                                                                <button type="submit" class="btn btn-danger" name="hapusbarangkeluar1">Hapus</button>
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
                        <div class="text-muted">Copyright &copy; Muhammad Yusuf 2025</div>
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
</body>
<!-- The Modal -->
<div class="modal fade" id="myModal">
    <div class="modal-dialog">
        <div class="modal-content">

            <!-- Modal Header -->
            <div class="modal-header">
                <h4 class="modal-title">Tambah Barang keluar</h4>
                <button type="button" class="close" data-dismiss="modal">&times;</button>
            </div>

            <!-- Modal body -->
            <form method="post">
                <div class="modal-body">
                    <br>
                    <input type="text" name="transaksi" placeholder="Kode Transaksi" class="form-control" required>
                    <br>
                    <select name="barangnya1" class="form-control">
                        <?php
                        // Filter by outlet for Leader/Kapten and Kepala Gudang
                        $whereClauseModal = '';
                        if (isset($_SESSION['level']) && ($_SESSION['level'] == 'Leader/Kapten' || $_SESSION['level'] == 'Kepala Gudang')) {
                            if (isset($_SESSION['idoutlet']) && !empty($_SESSION['idoutlet'])) {
                                $idoutlet = $_SESSION['idoutlet'];
                                $whereClauseModal = "where idoutlet='$idoutlet'";
                            }
                        }

                        $ambilsemuadatanya = mysqli_query($conn, "select * from stockoutlet " . $whereClauseModal);
                        while ($fetcharray = mysqli_fetch_array($ambilsemuadatanya)) {
                            $namabarangnya1 = $fetcharray['namabarang1'];
                            $idbarangnya1 = $fetcharray['idbarang1'];
                        ?>
                            <option value="<?= $idbarangnya1; ?>"><?= $namabarangnya1; ?></option>
                        <?php
                        }

                        ?>
                    </select>
                    <br>
                    <input type="text" name="keterangan1" placeholder="keterangan" class="form-control" required>
                    <br>
                    <input type="text" name="qty1" placeholder="qty" class="form-control" required>
                    <br>
                    <input type="text" name="outlet" placeholder="Gudang Asal" class="form-control" required>
                    <br>
                    <input type="text" name="outlettujuan" placeholder="Gudang Tujuan" class="form-control" required>
                    <br>
                    <button type="submit" class="btn btn-primary" name="addbarangkeluar1">submit</button>
                </div>
            </form>

        </div>
    </div>
</div>

</html>