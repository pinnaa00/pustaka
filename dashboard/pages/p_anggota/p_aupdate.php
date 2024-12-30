<?php
session_start();

if (!isset($_POST['btn-submit'])) {
    header('location: ./../index.php?page=a_data');
    exit();
}

// Mengambil data dari form
$nik = $_POST['nik'];
$nama = $_POST['nama'];
$nohp = $_POST['nohp'];
$email = $_POST['email'];
$alamat = $_POST['alamat'];
$foto = $_FILES['foto'];

// Validasi input kosong
if ($nik == '') $_SESSION['msg']['nik'] = "Kolom NIK Tidak Boleh Kosong!";
if ($nama == '') $_SESSION['msg']['nama'] = "Kolom Nama Tidak Boleh Kosong!";
if ($nohp == '') $_SESSION['msg']['nohp'] = "Kolom Nomor HP Tidak Boleh Kosong!";
if ($email == '') $_SESSION['msg']['email'] = "Kolom Email Tidak Boleh Kosong!";
if ($alamat == '') $_SESSION['msg']['alamat'] = "Kolom Alamat Tidak Boleh Kosong!";

// Jika ada error, redirect ke halaman update
if (!empty($_SESSION['msg'])) {
    header('location: ../../index.php?page=p_aupdate&nik=' . $nik);
    exit();
}

// Menghubungkan ke database
include('../../components/koneksi.php');

// Validasi data duplikat berdasarkan Email
$query = "SELECT * FROM anggota WHERE email='$email' AND nik != '$nik'";  // duplikat berdasasrkan email dan nik
$result = mysqli_query($koneksi, $query);
if (mysqli_num_rows($result) > 0) {
    $_SESSION['msg']['error'] = "Data anggota dengan Email yang sama sudah ada.";
    header('location: ../../index.php?page=a_input_update&nik=' . $nik);
    exit();
}

// Ambil data anggota lama untuk perbandingan
$query = "SELECT * FROM anggota WHERE nik='$nik'";
$result = mysqli_query($koneksi, $query);
$row = mysqli_fetch_assoc($result);

// Proses foto baru jika ada
$namaFileBaru = $row['foto']; // Menggunakan foto lama sebagai default

if ($foto['error'] !== UPLOAD_ERR_NO_FILE) {
    $ekstensiValid = ['jpg', 'jpeg', 'png'];
    $ekstensiFile = strtolower(pathinfo($foto['name'], PATHINFO_EXTENSION));

    if (in_array($ekstensiFile, $ekstensiValid)) {
        // Hapus foto lama jika ada
        $folder = 'image/';
        $oldFilePath = $folder . $row['foto'];
        if ($row['foto'] && file_exists($oldFilePath)) {
            unlink($oldFilePath);
        }

        // Generate nama file unik untuk foto baru
        $namaFileBaru = md5(time() . $foto['name']) . '.' . $ekstensiFile;
        $targetFilePath = $folder . $namaFileBaru;

        if (!move_uploaded_file($foto['tmp_name'], $targetFilePath)) {
            $_SESSION['msg']['error'] = "Gagal mengupload foto baru.";
            header('location: ../../index.php?page=p_aupdate&nik=' . $nik);
            exit();
        }
    } else {
        $_SESSION['msg']['error'] = "Format foto tidak valid. Hanya JPG, JPEG, dan PNG yang diperbolehkan.";
        header('location: ../../index.php?page=p_aupdate&nik=' . $nik);
        exit();
    }
}

// Update data anggota
$query = "UPDATE anggota SET nama='$nama', nohp='$nohp', email='$email', alamat='$alamat', foto='$namaFileBaru' WHERE nik='$nik'";

if (mysqli_query($koneksi, $query)) {
    $_SESSION['msg']['success'] = "Data anggota berhasil diperbarui.";
} else {
    $_SESSION['msg']['error'] = "Gagal memperbarui data anggota: " . mysqli_error($koneksi);
}

header('location: ../../index.php?page=a_data');
exit();
?>