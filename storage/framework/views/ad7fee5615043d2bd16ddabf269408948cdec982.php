<!-- MODAL -->

<!-- Modal Add User -->
<div class="modal fade" id="modalShowAddUser" tabindex="-1" data-bs-backdrop="static" data-bs-keyboard="false">
    <div class="modal-dialog modal-dialog-centered modal-dialog-scrollable modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <h5 id="cardHeaderUserAdd" class="pull-left">Tambah User</h5>
                <button type="button" class="btn-close-add-user btn-close pull-right" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <form id="formAddUser" class="formAddUser">
                    <?php echo csrf_field(); ?>
                    <div class="card p-2 mb-3">
                        <div class="row">
                            <div class="col-md-6">
                                <div class="mb-3">
                                    <label for="namaUser" class="form-label">Nama</label>
                                    <input type="hidden" id="values" name="values" value="">
                                    <input type="text" class="form-control" id="namaUser" name="nama"
                                        required="required" data-parsley-errors-container="#nama_user_error"
                                        data-parsley-required-message="Nama user belum diisi.">
                                    <div id="nama_user_error" class="error-message-custom"></div>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="mb-3">
                                    <label for="emailUser" class="form-label">Email</label>
                                    <input type="email" class="form-control" id="emailUser" name="email"
                                        required="required" data-parsley-errors-container="#email_user_error"
                                        data-parsley-required-message="Email user belum diisi."
                                        data-parsley-type="email"
                                        data-parsley-type-message="Gunakan format email, cth nama@gmail.com">
                                    <div id="email_user_error" class="error-message-custom"></div>
                                    <div id="uname_response_email" class="error-message-custom"></div>
                                </div>
                            </div>
                        </div>

                        <div id="rowPassword" class="row">
                            <div class="col-md-6">
                                <div class="mb-3">
                                    <label for="password" class="form-label">Password</label>
                                    <div class="input-group">
                                        <input type="password" class="form-control" id="password" name="password"
                                            required="required" data-parsley-errors-container="#pass_user_error"
                                            data-parsley-required-message="Password belum diisi."
                                            data-parsley-equalto="#password-konfirmasi"
                                            data-parsley-equalto-message="Password tidak sama"
                                            data-parsley-minlength="6"
                                            data-parsley-minlength-message="Password miminal 6 (enam) karakter">
                                        <span class="input-group-text">
                                            <i id="passwordShow" class="fa fa-eye-slash cursor" aria-hidden="true"></i>
                                        </span>
                                    </div>
                                    <div id="pass_user_error" class="error-message-custom"></div>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="mb-3">
                                    <label for="password-konfirmasi" class="form-label">Konfirmasi Password</label>
                                    <div class="input-group">
                                        <input type="password" class="form-control" id="password-konfirmasi"
                                            name="password-konfirmasi" required="required"
                                            data-parsley-errors-container="#pass_konf_user_error"
                                            data-parsley-required-message="Konfirmasi password belum diisi."
                                            data-parsley-equalto="#password"
                                            data-parsley-equalto-message="Password tidak sama">
                                        <span class="input-group-text"><i id="passwordKonfirmasiShow"
                                                class="fa fa-eye-slash cursor" aria-hidden="true"></i></span>
                                    </div>
                                    <div id="pass_konf_user_error" class="error-message-custom"></div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <?php if(auth()->check() && auth()->user()->hasRole('super')): ?>

                    <div id="wilayahBox" class="form-check mt-1 mb-1 sembunyi">
                        <input class="form-check-input" type="checkbox" value="0" name="cekboxWil" id="cekboxWil">
                        <label class="form-check-label" for="flexCheckDefault">
                            Edit Wilayah
                        </label>
                    </div>
                    <div class="wilayah mb-3">
                        <div class="card p-2">
                            <div class="row">
                                <div class="col-md-6">
                                    <label for="listProvinsi" class="form-label">Provinsi</label>
                                    <select style="width: 100%;" class="select-kategori form-control selectpicker"
                                        data-live-search="true" id="listProvinsi" name="provinsi" <?php if(auth()->check() && auth()->user()->hasRole('super')): ?>
                                        required="required" <?php endif; ?> data-parsley-errors-container="#list_prov_error"
                                        data-parsley-required-message="Provinsi belum dipilih.">
                                        <option disabled value="" selected="selected" data-sub="">--Pilih provinsi--
                                        </option>
                                        <?php $__currentLoopData = $provinsi; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $p): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                        <option value="<?php echo e($p->id); ?>" data-sub=""><?php echo e($p->name); ?></option>
                                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                    </select>
                                    <div id="list_prov_error" class="error-message-custom"></div>
                                </div>
                                <div class="col-md-6">
                                    <label for="listKota" class="form-label">Kota/Kab</label>
                                    <select style="width: 100%;" class="select-kategori form-control selectpicker"
                                        data-live-search="true" id="listKota" name="kota" <?php if(auth()->check() && auth()->user()->hasRole('super')): ?>
                                        required="required" <?php endif; ?> data-parsley-errors-container="#list_kota_error"
                                        data-parsley-required-message="Kota/Kab belum dipilih.">
                                    </select>
                                    <div id="list_kota_error" class="error-message-custom"></div>
                                </div>
                            </div>

                            <div class="row mt-3">
                                <div class="col-md-6">
                                    <label for="listKec" class="form-label">Kecamatan</label>
                                    <select style="width: 100%;" class="select-kategori form-control selectpicker"
                                        data-live-search="true" id="listKec" name="kecamatan" <?php if(auth()->check() && auth()->user()->hasRole('super')): ?>
                                        required="required" <?php endif; ?> data-parsley-errors-container="#list_kec_error"
                                        data-parsley-required-message="Provinsi belum dipilih.">

                                    </select>
                                    <div id="list_kec_error" class="error-message-custom"></div>
                                </div>
                                <div class="col-md-6">
                                    <label for="listDesa" class="form-label">Desa</label>
                                    <select style="width: 100%;" class="select-kategori form-control selectpicker"
                                        data-live-search="true" id="listDesa" name="desa" <?php if(auth()->check() && auth()->user()->hasRole('super')): ?>
                                        required="required" <?php endif; ?> data-parsley-errors-container="#list_desa_error"
                                        data-parsley-required-message="Kota/Kab belum dipilih.">
                                    </select>
                                    <div id="list_desa_error" class="error-message-custom"></div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <?php endif; ?>

                    <div class="mb-3">
                        <label for="listRole" class="form-label">Hak Akses</label>
                        <select style="width: 100%;" class="select-kategori form-control selectpicker" id="listRole"
                            name="role" required="required" data-parsley-errors-container="#list_role_error"
                            data-parsley-required-message="Hak akses belum dipilih.">
                            <option disabled value="" selected="selected">--Pilih hak akses--</option>
                            <?php if(auth()->check() && auth()->user()->hasRole('super')): ?>
                            <option value="super">Super Admin
                            </option>
                            <?php endif; ?>
                            <option value="admin">Admin</option>
                            <option value="anggota">Anggota</option>
                        </select>
                        <div id="list_role_error" class="error-message-custom"></div>
                    </div>

                    <div id="cardFotoUser" class="card">
                        <div class="card-header">Foto user (Hanya 1 (satu) gambar) </div>
                        <div class="card-body">
                            <div class="file-loading">
                                <input id="input-b6" class="form-control form-control-sm" name="input-b6[]" type="file"
                                    data-allowed-file-extensions='["jpg", "jpeg","png"]' multiple required="required"
                                    data-parsley-errors-container="#foto_user_error"
                                    data-parsley-required-message="Foto user belum diisi.">
                            </div>
                            <div id="kartik-file-errors"></div>
                            <div id="foto_user_error" class="error-message-custom"></div>
                        </div>
                    </div>
                    <div id="cardFotoUserBox" class="form-check mt-1">
                        <input class="form-check-input" type="checkbox" value="0" name="cekboxFoto" id="cekboxFoto">
                        <label class="form-check-label" for="flexCheckDefault">
                            Lewati foto user
                        </label>
                    </div>

                </form>
            </div>
            <div class="card-footer bg-white">
                <button id="btnConfirmAddUser"
                    class="btn-confirm-add-user btn btn-outline-success btn-sm pull-right me-2">Tambah</button>
                <button class="btn-close-add-user btn btn-outline-danger btn-sm pull-right me-2">Close</button>
            </div>
        </div>
    </div>
</div>
<!-- End Modal Add User -->




<div class="modal fade" id="openModalDetailUser" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1"
    aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered modal-xl">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Detail User Pending</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <img id="detail_img_ktp" data-ukuran="kecil" src="" class="rounded mx-auto d-block"
                    style="width: 500px;height: 250px;">
                <div id="data_lengkap">
                    <hr>
                    <div class="row">
                        <div class="col-md-3">
                            <img id="detail_img_user" src="" class="img-fluid rounded">
                        </div>
                        <div class="col-md-9">
                            <div class="row">
                                <div class="col-md-12 mb-3">
                                    <label for="wilayah" class="form-label">Wilayah</label>
                                    <input readonly type="text" class="form-control" id="wilayah">
                                </div>
                                <div class="col-md-6 mb-3">
                                    <label for="no_ktp" class="form-label">No.KTP</label>
                                    <input readonly type="text" class="form-control" id="no_ktp">
                                </div>
                                <div class="col-md-6 mb-3">
                                    <label for="nama_lengkap" class="form-label">Nama Lengkap</label>
                                    <input readonly type="text" class="form-control" id="nama_lengkap">
                                </div>
                                <div class="col-md-6 mb-3">
                                    <label for="email_user" class="form-label">Email</label>
                                    <input readonly type="text" class="form-control" id="email_user">
                                </div>
                                <div class="col-md-6 mb-3">
                                    <label for="detail_status" class="form-label">Status</label>
                                    <div id="detail_status" class="text-start"></div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>





<div class="modal fade" id="openModalImportUser" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1"
    aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Import User dari Excel</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <div class="card-text">Catatan:</div>
                <div class="alert alert-primary p-1" role="alert">
                    <ul class="font-14 mb-0">
                        <li>Mohon gunakan template excel yang telah disediakan. Unduh template <a
                                class="btn_template_user cursor teks-tebal">disini</a></li>
                        <li>Kolom yang wajib diisi adalah <b>Nama</b>, <?php if(auth()->check() && auth()->user()->hasRole('super')): ?> <b>Kode Desa</b>, <?php endif; ?>
                            <b>Email</b>, dan <b>Password</b></li>
                        <li>User yang diimport via excel akan berstatus <b class="merah">anggota</b></li>
                        <li>User yang diimport via excel dapat mengakses langsung aplikasi <b class="merah">tanpa
                                validasi KTP</b></li>
                    </ul>
                </div>
                <form class="formImportExcel" id="formImportExcel">
                    <?php echo csrf_field(); ?>
                    <div class="card">
                        <div class="card-header">File excel user (Hanya 1 (satu) file) </div>
                        <div class="card-body">
                            <div class="file-loading">
                                <input id="input-excel" class="form-control form-control-sm" name="input_excel"
                                    type="file" data-allowed-file-extensions='["xls","xlsx"]' multiple
                                    required="required" data-parsley-errors-container="#file_excel_user_error"
                                    data-parsley-required-message="File excel user belum dipilih.">
                            </div>
                            <div id="kartik-excel-errors"></div>
                            <div id="file_excel_user_error" class="error-message-custom"></div>
                        </div>
                    </div>
                </form>
            </div>
            <div class="modal-footer">
                <button id="btnConfirmImportUser"
                    class="btn-confirm-import-user btn btn-outline-success btn-sm pull-right me-2"><i
                        class="bi bi-file-earmark-spreadsheet"></i> Import</button>
                <button data-bs-dismiss="modal" class="btn btn-outline-danger btn-sm pull-right me-2">Close</button>
            </div>
        </div>
    </div>
</div>



<div class="modal fade" id="openModalCariKodeDesa" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1"
    aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Cari Kode Desa</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <div class="card p-2">
                    <form class="formCariDesa" id="formCariDesa">
                        <div class="mb-3">
                            <label for="listProvinsiCari" class="form-label">Provinsi</label>
                            <input readonly type="text" class="form-control" id="listProvinsiCari" value="JAWA BARAT">
                        </div>

                        <div class="mb-3">
                            <label for="listKotaCari" class="form-label">Kota/Kab</label>
                            <select style="width: 100%;" class="select-kategori form-control selectpicker"
                                data-live-search="true" id="listKotaCari" name="kota" required="required"
                                data-parsley-errors-container="#list_kota_cari_error"
                                data-parsley-required-message="Mohon pilih Kota/Kab terlebih dahulu.">
                            </select>
                            <div id="list_kota_cari_error" class="error-message-custom"></div>
                        </div>

                        <div class="mb-3">
                            <label for="listKecCari" class="form-label">Kecamatan</label>
                            <select style="width: 100%;" class="select-kategori form-control selectpicker"
                                data-live-search="true" id="listKecCari" name="kecamatan" required="required"
                                data-parsley-errors-container="#list_kec_cari_error"
                                data-parsley-required-message="Mohon pilih Kecamatan terlebih dahulu.">
                            </select>
                            <div id="list_kec_cari_error" class="error-message-custom"></div>
                        </div>

                        <div class="mb-3">
                            <label for="listDesaCari" class="form-label">Desa</label>
                            <select style="width: 100%;" class="select-kategori form-control selectpicker"
                                data-live-search="true" id="listDesaCari" name="desa" required="required"
                                data-parsley-errors-container="#list_desa_cari_error"
                                data-parsley-required-message="Mohon pilih Desa terlebih dahulu.">
                            </select>
                            <div id="list_desa_cari_error" class="error-message-custom"></div>
                        </div>

                        <label class="form-label">Kode Desa</label>
                        <div class="input-group mb-3">
                            <input readonly type="text" class="form-control" id="kodeDesa">
                            <button id="btnSalinKodeDesa" class="btn btn-outline-success" type="button"
                                id="button-addon2">
                                <i class="bi bi-clipboard me-1"></i>
                                Salin Kode Desa
                            </button>
                        </div>
                    </form>
                </div>
            </div>
            <div class="modal-footer">
                <button data-bs-dismiss="modal" class="btn btn-outline-danger btn-sm pull-right me-2">Close</button>
            </div>
        </div>
    </div>
</div>





<div class="modal fade" id="modalEmail" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1"
    aria-labelledby="staticBackdropLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
            <div id="overlay" class="p-4">
                <div class="cv-spinner">
                    <span class="spinner"></span>
                </div>
                <div class="text-center pt-4">
                    <p>Sedang mengirim email, mohon tunggu ...</p>
                </div>
            </div>
        </div>
    </div>
</div>


<!-- END MODAL  -->
<?php /**PATH C:\xampp\htdocs\desacuss\resources\views/admin/user/modal.blade.php ENDPATH**/ ?>