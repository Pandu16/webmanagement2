<?php
    session_start();
    $level = $_SESSION["level"];
    $nik = $_SESSION["nik"];

    require '../functions.php';

    $profil = query("SELECT * from tbl_karyawan where nik = '$nik'")[0];
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
                        <h1 class="mt-4">Profil</h1>
                        <ol class="breadcrumb alert alert-dark mb-4">
                            <li class="breadcrumb-item"><a href="index.php"> Dashboard </a></li>
                            <li class="breadcrumb-item active">Profil</li>
                        </ol>
                        <div class="row">
                            <div class="col">
                                <div class="card">
                                    <div class="card-header">
                                        Profil <?= $profil["nama_karyawan"];?>
                                    </div>
                                    <div class="card-body">
                                        <table class="table">
                                            <tr>
                                                <td>NIK</td>
                                                <td>:</td>
                                                <td><?= $profil["nik"];?></td>
                                            </tr>
                                            <tr>
                                                <td>Nama Karyawan</td>
                                                <td>:</td>
                                                <td><?= $profil["nama_karyawan"];?></td>
                                            </tr>
                                            <tr>
                                                <td>Jenis Kelamin</td>
                                                <td>:</td>
                                                <td><?= $profil["jenis_kelamin"];?></td>
                                            </tr>
                                            <tr>
                                                <td>Alamat</td>
                                                <td>:</td>
                                                <td><?= $profil["alamat"];?></td>
                                            </tr>
                                        </table>
                                        <button class="btn btn-warning"><a href="edit_profil.php?nik=<?=$profil["nik"];?>"> Edit Profil </a></button>
                                        <button class="btn btn-warning"><a href="edit_password.php?nik=<?=$profil["nik"];?>">Edit Password</a></button>
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