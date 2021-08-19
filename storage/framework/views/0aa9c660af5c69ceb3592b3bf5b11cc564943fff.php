<div class="modal fade bd-example-modal-lg" id="modal_fixed" tabindex="-1" role="dialog"
    aria-labelledby="myLargeModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered modal-lg">
        <div class="modal-content">
            <div class="modal-header pb-0" style="justify-content: center; font-size: 16px; font-weight: bold">
                PERBAIKAN DATA REGISTRASI
                <button type="button" class="btn_cancel btn-close pull-right" aria-label="Close"></button>
            </div>
            <div class="modal-header" style="justify-content: center; font-size: 14px; padding-top:5px;">
                <div class="sub_head text-center">
                    Silahkan masukan email dan password untuk akun yang akan diperbaiki
                </div>
                <div hidden class="sub_head_after text-center">
                    <p class="font-14 mb-1">Silahkan perbaiki data sesuai arahan pesan dari admin desa, lalu tekan
                        tombol
                        Update.</p>
                    <p class="font-14" id="pesan_fix"></small>
                </div>
            </div>
            <div class="modal-body">
                <form id="form_perbaikan" class="form_perbaikan">
                    <?php echo csrf_field(); ?>
                    <div class="cek_login_fix" id="cek_login_fix">

                        <div class="form-group mb-3">
                            <label for="email" class="kastem form-label pull-left"><i class="bi bi-at"></i>
                                <?php echo e(__('E-Mail Address')); ?></label>
                            <input required="" data-parsley-errors-container="#email_fix" data-parsley-type="email"
                                data-parsley-type-message="Gunakan format email, contoh: forum@desaku.com"
                                data-parsley-required-message="Email belum diisi."
                                class="pw_lama_css_email kastem form-control" type="text" id="email_cek" name="email">
                            <div id="email_fix" class="pesan-error-fix"></div>
                        </div>

                        <div class="form-group mb-3">
                            <label for="password" class="form-label pull-left"><i class="bi bi-key"></i>
                                <?php echo e(__('Password')); ?></label>
                            <input required="" data-parsley-errors-container="#password_fix"
                                data-parsley-required-message="Password belum diisi."
                                class="pw_lama_css_email kastem form-control" type="password" id="pw_lama_email"
                                name="password">
                            <div id="password_fix" class="pesan-error-fix"></div>
                        </div>
                        <hr>
                    </div>
                </form>


                <div id="menu_edit_fix" class="menu_edit_fix modal-body"
                    style="display:none;padding-top: 4px;max-height: 450px;overflow-y: auto; ">
                    <form id="form_perbaikan_update" class="form_perbaikan_update">
                        <?php echo csrf_field(); ?>
                        <div class="form-bagi">
                            <h5 style="margin-bottom: 1px; font-weight: bold;">Foto KTP</h5>
                            <div class="card p-4">
                                <div class="text-center mb-1">
                                    <img id="foto_ktp_fixed" style="width:500px; height: 250px;" alt="" />
                                    <input hidden id="old_ktp" type="text" />
                                    <input hidden id="val_up" name="val_up" type="text" value="" />
                                </div>
                                <div class="file mb-3">
                                    <div class="file__input" id="file__input">
                                        <label class="file__input--label mb-2" for="customFile"
                                            data-text-btn="Ganti Foto KTP">Ganti Foto KTP :</label>
                                        <input class="file__input--file form-control form-control-sm" id="customFile"
                                            type="file" multiple="multiple" name="file" />
                                    </div>
                                </div>

                                <div class="mb-3">
                                    <label style="color: black; text-align: left;" class="control-label col-md-12">No.
                                        KTP</label>
                                    <div class="col-md-12">
                                        <input required="" data-parsley-errors-container="#pesan_error_ktp"
                                            data-parsley-required-message="No. KTP belum diisi."
                                            data-parsley-minlength="16"
                                            data-parsley-minlength-message="No.KTP minimal 16 angka!" name="no_ktp"
                                            id="no_ktp_fix" type="number" class="form-control form-control-success">
                                    </div>
                                    <div id="pesan_error_ktp" class="pesan-error-fix-2" style="margin-bottom: 0px;">
                                    </div>
                                    <div id="uname_response" style="text-align: left;"></div>
                                </div>
                            </div>
                        </div>

                        <div class="form-bagi">
                            <h5 style="margin-bottom: 1px; font-weight: bold;">Data Pribadi</h5>
                            <div class="card p-4">
                                <div class="form-group">
                                    <div class="row">
                                        <div class="col-6">
                                            <label style="color: black; text-align: left;"
                                                class="control-label col-md-12">Nama Lengkap </label>
                                            <div class="col-md-12">
                                                <input required="" data-parsley-errors-container="#pesan_error_nama"
                                                    data-parsley-required-message="Nama lengkap belum diisi."
                                                    id="nama_fix" name="name" type="text"
                                                    class="form-control form-control-success" value="">
                                            </div>
                                            <div id="pesan_error_nama" class="pesan-error-fix-2"></div>
                                        </div>
                                        <div class="col-6">
                                            <label style="color: black; text-align: left;"
                                                class="control-label col-md-12">Email</label>
                                            <div class="col-md-12">
                                                <input readonly id="email_fixed" name="email_fix" type="text"
                                                    class="form-control form-control-success" value="">
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="form-bagi">
                            <h5 style="margin-bottom: 1px;font-weight: bold">Data Wilayah</h5>
                            <div class="card p-4">
                                <div class="form-group">
                                    <label style="color: black; text-align: left;"
                                        class="control-label col-md-12">Alamat
                                        Rumah</label>
                                    <div class="col-md-12">
                                        <textarea readonly id="alamat_lengkap" name="alamat_lengkap" rows="1"
                                            type="text" class="form-control form-control-success"></textarea>
                                    </div>
                                </div>

                                <div class="form-check">
                                    <label class="form-check-label">
                                        <input id="cek_wilayah" onclick="wilayahCek()" name="cek_wilayah"
                                            class="form-check-input" type="checkbox">
                                        Ganti data alamat
                                        <span class="form-check-sign">
                                            <span class="check"></span>
                                        </span>
                                    </label>
                                </div>

                                <div class="menu_wilayah" style="display: none">
                                    <hr>
                                    <div class="form-group">
                                        <div class="row">
                                            <div class="col-6">
                                                <label style="color: black;padding-left: 0px; margin-bottom: 0px;"
                                                    class="control-label col-md-12">Asal Provinsi</label>
                                                <div class="prov input-group"
                                                    style="padding-bottom: 2px; margin: 10px 0 0 0;">
                                                    <select data-parsley-errors-container="#prov-error"
                                                        data-parsley-required-message="Asal provinsi belum dipilih."
                                                        name="province" id="prov_fixed" class="selectpicker input-sm"
                                                        data-width="100%" show-tick data-style="btn-sm"
                                                        title="Pilih Provinsi" data-live-search="true">
                                                        <option value="">== Pilih Provinsi asal ==</option>
                                                        <?php $__currentLoopData = $prov; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $p): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                                        <option value="<?php echo e($p->id); ?>"><?php echo e($p->name); ?></option>
                                                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                                    </select>
                                                    <div id="prov-error" class="wil-error"></div>
                                                </div>
                                            </div>
                                            <div class="col-6">
                                                <label style="color: black;padding-left: 0px; margin-bottom: 0px;"
                                                    class="control-label col-md-12">Asal Kota/Kabupaten</label>
                                                <div class="input-group"
                                                    style="padding-bottom: 2px; margin: 10px 0 0 0;">
                                                    <select data-parsley-errors-container="#kota-error"
                                                        data-parsley-required-message="Asal kota/kab belum dipilih."
                                                        name="city" id="kab_fixed" class="selectpicker"
                                                        data-width="100%" show-tick data-style="btn-sm"
                                                        title="Pilih Kota/Kab" data-live-search="true">
                                                        <option value="">== Pilih Kota/Kab asal ==</option>
                                                    </select>
                                                    <div id="kota-error" class="wil-error"></div>
                                                </div>
                                            </div>

                                        </div>
                                    </div>

                                    <div class="form-group">
                                        <div class="row">
                                            <div class="col-6">
                                                <label style="color: black;padding-left: 0px; margin-bottom: 0px;"
                                                    class="control-label col-md-12">Asal Kecamatan</label>
                                                <div class="input-group"
                                                    style="padding-bottom: 2px; margin: 10px 0 0 0;">
                                                    <select data-parsley-errors-container="#kec-error"
                                                        data-parsley-required-message="Asal kecamatan belum dipilih."
                                                        name="kec" id="kec_fixed" class="selectpicker" data-width="100%"
                                                        show-tick data-style="btn-sm" title="Pilih Kecamatan"
                                                        data-live-search="true">
                                                        <option value="">== Pilih Provinsi asal ==</option>
                                                    </select>
                                                    <div id="kec-error" class="wil-error"></div>
                                                </div>
                                            </div>
                                            <div class="col-6">
                                                <label style="color: black;padding-left: 0px; margin-bottom: 0px;"
                                                    class="control-label col-md-12">Asal Desa</label>
                                                <div class="input-group"
                                                    style="padding-bottom: 2px; margin: 10px 0 0 0;">
                                                    <select data-parsley-errors-container="#desa-error"
                                                        data-parsley-required-message="Asal desa belum dipilih."
                                                        name="desa" id="desa_fixed" class="selectpicker"
                                                        data-width="100%" show-tick data-style="btn-sm"
                                                        title="Pilih Desa" data-live-search="true">
                                                        <option value="">== Pilih Desa asal ==</option>
                                                    </select>
                                                    <div id="desa-error" class="wil-error"></div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>

                                    <div class="form-group">
                                        <label style="color: black; text-align: left;"
                                            class="control-label col-md-12">Alamat Rumah</label>
                                        <div class="col-md-12">
                                            <textarea data-parsley-required-message="Alamat rumah belum diisi."
                                                id="rumah_fix" name="rumah" type="text"
                                                class="form-control form-control-success"></textarea>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </form>
                </div>

                <div hidden id="menu_perbaikan_update" class="form-navigation-2">
                    <hr>
                    <button type="button" class="kembali btn btn-outline-success pull-left">Kembali</button>
                    <button type="button"
                        class="btn-confirm-email lanjut btn btn-outline-success pull-right">Lanjut</button>
                    <button type="button" id="btn_perbaikan_update" class="btn btn-success pull-right">Update</button>
                    
                    <span class="clearfix"></span>
                </div>

                <button type="button" id="btn_perbaikan_konfirmasi"
                    class="btn btn-success pull-right">Konfirmasi</button>
            </div>
        </div>
    </div>
</div>

<script>
    customFile.onchange = evt => {
        const [file] = customFile.files
        if (file) {
            foto_ktp_fixed.src = URL.createObjectURL(file)
        }
    }

    // ------------  File upload BEGIN ------------
    $('.file__input--file').on('change', function (event) {
        $('.file__value').remove();
        var files = event.target.files;
        for (var i = 0; i < files.length; i++) {
            var file = files[i];
            $("<div class='file__value'><div class='file__value--text'>" + file.name +
                    "</div><div class='file__value--remove' data-id='" + file.name + "' ></div></div>")
                .insertAfter('#file__input');
        }
    });

    $('#ttl_fix').datepicker({
        showOtherMonths: true,
        selectOtherMonths: true,
        showWeek: false,
        numberOfMonths: 1,
        showButtonPanel: true,
        changeMonth: true,
        changeYear: true,
        currentText: 'Sekarang',
        closeText: "Tutup",
        prevText: "&#x3C;mundur",
        nextText: "maju&#x3E;",
        currentText: "hari ini",
        monthNames: ["Januari", "Februari", "Maret", "April", "Mei", "Juni", "Juli", "Agustus", "September",
            "Oktober", "Nopember", "Desember"
        ],
        monthNamesShort: ["Jan", "Feb", "Mar", "Apr", "Mei", "Jun", "Jul", "Agus", "Sep", "Okt", "Nop", "Des"],
        dayNames: ["Minggu", "Senin", "Selasa", "Rabu", "Kamis", "Jumat", "Sabtu"],
        dayNamesShort: ["Min", "Sen", "Sel", "Rab", "kam", "Jum", "Sab"],
        dayNamesMin: ["Mg", "Sn", "Sl", "Rb", "Km", "jm", "Sb"],
        weekHeader: "Mg ke",
        dateFormat: "dd/mm/yy",
        firstDay: 0,
        isRTL: false,
        showMonthAfterYear: false,
        yearSuffix: ""
    });

    $(document).on('click', '#cekdata', function () {
        $('#modal_fixed').modal({
            backdrop: 'static',
            keyboard: false
        })
        $('#modal_fixed').modal('show');
    });

    function perbaiki_data() {
        $('#modal_fixed').modal({
            backdrop: 'static',
            keyboard: false
        })
        $('#modal_fixed').modal('show');
    }

    function wilayahCek() {
        var checkBox = document.getElementById("cek_wilayah");
        if (checkBox.checked == true) {
            $('#cek_wilayah').val(1);
            $('#prov_fixed').attr('required', true);
            $('#kab_fixed').attr('required', true);
            $('#kec_fixed').attr('required', true);
            $('#desa_fixed').attr('required', true);
            $('#rumah_fix').attr('required', true);

            $(".menu_wilayah").show(1200);
            $('#modal_fixed').animate({
                scrollTop: $(".menu_wilayah").offset().top
            }, 'slow');
        } else {
            $('#cek_wilayah').val(0);
            $('#prov_fixed').attr('required', false);
            $('#kab_fixed').attr('required', false);
            $('#kec_fixed').attr('required', false);
            $('#desa_fixed').attr('required', false);
            $('#rumah_fix').attr('required', false);

            $(".menu_wilayah").hide(1200)
        }
    }

    $(document).on('click', '#btn_perbaikan_update', function () {
        $('.form_perbaikan_update').parsley().validate();
        let val_ktp = $('#val_ktp_fix').val();
        if ($('.form_perbaikan_update').parsley().isValid()) {
            let formPack = new FormData($('.form_perbaikan_update').get(0));

            swal.fire({
                title: 'KONFIRMASI',
                html: 'Data perbaikan sudah sesuai ? <br> lanjut proses perbaikan data ?',
                icon: 'warning',
                showCancelButton: !0,
                reverseButtons: !0,
                confirmButtonText: 'Ya, Lanjut',
                confirmButtonColor: 'green',
                cancelButtonText: 'Cek lagi',
            }).then(function (e) {
                if (e.value === true) {
                    getSwalLoading(1, 'Proses Perbaikan Data', 'Mohon Tunggu...')
                    $.ajax({
                        url: "<?php echo e(route('daftar.fix')); ?>",
                        method: 'post',
                        data: formPack,
                        contentType: false,
                        processData: false,
                        dataType: 'json',
                        success: function (data) {
                            getSwalLoading(0, null, null)
                            if (data.success) {

                                $('.sub_head').attr('hidden', true);
                                $('.sub_head_after').attr('hidden', false);
                                $('#btn_perbaikan_konfirmasi').attr('hidden', false);
                                $('#menu_perbaikan_update').attr('hidden', true);
                                $('#cek_login_fix').show();
                                $('#menu_edit_fix').hide();
                                $('.form_perbaikan')[0].reset();
                                $('#modal_fixed').modal('hide');

                                swal.fire({
                                    title: 'INFORMASI',
                                    html: data.message,
                                    icon: 'success'
                                })
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
            if (val_ktp == 1) {
                $('#modal_fixed').animate({
                    scrollTop: $("#pesan_error_ktp").offset().top
                }, 'slow');
            }
        }
    })

    $(document).on('click', '#btn_perbaikan_konfirmasi', function () {
        $('.form_perbaikan').parsley().validate();
        if ($('.form_perbaikan').parsley().isValid()) {
            let formPack = new FormData($('.form_perbaikan').get(0));
            getSwalLoading(1, 'Proses Pengecekan Data', 'Mohon Tunggu...')
            $.ajax({
                url: "<?php echo e(route('cek.perbaikan')); ?>",
                data: formPack,
                dataType: 'json',
                method: 'post',
                processData: false,
                contentType: false,
                success: function (data) {
                    getSwalLoading(0, null, null)
                    if (data.success) {

                        const Toast = Swal.mixin({
                            toast: true,
                            position: 'top',
                            showConfirmButton: false,
                            timer: 1700,
                            timerProgressBar: true,
                            didOpen: (toast) => {
                                toast.addEventListener('mouseenter', Swal.stopTimer)
                                toast.addEventListener('mouseleave', Swal.resumeTimer)
                            }
                        })

                        Toast.fire({
                            icon: 'success',
                            title: 'Ok!'
                        })

                        $('.sub_head').attr('hidden', true);
                        $('.sub_head_after').attr('hidden', false);

                        $('#pesan_fix').html("Pesan : <b>" + data.pack.pesan + "</b>");

                        $('#span_status').html(data.pack.status);

                        $('#val_up').val(data.pack.val);
                        $('#no_ktp_fix').val(data.pack.no_ktp);
                        $('#nama_fix').val(data.pack.name);
                        $('#email_fixed').val(data.pack.email);
                        $('#ttl_fix').val(data.pack.ttl);
                        $('#rumah_fix').val(data.pack.alamat);
                        // $('#desa_fixed').val(data.pack.id_desa);
                        $('#old_ktp').val(data.pack.foto_ktp);

                        $('#jk_fix').val(data.pack.jk).attr('selected', true);

                        let wilayah = "Desa " + data.pack.desa_self.name.toLowerCase() +
                            ", Kecamatan " + data.pack.kec_self.name.toLowerCase() + ", " + data
                            .pack.kab_self.name.toLowerCase() + ", Provinsi " + data.pack.prov_self
                            .name.toLowerCase() + ". ";
                        wilayah = wilayah.toLowerCase().replace(/\b[a-z]/g, function (letter) {
                            return letter.toUpperCase();
                        });
                        let almt = data.pack.alamat + ", " + wilayah;
                        $('#alamat_lengkap').val(almt);

                        //$('#desa_fixed').val(data.pack.id_desa).attr('selected', true);
                        // $('#kec_fixed').val(data.pack.kec_self).attr('selected', true);
                        //$('#kab_fixed').val(data.pack.kab_self).attr('selected', true);
                        //$('#prov_fixed').val(data.pack.prov_self).attr('selected', true);

                        //$("#desa_fixed option").filter(function() {
                        //    return $(this).text() == data.pack.desa_self.name;
                        // }).attr('selected', true);

                        $('#foto_ktp_fixed').attr('src', "<?php echo e(asset('/img/user/ktp')); ?>/" + data
                            .pack.id_desa + "/" + data.pack.foto_ktp +
                            "");

                        $('#btn_perbaikan_konfirmasi').attr('hidden', true);
                        $('#menu_perbaikan_update').attr('hidden', false);

                        $('#cek_login_fix').hide(1200);
                        $('#menu_edit_fix').show(1200);

                    } else {
                        const Toast = Swal.mixin({
                            toast: true,
                            position: 'top',
                            showConfirmButton: false,
                            timer: 1700,
                            timerProgressBar: true,
                            didOpen: (toast) => {
                                toast.addEventListener('mouseenter', Swal.stopTimer)
                                toast.addEventListener('mouseleave', Swal.resumeTimer)
                            }
                        })

                        Toast.fire({
                            icon: 'error',
                            title: 'Email atau Password Salah'
                        })
                    }
                },
                error: function () {
                    getSwalLoading(0, null, null)
                    swal.fire('ERROR', 'Server Bermasalah. Coba Lagi Nanti', 'error')
                }

            })
        } else {
            swal.fire('not valid');
        }
    });

    $(document).on('click', '.btn_cancel', function () {
        swal.fire({
            title: 'KONFIRMASI',
            text: 'Tutup menu perbaikan data registrasi?',
            icon: 'info',
            showCancelButton: !0,
            reverseButtons: !0,
            confirmButtonText: 'Ya, Tutup',
            cancelButtonText: 'Tidak',
        }).then(function (e) {
            if (e.value === true) {

                $('.sub_head').attr('hidden', true);
                $('.sub_head_after').attr('hidden', false);
                $('#btn_perbaikan_konfirmasi').attr('hidden', false);
                $('#btn_perbaikan_update').attr('hidden', true);
                $('#cek_login_fix').show();
                $('#menu_edit_fix').hide();
                $('.form_perbaikan')[0].reset();
                $('#modal_fixed').modal('hide');
            } else {
                e.dismiss;
            }
        }, function (dismiss) {
            return false;
        })
    });

    $('.selectpicker').selectpicker({
        style: 'btn-sm border'
    });
    $('.selectpicker').attr('data-trigger', 'change').attr('data-required', 'true').attr('data-style', 'btn-sm');

    $(document).ready(function () {
        $('#prov_fixed').selectpicker();
        $("#no_ktp_fix").keyup(function () {
            var no_ktp = $(this).val().trim();
            if (no_ktp != '') {
                $.ajax({
                    url: "<?php echo e(route('check_ktp')); ?>",
                    type: 'post',
                    data: {
                        '_token': '<?php echo e(csrf_token()); ?>',
                        no_ktp: no_ktp
                    },
                    success: function (response) {
                        var red =
                            '<span style="font-size: 0.9em;color: #B94A48;" role="alert"><ul class="remove-dot""><li>No.KTP sudah terdaftar!</li></ul></span>';
                        if (response == 1) {
                            $('#val_ktp_fix').val(1);
                            $('.btn-confirm-email').attr('disabled', true);
                            $('#btn_perbaikan_update').attr('disabled', true);
                            $('#uname_response').html(red);
                        } else {
                            $('.btn-confirm-email').attr('disabled', false);
                            $('#btn_perbaikan_update').attr('disabled', false);
                            $('#val_ktp_fix').val(0);
                            $("#uname_response").html("");
                        }
                    }
                });
            } else {
                $("#uname_response").html("");
            }
        });
    });

    $(function () {
        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        });

        $('#prov_fixed').on('change', function () {
            $.ajax({
                url: "<?php echo e(route('wil.kota')); ?>",
                method: 'POST',
                data: {
                    '_token': '<?php echo e(csrf_token()); ?>',
                    id: $(this).val()
                },
                success: function (response) {
                    $('#kab_fixed').empty();
                    $.each(response, function (id, name) {
                        $('#kab_fixed').append(new Option(name, id)).selectpicker(
                            'refresh');
                    })
                }
            })
        });

        $('#kab_fixed').on('change', function () {
            $.ajax({
                url: "<?php echo e(route('wil.kec')); ?>",
                method: 'POST',
                data: {
                    '_token': '<?php echo e(csrf_token()); ?>',
                    id: $(this).val()
                },
                success: function (response) {
                    $('#kec_fixed').empty();
                    $.each(response, function (id, name) {
                        $('#kec_fixed').append(new Option(name, id)).selectpicker(
                            'refresh');
                    })
                }
            })
        });

        $('#kec_fixed').on('change', function () {
            $.ajax({
                url: "<?php echo e(route('wil.desa')); ?>",
                method: 'POST',
                data: {
                    '_token': '<?php echo e(csrf_token()); ?>',
                    id: $(this).val()
                },
                success: function (response) {
                    $('#desa_fixed').empty();
                    $.each(response, function (id, name) {
                        $('#desa_fixed').append(new Option(name, id)).selectpicker(
                            'refresh');
                    })
                }
            })
        });


    });

    $(function () {
        var $sections2 = $('.form-bagi');

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
            $('.form-navigation-2 [id=btn_perbaikan_update]').toggle(atTheEnd);
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
            $('.form_perbaikan_update').parsley().whenValidate({
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

</script>
<?php /**PATH C:\xampp\htdocs\desacuss_new\resources\views/auth/modal/perbaikan.blade.php ENDPATH**/ ?>