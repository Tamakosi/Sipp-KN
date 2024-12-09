<!-- app/Views/voucher/edit.php -->

<div id="layoutSidenav_content">
    <main>
        <div class="container-fluid px-4">
            <h1 class="mt-4">Edit Voucher</h1>

            <div class="card mb-4">
                <div class="card-header">
                    <i class="fas fa-ticket-alt me-1"></i>
                    Form Edit Voucher
                </div>
                <div class="card-body">
                    <form action="<?= base_url('voucher/update/' . $voucher['kode_voucher']) ?>" method="POST">
                        <?= csrf_field() ?>
                        <div class="mb-3">
                            <label for="kode_voucher" class="form-label">Kode Voucher</label>
                            <input type="text" class="form-control" id="kode_voucher" name="kode_voucher" value="<?= $voucher['kode_voucher'] ?>" readonly>
                        </div>
                        <div class="mb-3">
                            <label for="diskon" class="form-label">Diskon</label>
                            <input type="number" class="form-control" id="diskon" name="diskon" value="<?= $voucher['diskon'] ?>" required min="1">
                        </div>
                        <button type="submit" class="btn btn-primary">
                            <i class="fas fa-save me-1"></i> Simpan Perubahan
                        </button>
                        <a href="<?= base_url('voucher') ?>" class="btn btn-secondary">
                            <i class="fas fa-arrow-left me-1"></i> Kembali
                        </a>
                    </form>
                </div>
            </div>
        </div>
    </main>
</div>