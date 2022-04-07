<?php
session_start();
$level = $_SESSION["level"];
$nik = $_SESSION["nik"];;

if (!isset($_SESSION["login"])) {
    header("Location: ../login.php");
    exit;
}
require '../functions.php';

if (isset($_GET["setuju_pembelian"])) {
    $setuju_pembelian = $_GET["setuju_pembelian"];   
    if (setuju_pembelian($setuju_pembelian) >= 0 ) {
        echo " <script>
                    alert('Berhasil Dikonfirmasi!');
                    document.location.href = 'pembelian_item_baru.php';
                    </script>
                ";
    } else{
        echo "<script>alert(' Gagal Dikonfirmasi!');</script>;";
        header("Location: pembelian_item_baru.php");
    }
} elseif (isset($_GET["tolak_pembelian"])) {
    $tolak_pembelian = $_GET["tolak_pembelian"];   
    if (tolak_pembelian($tolak_pembelian) > 0 ) {
        echo " <script>
                    alert('Pembelian ditolak!');
                    document.location.href = 'pembelian_item_baru.php';
                    </script>
                ";
    } else{
        echo "<script>alert(' Gagal Dikonfirmasi!');</script>;";
        header("Location: pembelian_item_baru.php");
    }
} elseif (isset($_GET["tolak_pembelian_lama"])) {
    $tolak_pembelian = $_GET["tolak_pembelian_lama"];   
    if (tolak_pembelian_lama($tolak_pembelian) > 0 ) {
        echo " <script>
                    alert('Pembelian ditolak!');
                    document.location.href = 'pembelian_item_lama.php';
                    </script>
                ";
    } else{
        echo "<script>alert(' Gagal Dikonfirmasi!');</script>;";
        header("Location: pembelian_item_lama.php");
    }
}

?>