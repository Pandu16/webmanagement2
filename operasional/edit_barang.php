<?php
    session_start();
    $level = $_SESSION["level"];
    $nik = $_SESSION["nik"];

    require '../functions.php';

    if(isset($_GET["id_brg"])){
        if (hapus_barang($_GET["id_brg"])){
            echo " <script>
                    alert('Data Dihapus!');
                    document.location.href = 'lihat_stok.php';
                    </script>
                ";
                exit;
    } else{
        echo "<script>alert(' Gagal Dikonfirmasi!');</script>";
        header("Location: lihat_stok.php");
        };
    }

    $barang = query("SELECT * from tbl_barang where id_barang = '$_GET[id_barang]'")[0];

    if (isset($_POST["submit"])) {
        if (edit_barang($_POST) >= 0 ) {
            echo "<script> alert('Berhasil diedit!');
                    document.location.href = 'lihat_stok.php';
                 </script>";
        } else {
            echo "<script> alert('Gagal diedit!');
                    document.location.href = 'lihat_stok.php';
                  </script>";
        }
    }
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <?php include "view/head.php";?>
    <title>Edit Barang</title>
</head>
<body class="sb-nav-fixed">
    <?php 
        include "view/navbar.php";
        include "view/sidebar.php";
    ?>

    <div id="layoutSidenav_content">
        <main>
            <div class="container-fluid px-4">
                        <h1 class="mt-4">Edit Barang</h1>
                        <ol class="breadcrumb alert alert-dark mb-4">
                            <li class="breadcrumb-item"><a href="index.php"> Dashboard </a></li>
                            <li class="breadcrumb-item"><a href="lihat_stok.php"> Barang </a></li>
                            <li class="breadcrumb-item active"> Edit Barang</li>
                        </ol>
                        <div class="row">
                            <div class="col">
                                <div class="card">
                                    <div class="card-header">
                                        Edit Barang <?= $barang["nama_barang"];?>
                                    </div>
                                    <div class="card-body">
                                        <form action="" method="POST">
                                            <div class="mb-3">
                                                <label class="form-label" for="nik">ID Barang</label>
                                                <input class="form-control" type="text" name="id_barang" value="<?= $barang["id_barang"];?>" readonly>
                                            </div>
                                            <div class="mb-3">
                                                <label class="form-label" for="">Nama Barang</label>
                                                <input class="form-control" type="text" name="nama_barang" value="<?= $barang["nama_barang"];?>">
                                            </div>
                                            <div class="mb-3">
                                                <label class="form-label" for="">Stok Total</label>
                                                <input class="form-control" type="text" name="stok_total" value="<?= $barang["stok"];?>">
                                            </div>
                                            <div class="mb-3">
                                                <label class="form-label" for="">Sisa Stok</label>
                                                <input class="form-control" type="text" name="sisa_stok" value="<?= $barang["sisa_stok"];?>">
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