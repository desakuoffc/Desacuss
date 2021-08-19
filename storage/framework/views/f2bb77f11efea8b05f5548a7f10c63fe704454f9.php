<?php $__env->startSection('konten'); ?>
<?php echo $__env->make('user.beranda.konten', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
<?php $__env->stopSection(); ?>

<?php $__env->startSection('js'); ?>
<script>
    $(document).ready(function () {

    })

    $(document).on('click', '.btn_like', function () {
        let id_diskusi = $(this).data('diskusi');
        let id_user = $(this).data('user');
        let like = $(this).data('like');

        $(this).effect("pulsate");

        if (id_user == '<?php echo e(auth()->user()->id); ?>') {
            const Toast = Swal.mixin({
                toast: true,
                position: 'top',
                showConfirmButton: false,
                timer: 3000,
                timerProgressBar: true,
                didOpen: (toast) => {
                    toast.addEventListener('mouseenter', Swal.stopTimer)
                    toast.addEventListener('mouseleave', Swal.resumeTimer)
                }
            })

            Toast.fire({
                icon: 'warning',
                title: 'Anda tidak bisa memberi like/unlike kepada diri anda sendiri.'
            })
        } else {
            $.ajax({
                url: "<?php echo e(route('diskusi.update.like')); ?>",
                method: 'post',
                dataType: 'json',
                data: {
                    '_token': "<?php echo e(csrf_token()); ?>",
                    id_diskusi: id_diskusi,
                    id_user: id_user,
                    like: like,
                },
                success: function (data) {
                    let id = data.id;
                    let y = data.y;
                    let n = data.n;
                    let ally = data.ally;
                    let alln = data.alln;

                    $(`#total_like_y_${id}`).text(ally);
                    $(`#total_like_n_${id}`).text(alln);

                    if (y > 0) {
                        $(`#icon_like_n_${id}`).removeClass('bi-hand-thumbs-down-fill merah')
                        $(`#icon_like_n_${id}`).addClass('bi-hand-thumbs-down')

                        $(`#icon_like_y_${id}`).removeClass('bi-hand-thumbs-up')
                        $(`#icon_like_y_${id}`).addClass('bi-hand-thumbs-up-fill hijau-desa')
                    }

                    if (n > 0) {
                        $(`#icon_like_n_${id}`).removeClass('bi-hand-thumbs-down')
                        $(`#icon_like_n_${id}`).addClass('bi-hand-thumbs-down-fill merah')

                        $(`#icon_like_y_${id}`).removeClass('bi-hand-thumbs-up-fill hijau-desa')
                        $(`#icon_like_y_${id}`).addClass('bi-hand-thumbs-up')
                    }
                }
            });
        }

    })

</script>

<?php echo $__env->make('user.js.widget', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('user.master', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\xampp\htdocs\desacuss_new\resources\views/user/beranda/komponen.blade.php ENDPATH**/ ?>