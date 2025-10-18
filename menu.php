<nav class="sb-sidenav accordion sb-sidenav-dark" id="sidenavAccordion">
    <div class="sb-sidenav-menu">
        <div class="nav">
            <div class="sb-sidenav-menu-heading">Menu</div>
            <?php if ($_SESSION['level'] == 'Admin') : ?>
            </a>
            <a class="nav-link" href="stock.php">
                <div class="sb-nav-link-icon"><i class="fas fa-folder"></i></div>
                Kelola Stock barang
            </a>
            <a class="nav-link" href="masuk.php">
                <div class="sb-nav-link-icon"><i class="far fa-folder-open"></i></div>
                Kelola Barang Masuk
            </a>

            <a class="nav-link" href="keluar.php">
                <div class="sb-nav-link-icon"><i class="fas fa-folder-open"></i></div>
                Kelola Barang Keluar
            </a>
            <a class="nav-link" href="PO.php">
                <div class="sb-nav-link-icon"><i class="fas fa-cart-plus"></i></div>
                Purchase Order
            </a>
            <a class="nav-link" href="penyesuaian.php">
                <div class="sb-nav-link-icon"><i class="far fa-window-restore"></i></div>
                Penyesuaian Stock
            </a>
            <a class="nav-link" href="stockoutlet.php">
                <div class="sb-nav-link-icon"><i class="fas fa-folder"></i></div>
                Stock Barang Outlet
            </a>
            <a class="nav-link" href="masukoutlet.php">
                    <div class="sb-nav-link-icon"><i class="far fa-folder-open"></i></div>
                    Barang Masuk Outlet
            </a>
            <a class="nav-link" href="keluaroutlet.php">
                    <div class="sb-nav-link-icon"><i class="fas fa-folder-open"></i></div>
                    Barang Keluar Outlet
            </a>
            <a class="nav-link" href="penyesuaianoutlet.php">
                    <div class="sb-nav-link-icon"><i class="fas fa-folder-open"></i></div>
                    Penyesuaian Outlet
            </a>
            <a class="nav-link" href="keluser.php">
                    <div class="sb-nav-link-icon"><i class="fas fa-user"></i></div>
                    Kelola User
                </a>
            <a class="nav-link" href="gudang.php">
                    <div class="sb-nav-link-icon"><i class="fas fa-cart-plus"></i></div>
                    Tambah Outlet
                </a>
                
            <?php endif; ?>

            <?php if ($_SESSION['level'] == 'Kepala Gudang') : ?>
            </a>
            <a class="nav-link" href="stock.php">
                <div class="sb-nav-link-icon"><i class="fas fa-folder"></i></div>
                Kelola Stock barang
            </a>
            <a class="nav-link" href="masuk.php">
                <div class="sb-nav-link-icon"><i class="far fa-folder-open"></i></div>
                Kelola Barang Masuk
            </a>

            <a class="nav-link" href="keluar.php">
                <div class="sb-nav-link-icon"><i class="fas fa-folder-open"></i></div>
                Kelola Barang Keluar
            </a>
            <a class="nav-link" href="PO.php">
                <div class="sb-nav-link-icon"><i class="fas fa-tachometer-alt"></i></div>
                Purchase Order
            </a>
            <a class="nav-link" href="penyesuaian.php">
                <div class="sb-nav-link-icon"><i class="far fa-window-restore"></i></div>
                Penyesuaian Stock
            </a>
            
            <?php endif; ?>
            
            <?php if ($_SESSION['level'] == 'Leader/Kapten') : ?> 
                <a class="nav-link" href="stockoutlet.php">
                    <div class="sb-nav-link-icon"><i class="fas fa-folder"></i></div>
                    Stock Barang Outlet
                </a>
                <a class="nav-link" href="masukoutlet.php">
                    <div class="sb-nav-link-icon"><i class="far fa-folder-open"></i></div>
                    Barang Masuk Outlet
                </a>
                <a class="nav-link" href="keluaroutlet.php">
                    <div class="sb-nav-link-icon"><i class="fas fa-folder-open"></i></div>
                    Barang Keluar Outlet
                </a>
                <a class="nav-link" href="penyesuaianoutlet.php">
                    <div class="sb-nav-link-icon"><i class="far fa-window-restore"></i></div>
                    Penyesuaian Stock
                </a>
                <a class="nav-link" href="PO.php">
                    <div class="sb-nav-link-icon"><i class="fas fa-cart-plus"></i></div>
                    Purchase Order
                </a>
                
            <?php endif; ?>

            <?php if ($_SESSION['level'] == 'Finance') : ?> 
                <a class="nav-link" href="laporankeuangan.php">
                    <div class="sb-nav-link-icon"><i class="fas fa-folder"></i></div>
                    Laporan Keuangan
                </a>
                <a class="nav-link" href="bebanpokokpenjualan.php">
                    <div class="sb-nav-link-icon"><i class="fas fa-folder"></i></div>
                    Beban Pokok Penjualan
                </a>
                <a class="nav-link" href="biayaoperasional.php">
                    <div class="sb-nav-link-icon"><i class="fas fa-folder"></i></div>
                    Biaya Operasional
                </a>
                <a class="nav-link" href="pengeluaranops.php">
                    <div class="sb-nav-link-icon"><i class="fas fa-folder"></i></div>
                    Pengeluaran Opsional
                </a>
                
            <?php endif; ?>
            <a class="nav-link" href="logout.php">
                <div class="sb-nav-link-icon"><i class="fas fa-sign-out-alt"></i></div>
                Logout
            </a>


            <div class="collapse" id="collapsePages" aria-labelledby="headingTwo" data-parent="#sidenavAccordion">
                <nav class="sb-sidenav-menu-nested nav accordion" id="sidenavAccordionPages">
                    <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#pagesCollapseAuth" aria-expanded="false" aria-controls="pagesCollapseAuth">
                        Authentication
                        <div class="sb-sidenav-collapse-arrow"><i class="fas fa-angle-down"></i></div>
                    </a>
                    <div class="collapse" id="pagesCollapseAuth" aria-labelledby="headingOne" data-parent="#sidenavAccordionPages">
                    </div>
                    <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#pagesCollapseError" aria-expanded="false" aria-controls="pagesCollapseError">
                        Error
                        <div class="sb-sidenav-collapse-arrow"><i class="fas fa-angle-down"></i></div>
                    </a>
                    <div class="collapse" id="pagesCollapseError" aria-labelledby="headingOne" data-parent="#sidenavAccordionPages">
                        <nav class="sb-sidenav-menu-nested nav">
                            <a class="nav-link" href="401.html">401 Page</a>
                            <a class="nav-link" href="404.html">404 Page</a>
                            <a class="nav-link" href="500.html">500 Page</a>
                        </nav>
                    </div>
                </nav>
            </div>
        </div>
    </div>
    <?= $_SESSION['level'] ?>
    <div class="sb-sidenav-footer">

</nav>