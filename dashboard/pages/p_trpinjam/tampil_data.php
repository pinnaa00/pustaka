<?php
include('components/koneksi.php');

// Pagination setup
$limit = 5; // Jumlah data per halaman
$page = isset($_REQUEST['pagination']) ? (int)$_REQUEST['pagination'] : 1; // Halaman saat ini, default 1
$offset = ($page - 1) * $limit; // Hitung offset untuk SQL

// Hitung total data
$totalQuery = mysqli_query($koneksi, "SELECT COUNT(*) AS total FROM buku");
$totalData = mysqli_fetch_assoc($totalQuery)['total'];
$totalPages = ceil($totalData / $limit); // Total halaman

$sql = "SELECT *, COUNT(detail_transaksi.id_transaksi) AS buku_dipinjam 
        FROM transaksi
        LEFT JOIN anggota ON transaksi.nik = anggota.nik
        LEFT JOIN detail_transaksi ON transaksi.id = detail_transaksi.id_transaksi
        GROUP BY transaksi.id ORDER BY transaksi.id DESC LIMIT $limit OFFSET $offset";
$query = mysqli_query($koneksi, $sql);

if ($page < 1) $page = 1;
if ($page > $totalPages) $page = $totalPages;

// detail
if (isset($_REQUEST['id_tr'])) {
    $id = $_REQUEST['id_tr'];

    // Ambil detail transaksi beserta data anggota dan buku
    $sql = "SELECT * FROM detail_transaksi
            LEFT JOIN buku ON detail_transaksi.kode = buku.kode
            LEFT JOIN transaksi ON detail_transaksi.id_transaksi = transaksi.id
            LEFT JOIN anggota ON transaksi.nik = anggota.nik
            WHERE detail_transaksi.id_transaksi = '$id'
   ";
    $query = mysqli_query($koneksi, $sql);

    $queryMember = mysqli_query($koneksi, $sql);
    $dataMember = mysqli_fetch_array($queryMember);
}

// menampilkan data lama di form peminjaman
if (isset($_REQUEST['id'])) {
    $id = $_REQUEST['id'];

    $sql = "SELECT * FROM detail_transaksi
            LEFT JOIN transaksi ON detail_transaksi.id_transaksi = transaksi.id
            LEFT JOIN buku ON detail_transaksi.kode = buku.kode
            LEFT JOIN anggota ON detail_transaksi.nik = anggota.nik
            WHERE detail_transaksi.id_transaksi = '$id'
    ";

    $query = mysqli_query($koneksi, $sql);
    $buku = [];
    if (mysqli_num_rows($query) > 0) {
        while ($row = mysqli_fetch_array($query)) {
            $buku[] = $row; // Menyimpan setiap baris data ke dalam array
        }
    }

    $query = mysqli_query($koneksi, $sql);
    $data = mysqli_fetch_array($query);
}