<?php
    session_start();
    $level = $_SESSION["level"];
    $nik = $_SESSION["nik"];

    require '../functions.php';

    $profil = query("SELECT * from tbl_karyawan where nik = '$_GET[nik]'")[0];

    if (isset($_POST["submit"])) {
        if (edit_profil($_POST) > 0 ) {
            echo "<script> alert('Berhasil diedit!');</script>";
        } else {
            echo "<script> alert('Gagal diedit!');</script>";
        }
    }
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <?php include "view/head.php";?>
    <title>Profil</title>
</head>
<body class="sb-nav-fixed">
    <?php 
        include "view/navbar.php";
        include "view/sidebar.php";
    ?>

    <div id="layoutSidenav_content">
        <main>
            <div class="container-fluid px-4">
                        <h1 class="mt-4">Edit Profil</h1>
                        <ol class="breadcrumb alert alert-dark mb-4">
                            <li class="breadcrumb-item"><a href="index.php"> Dashboard </a></li>
                            <li class="breadcrumb-item"><a href="profil.php"> Profil </a></li>
                            <li class="breadcrumb-item active"> Edit Profil</li>
                        </ol>
                        <div class="row">
                            <div class="col">
                                <div class="card">
                                    <div class="card-header">
                                        Profil <?= $profil["nama_karyawan"];?>
                                    </div>
                                    <div class="card-body">
                                        <form action="" method="POST">
                                            <div class="mb-3">
                                                <label class="form-label" for="nik">NIK</label>
                                                <input class="form-control" type="text" name="nik" value="<?= $profil["nik"];?>" readonly>
                                            </div>
                                            <div class="mb-3">
                                                <label class="form-label" for="">Nama</label>
                                                <input class="form-control" type="text" name="nama" value="<?= $profil["nama_karyawan"];?>">
                                            </div>
                                            <div class="mb-3">
                                                <label class="form-label" for="">Jenis Kelamin</label>
                                                <select class="form-select" name="kelamin" id="">
                                                    <option value="<?= $profil["jenis_kelamin"];?>"><?= $profil["jenis_kelamin"];?></option>
                                                    <option value="Laki-Laki">Laki-Laki</option>
                                                    <option value="Perempuan">Perempuan</option>
                                                </select>
                                            </div>
                                            <div class="mb-3">
                                                <label class="form-label" for="">Alamat</label>
                                                <input class="form-control" type="text" name="alamat" value="<?= $profil["alamat"];?>">
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