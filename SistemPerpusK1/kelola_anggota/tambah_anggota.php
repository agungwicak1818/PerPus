<?php
session_start();
require "functions.php";

if (!isset($_SESSION['login'])) {
    header("Location:../login.php");
    exit;
}
if (isset($_POST["submit"])) {
    if (tambah($_POST) > 0) {
        echo "
        <script>
            alert('data berhasil ditambahkan!');
            document.location.href = 'data_anggota.php';
        </script>
        ";
    } else {
        echo "
        <script>
            alert('data gagal ditambahkan!');
            document.location.href = 'data_anggota.php';
        </script>
        ";
    }
}
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dashboard PerpusK1 - Data Anggota - Tambah Anggota</title>
    <link rel="stylesheet" href="../style.css">
    <style>

    </style>
</head>

<body>
    <div class="container">
        <div class="navigation">
            <div class="logo-admin">
                <h2>PerpusK1</h2>
            </div>
            <ul>
                <li><a href="../index.php">Beranda</a></li>
                <li><a href="data_anggota.php">Data Anggota</a></li>
                <li><a href="../kelola_buku/data_buku.php">Data Buku</a></li>
                <li><a href="../kelola_pinjam/data_pinjam.php">Data Peminjaman</a></li>
                <li><a onclick="return confirm('Apakah anda yakin ingin keluar?')" href="../logout.php">Logout</a></li>
            </ul>
        </div>
        <div class="main">
            <div class="top-bar">
                <div class="nama-menu">
                    <h2>Data Anggota</h2>
                </div>
                <div class="sub-menu">
                    <h3>Tambah Anggota << </h3>
                </div>
            </div>
            <div class="details">
                <div class="input-grub">
                    <form action="" method="post" enctype="multipart/form-data">
                        <div class="input-box">
                            <label for="nim">Nim</label>
                            <input type="text" name="nim" id="nim" required>
                        </div>
                        <div class="input-box">
                            <label for="nama">Nama</label>
                            <input type="text" name="nama" id="nama" required>
                        </div>
                        <div class="input-box">
                            <label for="status">Status</label>
                            <select class="select-custom" name="status" id="">
                                <option value="Anggota">Anggota</option>
                                <option value="Admin">Admin</option>
                            </select>
                        </div>
                        <div class="input-box">
                            <label for="alamat">Alamat</label>
                            <input type="text" name="alamat" id="alamat">
                        </div>
                        <div class="input-box">
                            <label for="no_hp">No Hp</label>
                            <input type="text" name="no_hp" id="no_hp">
                        </div>
                        <div class="input-box">
                            <label for="password">Password</label>
                            <input type="text" name="password" id="password" required>
                        </div>
                        <div class="input-box">
                            <label for="gambar">Foto : square max 1 mb</label>
                            <input type="file" name="gambar" id="gambar" required>
                        </div>
                        <div class="input-box">
                            <button type="submit" name="submit">Tambah</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</body>

</html>