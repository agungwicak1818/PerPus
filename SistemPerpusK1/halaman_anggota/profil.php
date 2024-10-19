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
    <title>Dashboard PerpusK1 - Profil</title>
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
    </div>
    <div class="main">
        <div class="top-bar">
            <div class="nama-menu">
                <h2>Profil</h2>
            </div>
            <div class="btn-tambah">
                <a href="ubah_profil.php?id=<?= $data['nim'] ?>">Ubah Profil</a>
            </div>
        </div>

        <div class="details">
            <div class="input-grub">
                <form>
                    <div class="input-box">
                        <img class="img-profil" src="../kelola_anggota/img/<?= $data['gambar'] ?>" alt="">
                    </div>
                    <div class="input-box">
                        <label>Nim</label>
                        <input readonly type="text" value="<?= $data['nim'] ?>">
                    </div>
                    <div class="input-box">
                        <label>Nama</label>
                        <input readonly type="text" value="<?= $data['nama'] ?>">
                    </div>
                    <div class="input-box">
                        <label>Status</label>
                        <input readonly type="text" value="<?= $data['status'] ?>">
                    </div>
                    <div class="input-box">
                        <label>Alamat</label>
                        <input readonly type="text" value="<?= $data['alamat'] ?>">
                    </div>
                    <div class="input-box">
                        <label>No Hp</label>
                        <input readonly type="text" value="<?= $data['no_hp'] ?>">
                    </div>
                    <div class="input-box">
                        <label>Password</label>
                        <input readonly type="text" value="<?= $data['password'] ?>">
                    </div>
                </form>
            </div>
        </div>
    </div>
</body>

</html>