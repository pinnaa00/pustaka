<aside class="sidebar navbar-default" role="navigation">
    <div class="sidebar-nav navbar-collapse">
        <ul class="nav">
            <!-- Search -->
            <li class="sidebar-search">
                <div class="input-group custom-search-form">
                    <input type="text" class="form-control" placeholder="Search...">
                    <span class="input-group-btn">
                        <button class="btn btn-primary" type="button">
                            <i class="fa fa-search"></i>
                        </button>
                    </span>
                </div>
            </li>
            <!-- Dashboard -->
            <li>
                <a href="?page=dashboard" class="<?php echo ($_REQUEST['page'] == 'dashboard') ? 'active' : null; ?>">
                    <i class="fa fa-dashboard fa-fw"></i> Dashboard
                </a>
            </li>
            <!-- Kategori -->
            <li>
                <a href="#" class="dropdown-toggle" data-toggle="collapse" data-target="#kategoriMenu"
                    aria-expanded="<?php echo ($_REQUEST['page'] == 'k_data' || $_REQUEST['page'] == 'k_input') ? 'true' : 'false'; ?>">
                    <i class="fa fa-file fa-fw"></i> Kategori <span class="fa arrow"></span>
                </a>
                <ul class="nav nav-second-level collapse <?php echo ($_REQUEST['page'] == 'k_data' || $_REQUEST['page'] == 'k_input' ? 'in' : null); ?>"
                    id="kategoriMenu">
                    <li>
                        <a href="?page=k_data"
                            class="<?php echo ($_REQUEST['page'] == 'k_data' ? 'active' : ''); ?>">Kategori Data</a>
                    </li>
                    <li>
                        <a href="?page=k_input"
                            class="<?php echo ($_REQUEST['page'] == 'k_input' ? 'active' : ''); ?>">Kategori Input</a>
                    </li>
                </ul>
            </li>
            <!-- Penerbit -->
            <li>
                <a href="#" class="dropdown-toggle" data-toggle="collapse" data-target="#penerbitMenu"
                    aria-expanded="<?php echo ($_REQUEST['page'] == 'p_data' || $_REQUEST['page'] == 'p_input') ? 'true' : 'false'; ?>">
                    <i class="fa fa-cubes fa-fw"></i> Penerbit <span class="fa arrow"></span>
                </a>
                <ul class="nav nav-second-level collapse <?php echo ($_REQUEST['page'] == 'p_data' || $_REQUEST['page'] == 'p_input' ? 'in' : null); ?>"
                    id="penerbitMenu">
                    <li>
                        <a href="?page=p_data"
                            class="<?php echo ($_REQUEST['page'] == 'p_data' ? 'active' : ''); ?>">Data Penerbit</a>
                    </li>
                    <li>
                        <a href="?page=p_input"
                            class="<?php echo ($_REQUEST['page'] == 'p_input' ? 'active' : ''); ?>">Input Data</a>
                    </li>
                </ul>
            </li>
            <!-- Buku -->
            <li>
                <a href="#" class="dropdown-toggle" data-toggle="collapse" data-target="#bukuMenu"
                    aria-expanded="<?php echo ($_REQUEST['page'] == 'b_data' || $_REQUEST['page'] == 'b_input') ? 'true' : 'false'; ?>">
                    <i class="fa fa-book fa-fw"></i> Buku <span class="fa arrow"></span>
                </a>
                <ul class="nav nav-second-level collapse <?php echo ($_REQUEST['page'] == 'b_data' || $_REQUEST['page'] == 'b_input') ? 'in' : null; ?>"
                    id="bukuMenu">
                    <li>
                        <a href="?page=b_data"
                            class="<?php echo ($_REQUEST['page'] == 'b_data' ? 'active' : ''); ?>">Data Buku</a>
                    </li>
                    <li>
                        <a href="?page=b_input"
                            class="<?php echo ($_REQUEST['page'] == 'b_input' ? 'active' : ''); ?>">Input Buku</a>
                    </li>
                </ul>
            </li>
            <!-- Anggota -->
            <li>
                <a href="#" class="dropdown-toggle" data-toggle="collapse" data-target="#anggotaMenu"
                    aria-expanded="<?php echo ($_REQUEST['page'] == 'a_data' || $_REQUEST['page'] == 'a_input') ? 'true' : 'false'; ?>">
                    <i class="fa fa-user fa-fw"></i> Anggota <span class="fa arrow"></span>
                </a>
                <ul class="nav nav-second-level collapse <?php echo ($_REQUEST['page'] == 'a_data' || $_REQUEST['page'] == 'a_input') ? 'in' : null; ?>"
                    id="anggotaMenu">
                    <li>
                        <a href="?page=a_data"
                            class="<?php echo ($_REQUEST['page'] == 'a_data' ? 'active' : ''); ?>">Data Anggota</a>
                    </li>
                    <li>
                        <a href="?page=a_input"
                            class="<?php echo ($_REQUEST['page'] == 'a_input' ? 'active' : ''); ?>">Input Anggota</a>
                    </li>
                </ul>
            </li>
            <!-- Transaksi -->
            <li>
                <a href="#" class="dropdown-toggle" data-toggle="collapse" data-target="#transaksiMenu"
                    aria-expanded="<?php echo ($_REQUEST['page'] == 'tr_pinjam' || $_REQUEST['page'] == 'tr_kembali') ? 'true' : 'false'; ?>">
                    <i class="fa fa-shopping-cart fa-fw"></i> Transaksi <span class="fa arrow"></span>
                </a>
                <ul class="nav nav-second-level collapse  <?php 
    echo (
        $_REQUEST['page'] == 'tr_pinjam' || 
        $_REQUEST['page'] == 'tr_kembali' || 
        $_REQUEST['page'] == 'tr_kembalidata' || 
        $_REQUEST['page'] == 'tr_pinjamdata'
    ) ? 'in' : null; 
?>" id="transaksiMenu">
                    <li>
                        <a href="?page=tr_pinjam"
                            class="<?php echo ($_REQUEST['page'] == 'tr_pinjam') ? 'active' : null; ?>">Input
                            Peminjaman</a>
                    </li>
                    <li>
                        <a href="?page=tr_kembali"
                            class="<?php echo ($_REQUEST['page'] == 'tr_kembali') ? 'active' : null; ?>">Input
                            Pengembalian</a>
                    </li>
                    <li>
                        <a href="?page=tr_pinjamdata"
                            class="<?php echo ($_REQUEST['page'] == 'tr_pinjamdata') ? 'active' : null; ?>">Data
                            Peminjaman Buku</a>
                    </li>
                    <li>
                        <a href="?page=tr_kembalidata"
                            class="<?php echo ($_REQUEST['page'] == 'tr_kembalidata') ? 'active' : null; ?>">Data
                            Pengembalian Buku</a>
                    </li>
                </ul>
            </li>
            <!-- Logout -->
            <li>
                <a href="pages/proses/logout.php" class="">
                    <i class="fa fa-sign-in fa-fw"></i> Logout
                </a>
            </li>
        </ul>
    </div>
</aside>