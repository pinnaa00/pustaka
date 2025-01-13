<?php
session_start();
include('../dashboard/components/koneksi.php');
$sql = "SELECT * FROM buku ORDER BY buku.judul ASC";
$query = mysqli_query($koneksi, $sql);

if (isset($_POST['search'])) {
   $judul = $_POST['judul'];
   $_SESSION['value-judul'] = $judul;
   $sql = "SELECT * FROM buku WHERE judul LIKE '%$judul%' ORDER BY buku.judul ASC";
   $query = mysqli_query($koneksi, $sql);
   if (mysqli_num_rows($query) == 0) {
      $_SESSION['not-found'] = 'Buku Tidak DiTemukan!';
   }
}
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <!-- styles -->
    <?php include('layouts/styles.php') ?>
</head>

<body>

    <div id="wrapper">
        <!-- top nav -->
        <?php include('layouts/navbar.php') ?>
    </div>
    <!-- content -->
    <div class="row mb-12 g-6" id="card">
        <?php 
               if (isset($_SESSION['not-found'])) {
                  echo '<h1 class="text-center bg-warning py-5">'.$_SESSION['not-found'].'</h1>';
               }
               include('layouts/content.php') 
            ?>
    </div>

    <!-- script -->
    <?php include('layouts/script.php') ?>


</body>

</html>