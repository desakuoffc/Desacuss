<!-- Modal Kategori -->
<div class="modal fade" id="openModalKategori" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1"
    aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered modal-dialog-scrollable modal-xl">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Manage Kategori</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <div id="tableKategori">
                    <a id="btnAddKategori" class="btn btn-labeled btn-outline-success btn-sm mb-3">
                        <span class="btn-label"><i class="bi bi-plus-lg"></i></span>
                        Tambah Kategori
                    </a>
                    <div class="table-responsive">
                        <table id="tabel_kategori" class="main inventory" style="width: 100%">
                            <thead>
                                <tr class="main">
                                    <th class="main" style="width: 50px;">No.</th>
                                    <th class="main" style="width: 170px;">Nama</th>
                                    <th class="main" style="width: 170px;">Warna</th>
                                    <th class="main">Deskripsi</th>
                                    <th class="main" style="width: 170px;">Total</th>
                                    <th class="main" style="width: 170px;">#</th>
                                </tr>
                            </thead>
                            <tbody>
                                <tr class="main">
                                    <td class="main">1</td>
                                    <td class="main" id="nama">Aspirasi</td>
                                    <td class="main" id="warna" data-value="success"><span
                                            class="badge bg-success font-12">Aspirasi</span></td>
                                    <td class="main" id="desk">Aspirasi Adalah ...</td>
                                    <td class="main">50 Forum</td>
                                    <td class="main" class="text-center">
                                        <div class="btn-group" role="group"
                                            aria-label="Button group with nested dropdown">
                                            <a id="btnEditKategori"
                                                class="btnEditKategori btn btn-primary btn-sm">Edit</a>
                                            <a id="btnDeleteKategori"
                                                class="btnDeleteKategori btn btn-danger btn-sm">Delete</a>
                                        </div>
                                    </td>
                                </tr>
                                <tr class="main">
                                    <td class="main">2</td>
                                    <td class="main" id="nama">Keluhan</td>
                                    <td class="main" id="warna" data-value="info"><span
                                            class="badge bg-info font-12">Keluhan</span></td>
                                    <td class="main" id="desk">Keluhan Adalah ...</td>
                                    <td class="main">20 Forum</td>
                                    <td class="main" class="text-center">
                                        <div class="btn-group" role="group"
                                            aria-label="Button group with nested dropdown">
                                            <a id="btnEditKategori"
                                                class="btnEditKategori btn btn-primary btn-sm">Edit</a>
                                            <a id="btnDeleteKategori"
                                                class="btnDeleteKategori btn btn-danger btn-sm">Delete</a>
                                        </div>
                                    </td>
                                </tr>
                            </tbody>
                        </table>
                    </div>
                </div>

                <div id="formCardKategori" class="sembunyi">
                    <div class="card">
                        <div id="kategoriHeader" class="card-header">Tambah Kategori</div>
                        <div class="card-body">
                            <form id="formKategori" class="formKategori">
                                <?php echo csrf_field(); ?>
                                <input hidden id="val_kategori" type="text" name="values">
                                <div class="mb-3">
                                    <label for="namaKategori" class="form-label">Nama Kategori</label>
                                    <input type="text" class="form-control" id="namaKategori" name="nama"
                                        required="required" placeholder=""
                                        data-parsley-errors-container="#nama_kategori_error"
                                        data-parsley-required-message="Nama kategori belum diisi.">
                                    <div id="nama_kategori_error" class="error-message-kuliner"></div>
                                </div>
                                <div class="mb-3">
                                    <label for="warnaKategori" class="form-label">Warna Kategori</label>
                                    <select class="select-kategori form-select" id="warnaKategori" name="warna"
                                        required="required" data-parsley-errors-container="#warna_kategori_error"
                                        data-parsley-required-message="Warna kategori belum diisi.">
                                        <option disabled value="" selected>--Pilih salah satu warna--</option>
                                        <option value="success">Hijau</option>
                                        <option value="primary">Biru</option>
                                        <option value="info">Biru Muda</option>
                                        <option value="secondary">Abu</option>
                                        <option value="warning">Kuning</option>
                                        <option value="danger">Merah</option>
                                    </select>
                                    <div id="warna_kategori_error" class="error-message-kuliner"></div>
                                </div>
                                <div class="mb-3">
                                    <label for="deskKategori" class="form-label">Deskripsi Kategori</label>
                                    <textarea name="deskripsiKategori" class="form-control" id="deskKategori" rows="2"
                                        required="required" placeholder=""
                                        data-parsley-errors-container="#desk_kategori_error"
                                        data-parsley-required-message="Deskripsi kategori belum diisi."></textarea>
                                    <div id="desk_kategori_error" class="error-message-kuliner"></div>
                                </div>
                                <div class="mb-3">
                                    <label for="" class="form-label">Preview</label>
                                    <p><span id="prevKategori" class="badge bg-success font-14">Preview</span></p>
                                </div>
                            </form>
                        </div>
                        <div class="card-footer">
                            <button id="btnAddCreateKategori"
                                class="btn btn-outline-success btn-sm pull-right ms-2">Tambah</button>
                            <button id="btnCloseCreateKategori"
                                class="btn btn-outline-danger btn-sm pull-right">Close</button>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<!-- End Modal Kategori -->


<div class="modal fade" id="openModalDetailDiskusi" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1"
    aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered modal-dialog-scrollable modal-xl">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Detail Forum Diskusi</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <div class="row">
                    <div class="col-md-3">
                        <img id="detail_img_user" src="<?php echo e(asset('img/user/3204280004/jiso1.jpg')); ?>"
                            class="img-fluid rounded">
                        <hr>
                        <div id="detail_nama" class="card-text text-center font-18">Mughny Mubarak</div>
                        <div id="detail_role" class="card-text text-center font-16">ROLE</div>
                    </div>
                    <div class="col-md-9">
                        <div class="menu-span">
                            <span id="detail_span_jenis" class="badge bg-success">Forum Voting</span>
                            <span id="detail_span_kategori" class="badge bg-success">Aspirasi</span>
                            <span id="detail_span_komentar" class="badge bg-success">20 Komentar</span>
                            <span id="detail_span_viewed" class="badge bg-success">Dilihat 20 kali</span>
                            <span id="detail_span_like" class="badge bg-success">20 Like</span>
                            <span id="detail_span_dislike" class="badge bg-success">20 Dislike</span>
                            <span id="detail_span_status" class="badge bg-success">Forum Terlihat</span>
                        </div>
                        <hr>
                        <div id="detail_judul" class="card-text font-20 mb-2">JUDUL FORUM DISKUSI</div>
                        <div class="card p-3 mb-3">
                            <div id="detail_deskripsi" class="menu-deskripsi"> </div>
                        </div>
                        <div id="detail_menu_voting" class="card p-2 menu-voting sembunyi">
                            <div class="card-title font-18 mb-1">Detail Voting</div>
                            <hr class="mb-1 mt-1">
                            <div class="detail_opsi">
                                <div class="mb-3">
                                    <label>Opsi 1</label>
                                    <div class="progress">
                                        <div class="progress-bar" role="progressbar" style="width: 25%;"
                                            aria-valuenow="25" aria-valuemin="0" aria-valuemax="100">25%</div>
                                    </div>
                                </div>
                                <div class="mb-3">
                                    <label>Opsi 2</label>
                                    <div class="progress">
                                        <div class="progress-bar" role="progressbar" style="width: 25%;"
                                            aria-valuenow="25" aria-valuemin="0" aria-valuemax="100">25%</div>
                                    </div>
                                </div>
                            </div>

                            <div class="mb-1">
                                <div id="detail_vote_hitung" class="card-text">Suara Masuk 5 dari 10 (50%)</div>
                            </div>

                            <div id="detail_tgl_vote" class="menu-tgl-vote mb-1">
                                Tanggal Batas Voting : 18/10/2021
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<?php /**PATH C:\xampp\htdocs\desacuss\resources\views/admin/diskusi/modal.blade.php ENDPATH**/ ?>