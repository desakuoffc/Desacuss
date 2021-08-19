<div id="div_tambah_diskusi" class="container-fluid container-kastem pt-0 sembunyi">
    <div class="card">
        <div id="card_header_add_diskusi" class="card-header">
            <div class="card-title">
                <span id="aksi_diskusi" class="font-18">Tambah Diskusi</span>
                <button class="btn_close_form btn btn-danger font-18 pull-right">Tutup</button>
            </div>
        </div>
        <div class="card-body">
            <form id="form_tambah_diskusi" class="form_tambah_diskusi">
                <?php echo csrf_field(); ?>
                <input type="text" id="value_diskusi" name="value_diskusi" hidden>
                <div class="row">
                    <div class="col-md-6 mb-3">
                        <div class="mb-3">
                            <label for="nama_diskusi" class="form-label">Judul Diskusi</label>
                            <input type="text" class="form-control" name="nama_diskusi" id="nama_diskusi"
                                data-parsley-errors-container="#nama_diskusi_error"
                                data-parsley-required-message="Judul diskusi belum diisi.">
                            <div id="nama_diskusi_error" class="error-message-custom"></div>
                        </div>
                    </div>
                    <div class="col-md-6 mb-3">
                        <label for="listKategori" class="form-label">Kategori</label>
                        <select style="width: 100%;" class="form-control selectpicker" data-live-search="true"
                            id="listKategori" name="listKategori" data-parsley-errors-container="#list_kategori_error"
                            data-parsley-required-message="Kategori belum dipilih.">
                        </select>
                        <div id="list_kategori_error" class="error-message-custom"></div>
                    </div>
                </div>

                <div class="mb-4">
                    <label for="deskDiskusi" class="form-label">Deskripsi Diskusi</label>
                    <textarea id="deskDiskusi" class="form-control" name="deskDiskusi"
                        data-parsley-summernote-required="" data-parsley-errors-container="#deskripsi_diskusi_error"
                        data-parsley-required-message="Deskripsi diskusi belum diisi."></textarea>
                    <div id="deskripsi_diskusi_error" class="error-message-custom"></div>
                </div>

                <div class="mb-3">
                    <label for="cekboxvoting" class="form-label">Status Voting</label>
                    <div class="form-check mt-0">
                        <input class="form-check-input" type="checkbox" value="0" name="cekboxvoting" id="cekboxvoting">
                        <label class="form-check-label" for="flexCheckDefault">
                            Gunakan Voting
                        </label>
                    </div>
                </div>

                <div id="menu_add_vote" class="mb-3 sembunyi">
                    <input type="text" id="total_voting" name="total_voting" value="" hidden>
                    <div class="card p-4">
                        <small class="font-14">Aturan Voting</small>
                        <ul class="font-14 mb-3">
                            <li>Minimal 2 (dua) opsi voting</li>
                            <li>Maksimal 5 (lima) opsi voting</li>
                        </ul>
                        <div class="menu_opsi mb-1">
                            <div id="menu_vote_1" class="menu_vote mb-3">
                                <div class="input-group">
                                    <span class="span-vote input-group-text">Opsi 1</span>
                                    <input type="text" id="vote_1" name="vote[]" class="inp_vote form-control"
                                        placeholder="Tulis Opsi 1 Disini" data-parsley-errors-container="#vote_1_error"
                                        data-parsley-required-message="Opsi Pilihan 1 belum diisi.">
                                    <button disabled vote="1" class="btn_delete_opsi btn btn-outline-secondary"
                                        type="button">Hapus</button>
                                </div>
                                <div id="vote_1_error" class="error-message-custom"></div>
                            </div>
                            <div id="menu_vote_2" class="menu_vote mb-3">
                                <div class="input-group">
                                    <span class="span-vote input-group-text">Opsi 2</span>
                                    <input type="text" id="vote_2" name="vote[]" class="inp_vote form-control"
                                        placeholder="Tulis Opsi 2 Disini" data-parsley-errors-container="#vote_2_error"
                                        data-parsley-required-message="Opsi Pilihan 2 belum diisi.">
                                    <button vote="2" disabled class="btn_delete_opsi btn btn-outline-secondary"
                                        type="button">Hapus</button>
                                </div>
                                <div id="vote_2_error" class="error-message-custom"></div>
                            </div>
                        </div>
                        <button type="button" class="btn_tambah_opsi btn btn-outline-success btn-sm mb-3 wid-100">Tambah
                            Opsi</button>

                        <div class="mb-3">
                            <label for="tgl_vote" class="form-label">Tanggal Batas Voting</label>
                            <input type="text" class="form-control" name="tgl_vote" id="tgl_vote"
                                data-parsley-errors-container="#tgl_vote_error"
                                data-parsley-required-message="Tanggal batas voting belum diisi.">
                            <div id="tgl_vote_error" class="error-message-custom"></div>
                        </div>
                    </div>
                </div>
            </form>
        </div>

        <div class="card-footer bg-white">
            <button type="button" class="btn_update_diskusi btn btn-success pull-right sembunyi">Update Diskusi</button>
            <button type="button" class="btn_add_diskusi btn btn-success pull-right">Tambah Diskusi</button>
            <button type="button" class="btn_close_form btn btn-danger pull-right me-2">Tutup</button>
        </div>
    </div>
</div>

<?php echo $__env->make('tambahan.diskusi.js', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
<?php /**PATH C:\xampp\htdocs\desacuss_new\resources\views/tambahan/diskusi/tambah.blade.php ENDPATH**/ ?>