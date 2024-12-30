<?php
session_start();

if(!isset($_POST['btn-submit'])){
    header('location: ../../index.php');
    exit();
}

// Mengambil data dari form
$nik = $_POST['nik'];
$nama = $_POST['nama'];
$nohp = $_POST['nohp'];
$email = $_POST['email'];
$alamat = $_POST['alamat'];
$foto = $_FILES['foto'];
$file_tmp = $_FILES['foto']['tmp_name'];

// Validasi jika kosong
if($nik == '') $_SESSION['msg']['nik'] = "Kolom Tidak Boleh Kosong!";
if($nama == '') $_SESSION['msg']['nama'] = "Kolom Tidak Boleh Kosong!";
if($nohp == '') $_SESSION['msg']['nohp'] = "Kolom Tidak Boleh Kosong!";
if($email == '') $_SESSION['msg']['email'] = "Kolom Tidak Boleh Kosong!";
if($alamat == '') $_SESSION['msg']['alamat'] = "Kolom Tidak Boleh Kosong!";
if ($foto['error'] !== UPLOAD_ERR_OK) $_SESSION['msg']['foto'] = "Upload foto anggota!";

// Periksa apakah ada error
if (!empty($_SESSION['msg'])) {
    header('location: ../../index.php?page=a_input');
    exit();
}

// Menghubungkan ke database
include('../../components/koneksi.php');

// Validasi duplikasi data
$query = "SELECT * FROM anggota WHERE nik='$nik' OR email='$email'";
$q = mysqli_query($koneksi, $query);
if (mysqli_num_rows($q) > 0) {
    $_SESSION['msg']['error'] = "Data dengan NIK atau Email ini sudah ada.";
    header('location: ../../index.php?page=a_input');
    exit();
}

// Validasi dan proses file foto
$ekstensiValid = ['jpg', 'jpeg', 'png'];
$ekstensiFile = strtolower(pathinfo($foto['name'], PATHINFO_EXTENSION));

if (!in_array($ekstensiFile, $ekstensiValid)) {
    $_SESSION['msg']['error'] = "Format file foto tidak valid. Hanya JPG, JPEG, dan PNG yang diperbolehkan.";
    header('location: ../../index.php?page=a_input');
    exit();
}

// Generate nama file unik untuk foto baru
$namaFile = md5(time() . $foto['name']) . '.' . $ekstensiFile;
$targetFilePath = 'image/' . $namaFile;

// Memindahkan file foto setelah validasi ekstensi
if (!move_uploaded_file($file_tmp, $targetFilePath)) {
    $_SESSION['msg']['error'] = "Gagal mengupload foto baru.";
    header('location: ../../index.php?page=a_input');
    exit();
}

// Insert data ke database
$query = "INSERT INTO anggota (nik, nama, nohp, email, alamat, foto) VALUES ('$nik', '$nama', '$nohp', '$email', '$alamat', '$namaFile')";
if (mysqli_query($koneksi, $query)) {
    $_SESSION['msg']['success'] = "Data anggota baru berhasil di input.";
} else {
    $_SESSION['msg']['error'] = "Gagal menyimpan data anggota.";
}

header('location: ../../index.php?page=a_input');
exit();
?>