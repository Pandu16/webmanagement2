<div id="layoutSidenav">
    <div id="layoutSidenav_nav">
        <nav class="sb-sidenav accordion sb-sidenav-dark" id="sidenavAccordion">
            <div class="sb-sidenav-menu">
                <div class="nav">
                    <div class="sb-sidenav-menu-heading">Core</div>
                    <a class="nav-link" href="index.php">
                        <div class="sb-nav-link-icon"><i class="fas fa-tachometer-alt"></i></div>
                        Dashboard
                    </a>
                    <a class="nav-link collapsed" href="#" data-bs-toggle="collapse" data-bs-target="#collapseLayouts" aria-expanded="false" aria-controls="collapseLayouts">
                        <div class="sb-nav-link-icon"><i class="fas fa-cubes"></i></div>
                        Master
                        <div class="sb-sidenav-collapse-arrow"><i class="fas fa-angle-down"></i></div>
                    </a>
                    <div class="collapse" id="collapseLayouts" aria-labelledby="headingOne" data-bs-parent="#sidenavAccordion">
                        <nav class="sb-sidenav-menu-nested nav">
                            <a class="nav-link" href="data_karyawan.php">Data Karyawan</a>
                            <a class="nav-link" href="lihat_stok.php">Lihat Stok Barang</a>
                            <a class="nav-link" href="pembelian.php">Pembelian Barang</a>
                            <a class="nav-link" href="item_baru.php">Permintaan Item Baru</a>
                            <a class="nav-link" href="permintaan.php">Permintaan Barang</a>
                        </nav>
                    </div>
                    <a class="nav-link collapsed" href="#" data-bs-toggle="collapse" data-bs-target="#laporan" aria-expanded="false" aria-controls="collapseLayouts">
                        <div class="sb-nav-link-icon"><i class="fas fa-cubes"></i></div>
                        Laporan
                        <div class="sb-sidenav-collapse-arrow"><i class="fas fa-angle-down"></i></div>
                    </a>
                    <div class="collapse" id="laporan" aria-labelledby="headingOne" data-bs-parent="#sidenavAccordion">
                        <nav class="sb-sidenav-menu-nested nav">
                            <a class="nav-link" href="stok_masuk.php">Stok Masuk</a>
                            <a class="nav-link" href="stok_keluar.php">Stok Keluar</a>
                            <a class="nav-link" href="laporan_permintaan.php">Laporan Permintaan</a>
                            <a class="nav-link" href="laporan_pembelian.php">Laporan Pembelian</a>
                        </nav>
                    </div>
                </div>
            </div>
            <div class="sb-sidenav-footer">
                <div class="small">Logged in as:</div>
                <?= $level ;?>
            </div>
        </nav>
    </div>