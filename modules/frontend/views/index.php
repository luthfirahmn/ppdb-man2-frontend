<!DOCTYPE html>
<html lang="en">

<head>

    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="">
    <meta name="author" content="PPDB MAN 2 KOTA BANDUNG">
    <link href="https://fonts.googleapis.com/css?family=Poppins:100,200,300,400,500,600,700,800,900" rel="stylesheet">

    <link rel="icon" type="image/x-icon" href="<?= ASSETS . 'images/logo-man2.png' ?>">
    <title> PPDB MAN 2 KOTA BANDUNG</title>

    <!-- Bootstrap core CSS -->
    <link href="<?= ASSETS . 'frontend' ?>/vendor/bootstrap/css/bootstrap.min.css" rel="stylesheet">


    <!-- Additional CSS Files -->
    <link rel="stylesheet" href="<?= ASSETS . 'frontend' ?>/assets/css/fontawesome.css">
    <link rel="stylesheet" href="<?= ASSETS . 'frontend' ?>/assets/css/templatemo-edu-meeting.css">
    <link rel="stylesheet" href="<?= ASSETS . 'frontend' ?>/assets/css/owl.css">
    <link rel="stylesheet" href="<?= ASSETS . 'frontend' ?>/assets/css/lightbox.css">
    <!--

TemplateMo 569 Edu Meeting

https://templatemo.com/tm-569-edu-meeting

-->
</head>

<body>

    <!-- Sub Header -->
    <div class="sub-header">
        <div class="container">
            <div class="row">
                <div class="col-lg-12 col-sm-8">
                    <div class="right-icons">
                        <p style="color:white !important;">
                            <marquee> <?= $infoHeader ?> </marquee>
                        </p>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- ***** Header Area Start ***** -->
    <header class="header-area header-sticky">
        <div class="container">
            <div class="row">
                <div class="col-12">
                    <nav class="main-nav">
                        <!-- ***** Logo Start ***** -->
                        <a href="<?= BASE_URL . 'frontend' ?>" class="logo d-flex d-none d-lg-block align-items-center  " style="font-size: 18px !important;">
                            <img src="<?= ASSETS . 'images/logo-man2.png' ?>" class="me-3" style="width: 30px; ">
                            PPDB MAN 2 KOTA BANDUNG
                        </a>

                        <a href="<?= BASE_URL . 'frontend' ?>" class="logo  d-lg-none align-items-center  " style="font-size: 10px !important;">
                            <img src="<?= ASSETS . 'images/logo-man2.png' ?>" class="me-2" style="width: 20px; ">
                            PPDB MAN 2 KOTA BANDUNG
                        </a>
                        <!-- ***** Logo End ***** -->
                        <!-- ***** Menu Start ***** -->
                        <ul class="nav">
                            <li class="scroll-to-section"><a href="#top" class="active">Pendaftaran</a></li>
                            <li class="scroll-to-section"><a href="#infoppdb">Info PPDB</a></li>
                            <li class="scroll-to-section"><a href="#jalur">Jalur Pilihan</a></li>
                            <li class="scroll-to-section"><a href="#alur">Alur & Agenda PPDB</a></li>
                            <li class="scroll-to-section"><a href="#tentang">Tentang</a></li>
                        </ul>
                        <a class='menu-trigger'>
                            <span>Menu</span>
                        </a>
                        <!-- ***** Menu End ***** -->
                    </nav>
                </div>
            </div>
        </div>
    </header>
    <!-- ***** Header Area End ***** -->

    <!-- ***** Main Banner Area Start ***** -->
    <section class="section main-banner" id="top" data-section="section1">
        <video autoplay muted loop id="bg-video">
            <source src="<?= ASSETS_UPLOAD ?>/video/video.mp4" type="video/mp4" />
        </video>

        <div class="video-overlay header-text">
            <div class="container">
                <div class="row">
                    <div class="col-lg-12">
                        <div class="caption">
                            <h6>Pendaftaran PPDB Tahun Ajaran 2025/2026</h6>
                            <h2>Informasi PPDB</h2>
                            <p><?= $getButtonData->desc ?></p>
                            <div class="d-lg-flex  ">
                                <?= $getButton ?>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <!-- ***** Main Banner Area End ***** -->


    <section class="meetings-page" id="infoppdb">
        <div class="container">
            <div class="row">
                <div class="col-lg-12">
                    <div class="section-heading text-center">
                        <h2>Info PPDB</h2>
                    </div>
                </div>
                <div class="col-lg-12">
                    <div class="row">

                        <div class="col-lg-12">
                            <div class="row grid">

                                <?php
                                if ($getArticle > 0) {
                                    foreach ($getArticle as $row) { ?>
                                        <div class="col-lg-4 templatemo-item-col all soon">
                                            <div class="meeting-item">
                                                <div class="thumb">

                                                    <img src="<?= ARTIKEL_PATH . $row->image ?>" alt="">

                                                </div>
                                                <div class="down-content ">
                                                    <div class="d-flex">
                                                        <div class="date">
                                                            <h6><?= date('M', strtotime($row->created_time)) ?> <span><?= date('d', strtotime($row->created_time)) ?></span></h6>
                                                        </div>
                                                        <a href="<?= BASE_URL . 'frontend/detail/' . $row->id ?> ">
                                                            <h4><?= html_escape($row->title) ?></h4>
                                                        </a>

                                                    </div>
                                                    <p><?= html_escape(slice_string($row->content, 35)) ?> <a href="<?= BASE_URL . 'frontend/detail/' . $row->id ?> " class="text-xs">Lihat Selengkapnya</a></p>
                                                </div>
                                            </div>
                                        </div>

                                <?php }
                                } else {
                                    echo '<p class="text-gray-700 text-base"> Informasi belum tersedia</p>';
                                }
                                ?>


                            </div>
                        </div>

                        <!-- <div class="col-lg-12">
                            <div class="pagination">
                                <ul>
                                    <li><a href="#">1</a></li>
                                    <li class="active"><a href="#">2</a></li>
                                    <li><a href="#">3</a></li>
                                    <li><a href="#"><i class="fa fa-angle-right"></i></a></li>
                                </ul>
                            </div>
                        </div> -->
                    </div>
                </div>
            </div>
        </div>

    </section>

    <section class="apply-now" id="jalur">
        <div class="container">
            <div class="row">
                <div class="col-lg-12">
                    <div class="section-heading text-center">
                        <h2>Jalur Pilihan</h2>
                    </div>
                </div>
                <div class="col-lg-6 align-self-center">
                    <div class="row">
                        <div class="col-lg-12">
                            <div class="item">
                                <h3>PERSYARATAN UMUM</h3>
                                <ol class="text-white list-group list-group-numbered">
                                    <li>Berusia Maksimal 21 Tahun pada 1 Juni 2025</li>
                                    <li>Surat Keterangan kelas 9 (bagi lulusan Tahun 2025)/Ijazah dari SMP/MTs Asal</li>
                                    <li>Surat Keterangan NISN/Screenshot dari https://nisn.data.kemdikbud.go.id</li>
                                    <li>Raport</li>
                                    <li>Akte Kelahiran</li>
                                    <li>Kartu Keluarga</li>
                                    <li>KTP Orangtua / Wali</li>
                                    <li>Pas Photo Berwarna ukuran 3x4 Terbaru</li>
                                </ol>

                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-lg-6" style="max-height: 50rem; overflow-y: auto;  scrollbar-width: none; ">
                    <div class="accordions is-first-expanded mb-4">
                        <article class="accordion">
                            <div class="accordion-head">
                                <span>JALUR SELEKSI AKADEMIK<br>
                                </span>
                                <span class="icon">
                                    <i class="icon fa fa-chevron-right"></i>
                                </span>
                            </div>
                            <div class="accordion-body">
                                <div class="content">
                                    <p class="fw-bold">Keterangan:</p>
                                    <p> Jalur Tes Seleksi Saringan Masukl</p>

                                    <p class="fw-bold">Informasi:</p>
                                    <p>
                                        Calon Peserta Jalur Tes Akademik akan
                                        melaksanakan Tes Seleksi Saringan Masuk
                                        Berbasis Komputer (CBT)</p>
                                </div>
                            </div>
                        </article>
                    </div>
                    <div class="accordions is-first-expanded">
                        <p class="fs-5 fw-bold">JALUR SELEKSI
                            NON AKADEMIK</p>
                        <article class="accordion">
                            <div class="accordion-head">
                                <span>PRESTASI<br>
                                </span>
                                <span class="icon">
                                    <i class="icon fa fa-chevron-right"></i>
                                </span>
                            </div>
                            <div class="accordion-body">
                                <div class="content">
                                    <p class="fw-bold">Keterangan:</p>
                                    <p> Siswa Berprestasi Bidang Seni, Olah Raga,
                                        Olimpiade KSM, OSN, Tahfidz, Robotik, dll</p>
                                    <p class="fw-bold">Persyaratan Khusus:</p>
                                    <p>
                                        Melampirkan Dokumen/Portopolio/Sertifikat
                                        yang terkait dengan kompetensi prestasi</p>

                                    <p class="fw-bold">Informasi:</p>
                                    <p>
                                        Calon peserta Jalur Prestasi akan
                                        melaksnakan Validasi dan Uji Kompetensi
                                        Prestasi oleh Panitia PPDBM MAN 2
                                        Kota Bandung</p>
                                </div>
                            </div>
                        </article>
                        <article class="accordion">
                            <div class="accordion-head">
                                <span>AFIRMASI
                                    KETM</span>
                                <span class="icon">
                                    <i class="icon fa fa-chevron-right"></i>
                                </span>
                            </div>
                            <div class="accordion-body">
                                <div class="content">
                                    <p class="fw-bold">Keterangan:</p>
                                    <p> Keluarga Pemegang KIP/PKH/KPS/KKS/SKTM</p>
                                    <p class="fw-bold">Persyaratan Khusus:</p>
                                    <p>
                                        Memiliki Kartu KIP, KKS, PKH, SKTM/DTKS
                                        dari Desa/kelurahan (Asli)</p>

                                    <p class="fw-bold">Informasi:</p>
                                    <p>
                                        Calon Peserta KETM harus bersedia
                                        dilakukan verifikasi dan survei kelayakan
                                        mengikuti jalur KETM oleh Panitia PPDBM
                                        MAN 2 Kota Bandung</p>
                                </div>
                            </div>
                        </article>
                        <article class="accordion last-accordion">
                            <div class="accordion-head">
                                <span>AFIRMASI
                                    PINDAH TUGAS</span>
                                <span class="icon">
                                    <i class="icon fa fa-chevron-right"></i>
                                </span>
                            </div>

                            <div class="accordion-body">
                                <div class="content">
                                    <p class="fw-bold">Keterangan:</p>
                                    <p> Perpindahan Tugas/Mutasi Kerja Orang Tua</p>
                                    <p class="fw-bold">Persyaratan Khusus:</p>
                                    <p>
                                        Melampirkan Dokumen SK Pengangkatan
                                        Pegawai / SK Pindah Tugas (Mutasi)
                                        Orangtua Calon Peserta didik dari daerah.
                                        asal ke Wilayah Bandung Raya.</p>

                                    <p class="fw-bold">Informasi:</p>
                                    <p>
                                        Calon Peserta jalur PPT akan melaksanakan
                                        Verifikasi dan Validasi data oleh Panitia
                                        PPDBM MAN 2 Kota Bandung</p>
                                </div>
                            </div>
                        </article>
                    </div>
                </div>
            </div>
        </div>
    </section>


    <style>
        .our-courses {
            position: relative;
            max-height: 800px;
            overflow-y: auto;
            scrollbar-width: none;
            padding-bottom: 50px;
        }

        .our-courses::-webkit-scrollbar {
            display: none;
        }

        /* Gradasi tetap di bagian bawah yang terlihat saat scroll */
        .our-courses .gradient-overlay {
            position: sticky;
            bottom: -130px;
            left: 0;
            width: 100%;
            height: 100px;
            background: linear-gradient(to bottom, rgba(255, 255, 255, 0), rgba(0, 0, 0, 0.9));
            pointer-events: none;
        }
    </style>

    <section class="our-courses" id="alur">
        <div class="container">
            <div class="row">
                <div class="col-lg-12">
                    <div class="section-heading text-center">
                        <h2>Alur & Agenda Pendaftaran PPDB</h2>
                    </div>
                </div>
                <div class="col-lg-6" style="max-height: ;">
                    <img src="<?= ASSETS . 'frontend' ?>/assets/images/alur.jpg">
                </div>
                <div class="col-lg-6">
                    <img src="<?= ASSETS . 'frontend' ?>/assets/images/agenda_jalur_1.png">
                </div>
            </div>
        </div>
        <!-- Elemen gradasi -->
        <div class="gradient-overlay"></div>
    </section>


    <section class="our-facts" id="tentang">
        <div class="container">
            <div class="row">
                <div class="col-lg-6">
                    <div class="row">
                        <div class="col-lg-12">
                            <h2>Tentang MAN 2 KOTA BANDUNG</h2>
                        </div>
                        <div class="col-lg-12">
                            <div class="row">
                                <div class="col-12">
                                    <div class="count-area-content percentage">
                                        <div class="count-title " style="font-size: 12px !important;">Madrasah Aliyah Negeri (MAN) 2 Kota Bandung, merupakan satu dari 77 Madrasah Aliyah Negeri (MAN) yang ada di Provinsi Jawa Barat, Indonesia. Madrasah Aliyah (MA) adalah satuan pendidikan setara dengan Sekolah Menengah Umum (SMU). MA ada dibawah binaan Kementerian Agama Republik Indonesia sedangkan SMU ada dibawah binaan Kementerian Pendidikan dan Kebudayaan. Waktu belajar dan Kurikulum Pendidikan MA sama dengan SMU yaitu ditempuh dalam waktu tiga tahun pelajaran. Nilai tambah MA, yaitu adanya pendidikan keagamaan yang lebih banyak dibandingkan di SMU. Karena itu, MAN 2 Kota Bandung, adalah SMU plus kegiatan Keislaman. Kegiatan Belajar Mengajar di MAN 2 Kota Bandung lima hari (Senin-Jum'at) dan hari Sabtu digunakan untuk kegiatan ekstrakurikuler. Madrasah ini, didirikan pada tahun 1991.</div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-lg-6 align-self-center">
                    <div class="video">
                        <a href="https://youtu.be/EqZiS4n9a3Q" target="_blank"><img src="<?= ASSETS . 'frontend' ?>/assets/images/play-icon.png" alt=""></a>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <section class="contact-us" id="contact">

        <div class="footer">
            <p>Copyright © 2025 MAN 2 KOTA BANDUNG. All Rights Reserved.
            </p>
        </div>
    </section>

    <!-- Scripts -->
    <!-- Bootstrap core JavaScript -->
    <script src="<?= ASSETS . 'frontend' ?>/vendor/jquery/jquery.min.js"></script>
    <script src="<?= ASSETS . 'frontend' ?>/vendor/bootstrap/js/bootstrap.bundle.min.js"></script>

    <script src="<?= ASSETS . 'frontend' ?>/assets/js/isotope.min.js"></script>
    <script src="<?= ASSETS . 'frontend' ?>/assets/js/owl-carousel.js"></script>
    <script src="<?= ASSETS . 'frontend' ?>/assets/js/lightbox.js"></script>
    <script src="<?= ASSETS . 'frontend' ?>/assets/js/tabs.js"></script>
    <script src="<?= ASSETS . 'frontend' ?>/assets/js/video.js"></script>
    <script src="<?= ASSETS . 'frontend' ?>/assets/js/slick-slider.js"></script>
    <script src="<?= ASSETS . 'frontend' ?>/assets/js/custom.js"></script>
    <script>
        //according to loftblog tut
        $('.nav li:first').addClass('active');

        var showSection = function showSection(section, isAnimate) {
            var
                direction = section.replace(/#/, ''),
                reqSection = $('.section').filter('[data-section="' + direction + '"]'),
                reqSectionPos = reqSection.offset().top - 0;

            if (isAnimate) {
                $('body, html').animate({
                        scrollTop: reqSectionPos
                    },
                    800);
            } else {
                $('body, html').scrollTop(reqSectionPos);
            }

        };

        var checkSection = function checkSection() {
            $('.section').each(function() {
                var
                    $this = $(this),
                    topEdge = $this.offset().top - 80,
                    bottomEdge = topEdge + $this.height(),
                    wScroll = $(window).scrollTop();
                if (topEdge < wScroll && bottomEdge > wScroll) {
                    var
                        currentId = $this.data('section'),
                        reqLink = $('a').filter('[href*=\\#' + currentId + ']');
                    reqLink.closest('li').addClass('active').
                    siblings().removeClass('active');
                }
            });
        };

        $('.main-menu, .responsive-menu, .scroll-to-section').on('click', 'a', function(e) {
            e.preventDefault();
            showSection($(this).attr('href'), true);
        });

        $(window).scroll(function() {
            checkSection();
        });
    </script>
</body>

</body>

</html>
