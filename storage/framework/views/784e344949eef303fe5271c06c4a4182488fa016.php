<script>
    $(document).on('click', '.btnEditAnggota', function () {
        let id = $(this).data('id');
        let nama = $(this).data('name');
        let status = $(this).attr('id');
        getSwalLoading(1, 'Proses Pengambilan Data Musrenbang', 'Mohon Tunggu...')
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
                getSwalLoading(0, null, null)
                $('#div_list_anggota').empty();
                $('#div_list_anggota_not').empty();
                let ht = '';
                let ht_not = '';
                $('#text_total_anggota').text(`Total Anggota: ${data.eksis.total}`);
                $('#text_total_anggota_not').text(`Total Bukan Anggota: ${data.not_eksis.total}`);
                $('#btnDeleteMultiAnggota').attr('musrenbang', data.eksis.id_musrenbang);
                $('#btnTambahMultiAnggota').attr('musrenbang', data.eksis.id_musrenbang);

                for (let index = 0; index < data.eksis.total; index++) {
                    ht +=
                        `<div id="edt_urut_user_${data.eksis[index].id_user}" class="urut_user mb-2 d-flex position-relative border-custom p-2">`;

                    ht += `<div class="me-2 mt-auto mb-auto">`;
                    ht +=
                        `<input id="cekBoxAnggota_${data.eksis[index].id}" class="cekBoxAnggota form-check-input sembunyi" musrenbang="${data.eksis.id_musrenbang}" email="${data.eksis[index].email}" foto="${data.eksis[index].foto}" nama="${data.eksis[index].nama}" user="${data.eksis[index].id_user}"`;
                    ht += `type="checkbox" value="" id="flexCheckDefault">`;
                    ht += `</div>`;

                    ht += `<div class="me-3">`;
                    ht +=
                        `<img class="edt_foto_user" id="edt_foto_user_${data.eksis[index].id_user}" class=""`;
                    ht += `src="${data.eksis[index].foto}" width="60px" height="60px">`;
                    ht += `</div>`;
                    ht += `<div class="mt-2">`;
                    ht +=
                        `<p id="edt_nama_user_${data.eksis[index].id_user}" class="edt_nama_user modal-title font-18">${data.eksis[index].nama}</p>`;
                    ht +=
                        `<span id="edt_sub_user_${data.eksis[index].id_user}" class="edt_sub_user text-muted font-12">`;
                    ht += `${data.eksis[index].email}`;
                    ht += `</span>`;
                    ht += `</div>`;
                    ht +=
                        `<div class="btn-toolbar d-flex position-relative ms-auto" role="toolbar"`;
                    ht += `aria-label="Toolbar with button groups">`;
                    ht +=
                        `<div class="btn-group me-2" style="padding: unset !important" role="group"`;
                    ht += `aria-label="First group">`;
                    <?php if(auth()->check() && auth()->user()->hasRole('admin|super')): ?>
                    ht +=
                        `<button data-bs-toggle="tooltip" data-bs-placement="top" title="Hapus Anggota"`;
                    ht +=
                        `type="button" nama="${data.eksis[index].nama}" status="single" musrenbang="${data.eksis.id_musrenbang}" user="${data.eksis[index].id_user}" class="btnDeleteUserShow btn btn-outline-danger">`;
                    ht += `<i class="bi bi-trash"></i></button>`;
                    <?php endif; ?>
                    ht += `</div>`;
                    ht += `</div>`;
                    ht += `</div>`;
                    ht += `</div>`;
                }

                for (let index2 = 0; index2 < data.not_eksis.total; index2++) {
                    ht_not +=
                        `<div id="edt_urut_user_not_${data.not_eksis[index2].id_user}" class="urut_user_not mb-2 d-flex position-relative border-custom p-2">`;

                    ht_not += `<div class="me-2 mt-auto mb-auto">`;
                    ht_not +=
                        `<input id="cekBoxAnggotaNot_${data.not_eksis[index2].id}" class="cekBoxAnggotaNot form-check-input sembunyi" musrenbang="${data.not_eksis.id_musrenbang}" email="${data.not_eksis[index2].email}" foto="${data.not_eksis[index2].foto}" nama="${data.not_eksis[index2].nama}" user="${data.not_eksis[index2].id_user}"`;
                    ht_not += `type="checkbox" value="" id="flexCheckDefault">`;
                    ht_not += `</div>`;

                    ht_not += `<div class="me-3">`;
                    ht_not +=
                        `<img class="edt_foto_user_not" id="edt_foto_user_not_${data.not_eksis[index2].id_user}" class=""`;
                    ht_not += `src="${data.not_eksis[index2].foto}" width="60px" height="60px">`;
                    ht_not += `</div>`;
                    ht_not += `<div class="mt-2">`;
                    ht_not +=
                        `<p id="edt_nama_user_not_${data.not_eksis[index2].id_user}" class="edt_nama_user_not modal-title font-18">${data.not_eksis[index2].nama}</p>`;
                    ht_not +=
                        `<span id="edt_sub_user_not_${data.not_eksis[index2].id_user}" class="edt_sub_user_not text-muted font-12">`;
                    ht_not += `${data.not_eksis[index2].email}`;
                    ht_not += `</span>`;
                    ht_not += `</div>`;
                    ht_not +=
                        `<div class="btn-toolbar d-flex position-relative ms-auto" role="toolbar"`;
                    ht_not += `aria-label="Toolbar with button groups">`;
                    ht_not +=
                        `<div class="btn-group me-2" style="padding: unset !important" role="group"`;
                    ht_not += `aria-label="First group">`;
                    ht_not +=
                        `<button data-bs-toggle="tooltip" data-bs-placement="top" title="Tambah Anggota"`;
                    ht_not +=
                        `type="button" nama="${data.not_eksis[index2].nama}" status="single" musrenbang="${data.not_eksis.id_musrenbang}" user="${data.not_eksis[index2].id_user}" class="btnTambahUserShow btn btn-outline-success">`;
                    ht_not += `<i class="bi bi-person-plus"></i></button>`;
                    ht_not += `</div>`;
                    ht_not += `</div>`;
                    ht_not += `</div>`;
                    ht_not += `</div>`;
                }

                $('#div_list_anggota').append(ht);
                $('#div_list_anggota_not').append(ht_not);
            },
            error: function () {
                getSwalLoading(0, null, null)
                swal.fire('ERROR', 'Server Bermasalah. Coba Lagi Nanti', 'error')
            }
        })

        $('.modal_title_anggota').text(`Anggota Musrenbang ${nama}`);

        $('#modalShowUserMusrenbang').modal('show');
    })

    $(document).on('click', '#menu_cekbox_anggota', function () {
        if ($(this).is(":checked")) {
            resetCekBoxExist(1);
        } else {
            resetCekBoxExist(0);
        }
    })

    $(document).on('click', '#menu_cekbox_anggota_not', function () {
        if ($(this).is(":checked")) {
            resetCekBoxNotExist(1);
        } else {
            resetCekBoxNotExist(0);
        }
    })

    $(document).on('click', '.cekBoxAnggota', function () {
        let hitungcek = $('.cekBoxAnggota').filter(':checked').length
        $('#btnDeleteMultiAnggota').text(`Hapus Anggota (${hitungcek})`);
    })

    $(document).on('click', '.cekBoxAnggotaNot', function () {
        let hitungcek2 = $('.cekBoxAnggotaNot').filter(':checked').length
        $('#btnTambahMultiAnggota').text(`Tambah Anggota (${hitungcek2})`);
    })

    $(document).on('click', '.btnDeleteUserShow', function () {
        let id_musrenbang = $(this).attr('musrenbang');
        let id_user = $(this).attr('user');
        let nama = $(this).attr('nama');
        let status = $(this).attr('status');

        swal.fire({
            title: 'KONFIRMASI',
            html: `Hapus <b>${nama}</b> dari anggota musrenbang ?`,
            icon: 'warning',
            reverseButtons: !0,
            showCancelButton: !0,
            confirmButtonText: 'Ya, Hapus',
            cancelButtonText: 'Tidak'
        }).then(function (e) {
            if (e.value === true) {
                getSwalLoading(1, 'Proses Penghapusan Anggota Musrenbang', 'Mohon Tunggu...')
                $.ajax({
                    url: "<?php echo e(route('musrenbang.user.delete')); ?>",
                    data: {
                        "_token": "<?php echo e(csrf_token()); ?>",
                        id_user: id_user,
                        id_musrenbang: id_musrenbang,
                        nama: nama,
                        status: status,
                    },
                    method: "post",
                    dataType: 'json',
                    success: function (data) {
                        getSwalLoading(0, null, null)
                        if (data.success) {
                            swal.fire('INFORMASI', data.message, 'success')
                            let ht_not = '';

                            for (let index = 0; index < data.refresh.total; index++) {
                                $(`#edt_urut_user_${data.refresh[index].id_user}`)
                                    .remove();
                                ht_not +=
                                    `<div id="edt_urut_user_not_${data.refresh[index].id_user}" class="urut_user_not mb-2 d-flex position-relative border-custom p-2">`;

                                ht_not += `<div class="me-2 mt-auto mb-auto">`;
                                ht_not +=
                                    `<input id="cekBoxAnggotaNot_${data.refresh[index].id}" class="cekBoxAnggotaNot form-check-input sembunyi" musrenbang="${data.refresh.id_musrenbang}" email="${data.refresh[index].email}" foto="${data.refresh[index].foto}" nama="${data.refresh[index].nama}" user="${data.refresh[index].id_user}"`;
                                ht_not += `type="checkbox" value="" id="flexCheckDefault">`;
                                ht_not += `</div>`;

                                ht_not += `<div class="me-3">`;
                                ht_not +=
                                    `<img class="edt_foto_user_not" id="edt_foto_user_not_${data.refresh[index].id_user}" class=""`;
                                ht_not +=
                                    `src="${data.refresh[index].foto}" width="60px" height="60px">`;
                                ht_not += `</div>`;
                                ht_not += `<div class="mt-2">`;
                                ht_not +=
                                    `<p id="edt_nama_user_not_${data.refresh[index].id_user}" class="edt_nama_user_not modal-title font-18">${data.refresh[index].nama}</p>`;
                                ht_not +=
                                    `<span id="edt_sub_user_not_${data.refresh[index].id_user}" class="edt_sub_user_not text-muted font-12">`;
                                ht_not += `${data.refresh[index].email}`;
                                ht_not += `</span>`;
                                ht_not += `</div>`;
                                ht_not +=
                                    `<div class="btn-toolbar d-flex position-relative ms-auto" role="toolbar"`;
                                ht_not += `aria-label="Toolbar with button groups">`;
                                ht_not +=
                                    `<div class="btn-group me-2" style="padding: unset !important" role="group"`;
                                ht_not += `aria-label="First group">`;
                                ht_not +=
                                    `<button data-bs-toggle="tooltip" data-bs-placement="top" title="Tambah Anggota"`;
                                ht_not +=
                                    `type="button" nama="${data.refresh[index].nama}" status="single" musrenbang="${data.refresh.id_musrenbang}" user="${data.refresh[index].id_user}" class="btnTambahUserShow btn btn-outline-success">`;
                                ht_not += `<i class="bi bi-person-plus"></i></button>`;
                                ht_not += `</div>`;
                                ht_not += `</div>`;
                                ht_not += `</div>`;
                                ht_not += `</div>`;
                            }
                            $('#div_list_anggota_not').append(ht_not);

                            $('#text_total_anggota_not').text(
                                `Total Bukan Anggota: ${$('.urut_user_not').length}`);
                            $('#text_total_anggota').text(
                                `Total Anggota: ${$('.urut_user').length}`);
                            $('#tabel_musrenbang').DataTable().ajax.reload();
                        } else {
                            swal.fire('INFORMASI', data.message, 'error')
                        }
                    },
                    error: function () {
                        getSwalLoading(0, null, null)
                        swal.fire('ERROR', 'Server Bermasalah. Coba Lagi Nanti', 'error')
                    }
                })
            } else {
                e.dismiss;
            }
        }, function (dismiss) {
            return false
        })
    })

    $(document).on('click', '.btnTambahUserShow', function () {
        let id_musrenbang = $(this).attr('musrenbang');
        let id_user = $(this).attr('user');
        let nama = $(this).attr('nama');
        let status = $(this).attr('status');

        swal.fire({
            title: 'KONFIRMASI',
            html: `Tambah <b>${nama}</b> jadi anggota musrenbang ?`,
            icon: 'info',
            reverseButtons: !0,
            showCancelButton: !0,
            confirmButtonText: 'Ya, Tambah',
            cancelButtonText: 'Tidak'
        }).then(function (e) {
            if (e.value === true) {
                getSwalLoading(1, 'Proses Penambahan Anggota Musrenbang', 'Mohon Tunggu...')
                $.ajax({
                    url: "<?php echo e(route('musrenbang.user.create')); ?>",
                    data: {
                        "_token": "<?php echo e(csrf_token()); ?>",
                        id_user: id_user,
                        id_musrenbang: id_musrenbang,
                        nama: nama,
                        status: status,
                    },
                    method: "post",
                    dataType: 'json',
                    success: function (data) {
                        getSwalLoading(0, null, null)
                        if (data.success) {
                            swal.fire('INFORMASI', data.message, 'success')
                            ht = '';

                            for (let index = 0; index < data.refresh.total; index++) {
                                $(`#edt_urut_user_not_${data.refresh[index].id_user}`)
                                    .remove();
                                ht +=
                                    `<div id="edt_urut_user_${data.refresh[index].id_user}" class="urut_user mb-2 d-flex position-relative border-custom p-2">`;

                                ht += `<div class="me-2 mt-auto mb-auto">`;
                                ht +=
                                    `<input id="cekBoxAnggota_${data.refresh[index].id}" class="cekBoxAnggota form-check-input sembunyi" musrenbang="${data.refresh.id_musrenbang}" email="${data.refresh[index].email}" foto="${data.refresh[index].foto}" nama="${data.refresh[index].nama}" user="${data.refresh[index].id_user}"`;
                                ht += `type="checkbox" value="" id="flexCheckDefault">`;
                                ht += `</div>`;

                                ht += `<div class="me-3">`;
                                ht +=
                                    `<img class="edt_foto_user" id="edt_foto_user_${data.refresh[index].id_user}" class=""`;
                                ht +=
                                    `src="${data.refresh[index].foto}" width="60px" height="60px">`;
                                ht += `</div>`;
                                ht += `<div class="mt-2">`;
                                ht +=
                                    `<p id="edt_nama_user_${data.refresh[index].id_user}" class="edt_nama_user modal-title font-18">${data.refresh[index].nama}</p>`;
                                ht +=
                                    `<span id="edt_sub_user_${data.refresh[index].id_user}" class="edt_sub_user text-muted font-12">`;
                                ht += `${data.refresh[index].email}`;
                                ht += `</span>`;
                                ht += `</div>`;
                                ht +=
                                    `<div class="btn-toolbar d-flex position-relative ms-auto" role="toolbar"`;
                                ht += `aria-label="Toolbar with button groups">`;
                                ht +=
                                    `<div class="btn-group me-2" style="padding: unset !important" role="group"`;
                                ht += `aria-label="First group">`;
                                ht +=
                                    `<button data-bs-toggle="tooltip" data-bs-placement="top" title="Hapus Anggota"`;
                                ht +=
                                    `type="button" nama="${data.refresh[index].nama}" status="single" musrenbang="${data.refresh.id_musrenbang}" user="${data.refresh[index].id_user}" class="btnDeleteUserShow btn btn-outline-danger">`;
                                ht += `<i class="bi bi-trash"></i></button>`;
                                ht += `</div>`;
                                ht += `</div>`;
                                ht += `</div>`;
                                ht += `</div>`;
                            }

                            $('#div_list_anggota').append(ht);

                            $('#text_total_anggota_not').text(
                                `Total Bukan Anggota: ${$('.urut_user_not').length}`);
                            $('#text_total_anggota').text(
                                `Total Anggota: ${$('.urut_user').length}`);
                            $('#tabel_musrenbang').DataTable().ajax.reload();

                        } else {
                            swal.fire('INFORMASI', data.message, 'error')
                        }
                    },
                    error: function () {
                        getSwalLoading(0, null, null)
                        swal.fire('ERROR', 'Server Bermasalah. Coba Lagi Nanti', 'error')
                    }
                })
            } else {
                e.dismiss;
            }
        }, function (dismiss) {
            return false
        })
    })

    $(document).on('click', '#btnDeleteMultiAnggota', function () {
        let id_musrenbang = $(this).attr('musrenbang');
        const listDeleteAnggotaId = [];
        const listDeleteAnggotaNama = [];
        let total = 0;
        let ht = `<h5>Daftar Anggota Yang Akan Dihapus</h5>`;
        ht += `<div class="card p-2 mb-3 max-200">`;
        $('.cekBoxAnggota').filter(':checked').each(function (index, value) {
            listDeleteAnggotaId.push($(this).attr('user'));
            listDeleteAnggotaNama.push($(this).attr('nama'));
            ht +=
                `<div class="mb-2 d-flex position-relative border-custom p-2">`;

            ht += `<div class="me-3">`;
            ht +=
                `<img class="edt_foto_user"`;
            ht += `src="${$(this).attr('foto')}" width="60px" height="60px">`;
            ht += `</div>`;
            ht += `<div class="mt-2">`;
            ht +=
                `<p class="modal-title font-18 text-start">${$(this).attr('nama')}</p>`;
            ht +=
                `<span class="text-muted font-12">`;
            ht += `${$(this).attr('email')}`;
            ht += `</span>`;
            ht += `</div>`;
            ht += `</div>`;
            total++;
        })
        ht += `</div>`;
        ht += `Lanjutkan Proses Penghapusan Anggota Yang Dipilih (${total} Anggota)?`;

        if (total < 1) {
            swal.fire({
                title: 'INFORMASI',
                html: 'Tidak ada user yang dipilih',
                icon: 'error'
            })
        } else {
            swal.fire({
                title: 'KONFIRMASI',
                html: ht,
                icon: 'info',
                reverseButtons: !0,
                showCancelButton: !0,
                confirmButtonText: 'Ya, Hapus',
                cancelButtonText: 'Tidak'
            }).then(function (e) {
                if (e.value === true) {
                    getSwalLoading(1, 'Proses Penghapusan Anggota Musrenbang', 'Mohon Tunggu...')
                    $.ajax({
                        url: "<?php echo e(route('musrenbang.user.delete')); ?>",
                        data: {
                            "_token": "<?php echo e(csrf_token()); ?>",
                            id_user: listDeleteAnggotaId,
                            id_musrenbang: id_musrenbang,
                            nama: listDeleteAnggotaNama,
                            status: 'multi',
                        },
                        method: "post",
                        dataType: 'json',
                        success: function (data) {
                            getSwalLoading(0, null, null)
                            if (data.success) {
                                swal.fire('INFORMASI', data.message, 'success')
                                let ht_not = '';

                                for (let index = 0; index < data.refresh.total; index++) {
                                    $(`#edt_urut_user_${data.refresh[index].id_user}`)
                                        .remove();
                                    ht_not +=
                                        `<div id="edt_urut_user_not_${data.refresh[index].id_user}" class="urut_user_not mb-2 d-flex position-relative border-custom p-2">`;

                                    ht_not += `<div class="me-2 mt-auto mb-auto">`;
                                    ht_not +=
                                        `<input id="cekBoxAnggotaNot_${data.refresh[index].id}" class="cekBoxAnggotaNot form-check-input sembunyi" musrenbang="${data.refresh.id_musrenbang}" email="${data.refresh[index].email}" foto="${data.refresh[index].foto}" nama="${data.refresh[index].nama}" user="${data.refresh[index].id_user}"`;
                                    ht_not +=
                                        `type="checkbox" value="" id="flexCheckDefault">`;
                                    ht_not += `</div>`;

                                    ht_not += `<div class="me-3">`;
                                    ht_not +=
                                        `<img class="edt_foto_user_not" id="edt_foto_user_not_${data.refresh[index].id_user}" class=""`;
                                    ht_not +=
                                        `src="${data.refresh[index].foto}" width="60px" height="60px">`;
                                    ht_not += `</div>`;
                                    ht_not += `<div class="mt-2">`;
                                    ht_not +=
                                        `<p id="edt_nama_user_not_${data.refresh[index].id_user}" class="edt_nama_user_not modal-title font-18">${data.refresh[index].nama}</p>`;
                                    ht_not +=
                                        `<span id="edt_sub_user_not_${data.refresh[index].id_user}" class="edt_sub_user_not text-muted font-12">`;
                                    ht_not += `${data.refresh[index].email}`;
                                    ht_not += `</span>`;
                                    ht_not += `</div>`;
                                    ht_not +=
                                        `<div class="btn-toolbar d-flex position-relative ms-auto" role="toolbar"`;
                                    ht_not += `aria-label="Toolbar with button groups">`;
                                    ht_not +=
                                        `<div class="btn-group me-2" style="padding: unset !important" role="group"`;
                                    ht_not += `aria-label="First group">`;
                                    ht_not +=
                                        `<button data-bs-toggle="tooltip" data-bs-placement="top" title="Tambah Anggota"`;
                                    ht_not +=
                                        `type="button" nama="${data.refresh[index].nama}" status="single" musrenbang="${data.refresh.id_musrenbang}" user="${data.refresh[index].id_user}" class="btnTambahUserShow btn btn-outline-success">`;
                                    ht_not += `<i class="bi bi-person-plus"></i></button>`;
                                    ht_not += `</div>`;
                                    ht_not += `</div>`;
                                    ht_not += `</div>`;
                                    ht_not += `</div>`;
                                }
                                $('#div_list_anggota_not').append(ht_not);

                                $('#text_total_anggota_not').text(
                                    `Total Bukan Anggota: ${$('.urut_user_not').length}`
                                );
                                $('#text_total_anggota').text(
                                    `Total Anggota: ${$('.urut_user').length}`);
                                $('#tabel_musrenbang').DataTable().ajax.reload();
                            } else {
                                swal.fire('INFORMASI', data.message, 'error')
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
                return false
            })
        }


    })

    $(document).on('click', '#btnTambahMultiAnggota', function () {
        let id_musrenbang = $(this).attr('musrenbang');
        const listTambahAnggotaId = [];
        const listTambahAnggotaNama = [];
        let total = 0;
        let ht_not = `<h5>Daftar Anggota Yang Akan Ditambah</h5>`;
        ht_not += `<div class="card p-2 mb-3 max-200">`;
        $('.cekBoxAnggotaNot').filter(':checked').each(function (index, value) {
            listTambahAnggotaId.push($(this).attr('user'));
            listTambahAnggotaNama.push($(this).attr('nama'));
            ht_not +=
                `<div class="mb-2 d-flex position-relative border-custom p-2">`;

            ht_not += `<div class="me-3">`;
            ht_not +=
                `<img class="edt_foto_user_not"`;
            ht_not += `src="${$(this).attr('foto')}" width="60px" height="60px">`;
            ht_not += `</div>`;
            ht_not += `<div class="mt-2">`;
            ht_not +=
                `<p class="modal-title font-18 text-start">${$(this).attr('nama')}</p>`;
            ht_not +=
                `<span class="text-muted font-12">`;
            ht_not += `${$(this).attr('email')}`;
            ht_not += `</span>`;
            ht_not += `</div>`;
            ht_not += `</div>`;
            total++;
        })
        ht_not += `</div>`;
        ht_not += `Lanjutkan Proses Penambahan Anggota Yang Dipilih (${total} Anggota)?`;

        if (total < 1) {
            swal.fire({
                title: 'INFORMASI',
                html: 'Tidak ada user yang dipilih',
                icon: 'error'
            })
        } else {
            swal.fire({
                title: 'KONFIRMASI',
                html: ht_not,
                icon: 'info',
                reverseButtons: !0,
                showCancelButton: !0,
                confirmButtonText: 'Ya, Tambah',
                cancelButtonText: 'Tidak'
            }).then(function (e) {
                if (e.value === true) {
                    getSwalLoading(1, 'Proses Penambahan Anggota Musrenbang', 'Mohon Tunggu...')
                    $.ajax({
                        url: "<?php echo e(route('musrenbang.user.create')); ?>",
                        data: {
                            "_token": "<?php echo e(csrf_token()); ?>",
                            id_user: listTambahAnggotaId,
                            id_musrenbang: id_musrenbang,
                            nama: listTambahAnggotaNama,
                            status: 'multi',
                        },
                        method: "post",
                        dataType: 'json',
                        success: function (data) {
                            getSwalLoading(0, null, null)
                            if (data.success) {
                                swal.fire('INFORMASI', data.message, 'success')
                                ht = '';

                                for (let index = 0; index < data.refresh.total; index++) {
                                    $(`#edt_urut_user_not_${data.refresh[index].id_user}`)
                                        .remove();
                                    ht +=
                                        `<div id="edt_urut_user_${data.refresh[index].id_user}" class="urut_user mb-2 d-flex position-relative border-custom p-2">`;

                                    ht += `<div class="me-2 mt-auto mb-auto">`;
                                    ht +=
                                        `<input id="cekBoxAnggota_${data.refresh[index].id}" class="cekBoxAnggota form-check-input sembunyi" musrenbang="${data.refresh.id_musrenbang}" email="${data.refresh[index].email}" foto="${data.refresh[index].foto}" nama="${data.refresh[index].nama}" user="${data.refresh[index].id_user}"`;
                                    ht += `type="checkbox" value="" id="flexCheckDefault">`;
                                    ht += `</div>`;

                                    ht += `<div class="me-3">`;
                                    ht +=
                                        `<img class="edt_foto_user" id="edt_foto_user_${data.refresh[index].id_user}" class=""`;
                                    ht +=
                                        `src="${data.refresh[index].foto}" width="60px" height="60px">`;
                                    ht += `</div>`;
                                    ht += `<div class="mt-2">`;
                                    ht +=
                                        `<p id="edt_nama_user_${data.refresh[index].id_user}" class="edt_nama_user modal-title font-18">${data.refresh[index].nama}</p>`;
                                    ht +=
                                        `<span id="edt_sub_user_${data.refresh[index].id_user}" class="edt_sub_user text-muted font-12">`;
                                    ht += `${data.refresh[index].email}`;
                                    ht += `</span>`;
                                    ht += `</div>`;
                                    ht +=
                                        `<div class="btn-toolbar d-flex position-relative ms-auto" role="toolbar"`;
                                    ht += `aria-label="Toolbar with button groups">`;
                                    ht +=
                                        `<div class="btn-group me-2" style="padding: unset !important" role="group"`;
                                    ht += `aria-label="First group">`;
                                    ht +=
                                        `<button data-bs-toggle="tooltip" data-bs-placement="top" title="Hapus Anggota"`;
                                    ht +=
                                        `type="button" nama="${data.refresh[index].nama}" status="single" musrenbang="${data.refresh.id_musrenbang}" user="${data.refresh[index].id_user}" class="btnDeleteUserShow btn btn-outline-danger">`;
                                    ht += `<i class="bi bi-trash"></i></button>`;
                                    ht += `</div>`;
                                    ht += `</div>`;
                                    ht += `</div>`;
                                    ht += `</div>`;
                                }

                                $('#div_list_anggota').append(ht);

                                $('#text_total_anggota_not').text(
                                    `Total Bukan Anggota: ${$('.urut_user_not').length}`
                                );
                                $('#text_total_anggota').text(
                                    `Total Anggota: ${$('.urut_user').length}`);
                                $('#tabel_musrenbang').DataTable().ajax.reload();
                            } else {
                                swal.fire('INFORMASI', data.message, 'error')
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
                return false
            })
        }
    })

    function resetCekBoxExist(data) {
        if (data == "1") {
            $('.cekBoxAnggota').show(600);
            $('.btnDeleteMultiAnggota').fadeIn(600);
            $('.btnDeleteUserShow').attr('disabled', true);
        } else {
            $('.cekBoxAnggota').hide(600);
            $('.cekBoxAnggota').prop('checked', false);
            $('.btnDeleteMultiAnggota').fadeOut(600);
            $('.btnDeleteUserShow').attr('disabled', false);
            $('#btnDeleteMultiAnggota').text(`Hapus Anggota`);
        }
    }

    function resetCekBoxNotExist(data) {
        if (data == "1") {
            $('.cekBoxAnggotaNot').show(600);
            $('.btnTambahMultiAnggota').fadeIn(600);
            $('.btnTambahUserShow').attr('disabled', true);
        } else {
            $('.cekBoxAnggotaNot').hide(600);
            $('.cekBoxAnggotaNot').prop('checked', false);
            $('.btnTambahMultiAnggota').fadeOut(600);
            $('.btnTambahUserShow').attr('disabled', false);
            $('#btnTambahMultiAnggota').text(`Tambah Anggota`);
        }
    }


    $('#find_anggota_exist').bind('keyup', function () {
        let cari = this.value

        $("#div_list_anggota").find('.urut_user').each(function (index, value) {
            currentName = $(value).text()
            if (currentName.toUpperCase().indexOf(cari.toUpperCase()) > -1) {
                $(value).removeClass('sembunyi2');
            } else {
                $(value).addClass('sembunyi2');
            }

        });
    })

    $('#find_anggota_not_exist').bind('keyup', function () {
        let cari2 = this.value

        $("#div_list_anggota_not").find('.urut_user_not').each(function (index, value) {
            currentName2 = $(value).text()
            if (currentName2.toUpperCase().indexOf(cari2.toUpperCase()) > -1) {
                $(value).removeClass('sembunyi2');
            } else {
                $(value).addClass('sembunyi2');
            }

        });
    })

    $('#modalShowUserMusrenbang').on('hidden.bs.modal', function (e) {
        $('.modal_title_anggota').text(`Anggota Musrenbang`);
        resetCekBoxExist(0);
        resetCekBoxNotExist(0);
        $('#div_list_anggota').empty();
        $('#div_list_anggota_not').empty();
        $('#btnDeleteMultiAnggota').attr('musrenbang', 0);
        $('#btnTambahMultiAnggota').attr('musrenbang', 0);

        $('#modal_dialog_custom_anggota').removeClass('modal-xl');
        $('#menu_not_exist_anggota').fadeOut('slow');
        $('#menuSearchEksis').removeClass('wid-100');
        $('#btnShowMenuTambahAnggota').fadeIn('slow');
        $('.modal_title_anggota').addClass('font-18');
    })

    $(document).on('click', '#btnShowMenuTambahAnggota', function () {

        $('#modal_dialog_custom_anggota').addClass("modal-xl", 1000, "easeOutBounce");

        // $('#modal_dialog_custom_anggota').addClass('modal-xl');
        $('#menu_not_exist_anggota').show('slow');
        $('#menuSearchEksis').addClass('wid-100', 1000, 'easeOutBounce');
        $('#btnShowMenuTambahAnggota').hide('slow');
        $('.modal_title_anggota').removeClass('font-18');
    })

    $(document).on('click', '#btnHideMenuTambahAnggota', function () {
        $('#modal_dialog_custom_anggota').removeClass("modal-xl", 700, "easeInBack");
        $('#menu_not_exist_anggota').hide('slow', function () {
            $('#menuSearchEksis').removeClass('wid-100', 100, 'easeInBack');
            $('#btnShowMenuTambahAnggota').fadeIn('slow');
            $('.modal_title_anggota').addClass('font-18');
        });
    })

</script>
<?php /**PATH C:\xampp\htdocs\desacuss_new\resources\views/admin/musrenbang/js_pack/jsuser.blade.php ENDPATH**/ ?>