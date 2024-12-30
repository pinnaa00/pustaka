<?php
session_start();
include('../../components/koneksi.php');

// Redirect jika tombol reset ditekan
if (isset($_POST['btn-reset'])) {
    header('location: ../../?page=transaksi/tr_pinjam');
    exit();
}

// Redirect jika form tidak di-submit
if (!isset($_POST['submit'])) {
    header('location: ../../index.php?page=dashboard');
    exit();
}

// Ambil data dari form
$nik = $_POST['nik'];
$tgl_pinjam = $_POST['tgl_pinjam'];

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
    header('location:  ../../?page=tr_pinjam');
    exit();
}


// Mulai transaksi database
mysqli_autocommit($koneksi, false);


try {
    // Insert ke tabel transaksi
    $queryUpdateTransaksi = "UPDATE transaksi SET tgl_kembali='$tgl_kembali' WHERE nik='$nik'";
    $resultUpdateTransaksi = mysqli_query($koneksi, $queryUpdateTransaksi);
    if (!$resultUpdateTransaksi) {
        throw new Exception('Gagal mengupdate: ' . mysqli_error($koneksi));
    }

   // 2. Ambil id_transaksi berdasarkan nik_member
   $sqlGetTransaksi = "SELECT id FROM transaksi WHERE nik='$nik' AND tgl_kembali='$tgl_kembali'";
   $resultTransaksi = mysqli_query($connect, $sqlGetTransaksi);
   if (!$resultTransaksi) {
      throw new Exception("Gagal mendapatkan id_transaksi: " . mysqli_error($koneksi));
   }
   $dataTransaksi = mysqli_fetch_array($resultTransaksi);
   $id_transaksi = $dataTransaksi['id'];


    // Commit transaksi
    mysqli_commit($koneksi);

    // Sukses
    $_SESSION['msg']['sukses'] = 'Transaksi peminjaman berhasil ditambahkan!';
    unset($_SESSION['value']);
    header('location: ../../?page=tr_pinjamdata');
    exit();
} catch (Exception $e) {
    // Rollback jika error
    mysqli_rollback($koneksi);
    $_SESSION['msg']['general'] = 'Terjadi kesalahan: ' . $e->getMessage();
    header('location: ../../?page=tr_kembali');
    exit();
}