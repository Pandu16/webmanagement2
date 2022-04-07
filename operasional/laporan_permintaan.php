<?php
    session_start();
    $level = $_SESSION["level"];
    $nik = $_SESSION["nik"];

    require '../functions.php';

$permintaan = query("SELECT * from tbl_permintaan inner join tbl_barang on tbl_permintaan.id_barang = tbl_barang.id_barang inner join tbl_karyawan on tbl_permintaan.nik = tbl_karyawan.nik where status = 1");
$permintaan_baru = query("SELECT * from tbl_permintaan_baru inner join tbl_karyawan on tbl_permintaan_baru.nik = tbl_karyawan.nik where status >= 1");
$today = date("Y-m-d");
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <?php include "view/head.php";?>
    <title>Laporan Permintaan</title>
</head>
<body class="sb-nav-fixed">
    <?php 
        include "view/navbar.php";
        include "view/sidebar.php";
    ?>

    <div id="layoutSidenav_content">
        <main>
            <div class="container-fluid px-4">
                <h1 class="mt-4">Laporan Permintaan</h1>
                <ol class="breadcrumb alert alert-dark mb-4">
                    <li class="breadcrumb-item"><a href="index.php"> Dashboard </a></li>
                    <li class="breadcrumb-item active">Laporan Permintaan</li>
                </ol>
                <div class="row">
                    <div class="col">
                        <div class="card mb-4">
                            <div class="card-header">
                                Laporan Permintaan
                            </div>
                            <div class="card-body">
                                <table class="table table-striped table-bordered" id="tabel"> 
                                    <thead>
                                        <th>No</th>
                                        <th>Tanggal Permintaan</th>
                                        <th>Nama Pengaju</th>
                                        <th>Nama Barang</th>
                                        <th>Jumlah</th>
                                        <th>Keterangan</th>
                                    </thead>
                                    <tbody>
                                        <?php $i = 1; foreach ($permintaan as $row):?>
                                            <tr>
                                                <td><?= $i;?></td>
                                                <td><?= $row["tgl_permintaan"];?></td>
                                                <td><?= $row["nama_karyawan"];?></td>
                                                <td><?= $row["nama_barang"];?></td>
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
                <div class="row">
                    <div class="col">
                        <div class="card mb-4">
                            <div class="card-header">
                                Laporan Permintaan Barang Baru
                            </div>
                            <div class="card-body">
                                <table class="table table-striped table-bordered" id="tabel2"> 
                                    <thead>
                                        <th>No</th>
                                        <th>Tanggal Permintaan</th>
                                        <th>Nama Pengaju</th>
                                        <th>Nama Barang</th>
                                        <th>Jumlah</th>
                                        <th>Keterangan</th>
                                    </thead>
                                    <tbody>
                                        <?php $i = 1; foreach ($permintaan_baru as $row):?>
                                            <tr>
                                                <td><?= $i;?></td>
                                                <td><?= $row["tgl_permintaan_baru"];?></td>
                                                <td><?= $row["nama_karyawan"];?></td>
                                                <td><?= $row["nama_barang"];?></td>
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
            title: 'Laporan Permintaan Barang per: <?= $today;?>',
          },
          {
            extend: 'print',
            title: '<h6>Laporan Permintaan Barang per: <?= $today;?> </h6>',
            
          }
        ]

    } );
    } );
  </script>
  <script>
    $(document).ready( function () {
        $('#tabel2').DataTable( {
        dom: 'lBfrtip',
        lengthMenu: [
                  [10, 25, 50, -1],
                  ['10', '25', '50', 'Tampilkan semua']
              ],
        buttons: [
          {
            extend: 'pdfHtml5',
            text: 'Save as pdf',
            title: 'Laporan Permintaan Barang Baru per: <?= $today;?>',
          },
          {
            extend: 'print',
            title: '<h6>Laporan Permintaan Barang Baru per: <?= $today;?> </h6>',
            
          }
        ]

    } );
    } );
  </script>
</body>
</html>