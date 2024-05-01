<div class="content-body">
    <div id="user-profile">
        <!-- profile header -->
        <div class="row">
            <div class="col-12">
                <div class="card profile-header mb-2">
                    <!-- profile cover photo -->
                    <img class="card-img-top" src="<?= FT_APP_ASSETS ?>images/man2.jpeg" alt="User Profile Image" height="400" />
                    <!--/ profile cover photo -->

                    <div class="position-relative">
                        <!-- profile picture -->
                        <div class="profile-img-container d-flex align-items-center">
                            <div class="profile-img">
                                <img src="<?= isset($infoPeserta['foto']) ?  FT_UPLOAD_BERKAS . $infoPeserta['foto'] : FT_APP_ASSETS . 'images/user.png'   ?>" class="rounded img-fluid" alt="Card image" width="100%" />
                            </div>
                            <!-- profile title -->
                            <div class="profile-title ml-3">
                                <h2 class="text-white"><?= $infoPeserta['nama_lengkap'] ?></h2>
                                <p class="text-white"><?= $infoPeserta['email'] ?></p>
                            </div>
                        </div>
                    </div>

                    <!-- tabs pill -->
                    <div class="profile-header-nav">
                        <!-- navbar -->
                        <nav class="navbar navbar-expand-md navbar-light justify-content-end justify-content-md-between w-100">
                            <button class="btn btn-icon navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
                                <i data-feather="align-justify" class="font-medium-5"></i>
                            </button>

                            <!-- collapse  -->
                            <div class="collapse navbar-collapse collapse show" id="navbarSupportedContent">
                                <div class="profile-tabs d-flex justify-content-between flex-wrap mt-1 mt-md-0">
                                    <ul class="nav nav-pills mb-0">
                                        <li class="nav-item">
                                            <a class="nav-link font-weight-bold " href="<?= base_url("dashboard_peserta") ?>">
                                                <span class="d-none d-md-block">Informasi</span>
                                                <i data-feather="home" class="d-block d-md-none"></i>
                                            </a>
                                        </li>
                                        <li class="nav-item">
                                            <a class="nav-link font-weight-bold active" href="<?= base_url("settings") ?>">
                                                <span class="d-none d-md-block">Pengaturan Akun</span>
                                                <i data-feather="users" class="d-block d-md-none"></i>
                                            </a>
                                        </li>

                                    </ul>

                                </div>
                            </div>
                            <!--/ collapse  -->
                        </nav>
                        <!--/ navbar -->
                    </div>
                </div>
            </div>
        </div>
        <!--/ profile header -->

        <!-- profile info section -->
        <section id="profile-info">
            <div class="row">
                <!-- left profile info section -->
                <div class="col-lg-3 col-12 order-1 order-lg-1" id="profil_siswa">
                    <!-- about -->
                    <div class="card">
                        <div class="card-body">
                            <div class="collapse navbar-collapse collapse show" id="navbarSupportedContent">
                                <div class="profile-tabs mt-1 mt-md-0">
                                    <p class="font-weight-bold">Menu</p>
                                    <ul class="nav nav-pills mb-0">
                                        <li class="nav-item">
                                            <a class="nav-link font-weight-bold active" href="<?= base_url("dashboard_peserta") ?>">
                                                <span class="d-none d-md-block">Ganti Password</span>
                                                <i data-feather="keys" class="d-block d-md-none"></i>
                                            </a>
                                        </li>

                                    </ul>

                                </div>
                            </div>
                        </div>
                    </div>
                    <!--/ about -->


                    <!--/ twitter feed card -->
                </div>
                <!--/ left profile info section -->

                <!-- center profile info section -->
                <div class="col-lg-7 col-12 order-2 order-lg-2">
                    <!-- post 1 -->
                    <div class="card">
                        <div class="card-body">
                            <h5 class="mb-0">Ganti Password</h5>
                            <div class="d-flex justify-content-start align-items-center mb-1 mt-2">
                                <div class="demo-spacing-0 col-md-12">

                                    <form class="change_password_form">
                                        <input type="hidden" value="<?= isset($infoPeserta["id"]) ? $infoPeserta["id"] : '' ?>" name="id_siswa">
                                        <div class="form-group">
                                            <label for="password" class="form-label">Password</label>
                                            <div class="input-group input-group-merge form-password-toggle">
                                                <input type="password" class="form-control form-control-merge" id="password" name="password" placeholder="&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;" aria-describedby="register-password" tabindex="3" />

                                            </div>
                                        </div>
                                        <div class="form-group">
                                            <label for="password" class="form-label">Konfirmasi Password</label>
                                            <div class="input-group input-group-merge form-password-toggle">
                                                <input type="password" class="form-control form-control-merge" id="confirm_password" name="confirm_password" placeholder="&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;" aria-describedby="register-password" tabindex="3" placeholder="Tulis ulang password" />

                                            </div>
                                        </div>

                                        <button class="btn btn-primary btn-block" tabindex="5">Ganti Password</button>
                                    </form>

                                </div>
                            </div>
                        </div>
                    </div>
                    <!--/ post 1 -->
                </div>
                <!--/ center profile info section -->


            </div>


            <!--/ reload button -->
        </section>
        <!--/ profile info section -->
    </div>

</div>



<script>
    $(function() {
        'use strict';


        var page = $('.change_password_form');

        // jQuery Validation
        // --------------------------------------------------------------------
        if (page.length) {
            page.validate({

                onkeyup: function(element) {
                    $(element).valid();
                },
                rules: {
                    'password': {
                        required: true,
                        minlength: 6
                    },
                    'confirm_password': {
                        required: true,
                        minlength: 6,
                        equalTo: "#password"
                    }
                },
                messages: {

                    'password': {
                        required: 'Password tidak boleh kosong',
                        minlength: jQuery.validator.format(
                            "Password harus memiliki minimal {0} karakter")
                    },
                    'confirm_password': {
                        required: 'Konfirmasi password tidak boleh kosong',
                        minlength: jQuery.validator.format(
                            "Password harus memiliki minimal {0} karakter"),
                        equalTo: "Password tidak sama"
                    }
                },

                submitHandler: function(page) {
                    Swal.fire({
                        title: 'Konfirmasi',
                        text: "Ganti Password?!",
                        icon: 'warning',
                        showCancelButton: true,
                        confirmButtonColor: '#3085d6',
                        cancelButtonColor: '#d33',
                        confirmButtonText: 'Ganti Password!'
                    }).then((result) => {
                        if (result.isConfirmed) {
                            $.ajax({
                                url: "<?php echo base_url('settings/change_password') ?>",
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
                                        toastr.success(data.msg,
                                            'Success Ganti Password!', {
                                                closeButton: true,
                                                progressBar: true,
                                                tapToDismiss: false
                                            })
                                        page.reset()
                                    } else {
                                        toastr.error(data.msg,
                                            'Error Ganti Password!', {
                                                progressBar: true,
                                                allowHtml: true,
                                                closeButton: true,
                                                tapToDismiss: false
                                            });
                                    }
                                },
                            });
                        }
                    })

                }
            });


        }
    })
    // end validation
</script>
