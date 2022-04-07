<?php
    session_start();
    $level = $_SESSION["level"];
    $nik = $_SESSION["nik"];

    require '../functions.php';

    $pembelian = query("SELECT * from tbl_pembelian inner join tbl_barang on tbl_pembelian.id_barang = tbl_barang.id_barang where jenis_pembelian = 'Barang Lama' and status < 3 ");
    $menunggu_acc = query("SELECT * from tbl_pembelian inner join tbl_barang on tbl_pembelian.id_barang = tbl_barang.id_barang where status = 0 and jenis_pembelian = 'Barang Lama' ");
    $disetujui = query("SELECT * from tbl_pembelian inner join tbl_barang on tbl_pembelian.id_barang = tbl_barang.id_barang where status = 1 and jenis_pembelian = 'Barang Lama' ");
    $proses = query("SELECT * from tbl_pembelian inner join tbl_barang on tbl_pembelian.id_barang = tbl_barang.id_barang where status = 2 and jenis_pembelian = 'Barang Lama' ");
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
                    <button class="btn btn-primary mb-3"><i class="fas fa-plus"></i> <a class="text-decoration-none text-light" href="form_pembelian.php">Beli barang</a> </button>
                        <div class="card mb-4">
                            <div class="card-header">
                                Proses Pembelian 
                            </div>
                            <div class="card-body">
                                <table class="table table-striped table-bordered" id="tabel"> 
                                    <thead>
                                        <th>No</th>
                                        <th>ID Barang</th>
                                        <th>Nama Barang</th>
                                        <th>Jumlah</th>
                                        <th>Harga</th>
                                        <th>Status</th>
                                        <th>Action</th>
                                    </thead>
                                    <tbody>
                                        <?php $i = 1; foreach ($pembelian as $row):?>
                                            <tr>
                                                <td><?=$i;?></td>
                                                <td><?=$row["id_barang"];?></td>
                                                <td><?=$row["nama_barang"];?></td>
                                                <td><?=$row["qty"];?></td>
                                                <td>Rp. <?= number_format($row["harga"],0,',','.');?></td>
                                                <?php if($row["status"] == 0):?>
                                                    <td class="bg-warning opacity-75">Menunggu Persetujuan Manajer</td>
                                                    <td>
                                                        <button class="btn btn-warning"><a class="text-decoration-none text-dark" href="edit_pembelian.php?id_pembelian=<?=$row["id_pembelian"];?>"><i class="fas fa-pen"></i></a></button> | 
                                                        <button class="btn btn-danger" onclick="return confirm('Hapus Pembelian?')"><a class="text-decoration-none text-dark" href="edit_pembelian.php?hapus_pembelian=<?=$row["id_pembelian"];?>"><i class="fas fa-trash"></i></a></button>
                                                    </td>
                                                <?php elseif($row["status"] == 1):?>
                                                    <td class="bg-primary">Disetujui</td>
                                                    <td><button class="btn btn-primary"><a class="text-decoration-none text-light" href="acc.php?lanjut=<?=$row["id_pembelian"];?>"><i class="fas fa-check"></i> Lanjutkan</a></button> </td>
                                                <?php elseif($row["status"] == 2):?>
                                                    <td class="bg-success">Sedang Dipesan</td>
                                                    <td><button class="btn btn-success"><a class="text-decoration-none text-light" href="acc.php?selesai=<?=$row["id_pembelian"];?>"><i class="fas fa-check"></i> Selesai</a></button> </td>
                                                <?php elseif($row["status"] == -1):?>
                                                    <td class="bg-danger">Ditolak</td>
                                                    <td><button class="btn btn-danger"><a class="text-decoration-none text-light" href="acc.php?hapus_lama=<?=$row["id_pembelian"];?>"><i class="fas fa-times"></i> Hapus</a></button> </td>
                                                <?php endif;?>
                                            </tr>
                                        <?php $i++ ; endforeach;?>
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
    $(document).ready( function () {
        $('#tabel2').DataTable( {} );
    } );
    $(document).ready( function () {
        $('#tabel3').DataTable( {} );
    } );
  </script>
</body>
</html>