<?php 
session_start();


// Ambil data dari form
$username = $_POST['username'];
$password = $_POST['password'];

// Simpan username dan password di session jika validasi sudah OK
$_SESSION['username'] = $username;
$_SESSION['password'] = $password;

// Memastikan form sudah disubmit sebelum memproses
if (!isset($_POST['btn-login'])) {
    header('location:login_form.php');
    exit();
}
// Validasi input
if ($username == '') {
    $_SESSION['msg-user'] = "Username tidak boleh kosong.";
}

if ($password == '') {
    $_SESSION['msg-pass'] = "Password tidak boleh kosong.";
}
if (isset($_SESSION['msg-user']) || isset($_SESSION['msg-pass'])){
    header('location: login_form.php');
    exit();
}



// Koneksi ke database
$connect = mysqli_connect('localhost', 'root', '', '2024sem5_sore');
if (!$connect) {
    die('Koneksi gagal: ' . mysqli_connect_error());
}

// Gunakan prepared statement untuk mencegah SQL Injection
$connect = mysqli_connect("localhost", "root", "", "2024sem5_sore");

$sql = "SELECT * FROM users WHERE username='$username' AND password='$password'";
$query = mysqli_query($connect, $sql);
$numRow = mysqli_num_rows($query);
if($numRow == 0){
   $_SESSION['msg-global'] = "Data login tidak valid.";
   header('location: login_form.php');
   exit();
}

// Login berhasil, set session dan arahkan ke dashboard
$_SESSION['login'] = true;
header('location: ../../?page=dashboard');
exit();
?>