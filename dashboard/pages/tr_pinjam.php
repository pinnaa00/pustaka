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
            <div class="row">
                <!-- Form Peminjaman -->
                <div class="form-group">
                    <div class="card-body">
                        <?php if (isset($_SESSION['msg']['buku'])) {
                     echo '<div class="alert alert-danger float-end w-50" role="alert">' . $_SESSION['msg']['buku'] . '</div>';
                  } ?>
                        <div class="col-lg-6">
                            <div class="panel panel-default">
                                <div class="panel-heading">Buku 1</div>
                                <!-- Pencarian Buku 1 -->
                                <!-- Label dan Input Pencarian Buku -->
                                <label for="searchBook1">Cari Buku 1</label>
                                <div class="input-group input-group-merge">
                                    <span
                                        class="input-group-text <?php echo isset($_SESSION['msg']['!buku1']) ? 'border-danger' : ''; ?>">
                                        <i class="ri-search-line ri-20px"></i>
                                    </span>
                                    <input type="text" name="buku1" id="searchBook1"
                                        class="form-control <?php echo isset($_SESSION['msg']['!buku1']) ? 'border-danger' : ''; ?>"
                                        placeholder="Cari Buku 1"
                                        value="<?php echo $data['buku1'] ?? $_SESSION['value']['buku1'] ?? ''; ?>"
                                        onkeyup="showBook(this.value, 1)" />
                                </div>

                                <!-- Judul Buku -->
                                <label for="judulBuku1">Judul Buku</label>
                                <div class="form-floating form-floating-outline mb-6">
                                    <input readonly type="text" name="judul1" id="judulBuku1" class="form-control"
                                        value="<?php echo $data['judul1'] ?? $_SESSION['value']['judul1'] ?? ''; ?>" />
                                </div>


                                <!-- Buku 2 -->
                                <div class="panel panel-default">
                                    <div class="panel-heading">Buku 2</div>
                                    <div class="form-group">
                                        <!-- Pencarian Buku 2 -->
                                        <label for="searchBook2">Cari Buku 2</label>
                                        <div class="input-group input-group-merge">
                                            <span class="input-group-text"><i class="ri-search-line ri-20px"></i></span>
                                            <input type="text" name="buku2" class="form-control"
                                                placeholder="Cari Buku 2"
                                                value="<?php echo $_SESSION['value']['buku2'] ?? ''; ?>"
                                                onkeyup="showBook(this.value, 2)" />
                                        </div>
                                    </div>
                                    <!-- Judul Buku 2 -->
                                    <div class="form-group">
                                        <label for="judulBuku2">Judul Buku</label>
                                        <input readonly type="text" name="judul2" id="judulBuku2" class="form-control"
                                            value="<?php echo $_SESSION['value']['judul2'] ?? ''; ?>" />
                                    </div>

                                    <!-- Buku 3 -->
                                    <div class="panel panel-default">
                                        <div class="panel-heading">Buku 3</div>
                                        <br>
                                        <div class="form-group">
                                            <!-- Pencarian Buku 3 -->
                                            <label for="searchBook3">Cari Buku 3</label>
                                            <div class="input-group input-group-merge">
                                                <span class="input-group-text"><i
                                                        class="ri-search-line ri-20px"></i></span>
                                                <input type="text" name="buku3" class="form-control"
                                                    placeholder="Cari Buku 3"
                                                    value="<?php echo $_SESSION['value']['buku3'] ?? ''; ?>"
                                                    onkeyup="showBook(this.value, 3)" />
                                            </div>
                                        </div>
                                        <!-- Judul Buku 3 -->
                                        <div class="form-group">
                                            <label for="judulBuku3">Judul Buku</label>
                                            <input readonly type="text" name="judul3" id="judulBuku3"
                                                class="form-control"
                                                value="<?php echo $_SESSION['value']['judul3'] ?? ''; ?>" />
                                        </div>

                                        <!-- Buku 4 -->
                                        <div class="panel panel-default">
                                            <div class="panel-heading">Buku 4</div>
                                            <div class="form-group">
                                                <!-- Pencarian Buku 4 -->
                                                <label for="searchBook4">Cari Buku 4</label>
                                                <div class="input-group input-group-merge">
                                                    <span class="input-group-text"><i
                                                            class="ri-search-line ri-20px"></i></span>
                                                    <input type="text" name="buku4" class="form-control"
                                                        placeholder="Cari Buku 4"
                                                        value="<?php echo $_SESSION['value']['buku4'] ?? ''; ?>"
                                                        onkeyup="showBook(this.value, 4)" />
                                                </div>
                                            </div>
                                            <!-- Judul Buku 4 -->
                                            <div class="form-group">
                                                <label for="judulBuku4">Judul Buku</label>
                                                <input readonly type="text" name="judul4" id="judulBuku4"
                                                    class="form-control"
                                                    value="<?php echo $_SESSION['value']['judul4'] ?? ''; ?>" />
                                            </div>

                                            <!-- Buku 5 -->
                                            <div class="panel panel-default">
                                                <div class="panel-heading">Buku 5</div>
                                                <div class="form-group">
                                                    <!-- Pencarian Buku 5 -->
                                                    <label for="searchBook5">Cari Buku 5</label>
                                                    <div class="input-group input-group-merge">
                                                        <span class="input-group-text"><i
                                                                class="ri-search-line ri-20px"></i></span>
                                                        <input type="text" name="buku5" class="form-control"
                                                            placeholder="Cari Buku 5"
                                                            value="<?php echo $_SESSION['value']['buku5'] ?? ''; ?>"
                                                            onkeyup="showBook(this.value, 5)" />
                                                    </div>
                                                </div>
                                                <!-- Judul Buku 5 -->
                                                <div class="form-group">
                                                    <label for="judulBuku5">Judul Buku</label>
                                                    <input readonly type="text" name="judul5" id="judulBuku5"
                                                        class="form-control"
                                                        value="<?php echo $_SESSION['value']['judul5'] ?? ''; ?>" />
                                                </div>

                                            </div>
                                        </div>
                                    </div>
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
<!-- apa namanya buatlah msg kan?  -->