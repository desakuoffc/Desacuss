<script>
    $(document).on('click', '#radioForum', function () {
        $('#div_widget_widget').fadeOut(600, function () {
            $('#div_widget_forum').fadeIn(600);
        })
    })

    $(document).on('click', '#radioWidget', function () {
        $('#div_widget_forum').fadeOut(600, function () {
            $('#div_widget_widget').fadeIn(600);
        })
    })

    $(document).on('click', '.btnVoteNow', function () {
        let data_vote = $(this).data('vote');
        let data_idvote = $(this).data('idvote');
        let data_idurut = $(this).data('idurut');
        let data_nama = $(this).data('nama');

        swal.fire({
            title: 'KONFIRMASI VOTING',
            html: `Vote ${data_nama}. <br> Anda Memilih ${data_vote}. Setelah Anda Memilih, Voting <b class="merah">Tidak Bisa Diubah</b><br><br>Lanjut Proses Voting?`,
            imageUrl: "<?php echo e(asset('img/vote.png')); ?>",
            imageWidth: 150,
            imageHeight: 150,
            reverseButtons: true,
            showCancelButton: true,
            cancelButtonText: 'Tidak',
            confirmButtonText: 'Ya, Lanjut',
        }).then((e) => {
            if (e.isConfirmed) {
                getSwalLoading(1, 'Proses Update Voting', 'Mohon Tunggu...')
                $.ajax({
                    url: "<?php echo e(route('diskusi.update.vote')); ?>",
                    method: 'post',
                    dataType: 'json',
                    data: {
                        '_token': "<?php echo e(csrf_token()); ?>",
                        vote: data_vote,
                        id_vote: data_idvote,
                        urut: data_idurut,
                        nama: data_nama
                    },
                    success: function (data) {
                        getSwalLoading(0, null, null)
                        if (data.info) {
                            swal.fire('INFORMASI', data.message,
                                'info')
                        } else if (data.success) {
                            let id = data.vote.id;
                            for (let index = 1; index <= data.vote.total; index++) {
                                $(`#progress_custom_${id}_${index}`).css('width', data.vote
                                    .pvote[index]);
                                $(`#percent_custom_${id}_${index}`).text(data.vote.pvote[
                                    index]);
                                $(`#total_suara_${id}_${index}`).text(
                                    `${data.vote.tvote[index]} (suara)`);
                                $(`#btnVoteCustom_${id}_${index}`).addClass('sembunyi');
                                $(`#btnVoteNow_${id}_${index}`).attr('disabled', true);
                            }

                            $(`#suara_masuk_${id}`).text(
                                `Suara Masuk : ${data.vote.suara_masuk} (${data.vote.suara_masuk_p})`
                            );
                            $(`#alert_status_vote_${id}`).removeClass(`alert-danger`)
                            $(`#alert_status_vote_${id}`).addClass(`alert-success`)
                            $(`#icon_status_vote_${id}`).removeClass(
                                `bi-exclamation-triangle`)
                            $(`#icon_status_vote_${id}`).addClass(`bi-check-circle`)
                            $(`#span_status_memilih_${id}`).text(
                                `Anda Sudah Memilih Voting.`);

                            swal.fire('INFORMASI', data.message,
                                'success');

                        } else {
                            swal.fire('INFORMASI', data.message,
                                'error')
                        }
                    },
                    error: function (data) {
                        getSwalLoading(0, null, null)
                        swal.fire('INFORMASI', 'Terjadi Kesalahan, Coba Lagi Nanti.',
                            'error')
                    }
                });

            } else {
                e.dismiss;
            }
        })
    })

    // WIDGET APP DESAKU
    $(document).ready(function () {
        moment.locale('id');
        getNews();
        getStore();
        getWisata();
        getKuliner();
    })

    var url_berita = 'https://desaku-desanews.masuk.id/api/berita';
    var url_store = 'http://marketpalcedesaku.masuk.web.id/api/products';
    var url_wisata = 'https://desaku-desatour.masuk.id/api/wisata';
    var url_kuliner = 'https://desaku-desatour.masuk.id/api/kuliner'

    function getNews() {
        $.ajax({
            url: url_berita,
            method: 'get',
            dataType: 'json',
            success: function (respon) {
                let ht = ''

                if (parseInt(respon.length) < 1) {
                    ht += `<p class="text-center">Belum ada berita.</p>`
                } else {
                    ht += `<ul class="remove-dot">`
                    for (let index = 0; index < respon.length; index++) {
                        let tgl = moment(respon[index].created_at).format('dddd, Do MMMM YYYY')
                        let sisa = moment(respon[index].created_at).fromNow()

                        ht += `<li class="mb-3">`
                        ht += `<div class="card">`
                        ht += `<img src="https://desaku-desanews.masuk.id/${respon[index].gambar}"`
                        ht += `onerror="this.onerror=null;this.src='<?php echo e(asset('/img/background-3.jpg')); ?>';"`
                        ht += `class="card-img-top">`
                        ht += `<div class="card-img-overlay p-2 font-14">`
                        ht += `<span class="badge bg-success me-1">`
                        ht += `${respon[index].kategori.nama_kategori}`
                        ht += `</span>`
                        ht += `<span class="badge bg-success">`
                        ht += `Desa ${clean_text(respon[index].kelurahans)}`
                        ht += `</span>`
                        ht += `</div>`
                        ht += `<div class="card-body z2">`
                        ht +=
                            `<a href="https://desaku-desanews.masuk.id/berita/${respon[index].id}/${respon[index].slug}"`
                        ht += `class="teks-item-forum font-14 remove-underline-just hitam sebaris-block">`
                        ht += `${respon[index].judul}`
                        ht += `</a>`
                        ht += `</div>`
                        ht += `<div class="card-footer bg-white">`
                        ht += `<p class="text-muted mb-0 font-12">`
                        ht +=
                            `${tgl} - ${sisa}`
                        ht += `</p>`
                        ht += `</div>`
                        ht += `</div>`
                        ht += `</li>`

                        if (index === 4) {
                            break;
                        }
                    }
                    ht += `</ul>`
                }

                $(ht).appendTo(".main_berita").fadeIn(400);

                $('.load_berita').fadeOut(800, function () {
                    $('.main_berita').fadeIn(800)
                })
            },
            error: function () {
                $('.load_berita').fadeOut(800, function () {
                    $('.error_berita').fadeIn(800)
                })
            }
        })
    }


    function getStore() {
        $.ajax({
            url: url_store,
            method: 'get',
            dataType: 'json',
            success: function (respon) {
                let ht = ''

                if (parseInt(respon.length) < 1) {
                    ht += `<p class="text-center">Belum ada produk.</p>`
                } else {
                    ht += `<ul class="remove-dot">`
                    for (let index = 0; index < respon.length; index++) {

                        ht += `<li class="mb-2">`
                        ht += `<div class="d-flex align-items-center">`
                        ht += `<div class="flex-shrink-0">`
                        ht += `<img class="mx-auto d-block rounded" style="object-fit: cover"`
                        ht +=
                            `src="http://marketpalcedesaku.masuk.web.id/storage/${respon[index].galleries[0].photos}"`
                        ht += `onerror="this.onerror=null;this.src='<?php echo e(asset('/img/store_error.png')); ?>';"`
                        ht += `width="50" height="50">`
                        ht += `</div>`
                        ht += `<div class="flex-grow-1 ms-3">`
                        ht += `<p class="mb-0 font-14">`
                        ht +=
                            `<a href="http://marketpalcedesaku.masuk.web.id/details/${respon[index].slug}" class="modalStore teks-item-forum font-14 remove-underline-just hitam sebaris-block">`
                        ht += `${respon[index].name}`
                        ht += `</a>`
                        ht += `</p>`
                        ht += `<p class="text-muted mt-0 mb-0 font-12">`
                        ht += `<span class="text-muted font-12">`
                        ht += `${formatRupiah2(respon[index].price)}`
                        ht += `</span>`
                        ht += `</p>`
                        ht += `</div>`
                        ht += `</div>`
                        if (index <= 3) {
                            ht += '<hr>'
                        }
                        ht += `</li>`

                        if (index === 4) {
                            break;
                        }
                    }
                    ht += `</ul>`
                }

                $(ht).appendTo(".main_store").fadeIn(400);

                $('.load_store').fadeOut(800, function () {
                    $('.main_store').fadeIn(800)
                })
            },
            error: function () {
                $('.load_store').fadeOut(800, function () {
                    $('.error_store').fadeIn(800)
                })
            }
        })
    }

    function getWisata() {
        $.ajax({
            url: url_wisata,
            method: 'get',
            dataType: 'json',
            success: function (respon) {
                let ht = ''

                if (parseInt(respon.hasil.total) < 1) {
                    ht += `<p class="text-center">Belum ada wisata.</p>`
                } else {
                    ht += `<ul class="remove-dot">`
                    for (let index = 0; index < respon.hasil.total; index++) {

                        ht += `<li class="mb-3">`
                        ht += `<div class="card">`
                        ht += `<img src="${respon.data[index].foto}"`
                        ht += `onerror="this.onerror=null;this.src='<?php echo e(asset('/img/background-3.jpg')); ?>';"`
                        ht += `class="card-img-top">`
                        ht += `<div class="card-img-overlay p-2 font-14">`
                        ht += `<span class="badge bg-success me-1">`
                        ht += `${respon.data[index].kategori}`
                        ht += `</span>`
                        ht += `<span class="badge bg-success">`
                        ht += `${respon.data[index].wilayah.desa}`
                        ht += `</span>`
                        ht += `</div>`
                        ht += `<div class="card-body z2">`
                        ht += `<a href="${respon.data[index].url}"`
                        ht += `class="teks-item-forum font-14 remove-underline-just hitam sebaris-block">`
                        ht += `${respon.data[index].nama}`
                        ht += `</a>`
                        ht += `<p class="mb-0 font-12">`
                        ht += `${respon.data[index].biaya}`
                        ht += `</p>`
                        ht += `</div>`
                        ht += `<div class="card-footer bg-white">`
                        ht += `<span class="text-muted font-12">`
                        ht += `<i class="bi bi-clock me-1"></i>`
                        ht += `${respon.data[index].jam}`
                        ht += `</span>`
                        ht += `</div>`
                        ht += `</div>`
                        ht += `</li>`

                        if (index === 4) {
                            break;
                        }
                    }
                    ht += `</ul>`
                }

                $(ht).appendTo(".main_wisata").fadeIn(400);

                $('.load_wisata').fadeOut(800, function () {
                    $('.main_wisata').fadeIn(800)
                })
            },
            error: function () {
                $('.load_wisata').fadeOut(800, function () {
                    $('.error_wisata').fadeIn(800)
                })
            }
        })
    }

    function getKuliner() {
        $.ajax({
            url: url_kuliner,
            method: 'get',
            dataType: 'json',
            success: function (respon) {

                let ht = ''

                if (parseInt(respon.hasil.total) < 1) {
                    ht += `<p class="text-center">Belum ada kuliner.</p>`
                } else {
                    ht += `<ul class="remove-dot">`
                    for (let index = 0; index < respon.hasil.total; index++) {

                        ht += `<li class="mb-3">`
                        ht += `<div class="card">`
                        ht += `<img src="${respon.data[index].foto}"`
                        ht += `onerror="this.onerror=null;this.src='<?php echo e(asset('/img/background-3.jpg')); ?>';"`
                        ht += `class="card-img-top">`
                        ht += `<div class="card-img-overlay p-2 font-14">`
                        ht += `<span class="badge bg-success me-1">`
                        ht += `${respon.data[index].jenisMakanan}`
                        ht += `</span>`
                        ht += `<span class="badge bg-success">`
                        ht += `${respon.data[index].wilayah.desa}`
                        ht += `</span>`
                        ht += `</div>`
                        ht += `<div class="card-body p-1 ps-2 pb-0 z2">`
                        ht += `<span class="badge bg-success font-10 me-1">`
                        ht += `${respon.data[index].tempat}`
                        ht += `</span>`
                        ht += `<span class="badge bg-success font-10">`
                        ht += `${respon.data[index].jenisTempat}`
                        ht += `</span>`
                        ht += `</div>`
                        ht += `<div class="card-body pt-1 z2">`
                        ht += `<a href="${respon.data[index].url}"`
                        ht += `class="teks-item-forum font-14 remove-underline-just hitam sebaris-block">`
                        ht += `${respon.data[index].nama}`
                        ht += `</a>`
                        ht += `<p class="mb-0 font-12">`
                        ht += `${respon.data[index].harga}`
                        ht += `</p>`
                        ht += `</div>`
                        ht += `<div class="card-footer bg-white">`
                        ht += `<span class="text-muted font-12">`
                        ht += `<i class="bi bi-clock me-1"></i>`
                        ht += `${respon.data[index].jam}`
                        ht += `</span>`
                        ht += `</div>`
                        ht += `</div>`
                        ht += `</li>`

                        if (index === 4) {
                            break;
                        }
                    }
                    ht += `</ul>`
                }

                $(ht).appendTo(".main_kuliner").fadeIn(400);

                $('.load_kuliner').fadeOut(800, function () {
                    $('.main_kuliner').fadeIn(800)
                })
            },
            error: function () {
                $('.load_kuliner').fadeOut(800, function () {
                    $('.error_kuliner').fadeIn(800)
                })
            }
        })
    }

    $(document).on('click', '.refreshApi', function () {
        let api = $(this).attr('api')
        if (api == 'berita') {
            $('.error_berita').fadeOut(400, function () {
                $('.main_berita').fadeOut(400, function () {
                    $(this).empty();
                    $('.load_berita').fadeIn(400, function () {
                        getNews()
                    })
                })
            })

        } else if (api == 'store') {
            $('.error_store').fadeOut(400, function () {
                $('.main_store').fadeOut(400, function () {
                    $(this).empty();
                    $('.load_store').fadeIn(400, function () {
                        getStore()
                    })
                })
            })
        } else if (api == 'wisata') {
            $('.error_wisata').fadeOut(400, function () {
                $('.main_wisata').fadeOut(400, function () {
                    $(this).empty();
                    $('.load_wisata').fadeIn(400, function () {
                        getWisata()
                    })
                })
            })
        } else if (api == 'kuliner') {
            $('.error_kuliner').fadeOut(400, function () {
                $('.main_kuliner').fadeOut(400, function () {
                    $(this).empty();
                    $('.load_kuliner').fadeIn(400, function () {
                        getKuliner()
                    })
                })
            })
        }
    })

    const clean_text = (s) => {
        let x = s.toLowerCase();
        if (typeof x !== 'string') return ''
        return x.charAt(0).toUpperCase() + x.slice(1)
    }

</script>
<?php /**PATH C:\xampp\htdocs\desacuss\resources\views/user/js/widget.blade.php ENDPATH**/ ?>