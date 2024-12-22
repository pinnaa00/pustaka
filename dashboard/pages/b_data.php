<div class="container-fluid">
    <div class="row">
        <div class="col-lg-12">
            <h1 class="page-header">DATA BUKU</h1>
        </div>
    </div>
    <div class="row">
        <div class="col-lg-12">
            <div class="panel panel-default">
                <div class="panel-heading">
                    DATA BUKU
                </div>
                <div class="panel-body">
                    <div class="table-responsive">
                        <!-- Tampilkan pesan sukses jika ada -->
                        <?php 
                            if(isset($_SESSION['msg']['success'])){
                                echo '
                                    <div class="alert alert-success" role="alert">
                                        '.$_SESSION['msg']['success'].'
                                    </div>
                                ';
                            }
                        ?>

                        <!-- Tabel data -->
                        <table class="table table-striped table-bordered table-hover" id="dataTables-example">
                            <thead>
                                <tr>
                                    <th>No</th>
                                    <th>Kode</th>
                                    <th>ISBN</th>
                                    <th>Tahun</th>
                                    <th>Judul</th>
                                    <th>Penulis</th>
                                    <th>Penerbit</th>
                                    <th>Kategori</th>
                                    <th>Bahasa</th>
                                    <th>Cover</th>
                                    <th>Aksi</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php 
                                include('components/koneksi.php');
                                $query = "SELECT * FROM buku";
                                $q = mysqli_query($koneksi, $query);
                                $no = 1;

                                // if (mysqli_num_rows($q) > 0) {
                                    while ($data = mysqli_fetch_array($q)) {
                                ?>
                                <tr>
                                    <th scope="row"><?= $no++ ?></th>
                                    <td><?= $data['kode'] ?></td>
                                    <td><?= $data['isbn'] ?></td>
                                    <td><?= $data['tahun'] ?></td>
                                    <td><?= $data['judul'] ?></td>
                                    <td><?= $data['nama'] ?></td>
                                    <td><?= $data['penerbit'] ?></td>
                                    <td><?= $data['kategori'] ?></td>
                                    <td><?= $data['bahasa'] == 1 ? 'Bahasa Indonesia' : 'Bahasa Inggris' ?></td>
                                    <td>
                                        <img src="assets/images/<?= $data['cover'] ?>" alt="Cover"
                                            style="width: 100px; height: auto;">
                                    </td>
                                    <td>
                                        <a href="pages/p_buku/p_bdelete.php?kode=<?= $data['kode'] ?>"
                                            onclick="return confirm('Anda yakin menghapus data ini?')">
                                            <i class="fa fa-trash text-danger"></i>
                                        </a> |
                                        <a href="?page=b_input_update&kode=<?= $data['kode'] ?>">
                                            <i class="fa fa-pencil-square-o text-primary"></i>
                                        </a>
                                    </td>
                                </tr>
                                <?php 
                                
                                }
                                ?>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<?php 
unset($_SESSION['msg']);
?>