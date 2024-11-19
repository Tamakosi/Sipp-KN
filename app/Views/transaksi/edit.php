<div id="layoutSidenav_content">
    <main>
        <div class="container-fluid px-4">
            <h1 class="mt-4">Edit Transaksi</h1>
            
            <div class="card mb-4">
                <div class="card-header">
                    <i class="fas fa-edit me-1"></i>
                    Form Edit Transaksi
                </div>
                <div class="card-body">
                    <form action="<?= base_url('transaksi/update/' . $transaksi['id_transaksi']) ?>" method="POST">
                        <?= csrf_field() ?>
                        <input type="hidden" name="_method" value="PUT">
                        <input type="hidden" name="id_transaksi" value="<?= $transaksi['id_transaksi'] ?>">

                        <!-- ID Karyawan -->
                        <div class="mb-3">
                            <label for="id_karyawan" class="form-label">ID Karyawan</label>
                            <input type="text" class="form-control <?= session('errors.id_karyawan') ? 'is-invalid' : '' ?>" 
                                   id="id_karyawan" name="id_karyawan" 
                                   value="<?= old('id_karyawan', $transaksi['id_karyawan']) ?>">
                            <?php if (session('errors.id_karyawan')) : ?>
                                <div class="invalid-feedback">
                                    <?= session('errors.id_karyawan') ?>
                                </div>
                            <?php endif; ?>
                        </div>

                        <!-- ID Pelanggan -->
                        <div class="mb-3">
                            <label for="id_pelanggan" class="form-label">ID Pelanggan</label>
                            <input type="text" class="form-control <?= session('errors.id_pelanggan') ? 'is-invalid' : '' ?>" 
                                   id="id_pelanggan" name="id_pelanggan" 
                                   value="<?= old('id_pelanggan', $transaksi['id_pelanggan']) ?>">
                            <?php if (session('errors.id_pelanggan')) : ?>
                                <div class="invalid-feedback">
                                    <?= session('errors.id_pelanggan') ?>
                                </div>
                            <?php endif; ?>
                        </div>

                        <!-- Kode Voucher -->
                        <div class="mb-3">
                            <label for="kode_voucher" class="form-label">Kode Voucher</label>
                            <input type="text" class="form-control <?= session('errors.kode_voucher') ? 'is-invalid' : '' ?>" 
                                   id="kode_voucher" name="kode_voucher" 
                                   value="<?= old('kode_voucher', $transaksi['kode_voucher']) ?>">
                            <?php if (session('errors.kode_voucher')) : ?>
                                <div class="invalid-feedback">
                                    <?= session('errors.kode_voucher') ?>
                                </div>
                            <?php endif; ?>
                            <div class="form-text">Opsional: Kosongkan jika tidak menggunakan voucher</div>
                        </div>

                        <!-- Buttons -->
                        <div class="d-flex justify-content-end">
                            <a href="<?= base_url('transaksi') ?>" class="btn btn-secondary me-2">Batal</a>
                            <button type="submit" class="btn btn-primary">Update</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </main>
</div>

<script>
document.addEventListener('DOMContentLoaded', function() {
    // Form validation
    const form = document.querySelector('form');
    form.addEventListener('submit', function(event) {
        let isValid = true;
        
        // Validate ID Karyawan
        const idKaryawan = document.getElementById('id_karyawan');
        if (!idKaryawan.value.trim()) {
            isValid = false;
            idKaryawan.classList.add('is-invalid');
        } else {
            idKaryawan.classList.remove('is-invalid');
        }
        
        // Validate ID Pelanggan
        const idPelanggan = document.getElementById('id_pelanggan');
        if (!idPelanggan.value.trim()) {
            isValid = false;
            idPelanggan.classList.add('is-invalid');
        } else {
            idPelanggan.classList.remove('is-invalid');
        }
        
        if (!isValid) {
            event.preventDefault();
        }
    });
});
</script>