<script>
    var config = {
        route: {
            cekMail: "<?php echo e(route('cek.email')); ?>",
            update: "<?php echo e(route('profile.update')); ?>",
            verifikasi: "<?php echo e(route('profile.verifikasi')); ?>"
        },
        asset: "<?php echo e(asset('/img/user')); ?>/"
    };
    $(document).ready(function () {

        $('#tabel_diskusi').DataTable({
            processing: true,
            serverSide: true,
            ajax: {
                url: "<?php echo e(route('profile.diskusi')); ?>"
            },
            'columnDefs': [{
                "targets": [0, 1, 2, 3, 4, 5, 6],
                "className": "text-center main",
            }, ],
            columns: [{
                    data: 'DT_RowIndex'
                },
                {
                    data: 'nama_diskusi'
                },
                {
                    data: 'color'
                },
                {
                    data: 'jenis_diskusi'
                },
                {
                    data: 'desk'
                },
                {
                    data: 'stat'
                },
                {
                    data: 'action',
                    orderable: false,
                    searchable: false
                }
            ]
        });

        $(document).on('click', '.btnDetailDiskusi', function () {
            let id = $(this).data('id');

            $.ajax({
                url: "<?php echo e(route('diskusi.detail')); ?>",
                data: {
                    "_token": "<?php echo e(csrf_token()); ?>",
                    id: id
                },
                method: 'post',
                dataType: 'json',
                success: function (respon) {

                    $('#detail_img_user').attr('src', respon.foto);
                    $('#detail_nama').text(respon.nama);
                    $('#detail_role').text(respon.role);
                    $('#detail_span_jenis').text(respon.jenis);
                    $('#detail_span_kategori').text(respon.kategori);
                    $('#detail_span_komentar').text(respon.balas);
                    $('#detail_span_viewed').text(respon.viewed);
                    $('#detail_span_like').text(respon.like);
                    $('#detail_span_dislike').text(respon.dislike);
                    $('#detail_span_status').text(respon.status);
                    $('#detail_judul').text(respon.judul);
                    $('#detail_deskripsi').html(respon.desk);

                    if (respon.votes > 0) {

                        const arr_vote = [];
                        const arr_vote_total = [];
                        const arr_vote_persen = [];
                        arr_vote[1] = respon.vote.vote_1;
                        arr_vote[2] = respon.vote.vote_2;
                        arr_vote[3] = respon.vote.vote_3;
                        arr_vote[4] = respon.vote.vote_4;
                        arr_vote[5] = respon.vote.vote_5;

                        arr_vote_total[1] = respon.vote.tvote_1;
                        arr_vote_total[2] = respon.vote.tvote_2;
                        arr_vote_total[3] = respon.vote.tvote_3;
                        arr_vote_total[4] = respon.vote.tvote_4;
                        arr_vote_total[5] = respon.vote.tvote_5;

                        arr_vote_persen[1] = respon.vote.pvote_1;
                        arr_vote_persen[2] = respon.vote.pvote_2;
                        arr_vote_persen[3] = respon.vote.pvote_3;
                        arr_vote_persen[4] = respon.vote.pvote_4;
                        arr_vote_persen[5] = respon.vote.pvote_5;

                        let html = '';

                        for (let index = 1; index <= respon.vote.total; index++) {
                            html += '<div class="mb-3">';
                            html += '<label>' + arr_vote[index] + '</label>';
                            html += '<div class="progress">';
                            html +=
                                '<div class="progress-bar" role="progressbar" style="width: ' +
                                arr_vote_persen[index] + '%;"';
                            html +=
                                'aria-valuenow="' + arr_vote_total[index] +
                                '" aria-valuemin="0" aria-valuemax="100">' +
                                arr_vote_persen[index] +
                                '%</div>';
                            html += '</div>';
                            html += '</div>';

                        }

                        $(".detail_opsi").html(html);

                        $('#detail_vote_hitung').text(
                            `Suara masuk ${respon.vote.tmasuk} dari ${respon.vote.tuser} (${respon.vote.tpersen}%)`
                        );
                        $('#detail_tgl_vote').text(
                            `Batas Waktu Voting : ${respon.vote.tgl_vote} (${respon.vote.sisa_vote})`
                        );

                        $('#detail_menu_voting').show();

                    } else {
                        $('#detail_menu_voting').hide();
                    }

                    $('#openModalDetailDiskusi').modal('show');
                }
            })

        })

        $('#openModalDetailDiskusi').on('hidden.bs.modal', function (e) {
            $('#detail_menu_voting').hide();
        })

        $("#input-b6").fileinput({
            elErrorContainer: '#kartik-file-errors',
            showUpload: false,
            dropZoneEnabled: false,
            maxFileCount: 1,
            mainClass: "input-group-sm",
            language: 'id',
        });

        $('#btnGantiFoto').click(function () {
            $('#modalShowEditFoto').modal('show');
        })

        $('.btn-close-edit-foto').click(function () {
            $('#formEditFoto')[0].reset();
            $('#modalShowEditFoto').modal('hide');
        })

        $('.btn-confirm-edit-foto').click(function () {
            $('#formEditFoto').parsley().validate();
            if ($('#formEditFoto').parsley().isValid()) {
                let formDatas = $('#formEditFoto').get(0);
                let formPack = new FormData(formDatas);
                swal.fire({
                    title: 'Lanjut proses update?',
                    icon: 'info',
                    showCancelButton: !0,
                    reverseButtons: !0,
                    cancelButtonText: 'Tidak',
                    confirmButtonText: 'Lanjut'
                }).then(function (e) {
                    if (e.value === true) {
                        $.ajax({
                            url: config.route.update,
                            data: formPack,
                            method: 'post',
                            dataType: 'json',
                            processData: false,
                            contentType: false,
                            success: function (respon) {
                                if (respon.success) {
                                    swal.fire({
                                        title: 'INFORMASI',
                                        text: respon.message,
                                        icon: 'success'
                                    })

                                    $('#foto-profile').attr('src', config.asset +
                                        respon.desa + "/" + respon.refresh + "");
                                    $('#base-foto').attr('src', config.asset +
                                        respon.desa + "/" + respon.refresh + "");

                                    $('#formEditFoto')[0].reset();
                                    $('#modalShowEditFoto').modal('hide');

                                } else {
                                    swal.fire({
                                        title: 'INFORMASI',
                                        text: respon.message,
                                        icon: 'error'
                                    })
                                }
                            }
                        })
                    } else {
                        return e.dismiss;
                    }
                }, function (dismiss) {
                    return false;
                })
            }
        })

        $('#btnEditName').click(function () {
            const name = $('#name').val();
            const name_old = $('#name').data('old');
            const val = $(this).data('value');
            if (val == 'tutup') {
                $(this).text('Cancel');
                $(this).data('value', 'open');
                $('#name').attr({
                    'readonly': false
                })
                $('#btnUpdateName').show(400);
            } else if (val == 'open') {
                $(this).text('Edit');
                $(this).data('value', 'tutup');
                $('#name').attr({
                    'readonly': true
                });
                $('#btnUpdateName').hide(400);
                $('#name').val(name_old);
            }
        })

        $('#btnUpdateName').click(function () {
            $('#formEditName').parsley().validate();
            if ($('#formEditName').parsley().isValid()) {
                let formDatas = $('#formEditName').get(0);
                let formPack = new FormData(formDatas);
                swal.fire({
                    title: 'Lanjut proses update?',
                    icon: 'info',
                    showCancelButton: !0,
                    reverseButtons: !0,
                    cancelButtonText: 'Tidak',
                    confirmButtonText: 'Lanjut'
                }).then(function (e) {
                    if (e.value === true) {
                        $.ajax({
                            url: config.route.update,
                            data: formPack,
                            method: 'post',
                            dataType: 'json',
                            processData: false,
                            contentType: false,
                            success: function (respon) {
                                if (respon.success) {
                                    swal.fire({
                                        title: 'INFORMASI',
                                        text: respon.message,
                                        icon: 'success'
                                    })
                                    $('#name').val(respon.refresh).data('old',
                                        respon.refresh);

                                    $('#btnEditName').text('Edit');
                                    $('#btnEditName').data('value', 'tutup');
                                    $('#name').attr({
                                        'readonly': true
                                    });
                                    $('#btnUpdateName').hide(400);
                                    $('#base-nama-pengenal').html(respon.refresh);
                                    $('#base2-nama-pengenal').html(respon.refresh);
                                    $('#hi-name').html('Hi, ' + respon.refresh);
                                } else {
                                    swal.fire({
                                        title: 'INFORMASI',
                                        text: respon.message,
                                        icon: 'error'
                                    })
                                }
                            }
                        })
                    } else {
                        return e.dismiss;
                    }
                }, function (dismiss) {
                    return false;
                })
            }
        })

        $('.btn-confirm-edit-email').click(function () {
            $('#formEditEmail').parsley().validate();
            if ($('#formEditEmail').parsley().isValid()) {
                let formDatas = $('#formEditEmail').get(0);
                let formPack = new FormData(formDatas);
                swal.fire({
                    title: 'Lanjut proses update?',
                    icon: 'info',
                    showCancelButton: !0,
                    reverseButtons: !0,
                    cancelButtonText: 'Tidak',
                    confirmButtonText: 'Lanjut'
                }).then(function (e) {
                    if (e.value === true) {
                        $.ajax({
                            url: config.route.update,
                            data: formPack,
                            method: 'post',
                            dataType: 'json',
                            processData: false,
                            contentType: false,
                            success: function (respon) {
                                if (respon.success) {
                                    swal.fire({
                                        title: 'INFORMASI',
                                        text: respon.message,
                                        icon: 'success'
                                    })
                                    $('#email').val(respon.refresh);
                                    $('#modalShowEditProfile').modal('hide');
                                    resetEdit();
                                } else {
                                    swal.fire({
                                        title: 'INFORMASI',
                                        text: respon.message,
                                        icon: 'error'
                                    })
                                }
                            }
                        })
                    } else {
                        return e.dismiss;
                    }
                }, function (dismiss) {
                    return false;
                })
            }
        })

        $('.btn-confirm-edit-password').click(function () {
            $('#formEditPassword').parsley().validate();
            if ($('#formEditPassword').parsley().isValid()) {
                let formDatas = $('#formEditPassword').get(0);
                let formPack = new FormData(formDatas);
                swal.fire({
                    title: 'Lanjut proses update?',
                    icon: 'info',
                    showCancelButton: !0,
                    reverseButtons: !0,
                    cancelButtonText: 'Tidak',
                    confirmButtonText: 'Lanjut'
                }).then(function (e) {
                    if (e.value === true) {
                        $.ajax({
                            url: config.route.update,
                            data: formPack,
                            method: 'post',
                            dataType: 'json',
                            processData: false,
                            contentType: false,
                            success: function (respon) {
                                if (respon.success) {
                                    swal.fire({
                                        title: 'INFORMASI',
                                        text: respon.message,
                                        icon: 'success'
                                    });
                                    $('#modalShowEditProfile').modal('hide');
                                    resetEdit();
                                } else {
                                    swal.fire({
                                        title: 'INFORMASI',
                                        text: respon.message,
                                        icon: 'error'
                                    })
                                }
                            }
                        })
                    } else {
                        return e.dismiss;
                    }
                }, function (dismiss) {
                    return false;
                })
            }
        })

        $('#btnEditEmail').on('click', function () {
            $('#modalShowEditProfile').modal('show');
            $('.edit-email').show();
            $('#emailUserBaru').attr('required', true);
            $('.modal-verifikasi-akun').attr('id', 'email');
            $('.btn-confirm-edit-email').removeAttr('style');
        })

        $('#btnEditPw').on('click', function () {
            $('#modalShowEditProfile').modal('show');
            $('.edit-password').show();
            $('#cardHeaderProfileEdit').text('Edit Password');
            $('.btn-confirm-edit-email').hide();
            $('.btn-confirm-edit-password').show();
            $('#password-baru').attr('required', true);
            $('#password-konfirmasi-baru').attr('required', true);
            $('.modal-verifikasi-akun').attr('id', 'password');
            $('.btn-confirm-edit-password').removeAttr('style');
        })

        $('.btn-close-edit').on('click', function () {
            $('#modalShowEditProfile').modal('hide');
            resetEdit();
        })

        $('#passwordShow').on('click', function () {
            if ($('#passwords').attr('type') == 'password') {
                $(this).removeClass('fa-eye-slash')
                $('#passwords').attr('type', 'text')
                $(this).addClass('fa-eye')
            } else if ($('#passwords').attr('type') == 'text') {
                $(this).removeClass('fa-eye')
                $('#passwords').attr('type', 'password')
                $(this).addClass('fa-eye-slash')
            }
        })

        $('#passwordBaruShow').on('click', function () {
            if ($('#password-baru').attr('type') == 'password') {
                $(this).removeClass('fa-eye-slash')
                $('#password-baru').attr('type', 'text')
                $(this).addClass('fa-eye')
            } else if ($('#password-baru').attr('type') == 'text') {
                $(this).removeClass('fa-eye')
                $('#password-baru').attr('type', 'password')
                $(this).addClass('fa-eye-slash')
            }
        })

        $('#passwordKonfirmasiBaruShow').on('click', function () {
            if ($('#password-konfirmasi-baru').attr('type') == 'password') {
                $(this).removeClass('fa-eye-slash')
                $('#password-konfirmasi-baru').attr('type', 'text')
                $(this).addClass('fa-eye')
            } else if ($('#password-konfirmasi-baru').attr('type') == 'text') {
                $(this).removeClass('fa-eye')
                $('#password-konfirmasi-baru').attr('type', 'password')
                $(this).addClass('fa-eye-slash')
            }
        })
    })

    $(document).on('click', '.btn-confirm-edit-verifikasi', function () {
        let aksi = $('.modal-verifikasi-akun').attr('id');

        $('#formCekAkun').parsley().validate();
        if ($('#formCekAkun').parsley().isValid()) {
            let formDatas = $('#formCekAkun').get(0);
            let formPack = new FormData(formDatas);
            $.ajax({
                url: config.route.verifikasi,
                data: formPack,
                method: 'post',
                dataType: 'json',
                processData: false,
                contentType: false,
                success: function (respon) {
                    if (respon.success) {
                        const Toast = Swal.mixin({
                            toast: true,
                            position: 'top',
                            showConfirmButton: false,
                            timer: 1800,
                            timerProgressBar: true,
                            didOpen: (toast) => {
                                toast.addEventListener('mouseenter', Swal.stopTimer)
                                toast.addEventListener('mouseleave', Swal.resumeTimer)
                            }
                        })

                        Toast.fire({
                            icon: 'success',
                            title: respon.message
                        })

                        if (aksi == "email") {
                            $('.menu-cek').hide(1100);
                            $('.edit-email').removeClass('sembunyi2');
                            $('.edit-email').removeAttr('style');
                            $('.edit-email').addClass('sembunyi');
                            $('.edit-email').show(1100);
                            $('.btn-confirm-edit-verifikasi').hide();
                            $('.btn-confirm-edit-email').show(1100);
                        } else if (aksi == "password") {
                            $('.menu-cek').hide(1100);
                            $('.edit-password').removeClass('sembunyi2');
                            $('.edit-password').removeAttr('style');
                            $('.edit-password').addClass('sembunyi');
                            $('.edit-password').show(1100);
                            $('.btn-confirm-edit-verifikasi').hide();
                            $('.btn-confirm-edit-password').show(1100);
                        }
                    } else {
                        const Toast = Swal.mixin({
                            toast: true,
                            position: 'top',
                            showConfirmButton: false,
                            timer: 1800,
                            timerProgressBar: true,
                            didOpen: (toast) => {
                                toast.addEventListener('mouseenter', Swal.stopTimer)
                                toast.addEventListener('mouseleave', Swal.resumeTimer)
                            }
                        })

                        Toast.fire({
                            icon: 'error',
                            title: respon.message
                        })
                    }
                }
            })
        }
    })

    $("#emailUserBaru").on('keyup', function () {
        var email = $(this).val().trim();
        if (email != '') {
            $.ajax({
                url: config.route.cekMail,
                type: 'post',
                data: {
                    email: email
                },
                success: function (response) {
                    var red =
                        '<span style="color: red;" role="alert"><ul><li>Email sudah terdaftar, gunakan email lain!</li></ul></span>';
                    if (response == 1) {
                        $('.btn-confirm-edit-email').attr('disabled', true);
                        $('#uname_response_email').html(red);
                    } else {
                        $('.btn-confirm-edit-email').attr('disabled', false);
                        $("#uname_response_email").html("");
                    }
                }
            });
        } else {
            $("#uname_response_email").html("");
        }
    });

    function resetEdit() {
        $('#formCekAkun')[0].reset();
        $('#formEditEmail')[0].reset();
        $('#formEditPassword')[0].reset();

        $('#passwords').attr('type', 'password');

        $('.btn-confirm-edit-email').attr('disabled', false);

        $('.modal-verifikasi-akun').attr('id', '');

        $('#cardHeaderProfileEdit').text('Edit Email');
        $('.btn-confirm-edit-email').hide().removeAttr('style');
        $('.btn-confirm-edit-password').hide().removeAttr('style');
        $('.btn-confirm-edit-verifikasi').show();
        $('.edit-email').hide();
        $('.edit-email').addClass('sembunyi2');
        $('.edit-password').hide();
        $('.edit-password').addClass('sembunyi2');

        $('.menu-cek').show();

        $('#emailUserBaru').attr('required', false);
        $('#password-baru').attr('required', false);
        $('#password-konfirmasi-baru').attr('required', false);
    }

</script>










<script>
    $(document).ready(function () {
        // let deskDiskusi = $('#deskDiskusi').attr('id')
        // CKEDITOR.replace(deskDiskusi, {
        //     filebrowserUploadUrl: "<?php echo e(route('upload.upload', ['_token' => csrf_token() ])); ?>",
        //     filebrowserUploadMethod: 'form',
        //     language: 'id'
        // });

        // CKEDITOR.on('instanceReady', function () {
        //     $('#deskDiskusi').attr('required', '');
        //     $.each(CKEDITOR.instances, function (instance) {
        //         CKEDITOR.instances[instance].on("change", function (e) {
        //             for (instance in CKEDITOR.instances) {
        //                 CKEDITOR.instances[instance].updateElement();
        //                 $('#form_tambah_diskusi').parsley().validate();
        //             }
        //         });
        //     });
        // });

        $('#deskDiskusi').summernote({
            placeholder: 'Tulis isi forum disini...',
            lang: 'id-ID',
            tabsize: 2,
            height: 150
        });

        $('#cekboxvoting').click(function () {
            if ($(this).is(":checked")) {
                let total_vote = $('.menu_vote').length;
                for (let index = 1; index <= total_vote; index++) {
                    $('#vote_' + index).attr('required', true);
                }
                $('#tgl_vote').attr('required', true);
                $('#menu_add_vote').slideToggle(1100);
                $(this).val('1')
            } else {
                let total_vote = $('.menu_vote').length;
                for (let index = 1; index <= total_vote; index++) {
                    $('#vote_' + index).attr('required', false);
                }
                $('#menu_add_vote').slideToggle(1100);
                $('#tgl_vote').attr('required', false);
                $(this).val('0')
            }
        })
    })

    $(document).on('click', '.btn_update_diskusi', function () {
        $('#form_tambah_diskusi').parsley().validate();
        if ($('#form_tambah_diskusi').parsley().isValid()) {
            let formDatas = $('#form_tambah_diskusi').get(0);
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
                    $.ajax({
                        url: "<?php echo e(route('diskusi.update')); ?>",
                        data: formPack,
                        method: 'post',
                        dataType: 'json',
                        processData: false,
                        contentType: false,
                        success: function (respon) {
                            if (respon.success) {
                                swal.fire({
                                    title: 'INFORMASI',
                                    text: respon.message,
                                    icon: 'success'
                                })
                                $('#tabel_diskusi').DataTable().ajax.reload();
                                $('#tabel_kategori').DataTable().ajax.reload();
                                showHide();
                            } else {
                                swal.fire({
                                    title: 'INFORMASI',
                                    text: respon.message,
                                    icon: 'error'
                                })
                            }
                        }
                    })
                } else {
                    e.dismiss;
                }
            }, function (dismiss) {
                return false;
            })
        } else {
            swal.fire('Terdapat Kolom Yang Kosong!', '', 'error')
        }
    })


    $(document).on('click', '.btnEditDiskusi', function () {
        let id = $(this).data('id');
        $.ajax({
            url: "<?php echo e(route('diskusi.edit')); ?>",
            data: {
                "_token": "<?php echo e(csrf_token()); ?>",
                id: id
            },
            method: 'post',
            dataType: 'json',
            success: function (respon) {
                showHide();

                $('#aksi_diskusi').text('Edit Diskusi');
                $('.btn_add_diskusi').hide();
                $('.btn_update_diskusi').show();

                let nama = respon.diskusi.nama_diskusi;
                let kategori = respon.diskusi.id_kategori;
                let jenis = respon.diskusi.jenis_diskusi;
                let desk = respon.diskusi.deskripsi_diskusi;

                getKategori(kategori)

                $('#value_diskusi').val(respon.diskusi.id_diskusi);
                $('#nama_diskusi').val(nama);
                // $("#listKategori").val(kategori);

                $('#listKategori').selectpicker('refresh');
                $('#listKategori').val(7);
                $('#listKategori').selectpicker('refresh');


                $("#deskDiskusi").summernote("code", desk);

                // let deskDiskusi = CKEDITOR.instances['deskDiskusi'];
                // deskDiskusi.setData(desk);

                if (respon.vote.length > 0) {
                    let total = respon.vote[0].total_vote;
                    let vote_1 = respon.vote[0].vote_1;
                    let vote_2 = respon.vote[0].vote_2;
                    let vote_3 = respon.vote[0].vote_3;
                    let vote_4 = respon.vote[0].vote_4;
                    let vote_5 = respon.vote[0].vote_5;
                    let tgl_vote = respon.vote[0].tgl_vote;

                    if (total > 0) {
                        $('#cekboxvoting').attr('checked', true)

                        let total_votes = $('.menu_vote').length;
                        for (let index = 1; index <= total_votes; index++) {
                            $('#vote_' + index).attr('required', true);
                        }
                        $('#tgl_vote').attr('required', true);
                        $('#menu_add_vote').show(1100);
                        $(this).val('1')

                        $('#tgl_vote').val(tgl_vote);

                        $('#vote_1').val(vote_1)
                        $('#vote_2').val(vote_2)

                        const arr_vote = [];
                        arr_vote[3] = vote_3;
                        arr_vote[4] = vote_4;
                        arr_vote[5] = vote_5;
                        $('.new_vote').remove();
                        if (total > 2) {
                            let html_vote = '';
                            for (let index = 3; index <= total; index++) {
                                html_vote += '<div id="menu_vote_' + index +
                                    '" class="menu_vote new_vote mb-3">';
                                html_vote += '<div class="input-group">';
                                html_vote += '<span class="span-vote input-group-text">Opsi ' +
                                    index +
                                    '</span>';
                                html_vote += '<input value="' + arr_vote[index] +
                                    '" type="text" id="vote_' + index +
                                    '" name="vote[]" class="inp_vote form-control"';
                                html_vote += 'placeholder="Tulis Opsi ' + index +
                                    ' Disini" required="required"';
                                html_vote += 'data-parsley-errors-container="#vote_' + index +
                                    '_error"';
                                html_vote += 'data-parsley-required-message="Opsi Pilihan ' +
                                    index +
                                    ' belum diisi.">';
                                html_vote +=
                                    '<button class="btn_delete_opsi btn btn-outline-danger" vote="' +
                                    index +
                                    '" id="vote_' + index +
                                    '" type="button">Hapus</button>';
                                html_vote += '</div>';
                                html_vote += '<div id="vote_' + index +
                                    '_error" class="error-message-custom"></div>';
                                html_vote += '</div>';
                            }
                            $('.menu_opsi').append(html_vote).show(600);
                        }
                    }
                }
            }
        })
    })

    $(document).on('click', '.btn_close_form', function () {
        showHide();
    })

    function showHide() {
        if ($('#div_tabel_diskusi').is(':visible')) {
            $('#div_tabel_diskusi').hide(600, function () {
                $('#div_tambah_diskusi').show(600);
                resetFormDiskusiReverse();

            });
        } else {
            $('#div_tambah_diskusi').hide(600, function () {
                $('#div_tabel_diskusi').show(600);
                resetFormDiskusi();
            });
        }
    }

    function getKategori(value) {
        $.ajax({
            url: "<?php echo e(route('kategori.get.kategori')); ?>",
            method: 'get',
            dataType: 'json',
            success: function (respon) {
                let html = '';
                $('#listKategori').empty();
                $.each(respon, function (id, data) {
                    html += '<option value="' + data.id_kategori + '"';
                    html +=
                        `data-content="<span class='badge bg-${data.warna}'>${data.nama_kategori}</span>"`;
                    html += '</option>';
                })
                $('#listKategori').append(html).selectpicker('refresh');
                if (value != null) {
                    $('#listKategori').val(value);
                    $('#listKategori').selectpicker('refresh');
                }
            }
        })
    }

    function resetFormDiskusi() {
        $('#form_tambah_diskusi')[0].reset();
        $('#aksi_diskusi').text('Tambah Diskusi');
        $('.btn_add_diskusi').show();
        $('.btn_update_diskusi').hide();

        $('#nama_diskusi').attr('required', false);
        $('#listKategori').attr('required', false);
        $('#deskDiskusi').attr('required', false);

        $('#listKategori').val('');
        $('.selectpicker').selectpicker('refresh');

        $("#deskDiskusi").summernote("reset");


        // let deskDiskusi = CKEDITOR.instances['deskDiskusi'];
        // deskDiskusi.setData('');

        $('#cekboxvoting').attr('checked', false);

        $('.new_vote').remove();

        $('#menu_add_vote').hide(1100);
        let total_vote = $('.menu_vote').length;
        for (let index = 1; index <= total_vote; index++) {
            $('#vote_' + index).attr('required', false);
        }
        $('#tgl_vote').attr('required', false);
    }

    function resetFormDiskusiReverse() {
        $('#nama_diskusi').attr('required', true);
        $('#listKategori').attr('required', true);
        $('#deskDiskusi').attr('required', true);

        $('cekboxvoting').prop('checked', false);

    }

</script>


<script>
    $(document).on('click', '.btnDeleteDiskusi', function () {
        let id = $(this).data('id');
        let nama = $(this).data('name');

        swal.fire({
            title: 'KONFIRMASI',
            html: 'Hapus Forum Diskusi ' + nama + '?',
            icon: 'warning',
            reverseButtons: !0,
            showCancelButton: !0,
            confirmButtonText: 'Ya, Hapus',
            cancelButtonText: 'Tidak'
        }).then(function (e) {
            if (e.value === true) {
                $.ajax({
                    url: "<?php echo e(route('diskusi.delete')); ?>",
                    data: {
                        "_token": "<?php echo e(csrf_token()); ?>",
                        id: id,
                        nama: nama,
                    },
                    dataType: 'json',
                    method: 'post',
                    success: function (respon) {
                        if (respon.success) {
                            $('#tabel_diskusi').DataTable().ajax.reload();
                            $('#tabel_kategori').DataTable().ajax.reload();
                            swal.fire('INFORMASI', respon.message, 'success');
                        } else {
                            swal.fire('INFORMASI', respon.message, 'error');
                        }
                    }
                })
            } else {
                return e.dismiss;
            }
        }, function (dismiss) {
            return false;
        });
    })

</script>




<script>
    $(document).ready(function () {

    })

    $(document).on('click', '.btn_tambah_opsi', function () {
        let html_vote = '';
        let total_vote = $('.menu_vote').length + 1;

        if (total_vote > 5) {
            swal.fire('Maksimal Vote 5 (Lima) Opsi', '', 'error');
        } else {
            html_vote += '<div id="menu_vote_' + total_vote +
                '" class="menu_vote new-vote mb-3">';
            html_vote += '<div class="input-group">';
            html_vote += '<span class="span-vote input-group-text">Opsi ' + total_vote + '</span>';
            html_vote += '<input type="text" id="vote_' + total_vote +
                '" name="vote[]" class="inp_vote form-control"';
            html_vote += 'placeholder="Tulis Opsi ' + total_vote + ' Disini" required="required"';
            html_vote += 'data-parsley-errors-container="#vote_' + total_vote + '_error"';
            html_vote += 'data-parsley-required-message="Opsi Pilihan ' + total_vote +
                ' belum diisi.">';
            html_vote +=
                '<button class="btn_delete_opsi btn btn-outline-danger" vote="' + total_vote +
                '" id="vote_' + total_vote +
                '" type="button">Hapus</button>';
            html_vote += '</div>';
            html_vote += '<div id="vote_' + total_vote +
                '_error" class="error-message-custom"></div>';
            html_vote += '</div>';
            $('.menu_opsi').append(html_vote).show(600);
        }

    })

    $(document).on('click', '.btn_delete_opsi', function () {
        let id = $(this).attr('id');
        let vote = $(this).attr('vote');

        $('#menu_vote_' + vote).hide(300, function () {
            $(this).remove();

            $('.menu_vote').each(function (i) {
                const x = (i + 1);
                $(this).attr('id', 'menu_vote_' + x);
                $(this).find('.span-vote').text('Opsi ' + x);
                $(this).find('.inp_vote').attr({
                    id: 'vote_' + x,
                    placeholder: 'Tulis Opsi ' + x + ' Disini',
                    'data-parsley-errors-container': '#vote_' + x +
                        '_error',
                    'data-parsley-required-message': 'Opsi Pilihan ' + x +
                        ' belum diisi.'
                });
                $(this).find('.btn_delete_opsi').attr({
                    'id': x,
                    'vote': x
                });
                $(this).find('.error-message-custom').attr('id', 'vote_' + x +
                    '_error');

            });
        });

    })

    $(function () {
        $("#tgl_vote").datepicker();
    });

</script>
<?php /**PATH C:\xampp\htdocs\desacuss\resources\views/admin/profile/js.blade.php ENDPATH**/ ?>