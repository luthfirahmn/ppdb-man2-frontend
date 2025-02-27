<!DOCTYPE html>
<html class="loading" lang="en" data-textdirection="ltr">
<!-- BEGIN: Head-->

<head>
    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width,initial-scale=1.0,user-scalable=0,minimal-ui">
    <meta name="description" content="Selamat Datang Di PPDB MAN 2 KOTA BANDUNG">
    <meta name="keywords" content="PPDB MAN 2 KOTA BANDUNG">
    <meta name="author" content="MAN 2 KOTA BANDUNG">
    <title>MAN 2 KOTA BANDUNG</title>
    <link rel="icon" type="image/x-icon" href="<?php echo base_url() ?>assets/images/logo-man2.png">
    <link href="https://fonts.googleapis.com/css2?family=Montserrat:ital,wght@0,300;0,400;0,500;0,600;1,400;1,500;1,600" rel="stylesheet">

    <!-- BEGIN: Vendor CSS-->
    <link rel="stylesheet" type="text/css" href="<?php echo FT_APP_ASSETS ?>vendors/css/vendors.min.css">
    <link rel="stylesheet" type="text/css" href="<?php echo FT_APP_ASSETS ?>vendors/css/extensions/toastr.min.css">

    <!-- END: Vendor CSS-->

    <!-- BEGIN: Theme CSS-->
    <link rel="stylesheet" type="text/css" href="<?php echo FT_APP_ASSETS ?>css/bootstrap.css">
    <link rel="stylesheet" type="text/css" href="<?php echo FT_APP_ASSETS ?>css/bootstrap-extended.css">
    <link rel="stylesheet" type="text/css" href="<?php echo FT_APP_ASSETS ?>css/colors.css">
    <link rel="stylesheet" type="text/css" href="<?php echo FT_APP_ASSETS ?>css/components.css">
    <link rel="stylesheet" type="text/css" href="<?php echo FT_APP_ASSETS ?>css/themes/dark-layout.css">
    <link rel="stylesheet" type="text/css" href="<?php echo FT_APP_ASSETS ?>css/themes/bordered-layout.css">
    <link rel="stylesheet" type="text/css" href="<?php echo FT_APP_ASSETS ?>css/themes/semi-dark-layout.css">

    <!-- BEGIN: Page CSS-->
    <link rel="stylesheet" type="text/css" href="<?php echo FT_APP_ASSETS ?>css/core/menu/menu-types/horizontal-menu.css">
    <link rel="stylesheet" type="text/css" href="<?php echo FT_APP_ASSETS ?>css/plugins/forms/form-validation.css">
    <link rel="stylesheet" type="text/css" href="<?php echo FT_APP_ASSETS ?>css/pages/page-auth.css">
    <link rel="stylesheet" type="text/css" href="<?php echo FT_APP_ASSETS ?>css/plugins/extensions/ext-component-toastr.css">
    <!-- END: Page CSS-->

</head>
<!-- END: Head-->

<!-- BEGIN: Body-->

<body class="horizontal-layout horizontal-menu blank-page navbar-floating footer-static  " data-open="hover" data-menu="horizontal-menu" data-col="blank-page">
    <!-- BEGIN: Content-->
    <div class="app-content content ">
        <div class="content-overlay"></div>
        <div class="header-navbar-shadow"></div>
        <div class="content-wrapper">
            <div class="content-header row">
            </div>
            <div class="content-body">
                <div class="auth-wrapper auth-v1 px-2">
                    <div class="auth-inner py-2">
                        <!-- Register v1 -->
                        <div class="card mb-0">
                            <div class="card-body">
                                <img src="<?php echo base_url() ?>assets/images/logo-man2.png" width="50" class="img-responsive center-block d-block mx-auto">
                                <a href="javascript:void(0);" class="brand-logo">
                                    <h3 class="brand-text text-primary ml-1">MAN 2 KOTA BANDUNG</h3>
                                </a>

                                <h4 class="card-title mb-1">Lupa Password</h4>
                                <p class="card-text mb-2">Silahkan isi form dibawah</p>

                                <form class="auth-register-form mt-2">
                                    <div class="form-group">
                                        <label for="tgl_lahir" class="form-label">No Whatsapp </label>
                                        <div class="input-group">
                                            <div class="input-group-prepend">
                                                <span class="input-group-text" id="basic-addon3">+62</span>
                                            </div>
                                            <input type="number" class="form-control" id="no_wa" name="no_wa" aria-describedby="basic-addon3" />
                                            <span class="text-danger"></span>
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <div class="d-flex justify-content-between">
                                            <label for="password" class="form-label">Password Baru</label>

                                        </div>
                                        <div class="input-group input-group-merge form-password-toggle">
                                            <input type="password" class="form-control form-control-merge" id="password" name="password" placeholder="&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;" aria-describedby="register-password" tabindex="3" />
                                            <div class="input-group-append">
                                                <span class="input-group-text cursor-pointer"><i data-feather="eye"></i></span>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <div class="d-flex justify-content-between">
                                            <label for="password" class="form-label">Ulang Password Baru</label>

                                        </div>
                                        <div class="input-group input-group-merge form-password-toggle">
                                            <input type="password" class="form-control form-control-merge" id="re-password" name="re-password" placeholder="&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;" aria-describedby="register-password" tabindex="3" />
                                            <div class="input-group-append">
                                                <span class="input-group-text cursor-pointer"><i data-feather="eye"></i></span>
                                            </div>
                                        </div>
                                    </div>

                                    <div class="form-group">
                                        <label for="otp" class="form-label">OTP</label>
                                        <input type="number" class="form-control " id="otp" name="otp" tabindex="2" autocomplete="off" />
                                        <span class="text-danger mb-1"><small>. Kode OTP akan dikirimkan melalui
                                                whatsapp yanng digunakan untuk mengganti password</small></span>
                                        <button class="btn btn-primary btn-sm" type="button" id="btn-otp"> Dapatkan kode
                                            OTP </button>
                                    </div>

                                    <button class="btn btn-primary btn-block" tabindex="5">Ganti Password</button>
                                </form>

                                <p class="text-center fs-6 mt-2">
                                    <a href="<?php echo base_url('login_peserta') ?>">
                                        <span>Kembali ke Login</span>
                                    </a>
                                </p>

                            </div>
                            <!-- /Register v1 -->
                        </div>
                    </div>

                </div>
            </div>
        </div>
        <!-- END: Content-->


        <!-- BEGIN: Vendor JS-->
        <script src="<?php echo FT_APP_ASSETS ?>vendors/js/vendors.min.js"></script>
        <!-- BEGIN Vendor JS-->

        <!-- BEGIN: Page Vendor JS-->
        <script src="<?php echo FT_APP_ASSETS ?>vendors/js/ui/jquery.sticky.js"></script>
        <script src="<?php echo FT_APP_ASSETS ?>vendors/js/forms/validation/jquery.validate.min.js"></script>
        <!-- END: Page Vendor JS-->

        <!-- BEGIN: Theme JS-->
        <script src="<?php echo FT_APP_ASSETS ?>js/core/app-menu.js"></script>
        <script src="<?php echo FT_APP_ASSETS ?>js/core/app.js"></script>


        <script src="<?php echo FT_APP_ASSETS ?>vendors/js/extensions/toastr.min.js"></script>
        <!-- END: Theme JS-->

        <!-- BEGIN: Page JS-->
        <!-- <script src="<?php echo FT_APP_ASSETS ?>js/scripts/pages/page-auth-register.js"></script> -->
        <!-- END: Page JS-->

        <script>
            $(window).on('load', function() {
                if (feather) {
                    feather.replace({
                        width: 14,
                        height: 14
                    });
                }
            })

            $(function() {
                'use strict';


                $('#btn-otp').click(function() {
                    var btn = $(this);
                    btn.prop("disabled", true);

                    var countdown = 60;
                    var countdownInterval = setInterval(function() {
                        countdown--;
                        btn.text("Kirim ulang (" + countdown + "s)");

                        if (countdown <= 0) {
                            clearInterval(countdownInterval);
                            btn.text("Dapatkan Kode OTP");
                            btn.prop("disabled", false);
                        }
                    }, 1000);

                    var no_wa = $('#no_wa').val();
                    $.ajax({
                        url: "<?php echo base_url('lupa_password/get_otp') ?>",
                        type: "POST",
                        data: {
                            no_wa: no_wa
                        },
                        dataType: "json",
                        beforeSend: function() {
                            $('#btn-otp').attr('disable', 'disabled');
                            $('#btn-otp').html(
                                '<span class="spinner-grow spinner-grow-sm" role="status" aria-hidden="true"></span> <span class = "ml-25 align-middle" > Loading... </span>'
                            );
                        },
                        complete: function() {
                            $('#btn-otp').removeAttr('disable');
                            $('#btn-otp').html('Dapatkan Kode OTP');
                        },
                        success: function(data) {
                            if (data.error == false) {
                                toastr.success(data.msg, 'Success Mengirim OTP!', {
                                    closeButton: true,
                                    progressBar: true,
                                    tapToDismiss: false
                                })

                            } else {
                                toastr.error(data.msg, 'Error Mengirim OTP!', {
                                    progressBar: true,
                                    allowHtml: true,
                                    closeButton: true,
                                    tapToDismiss: false
                                });
                            }
                        },
                    })
                })


                var page = $('.auth-register-form');

                // jQuery Validation
                // --------------------------------------------------------------------
                if (page.length) {
                    page.validate({

                        onkeyup: function(element) {
                            $(element).valid();
                        },
                        rules: {
                            'no_wa': {
                                required: true,
                            },
                            'password': {
                                required: true,
                                minlength: 6
                            },
                            're-password': {
                                required: true,
                                equalTo: '#password',
                                minlength: 6
                            },
                            'otp': {
                                required: true,
                            },
                        },
                        messages: {
                            'no_wa': {
                                required: 'No Whatsapp tidak boleh kosong'
                            },
                            'password': {
                                required: 'Password tidak boleh kosong',
                                minlength: jQuery.validator.format(
                                    "Password harus memiliki minimal {0} karakter")
                            },
                            're-password': {
                                required: 'Ulangi Password tidak boleh kosong',
                                minlength: jQuery.validator.format(
                                    "Password harus memiliki minimal {0} karakter"),
                                equalTo: "Password tidak sama"
                            },
                            'otp': {
                                required: 'Kode OTP tidak boleh kosong'
                            },
                        },

                        submitHandler: function(page) {
                            $.ajax({
                                url: "<?php echo base_url('lupa_password/forgot_password') ?>",
                                type: "POST",
                                data: $(page).serialize(),
                                dataType: "json",
                                beforeSend: function() {
                                    $('.save').attr('disable', 'disabled');
                                    $('.save').html(
                                        '<span class="spinner-grow spinner-grow-sm" role="status" aria-hidden="true"></span> <span class = "ml-25 align-middle" > Loading... </span>'
                                    );
                                },
                                complete: function() {
                                    $('.save').removeAttr('disable');
                                    $('.save').html('Simpan');
                                },
                                success: function(data) {
                                    if (data.error == false) {
                                        toastr.success(data.msg, 'Success!', {
                                            closeButton: true,
                                            progressBar: true,
                                            tapToDismiss: false
                                        })
                                        window.location.href =
                                            '<?php echo base_url('dashboard_peserta') ?>';

                                    } else {
                                        toastr.error(data.msg, 'Error!', {
                                            progressBar: true,
                                            allowHtml: true,
                                            closeButton: true,
                                            tapToDismiss: false
                                        });
                                    }
                                },
                            });
                        }
                    });


                }
                // end validation

            });
        </script>
    </div>
</body>
<!-- END: Body-->

</html>
