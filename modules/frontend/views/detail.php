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
                            <li><a href="<?= BASE_URL . 'frontend' ?>" class="active">Pendaftaran</a></li>
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

    <section class="meetings-page" id="meetings">
        <div class="container">
            <div class="row">
                <div class="col-lg-12">
                    <div class="row">
                        <div class="col-lg-12">
                            <div class="meeting-single-item">
                                <div class="thumb">
                                    <div class="date">
                                        <h6><?= date('M', strtotime($created_time)) ?> <span><?= date('d', strtotime($created_time)) ?></h6>
                                    </div>
                                    <img src="<?= ARTIKEL_PATH . $image ?>" alt="">
                                </div>
                                <div class="down-content">
                                    <a href="#">
                                        <h4><?= html_escape($title) ?></h4>
                                    </a>
                                    <p class="description">
                                        <?= html_escape($content) ?>
                                    </p>
                                </div>
                            </div>
                        </div>
                        <div class="col-lg-12">
                            <div class="main-button-red">
                                <a href="<?= BASE_URL . 'frontend' ?>">Kembali</a>
                            </div>
                        </div>
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
