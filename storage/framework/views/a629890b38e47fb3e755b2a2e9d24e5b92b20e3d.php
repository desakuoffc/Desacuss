<div class="offcanvas offcanvas-end" data-bs-scroll="true" tabindex="-1" id="offcanvasRight"
    aria-labelledby="offcanvasWithBothOptionsLabel">
    <div class="offcanvas-header">
        <h5 class="offcanvas-title" id="offcanvasWithBothOptionsLabel">
            <i class="bi bi-bell-fill"></i>
            Semua Notifikasi
            (<span id="canvas_notif_total"><?php echo e(auth()->user()->notifications->count()); ?></span>)
        </h5>
        <button type="button" class="btn-close text-reset" data-bs-dismiss="offcanvas" aria-label="Close"></button>
    </div>
    <div class="text-end ms-3" style="margin-right: 2rem">
        <div class="btn-group" role="group" aria-label="Basic example">
            <button type="button" class="hapusCanvasAll font-12 btn btn-outline-danger btn-sm">
                <i class="bi bi-trash"></i> Hapus Semua Notifikasi
            </button>
        </div>
    </div>

    <div class="offcanvas-body mt-1">
        <ul id="canvas_notifikasi" class="remove-dot">
            <?php $__currentLoopData = auth()->user()->notifications; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $nf): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
            <li class="cursor mb-3 bg-whtie li_all li-<?php echo e($nf->data['data']['random']); ?>" style="border-radius:10px;">
                <div class="card">
                    <a href="<?php echo e($nf->data['data']['url']); ?>" class="remove-underline" style="color: black">
                        <div class="card-body">
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
                        </div>
                    </a>
                    <div class="card-footer bg-white">
                        <div class="btn-group wid-100" role="group" aria-label="Basic example">
                            <button data-random="<?php echo e($nf->data['data']['random']); ?>" type="button"
                                class="hapusCanvas font-12 btn btn-outline-danger btn-sm">Hapus</button>
                        </div>
                    </div>
                </div>
            </li>
            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
        </ul>
    </div>
</div>


<div class="toast-container position-fixed top-0 end-0 p-3" style="z-index: 60000; margin-top: 6rem">

</div>
<?php /**PATH C:\xampp\htdocs\desacuss\resources\views/user/canvas.blade.php ENDPATH**/ ?>