<div class="btn-group wid-100 mb-3" role="group" aria-label="Basic radio toggle button group">
    <input type="radio" class="btn-check" name="btnradio" id="radioForum" autocomplete="off" checked>
    <label class="btn btn-outline-success" for="radioForum">Forum</label>

    <input type="radio" class="btn-check" name="btnradio" id="radioWidget" autocomplete="off">
    <label class="btn btn-outline-success" for="radioWidget">Widget</label>
</div>

<button hidden type="button" id="btnModalStore">Test</button>

<div id="div_widget_forum">
    <h5>Kategori</h5>
    <hr class="hr-desa mt-0 mb-2" style="width: 25%">
    <?php if($kategori->count()<1): ?> <div class="alert alert-danger d-flex align-items-center" role="alert">
        <i class="bi bi-exclamation-triangle me-2"></i>
        <div class="font-14">
            Tidak ada Kategori yang tersedia.
        </div>
</div>
<?php else: ?>
<div class="card mb-3">
    <div class="card-body">
        <ul class="remove-dot">
            <?php $__currentLoopData = $kategori; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $k): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
            <li>
                <a href="<?php echo e(route('select.index', ['id'=> $k->id_kategori,'slug'=>$k->slug_kategori])); ?>"
                    class="teks-item-forum remove-underline-just hitam sebaris-block mb-1"><?php echo e($k->nama_kategori); ?></a>
                <span class="badge bg-<?php echo e($k->warna); ?> pull-right"><?php echo e($k->diskusi->count()); ?> Diskusi</span>
            </li>
            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
        </ul>
    </div>
</div>

<?php if($vote_total>0): ?>
<h5>Voting</h5>
<hr class="hr-desa mt-0 mb-2" style="width: 25%">
<?php endif; ?>

<?php $__currentLoopData = $vote; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $d): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
<div id="card_voting_<?php echo e($d['id_vote']); ?>" class="card_voting card mb-2">
    <div class="card-body border">
        <a href="<?php echo e(route('select.detail', ['id'=> $d['id_diskusi'],'slug'=>$d['slug_diskusi']])); ?>"
            class="text-center teks-item-forum remove-underline-just hitam font-18 d-flex justify-content-center mb-1"><?php echo e($d['nama']); ?></a>
        <span class="hr-desa mb-3"><em class="hr-desa"></em></span>
        <?php for($i=1; $i<=$d['total']; $i++): ?> <div id="card_voting_isi_<?php echo e($d['id_vote']); ?>_<?php echo e($i); ?>"
            class="card_voting_isi mb-2 mt-2">
            <div class="d-flex bd-highlight pe-1">
                <div class="p-1 flex-grow-1 bd-highlight">
                    <div class="bar-custom">
                        <div id="progress_custom_<?php echo e($d['id_vote']); ?>_<?php echo e($i); ?>" class="progress-custom bg-desa-rgb"
                            style="width: <?php echo e($d['voting'][$i]['pvote']); ?>">
                        </div>
                        <div id="percent_custom_<?php echo e($d['id_vote']); ?>_<?php echo e($i); ?>" class="percent-custom font-14">
                            <?php echo e($d['voting'][$i]['pvote']); ?>

                        </div>
                        <div class="text-custom font-14">
                            <?php echo e($d['voting'][$i]['vote']); ?>

                            <p id="total_suara_<?php echo e($d['id_vote']); ?>_<?php echo e($i); ?>"
                                class="total-suara text-muted font-12 mb-0 mt-0">(<?php echo e($d['voting'][$i]['tvote']); ?>

                                suara)</p>
                        </div>
                    </div>
                </div>
                <div id="btnVoteCustom_<?php echo e($d['id_vote']); ?>_<?php echo e($i); ?>"
                    class="p-1 ps-1 bd-highlight <?php echo e(($d['status']=='1' || $d['habis'])?'sembunyi':''); ?>">
                    <button <?php echo e(($d['status']=='1')?'disabled':''); ?> data-nama="<?php echo e($d['nama']); ?>"
                        data-vote=" <?php echo e($d['voting'][$i]['vote']); ?>" data-idvote="<?php echo e($d['id_vote']); ?>" data-idurut="<?php echo e($i); ?>"
                        id="btnVoteNow_<?php echo e($d['id_vote']); ?>_<?php echo e($i); ?>" class="btnVoteNow btn btn-outline-success"
                        style="height: 100%" type="button">
                        <i class="bi <?php echo e(($d['status']=='1')?'bi-hand-thumbs-up-fill':'bi-check-lg'); ?> "></i>
                    </button>
                </div>
            </div>
    </div>
    <?php endfor; ?>
    <div class="card-footer p-0 bg-body">
        <p id="suara_masuk_<?php echo e($d['id_vote']); ?>" class="hitam font-12 mb-1 mt-2  ">Suara Masuk : <?php echo e($d['suara_masuk']); ?>

            (<?php echo e($d['suara_masuk_p']); ?>)</p>
        <p class="hitam font-12">Batas Voting : <br> <?php echo e($d['tgl']); ?> (<span
                class="<?php echo e($d['habis']?'merah':'hijau'); ?>"><?php echo e($d['batas']); ?></span>)</p>
        <div id="alert_status_vote_<?php echo e($d['id_vote']); ?>"
            class="alert alert-<?php echo e(($d['status']=='1')?'success':'danger'); ?> d-flex justify-content-center p-1 font-14"
            role="alert">
            <i id="icon_status_vote_<?php echo e($d['id_vote']); ?>"
                class="bi <?php echo e(($d['status']=='1')?'bi-check-circle':'bi-exclamation-triangle'); ?> font-14 me-2"></i>
            <span id="span_status_memilih_<?php echo e($d['id_vote']); ?>">
                Anda <?php echo e(($d['status']=='1')?'Sudah':'Belum'); ?> Memilih Voting.
            </span>
        </div>
    </div>
</div>
</div>
<?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
<?php endif; ?>

</div>

<div id="div_widget_widget" class="sembunyi">

    <nav>
        <div class="nav nav-fill nav-tabs font-14" id="nav-tab" role="tablist">
            <button class="nav-link hitam active" id="nav-berita-tab" data-bs-toggle="tab" data-bs-target="#nav-berita"
                type="button" role="tab" aria-controls="nav-berita" aria-selected="false">Berita</button>
            <button class="nav-link hitam" id="nav-store-tab" data-bs-toggle="tab" data-bs-target="#nav-store"
                type="button" role="tab" aria-controls="nav-store" aria-selected="false">Store</button>
            <button class="nav-link hitam" id="nav-pariwisata-tab" data-bs-toggle="tab" data-bs-target="#nav-pariwisata"
                type="button" role="tab" aria-controls="nav-pariwisata" aria-selected="false">Pariwisata</button>
            
        </div>
    </nav>

    <div class="tab-content" id="nav-tabContent">
        <div class="tab-pane fade show active" id="nav-berita" role="tabpanel" aria-labelledby="nav-kuliner-tab">
            
            
            <div class="card mb-3">
                <div class="card-body">

                    <div class="error_berita sembunyi">
                        <div class="alert alert-danger d-flex align-items-center p-2" role="alert">
                            <i class="bi bi-exclamation-triangle-fill font-14 me-2"></i>
                            <div class="font-12">
                                Server DesaNews tidak tersedia. <a api='berita'
                                    class="refreshApi alert-link cursor">Refresh</a>.
                            </div>
                        </div>
                    </div>

                    <div class="load_berita">
                        <div id="overlay" class="p-4">
                            <div class="cv-spinner">
                                <span class="spinner"></span>
                            </div>
                            <div class="text-center pt-4">
                                <p>Sedang mengambil data ...</p>
                            </div>
                        </div>
                    </div>

                    <div class="main_berita sembunyi">

                    </div>
                </div>
            </div>
        </div>
        <div class="tab-pane fade" id="nav-store" role="tabpanel" aria-labelledby="nav-store-tab">
            
            
            <div class="card mb-3">
                <div class="card-body">

                    <div class="error_store sembunyi">
                        <div class="alert alert-danger d-flex align-items-center p-2" role="alert">
                            <i class="bi bi-exclamation-triangle-fill font-14 me-2"></i>
                            <div class="font-12">
                                Server DesaStore tidak tersedia. <a api='store'
                                    class="refreshApi alert-link cursor">Refresh</a>.
                            </div>
                        </div>
                    </div>

                    <div class="load_store">
                        <div id="overlay" class="p-4">
                            <div class="cv-spinner">
                                <span class="spinner"></span>
                            </div>
                            <div class="text-center pt-4">
                                <p>Sedang mengambil data ...</p>
                            </div>
                        </div>
                    </div>

                    <div class="main_store sembunyi">

                    </div>

                </div>
            </div>
        </div>
        <div class="tab-pane fade" id="nav-pariwisata" role="tabpanel" aria-labelledby="nav-pariwisata-tab">
            <nav>
                <div class="nav nav-fill nav-tabs font-14" id="nav-tab" role="tablist">
                    <button class="nav-link hitam active" id="nav-kuliner-tab" data-bs-toggle="tab"
                        data-bs-target="#nav-kuliner" type="button" role="tab" aria-controls="nav-kuliner"
                        aria-selected="true">Kuliner</button>
                    <button class="nav-link hitam" id="nav-wisata-tab" data-bs-toggle="tab" data-bs-target="#nav-wisata"
                        type="button" role="tab" aria-controls="nav-wisata" aria-selected="false">Wisata</button>
                </div>
            </nav>
            <div class="tab-content" id="nav-tabContent">
                <div class="tab-pane fade show active" id="nav-kuliner" role="tabpanel"
                    aria-labelledby="nav-kuliner-tab">
                    <div class="card mb-3">
                        <div class="card-body">

                            <div class="error_kuliner sembunyi">
                                <div class="alert alert-danger d-flex align-items-center p-2" role="alert">
                                    <i class="bi bi-exclamation-triangle-fill font-14 me-2"></i>
                                    <div class="font-12">
                                        Server DesaTour tidak tersedia. <a api='kuliner'
                                            class="refreshApi alert-link cursor">Refresh</a>.
                                    </div>
                                </div>
                            </div>

                            <div class="load_kuliner">
                                <div id="overlay" class="p-4">
                                    <div class="cv-spinner">
                                        <span class="spinner"></span>
                                    </div>
                                    <div class="text-center pt-4">
                                        <p>Sedang mengambil data ...</p>
                                    </div>
                                </div>
                            </div>

                            <div class="main_kuliner sembunyi">

                            </div>

                        </div>
                    </div>
                </div>
                <div class="tab-pane fade" id="nav-wisata" role="tabpanel" aria-labelledby="nav-profile-tab">
                    <div class="card mb-3">
                        <div class="card-body">

                            <div class="error_wisata sembunyi">
                                <div class="alert alert-danger d-flex align-items-center p-2" role="alert">
                                    <i class="bi bi-exclamation-triangle-fill font-14 me-2"></i>
                                    <div class="font-12">
                                        Server DesaTour tidak tersedia. <a api='wisata'
                                            class="refreshApi alert-link cursor">Refresh</a>.
                                    </div>
                                </div>
                            </div>

                            <div class="load_wisata">
                                <div id="overlay" class="p-4">
                                    <div class="cv-spinner">
                                        <span class="spinner"></span>
                                    </div>
                                    <div class="text-center pt-4">
                                        <p>Sedang mengambil data ...</p>
                                    </div>
                                </div>
                            </div>

                            <div class="main_wisata sembunyi">

                            </div>


                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="tab-pane fade" id="nav-video" role="tabpanel" aria-labelledby="nav-video-tab">

        </div>
    </div>

</div>
<?php /**PATH C:\xampp\htdocs\desacuss_new\resources\views/user/widget_backup.blade.php ENDPATH**/ ?>