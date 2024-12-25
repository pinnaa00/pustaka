<?php

$nik = $_REQUEST['nik'];

include('../../components/koneksi.php'); // Pastikan koneksi database benar

// Ambil nama file gambar dari database sebelum menghapus data
$query = "SELECT foto FROM anggota WHERE nik='$nik'"; // Ganti kode menjadi nik
$result = mysqli_query($koneksi, $query); // Gunakan $koneksi yang benar
if ($result && mysqli_num_rows($result) > 0) {
    $data = mysqli_fetch_array($result);
    $filePath = 'image/' . $data['foto']; // Path file gambar

    // Hapus gambar dari folder
    if (file_exists($filePath)) {
        unlink($filePath); // Menghapus file gambar
    }
}

// Hapus data dari database
$query = "DELETE FROM anggota WHERE nik='$nik'";
if (mysqli_query($koneksi, $query));
    session_start();
    $_SESSION['msg']['success'] = "Data anggota dengan NIK $nik berhasil dihapus";

header('location: ../../index.php?page=a_data');
exit();
?>