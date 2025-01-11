<?php
session_start();
include('../../components/koneksi.php');

    // Redirect jika form di-submit
if (!isset($_POST['submit'])) {
    header('location: ../../index.php?page=tr_pinjamupdate');
    exit();
}

// Ambil data dari form
$id = $_POST['id'];
$nik = $_POST['nik'];
$nama = $_POST['nama'];
$tgl_pinjam = $_POST['tgl_pinjam'];

// ambil data buku
$daftarBuku = [];
for ($i = 1; $i <= 5; $i++) {
    $kodeBuku = $_POST["buku$i"] ?? '';
    $judulBuku = $_POST["judul$i"] ?? '';
    if (!empty($kodeBuku)) {
        $daftarBuku[] = ['kode' => $kodeBuku, 'judul' => $judulBuku];
    }
}

// Simpan ke sesi untuk redisplay
$_SESSION['value'] = [
    'nik' => $nik,
    'tgl_pinjam' => $tgl_pinjam,
    'nama' => $nama,
];

foreach ($daftarBuku as $key => $buku) {
    $_SESSION['value']["buku" . ($key + 1)] = $buku['kode'];
    $_SESSION['value']["judul" . ($key + 1)] = $buku['judul'];
    if (!empty($kodeBuku)) {
        $books[] = ['kode' => $kodeBuku, 'judul' => $judulBuku];
    }
}


// Ambil data buku lama yang sudah ada di transaksi
$existingBooks = [];
$existingBooksQuery = "SELECT kode_buku FROM detail_transaksi WHERE id_transaksi='$id'";
$existingBooksResult = mysqli_query($koneksi, $existingBooksQuery);
while ($row = mysqli_fetch_assoc($existingBooksResult)) {
   $existingBooks[] = strtoupper($row['kode_buku']);
}

// Filter buku baru
$newBooks = [];
foreach ($daftarBuku as $buku) {
   $kodeBuku = strtoupper($buku['kode']);
   if (!in_array($kodeBuku, $existingBooks)) {
      $newBooks[] = $kodeBuku;
   }
}

//! Validasi form
if (empty($nik)) {
   $_SESSION['msg']['nik'] = "NIK wajib diisi!";
}

if (empty($tgl_pinjam)) {
   $_SESSION['msg']['tgl_pinjam'] = "Tanggal peminjaman wajib diisi!";
}

if (empty($daftarBuku)) {
   $_SESSION['msg']['buku'] = "Tidak ada menambah peminjaman buku baru!";
} else {
   foreach ($daftarBuku as $buku) {
      $sql = "SELECT * FROM buku WHERE kode='{$buku['kode']}'";
      $query = mysqli_query($koneksi, $sql);
      if (mysqli_num_rows($query) == 0) {
         $_SESSION['msg']['buku'] = "Buku dengan kode '{$buku['kode']}' tidak ditemukan!";
      }
   }
}

//! Validasi buku baru
if (empty($newBooks)) {
   $_SESSION['msg']['buku'] = "Tidak ada buku baru yang ditambahkan!";
}

//! Jika ada pesan error, kembalikan ke halaman sebelumnya
if (!empty($_SESSION['msg'])) {
   header('location: ../../?page=tr_pinjamupdate&id=' . $id);
   exit();
}

// Tambahkan buku baru ke transaksi
mysqli_autocommit($koneksi, false);
try {
   foreach ($newBooks as $kodeBuku) {
      $kodeBuku = strtoupper($kodeBuku);
      $queryDetail = "INSERT INTO detail_transaksi (id, id_transaksi, nik, kode_buku) 
                        VALUES (NULL, '$id', '$nik', '$kodeBuku')";
      if (!mysqli_query($koneksi, $queryDetail)) {
         throw new Exception(mysqli_error($koneksi));
      }
   }
   mysqli_commit($koneksi);
   $_SESSION['msg']['sukses'] = "Buku baru berhasil ditambahkan!";
} catch (Exception $e) {
   mysqli_rollback($koneksi);
   $_SESSION['msg']['general'] = "Terjadi kesalahan saat menambahkan buku: " . $e->getMessage();
}

// Redirect ke halaman transaksi
header('location:   ../../?page=tr_pinjamupdate&id=' . $id);
exit();