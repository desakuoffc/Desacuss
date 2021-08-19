<!-- MODAL -->
<!-- Modal Edit Profile -->
<div class="modal fade" id="modalShowEditFoto" tabindex="-1" data-bs-backdrop="static" data-bs-keyboard="false">
    <div class="modal-dialog modal-dialog-centered modal-dialog-scrollable modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="pull-left">Edit Foto</h5>
                <button type="button" class="btn-close-edit-foto btn-close pull-right" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <form id="formEditFoto" class="formEditFoto">
                    <?php echo csrf_field(); ?>
                    <p class="text-muted">Max. Foto hanya satu</p>
                    <div class="file-loading">
                        <input id="input-b6" class="form-control form-control-sm" name="input-b6[]" type="file"
                            data-allowed-file-extensions='["jpg", "jpeg","png"]' multiple required="required"
                            data-parsley-errors-container="#foto_user_error"
                            data-parsley-required-message="Foto belum diisi.">
                    </div>
                    <div id="kartik-file-errors"></div>
                    <div id="foto_user_error" class="error-message-custom"></div>
                </form>
            </div>
            <div class="card-footer bg-white">
                <button class="btn-confirm-edit-foto btn btn-outline-success btn-sm pull-right me-2">Update
                    Foto</button>
                <button class="btn-close-edit-foto btn btn-outline-danger btn-sm pull-right me-2">Close</button>
            </div>
        </div>
    </div>
</div>


<!-- Modal Edit Profile -->
<div class="modal fade" id="modalShowEditProfile" tabindex="-1" data-bs-backdrop="static" data-bs-keyboard="false">
    <div class="modal-dialog modal-dialog-centered modal-dialog-scrollable modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <h5 id="cardHeaderProfileEdit" class="pull-left">Edit Email</h5>
                <button type="button" class="btn-close-edit btn-close pull-right" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <div class="menu-cek">
                    <div id="" class="modal-verifikasi-akun modal-title text-center">Verifikasi Akun.</div>
                    <form id="formCekAkun" class="formCekAkun">
                        <?php echo csrf_field(); ?>
                        <div class="mb-3">
                            <label for="emailUser" class="form-label">Email</label>
                            <input type="email" class="form-control" id="emailUser" name="email" required="required"
                                data-parsley-errors-container="#email_user_error"
                                data-parsley-required-message="Email belum diisi." data-parsley-type="email"
                                data-parsley-type-message="Gunakan format email, cth nama@gmail.com">
                            <div id="email_user_error" class="error-message-custom"></div>
                        </div>
                        <div class="mb-3">
                            <label for="password" class="form-label">Password</label>
                            <div class="input-group">
                                <input type="password" class="form-control" id="passwords" name="password"
                                    required="required" data-parsley-errors-container="#pass_user_error"
                                    data-parsley-required-message="Password belum diisi.">
                                <span class="input-group-text">
                                    <i id="passwordShow" class="fa fa-eye-slash cursor" aria-hidden="true"></i>
                                </span>
                            </div>
                            <div id="pass_user_error" class="error-message-custom"></div>
                        </div>
                    </form>
                </div>

                <div class="edit-email sembunyi2">
                    <div class="modal-title text-center">Silahkan masukan email baru anda.</div>
                    <form id="formEditEmail" class="formEditEmail">
                        <?php echo csrf_field(); ?>
                        <div class="mb-3">
                            <label for="emailUserBaru" class="form-label">Email Baru</label>
                            <input type="email" class="form-control" id="emailUserBaru" name="email"
                                data-parsley-errors-container="#email_baru_error"
                                data-parsley-required-message="Email belum diisi." data-parsley-type="email"
                                data-parsley-type-message="Gunakan format email, cth nama@gmail.com">
                            <div id="uname_response_email" class="error-message-custom"></div>
                            <div id="email_baru_error" class="error-message-custom"></div>
                        </div>
                    </form>
                </div>

                <div class="edit-password sembunyi2">
                    <div class="modal-title text-center">Silahkan masukan password baru anda.</div>
                    <form id="formEditPassword" class="formEditPassword">
                        <?php echo csrf_field(); ?>
                        <div class="mb-3">
                            <label for="password-baru" class="form-label">Password Baru</label>
                            <div class="input-group">
                                <input type="password" class="form-control" id="password-baru" name="password"
                                    data-parsley-errors-container="#pass_baru_error"
                                    data-parsley-required-message="Password belum diisi."
                                    data-parsley-equalto="#password-konfirmasi-baru"
                                    data-parsley-equalto-message="Password tidak sama" data-parsley-minlength="6"
                                    data-parsley-minlength-message="Password miminal 6 (enam) karakter">
                                <span class="input-group-text">
                                    <i id="passwordBaruShow" class="fa fa-eye-slash cursor" aria-hidden="true"></i>
                                </span>
                            </div>
                            <div id="pass_baru_error" class="error-message-custom"></div>
                        </div>

                        <div class="mb-3">
                            <label for="password-konfirmasi-baru" class="form-label">Konfirmasi Password Baru</label>
                            <div class="input-group">
                                <input type="password" class="form-control" id="password-konfirmasi-baru"
                                    name="password-konfirmasi" data-parsley-errors-container="#pass_konf_baru_error"
                                    data-parsley-required-message="Konfirmasi password belum diisi."
                                    data-parsley-equalto="#password-baru"
                                    data-parsley-equalto-message="Password tidak sama">
                                <span class="input-group-text"><i id="passwordKonfirmasiBaruShow"
                                        class="fa fa-eye-slash cursor" aria-hidden="true"></i></span>
                            </div>
                            <div id="pass_konf_baru_error" class="error-message-custom"></div>
                        </div>

                    </form>
                </div>

            </div>
            <div class="card-footer bg-white">
                <button
                    class="btn-confirm-edit-verifikasi btn btn-outline-success btn-sm pull-right me-2">Verifikasi</button>
                <button class="btn-confirm-edit-email btn btn-outline-success btn-sm pull-right me-2 sembunyi">Update
                    Email</button>
                <button class="btn-confirm-edit-password btn btn-outline-success btn-sm pull-right me-2 sembunyi">Update
                    Password</button>
                <button class="btn-close-edit btn btn-outline-danger btn-sm pull-right me-2">Close</button>
            </div>
        </div>
    </div>
</div>

<!-- END MODAL  -->



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
                        <img id="detail_img_user" src="" class="img-fluid rounded">
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

<?php /**PATH C:\xampp\htdocs\desacuss\resources\views/admin/profile/modal.blade.php ENDPATH**/ ?>