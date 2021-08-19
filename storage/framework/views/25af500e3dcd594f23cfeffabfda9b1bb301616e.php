<?php $__env->startSection('konten'); ?>
<?php echo $__env->make('user.create.konten', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
<?php $__env->stopSection(); ?>

<?php $__env->startSection('js'); ?>
<script>
    $(document).ready(function () {

        getKategori();
        $('#div_tambah_diskusi').show(600);
        $('#div_tambah_diskusi').removeClass('container-fluid container-kastem');
        $('.btn_close_form').hide();
        $('#card_header_add_diskusi').hide();

        $('#nama_diskusi').attr('required', true);
        $('#listKategori').attr('required', true);
        $('#deskDiskusi').attr('required', true);


        $('#deskDiskusi').summernote({
            placeholder: 'Tulis isi forum disini...',
            lang: 'id-ID',
            tabsize: 2,
            height: 150
        });
    })

    function getKategori() {
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
            }
        })
    }

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
                    getSwalLoading(1, 'Proses Menambahkan Forum Diskusi', 'Mohon Tunggu...')
                    $.ajax({
                        url: "<?php echo e(route('home.store')); ?>",
                        data: formPack,
                        method: 'post',
                        dataType: 'json',
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

    $(function () {
        $("#tgl_vote").datepicker();
    });


    window.Parsley.addValidator('summernoteRequired', {
        validateString: function (value, _value, _el) {
            var val = $($(_el.$element[0]).val()).text().trim();
            if (val.length < 1) return false;
        }
    });

</script>

<?php echo $__env->make('user.js.widget', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('user.master', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\xampp\htdocs\desacuss_new\resources\views/user/create/komponen.blade.php ENDPATH**/ ?>