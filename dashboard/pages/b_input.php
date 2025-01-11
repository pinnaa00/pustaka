<?php
include('components/koneksi.php'); 
//untuk mengambil data penerbit
$penerbit = "SELECT * FROM penerbit";
$selectPenerbit = mysqli_query($koneksi, $penerbit);

//untuk mengambil data kategori
$kategori = "SELECT * FROM kategori";
$selectKategori = mysqli_query($koneksi, $kategori);
?>
<div class="container-fluid">
    <div class="row">
        <div class="col-lg-12">
            <h1 class="page-header">INPUT DATA BUKU</h1>
        </div>
    </div>
    <div class="row">
        <div class="col-lg-12">
            <div class="panel panel-default">
                <div class="panel-heading">BUKU</div>
                <div class="panel-body">
                    <?php
                    // Tampilkan pesan error atau sukses dari session
                    if (isset($_SESSION['msg']['error'])) {
                        echo $_SESSION['msg']['error'];
                    }
                    if (isset($_SESSION['msg']['success'])) {
                        echo $_SESSION['msg']['success'];
                    }
                    ?>
                    <form role="form" action="pages/p_buku/p_binput.php" method="POST" enctype="multipart/form-data">
                        <div class="row">
                            <div class="col-lg-4">
                                <div class="form-group">
                                    <label>KODE BUKU</label>
                                    <input class="form-control" placeholder="Masukkan Kode" name="kode">
                                    <?php
                                    if (isset($_SESSION['msg']['kode'])) {
                                        echo $_SESSION['msg']['kode'];
                                    }
                                    ?>
                                </div>
                                <div class="form-group">
                                    <label>ISBN</label>
                                    <input class="form-control" placeholder="Masukkan ISBN" name="isbn">
                                    <?php
                                    if (isset($_SESSION['msg']['isbn'])) {
                                        echo $_SESSION['msg']['isbn'];
                                    }
                                    ?>
                                </div>
                                <div class="form-group">
                                    <label>TAHUN</label>
                                    <input class="form-control" type="number" placeholder="Masukkan Year" name="tahun">
                                    <?php
                                    if (isset($_SESSION['msg']['tahun'])) {
                                        echo $_SESSION['msg']['tahun'];
                                    }
                                    ?>
                                </div>
                            </div>
                            <div class="col-lg-4">
                                <div class="form-group">
                                    <label>JUDUL</label>
                                    <input class="form-control" placeholder="Masukkan Judul" name="judul">
                                    <?php
                                    if (isset($_SESSION['msg']['judul'])) {
                                        echo $_SESSION['msg']['judul'];
                                    }
                                    ?>
                                </div>
                                <div class="form-group">
                                    <label>NAMA PENULIS</label>
                                    <input class="form-control" type="text" placeholder="Masukkan Nama Penulis"
                                        name="nama">
                                    <?php
                                    if (isset($_SESSION['msg']['nama'])) {
                                        echo $_SESSION['msg']['nama'];
                                    }
                                    ?>
                                </div>
                                <div class="form-group">
                                    <label>PENERBIT</label>
                                    <select class="form-control" name="penerbit">
                                        <option value="">-- Pilih Penerbit --</option>
                                        <?php while ($rowPenerbit = mysqli_fetch_assoc($selectPenerbit)) { ?>
                                        <option value="<?php echo $rowPenerbit['kode']; ?>">
                                            <?php echo $rowPenerbit['nama']; ?>
                                        </option>
                                        <?php } ?>
                                    </select>
                                    <?php
                                    if (isset($_SESSION['msg']['penerbit'])) {
                                        echo $_SESSION['msg']['penerbit'];
                                    }
                                    ?>
                                </div>
                            </div>
                            <div class="col-lg-4">
                                <div class="form-group">
                                    <label>KATEGORI</label>
                                    <select class="form-control" name="kategori">
                                        <option value="">-- Pilih Kategori --</option>
                                        <?php while ($rowKategori = mysqli_fetch_assoc($selectKategori)) { ?>
                                        <option value="<?php echo $rowKategori['kode']; ?>">
                                            <?php echo $rowKategori['nama']; ?>
                                        </option>
                                        <?php } ?>
                                    </select>
                                    <?php
                                    if (isset($_SESSION['msg']['kategori'])) {
                                        echo $_SESSION['msg']['kategori'];
                                    }
                                    ?>
                                </div>
                                <div class="form-group">
                                    <label>BAHASA</label>
                                    <select class="form-control" name="bahasa">
                                        <option value="">--- Pilih Bahasa --- </option>
                                        <option value="Bahasa Indonesia">Bahasa Indonesia</option>
                                        <option value="Bahasa Inggris">Bahasa Inggris</option>
                                    </select>
                                    <?php
                                    if (isset($_SESSION['msg']['bahasa'])) {
                                        echo $_SESSION['msg']['bahasa'];
                                    }
                                    ?>
                                </div>
                                <div class="form-group">
                                    <label>Cover</label>
                                    <input type="file" name="cover">
                                    <?php
                                    if (isset($_SESSION['msg']['cover'])) {
                                        echo $_SESSION['msg']['cover'];
                                    }
                                    ?>
                                </div>
                            </div>
                        </div>
                        <div class="form-group">
                            <label>SINOPSIS</label>
                            <textarea class="form-control" rows="3" name="sinopsis"></textarea>
                            <?php
                            if (isset($_SESSION['msg']['sinopsis'])) {
                                echo $_SESSION['msg']['sinopsis'];
                            }
                            ?>
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