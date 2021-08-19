<div class="container-fluid container-kastem pb-0">
    <h4>Manage Musrenbang</h4>
</div>
<div id="div_tabel_musrenbang" class="container-fluid container-kastem pt-0">
    <?php if(auth()->check() && auth()->user()->hasAnyRole('super|admin')): ?>
    <button id="btn_tambah_musrenbang" class="btn btn-outline-success btn-sm mb-3">
        <i class="bi bi-plus"></i>
        Tambah Program Musrenbang
    </button>
    <?php endif; ?>

    <div class="card p-2">
        <div class="table-responsive">
            <table id="tabel_musrenbang" class="main inventory wid-100" style="margin-bottom: 0px;">
                <thead>
                    <tr class="main">
                        <th class="main" style="width: 30px;"><span>No</span></th>
                        <th class="main"><span>Nama Program</span></th>
                        <th class="main"><span>Progress Terbaru</span></th>
                        <th class="main"><span>Biaya</span></th>
                        <th class="main"><span>Anggota</span></th>
                        <th class="main" style="width: auto;"><span>Tanggal</span></th>
                        <th class="main"><span>#</span></th>
                    </tr>
                </thead>
                <tbody>

                </tbody>
            </table>
        </div>
    </div>
</div>

<div id="div_tambah_musrenbang" class="container-fluid container-kastem pt-0 sembunyi">
    <div class="card">
        <div class="card-header">
            <div class="card-title">
                <span id="aksi_musrenbang" class="font-18">Tambah Musrenbang</span>
                <button class="btn_close_form btn btn-sm btn-danger font-14 pull-right">Tutup</button>
            </div>
        </div>
        <div class="card-body">
            <form id="form_tambah_musrenbang" class="form_tambah_musrenbang">
                <?php echo csrf_field(); ?>
                <div class="form-section">
                    <p class="font-18 mb-1">Bagian Deskripsi (1 dari 5)</p>
                    <hr class="hr-desa-20 mt-0">
                    <div class="mb-3">
                        <label for="nama_musrenbang" class="form-label">Nama Program Musrenbang</label>
                        <input type="text" class="form-control" name="nama_musrenbang" id="nama_musrenbang"
                            required="required" data-parsley-errors-container="#nama_musrenbang_error"
                            data-parsley-required-message="Nama program musrenbang belum diisi.">
                        <div id="nama_musrenbang_error" class="error-message-custom"></div>
                    </div>
                    <div class="mb-4">
                        <label for="deskmusrenbang" class="form-label">Deskripsi Musrenbang</label>
                        <textarea id="deskmusrenbang" class="form-control" name="deskripsi_musrenbang"
                            required="required" data-parsley-summernote-required=""
                            data-parsley-errors-container="#deskripsi_musrenbang_error"
                            data-parsley-required-message="Deskripsi musrenbang belum diisi."></textarea>
                        <div id="deskripsi_musrenbang_error" class="error-message-custom"></div>
                    </div>
                </div>

                <div class="form-section">
                    <p class="font-18 mb-1">Bagian Progress (2 dari 5)</p>
                    <hr class="hr-desa-40 mt-0">
                    <div class="mb-3">
                        <label for="nama_musrenbang_prog" class="form-label">Nama Progress Musrenbang</label>
                        <input type="text" class="form-control" name="nama_musrenbang_prog" id="nama_musrenbang_prog"
                            placeholder="Cth: Planning Awal" required="required"
                            data-parsley-errors-container="#nama_musrenbang_prog_error"
                            data-parsley-required-message="Nama program musrenbang belum diisi.">
                        <div id="nama_musrenbang_prog_error" class="error-message-custom"></div>
                    </div>
                    <div class="mb-4">
                        <label for="deskmusrenbang_prog" class="form-label">Deskripsi Progress Musrenbang</label>
                        <textarea id="deskmusrenbang_prog" class="form-control" name="deskripsi_musrenbang_prog"
                            placeholder="cth: Menyusun anggota dan biaya musrenbang awal" required="required"
                            data-parsley-errors-container="#deskripsi_musrenbang_prog_error"
                            data-parsley-required-message="Deskripsi progress musrenbang belum diisi."></textarea>
                        <div id="deskripsi_musrenbang_prog_error" class="error-message-custom"></div>
                    </div>

                    <div class="row">
                        <div class="col-md-6 mb-3">
                            <label for="tgl_start_prog" class="form-label">Tanggal Mulai Progress Musrenbang</label>
                            <input type="text" class="form-control" name="tgl_start_prog" id="tgl_start_prog"
                                required="required" data-parsley-errors-container="#tgl_start_prog_error"
                                data-parsley-required-message="Tanggal mulai musrenbang belum diisi.">
                            <div id="tgl_start_prog_error" class="error-message-custom"></div>
                        </div>
                        <div class="col-md-6 mb-3">
                            <label for="tgl_end_prog" class="form-label">Tanggal Berakhir Progress Musrenbang</label>
                            <input type="text" class="form-control" name="tgl_end_prog" id="tgl_end_prog"
                                required="required" data-parsley-errors-container="#tgl_end_prog_error"
                                data-parsley-required-message="Tanggal berakhir musrenbang belum diisi.">
                            <div id="tgl_end_prog_error" class="error-message-custom"></div>
                        </div>
                    </div>

                    <div class="card-footer text-start">
                        <p class="text-muted">Catatan : Progress musrenbang dapat ditambah setelah penginputan.</p>
                    </div>
                </div>

                <div class="form-section">
                    <p class="font-18 mb-1">Bagian Biaya (3 dari 5)</p>
                    <hr class="hr-desa-60 mt-0">
                    <div class="table-responsive mb-3">
                        <table id="tabel_musrenbang_biaya" class="main inventory wid-100 mb-2"
                            style="margin-bottom: 0px;">
                            <thead>
                                <tr class="main">
                                    <th class="main" style="width: 60px;"><span>No.</span></th>
                                    <th class="main"><span>Nama Item</span></th>
                                    <th class="main" style="width: 150px;"><span>Satuan</span></th>
                                    <th class="main"><span>Biaya Satuan</span></th>
                                    <th class="main" style="width: 120px;"><span>Jumlah</span></th>
                                    <th class="main"><span>Total</span></th>
                                    <th class="main" style="width: 75px;"><span>#</span></th>
                                </tr>
                            </thead>
                            <tbody id="tbodi_item_baru">
                                <tr class="main tr_musrenbang" id="tr_musrenbang_1">
                                    <td class="main main_urut text-center" id="main_urut_1">
                                        <span class="no_urut">1</span>
                                    </td>

                                    <td class="main main_nama" id="main_nama_1">
                                        <input type="text" class="inp_item form-control" name="nama_item[]"
                                            id="nama_item_1" placeholder="Cth: Semen" required="required"
                                            data-parsley-errors-container="#nama_item_1_error"
                                            data-parsley-required-message="Nama item belum diisi.">
                                        <div id="nama_item_1_error" class="error_item error-message-custom"></div>
                                    </td>

                                    <td class="main main_satuan" id="main_satuan_1">
                                        <input type="text" placeholder="pcs" class="inp_satuan form-control"
                                            name="satuan_item[]" id="satuan_item_1" required="required"
                                            data-parsley-errors-container="#satuan_item_1_error"
                                            data-parsley-required-message="Satuan item belum diisi.">
                                        <div id="satuan_item_1_error" class="error_satuan error-message-custom">
                                        </div>
                                    </td>

                                    <td class="main main_biaya" id="main_biaya_1">
                                        <input type="text" class="inp_biaya form-control" name="biaya_item[]"
                                            id="biaya_item_1" required="required"
                                            data-parsley-errors-container="#biaya_item_1_error"
                                            data-parsley-required-message="Biaya item belum diisi.">
                                        <div id="biaya_item_1_error" class="error_biaya error-message-custom"></div>
                                    </td>

                                    <td class="main main_jumlah" id="main_jumlah_1">
                                        <input type="number" value="1" min="1" class="inp_jumlah form-control"
                                            name="jumlah_item[]" id="jumlah_item_1" required="required"
                                            data-parsley-errors-container="#jumlah_item_1_error"
                                            data-parsley-required-message="Jumlah item belum diisi.">
                                        <div id="jumlah_item_1_error" class="error_jumlah error-message-custom">
                                        </div>
                                    </td>

                                    <td class="main main_total" id="main_total_1">
                                        <input type="text" class="inp_total form-control" name="total_item[]"
                                            id="total_item_1" required="required"
                                            data-parsley-errors-container="#total_item_1_error"
                                            data-parsley-required-message="Total item belum diisi.">
                                        <div id="total_item_1_error" class="error_total error-message-custom"></div>
                                    </td>

                                    <td class="main main_tombol" id="main_tombol_1">
                                        <button type="button" id="delete_tombol_1" tombol="1"
                                            class="delete_tombol_item btn disabled btn-outline-secondary wid-100">
                                            <i class="bi bi-trash"></i>
                                        </button>
                                    </td>
                                </tr>
                            </tbody>
                            <tfoot>
                                <tr class="main">
                                    <th colspan="5" class="main">Total Keseluruhan</th>
                                    <td colspan="2" id="total_all" class="main text-center font-18"></td>
                                </tr>
                                <tr class="main">
                                    <th colspan="2" class="main">Terbilang</th>
                                    <td colspan="5" id="total_terbilang" class="main text-start font-14"></td>
                                </tr>
                            </tfoot>
                        </table>
                        <button type="button" class="btn_tambah_item btn btn-outline-success btn-sm wid-100"><i
                                class="bi bi-plus-square"></i>
                            Tambah Item</button>
                    </div>

                    <div class="form-check">
                        <input class="form-check-input" type="checkbox" value="0" id="cekboxmusrenbang"
                            name="cekboxmusrenbang">
                        <label class="form-check-label" for="cekboxmusrenbang">
                            Lewati biaya musrenbang (dapat diatur nanti).
                        </label>
                    </div>
                </div>

                <div class="form-section">
                    <p class="font-18 mb-1">Bagian Anggota (4 dari 5)</p>
                    <hr class="hr-desa-80 mt-0">

                    <input hidden type="text" id="total_user_musrenbang" name="total_user_musrenbang"
                        required="required" data-parsley-errors-container="#total_user_musrenbang_error"
                        data-parsley-required-message="Anggota musrenbang belum dipilih.">
                    <div id="total_user_musrenbang_error" class="error-message-big mb-2"></div>

                    <input hidden type="text" name="daftar_anggota[]" value="" id="daftar_anggota">

                    <div id="menu_pilih_anggota" class="row">
                        <div class="dual-list list-right col-md-6 mb-3">
                            <div class="card p-4">
                                <div class="well">
                                    <div class="row">
                                        <div class="col-md-12 form-group">
                                            <p id="anggota_not" class="text-muted mb-1 font-14">Daftar Anggota</p>
                                            <div class="input-group">
                                                <span class="input-group-text " style="top: 0px;">
                                                    <i class="bi bi-search"></i>
                                                </span>
                                                <input type="text" name="SearchDualList" class="form-control"
                                                    placeholder="Cari Anggota">
                                                <span class="input-group-text selector"
                                                    style="cursor: pointer; top: 0px;" title="Select All">
                                                    <i class="bi bi-square"></i>
                                                </span>
                                                <span class="input-group-text move-left"
                                                    style="cursor: pointer; top: 0px;" title="Add Selected">
                                                    <i class="bi bi-plus-square"></i>
                                                </span>
                                            </div>
                                        </div>
                                    </div>

                                    <ul class="list-group max-400" id="dual-list-right"> </ul>
                                </div>
                            </div>
                        </div>


                        <div class="dual-list list-left col-md-6 mb-3">
                            <div class="card p-4">
                                <div class="well text-right">
                                    <div class="row">
                                        <div class="col-md-12 form-group">
                                            <p id="anggota_yes" class="text-muted mb-1 font-14">Daftar Anggota Terpilih
                                            </p>
                                            <div class="input-group">
                                                <span class="input-group-text" style="top: 0px;">
                                                    <i class="bi bi-search"></i>
                                                </span>
                                                <input type="text" name="SearchDualList" class="form-control"
                                                    placeholder="Cari Anggota">
                                                <span class="input-group-text selector"
                                                    style="cursor: pointer; top: 0px;" title="Select All">
                                                    <i class="bi bi-square"></i>
                                                </span>
                                                <span class="input-group-text move-right"
                                                    style="cursor: pointer; top: 0px;" title="Remove Selected">
                                                    <i class="bi bi-dash-square"></i>
                                                </span>
                                            </div>
                                        </div>
                                    </div>

                                    <ul class="list-group list-unstyled list-icons" id="dual-list-left"> </ul>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="form-check">
                        <input class="form-check-input" type="checkbox" value="0" id="cekboxmusrenbanganggota"
                            name="cekboxmusrenbanganggota">
                        <label class="form-check-label" for="cekboxmusrenbanganggota">
                            Lewati anggota musrenbang (dapat diatur nanti).
                        </label>
                    </div>
                </div>

                <div class="form-section">
                    <p class="font-18 mb-1">Bagian Tanggal (5 dari 5)</p>
                    <hr class="hr-desa-100 mt-0">
                    <div class="row">
                        <div class="col-md-6 mb-3">
                            <label for="tgl_start" class="form-label">Tanggal Mulai Musrenbang</label>
                            <input type="text" class="form-control" name="tgl_start" id="tgl_start" required="required"
                                data-parsley-errors-container="#tgl_start_error"
                                data-parsley-required-message="Tanggal mulai musrenbang belum diisi.">
                            <div id="tgl_start_error" class="error-message-custom"></div>
                        </div>
                        <div class="col-md-6 mb-3">
                            <label for="tgl_end" class="form-label">Tanggal Berakhir Musrenbang</label>
                            <input type="text" class="form-control" name="tgl_end" id="tgl_end" required="required"
                                data-parsley-errors-container="#tgl_end_error"
                                data-parsley-required-message="Tanggal berakhir musrenbang belum diisi.">
                            <div id="tgl_end_error" class="error-message-custom"></div>
                        </div>
                    </div>
                </div>

                <div class="form-navigation-2">
                    <hr>
                    <button type="button" class="kembali btn btn-sm btn-outline-success pull-left">Kembali</button>
                    <button type="button"
                        class="btn-confirm-email lanjut btn btn-sm btn-outline-success pull-right">Lanjut</button>
                    <button type="button" id="btn_add_musrenbang"
                        class="btn btn-success btn-sm pull-right">Tambah</button>
                    <span class="clearfix"></span>
                </div>
            </form>
        </div>
    </div>
</div>
<?php /**PATH C:\xampp\htdocs\desacuss\resources\views/admin/musrenbang/konten.blade.php ENDPATH**/ ?>