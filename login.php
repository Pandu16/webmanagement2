<?php
session_start();

require "functions.php";

// Login
if (isset($_POST["login"])){
    $username = $_POST["username"];
    $password = $_POST["password"];
    $result = mysqli_query($koneksi, "SELECT * from tbl_user where nik = '$username' and password = '$password'");
    $fetch = mysqli_fetch_array($result);
    // $user = $fetch["username"];
    // $pswrd = $fetch["password"];
    // $level = $fetch["level"];    
    // $nik = $fetch["nik"];
    // cek username dan password

    if (mysqli_num_rows($result) == 1) {
            $_SESSION["login"] = true;
            $_SESSION["nik"] = $fetch["nik"];
            $_SESSION["level"] = $fetch["level"];

            if($fetch["level"] == 'Pengawas'){
                echo "<script> alert('Berhasil Login Sebagai Pengawas'); </script>";
                header("Location: pengawas/index.php");
            } elseif($fetch["level"] == 'Operasional'){
                echo "<script> alert('Berhasil Login Sebagai Operasional'); </script>";
                header("Location: operasional/index.php");
            } elseif($fetch["level"] == 'Manajer'){
                echo "<script> alert('Berhasil Login Sebagai Manajer'); </script>";
                header("Location: manajer/index.php");
            }

            exit;
        } else {
            echo "<script> alert('nik atau Password Yang Anda Masukkan Salah!'); 
                    document.location.href = 'login.php';
                  </script>";
        }
    }
    $error = true;

// Registrasi
if (isset($_POST["register"])){
    if ($_POST["password"] != $_POST["password2"]){
        echo "<script> alert('Konfirmasi Password Tidak Sama');</script>";
        header("Location: login.php");
    } else {
        $nik = $_POST["nik"];
        $nama = $_POST["nama"];
        $password = $_POST["password"];
        $level = $_POST["level"];
        $email = $_POST["email"];

        // cek nik apakah sudah ada user atau belum
        $cek_user = query("SELECT * from tbl_user where nik = '$nik'");
        if(count($cek_user) > 0){
            echo "<script> alert('User Telah Ada');</script>";
            header("Location: login.php");
        } else {
            // cek nik terdaftar sebagai karyawan atau tidak
            $cek_nik = query("SELECT * from tbl_karyawan where nik = '$nik'");
            if(count($cek_nik) > 0){
                $query = "INSERT into tbl_user values ('', '$nik', '$email', '$password', '$level')";

                // Jika Pengawas, tambahkan list barang ke nik tersebut
                if($level == 'Pengawas'){
                    $barang = query("SELECT * from tbl_barang");
                    foreach($barang as $row){
                        $query2 = "INSERT INTO stok_pengawas values ('', '$nik', '$row[id_barang]', '')";
                        mysqli_query($koneksi,$query2);
                    }
                }

                mysqli_query($koneksi,$query);
                
                echo "<script> alert('Akun berhasil dibuat!');
                                document.location.href = 'login.php';
                    </script>";

            } else {
                echo "<script> alert('Anda Tidak terdaftar sebagai karyawan!');
                                document.location.href = 'login.php';
                    </script>";
            }
        }

        return mysqli_affected_rows($koneksi);
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="//maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css" rel="stylesheet" id="bootstrap-css">
    <script src="//maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js"></script>
    <script src="//cdnjs.cloudflare.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
    <style>           
        @import url('https://fonts.googleapis.com/css?family=Mukta');
        body{
        font-family: 'Mukta', sans-serif;
            height:100vh;
            min-height:650px;
            background-repeat: no-repeat;
            background-size:cover;
            background-position:center;
            position:relative;
            overflow-y: hidden;
        }
        a{
        text-decoration:none;
        color:#444444;
        }
        .login-reg-panel{
            border-radius: 3%;
            position: relative;
            top: 42%;
            transform: translateY(-50%);
            text-align:center;
            width:70%;
            right:0;left:0;
            margin:auto;
            height:500px;
            background-color: rgba(236, 48, 20, 0.9);
        }
        .white-panel{
            background-color: rgba(255,255, 255, 1);
            border-radius: 15%;
            height:720px;
            position:absolute;
            top:-50px;
            width:50%;
            right:calc(50% - 50px);
            transition:.3s ease-in-out;
            z-index:0;
            box-shadow: 0 0 15px 9px #00000096;
        }
        .login-reg-panel input[type="radio"]{
            position:relative;
            display:none;
        }
        .login-reg-panel{
            color:#B8B8B8;
            border-radius: 5%;
        }
        .login-reg-panel #label-login, 
        .login-reg-panel #label-register{
            border:1px solid #9E9E9E;
            padding:5px 5px;
            width:150px;
            display:block;
            text-align:center;
            border-radius:15%;
            cursor:pointer;
            font-weight: 600;
            font-size: 18px;
        }
        .login-info-box{
            width:30%;
            padding:0 50px;
            top:20%;
            left:0;
            border-radius: 15%;
            position:absolute;
            text-align:left;
        }
        .register-info-box{
            width:30%;
            padding:0 50px;
            top:20%;
            right:0;
            position:absolute;
            text-align:left;
            
        }
        .right-log{right:50px !important;}

        .login-show, 
        .register-show{
            z-index: 1;
            display:none;
            opacity:0;
            transition:0.3s ease-in-out;
            color:#242424;
            text-align:left;
            padding:50px;
        }
        .show-log-panel{
            display:block;
            opacity:0.9;
        }
        .login-show input[type="text"], .login-show input[type="password"]{
            width: 100%;
            display: block;
            margin:20px 0;
            padding: 15px;
            border: 1px solid #b5b5b5;
            outline: none;
        }
        .login-show input[type="button"] {
            max-width: 150px;
            width: 100%;
            background: #444444;
            color: #f9f9f9;
            border: none;
            padding: 10px;
            text-transform: uppercase;
            border-radius: 2px;
            float:right;
            cursor:pointer;
        }

        .login-show button {
            max-width: 150px;
            width: 100%;
            background: #444444;
            color: #f9f9f9;
            border: none;
            padding: 10px;
            text-transform: uppercase;
            border-radius: 2px;
            float:right;
            cursor:pointer;
        }
        .login-show a{
            display:inline-block;
            padding:10px 0;
        }

        .register-show input[type="text"], .register-show input[type="password"], .register-show input[type="email"]{
            width: 100%;
            display: block;
            margin:20px 0;
            padding: 15px;
            border: 1px solid #b5b5b5;
            outline: none;
        }

        .register-show select{
            background-color: white;
            width: 100%;
            display: block;
            margin:20px 0;
            padding: 15px;
            border: 1px solid #b5b5b5;
            outline: none;
        }

        .register-show input[type="button"] {
            max-width: 150px;
            width: 100%;
            background: #444444;
            color: #f9f9f9;
            border: none;
            padding: 10px;
            text-transform: uppercase;
            border-radius: 2px;
            float:right;
            cursor:pointer;
        }

        .register-show button {
            max-width: 150px;
            width: 100%;
            background: #444444;
            color: #f9f9f9;
            border: none;
            padding: 10px;
            text-transform: uppercase;
            border-radius: 2px;
            float:right;
            cursor:pointer;
            height: 100%;
            max-height: 100px;
        }

        .credit {
            position:absolute;
            bottom:10px;
            left:10px;
            color: #3B3B25;
            margin: 0;
            padding: 0;
            font-family: Arial,sans-serif;
            text-transform: uppercase;
            font-size: 12px;
            font-weight: bold;
            letter-spacing: 1px;
            z-index: 99;
        }
        a{
        text-decoration:none;
        color:#2c7715;
        }
    </style>
    <title>Login</title>

</head>
<body background="assets/img/login.jpg">
<div class="login-reg-panel">
		<div class="login-info-box">
			<h2>Have an account?</h2>
			<label id="label-register" for="log-reg-show">Login</label>
            <input type="radio" name="active-log-panel" id="log-reg-show"  checked="checked">
		</div>
							
		<div class="register-info-box">
			<h2>Don't have an account?</h2>
			<label id="label-login" for="log-login-show">Register</label>
			<input type="radio" name="active-log-panel" id="log-login-show">
		</div>
							
		<div class="white-panel">
            <form action="" method="POST">
                <div class="login-show">
                    <h2>Netizen Net</h2>
                    <hr>
                    <h2>LOGIN</h2>
                    <input type="text" placeholder="Masukkan nik" name="username">
                    <input type="password" placeholder="Masukkan Password" name="password">
                    <button type="submit" name="login">Login </button>

                </div>
            </form>
            <form action="" method="POST">
                <div class="register-show">
                    <h2>Netizen Net</h2>
                    <hr>
                    <h2>REGISTER</h2>
                    <input type="text" placeholder="Masukkan nik" name="nik" required>
                    <input type="text" placeholder="Masukkan Nama Lengkap" name="nama" required>
                    <input type="email" placeholder="Masukkan Email" name="email" required>
                    <input type="password" placeholder="Masukkan Password" name="password" required>
                    <input type="password" placeholder="Konfirmasi Password" name="password2" required>
                    <select name="level" id="" required>
                        <option value="Pengawas">Pengawas Lapangan</option>
                        <option value="Operasional">Operasional</option>
                    </select>
                    <button type="submit" name="register"> Register </button>
                </div>
            </form>
		</div>
	</div>
</body>
<script>
    $(document).ready(function(){
        $('.login-info-box').fadeOut();
        $('.login-show').addClass('show-log-panel');
    });


    $('.login-reg-panel input[type="radio"]').on('change', function() {
        if($('#log-login-show').is(':checked')) {
            $('.register-info-box').fadeOut(); 
            $('.login-info-box').fadeIn();
            
            $('.white-panel').addClass('right-log');
            $('.register-show').addClass('show-log-panel');
            $('.login-show').removeClass('show-log-panel');
            
        }
        else if($('#log-reg-show').is(':checked')) {
            $('.register-info-box').fadeIn();
            $('.login-info-box').fadeOut();
            
            $('.white-panel').removeClass('right-log');
            
            $('.login-show').addClass('show-log-panel');
            $('.register-show').removeClass('show-log-panel');
        }
    });
</script>
</html>