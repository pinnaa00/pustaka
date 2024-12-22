<!-- jika button submit ditekan  -->
<?php
if(!isset($_POST['btn-submit'])){
    header('location: ../../index.php');
    exit();
}

// mengambil data dari form 
$kode = $_POST['kode'];
$nama = $_POST['nama'];
$alamat = $_POST['alamat'];

session_start();

// validasi jika  kosong 
if($kode == '') {
    $_SESSION['msg']['kode'] = "Kolom Tidak Boleh Kosong!";
}
if($nama == '') {
    $_SESSION['msg']['nama'] = "Kolom Tidak Boleh Kosong!";
}
if($alamat == '') {
    $_SESSION['msg']['alamat'] = "Kolom Tidak Boleh Kosong!";
}
if (isset($_SESSION['msg'] ['kode']) || isset($_SESSION['msg'] ['nama'])|| isset($_SESSION['msg'] ['alamat'])){
    header('location: ../../index.php?page=p_input');
    exit();
}

// memnguhubungkan ke data bases
include('../../components/koneksi.php');

$query = "SELECT * FROM penerbit WHERE kode='$kode' OR nama='$nama'OR alamat='$alamat' ";  // menampilkan tabel kategori di datasbase
$q = mysqli_query($koneksi, $query); //menangkap ke data base
if(mysqli_num_rows($q)!=0){ // msg untuk data yg sudah ada
    $_SESSION['msg']['error'] = "Data penerbit sudah ada, periksa kode atau nama yang sama";
    header('location:../../index.php?page=p_input');
    exit();
}

$query = "INSERT INTO penerbit VALUES('$kode','$nama','$alamat')"; //insert data ke database
mysqli_query($koneksi, $query);
$_SESSION['msg']['success'] = "Data penerbit baru berhasil di input";
header('location:../../index.php?page=p_input');



?>