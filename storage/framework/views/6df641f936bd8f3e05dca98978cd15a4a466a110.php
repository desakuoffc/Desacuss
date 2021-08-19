<script type="text/javascript">
    $(document).on('click', '#submit_daftar', function () {
        $('#form-daftar').parsley().validate();
        if ($('#form-daftar').parsley().isValid()) {
            let formDatas = $('#form-daftar').get(0);
            let formPack = new FormData(formDatas);

            swal.fire({
                title: 'KONFIRMASI',
                text: 'Data sudah sesuai? lanjutkan proses daftar?',
                showCancelButton: !0,
                reverseButtons: !0,
                confirmButtonText: "Ya, Lanjut",
                cancelButtonText: 'Cek Lagi'
            }).then(function (e) {
                getSwalLoading(1, 'Proses Pendaftaran Akun', 'Mohon Tunggu...')
                if (e.value === true) {
                    $.ajax({
                        url: "<?php echo e(route('daftar.first')); ?>",
                        method: "POST",
                        data: formPack,
                        contentType: false,
                        cache: false,
                        processData: false,
                        dataType: "json",
                        success: function (data) {
                            getSwalLoading(0, null, null)
                            $('#modalLoading').modal('hide')
                            if (data.success) {
                                swal.fire({
                                    title: 'INFORMASI',
                                    html: data.message,
                                    icon: 'success'
                                }).then(function () {
                                    window.location.href = "<?php echo e(route('login')); ?>"
                                });

                            } else {
                                swal.fire(
                                    "Failed!", data.errors, "error");
                            }
                        },
                        error: function () {
                            getSwalLoading(0, null, null)
                            swal.fire(
                                "Failed!", 'Server bermasalah, coba lagi nanti', "error"
                            );
                        }
                    });
                } else {
                    e.dismiss;
                }
            }, function (dismiss) {
                return false;
            })
        }
    })

    $(document).on('click', '#passwordBaruShow', function () {
        if ($('#password').attr('type') == 'password') {
            $(this).removeClass('fa-eye-slash')
            $('#password').attr('type', 'text')
            $(this).addClass('fa-eye')
        } else if ($('#password').attr('type') == 'text') {
            $(this).removeClass('fa-eye')
            $('#password').attr('type', 'password')
            $(this).addClass('fa-eye-slash')
        }
    })

    $(document).on('click', '#passwordKonfirmasiBaruShow', function () {
        if ($('#password-confirm').attr('type') == 'password') {
            $(this).removeClass('fa-eye-slash')
            $('#password-confirm').attr('type', 'text')
            $(this).addClass('fa-eye')
        } else if ($('#password-confirm').attr('type') == 'text') {
            $(this).removeClass('fa-eye')
            $('#password-confirm').attr('type', 'password')
            $(this).addClass('fa-eye-slash')
        }
    })

    $(document).on('keyup', "#email", function () {
        var email = $(this).val().trim();
        if (email != '') {
            $.ajax({
                url: "<?php echo e(route('cek.email')); ?>",
                type: 'post',
                data: {
                    "_token": "<?php echo e(csrf_token()); ?>",
                    email: email
                },
                success: function (response) {
                    var red =
                        '<div class="error-message-custom pull-left"><ul class="merah remove-dot"><li style="font-size: 0.9em;color: #B94A48;">Email sudah terdaftar, mohon gunakan email lain.</li></ul></div>';
                    if (response == 1) {
                        $('.btn-confirm-email').attr('disabled', true);
                        $('#uname_response_email').html(red);
                    } else {
                        $('.btn-confirm-email').attr('disabled', false);
                        $("#uname_response_email").html("");
                    }
                }
            });
        } else {
            $("#uname_response_email").html("");
        }
    });

    $(document).on('keyup', "#no_ktp", function () {
        var no_ktp = $(this).val().trim();
        if (no_ktp != '') {
            $.ajax({
                url: "<?php echo e(route('cek.ktp2')); ?>",
                type: 'post',
                data: {
                    "_token": "<?php echo e(csrf_token()); ?>",
                    no_ktp: no_ktp
                },
                success: function (response) {
                    var red =
                        '<div class="error-message-custom pull-left"><ul class="merah remove-dot"><li style="font-size: 0.9em;color: #B94A48;">No.KTP sudah terdaftar.</li></ul></div>';
                    if (response == 1) {
                        $('.btn-confirm-email').attr('disabled', true);
                        $('#uname_response_ktp').html(red);
                    } else {
                        $('.btn-confirm-email').attr('disabled', false);
                        $("#uname_response_ktp").html("");
                    }
                }
            });
        } else {
            $("#uname_response_ktp").html("");
        }
    });

    $("#input-b6").fileinput({
        elErrorContainer: '#kartik-file-errors',
        showUpload: false,
        dropZoneEnabled: false,
        maxFileCount: 1,
        mainClass: "input-group-sm",
        language: 'id',
    });

    $("#input-b66").fileinput({
        elErrorContainer: '#kartik-file-errors2',
        showUpload: false,
        dropZoneEnabled: false,
        maxFileCount: 1,
        mainClass: "input-group-sm",
        language: 'id',
    });

    $('#foto_profile_box').on('click', function () {
        if ($(this).is(":checked")) {
            $('#input-b66').attr({
                'required': false,
            }).val('');
            $(this).val('1');
        } else {
            $('#input-b66').attr({
                'required': true,
            });
            $(this).val('0')
        }
    })

    $.ajax({
        url: "<?php echo e(route('wil.kota')); ?>",
        data: {
            "_token": "<?php echo e(csrf_token()); ?>",
            id: 32
        },
        method: 'post',
        dataType: 'json',
        success: function (respon) {
            $("#listKota").empty();
            $.each(respon, function (id, name) {
                $('#listKota').append(new Option(name, id)).selectpicker('refresh');
            })
        }
    })

    $(document).on('change', '#listKota', function () {
        $.ajax({
            url: "<?php echo e(route('wil.kec')); ?>",
            data: {
                "_token": "<?php echo e(csrf_token()); ?>",
                id: $(this).val()
            },
            method: 'post',
            dataType: 'json',
            success: function (respon) {
                $('#listKec').empty();
                $.each(respon, function (id, name) {
                    $('#listKec').append(new Option(name, id)).selectpicker('refresh');
                })
            }
        })
    })

    $(document).on('change', '#listKec', function () {
        $.ajax({
            url: "<?php echo e(route('wil.desa')); ?>",
            data: {
                "_token": "<?php echo e(csrf_token()); ?>",
                id: $(this).val()
            },
            method: 'post',
            dataType: 'json',
            success: function (respon) {
                $('#listDesa').empty();
                $.each(respon, function (id, name) {
                    $('#listDesa').append(new Option(name, id)).selectpicker('refresh');
                })
            }
        })
    })

    $(function () {
        var $sections = $('.form-bagian');

        function navigateTo(index) {
            // Mark the current section with the class 'current'
            $sections
                .removeClass('current')
                .eq(index)
                .addClass('current');
            // Show only the navigation buttons that make sense for the current section:
            $('.form-navigation .previous').toggle(index > 0);
            var atTheEnd = index >= $sections.length - 1;
            $('.form-navigation .next').toggle(!atTheEnd);
            $('.form-navigation [id=submit_daftar]').toggle(atTheEnd);
        }

        function curIndex() {
            // Return the current index by looking at which section has the class 'current'
            return $sections.index($sections.filter('.current'));
        }

        // Previous button is easy, just go back
        $('.form-navigation .previous').click(function () {
            navigateTo(curIndex() - 1);
        });

        // Next button goes forward iff current block validates
        $('.form-navigation .next').click(function () {
            $('.form-daftar').parsley().whenValidate({
                group: 'block-' + curIndex()
            }).done(function () {
                navigateTo(curIndex() + 1);
            });
        });

        // Prepare sections by setting the `data-parsley-group` attribute to 'block-0', 'block-1', etc.
        $sections.each(function (index, section) {
            $(section).find(':input').attr('data-parsley-group', 'block-' + index);
        });
        navigateTo(0); // Start at the beginning
    });

</script>
<?php /**PATH C:\xampp\htdocs\desacuss\resources\views/layouts/registerjs.blade.php ENDPATH**/ ?>