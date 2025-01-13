<?php 
if (isset($_REQUEST['id'])) {
    include('components/koneksi.php');
    $id = $_REQUEST['id'];

    $sql = "SELECT * FROM detail_transaksi
            LEFT JOIN transaksi ON detail_transaksi.id_transaksi = transaksi.id
            LEFT JOIN buku ON detail_transaksi.kode_buku = buku.kode
            LEFT JOIN anggota ON detail_transaksi.nik = anggota.nik
            WHERE detail_transaksi.id_transaksi = '$id'
    ";
    
    $query = mysqli_query($koneksi, $sql);
    $buku = [];
    if (mysqli_num_rows($query) > 0) {
        while ($row = mysqli_fetch_array($query)) {
            $buku[] = $row; // Menyimpan setiap baris data ke dalam array
        }
    }

    $query = mysqli_query($koneksi, $sql);
    $data = mysqli_fetch_array($query);
}?>

<div class="container-fluid">
    <div class="row">
        <div class="col-lg-12">
            <h1 class="page-header">Tambah Peminjaman Buku</h1>
        </div>
    </div>
    <form action="pages/p_trpinjam/peminjaman_update.php" method="POST">
        <div class="row">
            <!-- Form Peminjaman -->
            <div class="col-lg-6">
                <div class="panel panel-default">
                    <div class="panel-heading">PEMINJAMAN</div>
                    <div class="panel-body">

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
                                    class="input-group-text <?php echo isset($_SESSION['msg']['nik']) ? : ''; // INI OPERATOR TERNARY, TRADISIONAL?>">
                                    <i class="ri-search-line ri-20px"></i>
                                </span>
                                <input readonly type="text" placeholder="Search Member's NIK" name="nik"
                                    class="form-control <?php echo (isset($_SESSION['msg']['nik'])) ? 'border-danger' : null; ?>"
                                    value="<?php echo $data['nik'] ; ?>" id="nik" onkeyup="showName(this.value)">
                            </div>
                            <?php if (isset($_SESSION['msg']['nik'])) {
                        echo '<span class="text-danger">' . $_SESSION['msg']['nik'] . '</span>';
                    } ?>
                        </div>
                        <div class="form-group">
                            <label class="form-label">NAMA</label>
                            <input type="text" name="nama" id="nama" class="form-control"
                                placeholder="Name will appear here"
                                value="<?php echo $_SESSION['value']['nama'] ?? $data['nama'] ?? ''; ?>" readonly />
                        </div>

                        <div class="form-group">
                            <label class="form-label">TANGGAL PINJAM</label>
                            <input readonly
                                class="form-control disabled <?php echo (isset($_SESSION['msg']['tgl_pinjam'])) ? 'border-danger' : null; ?>"
                                value="<?php echo $_SESSION['value']['tgl_pinjam'] ?? $data['tgl_pinjam'] ?? ''; ?>"
                                type="date" name="tgl_pinjam" />
                            <?php if (isset($_SESSION['msg']['tgl_pinjam'])) {
                        echo '<span class="text-danger">' . $_SESSION['msg']['tgl_pinjam'] . '</span>';
                    } ?>
                        </div>
                        <div class="mb-6" hidden>
                            <label class="form-label">Id</label>
                            <input type="text" name="id" id="id" class="form-control"
                                placeholder="Name will appear here"
                                value="<?php echo $_SESSION['value']['id'] ?? $data['id'] ?? ''; ?>" readonly />
                        </div>

                        <div class="text-end mt-3">
                            <button type="submit" name="submit" class="btn btn-primary me-2">Submit</button>
                            <button type="reset" class="btn btn-secondary">Reset</button>
                        </div>
                    </div>
                </div>
            </div>


            <!-- Kolom Buku -->
            <div class="row">
                <div class="col-lg-6">
                    <div class="panel panel-default">
                        <!-- BIKIN TEBEL RESPONSIF -->
                        <div class="panel-heading">
                            DATA BUKU
                        </div>
                        <!-- /.panel-heading -->
                        <div class="panel-body">
                            <div class="form-group">
                                <div class="card-body">
                                    <?php 
                            $jmlBuku = 5;
                            for ($i = 1; $i <= $jmlBuku; $i++) {
                                if ($i <= count($buku)) {
                            ?>
                                    <!-- jika buku sudah dipinjam -->
                                    <p class="display-4">
                                        <u>Buku <?= $i; ?></u>
                                    </p>
                                    <div class="form-group row">
                                        <label class="col-sm-3 col-form-label">Kode</label>
                                        <div class="col-sm-9">
                                            <input readonly type="text" class="form-control"
                                                value="<?= $buku[$i - 1]['kode']; ?>">
                                        </div>
                                    </div>
                                    <div class="form-group row">
                                        <label class="col-sm-3 col-form-label">Judul</label>
                                        <div class="col-sm-9">
                                            <input readonly type="text" class="form-control"
                                                value="<?= $buku[$i - 1]['judul']; ?>">
                                        </div>
                                    </div>
                                    <?php } else { ?>
                                    <!-- jika buku baru -->
                                    <p class="display-4">
                                        <u>Buku <?= $i; ?></u>
                                    </p>
                                    <div class="form-group row">
                                        <label class="col-sm-3 col-form-label">Kode</label>
                                        <div class="col-sm-9">
                                            <input type="text" class="form-control" placeholder="kode"
                                                name="buku<?= $i; ?>" onkeyup="showBook(this.value, <?= $i ?>)"
                                                value="">
                                        </div>
                                    </div>
                                    <div class="form-group row">
                                        <label class="col-sm-3 col-form-label">Judul</label>
                                        <div class="col-sm-9">
                                            <input readonly type="text" class="form-control" id="judul<?= $i; ?>"
                                                placeholder="judul" name="judul<?= $i; ?>"
                                                value="<?= $buku[$i - 1]['judul'] ?? '' ?>">
                                        </div>
                                    </div>
                                    <?php } 
                            } ?>
                                </div>
                            </div>
                        </div>
                    </div>
    </form>
</div>
</div>

<?php 
include('p_trpinjam/proses_cari.php');
unset($_SESSION['msg']); 
unset($_SESSION['value']);
?>