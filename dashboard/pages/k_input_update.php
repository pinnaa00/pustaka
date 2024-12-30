<?php 
$kode = $_REQUEST['kode'];
include('components/koneksi.php');
$query = "SELECT * FROM kategori WHERE kode='$kode'";
$q = mysqli_query($koneksi, $query);
$data = mysqli_fetch_array($q);
?>

<div class="container-fluid">
    <div class="row">
        <div class="col-lg-12">
            <h1 class="page-header">UPDATE KATEGORI</h1>
        </div>
    </div>
    <div class="row">
        <div class="col-lg-12">
            <div class="panel panel-default">
                <div class="panel-heading">UPDATE KATEGORI</div>
                <div class="panel-body">
                    <?php
                                        if(isset($_SESSION['msg'] ['error'])){
                                            echo $_SESSION['msg'] ['error'];
                                        }
                                        ?>
                    <?php
                                        if(isset($_SESSION['msg'] ['success'])){
                                            echo $_SESSION['msg'] ['success'];
                                        }
                                        ?>
                    <div class="row">
                        <div class="col-lg-6">
                            <!-- ini koneksi ke prosesnya -->
                            <form role="form" action="pages/p_kategori/p_kupdate.php" method="POST">
                                <div class="form-group">
                                    <label>KODE</label>
                                    <input readonly value="<?= $data['kode'] ?>" class="form-control"
                                        placeholder="Masukkan Kode" name="kode" type="text">

                                </div>
                                <div class="form-group">
                                    <label>NAMA</label>
                                    <input value="<?= $data['kode'] ?>" class="form-control" placeholder="Masukkan Nama"
                                        name="nama" type="text">
                                    <?php 
                                        if(isset($_SESSION['msg']['err_nama'])){
                                            echo '<span class="text-danger">'.$_SESSION['msg']['err_nama'].'</span>';
                                        }
                                    ?>
                                </div>
                                <div class="row mt-4">
                                    <div class="col-lg-12 text-end">
                                        <button type="submit" class="btn btn-primary me-2" name="btn-submit">Simpan
                                            Perubahan</button>
                                        <button type="reset" class="btn btn-secondary">Reset</button>
                                    </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
</div>
<?php unset($_SESSION['msg']);
    ?>