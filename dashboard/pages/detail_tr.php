<div class="container-fluid">
    <div class="row">
        <div class="col-lg-12">
            <h1 class="page-header">DATA PEMINJAMAN BUKU</h1>
        </div>
        <div class="row">
            <div class="col-lg-12">
                <div class="panel panel-default">
                    <!-- BIKIN TEBEL RESPONSIF -->
                    <div class="panel-heading">
                        DATA ANGGOTA
                    </div>
                    <div class="panel-body">
                        <div class="table-responsive">
                            <?php
                    if(isset($_SESSION['msg']['success'])){
                    echo '
                        <div class="alert alert-success" role="alert">
                            '.$_SESSION['msg']['success'].'
                        </div>
                    ';
                }
                ?>
                            <table class="table table-striped table-bordered table-hover" id="dataTables-example">
                                <thead>
                                    <tr>
                                        <th>NIK</th>
                                        <th>NAMA</th>
                                        <th>NO HP</th>
                                        <th>EMAIL</th>
                                        <th>ALAMAT</th>
                                        <th>FOTO</th>
                                    </tr>
                                </thead>
                                <tbody class="table-border-bottom-0">
                                    <?php 
                            if (isset($_REQUEST['id'])) {
                                $id = $_REQUEST['id'];

                                include('components/koneksi.php');
                                $query = "SELECT * FROM detail_transaksi
                                        LEFT JOIN anggota ON detail_transaksi.nik = anggota.nik 
                                        WHERE detail_transaksi.id_transaksi = '$id' ";
                                $q = mysqli_query($koneksi, $query);
                                $data = mysqli_fetch_array($q);
                            }
                        ?>
                                    <tr>
                                        <td><?= $data['nik'] ?></td>
                                        <td><?= $data['nama'] ?></td>
                                        <td><?= $data['nohp'] ?></td>
                                        <td><?= $data['email'] ?></td>
                                        <td><?= $data['alamat'] ?></td>
                                        <td>
                                            <img src="pages/p_anggota/image/<?= $data['foto'] ?>" alt="" width="100">
                                        </td>
                                    </tr>
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<div class="row">
    <div class="col-lg-12">
        <div class="panel panel-default">
            <!-- BIKIN TEBEL RESPONSIF -->
            <div class="panel-heading">
                DATA BUKU
            </div>
            <!-- /.panel-heading -->
            <div class="panel-body">
                <div class="table-responsive">
                    <?php
                    if(isset($_SESSION['msg']['success'])){
                        echo '
                        <div class="alert alert-success" role="alert">
                        '.$_SESSION['msg']['success'].'
                        </div>
                        ';
                }
                ?>
                    <table class="table table-striped table-bordered table-hover" id="dataTables-example">
                        <thead>
                            <tr>
                                <th>NO</th>
                                <th>KODE BUKU</th>
                                <th>JUDUL BUKU</th>
                                <th>COVER</th>
                            </tr>
                        </thead>
                        <tbody class="table-border-bottom-0">
                            <?php 
                            if (isset($_REQUEST['id'])) {
                                $id = $_REQUEST['id'];
                                $query = "SELECT * FROM detail_transaksi
                                        LEFT JOIN buku ON detail_transaksi.kode_buku = buku.kode
                                        WHERE detail_transaksi.id_transaksi = '$id'";
                                $q = mysqli_query($koneksi, $query);
                            }
                            $no = 1;
                            while ($dataBuku = mysqli_fetch_array($q)) {
                        ?>
                            <tr>
                                <td><?= $no++; ?></td>
                                <td><?= $dataBuku['kode'] ?></td>
                                <td><?= $dataBuku['judul'] ?></td>
                                <td>
                                    <img src="pages/p_buku/image/<?= $dataBuku['cover'] ?>" alt="" width="100">
                                </td>
                            </tr>
                            <?php } ?>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>
<!-- /.panel-body -->
<?php unset($_SESSION['msg']); ?>