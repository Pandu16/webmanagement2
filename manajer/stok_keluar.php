<?php
    session_start();
    $level = $_SESSION["level"];
    $nik = $_SESSION["nik"];

    require '../functions.php';

$stok = query("SELECT * from tbl_keluar inner join tbl_barang on tbl_keluar.id_barang = tbl_barang.id_barang");
$today = date("Y-m-d");
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
                                        <?php $i = 1; foreach ($stok as $row):?>
                                            <tr>
                                                <td><?= $i;?></td>
                                                <td><?= $row["tgl_keluar"];?></td>
                                                <td><?= $row["id_barang"];?></td>
                                                <td><?= $row["nama_barang"];?></td>
                                                <td><?= $row["kebutuhan"];?></td>
                                                <td><?= $row["qty"];?></td>
                                                <td><?= $row["keterangan"];?></td>
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
        $('#tabel').DataTable( {
        dom: 'lBfrtip',
        lengthMenu: [
                  [10, 25, 50, -1],
                  ['10', '25', '50', 'Tampilkan semua']
              ],
        buttons: [
          {
            extend: 'pdfHtml5',
            text: 'Save as pdf',
            title: 'Laporan Barang Keluar per: <?= $today;?>',
          },
          {
            extend: 'print',
            title: '<h6>Laporan Barang Keluar per: <?= $today;?> </h6>',
            
          }
        ]

    } );
    } );
  </script>
</body>
</html>