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

$query =  "SELECT * FROM tb_buku";

if (isset($_POST['cari'])) {
    $keyword = $_POST["keyword"];
    if ($keyword == "") {
        $datas = mysqli_query($koneksi, $query);
    } else {
        $query = "SELECT * FROM tb_buku 
                WHERE
                id_buku LIKE '%$keyword%' OR
                judul LIKE '%$keyword%' OR
                pengarang LIKE '%$keyword%' OR
                tahun_terbit LIKE '%$keyword%'
                ";
        $datas = mysqli_query($koneksi, $query);
        if (mysqli_num_rows($datas) === 0) {
            $error = true;
        }
    }
}
$datas = mysqli_query($koneksi, $query);
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dashboard PerpusK1 - Data Buku</title>
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
                <h2>Data Buku</h2>
            </div>
            <div class="search">
                <form action="" method="post">
                    <input type="text" name="keyword" autofocus placeholder="masukkan keyword pencarian.." autocomplete="off">
                    <button type="submit" name="cari">cari</button>
                </form>
            </div>
            <div class="btn-tambah">
                <h2>
                    <<<<<<< </h2>
            </div>
        </div>

        <div class="details">
            <?php if (!isset($error)) : ?>
                <table>
                    <tr>
                        <th>No</th>
                        <th>Id buku</th>
                        <th>Judul</th>
                        <th>Pengarang</th>
                        <th>tahun terbit</th>
                    </tr>
                    <?php
                    $i = 1;
                    while ($data = mysqli_fetch_array($datas)) :
                    ?>
                        <?php if ($i % 2 == 0) : ?>
                            <tr class="baris-genap">
                            <?php else : ?>
                            <tr class="baris-ganjil">
                            <?php endif; ?>
                            <td><?= $i++; ?></td>
                            <td style="text-align: center;"><?= $data["id_buku"] ?></td>
                            <td><?= $data["judul"] ?></td>
                            <td><?= $data["pengarang"] ?></td>
                            <td><?= $data["tahun_terbit"] ?></td>
                            </tr>
                        <?php
                    endwhile;
                        ?>
                </table>
            <?php else : ?></tr>
                <div class="notify-kosong">
                    <p>Data tidak ditemukan!</p>
                </div>
            <?php endif; ?>
        </div>
    </div>
</body>

</html>