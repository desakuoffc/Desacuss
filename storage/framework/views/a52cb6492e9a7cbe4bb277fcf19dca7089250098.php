<?php $__env->startComponent('mail::message'); ?>
<p class="arabic" style="text-align: center">بِسْمِ ٱللَّٰهِ ٱلرَّحْمَٰنِ ٱلرَّحِيمِ</p>
<h2>Hallo, <?php echo e($nama); ?></h2>
<?php echo $isi; ?>

<?php echo $pesan; ?>


<?php $__env->startComponent('mail::button', ['url' => $link ]); ?>
<?php echo e($button); ?>

<?php if (isset($__componentOriginalb8f5c8a6ad1b73985c32a4b97acff83989288b9e)): ?>
<?php $component = $__componentOriginalb8f5c8a6ad1b73985c32a4b97acff83989288b9e; ?>
<?php unset($__componentOriginalb8f5c8a6ad1b73985c32a4b97acff83989288b9e); ?>
<?php endif; ?>
<?php echo $__env->renderComponent(); ?>

Terima Kasih,<br>
Desaku.<br>
<?php echo e($tgl); ?>

<?php if (isset($__componentOriginal2dab26517731ed1416679a121374450d5cff5e0d)): ?>
<?php $component = $__componentOriginal2dab26517731ed1416679a121374450d5cff5e0d; ?>
<?php unset($__componentOriginal2dab26517731ed1416679a121374450d5cff5e0d); ?>
<?php endif; ?>
<?php echo $__env->renderComponent(); ?>
<?php /**PATH C:\xampp\htdocs\desacuss\resources\views/email/verif.blade.php ENDPATH**/ ?>