<!doctype html>
<html>

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <title>
        PPDB MAN 2 KOTA BANDUNG
    </title>
    <link rel="icon" type="image/x-icon" href="<?= ASSETS . 'images/logo-man2.png' ?>">

    <script src="https://cdn.tailwindcss.com"></script>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/swiper@9/swiper-bundle.min.css" />
    <link rel="stylesheet" href="<?= ASSETS_PATH . 'plugins/sweetalert2/sweetalert2.min.css' ?>" />

    <style>
    html,
    body {
        position: relative;
        height: 100%;
    }

    body {
        background: #eee;
        font-family: Helvetica Neue, Helvetica, Arial, sans-serif;
        font-size: 14px;
        color: #000;
        margin: 0;
        padding: 0;
    }

    .swiper {
        width: 100%;
        height: 100%;
    }

    .swiper-slide {
        text-align: center;
        font-size: 18px;
        /* background: #fff; */
        display: flex;
        justify-content: center;
        align-items: center;
    }
    </style>
</head>

<body class="bg-white">
    <header class="text-gray-600 body-font">
        <div
            class=" mx-auto flex flex-wrap p-5 flex-col md:flex-row items-center bg-indigo-500 text-white px-[4rem] lg:px-[10rem] ">
            <marquee> <?= $infoHeader ?> </marquee>
        </div>
        <div class="container mx-auto flex flex-wrap p-5 flex-col md:flex-row px-[4rem]  shadow-md">
            <a
                class="flex order-first lg:order-none lg:w-2/1 title-font font-medium items-center text-gray-900 lg:items-center lg:justify-center mb-4 md:mb-0">
                <img src="<?= ASSETS . 'images/logo-man2.png' ?>" class="w-7">
                <p class="ml-3 text-xl">
                    Pendaftaran Peserta Didik Baru<br> <span class="text-sm text-gray-600 -mt-10">MAN 2 KOTA
                        BANDUNG</span>
                </p>
            </a>
            <nav class="flex lg:w-1/5 flex-wrap items-center text-base md:ml-auto">
            </nav>

            <div class="lg:w-2/5 inline-flex lg:justify-end ml-5 lg:ml-0">
                <a class="inline-flex items-center bg-indigo-500 border-0 py-1 px-3 focus:outline-none hover:bg-indigo-900  rounded text-base mt-4 md:mt-0 text-white"
                    href="#pendaftaran">Pendaftaran
                    <svg fill="none" stroke="currentColor" stroke-linecap="round" stroke-linejoin="round"
                        stroke-width="2" class="w-4 h-4 ml-1" viewBox="0 0 24 24">
                        <path d="M5 12h14M12 5l7 7-7 7"></path>
                    </svg>
                </a>
            </div>
        </div>
    </header>
    <main class="px-[10px] lg:px-[10rem] xxl:px-[32rem] py-5"
        style="background: rgb(247,247,247);
background: linear-gradient(0deg, rgba(247,247,247,1) 0%, rgba(251,251,251,1) 11%, rgba(252,255,255,1) 16%, rgba(237,254,255,1) 24%, rgba(226,250,255,1) 60%, rgba(190,241,254,1) 95%, rgba(190,241,254,1) 99%, rgba(200,200,200,1) 100%);">
        <section>
            <div class="swiper mySwiper shadow-md rounded-lg ">
                <div class="swiper-wrapper h-[25rem] bg-cover">
                    <?php foreach($getSlider as $row){ ?>
                    <div class="swiper-slide"><img class="w-full" src="<?= ASSETS . 'uploads/slider/' . $row->image ?>">
                    </div>
                    <?php } ?>
                </div>
                <div class="swiper-button-next"></div>
                <div class="swiper-button-prev"></div>
                <div class="swiper-pagination"></div>
            </div>
        </section>

        <section class="text-gray-600 body-font" id="pendaftaran">
            <div class="container py-24 mx-auto flex flex-wrap">
                <div class="container pb-24 mx-auto flex flex-wrap">
                    <h2 class="w-full sm:text-3xl text-2xl text-gray-900 font-medium title-font mb-2 md:w-2/5">
                        Pendaftaran</h2>
                    <div class="md:w-3/5 md:pl-6 w-full">
                        <p class="leading-relaxed text-base"><?= $getButtonData->desc ?></p>
                        <div class="flex md:mt-4 mt-6">
                            <?= $getButton ?>

                        </div>
                    </div>
                </div>
                <div class="flex flex-wrap ">
                    <div class="flex flex-wrap ">
                        <div class="md:p-2 p-1 lg:w-1/2 h-[15rem] cursor-pointer hover:scale-105"
                            onclick="showImagePub('syarat')">
                            <img alt="gallery" class="w-full bg-cover h-full object-center block rounded-lg shadow-md"
                                src="<?= ASSETS . 'images/syarat.png' ?>">
                        </div>
                        <div class="md:p-2 p-1 lg:w-1/2 h-[15rem] cursor-pointer hover:scale-105"
                            onclick="showImagePub('alur')">
                            <img alt="gallery" class="w-full bg-cover h-full object-center block rounded-lg shadow-md"
                                src="<?= ASSETS . 'images/alur.png' ?>">
                        </div>
                        <div class="md:p-2 p-1 w-full h-[15rem] cursor-pointer hover:scale-105"
                            onclick="showImagePub('agenda')">
                            <img alt="gallery"
                                class="w-full h-full lg:bg-cover object-center block rounded-lg shadow-md"
                                src="<?= ASSETS . 'images/agenda.png' ?>">
                        </div>
                    </div>
                </div>
            </div>
        </section>

        <section class="text-black body-font bg-white shadow-2xl px-10 py-10">
            <p class="font-medium text-2xl title-font text-gray-900 border-b ">Informasi Seputar PPDB</p>

            <div class="py-5">
                <!--Card 1-->
                <div class=" w-full lg:max-w-full lg:flex">

                    <div class="bg-white rounded-b  p-4 flex flex-col justify-between leading-normal">

                        <?php
if($getArticle > 0){

                            foreach($getArticle as $row) { ?>
                        <div class="pb-5 cursor-pointer" onclick="articleDetail(<?= $row->id ?>)">
                            <div class="text-indigo-700 hover:text-indigo-900 font-bold text-xl "><?= $row->title ?>
                            </div>
                            <p class="text-sm text-gray-600 flex items-center mb-2">
                                <?=  date("d M Y",strtotime($row->created_time)) ?>
                            </p>
                            <p class="text-gray-700 text-base">
                                <?= slice_string($row->content,100) ?>
                            </p>

                        </div>


                        <?php }
                        }else {
                            echo '<p class="text-gray-700 text-base"> Informasi belum tersedia
                        </p>';
                        }  ?>
                    </div>
                </div>
            </div>
        </section>

        <section class="text-gray-600 body-font relative  my-[5rem] shadow-md">
            <div class="container mx-auto flex sm:flex-nowrap flex-wrap bg-white rounded-lg">

                <div
                    class="lg:w-full h-[30rem] bg-gray-300  overflow-hidden  p-10 flex items-end justify-start relative">
                    <iframe width="100%" height="100%" class="absolute inset-0" frameborder="0" title="map"
                        marginheight="0" marginwidth="0" scrolling="no" src="<?= $getContact->maps ?>"
                        style="filter: grayscale(1) contrast(1.2) opacity(0.4);"></iframe>
                    <div class="bg-white relative flex flex-wrap py-6 rounded shadow-md">
                        <div class="lg:w-full px-6 pb-5">
                            <h2 class="title-font font-semibold text-gray-900 tracking-widest text-xs">ADDRESS</h2>
                            <p class="mt-1"><?= $getContact->address ?></p>
                        </div>
                        <div class="lg:w-full px-6 mt-4 lg:mt-0">
                            <h2 class="title-font font-semibold text-gray-900 tracking-widest text-xs">EMAIL</h2>
                            <a class="text-indigo-500 leading-relaxed"><?= $getContact->email ?></a>
                            <h2 class="title-font font-semibold text-gray-900 tracking-widest text-xs mt-4">PHONE</h2>
                            <p class="leading-relaxed"><?= $getContact->phone ?></p>
                        </div>
                    </div>
                </div>
            </div>
        </section>
    </main>
    <footer class="text-gray-600 body-font">
        <div class="container px-5 py-8 mx-auto flex items-center sm:flex-row flex-col">
            <a class="flex title-font font-medium items-center md:justify-start justify-center text-gray-900">
                <img src="<?= ASSETS . 'images/logo-man2.png' ?>" class="w-7">
                <span class="ml-3 text-xl">MAN 2 KOTA BANDUNG</span>
            </a>

            <span class="inline-flex sm:ml-auto sm:mt-0 mt-4 justify-center sm:justify-start">

                <p class="text-sm text-gray-500 sm:ml-4 sm:pl-4 sm:border-l-2 sm:border-gray-200 sm:py-2 sm:mt-0 mt-4">©
                    2023 MAN 2 KOTA BANDUNG —
                    <a href="https://luthfirahmn.github.io/portfolio/" class="text-gray-600 ml-1"
                        rel="noopener noreferrer" target="_blank">Luthfirahmn</a>
                </p>
            </span>
        </div>
    </footer>
</body>

</html>

<script src="https://cdn.jsdelivr.net/npm/swiper@9/swiper-bundle.min.js"></script>
<script src="<?= ASSETS_PATH . 'plugins/sweetalert2/sweetalert2.min.js' ?>"></script>
<script src="<?= ASSETS_PATH . 'plugins/jquery/jquery.min.js' ?>"></script>

<script>
var swiper = new Swiper(".mySwiper", {
    spaceBetween: 30,
    centeredSlides: true,
    autoplay: {
        delay: 2500,
        disableOnInteraction: false,
    },
    pagination: {
        el: ".swiper-pagination",
        clickable: true,
    },
    navigation: {
        nextEl: ".swiper-button-next",
        prevEl: ".swiper-button-prev",
    },
});

document.querySelectorAll('a[href^="#"]').forEach(anchor => {
    anchor.addEventListener('click', function(e) {
        e.preventDefault();

        document.querySelector(this.getAttribute('href')).scrollIntoView({
            behavior: 'smooth'
        });
    });
});

$(document).ready(function() {
    Swal.fire({
        title: 'INFORMASI',
        html: '<?= $infoPopup ?>',
        showConfirmButton: false
    })
})

function articleDetail(id) {
    $.ajax({
        url: "<?php echo base_url('frontend/getArticleDetail/') ?>" + id,
        type: "GET",
        dataType: "JSON",
        success: function(data) {
            Swal.fire({
                title: data.data.title,
                text: data.data.content,
                imageUrl: '<?= ARTIKEL_PATH ?>' + data.data.image,
                imageWidth: 400,
                imageHeight: 200,
                width: 700,
                confirmButtonText: "Kembali"
            })
        }
    })
}

function showImagePub(param) {
    switch (param) {
        case 'syarat':
            var image = '<?= ASSETS . 'images/syarat_image.png' ?>'
            break;
        case 'agenda':
            var image = '<?= ASSETS . 'images/agenda_image.png' ?>'
            break;
        case 'alur':
            var image = '<?= ASSETS . 'images/alur_image.png' ?>'
            break;
    }
    var imageSyarat = '<?= ASSETS . 'images/syarat_image.png' ?>'
    Swal.fire({
        imageUrl: image,
        imageHeight: 800,
        width: 700,
    })
}

$(document).bind("contextmenu", function(e) {
    e.preventDefault();
});

$(document).keydown(function(e) {
    if (e.which === 123) {
        return false;
    }
});
</script>
