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
            document.location.href = 'data_buku.php';
        </script>
        ";
    } else {
        echo "
        <script>
            alert('data gagal ditambahkan!');
            document.location.href = 'data_buku.php';
        </script>
        ";
    }
}

// mengambil data buku dengan kode paling besar
$query = mysqli_query($koneksi, "SELECT max(id_buku) as kodeTerbesar FROM tb_buku");
$data = mysqli_fetch_array($query);
$idBuku = $data['kodeTerbesar'];

// mengambil angka dari kode buku terbesar, menggunakan fungsi substr
// dan diubah ke integer dengan (int)
$urutan = (int) substr($idBuku, 3, 3);

// bilangan yang diambil ini ditambah 1 untuk menentukan nomor urut berikutnya
$urutan++;

// membentuk kode barang baru
// perintah sprintf("%03s", $urutan); berguna untuk membuat string menjadi 3 karakter
// misalnya perintah sprintf("%03s", 15); maka akan menghasilkan '015'
// angka yang diambil tadi digabungkan dengan kode huruf yang kita inginkan, misalnya BRG 
$huruf = "B-";
$idBuku = $huruf . sprintf("%03s", $urutan);
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dashboard PerpusK1 - Data Buku - Tambah Buku</title>
    <link rel="stylesheet" href="../style.css">
</head>

<body>
    <div class="container">
        <div class="navigation">
            <div class="logo-admin">
                <h2>PerpusK1</h2>
            </div>
            <ul>
                <li><a href="../index.php">Beranda</a></li>
                <li><a href="../kelola_anggota/data_anggota.php">Data Anggota</a></li>
                <li><a href="data_buku.php">Data Buku</a></li>
                <li><a href="../kelola_pinjam/data_pinjam.php">Data Peminjaman</a></li>
                <li><a onclick="return confirm('Apakah anda yakin ingin keluar?')" href="../logout.php">Logout</a></li>
            </ul>
        </div>
        <div class="main">
            <div class="top-bar">
                <div class="nama-menu">
                    <h2>Data Buku</h2>
                </div>
                <div class="sub-menu">
                    <h3>Tambah Buku << </h3>
                </div>
            </div>
            <div class="details">
                <div class="input-grub">
                    <form action="" method="post">
                        <div class="input-box">
                            <input type="hidden" name="id_buku" id="id_buku" value="<?= $idBuku ?>">
                        </div>
                        <div class="input-box">
                            <label for="judul">Judul :</label>
                            <input type="text" name="judul" id="judul" required>
                        </div>
                        <div class="input-box">
                            <label for="pengarang">Pengarang :</label>
                            <input type="text" name="pengarang" id="pengarang">
                        </div>
                        <div class="input-box">
                            <label for="tahun_terbit">Tahun Terbit :</label>
                            <input type="text" name="tahun_terbit" id="tahun_terbit">
                        </div>
                        <div class="input-box">
                            <button type="submit" name="submit">Simpan</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</body>

</html>