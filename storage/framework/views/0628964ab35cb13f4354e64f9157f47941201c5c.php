<div class="container-fluid container-kastem pb-0">
    <h4>Manage Diskusi</h4>
</div>
<div id="div_tabel_diskusi" class="container-fluid container-kastem pt-0">
    <button id="btn_manage_kategori" class="btn btn-outline-success btn-sm mb-3"><i class="bi bi-gear"></i> Manage
        Kategori</button>
    <button id="btn_tambah_diskusi" class="btn btn-outline-success btn-sm mb-3"><i class="bi bi-plus"></i> Tambah
        Diskusi</button>
    <div class="card p-2">
        <div class="table-responsive">
            <table id="tabel_diskusi" class="main inventory wid-100" style="margin-bottom: 0px;">
                <thead>
                    <tr class="main">
                        <th class="main" style="width: 30px;"><span>No.</span></th>
                        <th class="main" style="width: 150px"><span>Judul</span></th>
                        <th class="main" style="width: 85px;"><span>Kategori</span></th>
                        <th class="main" style="width: 85px;"><span>Jenis</span></th>
                        <th class="main" style="width: 150px;"><span>Pembuat</span></th>
                        <th class="main" style="width: 100px;"><span>deskripsi</span></th>
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

<?php echo $__env->make('tambahan.diskusi.tambah', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
<?php /**PATH C:\xampp\htdocs\desacuss_new\resources\views/admin/diskusi/konten.blade.php ENDPATH**/ ?>