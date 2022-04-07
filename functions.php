<?php 
// koneksi db

$koneksi = mysqli_connect("localhost","root","","webmanagement");

// set tanggal timezone default
date_default_timezone_set("Asia/Jakarta");

// query
function query($query){
    global $koneksi;
    $result = mysqli_query($koneksi, $query);
    $rows = [];
    while ($row = mysqli_fetch_assoc($result)){
        $rows[] = $row;
    }
    return $rows;
}

function edit_profil($data){
    global $koneksi;

    $nik = $_GET["nik"];
    $nama = htmlspecialchars($data["nama"]);
    $kelamin = htmlspecialchars($data["kelamin"]);
    $alamat = htmlspecialchars($data["alamat"]);

    $query = "UPDATE tbl_karyawan set nama_karyawan = '$nama', jenis_kelamin = '$kelamin', alamat = '$alamat' where nik = '$nik'";
    mysqli_query($koneksi,$query);

    return mysqli_affected_rows($koneksi);
}

function edit_barang($data){
    global $koneksi;

    $id_barang = $_GET["id_barang"];
    $nama_barang = htmlspecialchars($data["nama_barang"]);
    $stok_total = htmlspecialchars($data["stok_total"]);
    $sisa_stok = htmlspecialchars($data["sisa_stok"]);

    $query = "UPDATE tbl_barang set nama_barang = '$nama_barang', stok = '$stok_total', sisa_stok = '$sisa_stok' where id_barang = '$id_barang'";
    mysqli_query($koneksi,$query);

    return mysqli_affected_rows($koneksi);
}

function edit_pembelian($data){
    global $koneksi;

    $id_pembelian = $_GET["id_pembelian"];
    $id_barang = htmlspecialchars($data["id_barang"]);
    $jenis_pembelian = htmlspecialchars($data["jenis_pembelian"]);
    $qty = htmlspecialchars($data["qty"]);
    $harga = htmlspecialchars($data["harga"]);
    $keterangan = htmlspecialchars($data["keterangan"]);

    $query = "UPDATE tbl_pembelian set id_barang = '$id_barang', jenis_pembelian = '$jenis_pembelian', qty = '$qty', harga = '$harga', keterangan = '$keterangan' where id_pembelian = '$id_pembelian'";
    mysqli_query($koneksi,$query);

    return mysqli_affected_rows($koneksi);
}

function hapus_barang($data){
    global $koneksi;

    $id_barang = $_GET["id_brg"];

    $query = "DELETE from tbl_barang where id_barang = '$id_barang' ";
    mysqli_query($koneksi,$query);

    return mysqli_affected_rows($koneksi);
}

function tambah_karyawan($data){
    global $koneksi;

    $nik = htmlspecialchars($data["nik"]);
    $nama = htmlspecialchars($data["nama_karyawan"]);
    $jenis_kelamin = htmlspecialchars($data["jenis_kelamin"]);
    $alamat = htmlspecialchars($data["alamat"]);
    
    $query = "INSERT into tbl_karyawan values ('', '$nik', '$nama', '$jenis_kelamin', '$alamat')";
    mysqli_query($koneksi,$query);

    return mysqli_affected_rows($koneksi);
}

function tambah_user($data){
    global $koneksi;

    $nik = htmlspecialchars($data["nik"]);
    $nama = htmlspecialchars($data["nama_karyawan"]);
    $jenis_kelamin = htmlspecialchars($data["jenis_kelamin"]);
    $alamat = htmlspecialchars($data["alamat"]);
    $username = htmlspecialchars($data["username"]);
    $password = htmlspecialchars($data["password"]);
    $level = htmlspecialchars($data["level"]);
    
    $query = "INSERT into tbl_karyawan values ('', '$nik', '$nama', '$jenis_kelamin', '$alamat')";
    mysqli_query($koneksi,$query);

    $query = "INSERT into tbl_user values ('', '$nik', '$username', '$password', '$level')";
    mysqli_query($koneksi,$query);

    // Jika levelnya pengawas, maka buat stok
    if($level == 'Pengawas'){
        $barang = query("SELECT * from tbl_barang");
        foreach ($barang as $row){
            $query = "INSERT into stok_pengawas values ('', '$nik', '$row[id_barang]', 0)";
        }
    }

    return mysqli_affected_rows($koneksi);
}

function edit_karyawan($data){
    global $koneksi;

    $nik = $_GET["nik"];
    $nama = htmlspecialchars($data["nama_karyawan"]);
    $level = htmlspecialchars($data["level"]);

    $query = "UPDATE tbl_karyawan set nama_karyawan = '$nama' where nik = '$nik'";
    $query2 = "UPDATE tbl_user set level = '$level' where nik = '$nik'";
    mysqli_query($koneksi,$query);
    mysqli_query($koneksi,$query2);

    return mysqli_affected_rows($koneksi);
}

function hapus_karyawan($data){
    global $koneksi;

    $nik = $_GET["nik"];

    $query = "DELETE from tbl_karyawan where nik = '$nik'";
    mysqli_query($koneksi,$query);

    $query = "DELETE from tbl_user where nik = '$nik'";
    mysqli_query($koneksi,$query);

    return mysqli_affected_rows($koneksi);
}

function edit_password($data){
    global $koneksi;

    $nik = $_GET["nik"];
    $password = htmlspecialchars($data["password"]);

    $query = "UPDATE tbl_user set password = '$password' where nik = '$nik'";
    mysqli_query($koneksi,$query);

    return mysqli_affected_rows($koneksi);
}

function tambah_barang($data){
    global $koneksi;

    $nama = htmlspecialchars($data["nama_barang"]);

    $query = "INSERT into tbl_barang values('', '$nama', 0, 0)";
    mysqli_query($koneksi,$query);

    $nik = query("SELECT * from tbl_user where level = 'Pengawas'");
    $id_barang = query("SELECT * from tbl_barang where nama_barang = '$nama'")[0]["id_barang"];
    foreach ($nik as $row){
        $query = "INSERT into stok_pengawas values ('', '$row[nik]', '$id_barang', 0)";
        mysqli_query($koneksi, $query);
    }

    return mysqli_affected_rows($koneksi);
}

function minta_barang_lama($data){
    global $koneksi;

    $id_barang = htmlspecialchars($data["id_barang"]);
    $id_barang2 = htmlspecialchars($data["id_barang2"]);
    $id_barang3 = htmlspecialchars($data["id_barang3"]);
    $id_barang4 = htmlspecialchars($data["id_barang4"]);
    $id_barang5 = htmlspecialchars($data["id_barang5"]);
    $qty = htmlspecialchars($data["qty"]);
    $qty2 = htmlspecialchars($data["qty2"]);
    $qty3 = htmlspecialchars($data["qty3"]);
    $qty4 = htmlspecialchars($data["qty4"]);
    $qty5 = htmlspecialchars($data["qty5"]);
    $keterangan = htmlspecialchars($data["keterangan"]);
    $tanggal = date("Y-m-d");
    $nik = $_SESSION["nik"];

    // insert permintaan
    $query = "INSERT INTO tbl_permintaan values ('', '$nik', '$id_barang', '$qty', '$tanggal', '$keterangan', '')";
    mysqli_query($koneksi, $query);
    if ($id_barang2 != '') {
        $query = "INSERT INTO tbl_permintaan values ('', '$nik', '$id_barang2', '$qty2', '$tanggal', '$keterangan', '')";
        mysqli_query($koneksi, $query);
    }
    
    if ($id_barang3 != '') {
        $query = "INSERT INTO tbl_permintaan values ('', '$nik', '$id_barang3', '$qty3', '$tanggal', '$keterangan', '')";
        mysqli_query($koneksi, $query);
    }

    if ($id_barang4 != '') {
        $query = "INSERT INTO tbl_permintaan values ('', '$nik', '$id_barang4', '$qty4', '$tanggal', '$keterangan', '')";
        mysqli_query($koneksi, $query);
    }

    if ($id_barang5 != '') {
        $query = "INSERT INTO tbl_permintaan values ('', '$nik', '$id_barang5', '$qty5', '$tanggal', '$keterangan', '')";
        mysqli_query($koneksi, $query);
    }

    return mysqli_affected_rows($koneksi);
}

function minta_barang_baru($data){
    global $koneksi;

    $nama_barang = htmlspecialchars($data["nama_barang"]);
    $qty = htmlspecialchars($data["qty"]);
    $keterangan = htmlspecialchars($data["keterangan"]);
    $tanggal = date("Y-m-d");
    $nik = $_SESSION["nik"];

    // insert permintaan baru 
    $query = "INSERT INTO tbl_permintaan_baru values ('', '$nik', '$nama_barang', '$qty', '$tanggal', '$keterangan', '')";
    mysqli_query($koneksi, $query);
    

    return mysqli_affected_rows($koneksi);
}

function input_keluar($data){
    global $koneksi;

    $id_barang = htmlspecialchars($data["id_barang"]);
    $id_barang2 = htmlspecialchars($data["id_barang2"]);
    $id_barang3 = htmlspecialchars($data["id_barang3"]);
    $id_barang4 = htmlspecialchars($data["id_barang4"]);
    $id_barang5 = htmlspecialchars($data["id_barang5"]);
    $qty = htmlspecialchars($data["qty"]);
    $qty2 = htmlspecialchars($data["qty2"]);
    $qty3 = htmlspecialchars($data["qty3"]);
    $qty4 = htmlspecialchars($data["qty4"]);
    $qty5 = htmlspecialchars($data["qty5"]);
    $keterangan = htmlspecialchars($data["keterangan"]);
    $kebutuhan = htmlspecialchars($data["kebutuhan"]);
    $tanggal = date("Y-m-d");
    $nik = $_SESSION["nik"];

    // insert permintaan
    $query = "INSERT INTO tbl_keluar values ('', '$nik', '$id_barang', '$qty', '$tanggal', '$kebutuhan', '$keterangan', '')";
    mysqli_query($koneksi, $query);
    // update stok
    $stok = query("SELECT * from stok_pengawas where id_barang = '$id_barang' and nik = '$nik'")[0]["stok_pengawas"];
    $updatestok = $stok - $qty;
    $query = "UPDATE stok_pengawas set stok_pengawas = '$updatestok' where id_barang = '$id_barang' and nik = '$nik'";
    mysqli_query($koneksi, $query);
    if ($id_barang2 != '') {
        $query = "INSERT INTO tbl_keluar values ('', '$nik', '$id_barang2', '$qty2', '$tanggal', '$keterangan', '')";
        mysqli_query($koneksi, $query);

        $stok = query("SELECT * from stok_pengawas where id_barang = '$id_barang2' and nik = '$nik'")[0]["stok_pengawas"];
        $updatestok = $stok - $qty2;
        $query = "UPDATE stok_pengawas set stok_pengawas = '$updatestok' where id_barang = '$id_barang2' and nik = '$nik'";
        mysqli_query($koneksi, $query);
    }
    
    if ($id_barang3 != '') {
        $query = "INSERT INTO tbl_keluar values ('', '$nik', '$id_barang3', '$qty3', '$tanggal', '$keterangan', '')";
        mysqli_query($koneksi, $query);

        $stok = query("SELECT * from stok_pengawas where id_barang = '$id_barang3' and nik = '$nik'")[0]["stok_pengawas"];
        $updatestok = $stok - $qty3;
        $query = "UPDATE stok_pengawas set stok_pengawas = '$updatestok' where id_barang = '$id_barang3' and nik = '$nik'";
        mysqli_query($koneksi, $query);
    }

    if ($id_barang4 != '') {
        $query = "INSERT INTO tbl_keluar values ('', '$nik', '$id_barang4', '$qty4', '$tanggal', '$keterangan', '')";
        mysqli_query($koneksi, $query);

        $stok = query("SELECT * from stok_pengawas where id_barang = '$id_barang4' and nik = '$nik'")[0]["stok_pengawas"];
        $updatestok = $stok - $qty4;
        $query = "UPDATE stok_pengawas set stok_pengawas = '$updatestok' where id_barang = '$id_barang4' and nik = '$nik'";
        mysqli_query($koneksi, $query);
    }

    if ($id_barang5 != '') {
        $query = "INSERT INTO tbl_keluar values ('', '$nik', '$id_barang5', '$qty5', '$tanggal', '$keterangan', '')";
        mysqli_query($koneksi, $query);

        $stok = query("SELECT * from stok_pengawas where id_barang = '$id_barang5' and nik = '$nik'")[0]["stok_pengawas"];
        $updatestok = $stok - $qty5;
        $query = "UPDATE stok_pengawas set stok_pengawas = '$updatestok' where id_barang = '$id_barang5' and nik = '$nik'";
        mysqli_query($koneksi, $query);
    }

    return mysqli_affected_rows($koneksi);
}

function acc_permintaan($data){
    global $koneksi;

    $id = $_GET["acc_permintaan"];
    $id_barang = $_GET["barang"];
    $qty = $_GET["qty"];
    $nik = $_GET["pengawas"];
    $tanggal = date("Y-m-d");

    $stok_sekarang = query("SELECT * from tbl_barang where id_barang = '$id_barang'")[0]["sisa_stok"];
    $updatestok = $stok_sekarang - $qty;
    // update stok sekarang
    $query = "UPDATE tbl_barang SET sisa_stok = '$updatestok' where id_barang = '$id_barang'";
    mysqli_query($koneksi,$query);

    // acc_permintaan
    $query = "UPDATE tbl_permintaan set status = 1 where id_permintaan = '$id'";
    mysqli_query($koneksi,$query);

    // Tambah stok pengawas
    $stok_pengawas_sekarang = query("SELECT * from stok_pengawas where nik = '$nik' and id_barang = '$id_barang'")[0]["stok_pengawas"];
    $update_stok_pengawas = $stok_pengawas_sekarang + $qty;
    $query = "UPDATE stok_pengawas set stok_pengawas = '$update_stok_pengawas' where nik = '$nik' and id_barang = '$id_barang'";
    mysqli_query($koneksi,$query);

    // stok masuk pengawas
    $query = "INSERT into tbl_masuk values ('', '$nik', '$id_barang', '$qty', '$tanggal', '9')";
    mysqli_query($koneksi,$query);


    return mysqli_affected_rows($koneksi);
}

function tolak_permintaan($data){
    global $koneksi;

    $id = $_GET["tolak_permintaan"];

    // Tolak permintaan
    $query = "UPDATE tbl_permintaan set status = -1 where id_permintaan = '$id'";
    mysqli_query($koneksi,$query);

    return mysqli_affected_rows($koneksi);
}

function terima_permintaan_baru($data){
    global $koneksi;

    $id = $_GET["terima_baru"];

    // Terima permintaan
    $query = "UPDATE tbl_permintaan_baru set status = 1 where id_permintaan_baru = '$id'";
    mysqli_query($koneksi,$query);

    return mysqli_affected_rows($koneksi);
}

function tolak_permintaan_baru($data){
    global $koneksi;

    $id = $_GET["tolak_baru"];

    // Tolak permintaan
    $query = "UPDATE tbl_permintaan_baru set status = -1 where id_permintaan_baru = '$id'";
    mysqli_query($koneksi,$query);

    return mysqli_affected_rows($koneksi);
}

function beli($data){
    global $koneksi;

    $nik = $_SESSION["nik"];
    $id_barang = htmlspecialchars($data["id_barang"]);
    $qty = htmlspecialchars($data["qty"]);
    $jenis = htmlspecialchars($data["jenis"]);
    $total = htmlspecialchars($data["total"]);
    $keterangan = htmlspecialchars($data["keterangan"]);
    $tanggal = date("Y-m-d");

    $query = "INSERT into tbl_pembelian values ('', '$nik', '$id_barang', '$jenis', '$qty', '$total', '$tanggal', '$keterangan', '') ";
    mysqli_query($koneksi,$query);

    return mysqli_affected_rows($koneksi);
}


function setuju_pembelian($data){
    global $koneksi;

    $id = $_GET["setuju_pembelian"];

    // Setuju pembelian
    $query = "UPDATE tbl_pembelian set status = 1 where id_pembelian = '$id'";
    mysqli_query($koneksi,$query);

    return mysqli_affected_rows($koneksi);
}

function tolak_pembelian($data){
    global $koneksi;

    $id = $_GET["tolak_pembelian"];

    // Tolak pembelian
    $query = "UPDATE tbl_pembelian set status = -1 where id_pembelian = '$id'";
    mysqli_query($koneksi,$query);

    return mysqli_affected_rows($koneksi);
}

function tolak_pembelian_lama($data){
    global $koneksi;

    $id = $_GET["tolak_pembelian_lama"];

    // Tolak pembelian
    $query = "UPDATE tbl_pembelian set status = -1 where id_pembelian = '$id'";
    mysqli_query($koneksi,$query);

    return mysqli_affected_rows($koneksi);
}

function lanjut($data){
    global $koneksi;

    $id = $_GET["lanjut"];

    // Lanjut pembelian
    $query = "UPDATE tbl_pembelian set status = 2 where id_pembelian = '$id'";
    mysqli_query($koneksi,$query);

    return mysqli_affected_rows($koneksi);
}

function lanjut_baru($data){
    global $koneksi;

    $id = $_GET["lanjut_baru"];

    // Lanjut pembelian
    $query = "UPDATE tbl_pembelian set status = 2 where id_pembelian = '$id'";
    mysqli_query($koneksi,$query);

    return mysqli_affected_rows($koneksi);
}

// Selesai Pembelian
function selesai($data){
    global $koneksi;

    $id = $_GET["selesai"];
    $tanggal = date("Y-m-d");
    $baru = query("SELECT * from tbl_pembelian inner join tbl_barang on tbl_pembelian.id_barang = tbl_barang.id_barang where id_pembelian = '$id'");
    if(count($baru) > 0){
        $nama_barang = $baru[0]["nama_barang"];
        $query2 = "UPDATE tbl_permintaan_baru set status = 2 where nama_barang = '$nama_barang'";
        mysqli_query($koneksi,$query2);

        $permintaan_baru = query("SELECT * from tbl_permintaan_baru");
        $nik = $permintaan_baru[0]["nik"];
        $qty = $permintaan_baru[0]["qty"];
        $query3 = "UPDATE stok_pengawas inner join tbl_barang on stok_pengawas.id_barang = tbl_barang.id_barang set stok_pengawas.stok_pengawas = '$qty' where stok_pengawas.nik = '$nik' and tbl_barang.nama_barang = '$nama_barang' ";
        mysqli_query($koneksi,$query3);

        $id_barang = query("SELECT * from tbl_pembelian where id_pembelian = '$id'")[0]["id_barang"];
        $beli_stok = query("SELECT * from tbl_pembelian where id_pembelian = '$id'")[0]["qty"];
        $nik_pembeli = query("SELECT * from tbl_pembelian where id_pembelian = '$id'")[0]["nik"];
        $query = "INSERT into tbl_masuk values ('', '$nik', '$id_barang', '$beli_stok', '$tanggal', '9') ";
        mysqli_query($koneksi,$query);
    }

    // Pembelian Selesai
    $query = "UPDATE tbl_pembelian set status = 3 where id_pembelian = '$id'";
    mysqli_query($koneksi,$query);

    // updatestok
    $id_barang = query("SELECT * from tbl_pembelian where id_pembelian = '$id'")[0]["id_barang"];
    $beli_stok = query("SELECT * from tbl_pembelian where id_pembelian = '$id'")[0]["qty"];
    $nik_pembeli = query("SELECT * from tbl_pembelian where id_pembelian = '$id'")[0]["nik"];


    $stok_sekarang = query("SELECT * from tbl_barang where id_barang = '$id_barang'")[0]["sisa_stok"];
    $stok_total = query("SELECT * from tbl_barang where id_barang = '$id_barang'")[0]["stok"];
    $updatestok_sekarang = $stok_sekarang + $beli_stok;
    $updatestok_total = $stok_total + $beli_stok;

    // Buat Laporan Stok Masuk
    $query = "INSERT into tbl_masuk values ('', '$nik_pembeli', '$id_barang', '$beli_stok', '$tanggal', '1') ";
    mysqli_query($koneksi,$query);

    // Update stok total
    $query = "UPDATE tbl_barang SET stok = '$updatestok_total' where id_barang = '$id_barang'";
    mysqli_query($koneksi,$query);

    // update stok sekarang
    $query = "UPDATE tbl_barang SET sisa_stok = '$updatestok_sekarang' where id_barang = '$id_barang'";
    mysqli_query($koneksi,$query);


    return mysqli_affected_rows($koneksi);
}

function selesai_baru($data){
    global $koneksi;

    $id = $_GET["selesai_baru"];
    $tanggal = date("Y-m-d");
    $baru = query("SELECT * from tbl_pembelian inner join tbl_barang on tbl_pembelian.id_barang = tbl_barang.id_barang where id_pembelian = '$id'");
    if(count($baru) > 0){
        $nama_barang = $baru[0]["nama_barang"];
        $query2 = "UPDATE tbl_permintaan_baru set status = 2 where nama_barang = '$nama_barang'";
        mysqli_query($koneksi,$query2);

        $permintaan_baru = query("SELECT * from tbl_permintaan_baru");
        $nik = $permintaan_baru[0]["nik"];
        $qty = $permintaan_baru[0]["qty"];
        $query3 = "UPDATE stok_pengawas inner join tbl_barang on stok_pengawas.id_barang = tbl_barang.id_barang set stok_pengawas.stok_pengawas = '$qty' where stok_pengawas.nik = '$nik' and tbl_barang.nama_barang = '$nama_barang' ";
        mysqli_query($koneksi,$query3);

        $id_barang = query("SELECT * from tbl_pembelian where id_pembelian = '$id'")[0]["id_barang"];
        $beli_stok = query("SELECT * from tbl_pembelian where id_pembelian = '$id'")[0]["qty"];
        $nik_pembeli = query("SELECT * from tbl_pembelian where id_pembelian = '$id'")[0]["nik"];
        $query = "INSERT into tbl_masuk values ('', '$nik', '$id_barang', '$beli_stok', '$tanggal', '9') ";
        mysqli_query($koneksi,$query);
    }

    // Pembelian Selesai
    $query = "UPDATE tbl_pembelian set status = 3 where id_pembelian = '$id'";
    mysqli_query($koneksi,$query);

    // updatestok
    $id_barang = query("SELECT * from tbl_pembelian where id_pembelian = '$id'")[0]["id_barang"];
    $beli_stok = query("SELECT * from tbl_pembelian where id_pembelian = '$id'")[0]["qty"];
    $nik_pembeli = query("SELECT * from tbl_pembelian where id_pembelian = '$id'")[0]["nik"];


    $stok_sekarang = query("SELECT * from tbl_barang where id_barang = '$id_barang'")[0]["sisa_stok"];
    $stok_total = query("SELECT * from tbl_barang where id_barang = '$id_barang'")[0]["stok"];
    $updatestok_sekarang = $stok_sekarang + $beli_stok;
    $updatestok_total = $stok_total + $beli_stok;

    // Buat Laporan Stok Masuk
    $query = "INSERT into tbl_masuk values ('', '$nik_pembeli', '$id_barang', '$beli_stok', '$tanggal', '1') ";
    mysqli_query($koneksi,$query);

    // Update stok total
    $query = "UPDATE tbl_barang SET stok = '$updatestok_total' where id_barang = '$id_barang'";
    mysqli_query($koneksi,$query);

    // update stok sekarang
    $query = "UPDATE tbl_barang SET sisa_stok = '$updatestok_sekarang' where id_barang = '$id_barang'";
    mysqli_query($koneksi,$query);


    return mysqli_affected_rows($koneksi);
}

function hapus_pembelian_ditolak($data){
    global $koneksi;

    $id = $_GET["hapus"];

    $query = "DELETE from tbl_pembelian where id_pembelian = '$id'";
    mysqli_query($koneksi,$query);

    return mysqli_affected_rows($koneksi);
}

function hapus_pembelian_ditolak_baru($data){
    global $koneksi;

    $id = $_GET["hapus_baru"];

    $query = "DELETE from tbl_pembelian where id_pembelian = '$id'";
    mysqli_query($koneksi,$query);

    return mysqli_affected_rows($koneksi);
}

function hapus_pembelian_lama_ditolak($data){
    global $koneksi;

    $id = $_GET["hapus_lama"];

    $query = "DELETE from tbl_pembelian where id_pembelian = '$id'";
    mysqli_query($koneksi,$query);

    return mysqli_affected_rows($koneksi);
}

function hapus_permintaan($data){
    global $koneksi;

    $id = $_GET["hapus_permintaan"];

    $query = "DELETE from tbl_permintaan where id_permintaan = '$id'";
    mysqli_query($koneksi,$query);

    return mysqli_affected_rows($koneksi);
}

function hapus_permintaan_baru($data){
    global $koneksi;

    $id = $_GET["hapus_permintaan_baru"];

    $query = "DELETE from tbl_permintaan_baru where id_permintaan_baru = '$id'";
    mysqli_query($koneksi,$query);

    return mysqli_affected_rows($koneksi);
}

function hapus_pembelian($data){
    global $koneksi;

    $id = $_GET["hapus_pembelian"];

    $query = "DELETE from tbl_pembelian where id_pembelian = '$id'";
    mysqli_query($koneksi,$query);

    return mysqli_affected_rows($koneksi);
}

?>