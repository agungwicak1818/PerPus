<?php
session_start();
require "functions.php";

if (!isset($_SESSION['login'])) {
    header("Location:../login.php");
    exit;
}

$username = $_SESSION['username'];

$datas = mysqli_query($koneksi, "SELECT * FROM tb_anggota WHERE nim = '$username'");
$data = mysqli_fetch_array($datas);

?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dashboard PerpusK1 - Beranda</title>
    <link rel="stylesheet" href="../style.css">
</head>

<body>

    <div class="container">
        <div class="navigation">
            <div class="logo-admin">
                <h2>PerpusK1</h2>
            </div>
            <ul>
                <li><a href="index.php">Beranda</a></li>
                <li><a href="profil.php">Profil</a></li>
                <li><a href="data_buku.php">Data Buku</a></li>
                <li><a href="data_pinjam.php">Data Peminjaman</a></li>
                <li><a onclick="return confirm('Apakah anda yakin ingin keluar?')" href="../logout.php">Logout</a></li>
            </ul>
        </div>
        <div class="main">
            <div class="welcome">
                <div class="ucapan">
                    <h2>Selamat Datang <?= $data['nama'] ?> !</h2>
                </div>
                <div class="gambar-beranda">
                    <img src="../gambar/welcome-kartun.png" alt="">
                </div>
            </div>
        </div>
    </div>
</body>

</html>