<?php 

$koneksi = mysqli_connect("localhost", "root", "", "db_perpusk1");

function tambah ($data){
    global $koneksi;

    $id_buku = $data["id_buku"];
    $judul = $data["judul"];
    $pengarang = $data["pengarang"];
    $tahun_terbit = $data["tahun_terbit"];

    mysqli_query($koneksi, "INSERT INTO tb_buku VALUES ('$id_buku', '$judul', '$pengarang', '$tahun_terbit')");

    return mysqli_affected_rows($koneksi);
}

function hapus ($id){
    global $koneksi;

    mysqli_query($koneksi, "DELETE FROM tb_buku WHERE id_buku = '$id'");

    return mysqli_affected_rows($koneksi);
}

function ubah ($data){
    global $koneksi;

    $id_buku = $data["id_buku"];
    $judul = $data["judul"];
    $pengarang = $data["pengarang"];
    $tahun_terbit = $data["tahun_terbit"];

    mysqli_query($koneksi, "UPDATE tb_buku SET judul = '$judul', pengarang = '$pengarang', tahun_terbit = '$tahun_terbit' WHERE id_buku = '$id_buku'");

    return mysqli_affected_rows($koneksi);
}
?>