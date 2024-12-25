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
if ($cover['error'] === UPLOAD_ERR_NO_FILE) $_SESSION['msg']['cover'] = "Upload Cover Buku!";

if (!empty($_SESSION['msg'])) {
    header("location: ../../index.php?page=b_input_update&kode=' . $kode");
    exit();
}


// Menghubungkan ke database
include('../../components/koneksi.php');

// Validasi data duplikat berdasarkan kode buku
$query = "SELECT * FROM buku WHERE isbn='$isbn' AND kode !='kode'";
$result = mysqli_query($koneksi, $query);
if (mysqli_num_rows($result) != 0) {
    $_SESSION['msg']['error'] = "Data buku dengan isbn yang sama sudah ada";
    header('location: ../../index.php?page=b_input_update&kode=' . $kode);
    exit();
}

if (mysqli_num_rows($result) > 0) {
    $_SESSION['msg']['error'] = "Data buku dengan kode ini sudah ada.";
    header('location: ../../index.php?page=b_input_update&kode=' . $kode);
    exit();
}

// Memindahkan file cover
$namaFile = basename($cover['name']); // Menggunakan nama file asli
$targetFilePath = 'image' . $namaFile;
if (move_uploaded_file($file_tmp, $targetFilePath)) {

    // Menyimpan data ke database
    $query = "UPDATE buku SET isbn = '$isbn', tahun = '$tahun', judul = '$judul', nama = '$nama', penerbit = '$penerbit', kategori = '$kategori', bahasa = '$bahasa', sinopsis = '$sinopsis', cover = '$namaFile' WHERE kode = '$kode'";
        if (mysqli_query($koneksi, $query)) {
        $_SESSION['msg']['success'] = "Data buku berhasil diperbarui.";
        header('location: ../../index.php?page=b_data'); 
        exit(); 
    } else {
        $_SESSION['msg']['error'] = "Gagal memperbarui data buku: " . mysqli_error($koneksi);
        header('location: ../../index.php?page=b_data'); 
    }
}

?>