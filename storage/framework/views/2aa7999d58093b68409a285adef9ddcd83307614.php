<script>
    $(document).on('click', '#btn_tambah_musrenbang', function () {
        $('#div_tabel_musrenbang').fadeOut(600, function () {
            $('#div_tambah_musrenbang').fadeIn(600);
        });
    })


    $(document).on('click', '.btn_close_form', function () {
        swal.fire({
            title: 'KONFIRMASI',
            html: 'Tutup menu tambah musrenbang?<br>Data yang sudah diisi akan terhapus.',
            icon: 'warning',
            reverseButtons: !0,
            showCancelButton: !0,
            confirmButtonText: 'Ya, Tutup',
            cancelButtonText: 'Tidak'
        }).then(function (e) {
            if (e.value === true) {
                $('#div_tambah_musrenbang').fadeOut(600, function () {
                    $('#div_tabel_musrenbang').fadeIn(600);
                });
                resetFormMusrenbang();
            } else {
                e.dismiss;
            }
        }, function (dismiss) {
            return false
        })
    })

    function resetFormMusrenbang() {
        $('#form_tambah_diskusi')[0].reset();
        menu_musrenbang_biaya(0);
        menu_musrenbang_anggota(0);
        $('#dual-list-right').html('');
        $('#dual-list-left').html('');
        $("#deskmusrenbang").summernote("reset");
    }

    $(document).on('click', '#btn_add_musrenbang', function () {
        $('#form_tambah_musrenbang').parsley().validate();
        if ($('#form_tambah_musrenbang').parsley().isValid()) {
            let formDatas = $('#form_tambah_musrenbang').get(0);
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
                    getSwalLoading(1, 'Proses Penambahan Data Musrenbang', 'Mohon Tunggu...')
                    $.ajax({
                        url: "<?php echo e(route('musrenbang.create')); ?>",
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
                                $('#div_tambah_musrenbang').fadeOut(600, function () {
                                    $('#div_tabel_musrenbang').fadeIn(600);
                                });
                                resetFormMusrenbang();
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



<script>
    getAnggota();

    function getAnggota() {
        $.ajax({
            url: "<?php echo e(route('user.get')); ?>",
            method: 'get',
            dataType: 'json',
            success: function (data) {
                let ht = '';

                for (let index = 0; index < data.length; index++) {
                    ht += `<li class="list-group-item" data-value="${data[index].id}">`;
                    ht +=
                        `<img src="${data[index].foto}" class="img-musrenbang me-3" width="50" height="50">`;
                    ht += `${data[index].nama}`;
                    ht += `</li>`;
                }

                $('#dual-list-right').html(ht);
                main_anggota();
                refreshAnggota();
            }
        })
    }

    function refreshAnggota() {
        let anggota_not = $("#dual-list-right li").length;
        let anggota_yes = $("#dual-list-left li").length;
        const anggota = [];

        if (parseInt(anggota_yes) < 1) {
            $('#total_user_musrenbang').val('');
        } else {
            $('#total_user_musrenbang').val(anggota_yes);
        }

        $('#dual-list-left').find(".list-group-item").each(function (i) {
            anggota.push($(this).data('value'));
        })

        $('#daftar_anggota').val(anggota);

        $('#anggota_yes').text(`Anggota Terpilih (${anggota_yes})`)
        $('#anggota_not').text(`Daftar Anggota (${anggota_not})`)
    }

</script>



<script>
    $(document).on('click', '#cekboxmusrenbang', function () {
        if ($(this).is(":checked")) {
            menu_musrenbang_biaya(1);
        } else {
            menu_musrenbang_biaya(0);
        }
    })

    $(document).on('click', '#cekboxmusrenbanganggota', function () {
        if ($(this).is(":checked")) {
            menu_musrenbang_anggota(1);
        } else {
            menu_musrenbang_anggota(0);
        }
    })

    function menu_musrenbang_anggota(data) {
        if (data == "0") {
            $('#cekboxmusrenbanganggota').val('0');
            $('#total_user_musrenbang').attr('required', true)
            $('#menu_pilih_anggota').show(600);
        } else if (data == "1") {
            $('#cekboxmusrenbanganggota').val('1');
            $('#total_user_musrenbang').attr('required', false)
            $('#menu_pilih_anggota').hide(600);
        }
    }

    function menu_musrenbang_biaya(data) {
        if (data == "0") {
            $('#cekboxmusrenbang').val('0');
            $('.inp_item').attr({
                'disabled': false,
                'required': true
            });
            $('.inp_satuan').attr({
                'disabled': false,
                'required': true
            });
            $('.inp_biaya').attr({
                'disabled': false,
                'required': true
            });
            $('.inp_jumlah').attr({
                'disabled': false,
                'required': true
            });
            $('.inp_total').attr({
                'disabled': false,
                'required': true
            });
            $('.delete_tombol_item').attr({
                'disabled': false
            });
        } else {
            $('#cekboxmusrenbang').val('1');
            $('.inp_item').attr({
                'disabled': true,
                'required': false
            });
            $('.inp_satuan').attr({
                'disabled': true,
                'required': false
            });
            $('.inp_biaya').attr({
                'disabled': true,
                'required': false
            });
            $('.inp_jumlah').attr({
                'disabled': true,
                'required': false
            });
            $('.inp_total').attr({
                'disabled': true,
                'required': false
            });
            $('.delete_tombol_item').attr({
                'disabled': true
            });
        }
    }

    $(document).on('click', '.btn_tambah_item', function () {
        let ht = '';
        let total_item = $('.tr_musrenbang').length;
        let item_baru = (total_item + 1);

        ht += '';

        ht += `<tr class="main tr_musrenbang sembunyi" id="tr_musrenbang_${item_baru}">`;

        ht += `<td class="main main_urut text-center" id="main_urut_${item_baru}">`;
        ht += `<span class="no_urut">${item_baru}</span>`;
        ht += '</td>'

        ht += `<td class="main main_nama" id="main_nama_${item_baru}">`;
        ht +=
            `<input type="text" class="inp_item form-control" name="nama_item[]" id="nama_item_${item_baru}"`;
        ht += `placeholder="Item ${item_baru}" required="required"`;
        ht += `data-parsley-errors-container="#nama_item_${item_baru}_error"`;
        ht += `data-parsley-required-message="Nama item belum diisi.">`;
        ht += `<div id="nama_item_${item_baru}_error" class="error_item error-message-custom"></div>`;
        ht += '</td>'

        ht += `<td class="main main_satuan" id="main_satuan_${item_baru}">`;
        ht += `<input type="text" class="inp_satuan form-control" name="satuan_item[]"`;
        ht += `id="satuan_item_${item_baru}" required="required"`;
        ht += `data-parsley-errors-container="#satuan_item_${item_baru}_error"`;
        ht += `data-parsley-required-message="Satuan item belum diisi.">`;
        ht += `<div id="satuan_item_${item_baru}_error" class="error_satuan error-message-custom"></div>`;
        ht += '</td>'

        ht += `<td class="main main_biaya" id="main_biaya_${item_baru}">`;
        ht +=
            `<input type="text" class="inp_biaya form-control" name="biaya_item[]" id="biaya_item_${item_baru}"`;
        ht += `required="required" data-parsley-errors-container="#biaya_item_${item_baru}_error"`;
        ht += ` data-parsley-required-message="Biaya item belum diisi.">`;
        ht += ` <div id="biaya_item_${item_baru}_error" class="error_biaya error-message-custom"></div>`;
        ht += '</td>'

        ht += `<td class="main main_jumlah" id="main_jumlah_${item_baru}">`;
        ht += `<input type="number" value="1" min="1" class="inp_jumlah form-control" name="jumlah_item[]"`;
        ht += `id="jumlah_item_${item_baru}" required="required"`;
        ht += `data-parsley-errors-container="#jumlah_item_${item_baru}_error"`;
        ht += `data-parsley-required-message="Jumlah item belum diisi.">`;
        ht += `<div id="jumlah_item_${item_baru}_error" class="error_jumlah error-message-custom"></div>`;
        ht += '</td>'

        ht += `<td class="main main_total" id="main_total_${item_baru}">`;
        ht +=
            `<input readonly type="text" class="inp_total form-control" name="total_item[]" id="total_item_${item_baru}"`;
        ht += `required="required" data-parsley-errors-container="#total_item_${item_baru}_error"`;
        ht += `data-parsley-required-message="Total item belum diisi.">`;
        ht += `<div id="total_item_${item_baru}_error" class="error_total error-message-custom"></div>`;
        ht += '</td>'

        ht += `<td class="main main_tombol" id="main_tombol_${item_baru}">`;
        ht += `<button type="button" id="delete_tombol_item_${item_baru}" tombol="${item_baru}"`;
        ht += `class="delete_tombol_item btn btn-outline-danger wid-100">`;
        ht += `<i class="bi bi-trash"></i>`;
        ht += `</button>`;
        ht += '</td>'

        ht += '</tr>';

        $(ht).appendTo("#tbodi_item_baru").fadeIn(400);

        var $sections2 = $('.form-section');
        $sections2.each(function (index, section) {
            $(section).find(':input').attr('data-parsley-group', 'block-' + index);
        });

        // $('#tbodi_item_baru').append(ht);
    })

    $(document).on('click', '.delete_tombol_item', function () {
        let id = $(this).attr('tombol');
        $(`#tr_musrenbang_${id}`).fadeOut(400, function () {
            $(this).remove();
            refreshUrutan();
            hitung_biaya();
        });
    })

    function refreshUrutan() {
        $('.tr_musrenbang').each(function (i) {
            const x = (i + 1);
            $(this).attr('id', 'tr_musrenbang_' + x);

            $(this).find('.main_urut').attr('id', 'main_urut_' + x);
            $(this).find('.no_urut').text(x);
            //
            $(this).find('.main_nama').attr('id', 'main_nama_' + x);
            $(this).find('.inp_item').attr({
                'id': `nama_item_${x}`,
                'placeholder': `Item ${x}`,
                'data-parsley-errors-container': `nama_item_${x}_error`,
            });
            $(this).find('.error_item').attr('id', `nama_item_${x}_error`);
            //
            $(this).find('.main_satuan').attr('id', 'main_satuan_' + x);
            $(this).find('.inp_satuan').attr({
                'id': `satuan_item_${x}`,
                'data-parsley-errors-container': `satuan_item_${x}_error`,
            });
            $(this).find('.error_satuan').attr('id', `satuan_item_${x}_error`);
            //
            $(this).find('.main_biaya').attr('id', 'main_biaya_' + x);
            $(this).find('.inp_biaya').attr({
                'id': `biaya_item_${x}`,
                'data-parsley-errors-container': `biaya_item_${x}_error`,
            });
            $(this).find('.error_biaya').attr('id', `biaya_item_${x}_error`);
            //
            $(this).find('.main_jumlah').attr('id', 'main_jumlah_' + x);
            $(this).find('.inp_jumlah').attr({
                'id': `jumlah_item_${x}`,
                'data-parsley-errors-container': `jumlah_item_${x}_error`,
            });
            $(this).find('.error_jumlah').attr('id', `jumlah_item_${x}_error`);
            //
            $(this).find('.main_total').attr('id', 'main_total_' + x);
            $(this).find('.inp_total').attr({
                'id': `total_item_${x}`,
                'data-parsley-errors-container': `total_item_${x}_error`,
            });
            $(this).find('.error_total').attr('id', `total_item_${x}_error`);
            //
            $(this).find('.main_tombol').attr('id', 'main_tombol_' + x);
            $(this).find('.delete_tombol_item').attr({
                'id': `delete_tombol_item_${x}`
            }).attr('tombol', x);
        });
    }

    $(document).on('keyup change', '.inp_biaya, .inp_jumlah', function () {
        hitung_biaya();
    })

    function hitung_biaya() {
        let total_item = $('.tr_musrenbang').length;
        let input_total = document.getElementsByName('total_item[]');
        let total_all = 0;
        $('.tr_musrenbang').each(function (i) {
            const x = (i + 1);
            $(`#biaya_item_${x}`).val(RpMusren($(`#biaya_item_${x}`).val(), 'Rp. '));
            let biaya = parseInt(filterNum($(`#biaya_item_${x}`).val()));
            let jumlah = parseInt($(`#jumlah_item_${x}`).val());
            let hitung = parseInt(biaya * jumlah);
            $(`#total_item_${x}`).val('Rp. ' + hitungTotal(hitung));

            total_all += parseInt(filterNum(input_total[i].value));
        })
        $('#total_all').text('Rp. ' + hitungTotal(total_all));
        $('#total_terbilang').text(angkaTerbilang(total_all) + ' Rupiah.');
    }

</script>



<script>
    $(function () {
        var dateFormat = "mm/dd/yy",
            tgl_start = $("#tgl_start")
            .datepicker({
                defaultDate: "+1w",
                changeMonth: true,
                numberOfMonths: 3
            })
            .on("change", function () {
                tgl_end.datepicker("option", "minDate", getDate(this));
            }),
            tgl_end = $("#tgl_end").datepicker({
                defaultDate: "+1w",
                changeMonth: true,
                numberOfMonths: 3
            })
            .on("change", function () {
                tgl_start.datepicker("option", "maxDate", getDate(this));
            }),
            tgl_start_edt = $("#tgl_start_edt")
            .datepicker({
                defaultDate: "+1w",
                changeMonth: true,
                numberOfMonths: 3
            })
            .on("change", function () {
                tgl_end_edt.datepicker("option", "minDate", getDate(this));
            }),
            tgl_end_edt = $("#tgl_end_edt").datepicker({
                defaultDate: "+1w",
                changeMonth: true,
                numberOfMonths: 3
            })
            .on("change", function () {
                tgl_start_edt.datepicker("option", "maxDate", getDate(this));
            });

        function getDate(element) {
            var date;
            try {
                date = $.datepicker.parseDate(dateFormat, element.value);
            } catch (error) {
                date = null;
            }

            return date;
        }
    });

    $(function () {
        var dateFormatProg = "mm/dd/yy",
            tgl_start_prog = $("#tgl_start_prog")
            .datepicker({
                defaultDate: "+1w",
                changeMonth: true,
                numberOfMonths: 3
            })
            .on("change", function () {
                tgl_end_prog.datepicker("option", "minDate", getDateProg(this));
            }),
            tgl_end_prog = $("#tgl_end_prog").datepicker({
                defaultDate: "+1w",
                changeMonth: true,
                numberOfMonths: 3
            })
            .on("change", function () {
                tgl_start_prog.datepicker("option", "maxDate", getDateProg(this));
            }),
            tgl_start_prog_new = $("#tgl_start_prog_new")
            .datepicker({
                defaultDate: "+1w",
                changeMonth: true,
                numberOfMonths: 3
            })
            .on("change", function () {
                tgl_end_prog_new.datepicker("option", "minDate", getDateProg(this));
            }),
            tgl_end_prog_new = $("#tgl_end_prog_new").datepicker({
                defaultDate: "+1w",
                changeMonth: true,
                numberOfMonths: 3
            })
            .on("change", function () {
                tgl_start_prog_new.datepicker("option", "maxDate", getDateProg(this));
            });

        function getDateProg(element) {
            var date;
            try {
                date = $.datepicker.parseDate(dateFormatProg, element.value);
            } catch (error) {
                date = null;
            }

            return date;
        }
    });

</script>

<script>
    $('#desk_infrastruktur').summernote({
        placeholder: 'Tulis deskripsi disini...',
        lang: 'id-ID',
        tabsize: 4,
        height: 300
    });
    $('#deskmusrenbang').summernote({
        placeholder: 'Tulis deskripsi disini...',
        lang: 'id-ID',
        tabsize: 2,
        height: 150
    });
    $('#deskmusrenbangedt').summernote({
        placeholder: 'Tulis deskripsi disini...',
        lang: 'id-ID',
        tabsize: 2,
        height: 150
    });

</script>

































<script>
    $(function () {
        var $sections2 = $('.form-section');

        function navigateTo2(index) {
            // Mark the current section with the class 'current'
            $sections2
                .removeClass('current')
                .eq(index)
                .addClass('current');
            // Show only the navigation buttons that make sense for the current section:
            $('.form-navigation-2 .kembali').toggle(index > 0);
            var atTheEnd = index >= $sections2.length - 1;
            $('.form-navigation-2 .lanjut').toggle(!atTheEnd);
            $('.form-navigation-2 [id=btn_add_musrenbang]').toggle(atTheEnd);
        }

        function curIndex2() {
            // Return the current index by looking at which section has the class 'current'
            return $sections2.index($sections2.filter('.current'));
        }

        // kembali button is easy, just go back
        $('.form-navigation-2 .kembali').click(function () {
            navigateTo2(curIndex2() - 1);
        });

        // lanjut button goes forward iff current block validates
        $('.form-navigation-2 .lanjut').click(function () {
            $('.form_tambah_musrenbang').parsley().whenValidate({
                group: 'block-' + curIndex2()
            }).done(function () {
                navigateTo2(curIndex2() + 1);
            });
        });

        // Prepare sections2 by setting the `data-parsley-group` attribute to 'block-0', 'block-1', etc.
        $sections2.each(function (index, section) {
            $(section).find(':input').attr('data-parsley-group', 'block-' + index);
        });
        navigateTo2(0); // Start at the beginning
    });

    function RpMusren(angka, prefix) {
        var number_string = angka.replace(/[^,\d]/g, '').toString(),
            split = number_string.split(','),
            sisa = split[0].length % 3,
            rupiah = split[0].substr(0, sisa),
            ribuan = split[0].substr(sisa).match(/\d{3}/gi);

        // tambahkan titik jika yang di input sudah menjadi angka ribuan
        if (ribuan) {
            separator = sisa ? '.' : '';
            rupiah += separator + ribuan.join('.');
        }

        rupiah = split[1] != undefined ? rupiah + ',' + split[1] : rupiah;
        return prefix == undefined ? rupiah : (rupiah ? 'Rp. ' + rupiah : '');
    }

    function hitungTotal(total) {
        let number_string = total.toString(),
            sisa = number_string.length % 3,
            rupiah = number_string.substr(0, sisa),
            ribuan = number_string.substr(sisa).match(/\d{3}/g);
        if (ribuan) {
            separator = sisa ? '.' : '';
            rupiah += separator + ribuan.join('.');
        }
        return rupiah;
    }

</script>
<?php /**PATH C:\xampp\htdocs\desacuss_new\resources\views/admin/musrenbang/jsaddmusrenbang.blade.php ENDPATH**/ ?>