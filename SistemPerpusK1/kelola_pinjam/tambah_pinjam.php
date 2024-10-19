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
            document.location.href = 'data_pinjam.php';
        </script>
        ";
    } else {
        echo "
        <script>
            alert('data gagal ditambahkan!');
            document.location.href = 'data_pinjam.php';
        </script>
        ";
    }
}

// mengambil data buku dengan kode paling besar
$query = mysqli_query($koneksi, "SELECT max(id_peminjaman) as kodeTerbesar FROM tb_peminjaman");
$data = mysqli_fetch_array($query);
$idPeminjaman = $data['kodeTerbesar'];

// mengambil angka dari kode buku terbesar, menggunakan fungsi substr
// dan diubah ke integer dengan (int)
$urutan = (int) substr($idPeminjaman, 3, 3);

// bilangan yang diambil ini ditambah 1 untuk menentukan nomor urut berikutnya
$urutan++;

// membentuk kode barang baru
// perintah sprintf("%03s", $urutan); berguna untuk membuat string menjadi 3 karakter
// misalnya perintah sprintf("%03s", 15); maka akan menghasilkan '015'
// angka yang diambil tadi digabungkan dengan kode huruf yang kita inginkan, misalnya BRG 
$huruf = "P-";
$idPeminjaman = $huruf . sprintf("%03s", $urutan);
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dashboard PerpusK1 - Data Peminjaman - Tambah Pinjam</title>
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
                <div class="sub-menu">
                    <h3>Tambah Pinjam << </h3>
                </div>
            </div>
            <div class="details">
                <div class="input-grub">
                    <form action="" method="post">
                        <div class="input-box">
                            <input type="hidden" name="id_peminjaman" id="id_peminjaman" value="<?= $idPeminjaman ?>">
                        </div>
                        <div class="input-box">
                            <input type="hidden" name="tgl_peminjaman" id="tgl_peminjaman" value="<?= date('Y/m/d'); ?>">
                        </div>
                        <div class="input-box">
                            <input type="hidden" name="tgl_pengembalian" id="tgl_pengembalian" value="<?= date('Y/m/d', strtotime('+7 days')); ?>">
                            <?php date_default_timezone_set('Asia/Jakarta'); ?>
                            <input type="hidden" name="jam" id="jam" value="<?= date('h:i:s a'); ?>">
                        </div>
                        <div class="input-box">
                            <label for="nim">Nim</label>
                            <select name="nim" id="" class="select-custom">
                                <option value="">Pilih Nim Peminjam</option>
                                <?php
                                $datas = mysqli_query($koneksi, "SELECT nim FROM tb_anggota WHERE status = 'anggota'");
                                while ($data = mysqli_fetch_array($datas)) :
                                ?>
                                    <option value="<?= $data['nim'] ?>"><?= $data['nim'] ?></option>
                                <?php endwhile; ?>
                            </select>
                        </div>
                        <div class="input-box">
                            <label for="id_buku">Id Buku</label>
                            <select name="id_buku" id="" class="select-custom">
                                <option value="">Pilih Buku Pinjaman</option>
                                <?php
                                $datas = mysqli_query($koneksi, "SELECT id_buku FROM tb_buku");
                                while ($data = mysqli_fetch_array($datas)) :
                                ?>
                                    <option value="<?= $data['id_buku'] ?>"><?= $data['id_buku'] ?></option>
                                <?php endwhile; ?>
                            </select>
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