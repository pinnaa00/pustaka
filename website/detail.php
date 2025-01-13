<?php 
include('../dashboard/components/koneksi.php');
if ($_REQUEST['kode']) {
    $kode = $_REQUEST['kode'];
    $sql = "SELECT 
        buku.*, 
        kategori.nama AS kategori_nama, 
        penerbit.nama AS penerbit_nama,
        penerbit.kode AS penerbit_kode,        
        kategori.kode AS kategori_kode
    FROM buku
    LEFT JOIN kategori ON buku.kategori = kategori.kode
    LEFT JOIN penerbit ON buku.penerbit = penerbit.kode
    WHERE buku.kode = '$kode'";
    
    $query = mysqli_query($koneksi, $sql);
    $data = mysqli_fetch_assoc($query);
}
?>


<!DOCTYPE html>
<html lang="en">

<head>
    <?php include('layouts/styles.php'); ?>
</head>

<body>
    <div class="row">
        <div class="col-lg-12">
            <div class="panel panel-default">
                <div class="panel-heading">
                </div>
                <!-- /.panel-heading -->
                <div class="panel-body">
                    <div class="table-responsive">
                        <div class=""
                            style="display: flex; justify-content: flex-end; align-items: center; width: 100%;">
                            <a href="index.php" class="btn btn-danger">Close</a>
                        </div>
                        <div>
                            <h2 class="modal-title" style="margin-left: 20px;">Detail Buku</h2>
                            <img width="300" height="" src="../dashboard/pages/p_buku/image/<?= $data['cover']; ?>"
                                alt="">
                        </div>
                        <div class="">
                            <h5><b>Title : </b><?= $data['judul']; ?></h5>
                            <h5><b>Category : </b><?= $data['kategori_nama']; ?></h5>
                            <h5><b>ISBN : </b><?= $data['isbn']; ?></h5>
                            <h5><b>Writer : </b><?= $data['nama']; ?></h5>
                            <h5><b>Publisher : </b><?= $data['penerbit_nama']; ?></h5>
                            <h5><b>Date : </b><?= $data['tahun']; ?></h5>
                            <h5><b>Language : </b><?= $data['bahasa']; ?></h5>
                            <h5><b>Synopsis : </b><?= $data['sinopsis']; ?></h5>
                        </div>
                        <!-- /.col-lg-12 -->
                    </div>
                    <!-- /.row -->
                </div>
                <!-- /.container-fluid -->
            </div>
        </div>
    </div>
    <?php include('layouts/script.php'); ?>
</body>

</html>