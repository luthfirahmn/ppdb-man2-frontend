<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1" />
    <title><?php echo $template['title']; ?></title>

    <!-- Google Font: Source Sans Pro -->
    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700&display=fallback" />
    <!-- Font Awesome Icons -->
    <link rel="stylesheet" href="<?= base_url('assets/adminlte/plugins/fontawesome-free/css/all.min.css') ?>" />
    <!-- Theme style -->
    <link rel="stylesheet" href="<?= base_url('assets/adminlte/dist/css/adminlte.min.css') ?>" />
    <link rel="stylesheet" href="<?= base_url('assets/adminlte') ?>/plugins/sweetalert2/dist/sweetalert2.min.css">

    <style>
        .brand-image:not(.sidebar-collapse .brand-image) {
            display: none !important;
        }
    </style>


    <?php
    if (isset($pageCSS) && count($pageCSS) > 0) {
        for ($i = 0; $i < count($pageCSS); $i++) {
            echo "<link rel=\"stylesheet\" href=\"" . BASE_URL . "assets/adminlte/" . $pageCSS[$i] . "\" />" . "\r\n\x20\x20";
        }
    }
    ?>
    <?php echo (isset($css) ? '<link rel="stylesheet" href="' . $css . '">' : '') . "\r\n\x20\x20" ?>
</head>

<body class="hold-transition sidebar-mini sidebar-collapse">
    <div class="wrapper">
        <!-- Navbar -->
        <nav class="main-header navbar navbar-expand navbar-white navbar-light">
            <!-- Left navbar links -->
            <ul class="navbar-nav">
                <li class="nav-item">
                    <a class="nav-link" data-widget="pushmenu" href="#" role="button"><i class="fas fa-bars"></i></a>
                </li>
            </ul>
            <!-- Right Navbar -->
            <ul class="navbar-nav ml-auto">
                <li class="nav-item dropdown user user-menu">
                    <a href="#" class="nav-link dropdown-toggle" data-toggle="dropdown" style="padding-right: 0.5rem">
                        <img src="<?= base_url('assets/adminlte/dist/img/avatar5.png') ?>" class="user-image img-circle elevation-2" alt="User Image" />
                        <span class="d-none d-md-block float-right">Admin</span>
                    </a>
                    <ul class="dropdown-menu dropdown-menu-lg dropdown-menu-right">
                        <li class="user-footer">
                            <div>
                                <a href="<?php echo base_url('login/logout') ?>" class="btn btn-default btn-flat btn-block">Sign out</a>
                            </div>
                        </li>
                    </ul>
                </li>
            </ul>
        </nav>
        <!-- /.navbar -->

        <!-- Main Sidebar Container -->
        <?php echo $template['partials']['sidebar']; ?>


        <!-- Content Wrapper. Contains page content -->
        <div class="content-wrapper">
            <!-- Content Header (Page header) -->
            <?php echo $template['partials']['content-header']; ?>
            <!-- /.content-header -->

            <!-- Main content -->
            <?php echo $template['body']; ?>


            <!-- /.content -->
        </div>
        <!-- /.content-wrapper -->

        <!-- Main Footer -->
        <footer class="main-footer">
            <strong>Copyright &copy; 2022 <a href="#">MAN 2 KOTA BANDUNG</a>.</strong> All
            rights reserved.
        </footer>
    </div>
    <!-- ./wrapper -->

    <!-- REQUIRED SCRIPTS -->
    <script type="text/javascript">
        var BASE_URL = '<?= BASE_URL ?>';
        var funct = '<?= $this->uri->segment(1) ?>';
        var index = '<?= $this->uri->segment(2) ?>';
        var MAdd = '<?= isset($MAdd) ? $MAdd : 0  ?>';
    </script>
    <!-- jQuery -->
    <script src="<?= base_url('assets/adminlte/plugins/jquery/jquery.min.js') ?>"></script>
    <!-- Bootstrap 4 -->
    <script src="<?= base_url('assets/adminlte/plugins/bootstrap/js/bootstrap.bundle.min.js') ?>"></script>
    <!-- AdminLTE App -->
    <script src="<?= base_url('assets/adminlte/dist/js/adminlte.min.js') ?>"></script>
    <script src="<?= base_url('assets/adminlte') ?>/plugins/sweetalert2/dist/sweetalert2.min.js"></script>


    <script>
        $(document).ready(function() {
            const isHover = e => e.parentElement.querySelector(':hover') === e;
            const myDiv = document.getElementById("main-sidebar");
            document.addEventListener("mousemove", function checkHover() {
                const hovered = isHover(myDiv);
                if (hovered !== checkHover.hovered) {
                    if (hovered) {
                        $('.brand-image').addClass('d-none');
                    } else {
                        $('.brand-image').removeClass('d-none');
                    }
                    checkHover.hovered = hovered;
                }
            });

        });
    </script>
    <?php
    if (isset($pageJS) && count($pageJS) > 0) {
        for ($i = 0; $i < count($pageJS); $i++) {
            $UrlParams = explode("/", $pageJS[$i]);
            $srcJs = ($UrlParams[0] == "https:" or $UrlParams[0] == "http:") ? $pageJS[$i] : BASE_URL . 'assets/adminlte/' . $pageJS[$i];
            echo "<script src=\"" . $srcJs . "\"></script>" . "\r\n\x20\x20";
        }
    }
    ?>

    <?php echo (isset($js) ? '<script src="' . $js . '"></script>' : '') . "\r\n\x20\x20" ?>
    <script src="<?= base_url() ?>assets/adminlte/main.js"></script>

</body>

</html>
<!-- tes -->