<?php
session_start();
$level = $_SESSION["level"];
$nik = $_SESSION["nik"];;

if (!isset($_SESSION["login"])) {
    header("Location: ../login.php");
    exit;
}
require '../functions.php';

if (isset($_GET["hapus_permintaan"])) {
    $hapus_permintaan = $_GET["hapus_permintaan"];   
    if (hapus_permintaan($hapus_permintaan) >= 0 ) {
        echo " <script>
                    alert('Berhasil dihapus!');
                    document.location.href = 'permintaan_barang.php';
                    </script>
                ";
    } else{
        echo "<script>alert(' Gagal Dikonfirmasi!');</script>;";
        header("Location: permintaan_barang.php");
    }
} elseif (isset($_GET["hapus_permintaan_baru"])) {
    $hapus_permintaan_baru = $_GET["hapus_permintaan_baru"];   
    if (hapus_permintaan_baru($hapus_permintaan_baru) >= 0 ) {
        echo " <script>
                    alert('Berhasil dihapus!');
                    document.location.href = 'permintaan_barang.php';
                    </script>
                ";
    } else{
        echo "<script>alert(' Gagal Dikonfirmasi!');</script>;";
        header("Location: permintaan_barang.php");
    }
}

?>