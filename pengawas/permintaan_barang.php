<?php
    session_start();
    $level = $_SESSION["level"];
    $nik = $_SESSION["nik"];

    require '../functions.php';

$barang = query("SELECT * from tbl_barang");
$permintaan = query("SELECT * from tbl_permintaan inner join tbl_barang on tbl_permintaan.id_barang = tbl_barang.id_barang where nik = '$nik' and status = -1");
$permintaan_baru = query("SELECT * from tbl_permintaan_baru where nik = '$nik' and status = -1");

// Jika tombol submit barang yg sudah ada ditekan
if (isset($_POST["submit"])) {
    if (minta_barang_lama($_POST) > 0) {
        echo "<script> alert('Data Berhasil Dikirim!'); 
                        document.location.href = 'permintaan_barang.php';
            </script>";
    } else {
        echo "<script> alert('Error!');
                        document.location.href = 'permintaan_barang.php';
            </script>";
        }
    }

// Jika tombol submit barang baru sudah ditekan
if (isset($_POST["submit2"])) {
    if (minta_barang_baru($_POST)) {
        echo "<script> alert('Data Berhasil Dikirim!'); 
                        document.location.href = 'permintaan_barang.php';
            </script>";
    } else {
        echo "<script> alert('Error!');
                        document.location.href = 'permintaan_barang.php';
            </script>";
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <?php include "view/head.php";?>
    <title>Permintaan Barang</title>
</head>
<body class="sb-nav-fixed">
    <?php 
        include "view/navbar.php";
        include "view/sidebar.php";
    ?>

    <div id="layoutSidenav_content">
        <main>
            <div class="container-fluid px-4">
                <h1 class="mt-4">Permintaan Barang</h1>
                <ol class="breadcrumb alert alert-dark mb-4">
                    <li class="breadcrumb-item"><a href="index.php"> Dashboard </a></li>
                    <li class="breadcrumb-item active">Permintaan Barang</li>
                </ol>
                <div class="row">
                    <div class="col">
                        <div class="card mb-4">
                            <div class="card-header">
                                Permintaan Barang
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
                                                <select class="form-select" name="id_barang" id="" required>
                                                    <option value="">Pilih Barang</option>
                                                    <?php foreach ($barang as $row):?>
                                                        <option value="<?= $row["id_barang"];?>"><?= $row["nama_barang"];?></option>
                                                    <?php endforeach;?>
                                                </select>
                                            </div>
                                            <div class="col">
                                                <label class="form-label" for="">Qty</label>
                                                <input class="form-control" type="text" name="qty" required>
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
                                                <label class="form-label" for="">Keterangan</label>
                                                <input class="form-control" type="text" name="keterangan">
                                            </div>
                                        </div>
                                        <button class="btn btn-primary" type="submit" name="submit">Submit</button>
                                    </form>
                                <?php elseif (isset($_POST["baru"])) :?>
                                    <div class="alert alert-success">
                                        <h5>Permintaan Barang Baru</h5>
                                    </div>
                                    <form action="" method="POST">
                                        <div class="row mb-3">
                                            <div class="row mb-3">
                                                <div class="col-6">
                                                    <label class="form-label" for="">Nama Barang</label>
                                                    <input class="form-control" type="text" name="nama_barang">
                                                </div>
                                                <div class="col-4">
                                                    <label class="form-label" for="">Qty</label>
                                                    <input class="form-control" type="number" name="qty">
                                                </div>
                                                <div class="col">
                                                    <label class="form-label" for="">Satuan</label>
                                                    <input class="form-control" type="text" value="Pcs / M" disabled>
                                                </div>
                                            </div>
                                            <div class="row mb-3">
                                                <div class="col">
                                                    <label class="form-label" for="">Keterangan</label>
                                                    <input class="form-control" type="text" name="keterangan">
                                                </div>
                                            </div>
                                        </div>
                                        <button class="btn btn-primary" type="submit" name="submit2">Submit</button>
                                    </form>
                                <?php endif;?>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col">
                        <div class="card">
                            <div class="card-header">
                                Permintaan ditolak
                            </div>
                            <div class="card-body">
                                <table class="table table-striped table-bordered" id="tabel">
                                    <thead>
                                        <th>No</th>
                                        <th>Nama Barang</th>
                                        <th>Qty</th>
                                        <th>Action</th>
                                    </thead>
                                    <tbody>
                                        <?php $i= 1; foreach($permintaan as $row):?>
                                            <tr>
                                                <td><?=$i;?></td>
                                                <td><?=$row["nama_barang"];?></td>
                                                <td><?=$row["qty"];?></td>
                                                <td><button class="btn btn-danger" onclick="return confirm('Data akan dihapus?')"><a class="text-decoration-none text-light" href="hapus_permintaan.php?hapus_permintaan=<?=$row["id_permintaan"];?>"><i class="fas fa-times"></i> Hapus</a></button></td>
                                            </tr>
                                        <?php $i++; endforeach;?>
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                    <div class="col">
                        <div class="card">
                            <div class="card-header">
                                Permintaan Barang Baru ditolak
                            </div>
                            <div class="card-body">
                                <table class="table table-striped table-bordered" id="tabel2">
                                    <thead>
                                        <th>No</th>
                                        <th>Nama Barang</th>
                                        <th>Qty</th>
                                        <th>Action</th>
                                    </thead>
                                    <tbody>
                                        <?php $i= 1; foreach($permintaan_baru as $row):?>
                                            <tr>
                                                <td><?=$i;?></td>
                                                <td><?=$row["nama_barang"];?></td>
                                                <td><?=$row["qty"];?></td>
                                                <td><button class="btn btn-danger" onclick="return confirm('Data akan dihapus?')"><a class="text-decoration-none text-light" href="hapus_permintaan.php?hapus_permintaan_baru=<?=$row["id_permintaan_baru"];?>"><i class="fas fa-times"></i> Hapus</a></button></td>
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
  <script>
    $(document).ready( function () {
    $('#tabel2').DataTable( {} );
    } );
  </script>
</body>
</html>