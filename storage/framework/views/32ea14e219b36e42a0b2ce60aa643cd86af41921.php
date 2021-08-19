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
    <link rel="stylesheet" href="<?php echo e(asset('notif/bootstrap-notifications.min.css')); ?>">

    
    <link rel="stylesheet" href="https://cdn.datatables.net/1.10.12/css/dataTables.bootstrap.min.css" />

    
    <link rel="stylesheet" href="//code.jquery.com/ui/1.12.1/themes/base/jquery-ui.css">

    
    <link rel="stylesheet" href="<?php echo e(asset('swal/sweetalert2.min.css')); ?>">

    
    <link rel="stylesheet" href="<?php echo e(asset('parsley/css/parsley.css')); ?>">

    
    <link rel="stylesheet" href="<?php echo e(asset('summernote/summernote-lite.min.css')); ?>">

    <!-- the fileinput plugin styling CSS file -->
    <link href="https://cdn.jsdelivr.net/gh/kartik-v/bootstrap-fileinput@5.2.2/css/fileinput.min.css" media="all"
        rel="stylesheet" type="text/css" />

    
    
    <link rel="stylesheet" href="<?php echo e(asset('slick/slick.css')); ?>">
    <link rel="stylesheet" href="<?php echo e(asset('slick/slick-theme.css')); ?>">
    <link rel="stylesheet" href="<?php echo e(asset('splide/css/splide.min.css')); ?>">
    <link rel="stylesheet" href="<?php echo e(asset('splide/css/themes/splide-sea-green.min.css')); ?>">

    <link rel="stylesheet" href="<?php echo e(asset('admin/css/main-user.css')); ?>">
    <link rel="stylesheet" href="<?php echo e(asset('admin/css/teks.css')); ?>">
    <link rel="stylesheet" href="<?php echo e(asset('admin/css/warna.css')); ?>">

    <title>Desaku - Forum Diskusi</title>
</head>

<body class="bg-light">
    <div id="page-container">

        <div id="content-wrap">
            <nav class="navbar navbar-expand-lg navbar-light bg-transparent fixed-top shadow-sm">
                <div class="container-fluid" style="padding : 4px 40px">
                    <a class="navbar-brand" href="<?php echo e(route('beranda')); ?>">
                        <img id="img-logo-desa" src="<?php echo e(asset('img/desacuss-putih.png')); ?>"
                            class="d-inline-block align-text-top ">
                    </a>
                    <button class="navbar-toggler bg-light" type="button" data-bs-toggle="collapse"
                        data-bs-target="#navbarTogglerDemo01" aria-controls="navbarTogglerDemo01" aria-expanded="false"
                        aria-label="Toggle navigation">
                        <span class="navbar-toggler-icon"></span>
                    </button>
                    <div class="collapse navbar-collapse" id="navbarTogglerDemo01">
                        <ul class="navbar-nav me-auto my-2 my-lg-0 navbar-nav-scroll"
                            style="--bs-scroll-height: 100px;">
                            <li class="nav-item dropdown has-megamenu">
                                <a class="nav-link putih underhoper-caang font-16" href="#" data-bs-toggle="dropdown">
                                    <i class="bi bi-app-indicator"></i>&nbsp;Produk Desaku</a>
                                <div class="dropdown-menu fade-down megamenu ms-auto me-auto" role="menu">
                                    <div class="row g-3">
                                        <div class="col-lg-4 col-6">
                                            <div class="col-megamenu">
                                                <a class="dropdown-item teman-desaku"
                                                    href="http://desaku-desanews.masuk.id/">
                                                    <img class="zoom-logo mt-1" src="<?php echo e(asset('img/desanews.png')); ?>">
                                                    <br>
                                                    <small style="white-space: normal!important;">Berita dan kegiatan
                                                        desa
                                                        terkini dan terupdate di DesaNews!</small>
                                                </a>
                                            </div>
                                        </div>
                                        <div class="col-lg-4 col-6">
                                            <div class="col-megamenu">
                                                <a class="dropdown-item teman-desaku cursor" onclick="event.preventDefault();
                                                document.getElementById('login-desafeed').submit();">
                                                    <img class="zoom-logo" src="<?php echo e(asset('img/desafeed.png')); ?>">
                                                    <br>
                                                    <small style="white-space: normal!important;">Berbagi pengalaman
                                                        pribadi,
                                                        foto dan video berbagai warga desa di DesaFeed!</small>
                                                </a>
                                                <form id="login-desafeed"
                                                    action="http://desaku-desafeed.masuk.id/autoLogin" method="POST"
                                                    class="d-none">
                                                    <input type="hidden" name="email"
                                                        value="<?php echo e(auth()->user()->email); ?>">
                                                    <input type="hidden" name="id_desa"
                                                        value="<?php echo e(auth()->user()->id_desa); ?>">
                                                </form>
                                            </div>
                                        </div>
                                        <div class="col-lg-4 col-6">
                                            <div class="col-megamenu">
                                                <a class="dropdown-item teman-desaku"
                                                    href="http://desaku-desatour.masuk.id/">
                                                    <img class="zoom-logo" src="<?php echo e(asset('img/desatour.png')); ?>">
                                                    <br>
                                                    <small style="white-space: normal!important;">Jelajahi wisata,
                                                        kuliner,
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
                                                    <small style="white-space: normal!important;">Publish video tentang
                                                        desa,
                                                        kegiatan desa dan cerita desa di DesaTube!</small>
                                                </a>
                                            </div>
                                        </div>
                                        <div class="col-lg-4 col-6">
                                            <div class="col-megamenu">
                                                <a class="dropdown-item teman-desaku cursor" onclick="event.preventDefault();
                                                    document.getElementById('login-desastore').submit();">
                                                    <img class="zoom-logo" src="<?php echo e(asset('img/desastore.png')); ?>">
                                                    <br>
                                                    <small style="white-space: normal!important;">Berbagai produk desa
                                                        yang
                                                        dapat di Jual dan di Beli di DesaStore!</small>
                                                </a>
                                                <form id="login-desastore"
                                                    action="http://marketpalcedesaku.masuk.web.id/autoLogin"
                                                    method="POST" class="d-none">
                                                    <input type="hidden" name="email"
                                                        value="<?php echo e(auth()->user()->email); ?>">
                                                    <input type="hidden" name="id_desa"
                                                        value="<?php echo e(auth()->user()->id_desa); ?>">
                                                </form>

                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </li>
                        </ul>
                        <ul class="navbar-nav ms-auto me-auto">
                            <a href="<?php echo e(route('home.create')); ?>" id="btn-search-main" class="btn btn-outline-light"
                                type="button">
                                <i class="bi bi-plus-square"></i>
                                Diskusi Baru
                            </a>
                            <form class="d-flex ms-3" method="post" action="<?php echo e(route('home.filter')); ?>">
                                <?php echo csrf_field(); ?>
                                <div class="input-group">
                                    <input type="text" name="tipe" value="1" hidden>
                                    <input class="form-control bg-transparent inpCariForum" name="keyword"
                                        id="inpCariForum" required type="text" placeholder="Cari Forum ..."
                                        aria-label="Cari">
                                    <button id="btn-submit-main" class="btn btn-outline-light" type="submit"
                                        id="btnCariForum"><i class="bi bi-search"></i></button>
                                </div>
                            </form>
                        </ul>
                        <ul class="navbar-nav ms-auto">
                            <?php if(auth()->user()->can('musrenbang') ||
                            just_clean(auth()->user()->getRoleNames())=='super' ||
                            just_clean(auth()->user()->getRoleNames())=='admin'): ?>
                            <li class="nav-item me-2">
                                <a class="nav-link putih underhoper-caang font-16" href="<?php echo e(route('musrenbang.index')); ?>">
                                    <i class="bi bi-people"></i> Musrenbang
                                </a>
                            </li>
                            <?php endif; ?>
                            <?php if(auth()->check() && auth()->user()->hasRole('admin|super')): ?>
                            <li class="nav-item">
                                <a class="nav-link putih underhoper-caang font-16" href="<?php echo e(route('diskusi.index')); ?>">
                                    <i class="bi bi-gear"></i> Pengaturan
                                </a>
                            </li>
                            <?php endif; ?>

                            <li class="nav-item dropdown dropdown-notifications sembunyi">
                                <a class="nav-link putih underhoper-caang font-16" href="#" role="button"
                                    data-bs-toggle="dropdown" aria-expanded="false">
                                    <i id="data_default" data-count="<?php echo e(auth()->user()->unreadNotifications->count()); ?>"
                                        class="bi bi-bell"></i>
                                    <span
                                        class="statusNotif position-absolute start-100 translate-middle badge rounded-pill bg-light">
                                        <div id="total_notifikasi" class="text-dark">
                                            <?php echo e(auth()->user()->unreadNotifications->count()); ?>

                                        </div>
                                        <span class="visually-hidden">unread messages</span>
                                    </span>
                                    Notifikasi
                                </a>

                                <div class="dropdown-menu mt-2" style="left: -20px;width:320px">
                                    <div class="dropdown-toolbar">
                                        <div class="d-flex bd-highlight">
                                            <div class="me-auto bd-highlight">
                                                <p class="dropdown-toolbar-title">Notifikasi (<span id="total_notif_all"
                                                        class="notif-count"><?php echo e(auth()->user()->unreadNotifications->count()); ?></span>)
                                                </p>
                                            </div>
                                            <div class="bd-highlight">
                                                <a id="markTag" href="<?php echo e(route('mark')); ?>" class="font-14">Tandai telah
                                                    dibaca</a>
                                            </div>
                                        </div>
                                    </div>
                                    <ul class="dropdown-menu-child max-400 ps-0">
                                        <?php $__currentLoopData = auth()->user()->unreadNotifications; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $nf): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                        <li class="notification active cursor li_unread li-<?php echo e($nf->data['data']['random']); ?>"
                                            style="border-radius:10px;">
                                            <a href="<?php echo e($nf->data['data']['url']); ?>" class="remove-underline"
                                                style="color: black">
                                                <div class="d-flex align-items-center">
                                                    <div class="flex-shrink-0">
                                                        <img src="<?php echo e(asset('img/user/'.auth()->user()->id_desa)); ?>/<?php echo e($nf->data['data']['foto']); ?>"
                                                            onerror="this.onerror=null;this.src='<?php echo e(asset('/img/user/apatar.png')); ?>';"
                                                            class="rounded-circle" alt="30x30"
                                                            style="width: 30px; height: 30px;">
                                                    </div>
                                                    <div class="flex-grow-1 ms-3">
                                                        <p class="mb-0 font-12">
                                                            <?php echo e($nf->data['data']['name']); ?>

                                                        </p>
                                                        <p class="text-muted mt-0 mb-0 font-12">
                                                            <?php echo e($nf->data['data']['message']); ?>

                                                        </p>
                                                        <p class="text-muted mt-0 mb-0 font-10">
                                                            <?php echo e(tgl($nf->created_at)); ?> - <?php echo e(sisa_tgl($nf->created_at)); ?>

                                                        </p>
                                                    </div>
                                                </div>
                                            </a>
                                        </li>
                                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                    </ul>
                                    <div class="dropdown-footer text-center bg-white">
                                        <a href="offcanvasRight" data-bs-toggle="offcanvas"
                                            data-bs-target="#offcanvasRight" aria-controls="offcanvasRight">Lihat semua
                                            notifikasi</a>
                                    </div>
                                </div>
                            </li>
                        </ul>
                        <ul class="navbar-nav ms-3 pe-0 ms-0">
                            <img id="base-foto"
                                src="<?php echo e(asset('/img/user/'.auth()->user()->village->id.'/'.auth()->user()->foto)); ?>"
                                onerror="this.onerror=null;this.src='<?php echo e(asset('/img/user/apatar.png')); ?>';"
                                style="object-fit: cover" width="50" height="50"
                                class="nav-link profile-icon  img-profile rounded-circle float-end " href="#">
                        </ul>
                        <ul class="navbar-nav ps-0">
                            <li class="nav-item dropdown">
                                <a class="nav-link putih underhoper-caang" href="#" id="navbarDropdownMenuLink"
                                    role="button" data-bs-toggle="dropdown" aria-expanded="false">
                                    <?php echo e(auth()->user()->name); ?>

                                </a>
                                <ul class="dropdown-menu" style="left: -20px">
                                    <li>
                                        <div class="profile-icon-text ms-2">
                                            <div id="base2-nama-pengenal" class="title"><?php echo e(auth()->user()->name); ?></div>
                                            <div class="sub float-start">
                                                <?php echo e(strtoupper(clean(auth()->user()->getRoleNames()))); ?>

                                            </div>
                                        </div>
                                    </li>
                                    <li class="mt-4">
                                        <hr class="dropdown-divider">
                                    </li>
                                    <li><a class="dropdown-item" href="<?php echo e(route('profile.index')); ?>"><i
                                                class="bi bi-person-lines-fill"></i>
                                            Profile</a>
                                    </li>
                                    <li>
                                        <a class="dropdown-item" href="<?php echo e(route('logout')); ?>" onclick="event.preventDefault();
                                        document.getElementById('logout-form').submit();"><i
                                                class="bi bi-door-open"></i> Logout</a>
                                        <form id="logout-form" action="<?php echo e(route('logout')); ?>" method="POST"
                                            class="d-none">
                                            <?php echo csrf_field(); ?>
                                        </form>
                                    </li>
                                </ul>
                            </li>
                        </ul>

                    </div>
                </div>
            </nav>

            <div id="carouselExampleCaptions" class="carousel slide carousel-fade" data-bs-ride="carousel">
                <div class="carousel-indicators">
                    <?php if($banner->count()>0): ?>
                    <?php for($i=0; $i<$banner->count(); $i++): ?>
                        <button type="button" data-bs-target="#carouselExampleCaptions" data-bs-slide-to="<?php echo e($i); ?>"
                            class="active" aria-current="true" aria-label="Slide <?php echo e(($i+1)); ?>"></button>
                        <?php endfor; ?>
                        <?php else: ?>
                        <button type="button" data-bs-target="#carouselExampleCaptions" data-bs-slide-to="0"
                            class="active" aria-current="true" aria-label="Slide 1"></button>
                        <?php endif; ?>

                </div>
                <div class="carousel-inner">
                    <?php if($banner->count()>0): ?>
                    <?php $__currentLoopData = $banner; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $b): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                    <?php if($loop->iteration==1): ?>
                    <div class="carousel-item active">
                        <?php else: ?>
                        <div class="carousel-item">
                            <?php endif; ?>

                            <img src="<?php echo e(asset('img/banner/'.$b->id_desa.'/'.$b->foto)); ?>" class="d-block w-100">
                            <div class="carousel-caption d-none d-md-block">
                                <h5><?php echo e($b->judul); ?></h5>
                                <p><?php echo e($b->deskripsi); ?></p>
                            </div>
                        </div>
                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                        <?php else: ?>
                        <div class="carousel-item active">
                            <img src="<?php echo e(asset('img/background-2.jpg')); ?>" class="d-block w-100">
                            <div class="carousel-caption d-none d-md-block">
                                <h5><?php echo e(wilayah(auth()->user()->id_desa)['desa']); ?></h5>
                                <p>Forum Diskusi</p>
                            </div>
                        </div>
                        <?php endif; ?>

                    </div>
                    <button class="carousel-control-prev" type="button" data-bs-target="#carouselExampleCaptions"
                        data-bs-slide="prev">
                        <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                        <span class="visually-hidden">Previous</span>
                    </button>
                    <button class="carousel-control-next" type="button" data-bs-target="#carouselExampleCaptions"
                        data-bs-slide="next">
                        <span class="carousel-control-next-icon" aria-hidden="true"></span>
                        <span class="visually-hidden">Next</span>
                    </button>
                </div>

                <div class="container">
                    <div class="row pt-4">
                        <div class="col-md-9 mb-3">
                            <?php echo $__env->yieldContent('konten'); ?>
                        </div>
                        <div class="col-md-3 mb-3">
                            <?php echo $__env->make('user.widget_backup', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
                        </div>
                    </div>

                </div>
            </div>

            <div id="btn-grup-musrenbang" class="shadow putih remove-underline">
                <button href="offcanvasChat" data-bs-toggle="offcanvas" data-bs-target="#offcanvasChat"
                    aria-controls="offcanvasChat" class="grup-musrenbang"><i class="bi bi-chat-quote"></i> Chat Grup
                    Musrenbang</button>
            </div>



            <footer id="footer" class="bg-body">
                <div class="container">
                    <div class="copyright float-right hitam">
                        &copy;Desaku <?php echo e(tahun_sekarang()); ?>, dibuat dengan penuh <i class="bi bi-heart-fill merah"></i>
                        oleh
                        <a href="<?php echo e(route('team')); ?>">Tim
                            Desaku</a> untuk Indonesia
                        lebih maju.
                    </div>
                </div>
            </footer>


        </div>


        <?php echo $__env->make('user.canvas', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
</body>

<script src="https://code.jquery.com/jquery-3.5.1.js"></script>
<script type="text/javascript" src="//code.jquery.com/jquery-migrate-1.2.1.min.js"></script>
<script src="https://code.jquery.com/ui/1.12.1/jquery-ui.js"></script>
<script src="<?php echo e(asset('admin/js/datepicker-id.js')); ?>"></script>
<script src="https://js.pusher.com/4.1/pusher.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js"
    integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous">
</script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap-select@1.14.0-beta2/dist/js/bootstrap-select.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-select/1.12.2/js/i18n/defaults-id_ID.min.js"></script>

<script src="https://cdn.datatables.net/1.10.25/js/jquery.dataTables.min.js"></script>
<script src="https://cdn.datatables.net/1.10.25/js/dataTables.bootstrap5.min.js"></script>

<!-- kartik -->
<script src="https://cdn.jsdelivr.net/gh/kartik-v/bootstrap-fileinput@5.2.2/js/plugins/piexif.min.js"
    type="text/javascript"></script>
<script src="https://cdn.jsdelivr.net/gh/kartik-v/bootstrap-fileinput@5.2.2/js/plugins/sortable.min.js"
    type="text/javascript"></script>
<script src="https://cdn.jsdelivr.net/gh/kartik-v/bootstrap-fileinput@5.2.2/js/fileinput.min.js"></script>
<script src="https://cdn.jsdelivr.net/gh/kartik-v/bootstrap-fileinput@5.2.2/js/locales/id.js"></script>


<script src="<?php echo e(asset('summernote/summernote-lite.min.js')); ?>"></script>
<script src="<?php echo e(asset('summernote/lang/summernote-id-ID.min.js')); ?>"></script>


<script src="<?php echo e(asset('admin/js/moment.js')); ?>"></script>
<script src="<?php echo e(asset('admin/js/moment-locale.js')); ?>"></script>


<script src="<?php echo e(asset('splide/js/splide.min.js')); ?>"></script>
<script src="<?php echo e(asset('slick/slick.min.js')); ?>"></script>

<script src="<?php echo e(asset('parsley/js/parsley.min.js')); ?>"></script>
<script src="<?php echo e(asset('parsley/js/id.js')); ?>"></script>
<script src="<?php echo e(asset('swal/sweetalert2.min.js')); ?>"></script>
<script>
    var asset = "<?php echo e(asset('/img/')); ?>/";
    var abc = "<?php echo e(route('notif.delete')); ?>"
    var prox = "data_<?php echo e(auth()->user()->id); ?>";
    var cba = "<?php echo e(csrf_token()); ?>";
    var abcz = "<?php echo e(route('notif.delete.all')); ?>";

</script>
<script src="<?php echo e(asset('admin/js/main-front.js')); ?>"></script>

<script src="<?php echo e(asset('admin/js/pusher.js')); ?>"></script>
<?php if(auth()->check() && auth()->user()->hasRole('admin|super')): ?>
<?php echo $__env->make('user.js.pusher', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
<?php endif; ?>


<script>
    document.addEventListener("DOMContentLoaded", function () {
        var elements = document.getElementsByClassName("inpCariForum");
        for (var i = 0; i < elements.length; i++) {
            elements[i].oninvalid = function (e) {
                e.target.setCustomValidity("");
                if (!e.target.validity.valid) {
                    e.target.setCustomValidity("Ketikan sesuatu untuk mencari forum diskusi.");
                }
            };
            elements[i].oninput = function (e) {
                e.target.setCustomValidity("");
            };
        }
    })

    $(document).ready(function () {
        let cek = 0;
        let datas = 0;
        let datax = 0;
        <?php $__currentLoopData = $vote; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $d): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
        datax = "<?php echo e($d['status']); ?>";
        datas = parseInt(datax);
        // let datas = "<?php echo e($d['status']); ?>";
        if (datas < 1) {
            cek++;
        }
        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
        setTimeout(function () {

            $('.toast').toast('show');

            if (cek > 0) {
                const Toast = Swal.mixin({
                    toast: true,
                    position: 'top',
                    showConfirmButton: true,
                    timer: 5000,
                    timerProgressBar: true,
                    didOpen: (toast) => {
                        toast.addEventListener('mouseenter', Swal.stopTimer)
                        toast.addEventListener('mouseleave', Swal.resumeTimer)
                    }
                })

                Toast.fire({
                    icon: 'info',
                    title: `Terdapat ${cek} Vote Yang Belum Anda Pilih.`
                })
            }
        }, 3000);
    });

</script>



<?php echo $__env->yieldContent('js'); ?>

</html>
<?php /**PATH C:\xampp\htdocs\desacuss_new\resources\views/user/master.blade.php ENDPATH**/ ?>