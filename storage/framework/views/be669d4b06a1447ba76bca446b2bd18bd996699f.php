<div class="modal fade" id="contoh" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1"
    aria-labelledby="staticBackdropLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="staticBackdropLabel">Edit Musrenbang</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                ...
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                <button type="button" class="btn btn-success">Simpan</button>
            </div>
        </div>
    </div>
</div>


<div class="modal fade" id="modalShowUserMusrenbang" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1"
    aria-labelledby="staticBackdropLabel" aria-hidden="true">
    <div id="modal_dialog_custom_anggota" class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-header mb-2">
                <h5 class="modal-title modal_title_anggota font-18" id="staticBackdropLabel">Anggota Musrenbang</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">

                <div class="row">
                    <div id="menu_not_exist_anggota" class="col-md mb-3 sembunyi">
                        <div class="card mb-3 p-2">
                            <div class="card p-2 mb-1">
                                <div class="btn-toolbar" role="toolbar" aria-label="Toolbar with button groups">
                                    <div class="input-group wid-100">
                                        <div class="input-group-text" id="btnGroupAddon"><i class="bi bi-search"></i>
                                        </div>
                                        <input type="text" id="find_anggota_not_exist" class="form-control"
                                            placeholder="Cari anggota" aria-label="Cari anggota"
                                            aria-describedby="btnGroupAddon">
                                    </div>
                                </div>
                            </div>
                            <span id="text_total_anggota_not" class="text-light badge bg-warning mt-1 mb-2"></span>
                            <div class="form-check">
                                <input class="menu_cekbox_anggota_not form-check-input" type="checkbox" value=""
                                    id="menu_cekbox_anggota_not">
                                <label class="form-check-label" for="flexCheckDefault">
                                    Tambah Lebih Banyak
                                </label>
                            </div>
                            <div id="div_list_anggota_not" class="max-400 card p-2 mb-3"> </div>
                            <?php if(auth()->check() && auth()->user()->hasRole('admin|super')): ?>
                            <button id="btnTambahMultiAnggota" musrenbang="0"
                                class="btnTambahMultiAnggota btn btn-outline-success btn-sm wid-100 sembunyi">Tambah
                                Anggota</button>
                            <?php endif; ?>
                        </div>
                        <?php if(auth()->check() && auth()->user()->hasRole('admin|super')): ?>
                        <button id="btnHideMenuTambahAnggota" class="btn btn-outline-danger btn-sm wid-100">Tutup Menu
                            Tambah Anggota</button>
                        <?php endif; ?>
                    </div>

                    <div id="menu_exist_anggota" class="col-md mb-3">
                        <div class="card mb-3 p-2">
                            <div class="card p-2 mb-1">
                                <div class="btn-toolbar" role="toolbar" aria-label="Toolbar with button groups">
                                    <div id="menuSearchEksis" class="input-group <?php if(auth()->check() && auth()->user()->hasRole('anggota')): ?> wid-100 <?php endif; ?>">
                                        <div class="input-group-text" id="btnGroupAddon"><i class="bi bi-search"></i>
                                        </div>
                                        <input type="text" id="find_anggota_exist" class="form-control"
                                            placeholder="Cari anggota" aria-label="Cari anggota"
                                            aria-describedby="btnGroupAddon">
                                    </div>
                                    <?php if(auth()->check() && auth()->user()->hasRole('admin|super')): ?>
                                    <div id="btnShowMenuTambahAnggota" class="btn-group ms-auto" role="group"
                                        aria-label="First group">
                                        <button class="btn btn-outline-success btn-sm">Tambah Anggota</button>
                                    </div>
                                    <?php endif; ?>
                                </div>
                            </div>
                            <?php if(auth()->check() && auth()->user()->hasRole('admin|super')): ?>
                            <span id="text_total_anggota" class="badge bg-success putih mt-1 mb-2"></span>
                            <div class="form-check">
                                <input class="menu_cekbox_anggota form-check-input" type="checkbox" value=""
                                    id="menu_cekbox_anggota">
                                <label class="form-check-label" for="menu_cekbox_anggota">
                                    Hapus Lebih Banyak
                                </label>
                            </div>
                            <?php endif; ?>
                            <div id="div_list_anggota" class="max-400 card p-2 mb-3"></div>
                            <?php if(auth()->check() && auth()->user()->hasRole('admin|super')): ?>
                            <button id="btnDeleteMultiAnggota" musrenbang="0"
                                class="btnDeleteMultiAnggota btn btn-outline-danger btn-sm wid-100 sembunyi">Hapus
                                Anggota</button>
                            <?php endif; ?>

                        </div>
                    </div>

                </div>
            </div>
        </div>
    </div>
</div>



<div class="modal fade" id="modalShowBiayaMusrenbang" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1"
    aria-labelledby="staticBackdropLabelBiaya" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered modal-xl">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="staticBackdropLabelBiaya">Biaya Musrenbang</h5>
                <button type="button" class="btnActionBiayaClose btn-close"></button>
            </div>
            <div class="modal-body">
                <form class="formBiayaEdt" id="formBiayaEdt">
                    <?php echo csrf_field(); ?>
                    <div class="table-responsive mb-3">
                        <div class="card p-4">
                            <table id="tabel_musrenbang_biaya_edt" class="main inventory wid-100 mb-2"
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
                                <tbody id="tbodi_item_biaya_edt" data-biaya="0">

                                </tbody>
                                <tfoot>
                                    <tr class="main">
                                        <th colspan="5" class="main">Total Keseluruhan</th>
                                        <td colspan="2" id="total_all_edt" class="main text-center font-18"></td>
                                    </tr>
                                    <tr class="main">
                                        <th colspan="2" class="main">Terbilang</th>
                                        <td colspan="5" id="total_terbilang_edt" class="main text-start font-14"></td>
                                    </tr>
                                </tfoot>
                            </table>

                            <button disabled type="button" id="btn_tambah_item_edt"
                                class="btn btn-outline-success btn-sm wid-100"><i class="bi bi-plus-square"></i>
                                Tambah Item</button>
                        </div>
                    </div>
                </form>

                <div class="form-check">
                    <input class="form-check-input" type="checkbox" value="0" id="cekboxmusrenbangedt"
                        name="cekboxmusrenbangedt">
                    <label class="form-check-label" for="cekboxmusrenbangedt">
                        Izinkan pengeditan.
                    </label>
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btnActionBiayaClose btn btn-secondary">Close</button>
                <button type="button" id="btnActionBiaya" class="btn btn-success">Simpan</button>
            </div>
        </div>
    </div>
</div>



<div class="modal fade" id="modalShowDeskMusrenbang" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1"
    aria-labelledby="staticBackdropLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="staticBackdropLabel">Edit Musrenbang Deskripsi</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <form class="formEditDeskMusrenbang" id="formEditDeskMusrenbang">
                    <?php echo csrf_field(); ?>
                    <input hidden type="text" id="deskVal" name="id">
                    <div class="mb-3">
                        <label for="nama_musrenbang_edt" class="form-label">Nama Program Musrenbang</label>
                        <input type="text" class="form-control" name="nama_musrenbang" id="nama_musrenbang_edt"
                            required="required" data-parsley-errors-container="#nama_musrenbang_edt_error"
                            data-parsley-required-message="Nama program musrenbang belum diisi.">
                        <div id="nama_musrenbang_edt_error" class="error-message-custom"></div>
                    </div>
                    <div class="mb-4">
                        <label for="deskmusrenbangedt" class="form-label">Deskripsi Musrenbang</label>
                        <textarea id="deskmusrenbangedt" class="form-control" name="deskripsi_musrenbang"
                            required="required" data-parsley-summernote-required=""
                            data-parsley-errors-container="#deskripsi_musrenbang_edt_error"
                            data-parsley-required-message="Deskripsi musrenbang belum diisi."></textarea>
                        <div id="deskripsi_musrenbang_edt_error" class="error-message-custom"></div>
                    </div>

                    <div class="row">
                        <div class="col-md-6 mb-3">
                            <label for="tgl_start_edt" class="form-label">Tanggal Mulai Musrenbang</label>
                            <input type="text" class="form-control" name="tgl_start" id="tgl_start_edt"
                                required="required" data-parsley-errors-container="#tgl_start_edt_error"
                                data-parsley-required-message="Tanggal mulai musrenbang belum diisi.">
                            <div id="tgl_start_edt_error" class="error-message-custom"></div>
                        </div>
                        <div class="col-md-6 mb-3">
                            <label for="tgl_end_edt" class="form-label">Tanggal Berakhir Musrenbang</label>
                            <input type="text" class="form-control" name="tgl_end" id="tgl_end_edt" required="required"
                                data-parsley-errors-container="#tgl_end_edt_error"
                                data-parsley-required-message="Tanggal berakhir musrenbang belum diisi.">
                            <div id="tgl_end_edt_error" class="error-message-custom"></div>
                        </div>
                    </div>
                </form>

            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                <button type="button" id="btnUpdateDesk" class="btn btn-success">Simpan</button>
            </div>
        </div>
    </div>
</div>



<div class="modal fade" id="modalShowProgMusrenbang" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1"
    aria-labelledby="staticBackdropLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title modal_title_musrenbang" id="staticBackdropLabel">Progress Musrenbang</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <div hidden data-progres="0" id="data-progress"></div>
                <div hidden data-progresName="0" id="data-progress-name"></div>
                <div id="div_daftar_prog">
                    <div class="d-flex position-relative">
                        <span id="card_title_progres"></span>
                        <button
                            class="btn_show_tambah_prog btn btn-success btn-sm d-flex position-relative ms-auto">Tambah
                            Progress</button>
                    </div>
                    <hr class="mt-2">

                    <div class="div_card_progress" style="max-height: 450px;overflow-y: auto;">

                    </div>
                </div>

                <div id="div_tambah_prog" class="card mb-3 sembunyi">
                    <form class="tambah_form_prog" id="tambah_form_prog">
                        <?php echo csrf_field(); ?>
                        <input type="text" name="id_prog" id="valProg" hidden>
                        <input type="text" name="id_mus" id="valMusProg" hidden>
                        <input type="text" name="action_prog" id="actionProg" hidden>
                        <div class="modal-header bg-desa">
                            <p id="title_text_progress" class="font-18 mb-1 text-light">Tambah Progress</p>
                            <button type="button"
                                class="btn_close_tambah_prog btn btn-sm btn-outline-light">Tutup</button>
                        </div>
                        <div class="card-body">
                            <div class="mb-3">
                                <label for="nama_musrenbang_prog_new" class="form-label">Nama Progress
                                    Musrenbang</label>
                                <input type="text" class="form-control" name="nama_musrenbang_prog"
                                    id="nama_musrenbang_prog_new" required="required"
                                    data-parsley-errors-container="#nama_musrenbang_prog_new_error"
                                    data-parsley-required-message="Nama program musrenbang belum diisi.">
                                <div id="nama_musrenbang_prog_new_error" class="error-message-custom"></div>
                            </div>
                            <div class="mb-4">
                                <label for="deskmusrenbang_prog_new" class="form-label">Deskripsi Progress
                                    Musrenbang</label>
                                <textarea id="deskmusrenbang_prog_new" class="form-control"
                                    name="deskripsi_musrenbang_prog"
                                    placeholder="cth: Menyusun anggota dan biaya musrenbang awal" required="required"
                                    data-parsley-errors-container="#deskripsi_musrenbang_prog_new_error"
                                    data-parsley-required-message="Deskripsi progress musrenbang belum diisi."></textarea>
                                <div id="deskripsi_musrenbang_prog_new_error" class="error-message-custom"></div>
                            </div>

                            <div class="row">
                                <div class="col-md-6 mb-3">
                                    <label for="tgl_start_prog_new" class="form-label">Tanggal Mulai Progress
                                        Musrenbang</label>
                                    <input type="text" class="form-control" name="tgl_start_prog"
                                        id="tgl_start_prog_new" required="required"
                                        data-parsley-errors-container="#tgl_start_prog_new_error"
                                        data-parsley-required-message="Tanggal mulai musrenbang belum diisi.">
                                    <div id="tgl_start_prog_new_error" class="error-message-custom"></div>
                                </div>
                                <div class="col-md-6 mb-3">
                                    <label for="tgl_end_prog_new" class="form-label">Tanggal Berakhir Progress
                                        Musrenbang</label>
                                    <input type="text" class="form-control" name="tgl_end_prog" id="tgl_end_prog_new"
                                        required="required" data-parsley-errors-container="#tgl_end_prog_new_error"
                                        data-parsley-required-message="Tanggal berakhir musrenbang belum diisi.">
                                    <div id="tgl_end_prog_new_error" class="error-message-custom"></div>
                                </div>
                            </div>
                        </div>
                        <div class="card-footer text-end">
                            <button type="button" id="btnActionProg" aksi="Tambah"
                                class="btn btn-outline-success btn-sm">Tambah</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>



<div class="modal fade" id="modalPublish" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1"
    aria-labelledby="staticBackdropLabel" aria-hidden="true">
    <div id="modal_cek_publish" class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
            <div id="overlay" class="p-4">
                <div class="cv-spinner">
                    <span class="spinner"></span>
                </div>
                <div class="text-center pt-4">
                    <p>Sedang melakukan pengecekan data musrenbang, mohon tunggu ...</p>
                </div>
            </div>

            <div class="menu_status_infra text-center p-4 sembunyi">

            </div>

            <div id="modal_publish_header" class="modal-header sembunyi">
                <h5 class="modal-title" id="staticBackdropLabel">Publish Musrenbang ke Aplikasi Infrastruktur DesaTour
                </h5>
            </div>
            <div id="modal_publish_body" class="modal-body sembunyi">
                <div class="menu_form_publish sembunyi">
                    <form id="formPublish" class="formPublish">
                        <input hidden type="text" name="id_desa" value="<?php echo e(auth()->user()->id_desa); ?>">

                        <div class="row">
                            <div class="col-md-6 mb-3">
                                <label for="nama_infrastruktur" class="form-label">Judul</label>
                                <input type="text" class="form-control" name="judul" id="nama_infrastruktur"
                                    required="required" data-parsley-errors-container="#nama_infrastruktur_error"
                                    data-parsley-required-message="Judul belum diisi.">
                                <div id="nama_infrastruktur_error" class="error-message-custom"></div>
                            </div>
                            <div class="col-md-6 mb-3">
                                <label for="listKategoriInfra" class="form-label">Kategori</label>
                                <select style="width: 100%;" class="form-control selectpicker" data-live-search="true"
                                    id="listKategoriInfra" name="kategori"
                                    data-parsley-errors-container="#list_kategori_infra_error"
                                    data-parsley-required-message="Kategori belum dipilih.">
                                </select>
                                <div id="list_kategori_infra_error" class="error-message-custom"></div>
                            </div>
                        </div>

                        <div class="mb-3">
                            <label for="desk_infrastruktur" class="form-label">Deskripsi Musrenbang</label>
                            <textarea id="desk_infrastruktur" class="form-control" name="deskripsi" required="required"
                                data-parsley-summernote-required=""
                                data-parsley-errors-container="#desk_infrastruktur_edt_error"
                                data-parsley-required-message="Deskripsi belum diisi."></textarea>
                            <div id="desk_infrastruktur_edt_error" class="error-message-custom"></div>
                        </div>
                        <div class="card">
                            <div class="card-header">Foto (min. 1 Foto, Max. 3 Foto)</div>
                            <div class="card-body">
                                <div class="file-loading">
                                    <input id="input-b6" class="form-control form-control-sm" name="input_b6[]"
                                        type="file" data-allowed-file-extensions='["jpg", "jpeg","png"]' multiple
                                        required="required" data-parsley-errors-container="#foto_musrenbang"
                                        data-parsley-required-message="Foto belum dipilih.">
                                </div>
                                <div id="kartik-file-errors"></div>
                                <div id="foto_musrenbang" class="error-message-custom"></div>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                <button type="button" class="btnPublishInfra btn btn-success sembunyi">Publish</button>
            </div>
        </div>
    </div>
</div>



<div class="modal fade" id="modalCetak" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1"
    aria-labelledby="staticBackdropLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
            <div id="overlay" class="p-4">
                <div class="cv-spinner">
                    <span class="spinner"></span>
                </div>
                <div class="text-center pt-4">
                    <p>Sedang memproses cetak laporan, mohon tunggu ...</p>
                </div>
            </div>
        </div>
    </div>
</div>

<?php /**PATH C:\xampp\htdocs\desacuss_new\resources\views/admin/musrenbang/modal.blade.php ENDPATH**/ ?>