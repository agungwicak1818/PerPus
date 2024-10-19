<?php
session_start();
require "functions.php";

if (!isset($_SESSION['login'])) {
    header("Location:../login.php");
    exit;
}

$id = $_GET['id'];
$datas = mysqli_query($koneksi, "SELECT * FROM tb_anggota WHERE nim = '$id'");

if (isset($_POST["submit"])) {
    if (ubah($_POST) > 0) {
        echo "
        <script>
            alert('data berhasil diubah!');
            document.location.href = 'profil.php';
        </script>
        ";
    } else {
        echo "
        <script>
            alert('data gagal diubah!');
            document.location.href = 'profil.php';
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
    <title>Dashboard PerpusK1 - Profil - Ubah Profil</title>
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
            <div class="top-bar">
                <div class="nama-menu">
                    <h2>Profil</h2>
                </div>
                <div class="btn-tambah">
                    <h3>
                        Ubah Profil << </h3>
                </div>
            </div>

            <div class="details">
                <div class="input-grub">
                    <form action="" method="post" enctype="multipart/form-data">
                        <?php
                        while ($data = mysqli_fetch_array($datas)) :
                        ?>
                            <div class="input-box">
                                <input type="hidden" name="nim" id="nim" value="<?= $data['nim'] ?>">
                            </div>
                            <div class="input-box">
                                <input type="hidden" name="gambarLama" value="<?= $data["gambar"] ?>">
                            </div>
                            <div class="input-box">
                                <label for="nama">Nama :</label>
                                <input type="text" name="nama" id="nama" value="<?= $data['nama'] ?>">
                            </div>
                            <div class="input-box">
                                <label for="status">Status :</label>
                                <input readonly type="text" name="status" id="status" value="<?= $data['status'] ?>">
                            </div>
                            <div class="input-box">
                                <label for="alamat">Alamat :</label>
                                <input type="text" name="alamat" id="alamat" value="<?= $data['alamat'] ?>">
                            </div>
                            <div class="input-box">
                                <label for="no_hp">No_Hp :</label>
                                <input type="text" name="no_hp" id="no_hp" value="<?= $data['no_hp'] ?>">
                            </div>
                            <div class="input-box">
                                <label for="password">Password :</label>
                                <input type="text" name="password" id="password" value="<?= $data['password'] ?>">
                            </div>
                            <div class="input-box">
                                <label for="gambar">Foto : square max 1 mb</label>
                                <img class="gambar-profil" src="../kelola_anggota/img/<?= $data['gambar'] ?>" alt="">
                                <input type="file" name="gambar" id="gambar" value="<?= $data['gambar'] ?>">
                            </div>
                            <div class="input-box">
                                <button type="submit" name="submit">Ubah</button>
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