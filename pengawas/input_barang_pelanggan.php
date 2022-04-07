<?php
    session_start();
    $level = $_SESSION["level"];
    $nik = $_SESSION["nik"];

    require '../functions.php';

$barang = query("SELECT * from tbl_barang");

// Jika tombol submit ditekan
if (isset($_POST["submit"])) {
    // Cek stok
    $stok = query("SELECT * from stok_pengawas where id_barang = '$_POST[id_barang]' and nik = '$nik'")[0]["stok_pengawas"];
    $hitung = $stok - $_POST["qty"];
    if($hitung < 0){
        echo "<script> 
                alert('Stok Barang Pertama Tidak Mencukupi');
                document.location.href = 'input_barang_pelanggan.php';
              </script>";
    }  elseif ($_POST["id_barang2"] != '' ) {
        $stok2 = query("SELECT * from stok_pengawas where id_barang = '$_POST[id_barang2]' and nik = '$nik'")[0]["stok_pengawas"];
        $hitung2 = $stok2 - $_POST["qty2"];
        if($hitung < 0){
            echo "<script> 
                    alert('Stok Barang Kedua Tidak Mencukupi');
                    document.location.href = 'input_barang_pelanggan.php';
                  </script>";
        }
    } elseif ($_POST["id_barang3"] != '' ) {
        $stok3 = query("SELECT * from stok_pengawas where id_barang = '$_POST[id_barang3]' and nik = '$nik'")[0]["stok_pengawas"];
        $hitung3 = $stok3 - $_POST["qty3"];
        if($hitung < 0){
            echo "<script> 
                    alert('Stok Barang Ketiga Tidak Mencukupi');
                    document.location.href = 'input_barang_pelanggan.php';
                  </script>";
        }
    } elseif ($_POST["id_barang4"] != '' ) {
        $stok4 = query("SELECT * from stok_pengawas where id_barang = '$_POST[id_barang4]' and nik = '$nik'")[0]["stok_pengawas"];
        $hitung4 = $stok4 - $_POST["qty4"];
        if($hitung < 0){
            echo "<script> 
                    alert('Stok Barang Keempat Tidak Mencukupi');
                    document.location.href = 'input_barang_pelanggan.php';
                  </script>";
        }
    } elseif ($_POST["id_barang5"] != '' ) {
        $stok5 = query("SELECT * from stok_pengawas where id_barang = '$_POST[id_barang5]' and nik = '$nik'")[0]["stok_pengawas"];
        $hitung5 = $stok5 - $_POST["qty5"];
        if($hitung < 0){
            echo "<script> 
                    alert('Stok Barang Kelima Tidak Mencukupi');
                    document.location.href = 'input_barang_pelanggan.php';
                  </script>";
        }
    } else{
        if (input_keluar($_POST) > 0) {
            echo "<script> alert('Data Berhasil Dikirim!'); 
                            document.location.href = 'input_barang_pelanggan.php';
                </script>";
        } else {
            echo "<script> alert('Error!');
                            document.location.href = 'input_barang_pelanggan.php';
                </script>";
            }
        }
    }
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <?php include "view/head.php";?>
    <title>Input Barang (Pelanggan) </title>
</head>
<body class="sb-nav-fixed">
    <?php 
        include "view/navbar.php";
        include "view/sidebar.php";
    ?>

    <div id="layoutSidenav_content">
        <main>
            <div class="container-fluid px-4">
                <h1 class="mt-4">Input Barang (Pelanggan) </h1>
                <ol class="breadcrumb alert alert-dark mb-4">
                    <li class="breadcrumb-item"><a href="index.php"> Dashboard </a></li>
                    <li class="breadcrumb-item active">Input Barang (Pelanggan) </li>
                </ol>
                <div class="row">
                    <div class="col">
                        <div class="card mb-4">
                            <div class="card-header">
                                Input Barang (Pelanggan) 
                            </div>
                            <div class="card-body">
                                <form action="" method="POST">
                                    <div class="row mb-3">
                                        <div class="col">
                                        <label class="form-label" for="">Nama Barang</label>
                                            <select class="form-select" name="id_barang" id="">
                                                <option value="">Pilih Barang</option>
                                                <?php foreach ($barang as $row):?>
                                                        <option value="<?= $row["id_barang"];?>"><?= $row["nama_barang"];?></option>
                                                <?php endforeach;?>
                                            </select>
                                        </div>
                                        <div class="col">
                                            <label class="form-label" for="">Qty</label>
                                            <input class="form-control" type="text" name="qty">
                                        </div>
                                    </div>
                                    <div class="row mb-3">
                                        <div class="col">
                                        <label class="form-label" for="">Nama Barang</label>
                                            <select class="form-select" name="id_barang2" id="">
                                                <option value="">Pilih Barang</option>
                                                <?php foreach ($barang as $row):?>
                                                        <option value="<?= $row["id_barang"];?>"><?= $row["nama_barang"];?></option>
                                                <?php endforeach;?>
                                            </select>
                                        </div>
                                        <div class="col">
                                            <label class="form-label" for="">Qty</label>
                                            <input class="form-control" type="text" name="qty2">
                                        </div>
                                    </div>
                                    <div class="row mb-3">
                                        <div class="col">
                                        <label class="form-label" for="">Nama Barang</label>
                                            <select class="form-select" name="id_barang3" id="">
                                                <option value="">Pilih Barang</option>
                                                <?php foreach ($barang as $row):?>
                                                        <option value="<?= $row["id_barang"];?>"><?= $row["nama_barang"];?></option>
                                                <?php endforeach;?>
                                            </select>
                                        </div>
                                        <div class="col">
                                            <label class="form-label" for="">Qty</label>
                                            <input class="form-control" type="text" name="qty3">
                                        </div>
                                    </div>
                                    <div class="row mb-3">
                                        <div class="col">
                                        <label class="form-label" for="">Nama Barang</label>
                                            <select class="form-select" name="id_barang4" id="">
                                                <option value="">Pilih Barang</option>
                                                <?php foreach ($barang as $row):?>
                                                        <option value="<?= $row["id_barang"];?>"><?= $row["nama_barang"];?></option>
                                                <?php endforeach;?>
                                            </select>
                                        </div>
                                        <div class="col">
                                            <label class="form-label" for="">Qty</label>
                                            <input class="form-control" type="text" name="qty4">
                                        </div>
                                    </div>
                                    <div class="row mb-3">
                                        <div class="col">
                                        <label class="form-label" for="">Nama Barang</label>
                                            <select class="form-select" name="id_barang5" id="">
                                                <option value="">Pilih Barang</option>
                                                <?php foreach ($barang as $row):?>
                                                        <option value="<?= $row["id_barang"];?>"><?= $row["nama_barang"];?></option>
                                                <?php endforeach;?>
                                            </select>
                                        </div>
                                        <div class="col">
                                            <label class="form-label" for="">Qty</label>
                                            <input class="form-control" type="text" name="qty5">
                                        </div>
                                    </div>
                                    <div class="row mb-3">
                                        <div class="col">
                                            <label class="form-label" for="">Kebutuhan</label>
                                            <select class="form-select" name="kebutuhan" id="" required>
                                                <option value="">Pilih Kebutuhan</option>
                                                <option value="Pemasangan Baru">Pemasangan Baru</option>
                                                <option value="Perbaikan">Perbaikan</option>
                                            </select>
                                        </div>
                                    </div>
                                    <div class="row mb-3">
                                        <div class="col">
                                            <label class="form-label" for="">Keterangan</label>
                                            <input class="form-control" type="text" name="keterangan">
                                        </div>
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