<div class="container-fluid">
    <div class="row">
        <div class="col-lg-12">
            <h1 class="page-header">KATEGORI DATA</h1>
        </div>
        <!-- /.col-lg-12 -->
    </div>
    <!-- /.row -->
    <div class="row">
        <div class="col-lg-12">
            <div class="panel panel-default">
                <div class="panel-heading">
                    KATEGORI DATA
                </div>

                <!-- /.panel-heading -->
                <div class="panel-body">
                    <div class="table-responsive">
                        <?php 
                            if(isset($_SESSION['msg']['success'])){
                                echo '
                                    <div class="alert alert-success" role="alert">
                                        '.$_SESSION['msg']['success'].'
                                    </div>
                                ';
                            }
                        ?>
                        <table class="table table-striped table-bordered table-hover" id="dataTables-example">
                            <thead>
                                <tr>
                                    <th>NO</th>
                                    <th>KODE KATEGORI</th>
                                    <th>NAMA KATEGORI</th>
                                    <th>AKSI</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php 
                                include('components/koneksi.php');
                                $query = "SELECT * FROM kategori";
                                $q = mysqli_query($koneksi, $query);
                                $no = 1;
                                while ($data = mysqli_fetch_array($q)) {
                            ?>
                                <th scope="row"><?= $no++ ?></th>
                                <td><?= $data['kode'] ?></td>
                                <td><?= $data['nama'] ?></td>
                                <td>
                                    <a href="pages/p_kategori/p_kdelete.php?kode=<?= $data['kode'] ?>"
                                        onclick="return confirm('Anda yakin menghapus data ini?')"><i
                                            class="fa fa-trash text-danger"></i></a> |
                                    <a href="?page=k_input_update&kode=<?= $data['kode'] ?>"><i
                                            class="fa fa-pencil-square-o text-primary"></i></a>
                                </td>
                                </tr>
                                <?php
                                }
                            ?>
                            </tbody>
                        </table>
                    </div>
                </div>
                <?php 
unset($_SESSION['msg']);
?>