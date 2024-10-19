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

$query =  "SELECT * FROM tb_peminjaman WHERE nim = '$username'";

if (isset($_POST['cari'])) {
    $keyword = $_POST["keyword"];
    if ($keyword == "") {
        $datas_pinjam = mysqli_query($koneksi, $query);
    } else {
        $query = "SELECT * FROM tb_peminjaman 
                WHERE nim = '$username' AND (
                id_peminjaman LIKE '%$keyword%' OR
                tgl_peminjaman LIKE '%$keyword%' OR
                tgl_pengembalian LIKE '%$keyword%' OR
                jam LIKE '%$keyword%' OR
                id_buku LIKE '%$keyword%')
                ";
        $datas_pinjam = mysqli_query($koneksi, $query);
        if (mysqli_num_rows($datas_pinjam) === 0) {
            $error = true;
        }
    }
}

$datas_pinjam = mysqli_query($koneksi, $query);
$jumlah_datas = mysqli_num_rows($datas_pinjam);
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dashboard PerpusK1 - Data Peminjaman</title>
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
                <h2>Data Peminjaman</h2>
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
                <?php if ($jumlah_datas > 0) : ?>
                    <table>
                        <tr>
                            <th>No</th>
                            <th>Id Peminjaman</th>
                            <th>Tgl Peminjaman</th>
                            <th>Tgl Pengembalian</th>
                            <th>Jam</th>
                            <th>Id Buku</th>
                        </tr>
                        <?php
                        $i = 1;
                        while ($data = mysqli_fetch_array($datas_pinjam)) :
                        ?>
                            <?php if ($i % 2 == 0) : ?>
                                <tr style="text-align: center;" class="baris-genap">
                                <?php else : ?>
                                <tr style="text-align: center;" class="baris-ganjil">
                                <?php endif; ?>
                                <td><?= $i++ ?></td>
                                <td><?= $data["id_peminjaman"] ?></td>
                                <td><?= $data["tgl_peminjaman"] ?></td>
                                <td><?= $data["tgl_pengembalian"] ?></td>
                                <td><?= $data["jam"] ?></td>
                                <td><?= $data["id_buku"] ?></td>
                                </tr>
                            <?php
                        endwhile;
                            ?>
                    </table>
                <?php else : ?>
                    <div class="notify-kosong">
                        <p>Belum ada data peminjaman buku!</p>
                    </div>
                <?php endif; ?>
            <?php else : ?></tr>
                <div class="notify-kosong">
                    <p>Data tidak ditemukan!</p>
                </div>
            <?php endif; ?>
        </div>
    </div>
</body>

</html>