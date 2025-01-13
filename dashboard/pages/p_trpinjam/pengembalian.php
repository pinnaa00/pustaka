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

$_SESSION['value']['nik'] = $nik;
$_SESSION['value']['tgl_kembali'] = $tgl_kembali;
$_SESSION['value']['nama'] = $_POST['nama'];
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

// Redirect kembali jika ada error
if (isset($_SESSION['msg'])) {
   header('location: ../../index.php?page=tr_kembali');
   exit();
}

// Mulai transaksi
mysqli_autocommit($koneksi, false);

    // 1. Cek apakah ada transaksi yang return_date nya NULL untuk satu member
    $sqlCheckReturn = "SELECT * FROM transaksi WHERE nik='$nik'";
    $queryCheckReturn = mysqli_query($koneksi, $sqlCheckReturn);
    $dataBorrow = mysqli_fetch_assoc($queryCheckReturn);
   if (!$dataBorrow) {
      $_SESSION['msg']['failed'] = "Tidak ada peminjaman buku yang belum dikembalikan untuk member ini!";
      header('location: ../../?page=tr_kembali');
      exit();
   }

   // 2. Validasi tanggal pengembalian tidak boleh lebih kecil dari tanggal peminjaman
   $tgl_pinjam = $dataBorrow['tgl_pinjam']; // Ambil tanggal peminjaman
   if (strtotime($tgl_kembali) < strtotime($tgl_pinjam)) {
      $_SESSION['msg']['failed'] = "Tanggal pengembalian tidak boleh lebih kecil dari tanggal peminjaman!";
      header('location: ../../?page=tr_kembali');
      exit();
   }

   // 3. Update return_date untuk transaksi yang belum dikembalikan
   $sqlUpdateTransaksi = "
      UPDATE transaksi 
      SET tgl_kembali='$tgl_kembali' 
      WHERE nik='$nik' AND tgl_kembali IS NULL
   ";
   mysqli_query($koneksi, $sqlUpdateTransaksi);

   // Commit transaksi
   mysqli_commit($koneksi);

   // Set pesan sukses
   $_SESSION['msg']['succses'] = "Buku peminjaman <b>" . $nik . "</b> berhasil dikembalikan!";
   unset($_SESSION['value']);
   header('location: ../../?page=tr_pinjamdata');
   exit();

?>