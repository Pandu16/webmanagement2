<?php
    session_start();
    $level = $_SESSION["level"];
    $nik = $_SESSION["nik"];

    require '../functions.php';

$pembelian = query("SELECT *, sum(harga) as a from tbl_pembelian inner join tbl_barang on tbl_pembelian.id_barang = tbl_barang.id_barang");
$today = date("Y-m-d");
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <?php include "view/head.php";?>
    <title>Laporan Pembelian</title>
</head>
<body class="sb-nav-fixed">
    <?php 
        include "view/navbar.php";
        include "view/sidebar.php";
    ?>

    <div id="layoutSidenav_content">
        <main>
            <div class="container-fluid px-4">
                <h1 class="mt-4">Laporan Pembelian</h1>
                <ol class="breadcrumb alert alert-dark mb-4">
                    <li class="breadcrumb-item"><a href="index.php"> Dashboard </a></li>
                    <li class="breadcrumb-item active">Laporan Pembelian</li>
                </ol>
                <div class="row">
                    <div class="col">
                        <div class="card mb-4">
                            <div class="card-header">
                                Laporan Pembelian
                            </div>
                            <div class="card-body">
                                <table class="table table-striped table-bordered" id="tabel"> 
                                    <thead>
                                        <th>No</th>
                                        <th>Tanggal Pembelian</th>
                                        <th>ID Barang</th>
                                        <th>Nama Barang</th>
                                        <th>Jenis Pembelian</th>
                                        <th>Jumlah</th>
                                        <th>Keterangan</th>
                                        <th>Harga</th>
                                    </thead>
                                    <tbody>
                                        <?php $i = 1; foreach ($pembelian as $row):?>
                                            <tr>
                                                <td><?= $i;?></td>
                                                <td><?= $row["tanggal_pembelian"];?></td>
                                                <td><?= $row["id_barang"];?></td>
                                                <td><?= $row["nama_barang"];?></td>
                                                <td><?= $row["jenis_pembelian"];?></td>
                                                <td><?= $row["qty"];?></td>
                                                <td><?= $row["keterangan"];?></td>
                                                <td>Rp. <?= number_format($row["harga"],0,',','.');?></td>
                                            </tr>
                                        <?php $i++; endforeach;?>
                                    </tbody>
                                    <tfoot>
                                        <tr class="bg-primary">
                                            <td class="text-end" colspan="7">Total</td>
                                            <td>Rp. <?= number_format($pembelian[0]["a"],0,',','.');?></td>
                                        </tr>
                                    </tfoot>
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
            title: 'Laporan Pembelian per: <?= $today;?>',
          },
          {
            extend: 'print',
            title: '<h6>Laporan Pembelian per: <?= $today;?> </h6>',
            
          }
        ]

    } );
    } );
  </script>
</body>
</html>