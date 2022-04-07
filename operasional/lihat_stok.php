<?php
    session_start();
    $level = $_SESSION["level"];
    $nik = $_SESSION["nik"];

    require '../functions.php';
    $stok = query("SELECT * from tbl_barang")
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
                            <button class="btn btn-primary mb-3"><i class="fas fa-plus"></i><a class="text-decoration-none text-light" href="tambah_barang.php"> Tambah Barang </a></button>
                                <table class="table table-striped table-bordered" id="tabel"> 
                                    <thead>
                                        <th>No</th>
                                        <th>ID Barang</th>
                                        <th>Nama Barang</th>
                                        <th>Stok</th>
                                        <th>Action</th>
                                    </thead>
                                    <tbody>
                                    <?php $i = 1; foreach ($stok as $row) :?>
                                        <tr>
                                            <td><?=$i;?></td>
                                            <td><?=$row["id_barang"];?></td>
                                            <td><?=$row["nama_barang"];?></td>
                                            <?php if($row["sisa_stok"] <= 0):?>
                                                <td class="bg-danger"><?=$row["sisa_stok"];?></td>
                                            <?php elseif($row["sisa_stok"] < 50):?>
                                                <td class="bg-warning"><?=$row["sisa_stok"];?></td>
                                            <?php else :?>
                                                <td><?=$row["sisa_stok"];?></td>
                                            <?php endif;?>
                                            <td class="text-center">
                                                <button class="btn btn-warning"><a class="text-decoration-none text-dark" href="edit_barang.php?id_barang=<?=$row["id_barang"];?>"><i class="fas fa-pen"></i></a></button> | 
                                                <button class="btn btn-danger"><a class="text-decoration-none text-dark" href="edit_barang.php?id_brg=<?=$row["id_barang"];?>"><i class="fas fa-trash"></i></a></button>
                                            </td>
                                        </tr>
                                    <?php $i++; endforeach;?>
                                    </tbody>
                                </table>
                                <table>
                                    Keterangan:
                                    <tr class=""> 
                                        <td class="bg-warning alert alert-warning"> Stok Menipis </td> 
                                        <td>  : Segera Lakukan Pemesanan</td>
                                    </tr>
                                    <tr class=""> 
                                        <td class="bg-danger alert alert-danger"> Stok Habis </td>  
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