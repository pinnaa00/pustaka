<?php

$nik = $_REQUEST['nik'];

include('../../components/koneksi.php');
$query = "DELETE FROM transaksi WHERE nik='$nik'";
$q= mysqli_query($koneksi, $q);

session_start();
$_SESSION['msg']['delete'] = "Data peminjam <b>'". $nik ."</b>' berhasil di hapus!";
header('location: ../../../?page=tr_pinjamdata');