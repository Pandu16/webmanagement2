<?php
    session_start();
    $level = $_SESSION["level"];
    $nik = $_SESSION["nik"];

    require '../functions.php';

    $karyawan2 = query("SELECT * from tbl_karyawan inner join tbl_user on tbl_karyawan.nik = tbl_user.nik where tbl_karyawan.nik = '$_GET[nik]'");

    if(count($karyawan2) == 0){
        echo "<script> alert('User belum ada, tidak dapat diedit!'); 
                        document.location.href = 'data_karyawan.php';
            </script>";
    }

    $karyawan = query("SELECT * from tbl_karyawan inner join tbl_user on tbl_karyawan.nik = tbl_user.nik where tbl_karyawan.nik = '$_GET[nik]'")[0];

    if (isset($_POST["submit"])) {
        if (edit_karyawan($_POST) >= 0) {
            echo "<script> alert('Data Berhasil diedit!'); 
                            document.location.href = 'data_karyawan.php';
                </script>";
            
        } else {
            echo "<script> alert('Error!'); </script>";
        }
    }
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <?php include "view/head.php";?>
    <title>Edit Data Karyawan</title>
</head>
<body class="sb-nav-fixed">
    <?php 
        include "view/navbar.php";
        include "view/sidebar.php";
    ?>

    <div id="layoutSidenav_content">
        <main>
            <div class="container-fluid px-4">
                <h1 class="mt-4">Edit Data Karyawan</h1>
                <ol class="breadcrumb alert alert-dark mb-4">
                    <li class="breadcrumb-item"><a href="index.php"> Dashboard </a></li>
                    <li class="breadcrumb-item"><a href="data_karyawan.php"> Data Karyawan </a></li>
                    <li class="breadcrumb-item active"> Edit Data Karyawan</li>
                </ol>
                <div class="row">
                    <div class="col">
                        <div class="card mb-4">
                            <div class="card-header">
                                Edit Data Karyawan
                            </div>
                            <div class="card-body">
                                <form action="" method="POST">
                                    <div class="mb-3">
                                        <label class="form-label" for="">NIK</label>
                                        <input type="text" class="form-control" name="nik" value="<?=$karyawan["nik"];?>" readonly>
                                    </div>
                                    <div class="mb-3">
                                        <label class="form-label" for="">Nama Karyawan</label>
                                        <input type="text" class="form-control" name="nama_karyawan" value="<?=$karyawan["nama_karyawan"];?>">
                                    </div>
                                    <div class="mb-3">
                                        <label class="form-label" for="">Level</label>
                                        <select class="form-select" name="level" id="">
                                            <option value="<?= $karyawan["level"];?>"><?= $karyawan["level"];?> </option>
                                            <option value="Teknisi">Teknisi </option>
                                            <option value="Operasional">Operasional </option>
                                            <option value="Pengawas">Pengawas Lapangan </option>
                                        </select>
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