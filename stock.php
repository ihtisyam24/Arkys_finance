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
    <title>STOCK BARANG</title>
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
                        <h1>Stock Barang</h1>
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
                            <a href="export.php" target="_blank" class="btn btn-info"> Export Laporan </a>
                            </button>
                            <a href="import.php" target="_blank" class="btn btn-info"> Import Laporan </a>
                            </button>
                        </div>
                        <div class="card-body">
                            <?php
                            // Filter by outlet for Leader/Kapten and Kepala Gudang
                            $whereAlert = 'where stock <10';
                            if (isset($_SESSION['level']) && ($_SESSION['level'] == 'Leader/Kapten' || $_SESSION['level'] == 'Kepala Gudang')) {
                                if (isset($_SESSION['idoutlet']) && !empty($_SESSION['idoutlet'])) {
                                    $idoutlet = $_SESSION['idoutlet'];
                                    $whereAlert .= " AND idoutlet='$idoutlet'";
                                }
                            }

                            $ambildatastock = mysqli_query($conn, "select * from stock " . $whereAlert);
                            while ($fetch = mysqli_fetch_array($ambildatastock)) {
                                $barang = $fetch['namabarang'];
                            ?>
                                <div class="alert alert-danger alert-dismissible">
                                    <button type="button" class="close" data-dismiss="alert">&times;</button>
                                    <strong>PERHATIAN!</strong> Stock <?= $barang ?> Hampir Habis, <strong>SEGERA BELANJA KEMBALI!</strong>
                                </div>
                            <?php
                            }
                            ?>
                            <div class="table-responsive">
                                <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                                    <thead>
                                        <tr>
                                            <th>No.</th>

                                            <th>Nama Barang</th>
                                            <th>Stock</th>
                                            <th>Kategori</th>
                                            <th>Keterangan</th>
                                            <th>Harga</th>
                                            <th>Outlet</th>
                                            <th>Aksi</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <?php
                                        // Filter by outlet for Leader/Kapten and Kepala Gudang
                                        $whereClause = '';
                                        if (isset($_SESSION['level']) && ($_SESSION['level'] == 'Leader/Kapten' || $_SESSION['level'] == 'Kepala Gudang')) {
                                            if (isset($_SESSION['idoutlet']) && !empty($_SESSION['idoutlet'])) {
                                                $idoutlet = $_SESSION['idoutlet'];
                                                $whereClause = "where s.idoutlet='$idoutlet'";
                                            }
                                        }

                                        if (isset($_GET['search'])) {
                                            if ($whereClause != '') {
                                                $whereClause .= " AND s.namabarang LIKE '%" . $_GET['search'] . "%'";
                                            } else {
                                                $whereClause = "where s.namabarang LIKE '%" . $_GET['search'] . "%'";
                                            }
                                        }

                                        $ambilsemuadatastock = mysqli_query($conn, "select s.*, o.namaoutlet from stock s LEFT JOIN outlet o ON s.idoutlet = o.idoutlet " . $whereClause);
                                        $i = 1;
                                        while ($data = mysqli_fetch_array($ambilsemuadatastock)) {
                                            $namabarang = $data['namabarang'];
                                            $stock = $data['stock'];

                                            $kategori = $data['kategori'];
                                            $keterangan = $data['keterangan'];
                                            $Harga= $data['Harga'];
                                            $idb = $data['idbarang'];
                                            $idoutletData = $data['idoutlet'];
                                            $namaoutlet = $data['namaoutlet'];
                                            $outletDisplay = $idoutletData ? $idoutletData . '-' . $namaoutlet : '-';
                                            //cek

                                            $base_url = "http://" . $_SERVER['SERVER_NAME'] . '/stokbarang/';

                                        ?>
                                            <tr>
                                                <td><?= $i++; ?></td>

                                                <td><?= $namabarang; ?></a></td>
                                                <td><?= $stock; ?></td>

                                                <td><?= $kategori; ?></td>
                                                <td><?= $keterangan ?></td>
                                                <td><?= $Harga ?></td>
                                                <td><?= $outletDisplay; ?></td>
                                                <td>
                                                    <button type="button" class="btn btn-warning" data-toggle="modal" data-target="#edit<?= $idb; ?>">
                                                        Edit
                                                    </button>
                                                    <button type="button" class="btn btn-danger" data-toggle="modal" data-target="#delete<?= $idb; ?>">
                                                        Delete
                                                    </button>
                                                </td>
                                            </tr>
                                            <!-- edit modal modal -->
                                            <div class="modal fade" id="edit<?= $idb; ?>">
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
                                                               
                                            
                                                                <input type="text" name="namabarang" value="<?= $namabarang; ?>" class="form-control" required>
                                                                <br>
                                                                <input type="number" name="stock" id="stockInput" placeholder="Stock" value="<?= $stock; ?>" class="form-control" required oninput="limitLength(this, 20)">
                                                                <script>
                                                                    function limitLength(element, maxLength) {
                                                                        if (element.value.length > maxLength) {
                                                                            element.value = element.value.slice(0, maxLength);
                                                                        }
                                                                    }
                                                                </script>
                                                                <br>
                                                                <label for="kategori">Kategori</label>
                                                                <input type="text" name="kategori" placeholder="kategori" value="<?= $kategori; ?>" class="form-control" required>
                                                                <br>
                                                                <input type="text" name="keterangan" value="<?= $keterangan; ?>" class="form-control" required>
                                                                <br>
                                                                <br>
                                                                <input type="text" name="Harga" value="<?= $Harga; ?>" class="form-control" required>
                                                                <br>
                                                                <input type="hidden" name="idbarang" value="<?= $idb; ?>">
                                                                <button type="submit" class="btn btn-primary" name="updatebarang">Submit</button>
                                                            </div>
                                                        </form>
                                                    </div>
                                                </div>
                                            </div>
                                            <!-- delete modal modal -->
                                            <div class="modal fade" id="delete<?= $idb; ?>">
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
                                                                Apakah anda yakin ingin menghapus <?= $namabarang; ?> | <?= $keterangan; ?>?
                                                                <br>
                                                                <input type="hidden" name="idbarang" value="<?= $idb; ?>">
                                                                <br>
                                                                <button type="submit" class="btn btn-danger" name="hapusbarang">Hapus</button>
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
                <h4 class="modal-title">Tambah Barang</h4>
                <button type="button" class="close" data-dismiss="modal">&times;</button>
            </div>

            <!-- Modal body -->
            <!-- <form method= "post" enctype="multipart-form-data"> -->
            <form method="post" enctype='multipart/form-data'>

                <div class="modal-body">
                    <input type="text" name="namabarang" placeholder="Nama Barang" class="form-control" required>
                    <br>
                    <input type="text" name="keterangan" placeholder="keterangan" class="form-control" required>
                    <br>
                    <input type="number" name="stock" id="stockInput" placeholder="Stock" class="form-control" required>
                    <br>
                    <label for="kategori">Kategori</label>
                    <input type="text" name="kategori" placeholder="kategori" class="form-control " required>
                    <br>
                    <input type="number" name="Harga" id="Harga" placeholder="Masukkan Harga" class="form-control" required>
                    <br>
                    <button type="submit" class="btn btn-primary" name="addnewbarang">submit</button>
                </div>
            </form>


        </div>
    </div>
</div>

</html>