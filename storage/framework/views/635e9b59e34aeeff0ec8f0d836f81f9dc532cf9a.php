<script>
    // BAGIAN PROGRESS
    $(document).on('click', '.btnEditProg', function () {
        let id = $(this).data('id');
        let nama = $(this).data('name');
        let status = $(this).attr('id');
        resetMenuProg();
        getProgress(id, nama, status);
        $('#data-progress').data('progres', id);
        $('#data-progress-name').data('progresName', nama);
        $('#modalShowProgMusrenbang').modal('show');
        // alert('prog')
    })

    $('#modalShowProgMusrenbang').on('hidden.bs.modal', function (e) {
        resetMenuProg();
        $('#data-progress').data('progres', 0);
        $('#data-progress-name').data('progresName', 0);
        $('.div_card_progress').empty();
    })

    $(document).on('click', '.btnDetailProgShow', function () {
        let id = $(this).attr('prog');
        $(`#desk_prog_${id}`).slideToggle('600');
    })

    $(document).on('click', '.btn_show_tambah_prog', function () {
        $('#div_daftar_prog').hide(600, function () {
            $('#div_tambah_prog').show(600);
        })
    })

    $(document).on('click', '.btn_close_tambah_prog', function () {
        swal.fire({
            title: 'KONFIRMASI',
            html: 'Tutup menu tambah progress musrenbang?<br>Data yang sudah diisi akan terhapus.',
            icon: 'warning',
            reverseButtons: !0,
            showCancelButton: !0,
            confirmButtonText: 'Ya, Tutup',
            cancelButtonText: 'Tidak'
        }).then(function (e) {
            if (e.value === true) {
                resetMenuProg();
            } else {
                e.dismiss;
            }
        }, function (dismiss) {
            return false
        })
    })

    $(document).on('click', '.btnEditProgShow', function () {
        let id = $(this).attr('prog');

        $.ajax({
            url: "<?php echo e(route('musrenbang.prog.edit')); ?>",
            data: {
                "_token": "<?php echo e(csrf_token()); ?>",
                id: id
            },
            method: "post",
            dataType: 'json',
            success: function (data) {
                $('#valProg').val(data.id_musrenbang_prog);
                $('#valMusProg').val(data.id_musrenbang);
                $('#nama_musrenbang_prog_new').val(data.nama_musrenbang_prog)
                $('#deskmusrenbang_prog_new').val(data.deskripsi_musrenbang_prog)
                $('#tgl_start_prog_new').val(data.tgl_start_prog)
                $('#tgl_end_prog_new').val(data.tgl_end_prog)
            },
            complete: function (data) {
                $('#title_text_progress').text('Edit Progress');
                $('#btnActionProg').text('Update')
                $('#btnActionProg').attr('aksi', 'Update');
                $('#actionProg').val('Update');
                $('#valProg').val(id);

                $('#div_daftar_prog').hide(600, function () {
                    $('#div_tambah_prog').show(600);
                })
            }
        });
    })

    $(document).on('click', '.btnDeleteProgShow', function () {
        let id = $(this).attr('prog');
        let name = $(this).attr('progname');

        swal.fire({
            title: 'KONFIRMASI',
            html: `Hapus program musrenbang <b>${name}</b>?`,
            icon: 'warning',
            reverseButtons: !0,
            showCancelButton: !0,
            confirmButtonText: 'Ya, Hapus',
            cancelButtonText: 'Tidak'
        }).then(function (e) {
            if (e.value === true) {
                getSwalLoading(1, 'Proses Penghapusan Data Musrenbang', 'Mohon Tunggu...')
                $.ajax({
                    url: "<?php echo e(route('musrenbang.prog.delete')); ?>",
                    data: {
                        "_token": "<?php echo e(csrf_token()); ?>",
                        id: id
                    },
                    method: "post",
                    dataType: 'json',
                    success: function (data) {
                        getSwalLoading(0, null, null)
                        if (data.success) {
                            swal.fire({
                                title: 'INFORMASI',
                                html: data.message,
                                icon: 'success'
                            })
                            $('#tabel_musrenbang').DataTable().ajax.reload();
                            $(`#card_progress_${id}`).hide(1100, function () {
                                $(this).remove();
                                getProgress(
                                    $('#data-progress').data('progres'),
                                    $('#data-progress-name').data(
                                        'progresName'),
                                    'progres');
                            })

                            resetMenuProg();
                        } else {
                            swal.fire({
                                title: 'INFORMASI',
                                html: data.message,
                                icon: 'error'
                            })
                        }
                    },
                    error: function () {
                        getSwalLoading(0, null, null)
                        swal.fire('ERROR', 'Server Bermasalah. Coba Lagi Nanti', 'error')
                    }
                });
            } else {
                e.dismiss;
            }
        }, function (dismiss) {
            return false
        })
    })

    $(document).on('click', '#btnActionProg', function () {
        $('#tambah_form_prog').parsley().validate();
        if ($('#tambah_form_prog').parsley().isValid()) {
            let formDatas = $('#tambah_form_prog').get(0);
            let formPack = new FormData(formDatas);
            swal.fire({
                title: 'KONFIRMASI',
                html: 'Data sudah sesuai? lanjutkan proses?',
                showCancelButton: !0,
                reverseButtons: !0,
                cancelButtonText: 'Cek lagi',
                confirmButtonText: 'Ya, Lanjut'
            }).then(function (e) {
                if (e.value === true) {
                    getSwalLoading(1, 'Proses Penambahan Data Progress Musrenbang', 'Mohon Tunggu...')
                    $.ajax({
                        url: "<?php echo e(route('musrenbang.prog.create')); ?>",
                        data: formPack,
                        method: 'post',
                        dataType: 'json',
                        processData: false,
                        contentType: false,
                        success: function (respon) {
                            getSwalLoading(0, null, null)
                            if (respon.success) {
                                swal.fire({
                                    title: 'INFORMASI',
                                    html: respon.message,
                                    icon: 'success'
                                })
                                $('#tabel_musrenbang').DataTable().ajax.reload();
                                getProgress(
                                    $('#data-progress').data('progres'),
                                    $('#data-progress-name').data('progresName'),
                                    'progres');
                                resetMenuProg();
                            } else {
                                swal.fire({
                                    title: 'INFORMASI',
                                    html: respon.message,
                                    icon: 'error'
                                })
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

    function getProgress(id, nama, status) {
        $.ajax({
            url: "<?php echo e(route('musrenbang.edit')); ?>",
            data: {
                "_token": "<?php echo e(csrf_token()); ?>",
                id: id,
                nama: nama,
                status: status,
            },
            method: "post",
            dataType: 'json',
            success: function (data) {
                let ht = '';

                $('#card_title_progres').html(`Total Progress Musrenbang : ${data.length}`);
                $('#valMusProg').val(id);

                for (let index = 0; index < data.length; index++) {
                    ht += ``;

                    ht +=
                        `<div class="card_proggress card p-3 mb-3 sembunyi" id="card_progress_${data[index].id}">`;

                    ht += `<div class="d-flex position-relative">`;
                    ht += `<div>`;
                    ht += `<p class="modal-title font-18">${data[index].nama}</p>`;
                    ht += `<span class="text-muted font-12">`;
                    ht += `<i class="bi bi-calendar-range"></i> ${data[index].tgl}`;
                    ht += `</span>`;
                    ht += `</div>`;

                    ht +=
                        `<div class="btn-toolbar d-flex position-relative ms-auto" role="toolbar"`;
                    ht += `aria-label="Toolbar with button groups">`;
                    ht +=
                        `<div class="btn-group btn-group-sm me-2" role="group" aria-label="First group">`;
                    ht +=
                        `<button data-bs-toggle="tooltip" data-bs-placement="top" title="Deskripsi Progress" type="button" prog="${data[index].id}" class="btnDetailProgShow btn btn-outline-success"><i class="bi bi-menu-button"></i></button>`;
                    ht += `</div>`;
                    ht +=
                        `<div class="btn-group btn-group-sm me-2" role="group" aria-label="Second group">`;
                    ht +=
                        `<button type="button" prog="${data[index].id}" class="btnEditProgShow btn btn-outline-primary"><i class="bi bi-pencil"></i></button>`;
                    ht +=
                        `<button type="button" prog="${data[index].id}" progname="${data[index].nama}" class="btnDeleteProgShow btn btn-outline-danger"><i class="bi bi-trash"></i></button>`;
                    ht += `</div>`;
                    ht += `</div>`;
                    ht += `</div>`;

                    ht +=
                        `<div id="desk_prog_${data[index].id}" class="desk_prog_class card-footer mt-4 bg-white sembunyi">`;
                    ht += `<div class="card-text text-muted">Deskripsi Progress</div>`;
                    ht +=
                        `<div class="card-text" id="card_text_prog_${data[index].id_musrenbang_prog}">`;
                    ht += `${data[index].desk}`;
                    ht += `</div>`;
                    ht += `</div>`;
                    ht += `</div>`;

                    ht += `</div>`;
                }

                $('.div_card_progress').html(ht);

                $(".card_proggress").first().show('slow', function showNext() {
                    $(this).next(".card_proggress").show('slow', showNext);
                });

            }
        })
    }

    function resetMenuProg() {
        $('#tambah_form_prog')[0].reset();
        $('#title_text_progress').text('Tambah Progress');
        $('#btnActionProg').text('Tambah')
        $('#btnActionProg').attr('aksi', 'Tambah');
        $('#actionProg').val('Tambah');
        $('#valProg').val('');
        $('#valMusProg').val('');
        $('.desk_prog_class').hide();

        $('#div_tambah_prog').hide(600, function () {
            $('#div_daftar_prog').show(600);
        })

    }

    // END BAGIAN PROGRESS

</script>
<?php /**PATH C:\xampp\htdocs\desacuss_new\resources\views/admin/musrenbang/js_pack/jsprogress.blade.php ENDPATH**/ ?>