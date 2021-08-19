<script>
    $(document).ready(function () {
        $('#tabel_musrenbang').DataTable({
            processing: true,
            serverSide: true,
            ajax: {
                url: "<?php echo e(route('musrenbang.index')); ?>"
            },
            'columnDefs': [{
                "targets": [0, 1, 2, 3, 4, 5, 6],
                "className": "text-center main",
            }, ],
            columns: [{
                    data: 'DT_RowIndex'
                },
                {
                    data: 'nama_musrenbang'
                },
                {
                    data: 'progres'
                },
                {
                    data: 'biaya'
                },
                {
                    data: 'anggota'
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
    });

    // window.Parsley.addValidator('summernoteRequired', {
    //     validateString: function (value, _value, _el) {
    //         var val = $($(_el.$element[0]).val()).text().trim();
    //         if (val.length < 1) return false;
    //     }
    // });


    var url_post_musrenbang = "https://desaku-desatour.masuk.id/api/musrenbang";
    var url_cek = "https://desaku-desatour.masuk.id/api/musrenbang/cek";
    var url_kategori = "https://desaku-desatour.masuk.id/api/musrenbang/kategori";

    $(document).on('click', '.btnPublish', function () {
        let id = $(this).data('id');
        let nama = $(this).data('name');
        let desk = $(this).data('desk');
        let biaya = $(this).data('biaya');
        let terbilang = $(this).data('terbilang');
        let wilayah = $(this).data('wilayah');
        let desa = $(this).data('desa');

        let ht = `<h2>Musyawarah Rencana Pembangunan Desa</h2>`;
        ht += `<small>${desa}, <?php echo e(tgl_sekarang()); ?></small>`;
        ht += `<hr>`;
        ht += `<p>${wilayah}, Merencanakan Musrenbang dengan nama program <b>${nama}</b>.</p>`;
        ht += `<p>Adapun biaya yang dikeluarkan sebesar ${biaya} (${terbilang}).</p>`;
        ht += `${desk}`;
        ht += `<p>(Lanjutkan isi deskripsi disini...)</p>`;
        ht += `<small>${desa}, <?php echo e(tgl_sekarang()); ?></small>`;
        ht += ``;
        $('#nama_infrastruktur').val(nama);
        $("#desk_infrastruktur").summernote("code", ht);
        $('#modalPublish').modal('show');

        getSwalLoading(1, 'Proses Pengecekan Data Musrenbang', 'Mohon Tunggu...')

        $.post(url_cek, {
                id_desa: "<?php echo e(auth()->user()->id_desa); ?>",
                judul: nama
            })
            .done(function (respon) {
                getSwalLoading(0, null, null)
                if (respon.kosong) {
                    $.post(url_kategori, {
                            id_desa: "<?php echo e(auth()->user()->id_desa); ?>"
                        })
                        .done(function (respon2) {
                            if (respon2.kosong) {
                                swal.fire({
                                    title: 'Gagal',
                                    icon: 'error',
                                    html: `Pihak <?php echo e(wilayah(auth()->user()->id_desa)['desa']); ?> masih belum menyediakan data kategori infrastruktur.<br> Silahkan untuk menghubungi pihak admin dari DesaTour.`
                                }).then(function () {
                                    $('#modalPublish').modal('hide');
                                })
                            } else if (respon2.success) {
                                let html = '';
                                $('#listKategoriInfra').empty();
                                $.each(respon2.kategori, function (id, data) {
                                    html += '<option value="' + data.id_kategori + '"';
                                    html +=
                                        `data-content="<span class='badge bg-${data.warna}'>${data.nama}</span>"`;
                                    html += '</option>';
                                })
                                $('#listKategoriInfra').append(html).selectpicker('refresh');
                                resetPublishRevert();
                            } else {
                                swal.fire('Server Bermasalah.', 'Coba lagi nanti.', 'error').then(
                                    function () {
                                        $('#modalPublish').modal('hide');
                                    });
                            }
                        })
                        .fail(function () {
                            swal.fire('Server Bermasalah.', 'Coba lagi nanti.', 'error').then(
                                function () {
                                    $('#modalPublish').modal('hide');
                                });
                        })
                } else if (respon.success) {
                    if (respon.status == 'pending') {
                        ht =
                            `Data Musrenbang <b>${respon.judul}</b> status <b class="merah">Pending</b><br>`;
                        ht += `Tunggu sampai admin DesaTour mem<i>Publish</i>nya.`;
                        $('.menu_status_infra').html(ht);
                        $('#overlay').fadeOut(600, function () {
                            $('.menu_status_infra').fadeIn(600)
                        })

                    } else if (respon.status == 'publish') {
                        ht =
                            `Data Musrenbang <b>${respon.judul}</b> sudah di <b class="hijau-desa">Publish</b> oleh admin DesaTour<br>`;
                        ht += `<a href="${respon.url}" class="cursor">Klik disini</a> untuk melihatnya..`;
                        $('.menu_status_infra').html(ht);
                        $('#overlay').fadeOut(600, function () {
                            $('.menu_status_infra').fadeIn(600)
                        })
                    }
                } else {
                    swal.fire('Server Bermasalah.', 'Coba lagi nanti.', 'error').then(function () {
                        $('#modalPublish').modal('hide');
                    });
                }
            })
            .fail(function () {
                getSwalLoading(0, null, null)
                swal.fire('Server Bermasalah.', 'Coba lagi nanti.', 'error');
            });
    })

    $(document).on('click', '.btnPublishInfra', function () {
        $('#formPublish').parsley().validate();
        if ($('#formPublish').parsley().isValid()) {
            let formDatas = $('#formPublish').get(0);
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
                    getSwalLoading(1, 'Proses Publish Musrenbang', 'Mohont Tunggu...')
                    $.ajax({
                        url: url_post_musrenbang,
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
                                }).then(function () {
                                    $('#modalPublish').modal('hide');
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
                            getSwalLoading(0, null, null)
                            swal.fire('Server Bermasalah.', 'Coba lagi nanti.', 'error')
                                .then(function () {
                                    // $('#modalPublish').modal('hide');
                                });
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

    $('#modalPublish').on('hidden.bs.modal', function (e) {
        resetPublish();
    })

    function resetPublish() {
        $('#formPublish')[0].reset();
        $("#desk_infrastruktur").summernote("reset");
        $('#modal_cek_publish').removeClass('modal-xl')
        $('#modal_publish_header').hide()
        $('#modal_publish_body').hide()
        $('.menu_form_publish').hide()
        $('.btnPublishInfra').hide()
        $('#overlay').show()
        $('.menu_status_infra').hide().text('');
    }

    function resetPublishRevert() {
        $('#overlay').fadeOut(600, function () {
            $('#modal_cek_publish').addClass("modal-xl", 600, "easeOutBounce", function () {
                $('#modal_publish_header').show(600)
                $('#modal_publish_body').show(600, function () {
                    $('.menu_form_publish').show(600)
                    $('.btnPublishInfra').show(600)
                })
            });

        })
    }


    $("#input-b6").fileinput({
        elErrorContainer: '#kartik-file-errors',
        showUpload: false,
        dropZoneEnabled: false,
        maxFileCount: 3,
        mainClass: "input-group-sm",
        language: 'id',
    });

    $(document).on('click', '.btnDeleteMusrenbang', function () {
        let id = $(this).data('id');
        let nama = $(this).data('name');

        swal.fire({
            title: 'KONFIRMASI',
            html: 'Hapus Musrenbang ' + nama + '?',
            icon: 'warning',
            reverseButtons: !0,
            showCancelButton: !0,
            confirmButtonText: 'Ya, Hapus',
            cancelButtonText: 'Tidak'
        }).then(function (e) {
            if (e.value === true) {
                getSwalLoading(1, 'Proses Penghapusan Data Musrenbang', 'Mohon Tunggu')
                $.ajax({
                    url: "<?php echo e(route('musrenbang.delete')); ?>",
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
                            $('#tabel_musrenbang').DataTable().ajax.reload();
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

    $(document).on('click', '.btnEditDesk', function () {
        let id = $(this).data('id');
        let nama = $(this).data('name');
        let status = $(this).attr('id');

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
                $('#nama_musrenbang_edt').val(data.nama_musrenbang)
                $('#tgl_start_edt').val(data.tgl_start)
                $('#tgl_end_edt').val(data.tgl_end)
                $('#deskVal').val(data.id_musrenbang);
                $("#deskmusrenbangedt").summernote("code", data.deskripsi_musrenbang);
                $('#modalShowDeskMusrenbang').modal('show');
            }
        })
    })

    $('#modalShowDeskMusrenbang').on('hidden.bs.modal', function (e) {
        $('#formEditDeskMusrenbang')[0].reset();
    })

    $(document).on('click', '#btnCetakMusrenbang', function () {
        let id = $(this).data('id');
        let nama = $(this).data('name');

        cetakLaporan(id, nama)

    })

    function cetakLaporan(id, nama) {
        swal.fire({
            title: "KONFIRMASI",
            html: `Cetak Laporan Musrenbang<br><b>${nama}</b>`,
            imageUrl: "<?php echo e(asset('img/printer.svg')); ?>",
            imageWidth: 150,
            imageHeight: 150,
            imageAlt: 'https://freeiconshop.com/icon/print-icon-flat/',
            showCancelButton: !0,
            confirmButtonText: "Ya, Cetak",
            cancelButtonText: "Tidak",
            reverseButtons: !0
        }).then(function (e) {
            if (e.value === true) {
                getSwalLoading(1, 'Proses Cetak Laporan', 'Mohon Tunggu...')
                $.ajax({
                    url: "<?php echo e(route('musrenbang.cetak')); ?>",
                    method: "POST",
                    data: {
                        "_token": "<?php echo e(csrf_token()); ?>",
                        id: id,
                        nm: nama
                    },
                    dataType: "json",
                    success: function (data) {
                        getSwalLoading(0, null, null)
                        cetakAlert(id, nama)
                    },
                    error: function () {
                        getSwalLoading(0, null, null)
                        cetakAlert(id, nama)
                    }
                });
            } else {
                e.dismiss;
            }
        }, function (dismiss) {
            return false;
        })
    }

    function cetakAlert(id, nama) {
        Swal.fire({
            title: 'Cetak laporan sudah diproses',
            showDenyButton: true,
            showCancelButton: false,
            confirmButtonText: `Tutup`,
            denyButtonText: `Ulangi proses cetak laporan`,
        }).then((result) => {
            if (result.isConfirmed) {
                Swal.fire('Ok!', '', 'success')
            } else if (result.isDenied) {
                cetakLaporan(id, nama)
            }
        })
    }

    $(document).on('click', '#btnUpdateDesk', function () {
        $('#formEditDeskMusrenbang').parsley().validate();
        if ($('#formEditDeskMusrenbang').parsley().isValid()) {
            let formDatas = $('#formEditDeskMusrenbang').get(0);
            let formPack = new FormData(formDatas);
            formPack.append('status', 'deskripsi');
            swal.fire({
                title: 'KONFIRMASI',
                html: 'Data sudah sesuai? lanjutkan proses?',
                showCancelButton: !0,
                reverseButtons: !0,
                cancelButtonText: 'Cek lagi',
                confirmButtonText: 'Ya, Lanjut'
            }).then(function (e) {
                if (e.value === true) {
                    getSwalLoading(1, 'Proses Update Musrenbang', 'Mohon Tunggu...')
                    $.ajax({
                        url: "<?php echo e(route('musrenbang.update')); ?>",
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
                                $('#modalShowDeskMusrenbang').modal('hide');
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
        } else {
            swal.fire('Terdapat Kolom Yang Kosong!', '', 'error')
        }
    })

</script>
<?php echo $__env->make('admin.musrenbang.js_pack.jsprogress', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
<?php echo $__env->make('admin.musrenbang.js_pack.jsbiaya', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
<?php echo $__env->make('admin.musrenbang.js_pack.jsuser', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
<?php /**PATH C:\xampp\htdocs\desacuss_new\resources\views/admin/musrenbang/js.blade.php ENDPATH**/ ?>