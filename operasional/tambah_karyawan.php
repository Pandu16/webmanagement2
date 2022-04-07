<?php
    session_start();
    $level = $_SESSION["level"];
    $nik = $_SESSION["nik"];

    require '../functions.php';

    if (isset($_POST["submit"])) {
        if (tambah_karyawan($_POST) >= 0) {
            echo "<script> alert('Data Berhasil ditambah!'); 
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
    <title>Tambah Data Karyawan</title>
</head>
<body class="sb-nav-fixed">
    <?php 
        include "view/navbar.php";
        include "view/sidebar.php";
    ?>

    <div id="layoutSidenav_content">
        <main>
            <div class="container-fluid px-4">
                <h1 class="mt-4">Tambah Data Karyawan</h1>
                <ol class="breadcrumb alert alert-dark mb-4">
                    <li class="breadcrumb-item"><a href="index.php"> Dashboard </a></li>
                    <li class="breadcrumb-item"><a href="data_karyawan.php"> Data Karyawan </a></li>
                    <li class="breadcrumb-item active"> Tambah Data Karyawan</li>
                </ol>
                <div class="row">
                    <div class="col">
                        <div class="card mb-4">
                            <div class="card-header">
                                Tambah Data Karyawan
                            </div>
                            <div class="card-body">
                                <form action="" method="POST">
                                    <div class="mb-3">
                                        <label class="form-label" for="">NIK</label>
                                        <input type="text" class="form-control" name="nik" required>
                                    </div>
                                    <div class="mb-3">
                                        <label class="form-label" for="">Nama Karyawan</label>
                                        <input type="text" class="form-control" name="nama_karyawan" required>
                                    </div>
                                    <div class="mb-3">
                                        <label class="form-label" for="">Jenis Kelamin</label>
                                        <select class="form-select" name="kelamin" id="" required>
                                            <option value="" selected hidden>Pilih Jenis Kelamin</option>
                                            <option value="Laki-Laki">Laki-Laki</option>
                                            <option value="Perempuan">Perempuan</option>
                                        </select>
                                    </div>
                                    <div class="mb-3">
                                        <label class="form-label" for="">Alamat </label>
                                        <textarea class="form-control" name="alamat" id="" cols="30" rows="10"></textarea>
                                    </div>
                                    <!-- <div class="mb-3">
                                        <label class="form-label" for="">Level</label>
                                        <select class="form-select" name="level" id="">
                                            <option value="" selected hidden>Pilih Level</option>
                                            <option value="Teknisi">Teknisi </option>
                                            <option value="Operasional">Operasional </option>
                                            <option value="Pengawas">Pengawas Lapangan </option>
                                        </select>
                                    </div> -->
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