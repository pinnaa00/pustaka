<div class="container-fluid">
    <div class="row">
        <div class="col-lg-12">
            <h1 class="page-header">DATA ANGGOTA</h1>
        </div>
        <!-- /.col-lg-12 -->
    </div>
    <!-- /.row -->
    <div class="row">
        <div class="col-lg-12">
            <div class="panel panel-default">
                <div class="panel-heading">
                    DATA ANGGOTA
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
                                    <th>NIK</th>
                                    <th>NAMA</th>
                                    <th>NO Hp</th>
                                    <th>EMAIL</th>
                                    <th>ALAMAT</th>
                                    <th>FOTO</th>
                                    <th>AKSI</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php 
                                include('components/koneksi.php');
                                $query = "SELECT * FROM anggota";
                                $q = mysqli_query($koneksi, $query);
                                $no = 1;
                                while ($data = mysqli_fetch_array($q)) {
                            ?>
                                <th scope="row"><?= $no++ ?></th>
                                <td><?= $data['nik'] ?></td>
                                <td><?= $data['nama'] ?></td>
                                <td><?= $data['nohp'] ?></td>
                                <td><?= $data['email'] ?></td>
                                <td><?= $data['alamat'] ?></td>
                                <td><img src="assets/images/<?= $data['foto'] ?>" alt="Foto"
                                        style="width: 100px; height: auto;"></td>
                                <td>
                                    <a href="pages/p_anggota/p_adelete.php?nik=<?= $data['nik'] ?>"
                                        onclick="return confirm('Anda yakin menghapus data ini?')"><i
                                            class="fa fa-trash text-danger"></i></a> |
                                    <a href="?page=a_input_update&nik=<?= $data['nik'] ?>"><i
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