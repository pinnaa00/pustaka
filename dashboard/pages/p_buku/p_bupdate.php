<?php
if (!isset($_POST['btn-submit'])) {
    header('location: ../../index.php?page=b_data');
    exit();
}

// Mengambil data dari form
$kode = $_POST['kode'];
$isbn = $_POST['isbn'];
$tahun = $_POST['tahun'];
$judul = $_POST['judul'];
$nama = $_POST['nama'];
$penerbit = $_POST['penerbit'];
$kategori = $_POST['kategori'];
$bahasa = $_POST['bahasa'];
$sinopsis = $_POST['sinopsis'];
$cover = $_FILES['cover'];
$file_tmp = $cover['tmp_name'];

session_start();

// Validasi input kosong
if ($kode == '') $_SESSION['msg']['kode'] = "Kolom Kode Buku Tidak Boleh Kosong!";
if ($isbn == '') $_SESSION['msg']['isbn'] = "Kolom ISBN Tidak Boleh Kosong!";
if ($tahun == '') $_SESSION['msg']['tahun'] = "Kolom Tahun Tidak Boleh Kosong!";
if ($judul == '') $_SESSION['msg']['judul'] = "Kolom Judul Tidak Boleh Kosong!";
if ($nama == '') $_SESSION['msg']['nama'] = "Kolom Nama Penulis Tidak Boleh Kosong!";
if ($penerbit == '') $_SESSION['msg']['penerbit'] = "Pilih Penerbit!";
if ($kategori == '') $_SESSION['msg']['kategori'] = "Pilih Kategori!";
if ($bahasa == '') $_SESSION['msg']['bahasa'] = "Pilih Bahasa!";
if ($sinopsis == '') $_SESSION['msg']['sinopsis'] = "Kolom Sinopsis Tidak Boleh Kosong!";

// Jika ada error, redirect ke halaman update
if (!empty($_SESSION['msg'])) {
    header("location: ../../index.php?page=b_input_update&kode=" . $kode);
    exit();
}

// Menghubungkan ke database
include('../../components/koneksi.php');

// Validasi data duplikat berdasarkan ISBN
$query = "SELECT * FROM buku WHERE isbn='$isbn' AND kode != '$kode'";
$result = mysqli_query($koneksi, $query);
if (mysqli_num_rows($result) > 0) {
    $_SESSION['msg']['error'] = "Data buku dengan ISBN yang sama sudah ada.";
    header('location: ../../index.php?page=b_input_update&kode=' . $kode);
    exit();
}

// Ambil data cover lama dari database
$query = "SELECT cover FROM buku WHERE kode='$kode'";
$result = mysqli_query($koneksi, $query);
$oldCover = '';
if ($row = mysqli_fetch_assoc($result)) {
    $oldCover = $row['cover'];
}

// Memproses file cover baru jika diunggah
if ($cover['error'] !== UPLOAD_ERR_NO_FILE) {
    $ekstensiValid = ['jpg', 'jpeg', 'png'];
    $ekstensiFile = strtolower(pathinfo($cover['name'], PATHINFO_EXTENSION));

    if (in_array($ekstensiFile, $ekstensiValid)) {
        // Hapus cover lama jika ada
        $folder = 'image/';
        $oldFilePath = $folder . $oldCover;
        if ($oldCover && file_exists($oldFilePath)) {
            unlink($oldFilePath);
        }

        // Generate nama file unik untuk cover baru
        $namaFileBaru = md5(time() . $cover['name']) . '.' . $ekstensiFile;
        $targetFilePath = $folder . $namaFileBaru;

        if (!move_uploaded_file($file_tmp, $targetFilePath)) {
            $_SESSION['msg']['error'] = "Gagal mengupload cover baru.";
            header('location: ../../index.php?page=b_input_update&kode=' . $kode);
            exit();
        }
    } else {
        $_SESSION['msg']['error'] = "Format file cover tidak valid. Hanya JPG, JPEG, dan PNG yang diperbolehkan.";
        header('location: ../../index.php?page=b_input_update&kode=' . $kode);
        exit();
    }
} else {
    // Jika tidak ada cover baru, gunakan cover lama
    $namaFileBaru = $oldCover;
}

// Query untuk update data buku
$query = "UPDATE buku SET isbn = '$isbn', tahun = '$tahun', judul = '$judul', nama = '$nama', penerbit = '$penerbit', kategori = '$kategori', bahasa = '$bahasa', sinopsis = '$sinopsis', cover = '$namaFileBaru' WHERE kode = '$kode'";

if (mysqli_query($koneksi, $query)) {
    $_SESSION['msg']['success'] = "Data buku berhasil diperbarui.";
    header('location: ../../index.php?page=b_data');
    exit();
} else {
    $_SESSION['msg']['error'] = "Gagal memperbarui data buku: " . mysqli_error($koneksi);
    header('location: ../../index.php?page=b_input_update&kode=' . $kode);
    exit();
}
?>