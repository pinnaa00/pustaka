<div class="container-fluid">
    <div class="row">
        <div class="col-lg-12">
            <h1 class="page-header">PENGEMBALIAN</h1>
        </div>
    </div>

    <div class="row">
        <!-- Form Peminjaman -->
        <div class="col-lg-6">
            <div class="panel panel-default">
                <div class="panel-heading">PENGEMBALIAN</div>
                <div class="panel-body">
                    <form role="form" action="pages/p_tr/p_trpininput.php" method="POST">
                        <?php if (isset($_SESSION['msg']['sukses'])) { ?>
                        <div class="alert alert-success ms-2 me-2" role="alert">
                            <?php echo $_SESSION['msg']['sukses']; ?>
                        </div>
                        <?php } ?>

                        <?php if (isset($_SESSION['msg']['general'])) { ?>
                        <div class="alert alert-danger ms-2 me-2" role="alert">
                            <?php echo $_SESSION['msg']['general']; ?>
                        </div>
                        <?php } ?>

                        <!-- Baris 1: NIK dan Nama -->
                        <div class="form-group">
                            <label for="nik">NIK</label>
                            <div class="input-group input-group-merge">
                                <span
                                    class="input-group-text <?php echo isset($_SESSION['msg']['nik']) ? 'border-danger' : ''; ?>">
                                    <i class="ri-search-line ri-20px"></i>
                                </span>
                                <input type="text" id="nik" name="mnik" placeholder="Cari NIK Anggota"
                                    class="form-control <?php echo isset($_SESSION['msg']['nik']) ? 'border-danger' : ''; ?>"
                                    value="<?php echo $_SESSION['value']['nik'] ?? ''; ?>"
                                    onkeyup="showName(this.value)">
                            </div>
                            <?php echo $_SESSION['msg']['nik'] ?? ''; ?>
                        </div>

                        <div class="form-group">
                            <label for="nama">Nama</label>
                            <input name="nama" id="nama" class="form-control" placeholder="Masukkan Nama"
                                value="<?php echo $data['nama'] ?? ''; ?>" readonly />
                        </div>

                        <div class="form-group">
                            <label for="tgl_pinjam">Tanggal Peminjaman</label>
                            <input name="tgl_pinjam" id="tgl_pinjam" type="date"
                                class="form-control <?php echo isset($_SESSION['msg']['tgl_pinjam']) ? 'border-danger' : ''; ?>"
                                value="<?php echo $_SESSION['value']['tgl_pinjam'] ?? ''; ?>" />
                            <?php echo $_SESSION['msg']['tgl_pinjam'] ?? ''; ?>
                        </div>
                        <div class="text-center mt-3">
                            <button type="submit" class="btn btn-primary me-2">Submit</button>
                            <button type="reset" class="btn btn-secondary">Reset</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>