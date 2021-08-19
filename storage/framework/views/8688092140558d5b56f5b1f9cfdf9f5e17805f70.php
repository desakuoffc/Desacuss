<nav aria-label="breadcrumb">
    <ol class="breadcrumb">
        <li class="breadcrumb-item"><a class="teks-item-forum hitam remove-underline"
                href="<?php echo e(route('beranda')); ?>">Beranda</a>
        </li>
        <li class="breadcrumb-item active" aria-current="page"><?php echo e($categories['kategori']); ?></li>
    </ol>
</nav>

<div class="card mb-3">
    <div class="card-body">
        <h5 class="card-title  text-center">
            <p class="mb-1">FORUM DISKUSI - <?php echo e(strtoupper($categories['kategori'])); ?></p>
            <small class="text-muted">Deskripsi Kategori</small>
            <span class="hr-desa mb-3 wid-25 mt-2"><em class="hr-desa wid-50"></em></span>
        </h5>
        <div class="row text-center">
            <div class="col-md-4">
                <i class="bi bi-receipt fs-1"></i>
                <p><?php echo e($categories['total_topik']); ?> Forum Diskusi</p>
            </div>
            <div class="col-md-4">
                <i class="bi bi-check2-circle fs-1"></i>
                <p><?php echo e($categories['total_terbuka']); ?> Forum Terbuka</p>
            </div>
            <div class="col-md-4">
                <i class="bi bi-chat fs-1"></i>
                <p><?php echo e($categories['total_komentar']); ?> Komentar</p>
            </div>
        </div>
    </div>
</div>

<?php echo e($discuss->links()); ?>

<?php $__currentLoopData = $discuss; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $ds): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
<div id="card_forum_<?php echo e($ds->id_diskusi); ?>" class="card_forum card mb-3">
    <div class="card-body pe-4 ps-4">
        <div class="row">
            <div class="col-md-2 mb-3">
                <img class="mx-auto d-block rounded-circle" style="object-fit: cover"
                    src="<?php echo e(asset('/img/user/'.$ds->id_desa.'/'.$ds->user->foto)); ?>"
                    onerror="this.onerror=null;this.src='<?php echo e(asset('/img/user/apatar.png')); ?>';" width="80" height="80">
                <p class="font-14 mt-2 mb-0 text-center"><?php echo e($ds->user->name); ?></p>
                <div class="text-center mt-0">
                    <span class="badge bg-success font-10"><?php echo e(clean($ds->user->getRoleNames())); ?></span>
                </div>
            </div>
            <div class="col-md-10 mb-3">
                <div class="d-flex">
                    <a href="<?php echo e(route('select.detail', ['id'=> $ds->id_diskusi,'slug'=>$ds->slug_nama_diskusi])); ?>"
                        class="card-title remove-underline-just hitam mb-0 teks-item-forum font-20 me-auto"><?php echo e($ds->nama_diskusi); ?></a>
                </div>
                <div class="text-start">
                    <?php echo ($ds->jenis_diskusi == 'Forum Voting') ? '<span class="badge bg-success font-10"> Forum
                        Voting</span>' : ''; ?>

                    <span class="badge bg-<?php echo e($ds->kategori->warna); ?> font-10"><?php echo e($ds->kategori->nama_kategori); ?></span>
                </div>

                <hr class="mb-2 mt-2">
                <div class="card-text mt-1">
                    <?php
                    $url = route('select.detail', ['id'=> $ds->id_diskusi,'slug'=>$ds->slug_nama_diskusi])
                    ?>
                    <?php echo \Illuminate\Support\Str::limit(strip_tags($ds->deskripsi_diskusi) , 250,
                    $end=' ...<a href="'.$url.'"> Lanjutkan Membaca</a> '); ?>

                </div>
            </div>
        </div>
    </div>
    <div class="card-footer p-3 bg-white">
        <div class="row">
            <div class="col-md-2 mb-1">
                <?php echo ($ds->status == 'terlihat') ? '<span class="badge bg-success d-flex align-items-center"><i
                        class="bi bi-check2-circle me-1 font-18"></i> <small class="font-12">Forum Tersedia</small>
                </span>' :
                '<span class="badge bg-danger d-flex align-items-center"><i class="bi bi-lock me-1 font-18"></i>
                    <small class="font-12">Forum
                        Ditutup</small></span>'; ?>

            </div>
            <div class="col-md-8 mb-1">

                <span class="ms-2">
                    <i class="bi bi-eye"></i>
                    <small class="font-12">Dilihat <?php echo e($ds->viewed); ?> kali</small>
                </span>
                <span class="ms-2">
                    <i class="bi bi-chat-text"></i>
                    <small class="font-12"><?php echo e($ds->diskusi_balas->count()); ?> Komentar</small>
                </span>
                <span class="ms-2">
                    <i class="bi bi-clock"></i>
                    <small class="font-12"><?php echo e(tgl($ds->created_at)); ?></small>
                    <small class="font-12">(<?php echo e(sisa_tgl($ds->created_at)); ?>)</small>
                </span>
            </div>
            <div class="col-md-2 mb-1 text-center">
                <span data-diskusi="<?php echo e($ds->id_diskusi); ?>" data-user="<?php echo e($ds->id_user); ?>" data-like="y"
                    class="btn_like pe-2"><i id="icon_like_y_<?php echo e($ds->id_diskusi); ?>"
                        class="icon_like bi <?php echo e(($ds->diskusi_like_self->sum('y')>0) ? 'bi-hand-thumbs-up-fill hijau-desa' : 'bi-hand-thumbs-up'); ?>  icon-item-forum"></i>
                    <small id="total_like_y_<?php echo e($ds->id_diskusi); ?>"> <?php echo e($ds->diskusi_like->sum('y')); ?></small></span>
                <span data-diskusi="<?php echo e($ds->id_diskusi); ?>" data-user="<?php echo e($ds->id_user); ?>" data-like="n"
                    class="btn_like ps-2"><i id="icon_like_n_<?php echo e($ds->id_diskusi); ?>"
                        class="icon_like bi <?php echo e(($ds->diskusi_like_self->sum('n')>0) ? 'bi-hand-thumbs-down-fill merah' : 'bi-hand-thumbs-down'); ?> icon-item-forum"></i>
                    <small id="total_like_n_<?php echo e($ds->id_diskusi); ?>"> <?php echo e($ds->diskusi_like->sum('n')); ?></small></span>


            </div>
        </div>
    </div>
</div>
<?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
<?php echo e($discuss->links()); ?>

<?php /**PATH C:\xampp\htdocs\desacuss\resources\views/user/select/konten.blade.php ENDPATH**/ ?>