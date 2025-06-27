<?php if (session()->get('success') || session()->get('error')): ?>
    <div aria-live="polite" aria-atomic="true" style="position: fixed; top: 1rem; right: 1rem; z-index: 9999;">
        <div class="toast show text-white <?= session()->get('success') ? 'bg-success' : 'bg-danger' ?>" id="liveToast" role="alert" data-delay="3000" style="min-width: 250px;">
            <div class="toast-header <?= session()->get('success') ? 'bg-success text-white' : 'bg-danger text-white' ?>">
                <strong class="mr-auto"><?= session()->get('success') ? 'Sukses' : 'Gagal' ?></strong>
                <small>Sekarang</small>
                <button type="button" class="ml-2 mb-1 close text-white" data-dismiss="toast" aria-label="Close" onclick="document.getElementById('liveToast').remove();">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="toast-body">
                <?= session()->get('success') ?? session()->get('error') ?>
            </div>
        </div>
    </div>
    <?php session()->remove(['success', 'error']); ?>
<?php endif; ?>
