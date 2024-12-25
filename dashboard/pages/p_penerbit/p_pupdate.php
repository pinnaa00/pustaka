<!-- jika button submit ditekan  -->
<?php
session_start();
if(!isset($_POST['btn-submit'])){
    header('location: ../../index.php');
    exit();
}

// mengambil data dari form 
$kode = $_POST['kode'];
$nama = $_POST['nama'];
$alamat = $_POST['alamat'];


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
if(isset($_SESSION['msg']['nama'])){
    header('location: ../../?page=p_input_update'.$kode);
    exit();
}

if(isset($_SESSION['msg']['alamat'])){
    header('location: ../../index.php?page=p_input_update'.$kode);
    exit();
}

include('../../components/koneksi.php'); //

$query = "SELECT * FROM penerbit WHERE nama='$nama' AND kode != '$kode' ";  // menampilkan tabel kategori di datasbase
$q = mysqli_query($koneksi, $query);
if(mysqli_num_rows($q)!=0){
    $_SESSION['msg']['error'] = "Data kategori sudah ada, periksa kode atau nama yang sama";
    header('location:../../index.php?page=p_input_update&kode='.$kode);
    exit();
}

$query = "UPDATE penerbit SET  nama='$nama', alamat='$alamat' WHERE kode='$kode'";
mysqli_query($koneksi, $query);
$_SESSION['msg']['success'] = "Data kategori berhasil diupdate";
header('location:../../?page=p_data');