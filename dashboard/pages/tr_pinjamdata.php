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
        <!-- /.col-lg-12 -->
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
                                <?php
                                 include('components/koneksi.php');
                                 $query = "SELECT * FROM transaksi";
                                 $q = mysqli_query($koneksi, $query);
                                 $no = 1;
                                 while ($data = mysqli_fetch_array($q)) { ?>
                                <tr>
                                    <td><?php echo $no++; ?></td>
                                    <td><?php echo $data['nik']; ?></td>
                                    <td><?php echo $data['nama'] ?></td>
                                    <td><?php echo ($data['tgl_kembali'] != null) ? '0' : $data['tgl_kembali'] ?>/5
                                    </td>
                                    <td><?php echo $data['tgl_pinjam'] ?></td>
                                    <td><?php echo ($data['tgl_kembali'] != null) ? $data['tgl_kembali'] : '<b>Not return yet</b>' ?>
                                    </td>
                                    <td>
                                        <a href="" class="btn btn-sm btn-info">
                                            Edit
                                            <i class="ri-pencil-line"></i>
                                        </a> |
                                        <a href="?page=transaction/detail-borrower&id=<?php echo $data['id_transaksi']; ?>"
                                            class="btn btn-sm btn-warning">
                                            Detail
                                            <i class="ri-book-open-line"></i>
                                        </a> |
                                        <a href="pages/transaksi/proses/delete.php?nik=<?php echo $data['nik']; ?>"
                                            onclick="return confirm('Anda yakin ingin menghapus data ini?')"
                                            class="btn btn-sm btn-danger">
                                            <i class="ri-delete-bin-line"></i>
                                            Delete
                                        </a>
                                    </td>
                                </tr>
                                <?php } ?>

                            </tbody>
                        </table>
                    </div>
                    <!-- /.table-responsive -->
                </div>
                <!-- /.panel-body -->
                <?php unset($_SESSION['msg']); ?>