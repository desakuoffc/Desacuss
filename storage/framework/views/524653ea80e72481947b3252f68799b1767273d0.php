<script>
    $(document).ready(function () {

        // KATEGORI
        // modal kategori
        $('#btn_manage_kategori').click(function () {
            $('#openModalKategori').modal('show');
        })

        // Tabel Kategori
        $('#tabel_kategori').DataTable({
            processing: true,
            serverSide: true,
            ajax: {
                url: "<?php echo e(route('kategori.index')); ?>"
            },
            'columnDefs': [{
                "targets": [0, 1, 2, 3, 4, 5],
                "className": "text-center main",
            }, ],
            'createdRow': function (row, data, dataIndex) {
                $(row).find('td:eq(0)').attr({
                    'id': 'values',
                    'data-value': data.id_kategori
                });
                $(row).find('td:eq(1)').attr({
                    'id': 'nama',
                    'data-nama': data.nama_kategori
                });
                $(row).find('td:eq(2)').attr({
                    'id': 'warna',
                    'data-warna': data.warna
                });
                $(row).find('td:eq(3)').attr({
                    'id': 'jenis',
                    'data-jenis': data.deskripsi
                });
            },
            columns: [{
                    data: 'DT_RowIndex'
                },
                {
                    data: 'nama_kategori'
                },
                {
                    data: 'color'
                },
                {
                    data: 'desk'
                },
                {
                    data: 'diskusi'
                },
                {
                    data: 'action',
                    orderable: false,
                    searchable: false
                }
            ]
        });

        // End Tabel Kategori

        // MODAL CLOSE
        $('#openModalKategori').on('hidden.bs.modal', function (e) {
            $('#kategoriHeader').html('Tambah Kategori');
            $('#btnAddCreateKategori').html('Tambah');
            $('#formKategori')[0].reset();
            $('#formCardKategori').hide(1100);
            $('#tableKategori').show();
        })

        // SHOW ADD KATEGORI
        $('#btnAddKategori').click(function () {
            $('#tableKategori').hide(1100);
            $('#formCardKategori').show(1100);
            $('#openModalKategori').animate({
                scrollTop: $("#kategoriHeader").offset().top
            }, 200);
        })


        //SHOW EDIT KATEGORI
        $(document).on('click', '.btnEditKategori', function () {
            const nama = $(this).closest("tr").find("#nama").text();
            const warna = $(this).closest("tr").find("#warna").data('warna');
            const desk = $(this).closest("tr").find("#jenis").data('jenis');
            const value = $(this).closest("tr").find("#values").data('value');

            $('#kategoriHeader').html('Edit Kategori');
            $('#btnAddCreateKategori').html('Update');
            $('#tableKategori').hide(1100);
            $('#formCardKategori').show(1100);
            $('#openModalKategori').animate({
                scrollTop: $("#kategoriHeader").offset().top
            }, 200);

            $('#namaKategori').val(nama);
            $('#deskKategori').val(desk);
            $('#warnaKategori').val(warna);
            $('#val_kategori').val(value);
            $('#prevKategori').removeClass().addClass('badge font-14')
                .addClass('bg-' + warna)
                .text(nama);
        });


        $(document).on('click', '.btnDeleteKategori', function () {
            const nama = $(this).closest("tr").find("#nama").text();
            const id = $(this).data('id');
            swal.fire({
                title: 'HAPUS KATEGORI',
                html: `Hapus Kategori <b>${nama}</b> ? <br> Data diskusi yang berkategorikan <b>${nama}</b> akan <b class="merah">TERHAPUS SECARA OTOMATIS.</b><br> Lanjut hapus kategori <b>${nama}</b>?`,
                showCancelButton: !0,
                reverseButtons: !0,
                confirmButtonText: 'Ya, Hapus',
                confirmButtonColor: 'red',
                cancelButtonText: 'Cancel',
                cancelButtonColor: 'green'
            }).then(function (e) {
                if (e.value === true) {
                    getSwalLoading(1, 'Proses Hapus Kategori', 'Mohon Tunggu...')
                    $.ajax({
                        url: "<?php echo e(route('kategori.delete')); ?>",
                        data: {
                            "_token": "<?php echo e(csrf_token()); ?>",
                            id: id,
                            nama: nama
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
                                $('#tabel_kategori').DataTable().ajax.reload();

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
                            swal.fire('ERROR', 'Terjadi masalah. Coba lagi nanti',
                                'error')
                        }
                    })
                } else {
                    return dismiss;
                }
            }, function (dismiss) {
                return false;
            })
        });

        $('#btnCloseCreateKategori').click(function () {
            $('#kategoriHeader').html('Tambah Kategori');
            $('#btnAddCreateKategori').html('Tambah');
            $('#formKategori')[0].reset();
            $('#formCardKategori').hide(600, function () {
                $('#tableKategori').show(800);
            });

        })

        $('#namaKategori').keyup(function () {
            let val = $(this).val();
            $('#prevKategori').html(val)
        })

        $('.select-kategori').change(function () {
            $('#prevKategori').removeClass()
            let val = $(this).val();
            if (val == 'success') {
                $('#prevKategori').addClass('badge font-14 bg-success');
            } else if (val == 'secondary') {
                $('#prevKategori').addClass('badge font-14 bg-secondary');
            } else if (val == 'primary') {
                $('#prevKategori').addClass('badge font-14 bg-primary');
            } else if (val == 'secondary') {
                $('#prevKategori').addClass('badge font-14 bg-secondary');
            } else if (val == 'warning') {
                $('#prevKategori').addClass('badge font-14 bg-warning');
            } else if (val == 'danger') {
                $('#prevKategori').addClass('badge font-14 bg-danger');
            } else if (val == 'info') {
                $('#prevKategori').addClass('badge font-14 bg-info');
            } else {
                $('#prevKategori').addClass('badge font-14 bg-secondary');
            }
        })

        $('#btnAddCreateKategori').click(function () {
            let status = $(this).html();
            let id = $(this).data('id');
            $('#formKategori').parsley().validate();
            if ($('#formKategori').parsley().isValid()) {
                let formDatas = $('#formKategori').get(0);
                let formPack = new FormData(formDatas);
                formPack.append('status', status);
                swal.fire({
                    title: 'KONFIRMASI',
                    html: 'Data sudah sesuai?, lanjutkan proses?',
                    reverseButtons: !0,
                    showCancelButton: !0,
                    confirmButtonText: 'Lanjut',
                    cancelButtonText: 'Cek Lagi',
                }).then(function (e) {
                    if (e.value === true) {
                        getSwalLoading(1, `Sedang Memproses ${status} Kategori`,
                            'Mohon Tunggu...')
                        $.ajax({
                            url: "<?php echo e(route('kategori.create')); ?>",
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
                                    $('#tabel_kategori').DataTable().ajax.reload();
                                    $('#kategoriHeader').html('Tambah Kategori');
                                    $('#btnAddCreateKategori').html('Tambah');
                                    $('#formKategori')[0].reset();
                                    $('#formCardKategori').hide(600, function () {
                                        $('#tableKategori').show(800);
                                    });
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
                                swal.fire('ERROR',
                                    'Server Bermasalah. Coba lagi nanti',
                                    'error')
                            }
                        })
                    } else {
                        return e.dismiss;
                    }
                }, function (dismiss) {
                    return false
                })
            }
        })

        // END KATEGORI
    })

</script>
<?php /**PATH C:\xampp\htdocs\desacuss\resources\views/admin/diskusi/jskategori.blade.php ENDPATH**/ ?>