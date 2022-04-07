<?php
    session_start();
    $level = $_SESSION["level"];
    $nik = $_SESSION["nik"];

    require '../functions.php';

    $permintaan = query("SELECT * from tbl_permintaan_baru inner join tbl_karyawan on tbl_permintaan_baru.nik = tbl_karyawan.nik where status = 0");
    $pembelian = query("SELECT * from tbl_pembelian inner join tbl_barang on tbl_pembelian.id_barang = tbl_barang.id_barang where status < 3 and jenis_pembelian = 'Barang Baru'");
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <?php include "view/head.php";?>
    <title>Permintaan Item Baru</title>
</head>
<body class="sb-nav-fixed">
    <?php 
        include "view/navbar.php";
        include "view/sidebar.php";
    ?>

    <div id="layoutSidenav_content">
        <main>
            <div class="container-fluid px-4">
                <h1 class="mt-4">Permintaan Item Baru</h1>
                <ol class="breadcrumb alert alert-dark mb-4">
                    <li class="breadcrumb-item"><a href="index.php"> Dashboard </a></li>
                    <li class="breadcrumb-item active">Permintaan Item Baru</li>
                </ol>
                <div class="row">
                    <div class="col">
                        <div class="card mb-4">
                            <div class="card-header">
                                Permintaan Item Baru
                            </div>
                            <div class="card-body">
                                <table class="table table-striped table-bordered" id="tabel"> 
                                    <thead>
                                        <th>No</th>
                                        <th>Pengaju</th>
                                        <th>Nama Barang</th>
                                        <th>Jumlah</th>
                                        <th>Keterangan</th>
                                        <th>Action</th>
                                    </thead>
                                    <tbody>
                                    <?php $i = 1; foreach ($permintaan as $row):?>
                                        <tr>
                                            <td><?=$i;?></td>
                                            <td><?=$row["nama_karyawan"];?></td>
                                            <td><?=$row["nama_barang"];?></td>
                                            <td><?=$row["qty"];?></td>
                                            <td><?=$row["keterangan"];?></td>
                                            <td>
                                                <button class="btn btn-primary"><i class="fas fa-plus"></i><a class="text-decoration-none text-light" href="acc.php?terima_baru=<?=$row["id_permintaan_baru"];?>&barang=<?=$row["nama_barang"];?>"> Pembelian Item Baru</a>  </button>
                                                <button class="btn btn-danger" onclick="return confirm('Tolak permintaan?')"><a class="text-decoration-none text-light" href="acc.php?tolak_baru=<?=$row["id_permintaan_baru"];?>"> Tolak </a>  </button>
                                            </td>
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
                                Pembelian Barang Baru
                            </div>
                            <div class="card-body">
                                <table class="table table-striped table-bordered" id="tabel2"> 
                                    <thead>
                                        <th>No</th>
                                        <th>Nama Barang</th>
                                        <th>Jumlah</th>
                                        <th>Harga</th>
                                        <th>Status</th>
                                        <th>Action</th>
                                    </thead>
                                    <tbody>
                                        <?php $i=1; foreach ($pembelian as $row):?>
                                            <tr>
                                                <td><?=$i;?></td>
                                                <td><?=$row["nama_barang"];?></td>
                                                <td><?=$row["qty"];?></td>
                                                <td>Rp. <?= number_format($row["harga"],0,',','.');?></td>
                                                <?php if($row["status"] == 0):?>
                                                    <td class="bg-warning opacity-75">Menunggu Persetujuan Manajer</td>
                                                    <td>
                                                        <button class="btn btn-warning"><a class="text-decoration-none text-dark" href="edit_item_baru.php?id_pembelian=<?=$row["id_pembelian"];?>"><i class="fas fa-pen"></i> </a></button> |
                                                        <button class="btn btn-danger" onclick="return confirm('Hapus Pembelian?')"><a class="text-decoration-none text-dark" href="edit_item_baru.php?hapus_pembelian=<?=$row["id_pembelian"];?>"><i class="fas fa-trash"></i></a></button>
                                                    </td>
                                                <?php elseif($row["status"] == 1):?>
                                                    <td class="bg-success">Disetujui</td>
                                                    <td><button class="btn btn-primary"><a class="text-decoration-none text-light" href="acc.php?lanjut_baru=<?=$row["id_pembelian"];?>"><i class="fas fa-check"></i> Lanjutkan</a></button> </td>
                                                <?php elseif($row["status"] == 2):?>
                                                    <td class="bg-warning">Sedang Dipesan</td>
                                                    <td><button class="btn btn-primary"><a class="text-decoration-none text-light" href="acc.php?selesai_baru=<?=$row["id_pembelian"];?>"><i class="fas fa-check"></i> Selesai</a></button> </td>
                                                <?php elseif($row["status"] == -1):?>
                                                    <td class="bg-danger">Ditolak</td>
                                                    <td><button class="btn btn-danger"><a class="text-decoration-none text-light" href="acc.php?hapus_baru=<?=$row["id_pembelian"];?>"><i class="fas fa-times"></i> Hapus</a></button> </td>
                                                <?php endif;?>
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
    $(document).ready( function () {
    $('#tabel2').DataTable( {} );
    } )
  </script>
</body>
</html>