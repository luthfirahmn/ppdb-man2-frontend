<!DOCTYPE html>
<html class="loading" lang="en" data-textdirection="ltr">
<!-- BEGIN: Head-->

<head>
    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width,initial-scale=1.0,user-scalable=0,minimal-ui">
    <meta name="description"
        content="Vuexy admin is super flexible, powerful, clean &amp; modern responsive bootstrap 4 admin template with unlimited possibilities.">
    <meta name="keywords"
        content="admin template, Vuexy admin template, dashboard template, flat admin template, responsive admin template, web app">
    <meta name="author" content="PIXINVENT">
    <title><?php echo $template['title']; ?></title>
    <link rel="apple-touch-icon" href="<?= base_url() ?>assets/mantemplate/images/ico/apple-icon-120.png">
    <link rel="shortcut icon" type="image/x-icon" href="<?php echo base_url() ?>assets/images/logo-man2.png">
    <link href="https://fonts.googleapis.com/css2?family=Montserrat:ital,wght@0,300;0,400;0,500;0,600;1,400;1,500;1,600"
        rel="stylesheet">

    <!-- BEGIN: Vendor CSS-->
    <link rel="stylesheet" type="text/css" href="<?= base_url() ?>assets/mantemplate/vendors/css/vendors.min.css">
    <link rel="stylesheet" type="text/css"
        href="<?php echo FT_APP_ASSETS . 'vendors/css/forms/select/select2.min.css' ?>">
    <link rel="stylesheet" type="text/css"
        href="<?= base_url() ?>assets/mantemplate/vendors/css/extensions/toastr.min.css">
    <link rel="stylesheet" type="text/css"
        href="<?= base_url() ?>assets/mantemplate/vendors/css/extensions/sweetalert2.min.css">
    <link rel="stylesheet" type="text/css"
        href="<?php echo base_url() ?>assets/mantemplate/vendors/css/pickers/flatpickr/flatpickr.min.css">
    <!-- <link rel="stylesheet" type="text/css" href="<?php echo base_url() ?>assets/mantemplate/vendors/customs/fontawesome-free/css/all.min.css"> -->

    <!-- END: Vendor CSS-->

    <!-- BEGIN: Theme CSS-->
    <link rel="stylesheet" type="text/css" href="<?= base_url() ?>assets/mantemplate/css/bootstrap.css">
    <link rel="stylesheet" type="text/css" href="<?= base_url() ?>assets/mantemplate/css/bootstrap-extended.css">
    <link rel="stylesheet" type="text/css" href="<?= base_url() ?>assets/mantemplate/css/colors.css">
    <link rel="stylesheet" type="text/css" href="<?= base_url() ?>assets/mantemplate/css/components.css">
    <link rel="stylesheet" type="text/css" href="<?= base_url() ?>assets/mantemplate/css/themes/dark-layout.css">
    <link rel="stylesheet" type="text/css" href="<?= base_url() ?>assets/mantemplate/css/themes/bordered-layout.css">
    <link rel="stylesheet" type="text/css" href="<?= base_url() ?>assets/mantemplate/css/themes/semi-dark-layout.css">

    <!-- BEGIN: Page CSS-->

    <link rel="stylesheet" type="text/css"
        href="<?php echo base_url() ?>assets/mantemplate/css/core/menu/menu-types/horizontal-menu.css">
    <link rel="stylesheet" type="text/css"
        href="<?= base_url() ?>assets/mantemplate/css/plugins/extensions/ext-component-toastr.css">
    <link rel="stylesheet" type="text/css"
        href="<?= base_url() ?>assets/mantemplate/css/plugins/extensions/ext-component-sweet-alerts.css">
    <!-- END: Page CSS-->

    <?php
    if (!empty($template['style'])) {
        foreach ($template['style'] as $row) {
            echo $row;
        }
    }
    ?>

    <!-- BEGIN: Vendor JS-->
    <script src="<?= base_url() ?>assets/mantemplate/vendors/js/vendors.min.js"></script>

    <!-- BEGIN Vendor JS-->
    <script src="<?= base_url() ?>assets/mantemplate/vendors/js/ui/jquery.sticky.js"></script>
    <script src="<?= base_url() ?>assets/mantemplate/vendors/js/pickers/flatpickr/flatpickr.min.js"></script>
    <script src="<?= base_url() ?>assets/mantemplate/vendors/js/extensions/toastr.min.js"></script>
    <script src="<?= base_url() ?>assets/mantemplate/vendors/js/extensions/sweetalert2.all.min.js"></script>
    <!-- END: Page Vendor JS-->

    <?php
    if (!empty($template['script'])) {
        foreach ($template['script'] as $row) {
            echo $row;
        }
    } ?>

</head>
<!-- END: Head-->

<body class="horizontal-layout horizontal-menu  navbar-floating footer-static  " data-open="hover"
    data-menu="horizontal-menu" data-col="">


    <?php
    // if ($this->session->userdata('status_login') != true) {
    //     redirect('login');
    // }

    echo $template['partials']['header'];
    echo $template['partials']['sidebar'];
    ?>
    <!-- Main Sidebar Container -->

    <!-- BEGIN: Content-->
    <div class="app-content content ">
        <div class="content-overlay"></div>
        <div class="header-navbar-shadow"></div>
        <div class="content-wrapper">
            <?php echo $template['partials']['content-header']; ?>

            <div class="content-body">
                <?php echo $template['body']; ?>
            </div>
        </div>
    </div>

    <div class="sidenav-overlay"></div>
    <div class="drag-target"></div>

    <!-- BEGIN: Footer-->
    <footer class="footer footer-static footer-light">
        <p class="clearfix mb-0"><span class="float-md-left d-block d-md-inline-block mt-25">COPYRIGHT &copy; 2022<a
                    class="ml-25" href="#" target="_blank">MAN 2 KOTA BANDUNG</a><span
                    class="d-none d-sm-inline-block">, All rights Reserved</span></span><span
                class="float-md-right d-none d-md-block">Hand-crafted & Made with<i data-feather="heart"></i></span></p>
    </footer>
    <button class="btn btn-primary btn-icon scroll-top" type="button"><i data-feather="arrow-up"></i></button>
    <!-- END: Footer-->
    <!-- <script src="<?= base_url() ?>assets/mantemplate/vendors/js/forms/select/select2.full.min.js"></script> -->

    <!-- BEGIN: Theme JS-->
    <script src="<?= base_url() ?>assets/mantemplate/js/core/app-menu.js"></script>
    <script src="<?= base_url() ?>assets/mantemplate/js/core/app.js"></script>
    <!-- END: Theme JS-->


    <script>
    $(window).on('load', function() {
        if (feather) {
            feather.replace({
                width: 14,
                height: 14
            });
        }
    })
    </script>


</body>

</html>
