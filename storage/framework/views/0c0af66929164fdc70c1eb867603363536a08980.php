<div class="card border-primary mb-3">
    <div class="card-header bg-white">
        <span class="font-16">MUSRENBANG <?php echo e(strtoupper($discuss->nama_diskusi)); ?></span>
        <button id="btnShowMusrenbang" class="btn btn-outline-success btn-sm pull-right">Tampilkan</button>
        <button id="btnHideMusrenbang" class="btn btn-outline-success btn-sm pull-right sembunyi">Sembunyikan</button>
    </div>
    <div class="div_menu_musrenbang card-body sembunyi">
        <ul class="nav nav-tabs justify-content-center" id="myTab" role="tablist">
            <li class="nav-item" role="presentation">
                <button class="nav-link active" id="desk_musrenbang_tab" data-bs-toggle="tab"
                    data-bs-target="#desk_musrenbang" type="button" role="tab" aria-controls="desk_musrenbang"
                    aria-selected="true">Deskripsi</button>
            </li>
            <li class="nav-item" role="presentation">
                <button class="nav-link " id="prog_musrenbang_tab" data-bs-toggle="tab"
                    data-bs-target="#prog_musrenbang" type="button" role="tab" aria-controls="prog_musrenbang"
                    aria-selected="false">Progress (<?php echo e($musrenbang->musrenbang_progres->count()); ?>)</button>
            </li>
            <li class="nav-item" role="presentation">
                <button class="nav-link " id="biaya_musrenbang_tab" data-bs-toggle="tab"
                    data-bs-target="#biaya_musrenbang" type="button" role="tab" aria-controls="biaya_musrenbang"
                    aria-selected="false">Biaya</button>
            </li>
            <li class="nav-item" role="presentation">
                <button class="nav-link " id="user_musrenbang_tab" data-bs-toggle="tab"
                    data-bs-target="#user_musrenbang" type="button" role="tab" aria-controls="user_musrenbang"
                    aria-selected="false">Anggota (<?php echo e($musrenbang->musrenbang_user->count()); ?>)</button>
            </li>
        </ul>
        <div class="tab-content" id="myTabContent">
            <div class="tab-pane fade show active p-4" id="desk_musrenbang" role="tabpanel"
                aria-labelledby="desk_musrenbang_tab">
                <div class="mb-1 row">
                    <label for="nama_musrenbang" class="col-sm-2 col-form-label">Nama Program</label>
                    <div class="col-sm-10">
                        <input type="text" readonly class="form-control-plaintext" id="nama_musrenbang"
                            value="<?php echo e($musrenbang->nama_musrenbang); ?>">
                    </div>
                </div>
                <div class="mb-1 row">
                    <label for="tgl_musrenbang" class="col-sm-2 col-form-label">Tanggal</label>
                    <div class="col-sm-10">
                        <input type="text" readonly class="form-control-plaintext" id="tgl_musrenbang"
                            value="<?php echo e(tgl_fix($musrenbang->tgl_start)); ?> - <?php echo e(tgl_fix($musrenbang->tgl_end)); ?>">
                    </div>
                </div>
                <div class="mb-1 row">
                    <div id="deskripsi_musrenbang" class="card m-2 p-2">
                        <?php echo $musrenbang->deskripsi_musrenbang; ?>

                    </div>
                </div>
            </div>
            <div class="tab-pane fade p-4 pe-5 ps-5 " id="prog_musrenbang" role="tabpanel"
                aria-labelledby="prog_musrenbang_tab">
                <div class="max-400">
                    <?php $__currentLoopData = $musrenbang->musrenbang_progres; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $mm): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                    <div class="card p-4 mb-3">
                        <div class="d-flex justify-content-between respon-tengah">
                            <div class="card-title d-flex align-items-center">
                                <div style="line-height: 18px">
                                    <p class="hitam mb-1 font-18"><?php echo e($mm->nama_musrenbang_prog); ?></p>
                                    <span class="text-muted font-12"><?php echo e(tgl_fix($mm->tgl_start_prog)); ?> -
                                        <?php echo e(tgl_fix($mm->tgl_end_prog)); ?></span>
                                </div>
                            </div>
                            <div class="justify-content-end">
                                <button id="btnShowHideProgMus_<?php echo e($mm->id_musrenbang_prog); ?>"
                                    data-mus_prog="<?php echo e($mm->id_musrenbang_prog); ?>"
                                    class="btnShowHideProgMus btn btn-outline-success pull-right"><i
                                        class="bi bi-menu-button"></i>
                                </button>
                            </div>
                        </div>
                        <div id="footer_desk_mus_<?php echo e($mm->id_musrenbang_prog); ?>" class="footer_desk_mus sembunyi">
                            <hr>
                            <div style="text-align: justify">
                                <?php echo $mm->deskripsi_musrenbang_prog; ?>

                            </div>
                        </div>
                    </div>
                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                </div>

            </div>
            <div class="tab-pane fade p-2" id="biaya_musrenbang" role="tabpanel" aria-labelledby="biaya_musrenbang_tab">

                <div class="table-responsive mb-3">
                    <table id="tabel_musrenbang_biaya" class="main inventory wid-100 mb-2" style="margin-bottom: 0px;">
                        <thead>
                            <tr class="main">
                                <th class="main" style="width: 60px;"><span>No.</span></th>
                                <th class="main" style="width: 200px;"><span>Nama Item</span></th>
                                <th class="main" style="width: 100px;"><span>Satuan</span></th>
                                <th class="main" style="width: 200px;"><span>Biaya Satuan</span></th>
                                <th class="main" style="width: 100px;"><span>Jumlah</span></th>
                                <th colspan="2" class="main"><span>Total</span></th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php $__currentLoopData = $musrenbang->musrenbang_biaya; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $mb): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                            <tr class="main">
                                <td class="main">
                                    <span>
                                        <?php echo e($loop->iteration); ?>

                                    </span>
                                </td>
                                <td class="main">
                                    <span>
                                        <?php echo e($mb->nama_musrenbang_biaya); ?>

                                    </span>
                                </td>
                                <td class="main">
                                    <span>
                                        <?php echo e($mb->satuan_musrenbang_biaya); ?>

                                    </span>
                                </td>
                                <td class="main">
                                    <span>
                                        <?php echo e(format_uang($mb->biaya_musrenbang_biaya)); ?>

                                    </span>
                                </td>
                                <td class="main">
                                    <span>
                                        <?php echo e($mb->jumlah_musrenbang_biaya); ?>

                                    </span>
                                </td>
                                <td colspan="2" class="main">
                                    <span>
                                        <?php echo e(format_uang($mb->total_musrenbang_biaya)); ?>

                                    </span>
                                </td>
                            </tr>
                            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                        </tbody>
                        <tfoot>
                            <tr class="main">
                                <th colspan="5" class="main">Total Keseluruhan</th>
                                <td colspan="2" class="main text-center font-18">
                                    <?php echo e(format_uang($musrenbang->musrenbang_biaya->sum('total_musrenbang_biaya'))); ?>

                                </td>
                            </tr>
                            <tr class="main">
                                <th colspan="2" class="main">Terbilang</th>
                                <td colspan="5" class="main text-start font-16">
                                    <?php echo e(terbilang($musrenbang->musrenbang_biaya->sum('total_musrenbang_biaya'))); ?>

                                </td>
                            </tr>
                        </tfoot>
                    </table>
                </div>

            </div>
            <div class="tab-pane fade p-2" id="user_musrenbang" role="tabpanel" aria-labelledby="user_musrenbang_tab">
                <div class="max-400">
                    <div class="row justify-content-between p-4">
                        <?php $__currentLoopData = $musrenbang->musrenbang_user; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $mu): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                        <div class="col-md-6 mb-3 ">
                            <div class="card p-2">
                                <div class="d-flex align-items-center">
                                    <div class="flex-shrink-0">
                                        <img src="<?php echo e(asset('img/user/'.$mu->user->id_desa.'/'.$mu->user->foto)); ?>"
                                            onerror="this.onerror=null;this.src='<?php echo e(asset('/img/user/apatar.png')); ?>';"
                                            class="mx-auto d-block rounded-circle" style="object-fit: cover" width="40"
                                            height="40">
                                    </div>
                                    <div class="flex-grow-1 ms-3">
                                        <p class="mb-0 font-14">
                                            <?php echo e($mu->user->name); ?>

                                        </p>
                                        <p class="text-muted mt-0 mb-0 font-14">
                                            <span class="badge bg-success">
                                                <?php echo e(clean($mu->user->getRoleNames())); ?>

                                            </span>
                                        </p>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>

                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<?php /**PATH C:\xampp\htdocs\desacuss_new\resources\views/user/detail/konten_musrenbang.blade.php ENDPATH**/ ?>