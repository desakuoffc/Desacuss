<nav aria-label="breadcrumb">
    <ol class="breadcrumb">
        <li class="breadcrumb-item"><a class="teks-item-forum hitam remove-underline"
                href="<?php echo e(route('beranda')); ?>">Beranda</a>
        </li>
        <li class="breadcrumb-item active" aria-current="page">Tambah Diskusi</li>
    </ol>
</nav>

<?php echo $__env->make('tambahan.diskusi.tambah', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
<?php /**PATH C:\xampp\htdocs\desacuss\resources\views/user/create/konten.blade.php ENDPATH**/ ?>