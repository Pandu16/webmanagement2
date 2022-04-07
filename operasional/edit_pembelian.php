<?php
    session_start();
    $level = $_SESSION["level"];
    $nik = $_SESSION["nik"];

    require '../functions.php';

    if(isset($_GET["hapus_pembelian"])){
        if (hapus_pembelian($_GET["hapus_pembelian"])){
            echo " <script>
                    alert('Data Dihapus!');
                    document.location.href = 'pembelian.php';
                    </script>
                ";
                exit;
    } else{
        echo "<script>alert(' Gagal Dikonfirmasi!');</script>";
        header("Location: pembelian.php");
        };
    }

    $pembelian = query("SELECT * from tbl_pembelian inner join tbl_barang on tbl_pembelian.id_barang = tbl_barang.id_barang where id_pembelian = '$_GET[id_pembelian]'")[0];
    $barang = query("SELECT * from tbl_barang");
    if (isset($_POST["submit"])) {
        if (edit_pembelian($_POST) >= 0 ) {
            echo "<script> alert('Berhasil diedit!');
                    document.location.href = 'pembelian.php';
                 </script>";
        } else {
            echo "<script> alert('Gagal diedit!');
                    document.location.href = 'pembelian.php';
                  </script>";
        }
    }
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <?php include "view/head.php";?>
    <title>Edit Pembelian</title>
</head>
<body class="sb-nav-fixed">
    <?php 
        include "view/navbar.php";
        include "view/sidebar.php";
    ?>

    <div id="layoutSidenav_content">
        <main>
            <div class="container-fluid px-4">
                        <h1 class="mt-4">Edit Pembelian</h1>
                        <ol class="breadcrumb alert alert-dark mb-4">
                            <li class="breadcrumb-item"><a href="index.php"> Dashboard </a></li>
                            <li class="breadcrumb-item"><a href="lihat_stok.php"> Barang </a></li>
                            <li class="breadcrumb-item active"> Edit Pembelian</li>
                        </ol>
                        <div class="row">
                            <div class="col">
                                <div class="card">
                                    <div class="card-header">
                                        ID Pembelian : <?=$pembelian["id_pembelian"];?>
                                    </div>
                                    <div class="card-body">
                                        <form action="" method="POST">
                                            <input type="text" value="<?= $pembelian["id_pembelian"];?>" name="id_pembelian" hidden>
                                            <div class="mb-3">
                                                <label class="form-label" for="">Nama Barang</label>
                                                <select class="form-select" name="id_barang" id="" required>
                                                    <option value="<?=$pembelian["id_barang"];?>" selected hidden><?=$pembelian["nama_barang"];?></option>
                                                    <?php foreach($barang as $row):?>
                                                        <option value="<?= $row["id_barang"];?>"><?= $row["nama_barang"];?></option>
                                                    <?php endforeach;?>
                                                </select>
                                            </div>
                                            <div class="mb-3">
                                                <label class="form-label" for="nik">Jenis Pembelian</label>
                                                <select class="form-select" name="jenis_pembelian" id="" required>
                                                    <option value="<?=$pembelian["jenis_pembelian"];?>" selected hidden><?=$pembelian["jenis_pembelian"];?></option>
                                                    <option value="Barang Baru">Pegadaan Barang Baru</option>
                                                    <option value="Barang Lama">Penambahan Stok Barang</option>
                                                </select>
                                            </div>
                                            <div class="mb-3">
                                                <label class="form-label" for="">Qty</label>
                                                <input class="form-control" type="text" name="qty" value="<?= $pembelian["qty"];?>" required>
                                            </div>
                                            <div class="mb-3">
                                                <label class="form-label" for="">Total Pembayaran</label>
                                                <div class="input-group">
                                                    <span class="input-group-text" >Rp.</span>
                                                    <input class="form-control" type="number" name="harga" value="<?= $pembelian["harga"];?>" required>
                                                </div>
                                            </div>
                                            <div class="mb-3">
                                                <label class="form-label" for="">Keterangan</label>
                                                <input class="form-control" type="text" name="keterangan" value="<?= $pembelian["keterangan"];?>" required>
                                            </div>
                                            <button class="btn btn-primary" name="submit" type="submit">Edit </button>
                                        </form>
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