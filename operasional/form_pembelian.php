<?php
    session_start();
    $level = $_SESSION["level"];
    $nik = $_SESSION["nik"];

    require '../functions.php';

    $barang = query("SELECT * from tbl_barang");

    if (isset($_GET["id_barang"])) {
        $barang2 = query("SELECT * from tbl_barang where id_barang = '$_GET[id_barang]'")[0];
    }

    if (isset($_POST["submit"])) {
        if (beli($_POST) >= 0) {
            echo "<script>
                    alert('Berhasil diajukan!');
                    document.location.href = 'pembelian.php';
                 </script>";
        } else {
            echo "<script>
                    alert('Error!');
                 </script>";
        }
    }
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
                    <li class="breadcrumb-item"><a href="pembelian.php"> Pembelian Item Yang Sudah Ada </a></li>
                    <li class="breadcrumb-item active">Form Pembelian Barang</li>
                </ol>
                <div class="row">
                    <div class="col">
                        <div class="card mb-4">
                            <div class="card-header">
                                Form Pembelian Barang
                            </div>
                            <div class="card-body">
                                <form action="" method="POST">
                                    <div class="mb-3">
                                        <label class="form-label" for="">Nama Barang</label>
                                        <select class="form-select" name="id_barang" id="" required>
                                            <?php if (isset($_GET["id_barang"])):?>
                                                <option value="<?=$barang2["id_barang"];?>" selected hidden><?=$barang2["nama_barang"];?></option>
                                            <?php else:?>
                                                <option value="" selected hidden>Pilih barang</option>
                                            <?php endif;?>
                                            <?php foreach ($barang as $row):?>
                                                    <option value="<?= $row["id_barang"];?>"><?= $row["nama_barang"];?></option>
                                            <?php endforeach;?>
                                        </select>
                                    </div>
                                    <div class="mb-3">
                                        <div class="row">
                                        <label class="form-label" for="">Qty</label>
                                            <div class="col">
                                                <input class="form-control" type="number" name="qty">
                                            </div>
                                            <div class="col">
                                                Pcs / M
                                            </div>
                                        </div>
                                    </div>
                                    <div class="mb-3">
                                        <label class="form-label" for="">Jenis Pembelian</label>
                                        <select class="form-select" name="jenis" id="" required>
                                            <?php if (isset($_GET["id_barang"])):?>
                                                <option value="Barang Baru" selected hidden>Pengadaan Barang Baru</option>
                                            <?php else:?>
                                                <option value="" selected hidden>Pilih Jenis Pembelian</option>
                                            <?php endif;?>
                                            <option value="Barang Baru">Pengadaan Barang Baru</option>
                                            <option value="Barang Lama">Penambahan Stok Barang</option>
                                        </select>
                                    </div>
                                    <div class="mb-3">
                                        <label class="form-label" for="">Total Pembayaran</label>
                                        <div class="input-group">
                                            <span class="input-group-text" >Rp.</span>
                                            <input class="form-control" type="number" name="total" required>
                                        </div>
                                    </div>
                                    <div class="mb-3">
                                        <label class="form-label" for="">Keterangan</label>
                                        <input class="form-control" type="text" name="keterangan" required>
                                    </div>
                                    <button class="btn btn-primary" type="submit" name="submit">Submit</button>
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