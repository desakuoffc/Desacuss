<nav aria-label="breadcrumb">
    <ol class="breadcrumb">
        <li class="breadcrumb-item"><a class="teks-item-forum hitam remove-underline"
                href="<?php echo e(route('beranda')); ?>">Beranda</a>
        </li>
        <li class="breadcrumb-item"><a class="teks-item-forum hitam remove-underline"
                href="<?php echo e(route('select.index', ['id'=> $discuss->kategori->id_kategori,'slug'=>$discuss->kategori->slug_kategori])); ?>"><?php echo e($discuss->kategori->nama_kategori); ?></a>
        </li>
        <li class="breadcrumb-item active" aria-current="page"><?php echo e($discuss->nama_diskusi); ?></li>
    </ol>
</nav>

<div id="card_forum_<?php echo e($discuss->id_diskusi); ?>" class="card_forum card border-primary mb-3">
    <div class="card-body pe-4 ps-4">
        <div class="row">
            <div class="col-md-2 mb-3">
                <img class="mx-auto d-block rounded-circle" style="object-fit: cover"
                    src="<?php echo e(asset('/img/user/'.$discuss->id_desa.'/'.$discuss->user->foto)); ?>"
                    onerror="this.onerror=null;this.src='<?php echo e(asset('/img/user/apatar.png')); ?>';" width="80" height="80">
                <p class="font-14 mt-2 mb-0 text-center"><?php echo e($discuss->user->name); ?></p>
                <div class="text-center mt-0">
                    <span class="badge bg-success font-10"><?php echo e(clean($discuss->user->getRoleNames())); ?></span>
                </div>
            </div>
            <div class="col-md-10 mb-3">
                <div class="d-flex">
                    <div class="card-title mb-0 teks-item-forum font-20 me-auto"><?php echo e($discuss->nama_diskusi); ?></div>
                    <?php if(just_clean(auth()->user()->getRoleNames())=='super' ||
                    just_clean(auth()->user()->getRoleNames())=='admin' ||
                    $discuss->id_user==auth()->user()->id): ?>
                    <div class="dropdown dropstart d-flex ms-auto">
                        <span class="me-2" role="button" id="dropdownMenuLink" data-bs-toggle="dropdown"
                            aria-expanded="false">
                            <i class="bi bi-three-dots-vertical icon-item-forum"></i>
                        </span>
                        <ul class="dropdown-menu" aria-labelledby="dropdownMenuLink">
                            <li>
                                <a data-id="<?php echo e($discuss->id_diskusi); ?>" class="btnDeleteForum dropdown-item" href="#">
                                    <i class="bi bi-trash me-2"></i>
                                    Hapus
                                </a>
                            </li>
                        </ul>
                    </div>
                    <?php endif; ?>
                </div>
                <div class="text-start">
                    <?php echo ($discuss->jenis_diskusi == 'Forum Voting') ? '<span class="badge bg-success font-10"> Forum
                        Voting</span>' : ''; ?>

                    <span
                        class="badge bg-<?php echo e($discuss->kategori->warna); ?> font-10"><?php echo e($discuss->kategori->nama_kategori); ?></span>
                </div>

                <hr class="mb-2 mt-2">
                <div class="card-text mt-1">
                    <?php echo $discuss->deskripsi_diskusi; ?>

                </div>
            </div>
        </div>
    </div>
    <div class="card-footer p-3 bg-white">
        <div class="row">
            <div class="col-md-2 mb-1">
                <?php echo ($discuss->status == 'terlihat') ? '<span class="badge bg-success d-flex align-items-center"><i
                        class="bi bi-check2-circle me-1 font-18"></i> <small class="font-12">Forum Tersedia</small>
                </span>' :
                '<span class="badge bg-danger d-flex align-items-center"><i class="bi bi-lock me-1 font-18"></i>
                    <small class="font-12">Forum
                        Ditutup</small></span>'; ?>

            </div>
            <div class="col-md-8 mb-1">

                <span class="ms-2">
                    <i class="bi bi-eye"></i>
                    <small class="font-12">Dilihat <?php echo e($discuss->viewed); ?> kali</small>
                </span>
                <span class="ms-2">
                    <i class="bi bi-chat-text"></i>
                    <small class="total_komentar_parent" class="font-12"><?php echo e($discuss->diskusi_balas->count()); ?>

                        Komentar</small>
                </span>
                <span class="ms-2">
                    <i class="bi bi-clock"></i>
                    <small class="font-12"><?php echo e(tgl($discuss->created_at)); ?></small>
                    <small class="font-12">(<?php echo e(sisa_tgl($discuss->created_at)); ?>)</small>
                </span>
            </div>
            <div class="col-md-2 mb-1 text-center">
                <span data-diskusi="<?php echo e($discuss->id_diskusi); ?>" data-user="<?php echo e($discuss->id_user); ?>" data-like="y"
                    class="btn_like pe-2"><i id="icon_like_y_<?php echo e($discuss->id_diskusi); ?>"
                        class="icon_like bi <?php echo e(($discuss->diskusi_like_self->sum('y')>0) ? 'bi-hand-thumbs-up-fill hijau-desa' : 'bi-hand-thumbs-up'); ?>  icon-item-forum"></i>
                    <small id="total_like_y_<?php echo e($discuss->id_diskusi); ?>">
                        <?php echo e($discuss->diskusi_like->sum('y')); ?></small></span>
                <span data-diskusi="<?php echo e($discuss->id_diskusi); ?>" data-user="<?php echo e($discuss->id_user); ?>" data-like="n"
                    class="btn_like ps-2"><i id="icon_like_n_<?php echo e($discuss->id_diskusi); ?>"
                        class="icon_like bi <?php echo e(($discuss->diskusi_like_self->sum('n')>0) ? 'bi-hand-thumbs-down-fill merah' : 'bi-hand-thumbs-down'); ?> icon-item-forum"></i>
                    <small id="total_like_n_<?php echo e($discuss->id_diskusi); ?>">
                        <?php echo e($discuss->diskusi_like->sum('n')); ?></small></span>
            </div>
        </div>
    </div>
</div>

<?php if($vote_cek>0): ?>
<?php echo $__env->make('user.detail.konten_vote', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
<?php endif; ?>

<?php if(!$mus_cek): ?>
<?php echo $__env->make('user.detail.konten_musrenbang', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
<?php endif; ?>


<hr>


<div>
    <?php if($komentar->count()<1): ?> <div class="alert alert-warning d-flex justify-content-center" role="alert">
        <i class="bi bi-exclamation-triangle me-2"></i>
        Forum Ini Belum Ada Komentar.
</div>
<?php else: ?>
<?php echo e($komentar->links()); ?>

<?php $__currentLoopData = $komentar; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $reply): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
<div id="card_komentar_<?php echo e($reply->id_balas); ?>" class="card border-success mb-3">
    <div class="card-body pe-4 ps-4">
        <div class="row">
            <div class="col-md-2 mb-3">
                <img class="mx-auto d-block rounded-circle" style="object-fit: cover"
                    src="<?php echo e(asset('/img/user/'.$reply->diskusi->id_desa.'/'.$reply->user->foto)); ?>"
                    onerror="this.onerror=null;this.src='<?php echo e(asset('/img/user/apatar.png')); ?>';" width="80" height="80">
                <p class="font-14 mt-2 mb-0 text-center"><?php echo e($reply->user->name); ?></p>
                <div class="text-center mt-0">
                    <span class="badge bg-success font-10"><?php echo e(clean($reply->user->getRoleNames())); ?></span>
                </div>
            </div>
            <div class="col-md-10 mb-3">
                <div class="d-flex">
                    <div style="text-align: justify">


                        <?php echo $reply->isi_balas; ?>


                    </div>
                    <?php if(just_clean(auth()->user()->getRoleNames())=='super' ||
                    just_clean(auth()->user()->getRoleNames())=='admin' ||
                    $reply->id_user==auth()->user()->id): ?>
                    <div class="dropdown dropstart d-flex ms-auto">
                        <span class="me-2" role="button" id="dropdownMenuLink" data-bs-toggle="dropdown"
                            aria-expanded="false">
                            <i class="bi bi-three-dots-vertical icon-item-forum"></i>
                        </span>
                        <ul class="dropdown-menu" aria-labelledby="dropdownMenuLink">
                            <li>
                                <a data-id="<?php echo e($reply->id_balas); ?>" class="btnDeleteBalas dropdown-item" href="#">
                                    <i class="bi bi-trash me-2"></i>
                                    Hapus
                                </a>
                            </li>
                        </ul>
                    </div>
                    <?php endif; ?>
                </div>

            </div>
        </div>
    </div>
    <div class="card-footer p-3 bg-white">
        <div class="row">
            <div class="col-md-2 mb-1">

            </div>
            <div class="col-md-8 mb-1">
                <span class="ms-2">
                    <i class="bi bi-clock"></i>
                    <small class="font-12"><?php echo e(tgl($reply->created_at)); ?></small>
                    <small class="font-12">(<?php echo e(sisa_tgl($reply->created_at)); ?>)</small>
                </span>
                <span class="ms-2">
                    <i class="bi bi-chat-text"></i>
                    <small data-value="<?php echo e($reply->id_balas); ?>" id="small_child_<?php echo e($reply->id_balas); ?>"
                        class="btnKomentarChild teks-item-forum font-12">
                        <?php echo e($reply->replies->count()); ?>

                        Komentar</small>
                </span>
            </div>
            <div class="col-md-2 mb-1 text-center">
                <span data-balas="<?php echo e($reply->id_balas); ?>" data-user="<?php echo e($reply->id_user); ?>" data-like="y"
                    class="btn_like_child pe-2"><i id="icon_like_y_child_<?php echo e($reply->id_balas); ?>"
                        class="icon_like_child bi <?php echo e(($reply->diskusi_like_self->sum('y')>0) ? 'bi-hand-thumbs-up-fill hijau-desa' : 'bi-hand-thumbs-up'); ?>  icon-item-forum"></i>
                    <small id="total_like_y_child_<?php echo e($reply->id_balas); ?>">
                        <?php echo e($reply->diskusi_like->sum('y')); ?></small></span>
                <span data-balas="<?php echo e($reply->id_balas); ?>" data-user="<?php echo e($reply->id_user); ?>" data-like="n"
                    class="btn_like_child ps-2"><i id="icon_like_n_child_<?php echo e($reply->id_balas); ?>"
                        class="icon_like_child bi <?php echo e(($reply->diskusi_like_self->sum('n')>0) ? 'bi-hand-thumbs-down-fill merah' : 'bi-hand-thumbs-down'); ?> icon-item-forum"></i>
                    <small id="total_like_n_child_<?php echo e($reply->id_balas); ?>">
                        <?php echo e($reply->diskusi_like->sum('n')); ?></small></span>
            </div>
        </div>
    </div>
</div>

<div id="div_child_komentar_<?php echo e($reply->id_balas); ?>" class="div_child_komentar sembunyi mb-3 border-primary ms-5">
    <div class="alert alert-primary d-flex align-items-center" role="alert">
        <div>
            <span class="text-muted sebaris-block">
                Balas Komentar:
                <?php echo \Illuminate\Support\Str::limit(strip_tags($reply->isi_balas) , 50,
                $end='...'); ?></span>
        </div>
    </div>
    <div id="daftarReplies_<?php echo e($reply->id_balas); ?>" class="card max-600 mb-3">
        <?php $__currentLoopData = $reply->replies; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $replies): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
        <div id="body_reply_<?php echo e($replies->id_balas); ?>" class="card-body">
            <div class="row">
                <div class="col-md-3 pe-0">
                    <div class="p-2 d-flex align-items-center">
                        <div class="flex-shrink-0">
                            <img class="mx-auto d-block rounded-circle" style="object-fit: cover"
                                src="<?php echo e(asset('/img/user/'.$replies->user->id_desa.'/'.$replies->user->foto)); ?>"
                                onerror="this.onerror=null;this.src='<?php echo e(asset('/img/user/apatar.png')); ?>';" width="40"
                                height="40">
                        </div>
                        <div class="flex-grow-1 ms-3">
                            <p class="mb-0 font-12">
                                <a class="teks-item-forum font-14 remove-underline-just hitam sebaris-block">
                                    <?php echo e($replies->user->name); ?>

                                </a>
                            </p>
                            <p class="text-muted mt-0 mb-0 font-12">
                                <span class="d-flex text-muted font-12">
                                    <?php echo e(tgl($replies->created_at)); ?>

                                </span>
                                <span class="text-muted font-12">
                                    <?php echo e(sisa_tgl($replies->created_at)); ?>

                                </span>
                            </p>
                        </div>
                    </div>

                </div>
                <div class="col-md-9">
                    <div class="card mb-3 p-3">
                        <p><?php echo e($replies->isi_balas); ?></p>
                    </div>
                    <?php if(just_clean(auth()->user()->getRoleNames())=='super' ||
                    just_clean(auth()->user()->getRoleNames())=='admin' ||
                    $reply->id_user==auth()->user()->id): ?>
                    <button data-id="<?php echo e($replies->id_balas); ?>" class="btnDeleteReply btn btn-danger btn-sm pull-right">
                        <i class="bi bi-trash me-2"></i>
                        Hapus
                    </button>
                    <?php endif; ?>
                </div>
            </div>
            <?php if(!$loop->last): ?>
            <hr>
            <?php endif; ?>
        </div>
        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
    </div>

    <?php if($discuss->status=='tertutup'): ?>
    <div class="alert alert-danger d-flex justify-content-center" role="alert">
        <i class="bi bi-exclamation-triangle me-2"></i>
        Forum Ini Sudah Ditutup.
    </div>
    <?php else: ?>

    <div class="card border-primary p-4">
        <div class="row">
            <div class="col-md-3">
                <div class="p-2 d-flex align-items-center">
                    <div class="flex-shrink-0">
                        <img class="mx-auto d-block rounded-circle" style="object-fit: cover"
                            src="<?php echo e(asset('/img/user/'.auth()->user()->id_desa.'/'.auth()->user()->foto)); ?>"
                            onerror="this.onerror=null;this.src='<?php echo e(asset('/img/user/apatar.png')); ?>';" width="40"
                            height="40">
                    </div>
                    <div class="flex-grow-1 ms-3">
                        <p class="mb-0 font-12">
                            <a class="teks-item-forum font-14 remove-underline-just hitam sebaris-block">
                                <?php echo e(auth()->user()->name); ?>

                            </a>
                        </p>
                    </div>
                </div>
            </div>
            <div class="col-md-9">
                <form id="formBalasChild_<?php echo e($reply->id_balas); ?>" class="formBalasChild">
                    <div id="reply_error_<?php echo e($reply->id_balas); ?>"></div>
                    <div class="row mt-2 mb-2">
                        <div class="col-md-10 mb-2">
                            <textarea id="textarea_<?php echo e($reply->id_balas); ?>" class="form-control reply_kelas" name="reply"
                                id="reply_<?php echo e($reply->id_balas); ?>" rows="1"
                                placeholder="Balas komentar <?php echo e($reply->user->name); ?> disini..." required="required"
                                data-parsley-errors-container="#reply_error_<?php echo e($reply->id_balas); ?>"
                                data-parsley-required-message="Komentar belum diisi."></textarea>
                        </div>
                        <div class="col-md-2">
                            <div class="btn-group" role="group" aria-label="Basic example">
                                <button data-reply="<?php echo e($reply->id_balas); ?>" type="button"
                                    class="btn_reply_balas btn btn-outline-success pull-right"><i
                                        class="bi bi-reply"></i></button>
                                <button data-reply="<?php echo e($reply->id_balas); ?>" type="button"
                                    class="btn_reply_close btn btn-outline-danger pull-left"><i
                                        class="bi bi-x-square"></i></button>
                            </div>
                        </div>
                    </div>

                </form>
            </div>
        </div>
    </div>
    <?php endif; ?>

</div>


<?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
<?php echo e($komentar->links()); ?>

<?php endif; ?>

<?php if($discuss->status=='tertutup'): ?>
<div class="alert alert-danger d-flex justify-content-center" role="alert">
    <i class="bi bi-exclamation-triangle me-2"></i>
    Forum Ini Sudah Ditutup.
</div>
<?php else: ?>

<div class="card mb-3">
    <div class="card-body pe-4 ps-4">
        <div class="row">
            <div class="col-md-2 mb-3">
                <img class="mx-auto d-block rounded-circle" style="object-fit: cover"
                    src="<?php echo e(asset('/img/user/'.$discuss->id_desa.'/'.auth()->user()->foto)); ?>"
                    onerror="this.onerror=null;this.src='<?php echo e(asset('/img/user/apatar.png')); ?>';" width="80" height="80">
                <p class="font-14 mt-2 mb-0 text-center"><?php echo e(auth()->user()->name); ?></p>
                <div class="text-center mt-0">
                    <span class="badge bg-success font-10"><?php echo e(clean(auth()->user()->getRoleNames())); ?></span>
                </div>
            </div>
            <div class="col-md-10 mb-3">
                <form id="formKomentar">
                    <?php echo csrf_field(); ?>
                    <input type="text" name="id_diskusi" value="<?php echo e($discuss->id_diskusi); ?>" hidden>
                    <input type="text" name="slug" value="<?php echo e($discuss->slug_nama_diskusi); ?>" hidden>
                    <textarea name="komentar" class="form-control" id="sn_komentar" required="required"
                        data-parsley-summernote-required="required" data-parsley-errors-container="#komentar_error"
                        data-parsley-required-message="Komentar belum diisi."></textarea>
                    <div id="komentar_error"></div>
                </form>
                <button id="btnSubmitKomentar" class="btn btn-success btn-sm pull-right mt-4">Balas</button>
            </div>
        </div>
    </div>
</div>

<?php endif; ?>
</div>

<?php /**PATH C:\xampp\htdocs\desacuss_new\resources\views/user/detail/konten.blade.php ENDPATH**/ ?>