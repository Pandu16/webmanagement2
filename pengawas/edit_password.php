<?php
    session_start();
    $level = $_SESSION["level"];
    $nik = $_SESSION["nik"];

    require '../functions.php';

    $profil = query("SELECT * from tbl_karyawan where nik = '$_GET[nik]'")[0];

    if (isset($_POST["submit"])) {
        if ($_POST["password"] != $_POST["password2"]) {
            echo "<script> alert('Konfirmasi Password Tidak Sama!');</script>";
        } else {
            if (edit_password($_POST) > 0 ) {
                echo "<script> alert('Berhasil diedit!');</script>";
            } else {
                echo "<script> alert('Gagal diedit!');</script>";
            }
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
                        <h1 class="mt-4">Edit Password</h1>
                        <ol class="breadcrumb alert alert-dark mb-4">
                            <li class="breadcrumb-item"><a href="index.php"> Dashboard </a></li>
                            <li class="breadcrumb-item"><a href="profil.php"> Profil </a></li>
                            <li class="breadcrumb-item active">Edit Password</li>
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
                                                <label class="form-label" for="nik">Password</label>
                                                <input class="form-control" type="password" name="password">
                                            </div>
                                            <div class="mb-3">
                                                <label class="form-label" for="">Konfirmasi Password </label>
                                                <input class="form-control" type="password" name="password2">
                                            </div>
                                            <button class="btn btn-primary" name="submit" type="submit">Edit Password </button>
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