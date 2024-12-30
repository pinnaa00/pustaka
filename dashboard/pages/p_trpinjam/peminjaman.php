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
$buku = array_filter([
    $_POST['buku1'] ?? '',
    $_POST['buku2'] ?? '',
    $_POST['buku3'] ?? '',
    $_POST['buku4'] ?? '',
    $_POST['buku5'] ?? '',
]);

/// show data
$_SESSION['value']['nik'] = $nik;
$_SESSION['value']['tgl_pinjam'] = $tgl_pinjam;
$_SESSION['value']['nama'] = $_POST['nama'];
$_SESSION['value']['judul1'] = $_POST['judul1'];
$_SESSION['value']['judul2'] = $_POST['judul2'];
$_SESSION['value']['judul3'] = $_POST['judul3'];
$_SESSION['value']['judul4'] = $_POST['judul4'];
$_SESSION['value']['judul5'] = $_POST['judul5'];

foreach ($buku as $key => $judul) {
    $_SESSION['value']['judul' . ($key + 1)] = $judul;
}

// Validasi anggota

$sql_anggota ="SELECT * FROM anggota WHERE nik = '$nik'";
$query_anggota = mysqli_query($koneksi, $sql_anggota);
$q_anggota = mysqli_fetch_array($query_anggota);

if ($nik == '') {
    $_SESSION['msg']['nik'] = 'NIK wajib diisi!';
}
if ($tgl_pinjam == '') {
    $_SESSION['msg']['tgl_pinjam'] = 'Isi tanggal pinjam';
}

if (isset($_SESSION['msg']['nik']) || isset($_SESSION['msg']['tgl_pinjam'])) {
    header('location:  ../../?page=tr_pinjam');
    exit();
}

// Validasi buku

$sql_buku ="SELECT * FROM buku WHERE kode = '$kode'";
$query_buku = mysqli_query($koneksi, $sql_buku);
$q_buku = mysqli_fetch_array($query_buku);

if (empty($buku)) {
    $_SESSION['msg']['judul buku'] = "Pilih buku yang ingin dipinjam!";
}

if (isset($_SESSION['msg'])) {
    header('location:  ../../?page=tr_pinjam');
    exit();
}


// Mulai transaksi database
mysqli_autocommit($koneksi, false);


try {
    // Insert ke tabel transaksi
    $queryTransaksi = "INSERT INTO transaksi (id, nik, tgl_pinjam, tgl_kembali) VALUES (NULL, '$nik', '$tgl_pinjam', NULL)";
    $resultTransaksi = mysqli_query($koneksi, $queryTransaksi);
    if (!$resultTransaksi) {
        throw new Exception('Gagal menambahkan transaksi: ' . mysqli_error($koneksi));
    }

    // Ambil ID transaksi terakhir
    $id_transaksi = mysqli_insert_id($koneksi);

    // Insert ke tabel detail_transaksi
    foreach ($buku as $judul) {
        $queryDetail = "INSERT INTO detail_transaksi (id, id_transaksi, nik, kode_buku) VALUES (NULL, '$id_transaksi', '$nik', '$buku')";
        $resultDetail = mysqli_query($koneksi, $queryDetail);
        if (!$resultDetail) {
            throw new Exception('Gagal menambahkan detail transaksi: ' . mysqli_error($koneksi));
        }
    }

    // Commit transaksi
    mysqli_commit($koneksi);

    // Sukses
    $_SESSION['msg']['sukses'] = 'Transaksi peminjaman berhasil ditambahkan!';
    unset($_SESSION['value']);
    header('location: ../../?page=tr_pinjam');
    exit();
} catch (Exception $e) {
    // Rollback jika error
    mysqli_rollback($koneksi);
    $_SESSION['msg']['general'] = 'Terjadi kesalahan: ' . $e->getMessage();
    header('location: ../../?page=tr_pinjam');
    exit();
}