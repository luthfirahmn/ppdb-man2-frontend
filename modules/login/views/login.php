<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Admin | Log in</title>
    <!-- <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700&display=fallback"> -->
    <link rel="stylesheet" href="<?= base_url('assets/adminlte') ?>/plugins/fontawesome-free/css/all.min.css">
    <link rel="stylesheet" href="<?= base_url('assets/adminlte') ?>/plugins/icheck-bootstrap/icheck-bootstrap.min.css">
    <link rel="stylesheet" href="<?= base_url('assets/adminlte') ?>/dist/css/adminlte.min.css">
    <link rel="stylesheet" href="<?= base_url('assets/adminlte') ?>/plugins/sweetalert2/dist/sweetalert2.min.css">

</head>

<body class="hold-transition login-page">
    <div class="login-box">
        <div class="login-logo">
            <img src="<?= base_url('assets/images/logo-man2.png') ?>" width=" 130"><br>
            <a href="<?= base_url('assets/adminlte') ?>index2.html"><b>MAN 2 KOTA BANDUNG</b></a>
        </div>
        <div class="card">
            <div class="card-body login-card-body" style="border-radius: 10px;">
                <p class="login-box-msg">Sign in to start your session</p>
                <div class="alert alert-danger error-msg" style="display:none"></div>
                <form id="form-login">
                    <div class="input-group mb-3">
                        <input type="email" name="email" class="form-control" placeholder="Email" id="email">
                        <div class="input-group-append">
                            <div class="input-group-text">
                                <span class="fas fa-envelope"></span>
                            </div>
                        </div>
                    </div>
                    <div class="input-group mb-3">
                        <input type="password" name="password" class="form-control" placeholder="Password" id="password">
                        <div class="input-group-append">
                            <div class="input-group-text">
                                <span class="fas fa-lock"></span>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-8">
                            <div class="icheck-primary">
                                <input type="checkbox" name="remember_me" id="remember">
                                <label for="remember">
                                    Remember Me
                                </label>
                            </div>
                        </div>
                        <div class="col-4">
                            <button type="button" id="btn-login" class="btn btn-primary btn-block btn-login">Sign In</button>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>

    <script src="<?= base_url('assets/adminlte') ?>/plugins/jquery/jquery.min.js"></script>
    <script src="<?= base_url('assets/adminlte') ?>/plugins/sweetalert2/dist/sweetalert2.min.js"></script>

    <script>
        //ajax add
        $('#btn-login').on('click', function() {

            $.ajax({
                type: "post",
                url: "<?php echo base_url('login/process_login') ?>",
                data: new FormData($('#form-login')[0]),
                processData: false,
                contentType: false,
                cache: false,
                dataType: "json",
                beforeSend: function() {
                    $('.btn-login').attr('disable', 'disabled');
                    $('.btn-login').html('<i class="fa fa-spin fa-spinner"></i>');
                },
                complete: function() {
                    $('.btn-login').removeAttr('disable');
                    $('.btn-login').html('<i class="ti-save"> </i> Save');
                },
                success: function(data) {
                    if (data.error == false) {
                        swal.fire({
                            title: "Success",
                            text: data.msg,
                            type: "success"
                        }).then(function() {
                            window.location.href = "<?php echo base_url('dashboard') ?>";
                        });

                    } else {
                        $(".error-msg").css('display', 'block');
                        $(".error-msg").html(data.msg);
                        window.scrollTo(0, 0)
                    }
                },

            });
        });

        $(document).ready(function() {
            $.ajax({
                url: '<?= base_url("backend/login/remember_me") ?>',
                type: "POST",
                data: {
                    remember_me: true
                },
                dataType: "json",
                success: function(response) {
                    $("#email").val(response.email);
                    $("#password").val(response.password);
                    $("#remember").prop('checked', response.checked);
                }
            })
        })

        setTimeout(function() {
            $('.alert-danger').hide();
        }, 4000);

        $(".close").click(function() {
            $(".alert-danger").hide();
        })
    </script>
</body>

</html>