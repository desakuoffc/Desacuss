<div class="card border-primary mb-3">
    <div class="card-header bg-white">
        <span class="font-16">VOTING <?php echo e(strtoupper($discuss->nama_diskusi)); ?></span>
        <button id="btnShowVoting" class="btn btn-outline-success btn-sm pull-right">Tampilkan</button>
        <button id="btnHideVoting" class="btn btn-outline-success btn-sm pull-right sembunyi">Sembunyikan</button>
    </div>
    <div class="div_menu_voting sembunyi card-body">
        <?php for($i=1; $i<=$votes['total']; $i++): ?> <div class="mb-3">
            <label class="form-label"><?php echo e($votes['voting'][$i]['vote']); ?> (<?php echo e($votes['voting'][$i]['tvote']); ?> suara)</label>
            <div class="progress">
                <div class="progress-bar" role="progressbar" style="width: <?php echo e($votes['voting'][$i]['pvote']); ?>;"
                    aria-valuenow="<?php echo e($votes['voting'][$i]['tvote']); ?>" aria-valuemin="0" aria-valuemax="100">
                    <?php echo e($votes['voting'][$i]['pvote']); ?></div>
            </div>
    </div>
    <?php endfor; ?>

</div>
<div class="div_menu_voting sembunyi card-footer bg-white">
    <p class="hitam font-14 mb-1 mt-2">Suara Masuk : <?php echo e($votes['suara_masuk']); ?>

        (<?php echo e($votes['suara_masuk_p']); ?>)</p>
    <p class="hitam font-14">Batas Voting : <?php echo e($votes['tgl']); ?> (<span
            class="<?php echo e($votes['habis']?'merah':'hijau'); ?>"><?php echo e($votes['batas']); ?></span>)</p>
    <div class="alert alert-<?php echo e(($votes['status']=='1')?'success':'danger'); ?> d-flex justify-content-center p-1 font-14"
        role="alert">
        <i class="bi <?php echo e(($votes['status']=='1')?'bi-check-circle':'bi-exclamation-triangle'); ?> font-24 me-2"></i>
        <span class="d-flex align-items-center">
            Anda <?php echo e(($votes['status']=='1')?'Sudah':'Belum'); ?> Memilih Voting.
        </span>
    </div>
</div>
</div>
<?php /**PATH C:\xampp\htdocs\desacuss\resources\views/user/detail/konten_vote.blade.php ENDPATH**/ ?>