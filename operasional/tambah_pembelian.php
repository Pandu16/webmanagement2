<?php
    session_start();
    $level = $_SESSION["level"];
    $nik = $_SESSION["nik"];

    require '../functions.php';
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <?php include "view/head.php";?>
    <title>Pembelian Barang</title>
</head>
<body class="sb-nav-fixed">
    <?php 
        include "view/navbar.php";
        include "view/sidebar.php";
    ?>

    <div id="layoutSidenav_content">
        <main>
            <div class="container-fluid px-4">
                <h1 class="mt-4">Pembelian Barang</h1>
                <ol class="breadcrumb alert alert-dark mb-4">
                    <li class="breadcrumb-item"><a href="index.php"> Dashboard </a></li>
                    <li class="breadcrumb-item active">Pembelian Barang</li>
                </ol>
                <div class="row">
                    <div class="col">
                        <div class="card mb-4">
                            <div class="card-header">
                                Pembelian Barang
                            </div>
                            <div class="card-body">
                                <form action="" method="POST">
                                    <button class="btn btn-primary mb-3" type="submit" name="lama"> Barang Yang Sudah Ada</button>
                                    <button class="btn btn-success mb-3" type="submit" name="baru"> Barang Baru</button>
                                </form>
                                <?php if(isset($_POST["lama"]) ):?>
                                    <div class="alert alert-primary">
                                        <h5>Permintaan Barang Yang Sudah Ada</h5>
                                    </div>
                                    <form action="" method="POST">
                                        <div class="row mb-3">
                                            <div class="col">
                                            <label class="form-label" for="">Nama Barang</label>
                                                <select class="form-select" name="id_barang" id="">
                                                    <option value="">Pilih Barang</option>
                                                </select>
                                            </div>
                                            <div class="col">
                                                <label class="form-label" for="">Qty</label>
                                                <input class="form-control" type="text">
                                            </div>
                                        </div>
                                        <div class="row mb-3">
                                            <div class="col">
                                                <label class="form-label" for="">Keterangan</label>
                                                <input class="form-control" type="text">
                                            </div>
                                        </div>
                                        <button class="btn btn-primary">Submit</button>
                                    </form>
                                <?php elseif (isset($_POST["baru"])) :?>
                                    <div class="alert alert-success">
                                        <h5>Permintaan Barang Baru</h5>
                                    </div>
                                    <form action="" method="POST">
                                        <div class="row mb-3">
                                            <div class="col">
                                                <label class="form-label" for="">Nama Barang</label>
                                                <input class="form-control" type="text">
                                            </div>
                                            <div class="col">
                                                <label class="form-label" for="">Qty</label>
                                                <input class="form-control" type="text">
                                            </div>
                                            <div class="row mb-3">
                                                <div class="col">
                                                    <label class="form-label" for="">Keterangan</label>
                                                    <input class="form-control" type="text">
                                                </div>
                                            </div>
                                        </div>
                                        <button class="btn btn-primary">Submit</button>
                                    </form>
                                <?php endif;?>
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