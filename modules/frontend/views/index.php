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
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css" integrity="sha512-DTOQO9RWCH3ppGqcWaEA1BIZOC6xxalwEsw9c2QQeAIftl+Vegovlnee1c9QX4TctnWMn13TZye+giMm8e2LwA==" crossorigin="anonymous" referrerpolicy="no-referrer" />
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
    <div class="bg-white text-gray-800  shadow-lg overflow-hidden relative flex w-full starring ">
        <div class="shadow-xl mb-3 absolute top-0 bg-gradient-to-b from-cyan-500 to-cyan-400 w-full z-10 flex px-5 py-2 text-center items-center">
            <img src="<?= ASSETS . 'images/logo-man2.png' ?>" class="w-7 mr-4">
            <p class="text-md font-bold text-white ">PPDB MAN 2 KOTA BANDUNG</p>
        </div>

        <div class="bg-white h-full w-full px-2 lg:px-10 pt-20 pb-20 overflow-y-auto">

            <!-- Modal -->
            <div id="imageModal" class="fixed inset-0 flex items-center justify-center bg-black bg-opacity-75 hidden z-20" onclick="closeModal(event)">
                <div class="relative bg-white rounded-lg overflow-hidden w-full max-w-xl mx-4 md:mx-0 md:h-[80%]">
                    <button class="absolute top-2 right-2 text-white" onclick="closeModal()">&times;</button>
                    <img id="modalImage" src="<?= ASSETS . 'images/info_kelulusan.jpg' ?>" alt="Full Image" class="object-fill h-full w-full">
                </div>
            </div>



            <div class="mb-5" id="pendaftaran">
                <div class="block rounded-lg relative p-5 transform transition-all duration-300 scale-100 hover:scale-95 shadow-xl" style="background: url(<?= ASSETS . 'images/bg.png' ?>) center; background-size: cover;">
                    <div class="absolute top-0 left-3 -mt-3 mr-3 ">
                        <div class="rounded-full bg-cyan-500 text-white text-xs py-1 pl-2 pr-3 leading-none shadow"><i class="mdi mdi-fire text-base align-middle"></i> <span class="align-middle">Pendaftaran
                                PPDB Tahun Ajaran 2024/2025</span>
                        </div>
                    </div>
                    <div class="h-15"></div>
                    <h2 class="text-white text-xl font-bold leading-tight mb-3 pr-5 mt-5"><?= $getButtonData->desc ?>
                    </h2>
                    <div class="flex w-full items-center text-sm text-gray-300 font-medium">


                        <?= $getButton ?>
                    </div>
                </div>
            </div>
            <div class="lg:flex mb-5 lg:space-x-3" id="agenda">
                <!-- Card 1 -->
                <div class="rounded-lg block w-full h-full transition-all duration-300 transform scale-100 hover:scale-105">
                    <div class="bg-white p-4 rounded-lg shadow-xl relative">
                        <h2 class="text-xl text-center font-bold mb-2 text-white py-2 relative overflow-hidden bg-gradient-to-r from-white via-cyan-500 to-white absolute inset-0">
                            Agenda PPDB
                        </h2>
                        <div class="w-full mt-4 relative aspect-w-16 aspect-h-9">
                            <img class="w-full h-full object-cover " src="<?= ASSETS . 'images/agenda_jalur-1.png' ?>" alt="Agenda Jalur 1">
                        </div>
                    </div>
                </div>

                <!-- Card 2 -->
                <div class="rounded-lg block w-full h-full transition-all duration-300 transform scale-100 hover:scale-105">
                    <div class="bg-white p-4 rounded-lg relative">
                        <h2 class="text-xl text-center font-bold mb-2 text-white py-2 relative overflow-hidden bg-gradient-to-r from-white via-cyan-500 to-white absolute inset-0">
                            Alur PPDB
                        </h2>
                        <div class="w-full mt-4 relative aspect-w-16 aspect-h-9">
                            <img class="w-full h-full object-cover " src="<?= ASSETS . 'images/alur-1.png' ?>" alt="Alur 1">
                        </div>
                    </div>
                </div>
            </div>


            <!-- <div class="mb-3">
                <h1 class="text-3xl font-bold">Yesterday</h1>
                <p class="text-sm text-gray-500 uppercase font-bold">WEDNESDAY 5 AUGUST</p>
            </div>
            <div class="flex -mx-1 mb-5">
                <div class="w-1/2 px-1">
                    <a href="#"
                        class="block mb-2 p-5 rounded overflow-hidden transform transition-all duration-300 scale-100 hover:scale-95"
                        style="background: url(https://images.unsplash.com/photo-1470225620780-dba8ba36b745?ixlib=rb-1.2.1&ixid=eyJhcHBfaWQiOjEyMDd9&auto=format&fit=crop&w=800&q=60) center; background-size: cover;">
                        <div class="h-24"></div>
                        <h3 class="text-lg font-bold text-white leading-tight">DJ Dan Spins The Wheels</h3>
                    </a>
                    <a href="#"
                        class="block mb-2 p-5 rounded overflow-hidden transform transition-all duration-300 scale-100 hover:scale-95"
                        style="background: url(https://images.unsplash.com/photo-1534329539061-64caeb388c42?ixlib=rb-1.2.1&ixid=eyJhcHBfaWQiOjEyMDd9&auto=format&fit=crop&w=800&q=60) center; background-size: cover;">
                        <div class="h-32"></div>
                        <h3 class="text-lg font-bold text-white leading-tight">Top Travels Destinations For 2020
                        </h3>
                    </a>
                </div>
                <div class="w-1/2 px-1">
                    <a href="#"
                        class="block mb-2 p-5 rounded overflow-hidden transform transition-all duration-300 scale-100 hover:scale-95"
                        style="background: url(https://images.unsplash.com/photo-1526661934280-676cef25bc9b?ixlib=rb-1.2.1&ixid=eyJhcHBfaWQiOjEyMDd9&auto=format&fit=crop&w=800&q=60) center; background-size: cover;">
                        <div class="h-32"></div>
                        <h3 class="text-lg font-bold text-white leading-tight">M&S Launches New Makeup Range!</h3>
                    </a>
                    <a href="#"
                        class="block mb-2 p-5 rounded overflow-hidden transform transition-all duration-300 scale-100 hover:scale-95"
                        style="background: url(https://images.unsplash.com/photo-1558365849-6ebd8b0454b2?ixlib=rb-1.2.1&ixid=eyJhcHBfaWQiOjEyMDd9&auto=format&fit=crop&w=800&q=60) center; background-size: cover;">
                        <div class="h-24"></div>
                        <h3 class="text-lg font-bold text-white leading-tight">APT Set To Be A&nbsp;Ripper</h3>
                    </a>
                </div>
            </div> -->
            <div class="mb-3" id="info">
                <h1 class="text-3xl font-bold">Info PPDB</h1>
            </div>
            <?php
            if ($getArticle > 0) {

                foreach ($getArticle as $row) { ?>


                    <div>
                        <a href="#" class="flex w-full transform transition-all duration-300 scale-100 hover:scale-95" onclick="articleDetail(<?= $row->id ?>)">
                            <div class=" block h-24 w-[25%] lg:w-[10%] rounded overflow-hidden" style="background: url(<?= ARTIKEL_PATH . $row->image ?>) center; background-size: cover;">
                            </div>
                            <div class="pl-3 w-[75%]">
                                <p class="text-xs text-gray-500 uppercase font-semibold">
                                    <?= date("d M Y", strtotime($row->created_time)) ?></p>
                                <h3 class="text-md font-semibold leading-tight mb-3"> <?= slice_string($row->content, 100) ?>
                                </h3>

                            </div>
                        </a>
                    </div>
                    <hr class="border-gray-200 my-3">


            <?php }
            } else {
                echo '<p class="text-gray-700 text-base"> Informasi belum tersedia
                        </p>';
            }  ?>

        </div>
        <div class="bg-gradient-to-b from-cyan-500 to-cyan-400 absolute bottom-0 w-full border-t border-gray-200 flex text-white  hover:text-indigo-100">
            <a href="#pendaftaran" class="flex flex-grow items-center justify-center p-2 ">
                <div class="text-center">
                    <span class="block h-8 text-2xl leading-8"><i class="fa fa-address-card"></i>
                    </span>
                    <span class="block text-xs leading-none">Pendaftaran</span>
                </div>
            </a>
            <a href="#agenda" class="flex flex-grow items-center justify-center p-2">
                <div class="text-center">
                    <span class="block h-8 text-2xl leading-8">
                        <i class="fa fa-calendar-days"></i>
                    </span>
                    <span class="block text-xs leading-none">Agenda & Alur PPDB</span>
                </div>
            </a>
            <a href="#info" class="flex flex-grow items-center justify-center p-2">
                <div class="text-center">
                    <span class="block h-8 text-2xl leading-8">
                        <i class="fa fa-newspaper"></i>
                    </span>
                    <span class="block text-xs leading-none">Info PPDB</span>
                </div>
            </a>
            <!-- <a href="#" class="flex flex-grow items-center justify-center p-2">
                <div class="text-center">
                    <span class="block h-8 text-3xl leading-8">
                        <i class="mdi mdi-magnify"></i>
                    </span>
                    <span class="block text-xs leading-none">Search</span>
                </div>
            </a> -->
        </div>
    </div>


</body>

</html>

<script src="https://cdn.jsdelivr.net/npm/swiper@9/swiper-bundle.min.js"></script>
<script src="<?= ASSETS_PATH . 'plugins/sweetalert2/sweetalert2.min.js' ?>"></script>
<script src="<?= ASSETS_PATH . 'plugins/jquery/jquery.min.js' ?>"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/js/all.min.js" integrity="sha512-GWzVrcGlo0TxTRvz9ttioyYJ+Wwk9Ck0G81D+eO63BaqHaJ3YZX9wuqjwgfcV/MrB2PhaVX9DkYVhbFpStnqpQ==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>

<script>
    $(document).ready(function() {
        $('#imageModal').removeClass('hidden').hide().fadeIn(500);
    });


    function closeModal(event) {
        if (event.target.id === 'imageModal' || event.target.tagName === 'BUTTON') {
            $('#imageModal').fadeOut(1000, function() {
                $(this).addClass('hidden');
            }); // 1 second animation duration
        }
    }
    var windowHeight = window.innerHeight;
    var elementPosition = document.querySelector(".starring").getBoundingClientRect().top;

    var elementHeightBelowWindow = windowHeight - elementPosition;
    document.querySelector(".starring").style.height = elementHeightBelowWindow + "px";


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

    // $(document).ready(function() {
    //     Swal.fire({
    //         title: 'INFORMASI',
    //         html: '<?= $infoPopup ?>',
    //         showConfirmButton: false
    //     })
    // })

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
