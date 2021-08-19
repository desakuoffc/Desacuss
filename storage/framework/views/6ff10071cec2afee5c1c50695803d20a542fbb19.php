<!doctype html>
<html lang="en">

<head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.1/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-+0n0xVW2eSR5OomGNYDnhzAbDsOXxcvSN1TPprVMTNDbiYZCxYbOOl7+AMvyTG2x" crossorigin="anonymous">
    <link rel="stylesheet" href="<?php echo e(asset('notif/bootstrap-notifications.min.css')); ?>">

    
    <link rel="stylesheet"
        href="https://cdn.jsdelivr.net/npm/bootstrap-select@1.14.0-beta2/dist/css/bootstrap-select.min.css">

    
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.5.0/font/bootstrap-icons.css">

    
    <link rel="stylesheet" href="//code.jquery.com/ui/1.12.1/themes/base/jquery-ui.css">

    
    
    <link rel="stylesheet" href="https://cdn.datatables.net/1.10.25/css/dataTables.bootstrap5.min.css">

    
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/boxicons@latest/css/boxicons.min.css">

    
    <link href="http://maxcdn.bootstrapcdn.com/font-awesome/4.1.0/css/font-awesome.min.css" rel="stylesheet">

    
    <link rel="stylesheet" href="<?php echo e(asset('swal/sweetalert2.min.css')); ?>">

    
    <link rel="stylesheet" href="<?php echo e(asset('parsley/css/parsley.css')); ?>">

    
    <link rel="stylesheet" href="<?php echo e(asset('summernote/summernote-lite.min.css')); ?>">

    <!-- the fileinput plugin styling CSS file -->
    <link href="https://cdn.jsdelivr.net/gh/kartik-v/bootstrap-fileinput@5.2.2/css/fileinput.min.css" media="all"
        rel="stylesheet" type="text/css" />

    
    <link rel="stylesheet" href="<?php echo e(asset('admin/css/main.css')); ?>">
    <link rel="stylesheet" href="<?php echo e(asset('admin/css/teks.css')); ?>">
    <link rel="stylesheet" href="<?php echo e(asset('admin/css/warna.css')); ?>">

    <title>FORUM DISKUSI</title>
</head>

<body id="body-pd">

    <?php echo $__env->make('admin.header', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
    <?php echo $__env->yieldContent('konten'); ?>
    <?php echo $__env->yieldContent('modal'); ?>


    
    <div class="modal fade" id="modalLoadingAll" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1"
        aria-labelledby="staticBackdropLabel" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content">
                <div id="overlay" class="p-4">
                    <div class="cv-spinner">
                        <span class="spinner"></span>
                    </div>
                    <div class="text-center pt-4">
                        <p class="teksLoadingAll"></p>
                    </div>
                </div>
            </div>
        </div>
    </div>
    
    <?php echo $__env->make('user.canvas', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
</body>

<script src="https://code.jquery.com/jquery-3.5.1.js"></script>
<script src="https://code.jquery.com/ui/1.12.1/jquery-ui.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.9/umd/popper.min.js"
    integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q" crossorigin="anonymous">
</script>
<script src="<?php echo e(asset('admin/js/datepicker-id.js')); ?>"></script>
<script src="https://js.pusher.com/4.1/pusher.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.1/dist/js/bootstrap.bundle.min.js"
    integrity="sha384-gtEjrD/SeCtmISkJkNUaaKMoLD0//ElJ19smozuHV6z3Iehds+3Ulb9Bn9Plx0x4" crossorigin="anonymous">
</script>

<script src="https://cdn.jsdelivr.net/npm/bootstrap-select@1.14.0-beta2/dist/js/bootstrap-select.min.js"></script>
<script src="https://cdn.datatables.net/1.10.25/js/jquery.dataTables.min.js"></script>
<script src="https://cdn.datatables.net/1.10.25/js/dataTables.bootstrap5.min.js"></script>

<!-- kartik -->
<script src="https://cdn.jsdelivr.net/gh/kartik-v/bootstrap-fileinput@5.2.2/js/plugins/piexif.min.js"
    type="text/javascript"></script>
<script src="https://cdn.jsdelivr.net/gh/kartik-v/bootstrap-fileinput@5.2.2/js/plugins/sortable.min.js"
    type="text/javascript"></script>
<script src="https://cdn.jsdelivr.net/gh/kartik-v/bootstrap-fileinput@5.2.2/js/fileinput.min.js"></script>
<script src="https://cdn.jsdelivr.net/gh/kartik-v/bootstrap-fileinput@5.2.2/js/locales/id.js"></script>


<script src="<?php echo e(asset('summernote/summernote-lite.min.js')); ?>"></script>
<script src="<?php echo e(asset('summernote/lang/summernote-id-ID.min.js')); ?>"></script>

<script src="<?php echo e(asset('parsley/js/parsley.min.js')); ?>"></script>
<script src="<?php echo e(asset('parsley/js/id.js')); ?>"></script>
<script src="<?php echo e(asset('swal/sweetalert2.min.js')); ?>"></script>

<script>
    var asset = "<?php echo e(asset('/img/')); ?>/";
    var abc = "<?php echo e(route('notif.delete')); ?>"
    var prox = "data_<?php echo e(auth()->user()->id); ?>";
    var cba = "<?php echo e(csrf_token()); ?>";
    var abcz = "<?php echo e(route('notif.delete.all')); ?>";

</script>

<script src="<?php echo e(asset('admin/js/main.js')); ?>"></script>
<script src="<?php echo e(asset('admin/js/pusher.js')); ?>"></script>
<?php echo $__env->make('user.js.pusher', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
<?php echo $__env->yieldContent('js'); ?>

</html>
<?php /**PATH C:\xampp\htdocs\desacuss\resources\views/admin/master.blade.php ENDPATH**/ ?>