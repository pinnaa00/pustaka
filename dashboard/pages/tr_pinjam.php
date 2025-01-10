<div class="container-fluid">
    <div class="row">
        <div class="col-lg-12">
            <h1 class="page-header">Peminjaman</h1>
        </div>
    </div>
    <form action="pages/p_trpinjam/peminjaman.php" method="POST">
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
                                <input type="text" id="nik" name="nik" placeholder="Cari NIK Anggota"
                                    class="form-control" value="<?php echo $_SESSION['value']['nik'] ?? ''; ?>"
                                    onkeyup="showName(this.value)">
                            </div>
                            <?php echo $_SESSION['msg']['nik'] ?? ''; // INI MODERN, LEBIH RINGKAS. KALAU PAHAM YA BGS(D)  ?>
                        </div>

                        <div class="form-group">
                            <label for="nama">Nama</label>
                            <input name="nama" id="nama" class="form-control" value="<?php echo $data['nama'] ?? ''; ?>"
                                readonly />
                        </div>

                        <div class="form-group">
                            <label for="tgl_pinjam">Tanggal Peminjaman</label>
                            <input name="tgl_pinjam" id="tgl_pinjam" type="date"
                                class="form-control <?php echo isset($_SESSION['msg']['tgl_pinjam']) ? : ''; ?>"
                                value="<?php echo $_SESSION['value']['tgl_pinjam'] ?? ''; ?>" />
                            <?php echo $_SESSION['msg']['tgl_pinjam'] ?? ''; ?>
                        </div>
                        <div class="text-end mt-3">
                            <button type="submit" name="submit" class="btn btn-primary me-2">Submit</button>
                            <button type="reset" class="btn btn-secondary">Reset</button>
                        </div>

                    </div>
                </div>
            </div>

            <!-- Kolom Buku -->
            <div class="col-lg-6">
                <div class="form-group">
                    <div class="card-body">
                        <?php if (isset($_SESSION['msg']['buku'])) { ?>
                        <div class="alert alert-danger float-end w-50" role="alert">
                            <?php echo $_SESSION['msg']['buku']; ?>
                        </div>
                        <?php } ?>

                        <?php
                            $maxBuku = 5; // Jumlah maksimum buku yang dapat dipinjam
                            for ($i = 1; $i <= $maxBuku; $i++) { 
                        ?>
                        <div class="col-lg-6 mb-4">
                            <div class="panel panel-default">
                                <div class="panel-heading">Book <?php echo $i; ?></div>
                                <div class="panel-body">
                                    <!-- Input kode buku -->
                                    <div class="input-group mb-2">
                                        <span class="input-group-text"><i class="ri-search-line ri-20px"></i></span>
                                        <input type="text" class="form-control" name="buku<?php echo $i; ?>"
                                            placeholder="Kode buku"
                                            value="<?php echo $_SESSION['value']["buku$i"] ?? ($buku[$i - 1]['kode'] ?? ''); ?>"
                                            onkeyup="showBook(this.value, <?php echo $i; ?>)" />
                                    </div>

                                    <!-- Input judul buku (readonly) -->
                                    <div class="input-group">
                                        <input readonly type="text" class="form-control"
                                            placeholder="Judul akan muncul disini" name="title<?php echo $i; ?>"
                                            id="judulBuku<?php echo $i; ?>"
                                            value="<?php echo $_SESSION['value']["judul$i"] ?? ($buku[$i - 1]['title'] ?? ''); ?>" />
                                    </div>
                                </div>
                            </div>
                        </div>
                        <?php } ?>
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