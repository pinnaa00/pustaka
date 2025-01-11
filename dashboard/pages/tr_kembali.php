<div class="container-fluid">
    <div class="row">
        <div class="col-lg-12">
            <h1 class="page-header">PENGEMBALIAN BUKU</h1>
        </div>
    </div>
    <form action="pages/p_trpinjam/pengembalian.php" method="POST">
        <div class="row">
            <!-- Form Pengembalian -->
            <div class="col-lg-6">
                <div class="panel panel-default">
                    <div class="panel-heading">PENGEMBALIAN BUKU</div>
                    <div class="panel-body">

                        <?php if (isset($_SESSION['msg']['sukses'])) { ?>
                        <div class="alert alert-success ms-2 me-2" role="alert">
                            <?php echo $_SESSION['msg']['sukses']; ?>
                        </div>
                        <?php } ?>

                        <?php if (isset($_SESSION['msg']['failed'])) { ?>
                        <div class="alert alert-danger ms-2 me-2" role="alert">
                            <?php echo $_SESSION['msg']['failed']; ?>
                        </div>
                        <?php } ?>

                        <!-- Baris 1: NIK dan Nama -->
                        <div class="form-group">
                            <label for="nik">NIK</label>
                            <span
                                class="input-group-text <?php echo (isset($_SESSION['msg']['nik'])) ? 'border-danger' : null; ?>">
                                <i class="ri-search-line ri-20px"></i></span>
                            <input type="text" placeholder="Search Member's NIK" name="nik"
                                class="form-control <?php echo (isset($_SESSION['msg']['nik'])) ? 'border-danger' : null; ?>"
                                value="<?php echo (isset($_SESSION['value']['nik'])) ? $_SESSION['value']['nik'] : null; ?>"
                                id="memberNik" onkeyup="showName(this.value)">
                        </div>
                        <?php if (isset($_SESSION['msg']['nik'])) {
                        echo '<span class="text-danger">' . $_SESSION['msg']['nik'] . '</span>';
                     } ?>
                    </div>

                    <div class="form-group">
                        <label for="nama">Nama</label>
                        <input type="text" name="nama" id="nama" class="form-control" value="<?php echo isset($data['nama']) ? $data['nama'] : '';
                                 echo (isset($_SESSION['value']['nama'])) ? $_SESSION['value']['nama'] : null; ?>"
                            readonly />
                    </div>

                    <div class="form-group">
                        <label for="tgl_pinjam">Tanggal Pengembalian</label>
                        <input
                            class="form-control <?php echo (isset($_SESSION['msg']['tgl_kembali'])) ? 'border-danger' : null; ?>"
                            value="<?php echo (isset($_SESSION['value']['tgl_kembali'])) ? $_SESSION['value']['tgl_kembali'] : null; ?>"
                            type="date" name="tgl_kembali" />
                        <?php if (isset($_SESSION['msg']['tgl_kembali'])) {
                        echo '<span class="text-danger">' . $_SESSION['msg']['tgl_kembali'] . '</span>';
                     } ?>
                        <div class="text-end ">
                            <button type="submit" name="submit" class="btn btn-primary me-2">Submit</button>
                            <button type="reset" class="btn btn-secondary">Reset</button>
                        </div>

                    </div>
                </div>
            </div>

        </div>
    </form>
</div>


<!-- BJIRRR -->
<?php 
include('p_trpinjam/proses_cari.php');
unset($_SESSION['msg']); 
unset($_SESSION['value']);
?>