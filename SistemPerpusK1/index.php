<?php
session_start();

if (!isset($_SESSION['login'])) {
    header("Location: login.php");
    exit;
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dashboard PerpusK1 - Beranda</title>
    <link rel="stylesheet" href="style.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css" integrity="sha512-iecdLmaskl7CVkqkXNQ/ZH/XLlvWZOJyj7Yy7tcenmpD1ypASozpmT/E0iPtmFIB46ZmdtAc9eNBvH0H/ZpiBw==" crossorigin="anonymous" referrerpolicy="no-referrer" />
</head>

<body>
    <div class="container">
        <div class="navigation">
            <div class="logo-admin">
                <h2>PerpusK1</h2>
            </div>
            <ul>
                <li><a href="index.php">Beranda</a></li>
                <li><a href="kelola_anggota/data_anggota.php">Data Anggota</a></li>
                <li><a href="kelola_buku/data_buku.php">Data Buku</a></li>
                <li><a href="kelola_pinjam/data_pinjam.php">Data Peminjaman</a></li>
                <li><a onclick="return confirm('Apakah anda yakin ingin keluar?')" href="logout.php">Logout</a></li>
            </ul>
        </div>
        <div class="main">
            <div class="welcome">
                <div class="ucapan">
                    <h2>Selamat Datang Admin!</h2>
                </div>
                <div class="gambar-beranda">
                    <img src="gambar/welcome-kartun.png" alt="">
                </div>
            </div>
        </div>
    </div>
</body>

</html>