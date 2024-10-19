<?php 

$koneksi = mysqli_connect("localhost", "root", "", "db_perpusk1");

function tambah ($data){
    global $koneksi;

    $nim = $data["nim"];
    $nama = $data["nama"];
    $status = $data["status"];
    $alamat = $data["alamat"];
    $no_hp = $data["no_hp"];
    $password = $data["password"];

    $cekNim = mysqli_query($koneksi, "SELECT * FROM tb_anggota WHERE nim = '$nim'");
    if (mysqli_num_rows($cekNim) > 0) {
        echo "
        <script>
            alert('NIM sudah ada, data gagal ditambahkan!');
            document.location.href = 'data_anggota.php';
        </script>
        ";
        exit;
    }

    // upload gambar
    $gambar = upload();
    // !$gambar / $gambar == false
    if (!$gambar){
        return false;
    }

    mysqli_query($koneksi, "INSERT INTO tb_anggota VALUES ('$nim', '$nama', '$status', '$alamat', '$no_hp', '$password', '$gambar')");

    return mysqli_affected_rows($koneksi);
}

function upload (){

    $namaFile = $_FILES['gambar']['name'];
    $ukuranFile = $_FILES['gambar']['size'];
    $error = $_FILES['gambar']['error'];
    $tmpName = $_FILES['gambar']['tmp_name'];

    // cek apakah tidak ada gambar yag di upload
    if ($error === 4){
        echo "
            <script>
                alert('pilih gambar terlebih dahulu!');
            </script>";
        return false;
    }

    // cek apakah yang diupload adalah gambar
    $ekstensiGambarValid = ['jpg', 'jpeg', 'png'];
    $ekstensiGambar = explode('.', $namaFile);
    $ekstensiGambar = strtolower(end($ekstensiGambar));
    if (!in_array($ekstensiGambar, $ekstensiGambarValid)){
        echo "
            <script>
                alert('yang anda upload bukan gambar!');
            </script>";
        return false;
    }

    // cek jika ukuran gambar terlalu besar
    if ($ukuranFile > 1000000){
        echo "
            <script>
                alert('ukuran gambar terlalu besar!');
            </script>";
        return false;
    }

    // lolos pengecekan, gambar siap diupload
    // generate nama gambar baru
    $namaFileBaru = uniqid();
    $namaFileBaru .= '.';
    $namaFileBaru .= $ekstensiGambar;

    move_uploaded_file($tmpName, 'img/'.$namaFileBaru);
    return $namaFileBaru;
}

function hapus ($id){
    global $koneksi;
    mysqli_query($koneksi, "DELETE FROM tb_anggota WHERE nim = $id");
    return mysqli_affected_rows($koneksi);
}

function ubah ($data){
    global $koneksi;

    $nim = $data["nim"];
    $nama = $data["nama"];
    $status = $data["status"];
    $alamat = $data["alamat"];
    $no_hp = $data["no_hp"];
    $password = $data["password"];
    $gambarLama = $data["gambarLama"];

    // cek apakah user pilih gambar baru
    if($_FILES["gambar"]["error"]==4){
        $gambar = $gambarLama;
    } else{
        $gambar = upload();
        if ($gambar === false){
            $gambar = $gambarLama;
        }
    }

    mysqli_query($koneksi, "UPDATE tb_anggota SET nama = '$nama', status = '$status', alamat = '$alamat', no_hp = '$no_hp', password = '$password', gambar = '$gambar'  WHERE nim = '$nim'");

    return mysqli_affected_rows($koneksi);
}