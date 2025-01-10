<?php
session_start();
include('../../components/koneksi.php');

    // Redirect jika form di-submit
if (!isset($_POST['submit'])) {
    header('location: ../../index.php');
    exit();
}

// Ambil data dari form
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
}


// Validasi anggota

if (empty($nik)) {
    $_SESSION['msg']['nik'] = "Tidak ada NIK yang dicari!";
// } else if (strlen($nik) < 16 || mysqli_num_rows(mysqli_query($koneksi, "SELECT * FROM anggota WHERE nik='$nik'")) == 0) {
//     $_SESSION['msg']['nik'] = "";
} else if (!isset($_REQUEST['id']) && mysqli_num_rows(mysqli_query($koneksi, "SELECT * FROM transaksi WHERE nik='$nik' AND tgl_kembali IS NULL")) != 0) {
    $_SESSION['msg']['general'] = "Anggota belum mengembalikan buku";
}

if (empty($tgl_pinjam)) {
    $_SESSION['msg']['tgl_pinjam'] = "Isi tanggal peminjaman!";
}

if (empty($daftarBuku)) {
    $_SESSION['msg']['buku'] = "Pilih buku yang ingin dipinjam!";
} else {
    $codes = []; // Array untuk menyimpan kode buku yang diinput
    foreach ($daftarBuku as $buku) {
        // Validasi apakah buku dengan kode yang sama sudah ada di input
        if (in_array($buku['kode'], $codes)) {
            $_SESSION['msg']['buku'] = "Tidak bisa meminjam buku dengan kode yang sama!";
            break;
        }
        $codes[] = $buku['kode']; // Tambahkan kode ke array jika belum ada

        // Validasi apakah buku ada di database
        $sql = "SELECT * FROM buku WHERE kode='{$buku['kode']}'";
        $query = mysqli_query($koneksi, $sql);
        if (mysqli_num_rows($query) == 0) {
            $_SESSION['msg']['buku'] = "Buku dengan kode '{$buku['kode']}' tidak ditemukan!";
            break;
        }
    }
}

if (!empty($_SESSION['msg'])) {
    header('location: ../../?page=tr_pinjam');
    exit();
}


/// Mulai transaksi
mysqli_autocommit($koneksi, false);
try {
    $queryTransaksi = "INSERT INTO transaksi (id, nik, tgl_pinjam, tgl_kembali) 
                        VALUES (NULL, '$nik', '$tgl_pinjam', NULL)";
    if (!mysqli_query($koneksi, $queryTransaksi)) {
        throw new Exception(mysqli_error($koneksi));
    }

    $idTransaksi = mysqli_insert_id($koneksi);
    foreach ($daftarBuku as $buku) {
        $buku = $buku['kode'];
        $queryDetail = "INSERT INTO detail_transaksi (id, id_transaksi, nik, kode_buku) 
                        VALUES (NULL, '$idTransaksi', '$nik', '$buku')";
        if (!mysqli_query($koneksi, $queryDetail)) {
            throw new Exception(mysqli_error($koneksi));
        }
    }

    mysqli_commit($koneksi);
    $_SESSION['msg']['sukses'] = "TRANSAKSI PEMINJAMAN BUKU BERHASIL!";
    unset($_SESSION['value']);
    header('location: ../../?page=tr_pinjam');
    exit();
} catch (Exception $e) {
    mysqli_rollback($koneksi);
    $_SESSION['msg']['general'] = "Terjadi kesalahan: " . $e->getMessage();
    header('location: ../../?page=tr_pinjam');
    exit();
}