<?php
    session_start();
    $level = $_SESSION["level"];
    $nik = $_SESSION["nik"];

    require '../functions.php';
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <?php include "view/head.php";?>
    <title>Stok Keluar</title>
</head>
<body class="sb-nav-fixed">
    <?php 
        include "view/navbar.php";
        include "view/sidebar.php";
    ?>

    <div id="layoutSidenav_content">
        <main>
            <div class="container-fluid px-4">
                <h1 class="mt-4">Stok Keluar</h1>
                <ol class="breadcrumb alert alert-dark mb-4">
                    <li class="breadcrumb-item"><a href="index.php"> Dashboard </a></li>
                    <li class="breadcrumb-item active">Stok Keluar</li>
                </ol>
                <div class="row">
                    <div class="col">
                        <div class="card mb-4">
                            <div class="card-header">
                                Stok Keluar
                            </div>
                            <div class="card-body">
                                <table class="table table-striped table-bordered" id="tabel"> 
                                    <thead>
                                        <th>No</th>
                                        <th>Tanggal Keluar</th>
                                        <th>ID Barang</th>
                                        <th>Nama Barang</th>
                                        <th>Kebutuhan</th>
                                        <th>Jumlah</th>
                                        <th>Keterangan</th>
                                    </thead>
                                    <tbody>
                                        <tr>
                                            <td>1</td>
                                            <td>20-Dec-2021</td>
                                            <td>001</td>
                                            <td>Modem</td>
                                            <td>Pemasangan Baru</td>
                                            <td>1</td>
                                            <td>Pemasangan baru cipondoh</td>
                                        </tr>
                                        <tr>
                                            <td>2</td>
                                            <td>20-Dec-2021</td>
                                            <td>002</td>
                                            <td>Konektor</td>
                                            <td>Pemasangan Baru</td>
                                            <td>6</td>
                                            <td>Pemasangan baru cipondoh</td>
                                        </tr>
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