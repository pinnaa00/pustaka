<div class="container-fluid">
    <div class="row">
        <div class="col-lg-12">
            <h1 class="page-header">DATA PEMINJAMAN BUKU</h1>
        </div>
        <?php if (isset($_SESSION['msg']['kembali'])) { ?>
        <div class="alert alert-success ms-2 me-2" role="alert">
            <?php echo $_SESSION['msg']['kembali']; ?>
        </div>
        <?php } ?>

        <?php if (isset($_SESSION['msg']['hapus'])) { ?>
        <div class="alert alert-success ms-2 me-2" role="alert">
            <?php echo $_SESSION['msg']['hapus']; ?>
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
                                    <th>JUDUl BUKUL</th>
                                    <th>COVER</th>
                                    <th>TANGGAL PENGEMBALIAN</th>
                                </tr>
                            </thead>
                            <tbody class="table-border-bottom-0">
                                <?php while ($data = mysqli_fetch_array($q)) { ?>
                                <tr>
                                    <td><?php echo $no++; ?></td>
                                    <td><?php echo $data['judul']; ?> | <?= $data['kode']; ?></td>
                                    <td>
                                        <img class="w-25" src="pages/book/image/<?php echo $data['cover']; ?>" alt="">
                                    </td>
                                    <td><?php echo ($data['tgl_kembali'] != null) ? $data['tgl_kembali'] : '<b>Not return yet</b>'; ?>
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