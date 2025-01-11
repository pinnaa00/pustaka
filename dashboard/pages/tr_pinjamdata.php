<?php
include('p_trpinjam/tampil_data.php');
$no = $offset + 1;
?>
<div class="container-fluid">
    <div class="row">
        <div class="col-lg-12">
            <h1 class="page-header">DATA PEMINJAMAN BUKU</h1>
        </div>
        <?php if (isset($_SESSION['msg']['return'])) { ?>
        <div class="alert alert-success ms-2 me-2" role="alert">
            <?php echo $_SESSION['msg']['return']; ?>
        </div>
        <?php } ?>

        <?php if (isset($_SESSION['msg']['delete'])) { ?>
        <div class="alert alert-success ms-2 me-2" role="alert">
            <?php echo $_SESSION['msg']['delete']; ?>
        </div>
        <?php } ?>
        <!-- PAGINATION -->
    </div>
    <!-- /.row -->
    <div class="row">
        <div class="col-lg-12">
            <div class="panel panel-default">
                <!-- BIKIN TEBEL RESPONSIF -->
                <div class="panel-heading">
                    DATA PEMINJAMAN BUKU
                </div>
                <!-- /.panel-heading -->
                <div class="panel-body">
                    <div class="table-responsive">
                        <table class="table table-striped table-bordered table-hover" id="dataTables-example">
                            <thead>
                                <tr>
                                    <th>No</th>
                                    <th>NIK</th>
                                    <th>NAMA</th>
                                    <th>BUKU DIPINJAM</th>
                                    <th>TANGGAL PEMINJAMAN</th>`
                                    <th>TANGGAL PENGEMBALIAN</th>
                                    <th>AKSI</th>
                                </tr>
                            </thead>
                            <tbody class="table-border-bottom-0">
                                <?php while ($data = mysqli_fetch_array($query)) { ?>
                                <tr>
                                    <td><?php echo $no++; ?></td>
                                    <td><?php echo $data['nik']; ?></td>
                                    <td><?php echo $data['nama'] ?></td>
                                    <td><?php echo ($data['tgl_kembali'] != null) ? '0' : $data['buku_dipinjam'] ?>/5
                                    </td>
                                    <td><?php echo $data['tgl_pinjam'] ?></td>
                                    <td><?php echo ($data['tgl_kembali'] != null) ? $data['tgl_kembali'] : '<b>Buku Belum Dikembalikan</b>' ?>
                                    </td>
                                    <td>
                                        <a href="?page=detail_tr&id=<?php echo $data['id_transaksi']; ?>"
                                            class="btn btn-sm btn-warning">
                                            Detail
                                            <i class="ri-book-open-line"></i>
                                        </a> |
                                        <a href="?page=tr_pinjamupdate&id=<?php echo $data['id_transaksi']; ?>"
                                            class="btn btn-sm btn-primary <?php echo ($data['tgl_kembali'] != null || $data['buku_dipinjam'] =='5') ? 'disabled' : '' ?>">
                                            Tambah Buku
                                            <!-- disabled berguna untuk jika ada tanggal kembali maka tambah buku tidak bisa diakses  -->
                                        </a>
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
</div>
<?php unset($_SESSION['msg']); ?>