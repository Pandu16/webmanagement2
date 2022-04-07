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
    <title>Pembelian Item Yang Sudah Ada</title>
</head>
<body class="sb-nav-fixed">
    <?php 
        include "view/navbar.php";
        include "view/sidebar.php";
    ?>

    <div id="layoutSidenav_content">
        <main>
            <div class="container-fluid px-4">
                <h1 class="mt-4">Pembelian Item Yang Sudah Ada</h1>
                <ol class="breadcrumb alert alert-dark mb-4">
                    <li class="breadcrumb-item"><a href="index.php"> Dashboard </a></li>
                    <li class="breadcrumb-item active">Pembelian Item Yang Sudah Ada</li>
                </ol>
                <div class="row">
                    <div class="col">
                        <div class="card mb-4">
                            <div class="card-header">
                                Permintaan Pembelian Item Yang Sudah Ada
                            </div>
                            <div class="card-body">
                                <button class="btn btn-primary mb-3"><i class="fas fa-plus"></i> Tambah Stok Barang</button>
                                <table class="table table-striped table-bordered" id="tabel"> 
                                    <thead>
                                        <th>No</th>
                                        <th>ID Barang</th>
                                        <th>Nama Barang</th>
                                        <th>Jumlah</th>
                                        <th>Harga</th>
                                        <th>Action</th>
                                    </thead>
                                    <tbody>
                                        <tr>
                                            <td>1</td>
                                            <td>1</td>
                                            <td>Modem</td>
                                            <td>3</td>
                                            <td>Rp. 300.000</td>
                                            <td>
                                                <button class="btn btn-primary"> Beli </button> |
                                                <button class="btn btn-danger"> Tolak </button> 
                                            </td>
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