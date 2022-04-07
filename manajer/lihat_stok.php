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
    <title>Lihat Stok</title>
</head>
<body class="sb-nav-fixed">
    <?php 
        include "view/navbar.php";
        include "view/sidebar.php";
    ?>

    <div id="layoutSidenav_content">
        <main>
            <div class="container-fluid px-4">
                <h1 class="mt-4">Lihat Stok</h1>
                <ol class="breadcrumb alert alert-dark mb-4">
                    <li class="breadcrumb-item"><a href="index.php"> Dashboard </a></li>
                    <li class="breadcrumb-item active">Lihat Stok</li>
                </ol>
                <div class="row">
                    <div class="col">
                        <div class="card mb-4">
                            <div class="card-header">
                                Lihat Stok
                            </div>
                            <div class="card-body">
                            <button class="btn btn-primary mb-3"><i class="fas fa-plus"></i> Tambah Stok Barang</button>
                                <table class="table table-striped table-bordered" id="tabel"> 
                                    <thead>
                                        <th>No</th>
                                        <th>ID Barang</th>
                                        <th>Nama Barang</th>
                                        <th>Stok</th>
                                    </thead>
                                    <tbody>
                                        <tr>
                                            <td>1</td>
                                            <td>001</td>
                                            <td>Modem</td>
                                            <td class="bg-warning">10</td>
                                        </tr>
                                        <tr>
                                            <td>2</td>
                                            <td>002</td>
                                            <td>Konektor</td>
                                            <td>400</td>
                                        </tr>
                                    </tbody>
                                </table>
                                <table>
                                    Keterangan:
                                    <tr class=""> 
                                        <td class="bg-warning"> Stok Menikis </td> 
                                        <td>  : Segera Lakukan Pemesanan</td>
                                    </tr>
                                    <tr class=""> 
                                        <td class="bg-danger"> Stok Habis </td>  
                                        <td>  : Segera Lakukan Pemesanan</td>
                                    </tr>
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