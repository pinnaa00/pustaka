<?php 

$kode = $_REQUEST['kode'];

include('../../components/koneksi.php');

$query = "DELETE FROM penerbit WHERE kode='$kode'";
mysqli_query($koneksi, $query);
session_start();
$_SESSION['msg']['success'] = "Data kategori ".$kode." berhasil dihapus";
header('location:../../index.php?page=p_data');