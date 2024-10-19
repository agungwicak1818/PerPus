<?php
session_start();
require "functions.php";

if (!isset($_SESSION['login'])) {
    header("Location:../login.php");
    exit;
}

$query =  "SELECT * FROM tb_peminjaman";

if (isset($_POST['cari'])) {
    $keyword = $_POST["keyword"];
    if ($keyword == "") {
        $datas = mysqli_query($koneksi, $query);
    } else {
        $query = "SELECT * FROM tb_peminjaman 
                WHERE
                id_peminjaman LIKE '%$keyword%' OR
                tgl_peminjaman LIKE '%$keyword%' OR
                tgl_pengembalian LIKE '%$keyword%' OR
                jam LIKE '%$keyword%' OR
                nim LIKE '%$keyword%' OR
                id_buku LIKE '%$keyword%'
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
    <title>Dashboard PerpusK1 - Data Peminjaman</title>
    <link rel="stylesheet" href="../style.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css" integrity="sha512-iecdLmaskl7CVkqkXNQ/ZH/XLlvWZOJyj7Yy7tcenmpD1ypASozpmT/E0iPtmFIB46ZmdtAc9eNBvH0H/ZpiBw==" crossorigin="anonymous" referrerpolicy="no-referrer" />
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
                <li><a href="../kelola_buku/data_buku.php">Data Buku</a></li>
                <li><a href="data_pinjam.php">Data Peminjaman</a></li>
                <li><a onclick="return confirm('Apakah anda yakin ingin keluar?')" href="../logout.php">Logout</a></li>
            </ul>
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
                    <a href="tambah_pinjam.php">Tambah Pinjam</a>
                </div>
            </div>
            <div class="details">
                <?php if (!isset($error)) : ?>

                    <table>
                        <tr>
                            <th>No</th>
                            <th>Id Peminjaman</th>
                            <th>Tgl Peminjaman</th>
                            <th>Tgl Pengembalian</th>
                            <th>Jam</th>
                            <th>Nim</th>
                            <th>Id Buku</th>
                            <th>Aksi</th>
                        </tr>
                        <?php
                        $i = 1;
                        while ($data = mysqli_fetch_array($datas)) :
                        ?>
                            <?php if ($i % 2 == 0) : ?>
                                <tr style="text-align: center;" class="baris-genap">
                                <?php else : ?>
                                <tr style="text-align: center;" class="baris-ganjil">
                                <?php endif; ?>
                                <td><?= $i++; ?></td>
                                <td><?= $data["id_peminjaman"] ?></td>
                                <td><?= $data["tgl_peminjaman"] ?></td>
                                <td><?= $data["tgl_pengembalian"] ?></td>
                                <td><?= $data["jam"] ?></td>
                                <td><?= $data["nim"] ?></td>
                                <td><?= $data["id_buku"] ?></td>
                                <td>
                                    <a href="hapus_pinjam.php?id=<?= $data['id_peminjaman'] ?>" onclick="return confirm('yakin hapus data?')"><i class="fa-solid fa-trash-can"></i></a>
                                </td>
                                </tr>

                            <?php
                        endwhile;
                            ?>
                    </table>
                <?php else : ?>
                    <div class="notify-kosong">
                        <p>Data tidak ditemukan!</p>
                    </div>
                <?php endif; ?>
            </div>
        </div>
    </div>

</body>

</html>