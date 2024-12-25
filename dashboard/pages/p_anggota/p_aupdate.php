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

session_start();

// Validasi jika kosong
if ($nik == '') {
    $_SESSION['msg']['nik'] = "Kolom Tidak Boleh Kosong!";
}
if ($nama == '') {
    $_SESSION['msg']['nama'] = "Kolom Tidak Boleh Kosong!";
}
if ($nohp == '') {
    $_SESSION['msg']['nohp'] = "Kolom Tidak Boleh Kosong!";
}
if ($email == '') {
    $_SESSION['msg']['email'] = "Kolom Tidak Boleh Kosong!";
}
if ($alamat == '') {
    $_SESSION['msg']['alamat'] = "Kolom Tidak Boleh Kosong!";
}

// Validasi jika foto kosong
if ($foto['error'] == UPLOAD_ERR_NO_FILE) {
    $_SESSION['msg']['foto'] = "Kolom Foto Tidak Boleh Kosong!";
}

// Jika ada error, kembali ke halaman sebelumnya
if (!empty($_SESSION['msg'])) {
    header('location: ../../index.php?page=p_aupdate&nik=' . $nik);
    exit();
}

include('../../components/koneksi.php');

// Validasi jika data sudah ada
$query = "SELECT * FROM anggota WHERE nama='$nama' AND nohp='$nohp' AND email='$email' AND alamat='$alamat' AND nik != '$nik'";
$q = mysqli_query($koneksi, $query);
if (mysqli_num_rows($q) != 0) {
    $_SESSION['msg']['error'] = "Data anggota dengan nama, nohp, email, atau alamat yang sama sudah ada";
    header('location: ../../index.php?page=p_aupdate&nik=' . $nik);
    exit();
}

//  jika pakai foto yang baru
$namaFile = $foto['name']; // Nama file foto yang diupload
$targetFilePath = 'image/' . $namaFile;

// Jika foto baru
if ($foto['error'] == UPLOAD_ERR_OK) {
    move_uploaded_file($foto['tmp_name'], $targetFilePath);
} else {
    // Jika tidak ada foto baru, PAKE foto lama
    $query = "SELECT foto FROM anggota WHERE nik='$nik'";
    $result = mysqli_query($koneksi, $query);
    if ($row = mysqli_fetch_assoc($result)) {
        $namaFile = $row['foto']; // Ambil foto lama jika tidak ada foto baru
    }
}

// Update data anggota
$query = "UPDATE anggota SET nama='$nama', nohp='$nohp', email='$email', alamat='$alamat', foto='$namaFile' WHERE nik='$nik'";
if (mysqli_query($koneksi, $query)) {
    $_SESSION['msg']['success'] = "Data anggota berhasil diupdate.";
} else {
    $_SESSION['msg']['error'] = "Gagal mengupdate data anggota.";
}

header('location: ../../index.php?page=a_data');
exit();
?>