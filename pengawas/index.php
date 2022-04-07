<?php
    session_start();
    $level = $_SESSION["level"];
    $nik = $_SESSION["nik"];

    require '../functions.php';

    $user = query("SELECT * from tbl_karyawan where nik = '$nik'")[0];
    $tgl_awal = date("Y-m-1");
    $tgl_akhir = date("Y-m-31");
    
    $stok_keluar = query("SELECT *, sum(qty) as c from tbl_keluar where nik = '$nik' and tgl_keluar between '$tgl_awal' and '$tgl_akhir' ");
    $stok_masuk = query("SELECT *, sum(qty) as c from tbl_masuk where nik = '$nik' and status = 9 and tgl_masuk between '$tgl_awal' and '$tgl_akhir' ");
    $pembelian = query("SELECT *, count(*) as c, sum(harga) as a from tbl_pembelian where status = 3 and tanggal_pembelian between '$tgl_awal' and '$tgl_akhir'");
    $permintaan = query("SELECT *, count(*) as c from tbl_permintaan where nik = '$nik' and status = 0 ");
    $stok = query("SELECT * from stok_pengawas inner join tbl_barang on stok_pengawas.id_barang = tbl_barang.id_barang where nik = '$nik'")

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <?php include "view/head.php";?>
    <title>Dashboard</title>
</head>
<body class="sb-nav-fixed">
    <?php 
        include "view/navbar.php";
        include "view/sidebar.php";
    ?>

    <div id="layoutSidenav_content">
        <main>
            <div class="container-fluid px-4">
                        <h1 class="mt-4">Dashboard</h1>
                        <ol class="breadcrumb alert alert-dark mb-4">
                            <li class="breadcrumb-item active">Dashboard</li>
                        </ol>
                        <div class="row">
                            <div class="col-3">
                                <div class="card bg-primary text-white mb-4">
                                    <div class="card-header">
                                        Permintaan Menunggu Konfirmasi
                                    </div>
                                    <div class="card-body">
                                        <div class="fs-3 text-center">
                                            <?= $permintaan[0]["c"];?>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="col-3">
                                <div class="card bg-info text-white mb-4">
                                    <div class="card-header">
                                        Stok Masuk Bulan Ini
                                    </div>
                                    <div class="card-body">
                                        <div class="fs-3 text-center">
                                            <?= $stok_masuk[0]["c"];?>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="col-3">
                                <div class="card bg-danger text-white mb-4">
                                    <div class="card-header">
                                        Stok Keluar Bulan Ini
                                    </div>
                                    <div class="card-body">
                                        <div class="fs-3 text-center">
                                            <?= $stok_keluar[0]["c"];?>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col">
                            <div class="card mb-4">
                                <div class="card-header">
                                    Stok <?= $user["nama_karyawan"];?> (<?=$level;?>)
                                </div>
                                <div class="card-body">
                                    <table class="table table-striped table-bordered" id="tabel"> 
                                        <thead>
                                            <th>No</th>
                                            <th>ID Barang</th>
                                            <th>Nama Barang</th>
                                            <th>Stok</th>
                                        </thead>
                                        <tbody>
                                        <?php $i = 1; foreach ($stok as $row) :?>
                                            <tr>
                                                <td><?=$i;?></td>
                                                <td><?=$row["id_barang"];?></td>
                                                <td><?=$row["nama_barang"];?></td>
                                                <td><?=$row["stok_pengawas"];?></td>
                                            </tr>
                                        <?php $i++; endforeach;?>
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                        </div>
                    </div>
            </div>
        </main>
    </div>
<?php include "view/foot.php";?>
<script>
    $(document).ready( function () {
    $('#tabel').DataTable( {} );
    } );
  </script>
</body>
</html>