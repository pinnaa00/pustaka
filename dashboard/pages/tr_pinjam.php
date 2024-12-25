<?php
include('components/koneksi.php'); 
//untuk mengambil data penerbit
$anggota = "SELECT * FROM anggota";
$selectAnggota = mysqli_query($koneksi, $anggota);
?>
<div class="container-fluid">
    <div class="row">
        <div class="col-lg-12">
            <h1 class="page-header">Peminjaman</h1>
        </div>
    </div>
    <div class="row">
        <div class="col-lg-6">
            <div class="panel panel-default">
                <div class="panel-heading">PEMINJAMAN</div>
                <div class="panel-body">
                    <form role="form" action='pages/p_tr/p_trpininput.php' method="POST">
                        <div class="form-group">
                            <label>NIK</label>
                            <div class="input-group">
                                <input name="nik" type="search" class="form-control" placeholder="Masukkan NIK">
                                <?php
                                        if(isset($_SESSION['msg'] ['nik'])){
                                            echo $_SESSION['msg'] ['nik'];
                                        }
                                        ?>
                                <div class="input-group-btn">
                                    <button type="submit" class="btn btn-primary">Cari</button>
                                </div>
                            </div>
                        </div>
                        <div class="form-group">
                            <label>NAMA</label>
                            <input name="nama" class="form-control" placeholder="Masukkan Nama">
                            <?php
                                        if(isset($_SESSION['msg'] ['nama'])){
                                            echo $_SESSION['msg'] ['nama'];
                                        }
                                        ?>
                        </div>
                        <div class="form-group">
                            <label>TANGGAL PEMINJAMAN</label>
                            <input name="tgl" type="date" class="form-control">
                            <?php
                                        if(isset($_SESSION['msg'] ['tgl'])){
                                            echo $_SESSION['msg'] ['tgl'];
                                        }
                                        ?>
                        </div>
                    </form>
                </div>
            </div>
        </div>
        <div class="col-lg-6">
            <div class="panel panel-default">
                <div class="panel-heading">Buku 1</div>
                <div class="panel-body">
                    <form role="form" action="proses.php" method="POST">
                        <div class="form-group">
                            <label>KODE</label>
                            <input class="form-control" placeholder="Masukkan Kode">
                        </div>
                        <div class="form-group">
                            <label>JUDUL</label>
                            <input class="form-control" placeholder="Masukkan Nama">
                        </div>
                        <div class="text-center">
                            <button type="submit" class="btn btn-primary me-2">Submit</button>
                            <button type="reset" class="btn btn-secondary">Reset</button>
                        </div>
                    </form>
                </div>
            </div>
            <div class="panel panel-default mt-4">
                <div class="panel-heading">Buku 2</div>
                <div class="panel-body">
                    <form role="form" action="proses.php" method="POST">
                        <div class="form-group">
                            <label>KODE</label>
                            <input class="form-control" placeholder="Masukkan Kode">
                        </div>
                        <div class="form-group">
                            <label>NAMA</label>
                            <input class="form-control" placeholder="Masukkan Nama">
                        </div>
                        <div class="text-center">
                            <button type="submit" class="btn btn-primary me-2">Submit</button>
                            <button type="reset" class="btn btn-secondary">Reset</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>