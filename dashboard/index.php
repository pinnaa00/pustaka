<?php 
session_start();
if(!isset($_SESSION['login'])){
    header('location: pages/proses/login_form.php');
    exit();
}
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <!-- styles -->
    <?php include('components/styles.php') ?>
</head>

<body>

    <div id="wrapper">

        <!-- top nav -->
        <?php include('components/top_nav.php') ?>

        <!-- /.sidebar -->
        <?php include('components/left_nav.php') ?>

        <!-- content -->
        <div id="page-wrapper">

            <?php 
            $page = isset($_REQUEST['page']) && !empty($_REQUEST['page']) ? $_REQUEST['page'] : 'dashboard';
            include('pages/'.$page.'.php');
            ?>
        </div>

    </div>

    <!-- script -->
    <?php include('components/script.php') ?>


</body>

</html>