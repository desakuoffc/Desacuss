<script>
    $(document).on('click', '.btnEditBiaya', function () {
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
                $('#tbodi_item_biaya_edt').empty();
                let ht = '';

                const id_musrenbang = data.id_musrenbang;
                const total_biaya = data.total_biaya;
                const total_rp = data.total_biaya_rp;
                const terbilang = data.total_biaya_bilang;
                const total_item = data.total_item;

                $('#total_all_edt').text(total_rp);
                $('#total_terbilang_edt').text(terbilang);

                $('#tbodi_item_biaya_edt').data('biaya', id_musrenbang);

                for (let index = 0; index < total_item; index++) {

                    ht +=
                        `<tr class="main tr_musrenbang_edt sembunyi" id="tr_musrenbang_edt_${(index+1)}">`;

                    ht +=
                        `<td class="main main_urut_edt text-center" id="main_urut_edt_${(index+1)}">`;
                    ht += `<span class="no_urut_edt">${(index+1)}</span>`;
                    ht +=
                        `<input hidden type="text" name="id_musrenbang_biaya[]" value="${data[index].id}">`;
                    ht += '</td>'

                    ht += `<td class="main main_nama_edt" id="main_nama_edt_${(index+1)}">`;
                    ht +=
                        `<input disabled type="text" class="inp_item_edt form-control" name="nama_item[]" id="nama_item_edt_${(index+1)}"`;
                    ht +=
                        `placeholder="Item ${(index+1)}" value="${data[index].nama}" required="required"`;
                    ht += `data-parsley-errors-container="#nama_item_edt_${(index+1)}_error"`;
                    ht += `data-parsley-required-message="Nama item belum diisi.">`;
                    ht +=
                        `<div id="nama_item_edt_${(index+1)}_error" class="error_item_edt error-message-custom"></div>`;
                    ht += '</td>'

                    ht += `<td class="main main_satuan_edt" id="main_satuan_edt_${(index+1)}">`;
                    ht +=
                        `<input disabled type="text" value="${data[index].satuan}" class="inp_satuan_edt form-control" name="satuan_item[]"`;
                    ht += `id="satuan_item_edt_${(index+1)}" required="required"`;
                    ht += `data-parsley-errors-container="#satuan_item_edt_${(index+1)}_error"`;
                    ht += `data-parsley-required-message="Satuan item belum diisi.">`;
                    ht +=
                        `<div id="satuan_item_edt_${(index+1)}_error" class="error_satuan_edt error-message-custom"></div>`;
                    ht += '</td>'

                    ht += `<td class="main main_biaya_edt" id="main_biaya_edt_${(index+1)}">`;
                    ht +=
                        `<input disabled type="text" value="${formatRupiah2(data[index].biaya)}" class="inp_biaya_edt form-control" name="biaya_item[]" id="biaya_item_edt_${(index+1)}"`;
                    ht +=
                        `required="required" data-parsley-errors-container="#biaya_item_edt_${(index+1)}_error"`;
                    ht += ` data-parsley-required-message="Biaya item belum diisi.">`;
                    ht +=
                        ` <div id="biaya_item_edt_${(index+1)}_error" class="error_biaya_edt error-message-custom"></div>`;
                    ht += '</td>'

                    ht += `<td class="main main_jumlah_edt" id="main_jumlah_edt_${(index+1)}">`;
                    ht +=
                        `<input disabled type="number" value="${data[index].jumlah}" min="1" class="inp_jumlah_edt form-control" name="jumlah_item[]"`;
                    ht += `id="jumlah_item_edt_${(index+1)}" required="required"`;
                    ht += `data-parsley-errors-container="#jumlah_item_edt_${(index+1)}_error"`;
                    ht += `data-parsley-required-message="Jumlah item belum diisi.">`;
                    ht +=
                        `<div id="jumlah_item_edt_${(index+1)}_error" class="error_jumlah_edt error-message-custom"></div>`;
                    ht += '</td>'

                    ht += `<td class="main main_total_edt" id="main_total_edt_${(index+1)}">`;
                    ht +=
                        `<input readonly disabled type="text" value="${formatRupiah2(data[index].total)}" class="inp_total_edt form-control" name="total_item_edt[]" id="total_item_edt_${(index+1)}"`;
                    ht +=
                        `required="required" data-parsley-errors-container="#total_item_edt_${(index+1)}_error"`;
                    ht += `data-parsley-required-message="Total item belum diisi.">`;
                    ht +=
                        `<div id="total_item_edt_${(index+1)}_error" class="error_total_edt error-message-custom"></div>`;
                    ht += '</td>'

                    ht += `<td class="main main_tombol_edt" id="main_tombol_edt_${(index+1)}">`;
                    ht +=
                        `<button disabled type="button" id="delete_tombol_item_edt_${(index+1)}" tombol="${(index+1)}"`;
                    ht += `class="delete_item btn btn-outline-danger wid-100">`;
                    ht += `<i class="bi bi-trash"></i>`;
                    ht += `</button>`;
                    ht += '</td>'

                    ht += '</tr>';
                }

                $('#tbodi_item_biaya_edt').append(ht);

                $(".tr_musrenbang_edt").first().show('fast', function showNext() {
                    $(this).next(".tr_musrenbang_edt").show('fast', showNext);
                });

            },
            complete: function (data) {
                $('#modalShowBiayaMusrenbang').modal('show');
            }
        });

    })

    $(document).on('click', '#btn_tambah_item_edt', function () {
        let ht = '';
        let total_item = $('.tr_musrenbang_edt').length;
        let item_baru = (total_item + 1);

        ht +=
            `<tr class="main tr_musrenbang_edt sembunyi" id="tr_musrenbang_edt_${item_baru}">`;

        ht +=
            `<td class="main main_urut_edt text-center" id="main_urut_edt_${item_baru}">`;
        ht += `<span class="no_urut_edt">${item_baru}</span>`;
        ht += '</td>'

        ht += `<td class="main main_nama_edt" id="main_nama_edt_${item_baru}">`;
        ht +=
            `<input type="text" class="inp_item_edt form-control" name="nama_item[]" id="nama_item_edt_${item_baru}"`;
        ht +=
            `placeholder="Item ${item_baru}" required="required"`;
        ht += `data-parsley-errors-container="#nama_item_edt_${item_baru}_error"`;
        ht += `data-parsley-required-message="Nama item belum diisi.">`;
        ht +=
            `<div id="nama_item_edt_${item_baru}_error" class="error_item_edt error-message-custom"></div>`;
        ht += '</td>'

        ht += `<td class="main main_satuan_edt" id="main_satuan_edt_${item_baru}">`;
        ht +=
            `<input type="text" class="inp_satuan_edt form-control" name="satuan_item[]"`;
        ht += `id="satuan_item_edt_${item_baru}" required="required"`;
        ht += `data-parsley-errors-container="#satuan_item_edt_${item_baru}_error"`;
        ht += `data-parsley-required-message="Satuan item belum diisi.">`;
        ht +=
            `<div id="satuan_item_edt_${item_baru}_error" class="error_satuan_edt error-message-custom"></div>`;
        ht += '</td>'

        ht += `<td class="main main_biaya_edt" id="main_biaya_edt_${item_baru}">`;
        ht +=
            `<input type="text" class="inp_biaya_edt form-control" name="biaya_item[]" id="biaya_item_edt_${item_baru}"`;
        ht +=
            `required="required" data-parsley-errors-container="#biaya_item_edt_${item_baru}_error"`;
        ht += ` data-parsley-required-message="Biaya item belum diisi.">`;
        ht +=
            ` <div id="biaya_item_edt_${item_baru}_error" class="error_biaya_edt error-message-custom"></div>`;
        ht += '</td>'

        ht += `<td class="main main_jumlah_edt" id="main_jumlah_edt_${item_baru}">`;
        ht +=
            `<input type="number" min="1" class="inp_jumlah_edt form-control" name="jumlah_item[]"`;
        ht += `id="jumlah_item_edt_${item_baru}" required="required"`;
        ht += `data-parsley-errors-container="#jumlah_item_edt_${item_baru}_error"`;
        ht += `data-parsley-required-message="Jumlah item belum diisi.">`;
        ht +=
            `<div id="jumlah_item_edt_${item_baru}_error" class="error_jumlah_edt error-message-custom"></div>`;
        ht += '</td>'

        ht += `<td class="main main_total_edt" id="main_total_edt_${item_baru}">`;
        ht +=
            `<input readonly type="text" class="inp_total_edt form-control" name="total_item_edt[]" id="total_item_edt_${item_baru}"`;
        ht +=
            `required="required" data-parsley-errors-container="#total_item_edt_${item_baru}_error"`;
        ht += `data-parsley-required-message="Total item belum diisi.">`;
        ht +=
            `<div id="total_item_edt_${item_baru}_error" class="error_total_edt error-message-custom"></div>`;
        ht += '</td>'

        ht += `<td class="main main_tombol_edt" id="main_tombol_edt_${item_baru}">`;
        ht +=
            `<button type="button" id="delete_tombol_item_edt_${item_baru}" tombol="${item_baru}"`;
        ht += `class="delete_item btn btn-outline-danger wid-100">`;
        ht += `<i class="bi bi-trash"></i>`;
        ht += `</button>`;
        ht += '</td>'

        ht += '</tr>';

        $(ht).appendTo("#tbodi_item_biaya_edt").fadeIn(400);

    })

    $(document).on('click', '.delete_item', function () {
        const id = $(this).attr('tombol')

        $(`#tr_musrenbang_edt_${id}`).fadeOut(400, function () {
            $(this).remove();
            refreshUrutanEdt();
            hitung_biaya_edt();
        });
    })

    $(document).on('keyup change', '.inp_biaya_edt, .inp_jumlah_edt', function () {
        hitung_biaya_edt();
    })

    function hitung_biaya_edt() {
        let total_item = $('.tr_musrenbang_edt').length;
        let input_total = document.getElementsByName('total_item_edt[]');
        let total_all = 0;
        $('.tr_musrenbang_edt').each(function (i) {
            const x = (i + 1);
            $(`#biaya_item_edt_${x}`).val(RpMusren($(`#biaya_item_edt_${x}`).val(), 'Rp. '));
            let biaya = parseInt(filterNum($(`#biaya_item_edt_${x}`).val()));
            let jumlah = parseInt($(`#jumlah_item_edt_${x}`).val());
            let hitung = parseInt(biaya * jumlah);
            $(`#total_item_edt_${x}`).val('Rp. ' + hitungTotal(hitung));

            total_all += parseInt(filterNum(input_total[i].value));
        })
        $('#total_all_edt').text('Rp. ' + hitungTotal(total_all));
        $('#total_terbilang_edt').text(angkaTerbilang(total_all) + ' Rupiah.');
    }

    function refreshUrutanEdt() {
        $('.tr_musrenbang_edt').each(function (i) {
            const x = (i + 1);
            $(this).attr('id', 'tr_musrenbang_edt_' + x);

            $(this).find('.main_urut_edt_').attr('id', 'main_urut_edt_' + x);
            $(this).find('.no_urut_edt').text(x);
            //
            $(this).find('.main_nama_edt').attr('id', 'main_nama_edt_' + x);
            $(this).find('.inp_item_edt').attr({
                'id': `nama_item_edt_${x}`,
                'placeholder': `Item ${x}`,
                'data-parsley-errors-container': `nama_item_edt_${x}_error`,
            });
            $(this).find('.error_item_edt').attr('id', `nama_item_edt_${x}_error`);
            //
            $(this).find('.main_satuan_edt').attr('id', 'main_satuan_edt_' + x);
            $(this).find('.inp_satuan_edt').attr({
                'id': `satuan_item_edt_${x}`,
                'data-parsley-errors-container': `satuan_item_edt_${x}_error`,
            });
            $(this).find('.error_satuan_edt').attr('id', `satuan_item_edt_${x}_error`);
            //
            $(this).find('.main_biaya_edt').attr('id', 'main_biaya_edt_' + x);
            $(this).find('.inp_biaya_edt').attr({
                'id': `biaya_item_edt_${x}`,
                'data-parsley-errors-container': `biaya_item_edt_${x}_error`,
            });
            $(this).find('.error_biaya_edt').attr('id', `biaya_item_edt_${x}_error`);
            //
            $(this).find('.main_jumlah_edt').attr('id', 'main_jumlah_edt_' + x);
            $(this).find('.inp_jumlah_edt').attr({
                'id': `jumlah_item_edt_${x}`,
                'data-parsley-errors-container': `jumlah_item_edt_${x}_error`,
            });
            $(this).find('.error_jumlah_edt').attr('id', `jumlah_item_edt_${x}_error`);
            //
            $(this).find('.main_total_edt').attr('id', 'main_total_edt_' + x);
            $(this).find('.inp_total_edt').attr({
                'id': `total_item_edt_${x}`,
                'data-parsley-errors-container': `total_item_edt_${x}_error`,
            });
            $(this).find('.error_total_edt').attr('id', `total_item_edt_${x}_error`);
            //
            $(this).find('.main_tombol_edt').attr('id', 'main_tombol_edt_' + x);
            $(this).find('.delete_item').attr({
                'id': `delete_tombol_item_edt_${x}`
            }).attr('tombol', x);
        });
    }

    $(document).on('click', '#btnActionBiaya', function () {
        $('#formBiayaEdt').parsley().validate();
        if ($('#formBiayaEdt').parsley().isValid()) {
            let formDatas = $('#formBiayaEdt').get(0);
            let formPack = new FormData(formDatas);
            formPack.append('id_mus', $('#tbodi_item_biaya_edt').data('biaya'))
            swal.fire({
                title: 'KONFIRMASI',
                html: 'Data sudah sesuai? lanjutkan proses?',
                showCancelButton: !0,
                reverseButtons: !0,
                cancelButtonText: 'Cek lagi',
                confirmButtonText: 'Ya, Lanjut'
            }).then(function (e) {
                if (e.value === true) {
                    getSwalLoading(1, 'Proses Penambahan Biaya Musrenbang', 'Mohon Tunggu...')
                    $.ajax({
                        url: "<?php echo e(route('musrenbang.biaya.update')); ?>",
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
                                $('#modalShowBiayaMusrenbang').modal('hide');
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
                            swal.fire('ERROR', 'Server Bermalasah. Coba Lagi Nanti',
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

    $(document).on('click', '#cekboxmusrenbangedt', function () {
        if ($(this).is(":checked")) {
            izinEditBiaya(1);
        } else {
            izinEditBiaya(0);
        }
    })

    function izinEditBiaya(data) {
        if (data == "1") {
            $('.inp_item_edt').attr('disabled', false)
            $('.inp_satuan_edt').attr('disabled', false)
            $('.inp_biaya_edt').attr('disabled', false)
            $('.inp_jumlah_edt').attr('disabled', false)
            $('.inp_total_edt').attr('disabled', false)
            $('.delete_item').attr('disabled', false)
            $('#btn_tambah_item_edt').attr('disabled', false);
            $('#btnActionBiaya').attr('disabled', false)
        } else {
            $('.inp_item_edt').attr('disabled', true)
            $('.inp_satuan_edt').attr('disabled', true)
            $('.inp_biaya_edt').attr('disabled', true)
            $('.inp_jumlah_edt').attr('disabled', true)
            $('.inp_total_edt').attr('disabled', true)
            $('.delete_item').attr('disabled', true)
            $('#btn_tambah_item_edt').attr('disabled', true);
            $('#btnActionBiaya').attr('disabled', true)
        }
    }

    $('#modalShowBiayaMusrenbang').on('hidden.bs.modal', function (e) {
        $('#tbodi_item_biaya_edt').data('biaya', 0);
    })

    $(document).on('click', '.btnActionBiayaClose', function () {
        swal.fire({
            title: 'KONFIRMASI',
            html: 'Tutup menu biaya musrenbang?<br>Data yang sudah diisi atau diubah tidak akan tersimpan.',
            icon: 'warning',
            reverseButtons: !0,
            showCancelButton: !0,
            confirmButtonText: 'Ya, Tutup',
            cancelButtonText: 'Tidak'
        }).then(function (e) {
            if (e.value === true) {
                $('#modalShowBiayaMusrenbang').modal('hide');
                $('#tbodi_item_biaya_edt').data('biaya', 0);
            } else {
                e.dismiss;
            }
        }, function (dismiss) {
            return false
        })
    })

</script>
<?php /**PATH C:\xampp\htdocs\desacuss_new\resources\views/admin/musrenbang/js_pack/jsbiaya.blade.php ENDPATH**/ ?>