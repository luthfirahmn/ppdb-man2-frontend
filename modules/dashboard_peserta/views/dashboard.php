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
                                            <a class="nav-link font-weight-bold active" href="<?= base_url("dashboard_peserta") ?>">
                                                <span class="d-none d-md-block">Informasi</span>
                                                <i data-feather="home" class="d-block d-md-none"></i>
                                            </a>
                                        </li>
                                        <li class="nav-item">
                                            <a class="nav-link font-weight-bold " href="<?= base_url("settings") ?>">
                                                <span class="d-none d-md-block">Pengaturan Akun</span>
                                                <i data-feather="settings" class="d-block d-md-none"></i>
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
                <div class="col-lg-3 col-12 order-2 order-lg-1" id="profil_siswa">
                    <!-- about -->
                    <div class="card">
                        <div class="card-body">
                            <h5 class="mb-75">Profile</h5>
                            <small>
                                Informasi singkat peserta
                            </small>
                            <div class="mt-2">
                                <h5 class="mb-75">Nama</h5>
                                <p class="card-text"><?= $infoPeserta['nama_lengkap'] ?></p>
                            </div>
                            <div class="mt-2">
                                <h5 class="mb-75">No Whatsapp</h5>
                                <p class="card-text"><?= $infoPeserta['no_wa'] ?></p>
                            </div>
                            <div class="mt-2">
                                <h5 class="mb-75">Email</h5>
                                <p class="card-text"><?= $infoPeserta['email'] ?></p>
                            </div>
                            <div class="mt-2">
                                <h5 class="mb-50">Jalur Pilihan</h5>
                                <p class="card-text mb-0"><?= $infoPeserta['jalur'] ?></p>
                            </div>
                        </div>
                    </div>
                    <!--/ about -->


                    <!--/ twitter feed card -->
                </div>
                <!--/ left profile info section -->

                <!-- center profile info section -->
                <div class="col-lg-7 col-12 order-1 order-lg-2">
                    <!-- post 1 -->
                    <div class="card">
                        <div class="card-body">
                            <h5 class="mb-0">Informasi</h5>
                            <div class="d-flex justify-content-start align-items-center mb-1 mt-2">
                                <div class="demo-spacing-0 col-md-12">


                                    <?php foreach ($info as $row) { ?>
                                        <div class="alert alert-primary col-md-12" role="alert">
                                            <h4 class="alert-heading"><?= $row->title ?></h4>
                                            <div class="alert-body">
                                                <?= $row->info ?>

                                                <?php
                                                switch ($row->btn) {
                                                    case 'btn_download_btq':
                                                        echo '<p class="card-text">
                                                    <a href="' . base_url("dashboard_peserta/download_kartu_btq") . '"
                                                        class="btn btn-outline-primary">
                                                        <i data-feather="download" class="mr-25"></i>
                                                        <span>Download</span>
                                                        </a>
                                                        </p>';
                                                        break;
                                                    case 'btn_download_ujian_akademik':
                                                        echo '<p class="card-text  mt-2">
                                                    <a href="' . base_url("dashboard_peserta/download_kartu_akademik") . '"
                                                        class="btn btn-outline-primary ">
                                                        <i data-feather="download" class="mr-25"></i>
                                                        <span>Download Kartu</span>
                                                        </a>
                                                        </p>';
                                                        break;
                                                    case 'btn_kartu_status_non_akademik':
                                                        echo '<p class="card-text  mt-2">
                                                    <a href="' . base_url("dashboard_peserta/download_status_kelulusan_non_akademik") . '"
                                                        class="btn btn-outline-primary ">
                                                        <i data-feather="download" class="mr-25"></i>
                                                        <span>Download Pengumuman Status</span>
                                                        </a>
                                                        </p>';
                                                        break;
                                                    case 'btn_kartu_status_akademik':
                                                        echo '<p class="card-text  mt-2">
                                                    <a href="' . base_url("dashboard_peserta/download_status_kelulusan_akademik") . '"
                                                        class="btn btn-outline-primary ">
                                                        <i data-feather="download" class="mr-25"></i>
                                                        <span>Download Pengumuman Status</span>
                                                        </a>
                                                        </p>';
                                                        break;
                                                    case 'btn_form_data_diri':
                                                        echo '<p class="card-text">
                                                    <a href="' . base_url("emis") . '"
                                                        class="btn btn-outline-primary">
                                                        <i data-feather="file-text" class="mr-25"></i>
                                                        <span>Form Data Diri</span>
                                                        </a>
                                                        </p>';
                                                        break;
                                                }
                                                ?>
                                            </div>
                                        </div>

                                    <?php } ?>

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
