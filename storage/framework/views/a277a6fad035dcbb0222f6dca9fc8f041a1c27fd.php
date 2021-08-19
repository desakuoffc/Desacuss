<script>
    $(document).ready(function () {
        $('#tabel_diskusi').DataTable({
            processing: true,
            serverSide: true,
            ajax: {
                url: "<?php echo e(route('diskusi.index')); ?>"
            },
            'columnDefs': [{
                "targets": [0, 1, 2, 3, 4, 5, 6, 7],
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
                    data: 'user'
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

        window.Parsley.addValidator('summernoteRequired', {
            validateString: function (value, _value, _el) {
                var val = $($(_el.$element[0]).val()).text().trim();
                if (val.length < 1) return false;
            }
        });

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

    $(document).on('click', '.btn_status', function () {
        let id = $(this).data('id');
        let nama = $(this).data('name');
        let status = $(this).attr('id');

        let show =
            `Set status diskusi ${nama} menjadi <b>terlihat</b>?<br>Forum Diskusi ${nama} akan terlihat oleh warga.<br>Lanjutkan Proses?`;
        let close =
            `Set status diskusi ${nama} menjadi <b>tertutup</b>?<br>Forum Diskusi ${nama} akan terlihat oleh warga namun warga <b class="merah">tidak dapat berkomentar</b> diforum tersebut.<br>Lanjutkan Proses?`;
        let hide =
            `Set status diskusi ${nama} menjadi <b>tersembunyi</b>?<br>Forum Diskusi ${nama} <b class="merah">tidak akan terlihat oleh warga</b>.<br>Lanjutkan Proses?`;
        let pesan = (status == "terlihat") ? show : ((status == "tertutup") ? close : hide)

        swal.fire({
            title: 'KONFIRMASI',
            html: pesan,
            icon: 'warning',
            reverseButtons: !0,
            showCancelButton: !0,
            confirmButtonText: 'Lanjutkan',
            cancelButtonText: 'Tidak'
        }).then(function (e) {
            if (e.value === true) {
                getSwalLoading(1, 'Proses Update Status', 'Mohon Tunggu...')
                $.ajax({
                    url: "<?php echo e(route('diskusi.set.status')); ?>",
                    data: {
                        "_token": "<?php echo e(csrf_token()); ?>",
                        id: id,
                        nama: nama,
                        status: status
                    },
                    dataType: 'json',
                    method: 'post',
                    success: function (respon) {
                        getSwalLoading(0, null, null)
                        if (respon.success) {
                            $('#tabel_diskusi').DataTable().ajax.reload();
                            $('#tabel_kategori').DataTable().ajax.reload();
                            swal.fire('INFORMASI', respon.message, 'success');
                        } else {
                            swal.fire('INFORMASI', respon.message, 'error');
                        }
                    },
                    error: function () {
                        getSwalLoading(0, null, null)
                        swal.fire('ERROR', 'Server Bermasalah. Coba Lagi Nanti', 'error')
                    }
                })
            } else {
                return e.dismiss;
            }
        }, function (dismiss) {
            return false;
        });
    })

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
                getSwalLoading(1, 'Proses Hapus Diskusi', 'Mohont Tunggu...')
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
                        getSwalLoading(0, null, null)
                        if (respon.success) {
                            $('#tabel_diskusi').DataTable().ajax.reload();
                            $('#tabel_kategori').DataTable().ajax.reload();
                            swal.fire('INFORMASI', respon.message, 'success');
                        } else {
                            swal.fire('INFORMASI', respon.message, 'error');
                        }
                    },
                    error: function () {
                        getSwalLoading(0, null, null)
                        swal.fire('ERROR', 'Server Bermasalah. Coba Lagi Nanti', 'error')
                    }
                })
            } else {
                return e.dismiss;
            }
        }, function (dismiss) {
            return false;
        });
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
                    getSwalLoading(1, 'Proses Update Diskusi', 'Mohon Tunggu...')
                    $.ajax({
                        url: "<?php echo e(route('diskusi.update')); ?>",
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
        } else {
            swal.fire('Terdapat Kolom Yang Kosong!', '', 'error')
        }
    })

    $(document).on('click', '.btn_add_diskusi', function () {
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
                    getSwalLoading(1, 'Proses Tambah Diskusi', 'Mohon Tunggu...')
                    $.ajax({
                        url: "<?php echo e(route('diskusi.create')); ?>",
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
                        },
                        error: function () {
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
        } else {
            swal.fire('Terdapat Kolom Yang Kosong!', '', 'error')
        }
    })

    $(document).on('click', '.btnEditDiskusi', function () {
        let id = $(this).data('id');

        getSwalLoading(1, 'Proses Pengambilan Data', 'Mohon Tunggu...')
        $.ajax({
            url: "<?php echo e(route('diskusi.edit')); ?>",
            data: {
                "_token": "<?php echo e(csrf_token()); ?>",
                id: id
            },
            method: 'post',
            dataType: 'json',
            success: function (respon) {
                getSwalLoading(0, null, null)
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
                // $('#deskDiskusi').val(desk);
                // $('#deskDiskusi').code(desk);
                $("#deskDiskusi").summernote("code", desk);
                // $("#listKategori").val(kategori);

                $('#listKategori').selectpicker('refresh');
                $('#listKategori').val(7);
                $('#listKategori').selectpicker('refresh');

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
            },
            error: function () {
                getSwalLoading(0, null, null)
                swal.fire('ERROR', 'Server Bermasalah. Coba Lagi Nanti', 'error')
            }
        })
    })

    $(document).on('click', '.btnDetailDiskusi', function () {
        let id = $(this).data('id');

        getSwalLoading(1, 'Proses Mengambil Data', 'Mohon Tunggu...')
        $.ajax({
            url: "<?php echo e(route('diskusi.detail')); ?>",
            data: {
                "_token": "<?php echo e(csrf_token()); ?>",
                id: id
            },
            method: 'post',
            dataType: 'json',
            success: function (respon) {
                getSwalLoading(0, null, null)
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
                        html += '<div class="progress-bar" role="progressbar" style="width: ' +
                            arr_vote_persen[index] + '%;"';
                        html +=
                            'aria-valuenow="' + arr_vote_total[index] +
                            '" aria-valuemin="0" aria-valuemax="100">' + arr_vote_persen[index] +
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

                }

                $('#openModalDetailDiskusi').modal('show');
            },
            error: function () {
                getSwalLoading(0, null, null)
                swal.fire('ERROR', 'Server Bermasalah. Coba Lagi Nanti', 'error')
            }
        })

        // $('#openModalDetailDiskusi').modal('show');

    })

    $('#openModalDetailDiskusi').on('hidden.bs.modal', function (e) {
        $('#detail_menu_voting').hide();
    })

    $(document).on('click', '#btn_tambah_diskusi', function () {
        getKategori(null);
        showHide();
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

        $('#menu_vote_3').remove()
        $('#menu_vote_4').remove()
        $('#menu_vote_5').remove()

        $('#nama_diskusi').attr('required', false);
        $('#listKategori').attr('required', false);
        $('#deskDiskusi').attr('required', false);

        $('#listKategori').val('');
        // $('#deskDiskusi').val('');
        $("#deskDiskusi").summernote("reset");
        $('.selectpicker').selectpicker('refresh');

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

        // let total_vote = $('.menu_vote').length;
        // for (let index = 1; index <= total_vote; index++) {
        //     $('#vote_' + index).attr('required', true);
        // }
    }

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
<?php /**PATH C:\xampp\htdocs\desacuss_new\resources\views/admin/diskusi/js.blade.php ENDPATH**/ ?>