<?php
// Memulai sesi dan memastikan koneksi database
session_start();
include('../../components/koneksi.php');

// Mengecek apakah parameter 'q' ada
if (isset($_GET['q'])) {
    $nik = $_GET['q'];

    // Query untuk mencari nama berdasarkan NIK
    $query = "SELECT nama FROM anggota WHERE nik = '$nik' LIMIT 1";
    $q = mysqli_query($koneksi, $query);

    if (mysqli_num_rows($q) > 0) {
        // Menampilkan nama jika NIK ditemukan
        $data = mysqli_fetch_array($q);
        echo $data['nama'];
    } else {
        // Menampilkan pesan jika NIK tidak ditemukan
        echo "Tidak ada data anggota berdasarkan NIK ini!";
    }
}

if (isset($_GET['b'])) {
    $kode = $_GET['b'];

    $query = "SELECT judul FROM buku WHERE kode = '$kode' LIMIT 1";
    $q = mysqli_query($koneksi, $query);

    if (mysqli_num_rows($q) > 0) {
        // Menampilkan judul buku jika kode ditemukan
        $data = mysqli_fetch_array($q);
        echo $data['judul'];
    } else {
        echo "Tidak ada data buku berdasarkan kode ini!";
    }
}

mysqli_close($koneksi);
?>