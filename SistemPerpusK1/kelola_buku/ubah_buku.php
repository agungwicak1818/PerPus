<?php
session_start();
require "functions.php";

if (!isset($_SESSION['login'])) {
    header("Location:../login.php");
    exit;
}

$id = $_GET['id'];
$datas = mysqli_query($koneksi, "SELECT * FROM tb_buku WHERE id_buku = '$id'");

if (isset($_POST["submit"])) {
    if (ubah($_POST) > 0) {
        echo "
        <script>
            alert('data berhasil diubah!');
            document.location.href = 'data_buku.php';
        </script>
        ";
    } else {
        echo "
        <script>
            alert('data belum diubah!');
            document.location.href = 'data_buku.php';
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
    <title>Dashboard PerpusK1 - Data Buku - Ubah Buku</title>
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
                    <h3>Ubah Buku << </h3>
                </div>
            </div>
            <div class="details">
                <div class="input-grub">
                    <form action="" method="post">
                        <?php
                        while ($data = mysqli_fetch_array($datas)) :
                        ?>
                            <div class="input-box">
                                <input type="hidden" name="id_buku" id="id_buku" value="<?= $data['id_buku'] ?>">
                            </div>
                            <div class="input-box">
                                <label for="judul">Judul :</label>
                                <input type="text" name="judul" id="judul" value="<?= $data['judul'] ?>">
                            </div>
                            <div class="input-box">
                                <label for="pengarang">Pengarang :</label>
                                <input type="text" name="pengarang" id="pengarang" value="<?= $data['pengarang'] ?>">
                            </div>
                            <div class="input-box">
                                <label for="tahun_terbit">Tahun Terbit :</label>
                                <input type="text" name="tahun_terbit" id="tahun_terbit" value="<?= $data['tahun_terbit'] ?>">
                            </div>
                            <div class="input-box">
                                <button type="submit" name="submit">Simpan</button>
                            </div>
                        <?php
                        endwhile;
                        ?>
                    </form>
                </div>
            </div>
        </div>
    </div>
</body>

</html>