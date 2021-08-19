<!doctype html>
<html lang="id">

<head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.5.0/font/bootstrap-icons.css">
    <link rel="stylesheet"
        href="https://cdn.jsdelivr.net/npm/bootstrap-select@1.14.0-beta2/dist/css/bootstrap-select.min.css">

    
    <link rel="stylesheet" href="//code.jquery.com/ui/1.12.1/themes/base/jquery-ui.css">

    
    <link rel="stylesheet" href="<?php echo e(asset('swal/sweetalert2.min.css')); ?>">

    
    <link rel="stylesheet" href="<?php echo e(asset('parsley/css/parsley.css')); ?>">

    <!-- the fileinput plugin styling CSS file -->
    <link href="https://cdn.jsdelivr.net/gh/kartik-v/bootstrap-fileinput@5.2.2/css/fileinput.min.css" media="all"
        rel="stylesheet" type="text/css" />

    <link rel="stylesheet" href="<?php echo e(asset('admin/css/main-user.css')); ?>">
    <link rel="stylesheet" href="<?php echo e(asset('admin/css/teks.css')); ?>">
    <link rel="stylesheet" href="<?php echo e(asset('admin/css/warna.css')); ?>">

    <script src="https://code.jquery.com/jquery-3.5.1.js"></script>
    <script src="https://code.jquery.com/ui/1.12.1/jquery-ui.js"></script>
    <script src="<?php echo e(asset('admin/js/datepicker-id.js')); ?>"></script>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous">
    </script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap-select@1.14.0-beta2/dist/js/bootstrap-select.min.js"></script>

    <!-- kartik -->
    <script src="https://cdn.jsdelivr.net/gh/kartik-v/bootstrap-fileinput@5.2.2/js/plugins/piexif.min.js"
        type="text/javascript"></script>
    <script src="https://cdn.jsdelivr.net/gh/kartik-v/bootstrap-fileinput@5.2.2/js/plugins/sortable.min.js"
        type="text/javascript"></script>
    <script src="https://cdn.jsdelivr.net/gh/kartik-v/bootstrap-fileinput@5.2.2/js/fileinput.min.js"></script>
    <script src="https://cdn.jsdelivr.net/gh/kartik-v/bootstrap-fileinput@5.2.2/js/locales/id.js"></script>

    <script src="<?php echo e(asset('parsley/js/parsley.min.js')); ?>"></script>
    <script src="<?php echo e(asset('parsley/js/id.js')); ?>"></script>
    <script src="<?php echo e(asset('swal/sweetalert2.min.js')); ?>"></script>

    <script>
        document.addEventListener("DOMContentLoaded", function () {
            /////// Prevent closing from click inside dropdown
            document.querySelectorAll('.dropdown-menu').forEach(function (element) {
                element.addEventListener('click', function (e) {
                    e.stopPropagation();
                });
            })
        });

        document.addEventListener("DOMContentLoaded", function () {
            var elements = document.getElementsByTagName("INPUT");
            for (var i = 0; i < elements.length; i++) {
                elements[i].oninvalid = function (e) {
                    e.target.setCustomValidity("");
                    if (!e.target.validity.valid) {
                        e.target.setCustomValidity("Kolom ini tidak boleh kosong.");
                    }
                };
                elements[i].oninput = function (e) {
                    e.target.setCustomValidity("");
                };
            }
        })

        function getSwalLoading(aksi, judul, isi) {
            if (aksi == 1) {
                Swal.fire({
                    title: judul,
                    html: `<p class="font-20">${isi}</p>`,
                    allowOutsideClick: false,
                    didOpen: () => {
                        Swal.showLoading()
                    }
                })
            } else if (aksi == 0) {
                Swal.DismissReason.close
                Swal.DismissReason.timer
                Swal.close()
            }
        }

    </script>

    <style>
        .bg-overlay {
            background: linear-gradient(rgba(0, 0, 0, .5), rgba(0, 0, 0, .5)),
            url("<?php echo e(asset('img/background-2.jpg')); ?>");
            background-repeat: unset;
            background-size: cover;
            background-position: center center;
            height: auto;
            padding-top: 50px;
        }

    </style>

    <title>Desaku - Forum Diskusi</title>
</head>

<body class="bg-overlay">
    <nav class="navbar navbar-expand-lg navbar-light bg-transparent fixed-top">
        <div class="container-fluid" style="padding : 4px 40px">
            <a class="navbar-brand" href="#">
                <img id="img-logo-desa" src="<?php echo e(asset('img/desacuss-putih.png')); ?>"
                    class="d-inline-block align-text-top ">
            </a>
            <button class="navbar-toggler bg-white" type="button" data-bs-toggle="collapse"
                data-bs-target="#navbarTogglerDemo01" aria-controls="navbarTogglerDemo01" aria-expanded="false"
                aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarTogglerDemo01">
                <ul class="navbar-nav me-auto my-2 my-lg-0 navbar-nav-scroll" style="--bs-scroll-height: 100px;">
                    <li class="nav-item dropdown has-megamenu">
                        <a class="nav-link putih-responsip underhoper-caang font-16 teks-tebal" href="#"
                            data-bs-toggle="dropdown">
                            <i class="bi bi-app-indicator"></i>&nbsp;Produk Desaku</a>
                        <div class="dropdown-menu fade-down megamenu ms-auto me-auto" role="menu">
                            <div class="row g-3">
                                <div class="col-lg-4 col-6">
                                    <div class="col-megamenu">
                                        <a class="dropdown-item teman-desaku" href="http://desaku-desanews.masuk.id/">
                                            <img class="zoom-logo mt-1" src="<?php echo e(asset('img/desanews.png')); ?>">
                                            <br>
                                            <small style="white-space: normal!important;">Berita dan kegiatan desa
                                                terkini dan terupdate di DesaNews!</small>
                                        </a>
                                    </div>
                                </div>
                                <div class="col-lg-4 col-6">
                                    <div class="col-megamenu">
                                        <a class="dropdown-item teman-desaku" href="http://desaku-desafeed.masuk.id/">
                                            <img class="zoom-logo" src="<?php echo e(asset('img/desafeed.png')); ?>">
                                            <br>
                                            <small style="white-space: normal!important;">Berbagi pengalaman pribadi,
                                                foto dan video berbagai warga desa di DesaFeed!</small>
                                        </a>
                                    </div>
                                </div>
                                <div class="col-lg-4 col-6">
                                    <div class="col-megamenu">
                                        <a class="dropdown-item teman-desaku" href="http://desaku-desatour.masuk.id/">
                                            <img class="zoom-logo" src="<?php echo e(asset('img/desatour.png')); ?>">
                                            <br>
                                            <small style="white-space: normal!important;">Jelajahi wisata, kuliner,
                                                penginapan, dan infrastruktur desa di DesaTour!</small>
                                        </a>
                                    </div>
                                </div>
                                <div class="col-lg-4 col-6">
                                    <div class="col-megamenu">
                                        <a class="dropdown-item teman-desaku"
                                            href="http://desaku-desafeed.masuk.id/social-media">
                                            <img class="zoom-logo" src="<?php echo e(asset('img/desatube.png')); ?>">
                                            <br>
                                            <small style="white-space: normal!important;">Publish video tentang desa,
                                                kegiatan desa dan cerita desa di DesaTube!</small>
                                        </a>
                                    </div>
                                </div>
                                <div class="col-lg-4 col-6">
                                    <div class="col-megamenu">
                                        <a class="dropdown-item teman-desaku"
                                            href="http://marketpalcedesaku.masuk.web.id/">
                                            <img class="zoom-logo" src="<?php echo e(asset('img/desastore.png')); ?>">
                                            <br>
                                            <small style="white-space: normal!important;">Berbagai produk desa yang
                                                dapat di Jual dan di Beli di DesaStore!</small>
                                        </a>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </li>
                </ul>
                <ul class="navbar-nav ms-auto">
                    <?php if(auth()->guard()->guest()): ?>
                    <li class="nav-item me-4">
                        <a class="nav-link putih-responsip underhoper-caang font-16 teks-tebal"
                            href="<?php echo e(route('login')); ?>">
                            <i class="bi bi-box-arrow-in-right"></i> <?php echo e(__('Login')); ?>

                        </a>
                    </li>
                    <?php if(Route::has('register')): ?>
                    <li class="nav-item">
                        <a class="nav-link putih-responsip underhoper-caang font-16 teks-tebal"
                            href="<?php echo e(route('register')); ?>">
                            <i class="bi bi-person-plus"></i> <?php echo e(__('Daftar')); ?>

                        </a>
                    </li>
                    <?php endif; ?>
                    <?php else: ?>
                    <li class="nav-item dropdown">
                        <a id="navbarDropdown" class="nav-link dropdown-toggle" href="#" role="button"
                            data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" v-pre>
                            <?php echo e(Auth::user()->name); ?>

                        </a>

                        <div class="dropdown-menu dropdown-menu-right" aria-labelledby="navbarDropdown">
                            <a class="dropdown-item" href="<?php echo e(route('logout')); ?>" onclick="event.preventDefault();
                                             document.getElementById('logout-form').submit();">
                                <?php echo e(__('Logout')); ?>

                            </a>

                            <form id="logout-form" action="<?php echo e(route('logout')); ?>" method="POST" class="d-none">
                                <?php echo csrf_field(); ?>
                            </form>
                        </div>
                    </li>
                    <?php endif; ?>

                </ul>
            </div>
        </div>
    </nav>

    <div class="bottomright text-muted font-12">
        Image by <a
            href="https://pixabay.com/users/joaocampanholo-5932502/?utm_source=link-attribution&amp;utm_medium=referral&amp;utm_campaign=image&amp;utm_content=4766274">João
            Campanholo Campanholo</a> from <a
            href="https://pixabay.com/?utm_source=link-attribution&amp;utm_medium=referral&amp;utm_campaign=image&amp;utm_content=4766274">Pixabay</a>
    </div>


    <?php echo $__env->yieldContent('konten'); ?>


    <footer class="footer bg-transparent fixed-bottom">
        <div class="container">
            <div class="copyright float-right " style="color: white;">
                &copy;Desaku <?php echo e(tahun_sekarang()); ?>, dibuat dengan penuh <i class="bi bi-heart-fill merah"></i> oleh
                <a href="<?php echo e(route('team')); ?>">Tim
                    Desaku</a> untuk Indonesia
                lebih maju.
            </div>
        </div>
    </footer>



</body>


<?php echo $__env->make('layouts.registerjs', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>

</html>
<?php /**PATH C:\xampp\htdocs\desacuss_new\resources\views/layouts/master.blade.php ENDPATH**/ ?>