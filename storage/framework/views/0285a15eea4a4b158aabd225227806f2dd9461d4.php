<h5>FORUM DISKUSI <?php echo e(strtoupper(wilayah(auth()->user()->id_desa)['desa'])); ?></h5>
<hr class="hr-desa mt-0 mb-2">
<?php if($discuss_cek->count()<1): ?> <div class="alert alert-danger d-flex align-items-center" role="alert">
    <i class="bi bi-exclamation-triangle me-2"></i>
    <div>
        Tidak ada forum diskusi yang tersedia.
    </div>
    </div>
    <?php else: ?>

    <div class="card mb-3">
        <div class="card-body p-3">
            <?php $__currentLoopData = $kategoris; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $k): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
            <div class="row g-2">
                <div class="col-md-5 p-2 d-flex align-items-center">
                    <div class="flex-shrink-0">
                        <i class="bi bi-chat-square-text-fill font-18"></i>
                    </div>
                    <div class="flex-grow-1 ms-3">
                        <p class="mb-0 font-12">
                            <a href="<?php echo e(route('select.index', ['id'=> $k['id'],'slug'=>$k['slug']])); ?>"
                                class="teks-item-forum font-14 remove-underline-just hitam sebaris-block">
                                <?php echo e($k['name']); ?>

                            </a>
                        </p>
                        <p class="text-muted mt-0 mb-0 font-12">
                            <span class="text-muted font-12">
                                <?php echo e(\Illuminate\Support\Str::limit($k['desk'], 50, $end='...')); ?>

                            </span>
                        </p>
                    </div>
                </div>
                <div class="col-md p-2 align-self-center border-kanan">
                    <p class="mb-0 text-center"><?php echo e($k['total']); ?></p>
                    <p class="font-10 text-muted text-center">Topik</p>
                </div>
                <div class="col-md p-2 align-self-center border-kiri">
                    <p class="mb-0 text-center"><?php echo e($k['komentar']); ?></p>
                    <p class="font-10 text-muted text-center">Komentar</p>
                </div>
                <div class="col-md-4 p-2 d-flex align-items-center">
                    <div class="flex-shrink-0">
                        <img class="mx-auto d-block rounded-circle" style="object-fit: cover" src="<?php echo e($k['foto']); ?>"
                            width="40" height="40">
                    </div>
                    <div class="flex-grow-1 ms-3">
                        <p class="mb-0 font-12">
                            <a href="<?php echo e(route('select.detail', ['id'=> $k['id_diskusi'],'slug'=>$k['slug_diskusi']])); ?>"
                                class="teks-item-forum remove-underline-just hitam font-14 sebaris-block">
                                <?php echo e(\Illuminate\Support\Str::limit($k['nama_diskusi'], 28, $end='...')); ?>

                            </a>
                        </p>
                        <p class="text-muted mt-0 mb-0 font-12">
                            <span class="font-12"><?php echo e($k['user']); ?>.</span>
                            <?php echo e($k['tgl']); ?>

                        </p>
                    </div>
                </div>
            </div>
            <?php if(!$loop->last): ?>
            <hr class="mb-2 mt-2">
            <?php endif; ?>
            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
        </div>
    </div>

    <h5>FILTER</h5>
    <hr class="hr-desa mt-0 mb-2">
    <div class="card mb-3">
        <div class="card-body p-4 pb-2">
            <form method="post" action="<?php echo e(route('home.filter')); ?>">
                <?php echo csrf_field(); ?>
                <input type="text" name="tipe" value="2" hidden>
                <div class="row">
                    <div class="col-md-4 mb-3">
                        <label for="listKategori" class="form-label">Kategori</label>
                        <select style="width: 100%;" class="form-control form-control-sm selectpicker"
                            data-live-search="true" id="listKategori" name="listKategori[]" multiple
                            data-selected-text-format="count" data-actions-box="true">
                            <?php $__currentLoopData = $kategori; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $kat): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                            <option value="<?php echo e($kat->id_kategori); ?>"
                                data-content="<span class='badge bg-<?php echo e($kat->warna); ?>'> <?php echo e($kat->nama_kategori); ?></span>">
                                <?php echo e($kat->nama_kategori); ?></option>
                            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                        </select>
                    </div>
                    <div class="col-md-4 mb-3">
                        <label for="listUser" class="form-label">User</label>
                        <select style="width: 100%;" class="form-control form-control-sm selectpicker"
                            data-live-search="true" id="listUser" name="listUser[]" multiple
                            data-selected-text-format="count" data-actions-box="true">

                            <?php $__currentLoopData = $user; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $us): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                            <option value="<?php echo e($us['id']); ?>"
                                data-content="<div class='d-flex align-items-center'><div class='flex-shrink-0'><img class='mx-auto d-block rounded-circle' style='object-fit: cover'  width='35' height='35' src='<?php echo e($us['foto']); ?>' alt='...'></div><div class='flex-grow-1 ms-3'><?php echo e($us['name']); ?></div></div>">
                            </option>
                            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                        </select>
                    </div>
                    <div class="col-md-4 mb-3">
                        <label for="keyword" class="form-label">Kata Kunci</label>
                        <div class="btn-toolbar btn-group-sm mb-3" role="toolbar"
                            aria-label="Toolbar with button groups">
                            <input type="text" class="form-control form-control-sm wid-80 me-2" name="keyword"
                                placeholder="Cari Forum ...">
                            <div class="btn-group btn-group-sm" role="group" aria-label="First group">
                                <button type="submit" class="btn btn-success"><i class="bi bi-search"></i></button>
                            </div>
                        </div>
                    </div>
                </div>
            </form>
        </div>
        <?php if($konten=='filter'): ?>
        <div class="card-footer bg-white">
            <p class="mb-1 mt-1 font-16">Hasil Fillter</p>
            <hr class="hr-desa mt-0 mb-2">
            <?php if($hasil['user']!='0'): ?>
            <div class="row mb-3">
                <div class="col-md-2">
                    User :
                </div>
                <div class="col-md-10">
                    <?php echo $hasil['user']; ?>

                </div>
            </div>
            <?php endif; ?>

            <?php if($hasil['kategori']!='0'): ?>
            <div class="row mb-3">
                <div class="col-md-2">
                    Kategori :
                </div>
                <div class="col-md-10">
                    <?php echo $hasil['kategori']; ?>

                </div>
            </div>
            <?php endif; ?>

            <?php if($hasil['kata_kunci']!='0'): ?>
            <div class="row mb-3">
                <div class="col-md-2">
                    Kata Kunci :
                </div>
                <div class="col-md-10">
                    <?php echo e($hasil['kata_kunci']); ?>

                </div>
            </div>
            <?php endif; ?>

            <hr>
            <p class="text-muted text-center mb-0">
                <?php if(($hasil['total']==0)): ?>
                Filter Tidak Ditemukan
                <?php else: ?>
                Ditemukan <?php echo e($hasil['total']); ?> (<?php echo e(clean_text(terbilang($hasil['total']))); ?> ) Forum Diskusi
                <?php endif; ?>
            </p>
        </div>
        <?php endif; ?>
    </div>

    <div class="row mb-3 mt-4 respon-header">
        <div class="col-md">

        </div>
        <div class="col-md-4 ps-2 font-18 teks-tebal">
            Topik
        </div>
        <div class="col-md text-center font-18 teks-tebal">
            Kategori
        </div>
        <div class="col-md text-center font-18 teks-tebal">
            Like
        </div>
        <div class="col-md text-center font-18 teks-tebal">
            Komentar
        </div>
        <div class="col-md text-center font-18 teks-tebal">
            Dilihat
        </div>
    </div>

    <div class="card p-3">
        <?php $__currentLoopData = $discuss; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $ds): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
        <div class="row p-1 mb-2">
            <div class="col-md">
                <img class="mx-auto d-block rounded-circle" style="object-fit: cover"
                    src="<?php echo e(asset('/img/user/'.$ds->id_desa.'/'.$ds->user->foto)); ?>"
                    onerror="this.onerror=null;this.src='<?php echo e(asset('/img/user/apatar.png')); ?>';" width="50" height="50">
            </div>
            <div class="col-md-4 ps-0 d-flex align-items-center respon-tengah">
                <div class="card-title d-flex align-items-center">
                    <?php if($ds->jenis_diskusi=='tertutup'): ?>
                    <small class="bi bi-lock-fill font-18 me-2"></small>
                    <?php endif; ?>
                    <div style="line-height: 18px">
                        <a href="<?php echo e(route('select.detail', ['id'=> $ds->id_diskusi,'slug'=>$ds->slug_nama_diskusi])); ?>"
                            class="teks-item-forum remove-underline-just hitam font-16"><?php echo e($ds->nama_diskusi); ?></a>
                        <span class="text-muted font-12"><?php echo e(tgl($ds->created_at)); ?> (<?php echo e(sisa_tgl($ds->created_at)); ?>)</span>
                    </div>
                </div>
            </div>
            <div class="col-md d-flex align-items-center justify-content-center">
                <span class="badge bg-<?php echo e($ds->kategori->warna); ?> font-12"><?php echo e($ds->kategori->nama_kategori); ?></span>
            </div>
            <div class="col-md d-flex align-items-center justify-content-center">
                <i class="bi bi-hand-thumbs-up font-18 me-2"></i>
                <?php echo e($ds->diskusi_like->sum('y')); ?>

            </div>
            <div class="col-md d-flex align-items-center justify-content-center">
                <i class="bi bi-chat-square-text font-18 me-2"></i>
                <?php echo e($ds->diskusi_balas->count()); ?>

            </div>
            <div class="col-md d-flex align-items-center justify-content-center">
                <i class="bi bi-eye font-18 me-2"></i>
                <?php echo e($ds->viewed); ?>

            </div>
        </div>
        <?php if(!$loop->last): ?>
        <hr>
        <?php endif; ?>
        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
        <?php echo e($discuss->links()); ?>

    </div>
    <?php endif; ?>
<?php /**PATH C:\xampp\htdocs\desacuss\resources\views/user/beranda/konten.blade.php ENDPATH**/ ?>