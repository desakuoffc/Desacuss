<?php $__env->startSection('konten'); ?>
<?php echo $__env->make('user.detail.konten', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
<?php $__env->stopSection(); ?>

<?php $__env->startSection('js'); ?>
<script>
    $(document).ready(function () {
        $('#sn_komentar').summernote({
            placeholder: 'Tulis komentar disini...',
            lang: 'id-ID',
            tabsize: 2,
            height: 150
        });
    })

    // window.Parsley.addValidator('summernoteRequired', {
    //     validateString: function (value, _value, _el) {
    //         var val = $($(_el.$element[0]).val()).text().trim();
    //         if (val.length < 1) return false;
    //     }
    // });

    $(document).on('click', '#btnSubmitKomentar', function () {
        $('#formKomentar').parsley().validate();
        if ($('#formKomentar').parsley().isValid()) {
            let formDatas = $('#formKomentar').get(0);
            let formPack = new FormData(formDatas);
            formPack.append('_token', '<?php echo e(csrf_token()); ?>')

            swal.fire({
                title: 'KONFIRMASI',
                html: 'Lanjut proses kirim komentar?',
                showCancelButton: !0,
                reverseButtons: !0,
                cancelButtonText: 'Cek lagi',
                confirmButtonText: 'Ya, Lanjut'
            }).then(function (e) {
                if (e.value === true) {
                    getSwalLoading(1, 'Proses Menambahkan Komentar', 'Mohon Tunggu...')
                    $.ajax({
                        url: "<?php echo e(route('select.komentar')); ?>",
                        data: formPack,
                        method: 'post',
                        processData: false,
                        contentType: false,
                        success: function (respon) {
                            getSwalLoading(0, null, null)
                            if (respon.success) {
                                swal.fire({
                                    title: "INFORMASI",
                                    html: respon.message,
                                    icon: "success"
                                }).then(function () {
                                    window.location = respon.url;
                                });

                            } else {
                                swal.fire({
                                    title: 'INFORMASI',
                                    html: respon.message,
                                    icon: 'error'
                                });
                            }
                        },
                        error: function () {
                            getSwalLoading(0, null, null)
                            swal.fire('ERROR', 'Server Bermasalah. Coba Lagi Nanti',
                                'error')
                        }
                    })
                } else {
                    e.dismiss;
                }
            }, function (dismiss) {
                return false;
            })
        }
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
    $(document).on('click', '.btn_like_child', function () {
        let id_balas = $(this).data('balas');
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
                url: "<?php echo e(route('diskusi.update.like.child')); ?>",
                method: 'post',
                dataType: 'json',
                data: {
                    '_token': "<?php echo e(csrf_token()); ?>",
                    id_balas: id_balas,
                    id_user: id_user,
                    like: like,
                },
                success: function (data) {
                    let id = data.id;
                    let y = data.y;
                    let n = data.n;
                    let ally = data.ally;
                    let alln = data.alln;

                    $(`#total_like_y_child_${id}`).text(ally);
                    $(`#total_like_n_child_${id}`).text(alln);

                    if (y > 0) {
                        $(`#icon_like_n_child_${id}`).removeClass('bi-hand-thumbs-down-fill merah')
                        $(`#icon_like_n_child_${id}`).addClass('bi-hand-thumbs-down')

                        $(`#icon_like_y_child_${id}`).removeClass('bi-hand-thumbs-up')
                        $(`#icon_like_y_child_${id}`).addClass('bi-hand-thumbs-up-fill hijau-desa')
                    }

                    if (n > 0) {
                        $(`#icon_like_n_child_${id}`).removeClass('bi-hand-thumbs-down')
                        $(`#icon_like_n_child_${id}`).addClass('bi-hand-thumbs-down-fill merah')

                        $(`#icon_like_y_child_${id}`).removeClass(
                            'bi-hand-thumbs-up-fill hijau-desa')
                        $(`#icon_like_y_child_${id}`).addClass('bi-hand-thumbs-up')
                    }
                }
            });
        }

    })

    $(document).on('click', '#btnShowVoting', function () {
        $('.div_menu_voting').show(600);
        $('#btnShowVoting').fadeOut(600, function () {
            $('#btnHideVoting').fadeIn(600);
        })
    })

    $(document).on('click', '#btnHideVoting', function () {
        $('.div_menu_voting').hide(600);
        $('#btnHideVoting').fadeOut(600, function () {
            $('#btnShowVoting').fadeIn(600);
        })
    })

    //
    $(document).on('click', '#btnShowMusrenbang', function () {
        $('.div_menu_musrenbang').show(600);
        $('#btnShowMusrenbang').fadeOut(600, function () {
            $('#btnHideMusrenbang').fadeIn(600);
        })
    })

    $(document).on('click', '#btnHideMusrenbang', function () {
        $('.div_menu_musrenbang').hide(600);
        $('#btnHideMusrenbang').fadeOut(600, function () {
            $('#btnShowMusrenbang').fadeIn(600);
        })
    })

    $(document).on('click', '.btnShowHideProgMus', function () {
        let data = $(this).data('mus_prog');

        if ($(`#footer_desk_mus_${data}`).is(":hidden")) {
            $(`#footer_desk_mus_${data}`).slideDown(600);
            $(`#btnShowHideProgMus_${data}`).removeClass('btn-outline-success');
            $(`#btnShowHideProgMus_${data}`).addClass('btn-outline-danger');
        } else {
            $(`#footer_desk_mus_${data}`).slideUp(600);
            $(`#btnShowHideProgMus_${data}`).addClass('btn-outline-success');
            $(`#btnShowHideProgMus_${data}`).removeClass('btn-outline-danger');
        }
    })

    $(document).on('click', '.btnKomentarChild', function () {
        let data = $(this).data('value');
        $(`#div_child_komentar_${data}`).slideToggle(600);
        // $(`#div_child_komentar_${data}`).css('display', 'flex');
    })

    $(document).on('click', '.btn_reply_close', function () {
        let data = $(this).data('reply');
        $(`#div_child_komentar_${data}`).slideUp(600);
    })

    $(document).on('click', '.teks_singkat', function () {
        let data = $(this).attr('balas');

        $(`#teks_singkat_${data}`).hide()
        $(`#teks_lengkap_${data}`).slideDown(600)

    })

    $(document).on('click', '.teks_lengkap', function () {
        let data = $(this).attr('balas');

        $(`#teks_lengkap_${data}`).slideUp(300, function () {
            $(`#teks_singkat_${data}`).slideDown(300)
        })
    })

    $(document).on('click', '.btn_reply_balas', function () {
        let data = $(this).data('reply');

        $(`#formBalasChild_${data}`).parsley().validate();
        if ($(`#formBalasChild_${data}`).parsley().isValid()) {
            let formReply = $(`#formBalasChild_${data}`).get(0);
            let formPackReply = new FormData(formReply);
            formPackReply.append('_token', '<?php echo e(csrf_token()); ?>')
            formPackReply.append('id_balas', data);
            swal.fire({
                title: 'KONFIRMASI',
                html: 'Lanjut proses balas komentar?',
                showCancelButton: !0,
                reverseButtons: !0,
                cancelButtonText: 'Cek lagi',
                confirmButtonText: 'Ya, Lanjut'
            }).then(function (e) {
                if (e.value === true) {
                    getSwalLoading(1, 'Proses Menambahkan Komentar', 'Mohon Tunggu...')
                    $.ajax({
                        url: "<?php echo e(route('select.reply')); ?>",
                        data: formPackReply,
                        method: 'post',
                        processData: false,
                        contentType: false,
                        success: function (respon) {
                            getSwalLoading(0, null, null)
                            ht = '';
                            if (respon.success) {
                                swal.fire({
                                    title: "INFORMASI",
                                    html: respon.message,
                                    icon: "success"
                                }).then(function () {
                                    ht +=
                                        `<div id="body_reply_${respon.isi_balas}" class="card-body sembunyi">`;
                                    ht += `<div class="row">`;
                                    ht += `<div class="col-md-3">`;
                                    ht +=
                                        `<div class="p-2 d-flex align-items-center">`;
                                    ht += `<div class="flex-shrink-0">`;
                                    ht +=
                                        `<img class="mx-auto d-block rounded-circle" style="object-fit: cover"`;
                                    ht += `src="${respon.foto}"`;
                                    ht += `width="40"`;
                                    ht += `height="40">`;
                                    ht += `</div>`;
                                    ht += `<div class="flex-grow-1 ms-3">`;
                                    ht += `<p class="mb-0 font-12">`;
                                    ht +=
                                        `<a class="teks-item-forum font-14 remove-underline-just hitam sebaris-block">`;
                                    ht += `${respon.nama}`;
                                    ht += `</a>`;
                                    ht += `</p>`;
                                    ht +=
                                        `<p class="text-muted mt-0 mb-0 font-12">`;
                                    ht += `<span class="text-muted font-12">`;
                                    ht += `${respon.tgl}`;
                                    ht += `</span>`;
                                    ht += `</p>`;
                                    ht += `</div>`;
                                    ht += `</div>`;
                                    ht += `</div>`;
                                    ht += `<div class="col-md-9">`;
                                    ht += `<div class="card mb-3 p-3">`;
                                    ht += `<p>${respon.isi_balas}</p>`;
                                    ht += `</div>`;
                                    ht +=
                                        `<button data-id="${respon.id_balas}" class="btnDeleteReply btn btn-danger btn-sm pull-right">`;
                                    ht += `<i class="bi bi-trash me-2"></i>`;
                                    ht += `Hapus`;
                                    ht += `</button>`;
                                    ht += `</div>`;
                                    ht += `</div>`;
                                    ht += '<hr>';
                                    ht += `</div>`;
                                    $(ht).appendTo(`#daftarReplies_${data}`).fadeIn(
                                        600);
                                    $(`#small_child_${data}`).text(
                                        `${respon.total} Komentar`);
                                    $('.reply_kelas').val('');
                                });

                            } else {
                                swal.fire({
                                    title: 'INFORMASI',
                                    html: respon.message,
                                    icon: 'error'
                                });
                            }
                        },
                        error: function () {
                            getSwalLoading(0, null, null)
                            swal.fire('ERROR', 'Server Bermasalah. Coba Lagi Nanti',
                                'error')
                        }
                    })
                } else {
                    e.dismiss;
                }
            }, function (dismiss) {
                return false;
            })
        }
    })

    $(document).on('click', '.btnDeleteForum', function () {
        let id = $(this).data('id');
        swal.fire({
            title: 'KONFIRMASI',
            html: 'Hapus Forum?',
            icon: 'warning',
            showCancelButton: !0,
            reverseButtons: !0,
            cancelButtonText: 'Cek lagi',
            confirmButtonText: 'Ya, Hapus'
        }).then(function (e) {
            if (e.value === true) {
                $.ajax({
                    url: "<?php echo e(route('select.delete.forum')); ?>",
                    data: {
                        "_token": "<?php echo e(csrf_token()); ?>",
                        id: id
                    },
                    method: 'post',
                    success: function (respon) {
                        ht = '';
                        if (respon.success) {
                            swal.fire({
                                title: "INFORMASI",
                                html: respon.message,
                                icon: "success"
                            }).then(function () {
                                window.location = "<?php echo e(route('beranda')); ?>"
                            });

                        } else {
                            swal.fire({
                                title: 'INFORMASI',
                                html: respon.message,
                                icon: 'error'
                            });
                        }
                    }
                })
            } else {
                e.dismiss;
            }
        }, function (dismiss) {
            return false;
        })
    })

    $(document).on('click', '.btnDeleteBalas', function () {
        let id = $(this).data('id');
        swal.fire({
            title: 'KONFIRMASI',
            html: 'Hapus komentar?',
            icon: 'warning',
            showCancelButton: !0,
            reverseButtons: !0,
            cancelButtonText: 'Tidak',
            confirmButtonText: 'Ya, Hapus'
        }).then(function (e) {
            if (e.value === true) {
                $.ajax({
                    url: "<?php echo e(route('select.delete.reply')); ?>",
                    data: {
                        "_token": "<?php echo e(csrf_token()); ?>",
                        id: id,
                        tipe: "main"
                    },
                    method: 'post',
                    success: function (respon) {
                        ht = '';
                        if (respon.success) {
                            swal.fire({
                                title: "INFORMASI",
                                html: respon.message,
                                icon: "success"
                            }).then(function () {
                                $(`.total_komentar_parent`).text(
                                    `${respon.total} Komentar`);
                                $(`#daftarReplies_${id}`).hide(600,
                                    function () {
                                        $(this).remove();
                                    })
                                $(`#div_child_komentar_${id}`).hide(600,
                                    function () {
                                        $(this).remove();
                                    })
                                $(`#card_komentar_${id}`).slideUp(600,
                                    function () {
                                        $(this).remove();

                                    })
                            });

                        } else {
                            swal.fire({
                                title: 'INFORMASI',
                                html: respon.message,
                                icon: 'error'
                            });
                        }
                    }
                })
            } else {
                e.dismiss;
            }
        }, function (dismiss) {
            return false;
        })
    })

    $(document).on('click', '.btnDeleteReply', function () {
        let id = $(this).data('id');
        swal.fire({
            title: 'KONFIRMASI',
            html: 'Hapus komentar?',
            icon: 'warning',
            showCancelButton: !0,
            reverseButtons: !0,
            cancelButtonText: 'Cek lagi',
            confirmButtonText: 'Ya, Hapus'
        }).then(function (e) {
            if (e.value === true) {
                $.ajax({
                    url: "<?php echo e(route('select.delete.reply')); ?>",
                    data: {
                        "_token": "<?php echo e(csrf_token()); ?>",
                        id: id,
                        tipe: "child"
                    },
                    method: 'post',
                    success: function (respon) {
                        ht = '';
                        if (respon.success) {
                            swal.fire({
                                title: "INFORMASI",
                                html: respon.message,
                                icon: "success"
                            }).then(function () {
                                $(`#small_child_${respon.id}`).text(
                                    `${respon.total} Komentar`);
                                $(`#body_reply_${id}`).slideUp(600, function () {
                                    $(this).remove();
                                })
                            });

                        } else {
                            swal.fire({
                                title: 'INFORMASI',
                                html: respon.message,
                                icon: 'error'
                            });
                        }
                    }
                })
            } else {
                e.dismiss;
            }
        }, function (dismiss) {
            return false;
        })
    })

</script>



<?php echo $__env->make('user.js.widget', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('user.master', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\xampp\htdocs\desacuss_new\resources\views/user/detail/komponen.blade.php ENDPATH**/ ?>