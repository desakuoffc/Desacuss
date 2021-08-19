<script>
    $(document).ready(function () {
        $('#tabel_user').DataTable({
            processing: true,
            serverSide: true,
            ajax: {
                url: "<?php echo e(route('user.index')); ?>"
            },
            'columnDefs': [{
                "targets": [0, 1, 2, 3, 4, 5, 6],
                "className": "text-center main",
            }, ],
            columns: [{
                    data: 'DT_RowIndex',
                    "width": "50px"
                },
                {
                    data: 'name'
                },
                {
                    data: 'desa'
                },
                {
                    data: 'role'
                },
                {
                    data: 'foto'
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

        $('#tabel_user_pending').DataTable({
            processing: true,
            serverSide: true,
            ajax: {
                url: "<?php echo e(route('user.pending')); ?>"
            },
            'columnDefs': [{
                "targets": [0, 1, 2, 3, 4, 5],
                "className": "text-center main",
            }, ],
            columns: [{
                    data: 'DT_RowIndex',
                    "width": "50px"
                },
                {
                    data: 'name'
                },
                {
                    data: 'desa'
                },
                {
                    data: 'foto'
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

        $('#tabel_user_log').DataTable({
            processing: true,
            serverSide: true,
            ajax: {
                url: "<?php echo e(route('user.log')); ?>"
            },
            'columnDefs': [{
                "targets": [0, 1, 2, 3, 4, 5, 6, 7, 8],
                "className": "text-center main",
            }, ],
            columns: [{
                    data: 'DT_RowIndex',
                    "width": "50px"
                },
                {
                    data: 'app'
                },
                {
                    data: 'aksi'
                },
                {
                    data: 'email'
                },
                {
                    data: 'oleh'
                },
                {
                    data: 'desa'
                },
                {
                    data: 'desk'
                },
                {
                    data: 'tgl'
                },
                {
                    data: 'action',
                    orderable: false,
                    searchable: false
                }
            ]
        });
    })

    $(document).on('click', '.btnLihatUser', function () {
        let id = $(this).data('id');
        getSwalLoading(1, 'Proses Pengambilan Data User', 'Mohon Tunggu...')
        $.ajax({
            url: "<?php echo e(route('user.pending.get')); ?>",
            data: {
                "_token": "<?php echo e(csrf_token()); ?>",
                id: id
            },
            method: 'post',
            dataType: 'json',
            success: function (respon) {
                getSwalLoading(0, null, null)
                $('#detail_img_user').attr('src', respon.foto_user);
                $('#detail_img_ktp').attr('src', respon.foto_ktp);
                $('#detail_status').html(respon.status);
                $('#wilayah').val(respon.wilayah);
                $('#no_ktp').val(respon.no_ktp);
                $('#nama_lengkap').val(respon.nama);
                $('#email_user').val(respon.email);
                $('#openModalDetailUser').modal('show');
            },
            error: function () {
                getSwalLoading(0, null, null)
                swal.fire('ERROR', 'Server Bermasalah. Coba Lagi Nanti', 'error')
            }
        })
    })

    $(document).on('click', '#detail_img_ktp', function () {

        let ukuran = $(this).data('ukuran');
        if (ukuran == 'kecil') {
            $('#data_lengkap').hide(600, function () {
                $('#detail_img_ktp').css({
                    'transform': 'scale(1.5)',
                    'transition': 'transform .1s'
                })
                $('#detail_img_ktp').css({
                    'width': '100%',
                    'height': '100%',
                    'transform': 'scale(1)',
                    'transition': 'transform .1s'
                })
                $('#detail_img_ktp').data('ukuran', 'besar')
            })
        } else {
            $('#detail_img_ktp').css({
                'transform': 'scale(.7)',
                'transition': 'transform .1s'
            })
            $('#detail_img_ktp').css({
                'width': '500px',
                'height': '250px',
                'transform': 'scale(1)',
                'transition': 'transform .1s'
            })
            $('#data_lengkap').show(600, function () {
                $('#detail_img_ktp').data('ukuran', 'kecil')
            })
        }
    })

    $(document).on('click', '#btn_tambah_user', function () {
        $('#modalShowAddUser').modal('show');
    })

    $(document).on('click', '#btn_import_user', function () {
        $('#openModalImportUser').modal('show');
    })

    $('#openModalImportUser').on('hidden.bs.modal', function (e) {
        $('#input-excel').fileinput('reset');
    })

    $('#openModalImportUser').on('hidden.bs.modal', function (e) {
        $("#listKotaCari").empty();
        $("#listKecCari").empty();
        $("#listDesaCari").empty();
        $('#kodeDesa').val('')
    })

    $(document).on('click', '.btn_template_user', function () {

        let role = ("<?php echo e(auth()->user()->hasRole('admin')); ?>" == "1") ? 'admin' : 'super';
        let excel = (role == "admin") ? "<?php echo e(asset('file/template_user.xlsx')); ?>" :
            "<?php echo e(asset('file/template_user_super.xlsx')); ?>";

        swal.fire({
            title: 'KONFIRMASI?',
            html: 'Unduh template excel user?',
            imageUrl: "<?php echo e(asset('img/excel.png')); ?>",
            imageWidth: 150,
            imageHeight: 150,
            showCancelButton: !0,
            reverseButtons: !0,
            cancelButtonText: 'Tidak',
            confirmButtonText: 'Ya, Unduh'
        }).then(function (e) {
            if (e.value === true) {
                let url_file = excel;
                let win = window.open(url_file, '_blank');
                if (win) {
                    swal.fire('SUKSES', 'Unduh Template Berhasil', 'success')
                    win.focus();
                } else {
                    swal.fire('Mohon izinkan popup untuk website ini.', '', 'error')
                }
            } else {
                e.dismiss;
            }
        }, function (dismiss) {
            return false;
        })
    })

    $(document).on('click', '.btn_cari_kode_desa', function () {
        getSwalLoading(1, 'Sedang Memproses Data', 'Mohon tunggu...');
        $.ajax({
            url: "<?php echo e(route('wil.kota')); ?>",
            data: {
                "_token": "<?php echo e(csrf_token()); ?>",
                id: 32
            },
            method: 'post',
            dataType: 'json',
            success: function (respon) {
                getSwalLoading(0, null, null)
                $("#listKotaCari").empty();
                $('#listKotaCari').append(new Option('Pilih Kota/Kab', '')).selectpicker('refresh');
                $.each(respon, function (id, name) {
                    $('#listKotaCari').append(new Option(name, id)).selectpicker('refresh');
                })
                $('#openModalCariKodeDesa').modal('show');
            },
            error: function () {
                getSwalLoading(0, null, null)
                swal.fire('TERJADI MASALAH', 'Coba lagi nanti', 'error')
            }
        })
    })

    $(document).on('click', '#btnSalinKodeDesa', function () {
        $('#formCariDesa').parsley().validate();
        if ($('#formCariDesa').parsley().isValid()) {
            let copyText = document.getElementById("kodeDesa");
            copyText.select();
            copyText.setSelectionRange(0, 99999);
            document.execCommand("copy");
            getSwalMini('Kode desa berhasil disalin', 'success', 3000, 'top')
        }
    })

    // MODAL CLOSE
    $('.btn-close-add-user').click(function () {
        swal.fire({
            title: 'Tutup menu user?',
            html: 'Data yang sudah diisi tidak akan <b>tersimpan</b>.',
            showCancelButton: !0,
            reverseButtons: !0,
            cancelButtonText: 'Tidak',
            confirmButtonText: 'Ya, Tutup'
        }).then(function (e) {
            if (e.value === true) {
                $('#formAddUser')[0].reset();
                $('#modalShowAddUser').modal('hide');
                $('#cardHeaderUserAdd').html('Tambah User');
                $('.btn-confirm-add-user').text('Tambah')
                $('#cardFotoUser').show();
                $('#rowPassword').show();
                $('#cardFotoUserBox').show();
                $('#btnConfirmAddUser').attr('disabled', false);
                $('#emailUser').attr('readonly', false);

                $('#password').attr('required', true);
                $('#password-konfirmasi').attr('required', true);

                $('#listProvinsi').attr('required', true);
                $('#listKota').attr('required', true);
                $('#listKec').attr('required', true);
                $('#listDesa').attr('required', true);
                $('.wilayah').show();
                $('#btnConfirmAddUser').attr('disabled', false);

                $('#input-b6').attr('required', true);

                $('#wilayahBox').hide();
                $('#cekboxWil').prop('checked', false);

            } else {
                e.dismiss;
            }
        }, function (dismiss) {
            return false;
        })
    })

    $('.btn-confirm-add-user').on('click', function () {
        let text = $(this).html();

        $('#formAddUser').parsley().validate();
        if ($('#formAddUser').parsley().isValid()) {
            let formDatas = $('#formAddUser').get(0);
            let formPack = new FormData(formDatas);
            formPack.append('status', text);

            swal.fire({
                title: 'KONFIRMASI',
                html: 'Data sudah sesuai? lanjutkan proses?',
                showCancelButton: !0,
                reverseButtons: !0,
                cancelButtonText: 'Cek lagi',
                confirmButtonText: 'Ya, Lanjut'
            }).then(function (e) {
                if (e.value === true) {
                    getSwalLoading(1, 'Sedang Memproses Data', 'Mohon Tunggu...')
                    $.ajax({
                        url: "<?php echo e(route('user.create')); ?>",
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
                                    text: respon.message,
                                    icon: 'success'
                                })
                                $('#tabel_user').DataTable().ajax.reload();
                                resetForm();
                            } else {
                                swal.fire({
                                    title: 'INFORMASI',
                                    text: respon.message,
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

    // HAPUS USER
    $(document).on('click', '.btnEditDelete', function () {
        let id = $(this).data('id');
        let nama = $(this).data('name');
        let status = $(this).data('status');

        let pesan =
            `Hapus user ${nama}?<br> semua data <b>diskusi, like, komentar, dan voting akan otomatis terhapus.</b><br> Lanjut hapus user?`;
        let teks = (status == 'aktif') ? pesan : `Hapus user pending ${nama}?`;

        swal.fire({
            title: 'KONFIRMASI',
            html: teks,
            showCancelButton: !0,
            reverseButtons: !0,
            cancelButtonText: 'Tidak',
            confirmButtonText: 'Ya, Hapus'
        }).then(function (e) {
            if (e.value === true) {
                getSwalLoading(1, 'Proses Penghapusan User', 'Mohon Tunggu...')
                $.ajax({
                    url: "<?php echo e(route('user.delete')); ?>",
                    data: {
                        "_token": "<?php echo e(csrf_token()); ?>",
                        id: id,
                        nama: nama,
                        status: status
                    },
                    method: 'post',
                    dataType: 'json',
                    success: function (respon) {
                        getSwalLoading(0, null, null)
                        if (respon.success) {
                            swal.fire({
                                title: 'INFORMASI',
                                text: respon.message,
                                icon: 'success'
                            })
                            $('#tabel_user').DataTable().ajax.reload();
                            $('#tabel_user_pending').DataTable().ajax.reload();
                        } else {
                            swal.fire({
                                title: 'INFORMASI',
                                text: respon.message,
                                icon: 'error'
                            })
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
            return false;
        })
    })

    // SET STATUS PENDING
    $(document).on('click', '.btn_status', function () {
        let id = $(this).data('id');
        let nama = $(this).data('name');
        let status = $(this).attr('id');
        let pesans = $(this).data('pesan');

        let terima =
            `Terima user ${nama}?<br> Dengan menerima user, user tersebut dapat mengakses forum diskusi.<br> Lanjutkan proses?`;
        let tolak = `Tolak user ${nama}?.<br> Lanjutkan proses?`;

        let teks = (status == 'terima') ? terima : tolak;

        swal.fire({
            title: 'KONFIRMASI',
            html: teks,
            showCancelButton: !0,
            reverseButtons: !0,
            cancelButtonText: 'Tidak',
            confirmButtonText: 'Ya, Lanjutkan'
        }).then(function (e) {
            if (e.value === true) {
                if (status == 'tolak') {
                    (async () => {
                        const {
                            value: text
                        } = await Swal.fire({
                            title: 'Pesan Registrasi Ditolak',
                            input: 'textarea',
                            inputPlaceholder: 'Tulis alasan registrasi ditolak disini...',
                            inputAttributes: {
                                'aria-label': 'Tulis alasan registrasi ditolak disini...'
                            },
                            showCancelButton: false,
                            confirmButtonText: 'Kirim',
                            allowOutsideClick: false,
                            inputValidator: (value) => {
                                if (!value) {
                                    return 'Pesan tidak boleh kosong, tuliskan sesuatu!'
                                } else {
                                    getSwalLoading(1, 'Sedang Memproses Data',
                                        'Mohon Tunggu...')
                                    $.ajax({
                                        url: "<?php echo e(route('user.pending.update')); ?>",
                                        method: "POST",
                                        data: {
                                            "_token": "<?php echo e(csrf_token()); ?>",
                                            id: id,
                                            nama: nama,
                                            status: 'tolak',
                                            pesan: value
                                        },
                                        success: function (data) {
                                            getSwalLoading(0, null,
                                                null)
                                            if (data.success) {
                                                $('#tabel_user')
                                                    .DataTable().ajax
                                                    .reload();
                                                $('#tabel_user_pending')
                                                    .DataTable().ajax
                                                    .reload();
                                                swal.fire({
                                                    title: "INFORMASI",
                                                    html: data
                                                        .message,
                                                    icon: 'success',
                                                    showConfirmButton: true
                                                }).then(
                                                    function () {
                                                        getSwalLoading
                                                            (1, 'Proses Mengirim Email',
                                                                'Mohon Tunggu...'
                                                            )
                                                        sendMail(
                                                            id);
                                                    })

                                            } else {
                                                swal.fire({
                                                    title: 'INFORMASI',
                                                    html: data
                                                        .message,
                                                    icon: 'error',
                                                    showConfirmButton: true
                                                })
                                            }
                                        },
                                        error: function () {
                                            getSwalLoading(0, null,
                                                null)
                                            swal.fire('ERROR',
                                                'Server Bermasalah. Coba Lagi Nanti',
                                                'error')
                                        }
                                    })

                                }
                            }
                        })
                    })()


                } else {
                    getSwalLoading(1, 'Sedang Memproses Data', 'Mohon Tunggu...')
                    $.ajax({
                        url: "<?php echo e(route('user.pending.update')); ?>",
                        data: {
                            "_token": "<?php echo e(csrf_token()); ?>",
                            id: id,
                            nama: nama,
                            status: 'terima'
                        },
                        method: 'post',
                        dataType: 'json',
                        success: function (respon) {
                            if (respon.success) {
                                swal.fire({
                                    title: 'INFORMASI',
                                    html: respon.message,
                                    icon: 'success'
                                })
                                $('#tabel_user').DataTable().ajax.reload();
                                $('#tabel_user_pending').DataTable().ajax.reload();
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
                }
            } else {
                e.dismiss;
            }
        }, function (dismiss) {
            return false;
        })
    })

    function sendMail(id) {
        $.ajax({
            url: "<?php echo e(route('user.pending.get')); ?>",
            data: {
                '_token': "<?php echo e(csrf_token()); ?>",
                id: id
            },
            method: 'post',
            dataType: 'json',
            success: function (d) {
                $.ajax({
                    url: "<?php echo e(route('send.email')); ?>",
                    data: {
                        '_token': "<?php echo e(csrf_token()); ?>",
                        nama: d.nama,
                        email: d.email,
                        desa: d.desa,
                        status: d.status2,
                        pesan: d.pesan
                    },
                    method: 'post',
                    dataType: 'json',
                    success: function (data) {
                        if (data.success) {

                            getSwalLoading(0, null, null)

                            swal.fire({
                                icon: 'success',
                                html: '<p style="margin-left:1rem">Email berhasil dikirim</p>'
                            })

                        } else {
                            swal.fire({
                                title: 'EMAIL GAGAL TERKIRIM',
                                html: 'Kirim ulang email?',
                                icon: 'error',
                                showCancelButton: !0,
                                confirmButtonText: 'Kirim Ulang!',
                                cancelButtonText: 'Tidak',
                                reverseButtons: !0
                            }).then(function (e) {
                                if (e.value === true) {
                                    sendMail(id);
                                } else {
                                    e.dismiss;
                                    swal.fire({
                                        title: "Email tidak dikirim",
                                        icon: 'error'
                                    })
                                }
                            }, function (dismiss) {
                                return false;
                            })
                        }
                    },
                    error: function () {
                        swal.fire('ERROR', 'Server Bermalasah', 'error')
                    }
                })
            },
            error: function () {
                swal.fire('ERROR', 'Server Bermalasah', 'error')
            }
        })
    }


    // IMPORT EXCEL
    $('#btnConfirmImportUser').on('click', function () {

        $('#formImportExcel').parsley().validate();
        if ($('#formImportExcel').parsley().isValid()) {
            let formDatas = $('#formImportExcel').get(0);
            let formPack = new FormData(formDatas);
            swal.fire({
                title: 'KONFIRMASI',
                html: 'Data sudah sesuai? lanjutkan proses import user?',
                imageUrl: "<?php echo e(asset('img/excel.png')); ?>",
                imageWidth: 150,
                imageHeight: 150,
                showCancelButton: !0,
                reverseButtons: !0,
                cancelButtonText: 'Cek lagi',
                confirmButtonText: 'Ya, Lanjut'
            }).then(function (e) {
                if (e.value === true) {
                    getSwalLoading(1, 'Proses import data', 'Mohon tunggu')
                    $.ajax({
                        url: "<?php echo e(route('user.import')); ?>",
                        data: formPack,
                        method: 'post',
                        dataType: 'json',
                        processData: false,
                        contentType: false,
                        success: function (respon) {
                            getSwalLoading(0, null, null)
                            $('#openModalImportUser').modal('hide')
                            swal.fire({
                                title: `SUKSES MENGIMPORT DATA`,
                                icon: 'success',
                                html: respon.message
                            }).then(function () {
                                $('#tabel_user').DataTable().ajax.reload();
                                $('#input-excel').fileinput('reset');
                            })
                        },
                        error: function (respon) {
                            getSwalLoading(0, null, null)
                            let total = respon.responseJSON.errors.length
                            let ht = ''

                            ht += `<h5>Terdapat ${total} kesalahan, detail kesalahan:</h5>`
                            ht += `<ul class="font-14 remove_bullet max-300 p-2">`
                            for (let index = 0; index < total; index++) {
                                ht += `<div class="alert alert-danger p-1" role="alert">`
                                ht += `<li>${respon.responseJSON.errors[index]}</li>`
                                ht += `</div>`
                            }
                            ht += `</ul>`

                            swal.fire({
                                title: `GAGAL MENGIMPORT DATA`,
                                icon: 'error',
                                html: ht
                            })
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
    // END IMPORT EXCEL

















    $(document).on('click', '#btnEditUser', function () {
        let val = $(this).data('id');

        $.ajax({
            url: "<?php echo e(route('user.edit')); ?>",
            data: {
                "_token": "<?php echo e(csrf_token()); ?>",
                id: val
            },
            method: 'post',
            dataType: 'json',
            success: function (respon) {
                let name = respon.user.name;
                let email = respon.user.email;
                let role = respon.role;

                $('#listRole').val(role);
                $('.selectpicker').selectpicker('refresh')

                $('#values').val(val);
                $('#namaUser').val(name);
                $('#emailUser').val(email);
                $('#cardHeaderUserAdd').html('Edit User');
                $('.btn-confirm-add-user').text('Update')
                $('#cardFotoUser').hide();
                $('#cardFotoUserBox').hide();
                $('#rowPassword').hide();
                $('#input-b6').attr('required', false);

                $('#emailUser').attr('readonly', true);

                $('#password').attr('required', false);
                $('#password-konfirmasi').attr('required', false);

                $('#listProvinsi').attr('required', false);
                $('#listKota').attr('required', false);
                $('#listKec').attr('required', false);
                $('#listDesa').attr('required', false);
                $('.wilayah').hide();
                $('#wilayahBox').show();



                $('#modalShowAddUser').modal('show');
            }
        })

    })

    $("#emailUser").on('keyup', function () {
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
                        '<span style="color: red;" role="alert">Email sudah terdaftar, gunakan email lain!</span>';
                    if (response == 1) {
                        $('#btnConfirmAddUser').attr('disabled', true);
                        $('#uname_response_email').html(red);
                    } else {
                        $('#btnConfirmAddUser').attr('disabled', false);
                        $("#uname_response_email").html("");
                    }
                }
            });
        } else {
            $("#uname_response_email").html("");
        }
    });

    function resetForm() {
        $('#formAddUser')[0].reset();
        $('#listRole').val('');
        $('#modalShowAddUser').modal('hide');
        $('#cardHeaderUserAdd').html('Tambah User');
        $('.btn-confirm-add-user').text('Tambah')
        $('#cardFotoUser').show();
        $('#rowPassword').show();
        $('#cardFotoUserBox').show();
        $('#btnConfirmAddUser').attr('disabled', false);
        $('#emailUser').attr('readonly', false);

        $('#password').attr('required', true);
        $('#password-konfirmasi').attr('required', true);

        $('#listProvinsi').attr('required', true);
        $('#listKota').attr('required', true);
        $('#listKec').attr('required', true);
        $('#listDesa').attr('required', true);
        $('.wilayah').show();
        $('#btnConfirmAddUser').attr('disabled', false);

        $('#input-b6').attr('required', true);

        $('#wilayahBox').hide();
        $('#cekboxWil').prop('checked', false);
    }



    $('#passwordShow').click(function () {
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

    $('#passwordKonfirmasiShow').click(function () {
        if ($('#password-konfirmasi').attr('type') == 'password') {
            $(this).removeClass('fa-eye-slash')
            $('#password-konfirmasi').attr('type', 'text')
            $(this).addClass('fa-eye')
        } else if ($('#password-konfirmasi').attr('type') == 'text') {
            $(this).removeClass('fa-eye')
            $('#password-konfirmasi').attr('type', 'password')
            $(this).addClass('fa-eye-slash')
        }
    })

    $('#cekboxFoto').on('click', function () {
        if ($(this).is(":checked")) {
            $('#input-b6').attr({
                'required': false,
            }).val('');
            $(this).val('1');
            $('#cardFotoUser').hide(1100);
        } else {
            $('#input-b6').attr({
                'required': true,
                'readonly': false,
                'placeholder': '081xxxxx'
            });
            $(this).val('0')
            $('#cardFotoUser').show(1100);
        }
    })

    $('#cekboxWil').on('click', function () {
        if ($(this).is(":checked")) {
            $('#listProvinsi').attr('required', true);
            $('#listKota').attr('required', true);
            $('#listKec').attr('required', true);
            $('#listDesa').attr('required', true);
            $(this).val('1');
            $('.wilayah').show(1100);
        } else {
            $('#listProvinsi').attr('required', false);
            $('#listKota').attr('required', false);
            $('#listKec').attr('required', false);
            $('#listDesa').attr('required', false);
            $(this).val('0')
            $('.wilayah').hide(1100);
        }
    })

    $("#input-b6").fileinput({
        elErrorContainer: '#kartik-file-errors',
        showUpload: false,
        dropZoneEnabled: false,
        maxFileCount: 1,
        mainClass: "input-group-sm",
        language: 'id',
    });

    $("#input-excel").fileinput({
        elErrorContainer: '#kartik-excel-errors',
        showUpload: false,
        dropZoneEnabled: false,
        maxFileCount: 1,
        mainClass: "input-group-sm",
        language: 'id',
    });

    // WILAYAH

    $(document).on('change', '#listProvinsi', function () {
        $.ajax({
            url: "<?php echo e(route('wil.kota')); ?>",
            data: {
                "_token": "<?php echo e(csrf_token()); ?>",
                id: $(this).val()
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

    // CARI KODE DESA
    $(document).on('change', '#listKotaCari', function () {
        $.ajax({
            url: "<?php echo e(route('wil.kec')); ?>",
            data: {
                "_token": "<?php echo e(csrf_token()); ?>",
                id: $(this).val()
            },
            method: 'post',
            dataType: 'json',
            success: function (respon) {
                $('#listKecCari').empty();
                $('#listKecCari').append(new Option('Pilih Kecamatan', '')).selectpicker('refresh');
                $.each(respon, function (id, name) {
                    $('#listKecCari').append(new Option(name, id)).selectpicker('refresh');
                })
            }
        })
    })

    $(document).on('change', '#listKecCari', function () {
        $.ajax({
            url: "<?php echo e(route('wil.desa')); ?>",
            data: {
                "_token": "<?php echo e(csrf_token()); ?>",
                id: $(this).val()
            },
            method: 'post',
            dataType: 'json',
            success: function (respon) {
                $('#listDesaCari').empty();
                $('#listDesaCari').append(new Option('Pilih Desa', '')).selectpicker('refresh');
                $.each(respon, function (id, name) {
                    $('#listDesaCari').append(new Option(name, id)).selectpicker('refresh');
                })
            }
        })
    })

    $(document).on('change', '#listDesaCari', function () {
        let val = $(this).val();
        $('#kodeDesa').val(val)
    })



    // END WILAYAH

    $(document).on('click', '#btnDeleteLog', function () {
        let id = $(this).data('id')
        swal.fire({
            title: 'KONFIRMASI',
            html: 'Hapus data Log?',
            icon: 'warning',
            showCancelButton: !0,
            reverseButtons: !0,
            cancelButtonText: 'Tidak',
            confirmButtonText: 'Ya, Hapus'
        }).then(function (e) {
            if (e.value === true) {

                $.ajax({
                    url: "<?php echo e(route('user.log.delete')); ?>",
                    data: {
                        "_token": "<?php echo e(csrf_token()); ?>",
                        id: id
                    },
                    method: 'post',
                    dataType: 'json',
                    success: function (respon) {
                        if (respon.success) {
                            $('#tabel_user_log').DataTable().ajax.reload();
                            swal.fire({
                                title: 'INFORMASI',
                                html: respon.message,
                                icon: 'success'
                            })
                        } else {
                            swal.fire({
                                title: 'INFORMASI',
                                html: respon.message,
                                icon: 'error'
                            })
                        }

                    },
                    error: function () {
                        swal.fire({
                            title: 'INFORMASI',
                            html: 'Server sedang bermasalah, coba lagi nanti',
                            icon: 'error'
                        })
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
<?php /**PATH C:\xampp\htdocs\desacuss\resources\views/admin/user/js.blade.php ENDPATH**/ ?>