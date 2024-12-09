<!-- app/Views/voucher/create.php -->

<div id="layoutSidenav_content">
    <main>
        <div class="container-fluid px-4">
            <h1 class="mt-4">Tambah Voucher</h1>

            <div class="card mb-4">
                <div class="card-header">
                    <i class="fas fa-ticket-alt me-1"></i>
                    Form Tambah Voucher
                </div>
                <div class="card-body">
                    <form action="<?= base_url('voucher/store') ?>" method="post">
                        <?= csrf_field() ?>
                        <div class="mb-3">
                            <label for="kode_voucher" class="form-label">Kode Voucher</label>
                            <input type="text"
                                class="form-control <?= isset($errors['kode_voucher']) ? 'is-invalid' : '' ?>"
                                id="kode_voucher" name="kode_voucher" value="<?= old('kode_voucher') ?>" required>
                            <small class="form-text text-muted">
                                Contoh: DISKON10, PROMO50, VCR25RB
                            </small>
                            <?php if (isset($errors['kode_voucher'])): ?>
                                <div class="invalid-feedback">
                                    <?= $errors['kode_voucher'] ?>
                                </div>
                            <?php endif; ?>
                        </div>
                        <div class="mb-3">
                            <label for="diskon" class="form-label">Diskon</label>
                            <input type="number"
                                class="form-control <?= isset($errors['diskon']) ? 'is-invalid' : '' ?>" id="diskon"
                                name="diskon" value="<?= old('diskon') ?>" required min="1">
                            <small class="form-text text-muted">
                                Masukkan nilai diskon dalam Rupiah (contoh: 10000)
                            </small>
                            <?php if (isset($errors['diskon'])): ?>
                                <div class="invalid-feedback">
                                    <?= $errors['diskon'] ?>
                                </div>
                            <?php endif; ?>
                        </div>
                        <button type="submit" class="btn btn-primary">
                            <i class="fas fa-save me-1"></i> Simpan
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

<script>
    document.getElementById('diskon').addEventListener('input', function (e) {
        var value = e.target.value.replace(/\D/g, '');
        e.target.value = value.replace(/\B(?=(\d{3})+(?!\d))/g, ".");
    });
</script>