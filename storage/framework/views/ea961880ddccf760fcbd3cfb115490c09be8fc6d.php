<header class="header" id="header">
    <div class="header_toggle"> <i class='bi bi-list' id="header-toggle"></i> </div>
    <p class="d-flex ms-2 me-auto mt-auto teks-desa font-16 teks-tebal">
        <?php echo e(strtoupper(wilayah(auth()->user()->id_desa)['desa'])); ?>

    </p>

    <div class="topbar-divider d-none d-sm-block"></div>

    <ul class="navbar-nav">
        <li class="nav-item dropdown dropdown-notifications sembunyi">
            <a class="nav-link hitam font-16 text-helper" href="#" role="button" data-bs-toggle="dropdown"
                aria-expanded="false">
                <i id="data_default" data-count="<?php echo e(auth()->user()->unreadNotifications->count()); ?>" class="bi bi-bell">
                </i>
                <span class="statusNotif position-absolute start-100 translate-middle badge rounded-pill bg-danger">
                    <div id="total_notifikasi">
                        <?php echo e(auth()->user()->unreadNotifications->count()); ?>

                    </div>
                    <span class="visually-hidden">unread messages</span>
                </span>
                <span class="text-notifikasi">Notifikasi</span>
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
                        <a href="<?php echo e($nf->data['data']['url']); ?>" class="remove-underline" style="color: black">
                            <div class="d-flex align-items-center">
                                <div class="flex-shrink-0">
                                    <img src="<?php echo e(asset('img/user/'.auth()->user()->id_desa)); ?>/<?php echo e($nf->data['data']['foto']); ?>"
                                        onerror="this.onerror=null;this.src='<?php echo e(asset('/img/user/apatar.png')); ?>';"
                                        class="rounded-circle" alt="30x30" style="width: 30px; height: 30px;">
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
                    <a href="offcanvasRight" data-bs-toggle="offcanvas" data-bs-target="#offcanvasRight"
                        aria-controls="offcanvasRight">Lihat semua
                        notifikasi</a>
                </div>
            </div>
        </li>
    </ul>

    <ul class="navbar-nav ms-5 nav-foto">
        <li class="nav-item dropdown no-arrow" style="display: inline-flex;">
            <div class="profile-icon-text">
                <div id="base-nama-pengenal" class="base nama-pengenal"><?php echo e(auth()->user()->name); ?></div>
                <div class="sub nama-pengenal"><?php echo e(strtoupper(clean(auth()->user()->getRoleNames()))); ?></div>
            </div>
            <img id="base-foto" src="<?php echo e(asset('/img/user/'.auth()->user()->village->id.'/'.auth()->user()->foto)); ?>"
                onerror="this.onerror=null;this.src='<?php echo e(asset('/img/user/apatar.png')); ?>';"
                class="nav-link dropdown-toggle profile-icon  img-profile rounded-circle float-end " href="#"
                id="userDropdown" role="button" data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
            <div id="base-foto-slide"
                class="animation slideDownIn slideDownIn-mobile dropdown-menu dropdown-menu-right shadow left-80"
                style="margin-top: 100px;" aria-labelledby="userDropdown">
                
            <a class="dropdown-item" href="<?php echo e(route('logout')); ?>" data-toggle="modal" data-target="#logoutModal"
                onclick="event.preventDefault();
                document.getElementById('logout-form').submit();">
                <i class="fa fa-sign-out fa-sm fa-fw mr-2 text-gray-400"></i>
                Logout
            </a>
            </div>
        </li>
    </ul>
</header>

<div class="l-navbar" id="nav-bar">
    <nav class="nav">
        <div>
            <a href="<?php echo e(route('beranda')); ?>" class="nav_logo">
                <i class="bi bi-house putih"></i>
                <span class="nav_logo-name">Forum Diskusi</span>
            </a>
            <div class="nav_list">
                <a href="<?php echo e(route('profile.index')); ?>"
                    class="nav_link <?php echo e((request()->is('profile')) ? 'aktif active' : ''); ?> ">
                    <i class="bi bi-person-circle"></i>
                    <span class="nav_name">Profile</span>
                </a>
                <?php if(auth()->user()->can('musrenbang') ||
                just_clean(auth()->user()->getRoleNames())=='super' ||
                just_clean(auth()->user()->getRoleNames())=='admin'): ?>
                <a href="<?php echo e(route('musrenbang.index')); ?>"
                    class="nav_link <?php echo e((request()->is('musrenbang')) ? 'aktif active' : ''); ?> ">
                    <i class="bi bi-receipt"></i>
                    <span class="nav_name">Musrenbang</span>
                </a>
                <?php endif; ?>
                <?php if(auth()->check() && auth()->user()->hasRole('admin|super')): ?>
                <hr class="mt-3 mb-3 bg-white divider">
                <a href="<?php echo e(route('diskusi.index')); ?>"
                    class="nav_link <?php echo e((request()->is('diskusi')) ? 'aktif active' : ''); ?> ">
                    <i class="bi bi-chat-square-quote"></i>
                    <span class="nav_name">Diskusi</span>
                </a>
                <a href="<?php echo e(route('user.index')); ?>" class="nav_link <?php echo e((request()->is('user')) ? 'aktif active' : ''); ?> ">
                    <i class="bi bi-people"></i>
                    <span class="nav_name">Anggota</span>
                </a>
                <a href="<?php echo e(route('banner.index')); ?>"
                    class="nav_link <?php echo e((request()->is('banner')) ? 'aktif active' : ''); ?> ">
                    <i class="bi bi-images"></i>
                    <span class="nav_name">Banner</span>
                </a>
                <?php endif; ?>
            </div>
        </div>

        <a href="<?php echo e(route('logout')); ?>" class="nav_link" onclick="event.preventDefault();
        document.getElementById('logout-form').submit();">
            <i class="bi bi-door-open"></i>
            <span class="nav_name">SignOut</span>
        </a>
        <form id="logout-form" action="<?php echo e(route('logout')); ?>" method="POST" class="d-none">
            <?php echo csrf_field(); ?>
        </form>
    </nav>
</div>
<?php /**PATH C:\xampp\htdocs\desacuss\resources\views/admin/header.blade.php ENDPATH**/ ?>