<?php
    session_start();
    $level = $_SESSION["level"];
    $nik = $_SESSION["nik"];

    require '../functions.php';

    $karyawan = query("SELECT * from tbl_karyawan");
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <?php include "view/head.php";?>
    <title>Data Karyawan</title>
</head>
<body class="sb-nav-fixed">
    <?php 
        include "view/navbar.php";
        include "view/sidebar.php";
    ?>

    <div id="layoutSidenav_content">
        <main>
            <div class="container-fluid px-4">
                <h1 class="mt-4">Data Karyawan</h1>
                <ol class="breadcrumb alert alert-dark mb-4">
                    <li class="breadcrumb-item"><a href="index.php"> Dashboard </a></li>
                    <li class="breadcrumb-item active">Data Karyawan</li>
                </ol>
                <div class="row">
                    <div class="col">
                        <div class="card mb-4">
                            <div class="card-header">
                                Data Karyawan
                            </div>
                            <div class="card-body">
                                <button class="btn btn-primary mb-3"><i class="fas fa-plus"></i><a class="text-decoration-none text-light" href="tambah_karyawan.php">  Tambah Karyawan  </a></button>
                                <button class="btn btn-primary mb-3"><i class="fas fa-plus"></i><a class="text-decoration-none text-light" href="tambah_user.php">  Tambah User  </a></button>
                                <table class="table table-striped table-bordered" id="tabel"> 
                                    <thead class="text-center">
                                        <th>No</th>
                                        <th>NIK</th>
                                        <th>Nama Karyawan</th>
                                        <th>Jenis Kelamin</th>
                                        <th>Alamat</th>
                                        <th>Action</th>
                                    </thead>
                                    <tbody>
                                    <?php $i = 1; foreach ($karyawan as $row) :?>
                                        <tr>
                                            <td><?= $i;?></td>
                                            <td><?= $row["nik"];?></td>
                                            <td><?= $row["nama_karyawan"];?></td>
                                            <td><?= $row["jenis_kelamin"];?></td>
                                            <td><?= $row["alamat"];?></td>
                                            <td class="text-center">
                                                <button class="btn btn-warning"><a class="text-decoration-none text-white" href="edit_karyawan.php?nik=<?=$row["nik"];?>"> Edit </a> </button> |
                                                <button class="btn btn-danger"><a class="text-decoration-none text-white" href="acc.php?nik=<?=$row["nik"];?>"> Hapus </a> </button> 
                                            </td>
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
  </script>
</body>
</html>