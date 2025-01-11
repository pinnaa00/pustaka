<?php
session_start();
include('../../components/koneksi.php');


// Redirect jika form tidak di-submit
if (!isset($_POST['submit'])) {
    header('location: ../../index.php?page=tr_kembali');
    exit();
}

// Ambil data dari form
$nik = $_POST['nik'];
$tgl_kembali = $_POST['tgl_kembali'];


// Validasi anggota

$sql ="SELECT * FROM anggota WHERE nik = '$nik'";
$query = mysqli_query($koneksi, $sql);
$q = mysqli_fetch_array($query);

if ($nik == '') {
    $_SESSION['msg']['nik'] = 'NIK Tidak Ada!';
}
if ($tgl_kembali == '') {
    $_SESSION['msg']['tgl_kembali'] = 'Isi tanggal pengembalian';
}

if (isset($_SESSION['msg']['nik']) || isset($_SESSION['msg']['tgl_kembali'])) {
    header('location:  ../../?page=tr_kembali');
    exit();
}


// Mulai transaksi database
mysqli_autocommit($koneksi, false);


try {
    // 1. Cek apakah ada transaksi yang return_date nya NULL untuk satu member
    $sqlCheckReturn = "SELECT tgl_kembali FROM transaksi WHERE nik='$nik'";
    $queryCheckReturn = mysqli_query($koneksi, $sqlCheckReturn);
    if (!$queryCheckReturn) {
       throw new Exception("Gagal mengecek status pengembalian buku: " . mysqli_error($koneksi));
    }
 
    $nullReturnDate = false; // Menandakan apakah masih ada transaksi dengan tgl_kembali NULL
    $validReturnDate = false; // Menandakan apakah semua transaksi sudah memiliki tgl_kembali yang valid
 
    // Periksa seluruh transaksi member
    while ($dataReturn = mysqli_fetch_array($queryCheckReturn)) {
       if ($dataReturn['tgl_kembali'] == NULL) {
          // Jika ada transaksi dengan tgl_kembali NULL, berarti member masih bisa mengembalikan buku
          $nullReturnDate = true;
       } else {
          // Jika ada transaksi dengan tgl_kembali yang sudah terisi (valid), berarti member sudah mengembalikan buku
          $validReturnDate = true;
       }
    }
 
    // 2. Jika masih ada transaksi dengan tgl_kembali NULL, maka member bisa mengembalikan buku
    if ($nullReturnDate) {
       // Update tgl_kembali pada transaksi yang belum dikembalikan
       $sqlUpdateTransaksi = "UPDATE transaksi SET tgl_kembali='$tgl_kembali' WHERE nik='$nik' AND tgl_kembali IS NULL";
       $queryUpdateTransaksi = mysqli_query($koneksi, $sqlUpdateTransaksi);
       if (!$queryUpdateTransaksi) {
          throw new Exception("Gagal mengupdate tgl_kembali: " . mysqli_error($koneksi));
       }
 
       // Commit transaksi
       mysqli_commit($koneksi);
 
       // Set pesan sukses
       $_SESSION['msg']['return'] = "Buku peminjaman <b>" . $nik . "</b> berhasil dikembalikan!";
       unset($_SESSION['value']);
       header('location: ../../?page=tr_pinjamdata');
       exit();
    } else {
       // Jika tidak ada transaksi dengan return_date NULL, maka member sudah mengembalikan semua bukunya
       $_SESSION['msg']['failed'] = "Tidak ada peminjaman buku dari member ini!";
       header('location: ../../?page=tr_kembali');
       exit();
    }
 
 } catch (Exception $e) {
    // Rollback jika terjadi error
    mysqli_rollback($koneksi);
    $_SESSION['msg']['failed'] = "Terjadi kesalahan saat memproses data: " . $e->getMessage();
    header('location: ../../?page=tr_kembali');
    exit();
 }
 