<div class="container-fluid">
    <div class="row">
        <div class="col-lg-12">
            <h1 class="page-header">INPUT DATA PENERBIT</h1>
        </div>
    </div>
    <div class="row">
        <div class="col-lg-12">
            <div class="panel panel-default">
                <div class="panel-heading">Input Data Penerbit</div>
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
                        <div class="col-lg-12">
                            <form role="form" action="pages/p_penerbit/p_pinput.php" method="POST">
                                <div class="form-group">
                                    <label>KODE</label>
                                    <input class="form-control" placeholder="Masukkan Kode" name="kode">
                                    <?php
                                        if(isset($_SESSION['msg'] ['kode'])){
                                            echo $_SESSION['msg'] ['kode'];
                                        }
                                        ?>
                                </div>
                                <div class="form-group">
                                    <label>NAMA</label>
                                    <input class="form-control" placeholder="Masukkan Nama" name="nama">
                                    <?php
                                        if(isset($_SESSION['msg'] ['nama'])){
                                            echo $_SESSION['msg'] ['nama'];
                                        }
                                        ?>
                                </div>
                                <div class="form-group">
                                    <label>ALAMAT</label>
                                    <input class="form-control" type="text" placeholder="Masukkan Alamat" name="alamat">
                                    <?php
                                        if(isset($_SESSION['msg'] ['alamat'])){
                                            echo $_SESSION['msg'] ['alamat'];
                                        }
                                        ?>
                                </div>
                                <div class="row mt-4">
                                    <div class="col-lg-12 text-end">
                                        <button type="submit" class="btn btn-primary me-2"
                                            name="btn-submit">Submit</button>
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
<?php unset($_SESSION['msg']);?>