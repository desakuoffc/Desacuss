<?php if(auth()->check() && auth()->user()->hasRole('admin')): ?>
<script>
    var prox_admin = `admin_<?php echo e(auth()->user()->id_desa); ?>`
    var channel_admin = pusher.subscribe(prox_admin);

    channel_admin.bind('App\\Events\\NotifikasiAdmin', function (data) {
        let toas = `
        <div id="notif_${count_toas}" class="toast hide" role="alert" aria-live="assertive" aria-atomic="true">
            <div class="toast-header">
                <img src="${data.foto_url}" class="rounded me-2" style="width: 25px; height: 25px;">
                <strong class="me-auto">${data.name}</strong>
                <small>${data.ago}</small>
            </div>
            <div class="toast-body">
            ${data.message}
            <div class="mt-2 pt-2 border-top">
                <a href="${data.url}" type="button" class="btn btn-outline-primary btn-sm">Lihat</a>
                <button type="button" class="btn btn-outline-danger btn-sm" data-bs-dismiss="toast">Close</button>
            </div>
            </div>
        </div>
        `;

        $('.toast-container').append(toas);

        new bootstrap.Toast(document.querySelector(`#notif_${count_toas}`)).show();
        count_toas++;

        // getSwalMini('Notifikasi Baru.', 'success', 5000, 'top-end')

        let existingNotifications = notifications.html();
        let newNotificationHtml = `
        <li class="notification active cursor li_unread li-${data.random}" style="border-radius:10px;">
            <a href="${data.url}" class="remove-underline" style="color: black">
                <div class="d-flex align-items-center">
                    <div class="flex-shrink-0">
                    <img src="${data.foto_url}" class="img-circle" alt="30x30" style="width: 30px; height: 30px;">
                    </div>
                    <div class="flex-grow-1 ms-3">
                        <p class="mb-0 font-12">
                        ${data.name}
                        </p>
                        <p class="text-muted mt-0 mb-0 font-12">
                        ${data.message}
                        </p>
                        <p class="text-muted mt-0 mb-0 font-10">
                        ${data.jam}
                        </p>
                    </div>
                </div>
            </a>
        </li>
        `;

        let newCanvas = `
        <li class="cursor mb-3 bg-whtie li_all li-${data.random}" style="border-radius:10px;">
            <div class="card">
                <a href="${data.url}" class="remove-underline" style="color: black">
                    <div class="card-body">
                        <div class="d-flex align-items-center">
                            <div class="flex-shrink-0">
                                <img src="${data.foto_url}"
                                    class="rounded-circle" alt="30x30" style="width: 30px; height: 30px;">
                            </div>
                            <div class="flex-grow-1 ms-3">
                                <p class="mb-0 font-12">
                                ${data.name}
                                </p>
                                <p class="text-muted mt-0 mb-0 font-12">
                                ${data.message}
                                </p>
                                <p class="text-muted mt-0 mb-0 font-10">
                                ${data.jam}
                                </p>
                            </div>
                        </div>
                    </div>
                </a>
                <div class="card-footer bg-white">
                    <div class="btn-group wid-100" role="group" aria-label="Basic example">
                        <button data-random="${data.random}" type="button" class="hapusCanvas font-12 btn btn-outline-danger btn-sm">Hapus</button>
                    </div>
                </div>
            </div>
        </li>
        `;

        $(newCanvas).prependTo("#canvas_notifikasi");
        notifications.html(newNotificationHtml + existingNotifications);

        notificationsCount += 1;

        let real = (notificationsCount > 5) ? "5+" : notificationsCount;
        $('#data_default').attr('data-count', notificationsCount);
        $('#total_notifikasi').text(notificationsCount)
        $('#total_notif_all').text(notificationsCount)
        $('#canvas_notif_total').text(notificationsCount)
        $('.dropdown-notifications').show();
    });

</script>
<?php endif; ?>

<?php if(auth()->check() && auth()->user()->hasRole('super')): ?>
<script>
    var channel_super = pusher.subscribe('super');

    channel_super.bind('App\\Events\\NotifikasiAdmin', function (data) {
        let toas = `
        <div id="notif_${count_toas}" class="toast hide" role="alert" aria-live="assertive" aria-atomic="true">
            <div class="toast-header">
                <img src="${data.foto_url}" class="rounded me-2" style="width: 25px; height: 25px;">
                <strong class="me-auto">${data.name}</strong>
                <small>${data.ago}</small>
            </div>
            <div class="toast-body">
            ${data.message}
            <div class="mt-2 pt-2 border-top">
                <a href="${data.url}" type="button" class="btn btn-outline-primary btn-sm">Lihat</a>
                <button type="button" class="btn btn-outline-danger btn-sm" data-bs-dismiss="toast">Close</button>
            </div>
            </div>
        </div>
        `;

        $('.toast-container').append(toas);

        new bootstrap.Toast(document.querySelector(`#notif_${count_toas}`)).show();
        count_toas++;

        // getSwalMini('Notifikasi Baru.', 'success', 5000, 'top-end')

        let existingNotifications = notifications.html();
        let newNotificationHtml = `
        <li class="notification active cursor li_unread li-${data.random}" style="border-radius:10px;">
            <a href="${data.url}" class="remove-underline" style="color: black">
                <div class="d-flex align-items-center">
                    <div class="flex-shrink-0">
                    <img src="${data.foto_url}" class="img-circle" alt="30x30" style="width: 30px; height: 30px;">
                    </div>
                    <div class="flex-grow-1 ms-3">
                        <p class="mb-0 font-12">
                        ${data.name}
                        </p>
                        <p class="text-muted mt-0 mb-0 font-12">
                        ${data.message}
                        </p>
                        <p class="text-muted mt-0 mb-0 font-10">
                        ${data.jam}
                        </p>
                    </div>
                </div>
            </a>
        </li>
        `;

        let newCanvas = `
        <li class="cursor mb-3 bg-whtie li_all li-${data.random}" style="border-radius:10px;">
            <div class="card">
                <a href="${data.url}" class="remove-underline" style="color: black">
                    <div class="card-body">
                        <div class="d-flex align-items-center">
                            <div class="flex-shrink-0">
                                <img src="${data.foto_url}"
                                    class="rounded-circle" alt="30x30" style="width: 30px; height: 30px;">
                            </div>
                            <div class="flex-grow-1 ms-3">
                                <p class="mb-0 font-12">
                                ${data.name}
                                </p>
                                <p class="text-muted mt-0 mb-0 font-12">
                                ${data.message}
                                </p>
                                <p class="text-muted mt-0 mb-0 font-10">
                                ${data.jam}
                                </p>
                            </div>
                        </div>
                    </div>
                </a>
                <div class="card-footer bg-white">
                    <div class="btn-group wid-100" role="group" aria-label="Basic example">
                        <button data-random="${data.random}" type="button" class="hapusCanvas font-12 btn btn-outline-danger btn-sm">Hapus</button>
                    </div>
                </div>
            </div>
        </li>
        `;

        $(newCanvas).prependTo("#canvas_notifikasi");
        notifications.html(newNotificationHtml + existingNotifications);

        notificationsCount += 1;

        let real = (notificationsCount > 5) ? "5+" : notificationsCount;
        $('#data_default').attr('data-count', notificationsCount);
        $('#total_notifikasi').text(notificationsCount)
        $('#total_notif_all').text(notificationsCount)
        $('#canvas_notif_total').text(notificationsCount)
        $('.dropdown-notifications').show();
    });

</script>
<?php endif; ?>
<?php /**PATH C:\xampp\htdocs\desacuss\resources\views/user/js/pusher.blade.php ENDPATH**/ ?>