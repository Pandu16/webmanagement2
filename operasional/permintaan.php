<?php
    session_start();
    $level = $_SESSION["level"];
    $nik = $_SESSION["nik"];

    require '../functions.php';

$permintaan = query("SELECT * from tbl_permintaan inner join tbl_barang on tbl_permintaan.id_barang = tbl_barang.id_barang where status = 0");
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <?php include "view/head.php";?>
    <title>Permintaan Item Yang Sudah Ada</title>
</head>
<body class="sb-nav-fixed">
    <?php 
        include "view/navbar.php";
        include "view/sidebar.php";
    ?>

    <div id="layoutSidenav_content">
        <main>
            <div class="container-fluid px-4">
                <h1 class="mt-4">Permintaan Item Yang Sudah Ada</h1>
                <ol class="breadcrumb alert alert-dark mb-4">
                    <li class="breadcrumb-item"><a href="index.php"> Dashboard </a></li>
                    <li class="breadcrumb-item active">Permintaan Item Yang Sudah Ada</li>
                </ol>
                <div class="row">
                    <div class="col">
                        <div class="card mb-4">
                            <div class="card-header">
                                Permintaan Item Yang Sudah Ada
                            </div>
                            <div class="card-body">
                                <table class="table table-striped table-bordered" id="tabel"> 
                                    <thead>
                                        <th>No</th>
                                        <th>Tanggal</th>
                                        <th>ID Barang</th>
                                        <th>Nama Barang</th>
                                        <th>Jumlah</th>
                                        <th>Keterangan</th>
                                        <th>Action</th>
                                    </thead>
                                    <tbody>
                                        <?php $i= 1; foreach ($permintaan as $row):?>
                                            <tr>
                                                <td><?= $i;?></td>
                                                <td><?= $row["tgl_permintaan"];?></td>
                                                <td><?= $row["id_barang"];?></td>
                                                <td><?= $row["nama_barang"];?></td>
                                                <td><?= $row["qty"];?></td>
                                                <td><?= $row["keterangan"];?></td>
                                                <td>
                                                    <button class="btn btn-primary"><a class="text-decoration-none text-white" href="acc.php?acc_permintaan=<?=$row["id_permintaan"];?>&barang=<?=$row["id_barang"];?>&qty=<?=$row["qty"];?>&pengawas=<?=$row["nik"];?>"> Acc </a></button> | 
                                                    <button class="btn btn-danger" onclick="return confirm('Tolak Permintaan?')"><a class="text-decoration-none text-white" href="acc.php?tolak_permintaan=<?=$row["id_permintaan"];?>"> Tolak </a></button>
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