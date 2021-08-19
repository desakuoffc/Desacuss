<?php $__env->startSection('konten'); ?>
<?php echo $__env->make('admin.musrenbang.konten', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
<?php echo $__env->make('admin.musrenbang.modal', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
<?php $__env->stopSection(); ?>

<?php $__env->startSection('js'); ?>
<script src="<?php echo e(asset('admin/js/develoka.js')); ?>"></script>
<script src="<?php echo e(asset('admin/js/dual.js')); ?>"></script>
<?php echo $__env->make('admin.musrenbang.js', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
<?php echo $__env->make('admin.musrenbang.jsaddmusrenbang', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('admin.master', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\xampp\htdocs\desacuss_new\resources\views/admin/musrenbang/komponen.blade.php ENDPATH**/ ?>