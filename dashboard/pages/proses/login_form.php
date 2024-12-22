<?php 
session_start();
if (isset($_SESSION['login'])) {
   header('location: ../../?page=dashboard');
   exit();
}
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="">
    <meta name="author" content="">

    <title>PERPUSTAKAAN</title>

    <!-- Bootstrap Core CSS -->
    <link href="../../assets/css/bootstrap.min.css" rel="stylesheet">


    <!-- MetisMenu CSS -->
    <link href="../../assets/css/metisMenu.min.css" rel="stylesheet">

    <!-- Custom CSS -->
    <link href="../../assets/css/startmin.css" rel="stylesheet">

    <!-- Custom Fonts -->
    <link href="../../assets/css/font-awesome.min.css" rel="stylesheet" type="text/css">

    <!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
    <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
    <!--[if lt IE 9]>
        <script src="https://cdnjs.cloudflare.com/ajax/libs/html5shiv/3.7.3/html5shiv.min.js"></script>
        <script src="https://cdnjs.cloudflare.com/ajax/libs/respond.js/1.4.2/respond.min.js"></script>
    <![endif]-->
</head>

<body>

    <div class="container">
        <div class="row">
            <div class="col-md-4 col-md-offset-4">
                <div class="login-panel panel panel-default">
                    <div class="panel-heading">
                        <h3 class="panel-title">Please Sign In</h3>
                        <?php if (isset($_SESSION['msg-global'])) { ?>
                        <p class="text-danger text mb-5">
                            <?php 
                     echo $_SESSION['msg-global']; 
                     unset($_SESSION['username']); 
                     unset($_SESSION['password']);
                     ?>
                        </p>
                        <?php } else { ?>
                        <p class="mb-5">Please sign-in to your account</p>
                        <?php } ?>
                    </div>
                    <div class="panel-body">
                        <form role="form" action="login_proses.php" method="post">
                            <fieldset>
                                <div class="form-group">
                                    <input
                                        class="form-control <?php echo (isset($_SESSION['msg-user'])) ? 'border-danger' : ''; ?>"
                                        id="username" name="username" placeholder="Enter your username"
                                        value="<?php echo (isset($_SESSION['username'])) ? $_SESSION['username'] : ''; ?>"
                                        <?php echo (isset($_SESSION['msg-user'])) ? '' : 'autofocus'; ?> />

                                    <?php if (isset($_SESSION['msg-user'])) { ?>
                                    <span class="text-danger"><?php echo $_SESSION['msg-user']; ?></span>
                                    <?php } ?>
                                </div>

                                <div class="form-group">
                                    <input
                                        class="form-control <?php echo (isset($_SESSION['msg-pass'])) ? 'border-danger' : ''; ?>"
                                        id="password" name="password" placeholder="Password" type="password"
                                        value="<?php echo (isset($_SESSION['password'])) ? $_SESSION['password'] : ''; ?>" />
                                    <?php if (isset($_SESSION['msg-pass'])) { ?>
                                    <span class="text-danger"><?php echo $_SESSION['msg-pass']; ?></span>
                                    <?php } ?>
                                </div>

                                <div class="form-group">
                                    <a href="forgot-password.php">Forgot password?</a>
                                </div>

                                <button class="btn btn-lg btn-success btn-block" type="submit"
                                    name="btn-login">Login</button>
                            </fieldset>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- jQuery -->
    <script src="../assets/js/jquery.min.js" type="text/javascript"></script>

    <!-- Bootstrap Core JavaScript -->
    <script src="../../assets/js/bootstrap.min.js" type="text/javascript"></script>

    <!-- Metis Menu Plugin JavaScript -->
    <script src="../../assets/js/metisMenu.min.js" type="text/javascript"></script>

    <!-- Custom Theme JavaScript -->
    <script src="../../assets/js/startmin.js" type="text/javascript"></script>

</body>

</html>
<?php
session_destroy();
?>