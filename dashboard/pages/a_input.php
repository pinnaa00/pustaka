<div class="container-fluid">
    <div class="row">
        <div class="col-lg-12">
            <h1 class="page-header">INPUT ANGGOTA</h1>
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
                    <form role="form" action="pages/p_anggota/p_ainput.php" method="POST" enctype="multipart/form-data">
                        <div class="row">
                            <div class="col-lg-4">
                                <div class="form-group">
                                    <label>NIK</label>
                                    <input name="nik" type="text" class="form-control" placeholder="Masukkan NIK">
                                    <?php
                                        if(isset($_SESSION['msg'] ['nik'])){
                                            echo '<span class="text-danger">' . $_SESSION['msg']['nik'] . '</span>';
                                        }
                                        ?>
                                </div>
                                <div class="form-group">
                                    <label>NAMA</label>
                                    <input name="nama" type="text" class="form-control" placeholder="Masukkan Name">
                                    <?php
                                        if(isset($_SESSION['msg'] ['nama'])){
                                            echo '<span class="text-danger">' . $_SESSION['msg']['nama'] . '</span>';
                                        }
                                        ?>
                                </div>
                                <div class="form-group">
                                    <label>No Hp</label>
                                    <input name="nohp" type="number" class="form-control" placeholder="MasukkanNo Hp">
                                    <?php
                                        if(isset($_SESSION['msg'] ['nohp'])){
                                            echo '<span class="text-danger">' . $_SESSION['msg']['nohp'] . '</span>';
                                        }
                                        ?>
                                </div>
                            </div>
                            <div class="col-lg-4">
                                <div class="form-group">
                                    <label>EMAIL</label>
                                    <input name="email" type="email" class="form-control" placeholder="Masukkan Email">
                                    <?php
                                        if(isset($_SESSION['msg'] ['email'])){
                                            echo '<span class="text-danger">' . $_SESSION['msg']['email'] . '</span>';
                                        }
                                        ?>
                                </div>
                                <div class="form-group">
                                    <label>ALAMAT</label>
                                    <input name="alamat" type="text" class="form-control" placeholder="Masukkan Alamat">
                                    <?php
                                        if(isset($_SESSION['msg'] ['alamat'])){
                                            echo '<span class="text-danger">' . $_SESSION['msg']['alamat'] . '</span>';
                                        }
                                        ?>
                                </div>
                                <div class="form-group">
                                    <label>FOTO</label>
                                    <input name="foto" type="file" class="form-control" accept=".jpg, .png , .jpeg">
                                    <?php
                                        if(isset($_SESSION['msg'] ['foto'])){
                                            '<span class="text-danger">' . $_SESSION['msg']['foto'] . '</span>';
                                        }
                                        ?>
                                </div>
                            </div>
                        </div>
                        <div class="row mt-4">
                            <div class="col-lg-12 text-end">
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
<?php unset($_SESSION['msg']);?>