<?php
if (!isset($_POST['btn-submit'])) {
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
$file_tmp = $foto['tmp_name'];

session_start();

// Validasi input kosong
if ($nik == '') $_SESSION['msg']['nik'] = "Kolom Tidak Boleh Kosong!";
if ($nama == '') $_SESSION['msg']['nama'] = "Kolom Tidak Boleh Kosong!";
if ($nohp == '') $_SESSION['msg']['nohp'] = "Kolom Tidak Boleh Kosong!";
if ($email == '') $_SESSION['msg']['email'] = "Kolom Tidak Boleh Kosong!";
if ($alamat == '') $_SESSION['msg']['alamat'] = "Kolom Tidak Boleh Kosong!";
if ($foto['error'] !== UPLOAD_ERR_OK) $_SESSION['msg']['foto'] = "Kolom Foto Tidak Boleh Kosong!";

if (!empty($_SESSION['msg'])) {
    header('location: ../../index.php?page=a_input');
    exit();
}

// Menghubungkan ke database
include('../../components/koneksi.php');

// Validasi data duplikat
$query = "SELECT * FROM anggota WHERE nik = '$nik'";
$result = mysqli_query($koneksi, $query);
if (mysqli_num_rows($result) > 0) {
    $_SESSION['msg']['error'] = "Data anggota dengan NIK ini sudah ada.";
    header('location: ../../index.php?page=a_input');
    exit();
}

// Memindahkan file foto
$namaFile = $foto['name']; // Menggunakan nama file asli
move_uploaded_file($file_tmp, '../../assets/images/' . $namaFile);

// Menyimpan data ke database
$query = "INSERT INTO anggota (nik, nama, nohp, email, alamat, foto) VALUES ('$nik', '$nama', '$nohp', '$email', '$alamat', '$namaFile')";
if (mysqli_query($koneksi, $query)) {
    $_SESSION['msg']['success'] = "Data anggota baru berhasil diinput.";
} else {
    $_SESSION['msg']['error'] = "Gagal menyimpan data anggota.";
}

header('location: ../../index.php?page=a_input');
exit();
?>