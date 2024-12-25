<?php

$kode = $_REQUEST['kode'];

include('../../components/koneksi.php'); //koneksi

// Ambil nama file gambar dari database sebelum menghapus data
$query = "SELECT cover FROM buku WHERE kode='$kode'";
$result = mysqli_query($koneksi, $query); // Gunakan $koneksi, bukan $connect
if ($result) {
    $data = mysqli_fetch_array($result);
    $filePath = 'image/' . $data['cover']; // Path file gambar

    // Hapus gambar dari folder
    if (file_exists($filePath)) {
        unlink($filePath); // Menghapus file gambar
    }
}

// Hapus data dari database
$query = "DELETE FROM buku WHERE kode='$kode'";
if (mysqli_query($koneksi, $query)) ;
    session_start();
    $_SESSION['msg']['success'] = "Data buku dengan kode $kode berhasil dihapus";
header('location: ../../index.php?page=b_data');
exit();
?>