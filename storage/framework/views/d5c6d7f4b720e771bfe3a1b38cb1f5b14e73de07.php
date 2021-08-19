<div class="container-fluid container-kastem">
    <h4>Manage User</h4>

    <button id="btn_tambah_user" class="btn btn-outline-success btn-sm mb-3"><i class="bi bi-plus-square"></i> Tambah
        User</button>

    <div class="btn-group" role="group" aria-label="Basic example">
        <button id="btn_import_user" class="btn btn-outline-success btn-sm mb-3"><i
                class="bi bi-file-earmark-spreadsheet"></i> Import Anggota Via Excel</button>
        <button class="btn_template_user btn btn-outline-success btn-sm mb-3"><i
                class="bi bi-file-earmark-arrow-down"></i> Unduh Template Excel</button>
        <?php if(auth()->check() && auth()->user()->hasRole('super')): ?>
        <button class="btn_cari_kode_desa btn btn-outline-primary btn-sm mb-3"><i class="bi bi-search"></i> Cari Kode
            Desa</button>
        <?php endif; ?>
    </div>

    

    <div class="card p-2 mb-5">
        <div class="table-responsive">
            <table id="tabel_user" class="inventory main wid-100">
                <thead>
                    <tr class="main">
                        <th class="main"><span>No.</span></th>
                        <th class="main"><span>Nama</span></th>
                        <th class="main"><span>Desa</span></th>
                        <th class="main""><span>Hak Akses</span></th>
                        <th class=" main"><span>Foto</span></th>
                        <th class="main"><span>Status</span></th>
                        <th class="main"><span>#</span></th>
                    </tr>
                </thead>
                <tbody>
                </tbody>
            </table>
        </div>
    </div>

    <h5>User Pending</h5>
    <div class="card p-2 mb-5">
        <div class="table-responsive">
            <table id="tabel_user_pending" class="inventory main wid-100">
                <thead>
                    <tr class="main">
                        <th class="main"><span>No.</span></th>
                        <th class="main"><span>Nama</span></th>
                        <th class="main"><span>Desa</span></th>
                        <th class="main"><span>Foto</span></th>
                        <th class="main"><span>Status</span></th>
                        <th class="main"><span>#</span></th>
                    </tr>
                </thead>
                <tbody>
                </tbody>
            </table>
        </div>
    </div>

    <h5 class="sembunyi">User Log</h5>
    <div class="card p-2 mb-5 sembunyi">
        <div class="table-responsive">
            <table id="tabel_user_log" class="inventory main wid-100">
                <thead>
                    <tr class="main">
                        <th class="main"><span>No.</span></th>
                        <th class="main"><span>From</span></th>
                        <th class="main"><span>Aksi</span></th>
                        <th class="main"><span>Email</span></th>
                        <th class="main"><span>Oleh</span></th>
                        <th class="main"><span>Desa</span></th>
                        <th class="main"><span>Deskripsi</span></th>
                        <th class="main"><span>Jam</span></th>
                        <th class="main"><span>#</span></th>
                    </tr>
                </thead>
                <tbody>
                </tbody>
            </table>
        </div>
    </div>


</div>
<?php /**PATH C:\xampp\htdocs\desacuss\resources\views/admin/user/konten.blade.php ENDPATH**/ ?>