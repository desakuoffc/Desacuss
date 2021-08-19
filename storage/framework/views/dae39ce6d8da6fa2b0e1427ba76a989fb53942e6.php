<div class="container-fluid container-kastem">
    <h4 id="hi-name">Menu Profile, <?php echo e(auth()->user()->name); ?></h4>
    <div id="div_tabel_diskusi">
        <div class="card mb-4">
            <div class="card-header">Manage Profile</div>
            <div class="card-body">

                <div class="row">
                    <div class="col-md-2 text-center">
                        <img id="foto-profile"
                            src="<?php echo e(asset('/img/user/'.auth()->user()->village->id.'/'.auth()->user()->foto)); ?>"
                            onerror="this.onerror=null;this.src='<?php echo e(asset('/img/user/apatar.png')); ?>';"
                            class="foto-profile border border-4" alt="">
                        <br>
                        <button id="btnGantiFoto" class="btn btn-outline-primary btn-sm mt-2">Ganti Foto</button>
                    </div>

                    <div class="col-md">

                        <div class="row">
                            <div class="col-md-6">
                                <div class="mb-3">
                                    <form class="formEditName" id="formEditName">
                                        <?php echo csrf_field(); ?>
                                        <label for="name" class="form-label">Nama</label>
                                        <div class="input-group mb-2">
                                            <input readonly type="text" class="form-control" id="name" name="nama"
                                                data-old="<?php echo e(auth()->user()->name); ?>" value="<?php echo e(auth()->user()->name); ?>"
                                                required="required" data-parsley-errors-container="#nama_error"
                                                data-parsley-required-message="Nama belum diisi.">
                                            <button id="btnEditName" data-value="tutup" class="btn btn-outline-primary"
                                                type="button">Edit</button>
                                            <button id="btnUpdateName" class="btn btn-outline-success sembunyi"
                                                type="button">Update</button>
                                        </div>
                                        <div id="nama_error" class="error-message-custom"></div>
                                    </form>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="mb-3">
                                    <label for="role" class="form-label">Hak Akses</label>
                                    <input readonly type="text" class="form-control" id="role" name="role"
                                        value="<?php echo e(clean(auth()->user()->getRoleNames())); ?>">
                                </div>
                            </div>
                        </div>


                        <div class="row">
                            <div class="col-md-6">
                                <div class="mb-3">
                                    <label for="namaUser" class="form-label">Email</label>
                                    <div class="input-group mb-2">
                                        <input readonly type="email" class="form-control" id="email" name="email"
                                            value="<?php echo e(auth()->user()->email); ?>">
                                        <button id="btnEditEmail" data-aksi="email" class="data-aksi btn btn-primary"
                                            type="button">Edit</button>
                                    </div>
                                </div>
                            </div>
                            <div class="col md-6">
                                <div class="mb-3">
                                    <label for="namaUser" class="form-label">Password</label>
                                    <div class="input-group mb-2">
                                        <input readonly type="password" class="form-control" id="password"
                                            name="password" value="*******">
                                        <button id="btnEditPw" data-aksi="password" class="data-aksi btn btn-primary"
                                            type="button">Edit</button>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div class="card mb-4">
            <div class="card-header">
                Manage Forum Diskusi
            </div>
            <div class="card-body">
                <div class="table-responsive">
                    <table id="tabel_diskusi" class="main inventory wid-100" style="margin-bottom: 0px;">
                        <thead>
                            <tr class="main">
                                <th class="main" style="width: 30px;"><span>No.</span></th>
                                <th class="main" style="width: 150px"><span>Judul</span></th>
                                <th class="main" style="width: 85px;"><span>Kategori</span></th>
                                <th class="main" style="width: 85px;"><span>Jenis</span></th>
                                <th class="main" style="width: 300px;"><span>deskripsi</span></th>
                                <th class="main" style="width: 100px;"><span>Status</span></th>
                                <th class="main" style="width: auto;"><span>#</span></th>
                            </tr>
                        </thead>
                        <tbody>

                        </tbody>
                    </table>
                </div>
            </div>
        </div>

        
    </div>
</div>

<?php echo $__env->make('tambahan.diskusi.tambah', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
<?php /**PATH C:\xampp\htdocs\desacuss\resources\views/admin/profile/konten.blade.php ENDPATH**/ ?>