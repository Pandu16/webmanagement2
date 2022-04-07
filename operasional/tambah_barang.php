<?php
    session_start();
    $level = $_SESSION["level"];
    $nik = $_SESSION["nik"];

    require '../functions.php';

    if (isset($_POST["submit"])) {
        if (tambah_barang($_POST) >= 0) {
            echo "<script> alert('Data Berhasil ditambah!'); </script>";
            if(isset($_GET["barang"])) {
                $barang = $_GET["barang"];
                $id_barang = query("SELECT * from tbl_barang where nama_barang = '$barang'")[0]["id_barang"];
                echo "<script>document.location.href = 'form_pembelian.php?id_barang=$id_barang';</script>";
            } else {
                echo "<script>document.location.href = 'lihat_stok.php';</script>";
            }
        } else {
            echo "<script> alert('Error!'); </script>";
        }
    }
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <?php include "view/head.php";?>
    <title>Tambah Barang</title>
</head>
<body class="sb-nav-fixed">
    <?php 
        include "view/navbar.php";
        include "view/sidebar.php";
    ?>

    <div id="layoutSidenav_content">
        <main>
            <div class="container-fluid px-4">
                <h1 class="mt-4">Tambah Barang</h1>
                <ol class="breadcrumb alert alert-dark mb-4">
                    <li class="breadcrumb-item"><a href="index.php"> Dashboard </a></li>
                    <li class="breadcrumb-item"><a href="lihat_stok.php"> Lihat Stok </a></li>
                    <li class="breadcrumb-item active"> Tambah Barang</li>
                </ol>
                <div class="row">
                    <div class="col">
                        <div class="card mb-4">
                            <div class="card-header">
                                Tambah Barang
                            </div>
                            <div class="card-body">
                                <form action="" method="POST">
                                    <div class="mb-3">
                                        <label class="form-label" for="">Nama Barang</label>
                                        <?php if (isset($_GET["barang"])):?>
                                            <input type="text" class="form-control" name="nama_barang" value="<?=$_GET["barang"];?>" required>
                                        <?php else:?>
                                            <input type="text" class="form-control" name="nama_barang" required>
                                        <?php endif;?>
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