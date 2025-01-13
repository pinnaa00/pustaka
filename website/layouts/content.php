<?php while ($data = mysqli_fetch_array($query)) { ?>
<!-- <div id="page-wrapper" style="padding: 15px; margin: 0 auto; max-width: 1200px;"> -->
<div class="container">
    <div class="row">
        <div class="col-lg-12">
            <h1 class="page-header"></h1>
            <img class="card-img-top" src="../dashboard/pages/p_buku/image/<?php echo $data['cover']; ?>"
                alt="Card image cap" style="max-height: 250px; object-fit: cover;" />
            <div class="card-body">
                <h5 class="card-title"
                    style="max-width: 100px; white-space: nowrap; overflow: hidden; text-overflow: ellipsis;">
                    <?php echo $data['judul']; ?></h5>
                <p class="card-text"
                    style="max-width: 100px; white-space: nowrap; overflow: hidden; text-overflow: ellipsis;">
                    <?php echo $data['sinopsis']; ?>
                </p>
                <a href="detail.php?kode=<?php echo $data['kode']; ?>" class="btn btn-primary">View Detail</a>
            </div>
        </div>
    </div>
</div>
</div>
<?php } ?>