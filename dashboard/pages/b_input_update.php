<?php
include('components/koneksi.php'); 
//untuk mengambil data penerbit
$penerbit = "SELECT * FROM penerbit";
$selectPenerbit = mysqli_query($koneksi, $penerbit);

//untuk mengambil data kategori
$kategori = "SELECT * FROM kategori";
$selectKategori = mysqli_query($koneksi, $kategori);

// Ambil kode buku dari request
$kode = $_REQUEST['kode'];
$query = "SELECT * FROM buku WHERE kode='$kode'";
$q = mysqli_query($koneksi, $query);
$data = mysqli_fetch_array($q);
?>

<div class="container-fluid">
    <div class="row">
        <div class="col-lg-12">
            <h1 class="page-header">UPDATE DATA BUKU</h1>
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
                        echo '<div class="alert alert-danger">' . $_SESSION['msg']['error'] . '</div>';
                    }
                    if (isset($_SESSION['msg']['success'])) {
                        echo '<div class="alert alert-success">' . $_SESSION['msg']['success'] . '</div>';
                    }
                    ?>
                    <form role="form" action="pages/p_buku/p_bupdate.php" method="POST" enctype="multipart/form-data">
                        <div class="row">
                            <div class="col-lg-4">
                                <div class="form-group">
                                    <label>KODE BUKU</label>
                                    <input readonly value="<?= $data['kode']?>" class="form-control"
                                        placeholder="Masukkan Kode" name="kode">
                                    <?php if (isset($_SESSION['msg']['kode'])) echo '<div class="text-danger">' . $_SESSION['msg']['kode'] . '</div>'; ?>
                                </div>
                                <div class="form-group">
                                    <label>ISBN</label>
                                    <input value="<?= $data['isbn']?>" class="form-control" placeholder="Masukkan ISBN"
                                        name="isbn">
                                    <?php if (isset($_SESSION['msg']['isbn'])) echo '<div class="text-danger">' . $_SESSION['msg']['isbn'] . '</div>'; ?>
                                </div>
                                <div class="form-group">
                                    <label>TAHUN</label>
                                    <input value="<?= $data['tahun']?>" class="form-control" type="number"
                                        placeholder="Masukkan Tahun" name="tahun">
                                    <?php if (isset($_SESSION['msg']['tahun'])) echo '<div class="text-danger">' . $_SESSION['msg']['tahun'] . '</div>'; ?>
                                </div>
                            </div>
                            <div class="col-lg-4">
                                <div class="form-group">
                                    <label>JUDUL</label>
                                    <input value="<?= $data['judul']?>" class="form-control"
                                        placeholder="Masukkan Judul" name="judul">
                                    <?php if (isset($_SESSION['msg']['judul'])) echo '<div class="text-danger">' . $_SESSION['msg']['judul'] . '</div>'; ?>
                                </div>
                                <div class="form-group">
                                    <label>NAMA PENULIS</label>
                                    <input value="<?= $data['nama']?>" class="form-control" type="text"
                                        placeholder="Masukkan Nama Penulis" name="nama">
                                    <?php if (isset($_SESSION['msg']['nama'])) echo '<div class="text-danger">' . $_SESSION['msg']['nama'] . '</div>'; ?>
                                </div>
                                <div class="form-group">
                                    <label>PENERBIT</label>
                                    <select class="form-control" name="penerbit">
                                        <option value="">-- Pilih Penerbit --</option>
                                        <?php while ($rowPenerbit = mysqli_fetch_assoc($selectPenerbit)) { ?>
                                        <option value="<?php echo $rowPenerbit['kode']; ?>"
                                            <?php if ($rowPenerbit['kode'] == $data['penerbit']) echo 'selected'; ?>>
                                            <?php echo $rowPenerbit['nama']; ?>
                                        </option>
                                        <?php } ?>
                                    </select>
                                    <?php if (isset($_SESSION['msg']['penerbit'])) echo '<div class ="text-danger">' . $_SESSION['msg']['penerbit'] . '</div>'; ?>
                                </div>
                            </div>
                            <div class="col-lg-4">
                                <div class="form-group">
                                    <label>KATEGORI</label>
                                    <select class="form-control" name="kategori">
                                        <option value="">-- Pilih Kategori --</option>
                                        <?php while ($rowKategori = mysqli_fetch_assoc($selectKategori)) { ?>
                                        <option value="<?php echo $rowKategori['kode']; ?>"
                                            <?php if ($rowKategori['kode'] == $data['kategori']) echo 'selected'; ?>>
                                            <?php echo $rowKategori['nama']; ?>
                                        </option>
                                        <?php } ?>
                                    </select>
                                    <?php if (isset($_SESSION['msg']['kategori'])) echo '<div class="text-danger">' . $_SESSION['msg']['kategori'] . '</div>'; ?>
                                </div>
                                <div class="form-group">
                                    <label>BAHASA</label>
                                    <select class="form-control" name="bahasa">
                                        <option value="Bahasa Indonesia"
                                            <?php if ($data['bahasa'] == 'Bahasa Indonesia') echo 'selected'; ?>>Bahasa
                                            Indonesia</option>
                                        <option value="Bahasa Inggris"
                                            <?php if ($data['bahasa'] == 'Bahasa Inggris') echo 'selected'; ?>>Bahasa
                                            Inggris</option>
                                    </select>
                                    <?php if (isset($_SESSION['msg']['bahasa'])) echo '<div class="text-danger">' . $_SESSION['msg']['bahasa'] . '</div>'; ?>
                                </div>
                                <div class="form-group">
                                    <label>Cover</label>
                                    <input type="file" name="cover">
                                    <?php if (!empty($data['cover'])): ?>
                                    <div>
                                        <img src="assets/images/<?= $data['cover'] ?>" alt="Cover"
                                            style="width: 100px; height: auto;">
                                    </div>
                                    <?php endif; ?>
                                    <?php if (isset($_SESSION['msg']['cover'])) echo '<div class="text-danger">' . $_SESSION['msg']['cover'] . '</div>'; ?>
                                </div>
                            </div>
                            <div class="form-group">
                                <label>SINOPSIS</label>
                                <textarea class="form-control" rows="3"
                                    name="sinopsis"><?= $data['sinopsis'] ?></textarea>
                                <?php if (isset($_SESSION['msg']['sinopsis'])) echo '<div class="text-danger">' . $_SESSION['msg']['sinopsis'] . '</div>'; ?>
                            </div>
                            <div class="row mt-4">
                                <div class="col-lg-12 text-end">
                                    <button type="submit" class="btn btn-primary me-2">Submit</button>
                                    <button type="reset" class="btn btn-secondary">Reset</button>
                                </div>
                            </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>