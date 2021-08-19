<?php $__env->startSection('konten'); ?>
<div class="form-signin-kontener text-center pt-em-3">
    <main class="form-signin bg-white radiuz" style="max-width: 700px">
        <form class="form-daftar" id="form-daftar">
            <?php echo csrf_field(); ?>
            <h1 class="h4 mb-2 fw-normal">Daftar</h1>
            <span class="hr-desa mb-3 wid-75">
                <em class="hr-desa wid-50"></em>
            </span>

            <div class="form-bagian">
                <p class="text-muted mb-0">Bagian 1 dari 4</p>
                <small class="text-muted">Data Akun</small>
                <div class="card p-4 mt-1 radiuz">
                    <div class="row">
                        <div class="col-md-6 mb-3">
                            <label class="form-label pull-left" for="name">Nama Lengkap</label>
                            <input type="text" class="form-control" id="name" name="name" required="required"
                                data-parsley-errors-container="#nama_error"
                                data-parsley-required-message="Nama lengkap belum diisi.">
                            <div id="nama_error" class="error-message-custom pull-left"></div>
                        </div>
                        <div class="col-md-6 mb-3">
                            <label class="form-label pull-left" for="email">Email</label>
                            <input type="email" class="form-control" name="email" id="email" required="required"
                                data-parsley-errors-container="#email_error"
                                data-parsley-required-message="Email belum diisi.">
                            <div id="uname_response_email"></div>
                            <div id="email_error" class="error-message-custom pull-left"></div>
                        </div>
                        <div class="col-md-6 mb-3">
                            <label class="form-label pull-left" for="password">Password</label>
                            <div class="input-group">
                                <input type="password" class="form-control mb-0" id="password" name="password"
                                    required="required" data-parsley-errors-container="#password_error"
                                    data-parsley-required-message="Password belum diisi."
                                    data-parsley-equalto="#password-confirm"
                                    data-parsley-equalto-message="Password tidak sama" data-parsley-minlength="6"
                                    data-parsley-minlength-message="Password miminal 6 (enam) karakter">
                                <span class="input-group-text"><i id="passwordBaruShow" class="fa fa-eye-slash cursor"
                                        aria-hidden="true"></i></span>
                            </div>
                            <div id="password_error" class="error-message-custom pull-left"></div>
                        </div>
                        <div class="col-md-6 mb-3">
                            <label class="form-label pull-left" for="password-confirm">Konfirmasi Password</label>
                            <div class="input-group">
                                <input id="password-confirm" type="password" class="form-control mb-0"
                                    name="password_confirmation" required="required"
                                    data-parsley-errors-container="#password_konfirmasi_error"
                                    data-parsley-required-message="Konfirmasi password belum diisi."
                                    data-parsley-equalto="#password" data-parsley-equalto-message="Password tidak sama"
                                    autocomplete="new-password">
                                <span class="input-group-text"><i id="passwordKonfirmasiBaruShow"
                                        class="fa fa-eye-slash cursor" aria-hidden="true"></i></span>
                            </div>
                            <div id="password_konfirmasi_error" class="error-message-custom pull-left"></div>
                        </div>
                    </div>
                </div>
            </div>

            <div class="form-bagian">
                <p class="text-muted mb-0">Bagian 2 dari 4</p>
                <small class="text-muted">Data Wilayah</small>
                <div class="card p-4 mt-1 radiuz">
                    <div class="row">
                        <div class="col-md-6 mb-4">
                            <label for="listProvinsi" class="form-label pull-left">Provinsi</label>
                            <select style="width: 100%;" class="select-kategori form-control selectpicker"
                                data-live-search="true" id="listProvinsi" name="provinsi"
                                data-parsley-errors-container="#list_prov_error"
                                data-parsley-required-message="Provinsi belum dipilih.">
                                <option disabled value="" selected>JAWA BARAT</option>
                            </select>
                            <div id="list_prov_error" class="error-message-custom pull-left"></div>
                        </div>
                        <div class="col-md-6 mb-4">
                            <label for="listKota" class="form-label pull-left">Kota/Kab</label>
                            <select style="width: 100%;" class="select-kategori form-control selectpicker"
                                data-live-search="true" id="listKota" name="kota" required="required"
                                data-parsley-errors-container="#list_kota_error"
                                data-parsley-required-message="Kota/Kab belum dipilih.">
                            </select>
                            <div id="list_kota_error" class="error-message-custom pull-left"></div>
                        </div>
                        <div class="col-md-6 mb-4">
                            <label for="listKec" class="form-label pull-left">Kecamatan</label>
                            <select style="width: 100%;" class="select-kategori form-control selectpicker"
                                data-live-search="true" id="listKec" name="kecamatan" required="required"
                                data-parsley-errors-container="#list_kec_error"
                                data-parsley-required-message="Provinsi belum dipilih.">

                            </select>
                            <div id="list_kec_error" class="error-message-custom pull-left"></div>
                        </div>
                        <div class="col-md-6 mb-4">
                            <label for="listDesa" class="form-label pull-left">Desa</label>
                            <select style="width: 100%;" class="select-kategori form-control selectpicker"
                                data-live-search="true" id="listDesa" name="desa" required="required"
                                data-parsley-errors-container="#list_desa_error"
                                data-parsley-required-message="Kota/Kab belum dipilih.">
                            </select>
                            <div id="list_desa_error" class="error-message-custom pull-left"></div>
                        </div>
                    </div>
                </div>
            </div>

            <div class="form-bagian">
                <p class="text-muted mb-0">Bagian 3 dari 4</p>
                <small class="text-muted">Data KTP</small>
                <div class="card p-4 mt-1 radiuz">
                    <div class="row">
                        <div class="col-md-12 mb-3">
                            <label class="form-label pull-left" for="no_ktp">No. KTP</label>
                            <input type="number" class="form-control" id="no_ktp" name="no_ktp" required="required"
                                data-parsley-errors-container="#ktp_error"
                                data-parsley-required-message="No.KTP belum diisi." data-parsley-minlength="16"
                                data-parsley-minlength-message="No.KTP miminal 16 (enam belas) angka">
                            <div id="uname_response_ktp"></div>
                            <div id="ktp_error" class="error-message-custom pull-left"></div>
                        </div>

                        <div class="col-md-12 mb-3">
                            <div class="card" style="max-height: 120px;overflow-y: auto;">
                                <div class="card-header pull-left">Foto KTP (Hanya 1 (satu) foto) </div>
                                <div class="card-body">
                                    <div class="file-loading">
                                        <input id="input-b6" class="form-control form-control-sm" name="input_b6[]"
                                            type="file" data-allowed-file-extensions='["jpg", "jpeg","png"]' multiple
                                            required="required" data-parsley-errors-container="#foto_user_error"
                                            data-parsley-required-message="Foto KTP belum dipilih.">
                                    </div>
                                </div>
                            </div>
                            <div id="kartik-file-errors"></div>
                            <div id="foto_user_error" class="error-message-custom pull-left"></div>
                        </div>
                    </div>
                </div>
            </div>

            <div class="form-bagian">
                <p class="text-muted mb-0">Bagian 4 dari 4</p>
                <small class="text-muted">Data Foto Profile</small>
                <div class="card p-4 mt-1 radiuz">
                    <div class="row">
                        <div class="col-md-12 mb-3">
                            <div class="card mb-1">
                                <div class="card-header pull-left">Foto Profile (Hanya 1 (satu) foto) </div>
                                <div class="card-body" style="max-height: 120px;overflow-y: auto;">
                                    <div class="file-loading">
                                        <input id="input-b66" class="form-control form-control-sm" name="input_b66[]"
                                            type="file" data-allowed-file-extensions='["jpg", "jpeg","png"]' multiple
                                            required="required" data-parsley-errors-container="#foto_profile_error"
                                            data-parsley-required-message="Foto Profile belum dipilih.">
                                    </div>
                                </div>
                                <div class="card-footer">
                                    <div id="kartik-file-errors2"></div>
                                    <div id="foto_profile_error" class="error-message-custom pull-left"></div>
                                </div>
                            </div>

                            <div class="form-check mb-3">
                                <input class="form-check-input" type="checkbox" value="" name="foto_profile_box"
                                    id="foto_profile_box">
                                <label class="form-check-label pull-left" for="foto_profile">
                                    Upload foto profile nanti.
                                </label>
                            </div>

                        </div>
                    </div>
                </div>
            </div>

            <div class="form-navigation pt-2">
                <button type="button" class="previous btn btn-outline-success pull-left">Kembali</button>
                <button type="button" class="btn-confirm-email next btn btn-outline-success pull-right">Lanjut</button>
                <button type="button" id="submit_daftar" class="btn btn-success pull-right">Daftar</button>
                <span class="clearfix"></span>
            </div>
        </form>
    </main>
</div>


<div class="modal fade" id="modalLoading" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1"
    aria-labelledby="staticBackdropLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
            <div id="overlay" class="p-4">
                <div class="cv-spinner">
                    <span class="spinner"></span>
                </div>
                <div class="text-center pt-4">
                    <p>Sedang memproses data pendaftaran, mohon tunggu ...</p>
                </div>
            </div>
        </div>
    </div>
</div>

<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.master', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\xampp\htdocs\desacuss\resources\views/auth/register.blade.php ENDPATH**/ ?>