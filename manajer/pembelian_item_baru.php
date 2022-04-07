<?php
    session_start();
    $level = $_SESSION["level"];
    $nik = $_SESSION["nik"];

    require '../functions.php';

    $pembelian = query("SELECT * from tbl_pembelian inner join tbl_barang on tbl_pembelian.id_barang = tbl_barang.id_barang 
                                                    inner join tbl_karyawan on tbl_pembelian.nik = tbl_karyawan.nik  
                        where jenis_pembelian = 'Barang Baru' and tbl_pembelian.status = 0");
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <?php include "view/head.php";?>
    <title>Pembelian Item Baru</title>
</head>
<body class="sb-nav-fixed">
    <?php 
        include "view/navbar.php";
        include "view/sidebar.php";
    ?>

    <div id="layoutSidenav_content">
        <main>
            <div class="container-fluid px-4">
                <h1 class="mt-4">Pembelian Item Baru</h1>
                <ol class="breadcrumb alert alert-dark mb-4">
                    <li class="breadcrumb-item"><a href="index.php"> Dashboard </a></li>
                    <li class="breadcrumb-item active">Pembelian Item Baru</li>
                </ol>
                <div class="row">
                    <div class="col">
                        <div class="card mb-4">
                            <div class="card-header">
                                Pembelian Item Baru
                            </div>
                            <div class="card-body">
                                <table class="table table-striped table-bordered" id="tabel"> 
                                    <thead>
                                        <th>No</th>
                                        <th>NIK</th>
                                        <th>Nama Barang</th>
                                        <th>Jumlah</th>
                                        <th>Harga</th>
                                        <th>Action</th>
                                    </thead>
                                    <tbody>
                                        <?php $i = 1; foreach($pembelian as $row):?>
                                            <tr>
                                                <td><?=$i;?></td>
                                                <td><?=$row["nik"];?></td>
                                                <td><?=$row["nama_barang"];?></td>
                                                <td><?=$row["qty"];?></td>
                                                <td>Rp. <?= number_format($row["harga"],0,',','.');?></td>
                                                <td>
                                                    <button class="btn btn-primary"><a class="text-decoration-none text-light" href="acc.php?setuju_pembelian=<?=$row["id_pembelian"];?>"><i class="fas fa-plus"></i> Acc </a> </button> | 
                                                    <button class="btn btn-danger" onclick="return confirm('Tolak pembelian?')"><a class="text-decoration-none text-white" href="acc.php?tolak_pembelian=<?=$row["id_pembelian"];?>"><i class="fas fa-times"></i> Tolak </a></button>
                                                </td>
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