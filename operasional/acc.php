<?php
session_start();
$level = $_SESSION["level"];
$nik = $_SESSION["nik"];;

if (!isset($_SESSION["login"])) {
    header("Location: ../login.php");
    exit;
}
require '../functions.php';

if (isset($_GET["acc_permintaan"])) {
    $acc_permintaan = $_GET["acc_permintaan"];   
    $id_barang = $_GET["barang"];   
    $qty_permintaan = $_GET["qty"];
    $stok = query("SELECT * from tbl_barang where id_barang = '$id_barang'")[0]["sisa_stok"];
    $hitung = $stok - $qty_permintaan;
    if(($hitung) >= 0 ){
        if (acc_permintaan($acc_permintaan) >= 0 ) {
            echo " <script>
                        alert('Berhasil Dikonfirmasi!');
                        document.location.href = 'permintaan.php';
                        </script>
                    ";
        } else{
            echo "<script>alert(' Gagal Dikonfirmasi!');</script>";
            header("Location: permintaan.php");
        }
    } else {
        echo "<script>alert('Stok Kurang silahkan lakukan pembelian!');
                     document.location.href= 'permintaan.php';
            </script>";
    }
} elseif (isset($_GET["tolak_permintaan"])) {
    $tolak_permintaan = $_GET["tolak_permintaan"];   
    if (tolak_permintaan($tolak_permintaan) > 0 ) {
        echo " <script>
                    alert('Permintaan ditolak!');
                    document.location.href = 'permintaan.php';
                    </script>
                ";
    } else{
        echo "<script>alert(' Gagal Dikonfirmasi!');</script>";
        header("Location: permintaan.php");
    }
}  elseif (isset($_GET["lanjut"])) {
    $lanjut = $_GET["lanjut"];   
    if (lanjut($lanjut) > 0 ) {
        echo " <script>
                    alert('Pembayaran Dilanjutkan!');
                    document.location.href = 'pembelian.php';
                    </script>
                ";
    } else{
        echo "<script>alert(' Gagal Dikonfirmasi!');</script>";
        header("Location: pembelian.php");
    }
}  elseif (isset($_GET["lanjut_baru"])) {
    $lanjut = $_GET["lanjut_baru"];   
    if (lanjut_baru($lanjut) > 0 ) {
        echo " <script>
                    alert('Pembayaran Dilanjutkan!');
                    document.location.href = 'item_baru.php';
                    </script>
                ";
    } else{
        echo "<script>alert(' Gagal Dikonfirmasi!');</script>";
        header("Location: item_baru.php");
    }
} elseif (isset($_GET["selesai"])) {
    $selesai = $_GET["selesai"];   
    if (selesai($selesai) >= 0 ) {
        echo " <script>
                    alert('Pembelian Barang Selesai!');
                    document.location.href = 'pembelian.php';
                    </script>
                ";
    } else{
        echo "<script>alert(' Gagal Dikonfirmasi!');</script>";
        header("Location: pembelian.php");
    }
} elseif (isset($_GET["selesai_baru"])) {
    $selesai = $_GET["selesai_baru"];   
    if (selesai_baru($selesai) >= 0 ) {
        echo " <script>
                    alert('Pembelian Barang Selesai!');
                    document.location.href = 'item_baru.php';
                    </script>
                ";
    } else{
        echo "<script>alert(' Gagal Dikonfirmasi!');</script>";
        header("Location: item_baru.php");
    }
} elseif (isset($_GET["terima_baru"])) {
    $terima_permintaan_baru = $_GET["terima_baru"];   
    $barang = $_GET["barang"];   
    if (terima_permintaan_baru($terima_permintaan_baru) > 0 ) {
        echo " <script>
                    document.location.href = 'tambah_barang.php?barang=$barang';
                </script>
                ";
    } else{
        echo "<script>alert(' Gagal Dikonfirmasi!');</script>";
        header("Location: item_baru.php");
    }
} elseif (isset($_GET["tolak_baru"])) { 
    $tolak_permintaan_baru = $_GET["tolak_baru"];   
    if (tolak_permintaan_baru($tolak_permintaan_baru) > 0 ) {
        echo " <script>
                    alert('Permintaan Barang Baru Ditolak!');
                    document.location.href = 'item_baru.php';
                    </script>
                ";
    } else{
        echo "<script>alert(' Gagal Dikonfirmasi!');</script>";
        header("Location: item_baru.php");
    }
} elseif (isset($_GET["hapus"])) { 
    $hapus = $_GET["hapus"];   
    if (hapus_pembelian_ditolak($hapus) > 0 ) {
        echo " <script>
                    alert('Data Dihapus!');
                    document.location.href = 'item_baru.php';
                    </script>
                ";
    } else{
        echo "<script>alert(' Gagal Dikonfirmasi!');</script>";
        header("Location: item_baru.php");
    }
}  elseif (isset($_GET["hapus_lama"])) { 
    $hapus = $_GET["hapus_lama"];   
    if (hapus_pembelian_ditolak($hapus) > 0 ) {
        echo " <script>
                    alert('Data Dihapus!');
                    document.location.href = 'item_lama.php';
                    </script>
                ";
    } else{
        echo "<script>alert(' Gagal Dikonfirmasi!');</script>";
        header("Location: item_lama.php");
    }
} elseif (isset($_GET["nik"])) { 
    $nik = $_GET["nik"];   
    if (hapus_karyawan($nik) >= 0 ) {
        echo " <script>
                    alert('Data Dihapus!');
                    document.location.href = 'data_karyawan.php';
                    </script>
                ";
    } else{
        echo "<script>alert(' Gagal Dikonfirmasi!');</script>";
        header("Location: data_karyawan.php");
    }
}

?>