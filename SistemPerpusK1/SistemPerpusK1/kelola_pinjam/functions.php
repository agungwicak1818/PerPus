<?php 

$koneksi = mysqli_connect("localhost", "root", "", "db_perpusk1");

function tambah ($data){
    global $koneksi;

    $id_peminjaman = $data["id_peminjaman"];
    $tgl_peminjaman = $data["tgl_peminjaman"];
    $tgl_pengembalian = $data["tgl_pengembalian"];
    $jam = $data['jam'];
    $nim = $data["nim"];
    $id_buku = $data["id_buku"];

    if (empty($nim) || empty($id_buku)) {
        // Tampilkan notifikasi JavaScript
        echo "<script>alert('NIM dan ID Buku harus diisi');</script>";
        return 0; // Mengembalikan nilai 0 menandakan data gagal ditambahkan
    }

    mysqli_query($koneksi, "INSERT INTO tb_peminjaman VALUES ('$id_peminjaman', '$tgl_peminjaman', '$tgl_pengembalian', '$jam', '$nim', '$id_buku')");

    return mysqli_affected_rows($koneksi);
}

function hapus ($id){
    global $koneksi;
    mysqli_query($koneksi, "DELETE FROM tb_peminjaman WHERE id_peminjaman = '$id'");
    return mysqli_affected_rows($koneksi);
}
