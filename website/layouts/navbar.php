<nav class="navbar navbar-inverse navbar-fixed-top" role="navigation">
    <!-- <div class="container-fluid"> -->
    <div class="navbar-header">
        <a class="navbar-brand" href="">e - PERPUSTAKAAN</a>
    </div>

    <!-- Form pencarian di sebelah kiri -->
    <form action="" method="POST" class="navbar-form navbar-left">
        <div class="form-group">
            <input type="text" name="judul" class="form-control" placeholder="Search book"
                value="<?= (isset($_SESSION['value-judul'])) ? $_SESSION['value-judul'] : null; ?>">
        </div>
        <button type="submit" class="btn btn-primary" name="search">Search</button>
    </form>

    <!-- Tombol login di sebelah kanan -->
    <div class="navbar-form navbar-right">
        <form action="../dashboard/pages/proses/login_form.php" method="get">
            <button type="submit" class="btn btn-primary">
                <i class="fa fa-sign-in fa-fw"></i> Login
            </button>
        </form>
    </div>
</nav>