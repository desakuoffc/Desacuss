<script>
    $(document).ready(function () {
        if ("<?php echo e($data); ?>" == 1) {
            swal.fire({
                title: "INFORMASI",
                icon: 'warning',
                text: "<?php echo e($message); ?>",
                showConfirmButton: true,
            })
        } else if ("<?php echo e($data); ?>" == 2) {
            swal.fire({
                title: "INFORMASI",
                icon: 'error',
                html: "<p style='font-size:16px;'><?php echo e($message); ?><br><br> <b>Pesan :</b> <br><?php echo e($pesan); ?></p>",
                showConfirmButton: true,
                showCancelButton: true,
                confirmButtonText: 'Perbaiki Data',
                cancelButtonText: 'Close',
                confirmButtonColor: 'green',
                cancelButtonColor: 'red'
            }).then(function (e) {
                if (e.value === true) {
                    perbaiki_data();
                } else {
                    e.dismiss;
                }
            }, function (dismiss) {
                return false;
            })
        };

        $('#btnLogin').on('click', function () {
            let email = document.getElementById("emaillogin").value;
            var pw = document.getElementById("password").value;
            if (pw != '' && email != '') {
                if (/^\w+([\.-]?\w+)*@\w+([\.-]?\w+)*(\.\w{2,3})+$/.test(email)) {
                    $('#error_email').text('')
                    $('#teksLogin').fadeOut(200, function () {
                        $('#loadingLogin').fadeIn(200)
                    })
                } else {
                    $('#error_email').text('Gunakan format email (@).')
                }
            }
        })
    });

</script>
<?php /**PATH C:\xampp\htdocs\desacuss\resources\views/layouts/loginjs.blade.php ENDPATH**/ ?>