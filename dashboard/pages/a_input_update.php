<?php 
$nik = $_REQUEST['nik'];
include('components/koneksi.php');
$query = "SELECT * FROM anggota WHERE nik='$nik'";
$q = mysqli_query($koneksi, $query);
$data = mysqli_fetch_array($q);
?>

<div class="container-fluid">
    <div class="row">
        <div class="col-lg-12">
            <h1 class="page-header">UPDATE ANGGOTA</h1>
        </div>
    </div>
    <div class="row">
        <div class="col-lg-12">
            <div class="panel panel-default">
                <div class="panel-heading">ANGGOTA</div>
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
                    <form role="form" action="pages/p_anggota/p_aupdate.php" method="POST"
                        enctype="multipart/form-data">
                        <div class="row">
                            <div class="col-lg-4">
                                <div class="form-group">
                                    <label>NIK</label>
                                    <input readonly value="<?= $data['nik']?>" name="nik" type="text"
                                        class="form-control" placeholder="Masukkan NIK">
                                    <?php 
                                        if(isset($_SESSION['msg']['err_nama'])){
                                            echo '<span class="text-danger">'.$_SESSION['msg']['err_nama'].'</span>';
                                        }
                                    ?>
                                </div>
                                <div class="form-group">
                                    <label>NAMA</label>
                                    <input value="<?= $data['nama']?>" name="nama" type="text" class="form-control"
                                        placeholder="Masukkan Name">
                                </div>
                                <div class="form-group">
                                    <label>No Hp</label>
                                    <input readonly value="<?= $data['nohp']?>" name="nohp" type="number"
                                        class="form-control" placeholder="Masukkan Number">
                                </div>
                            </div>
                            <div class="col-lg-4">
                                <div class="form-group">
                                    <label>EMAIL</label>
                                    <input readonly value="<?= $data['email']?>" name="email" type="email"
                                        class="form-control" placeholder="Masukkan Email">
                                    <?php 
                                        if(isset($_SESSION['msg']['err_nama'])){
                                            echo '<span class="text-danger">'.$_SESSION['msg']['err_nama'].'</span>';
                                        }
                                    ?>
                                </div>
                                <div class="form-group">
                                    <label>ALAMAT</label>
                                    <input value="<?= $data['alamat']?>" name="alamat" type="text" class="form-control"
                                        placeholder="Masukkan Alamat">
                                </div>
                                <div class="form-group">
                                    <label>FOTO</label>
                                    <img src="assets/images/<?= $data['foto'] ?>" alt="Foto"
                                        style="width: 100px; height: auto;">
                                    <input value="<?= $data['foto']?>" name="foto" type="file" class="form-control">
                                </div>
                            </div>
                        </div>
                        <div class="row mt-4">
                            <div class="col-lg-12 text-center">
                                <button type="submit" name="btn-submit" class="btn btn-primary me-2">Submit</button>
                                <button type="reset" class="btn btn-secondary">Reset</button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>