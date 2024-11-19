<div id="layoutSidenav_content">
    <main>
        <div class="container-fluid px-4">
            <h1 class="mt-4">Tambah Transaksi</h1>
            
            <div class="card mb-4">
                <div class="card-header">Form Tambah Transaksi</div>
                <div class="card-body">
                    <form action="<?= base_url('transaksi/store') ?>" method="POST">
                        <?= csrf_field() ?>

                        <div class="mb-3">
                            <label>ID Karyawan</label>
                            <select class="form-select" name="id_karyawan">
                                <option value="">Pilih Karyawan</option>
                                <?php foreach ($karyawan as $k): ?>
                                    <option value="<?= $k['id_karyawan'] ?>">
                                        <?= esc($k['id_karyawan']) ?>
                                    </option>
                                <?php endforeach; ?>
                            </select>
                        </div>

                        <div class="mb-3">
                            <label>ID Pelanggan</label>
                            <select class="form-select" name="id_pelanggan">
                                <option value="">Pilih Pelanggan</option>
                                <?php foreach ($pelanggan as $p): ?>
                                    <option value="<?= $p['id_pelanggan'] ?>">
                                        <?= esc($p['id_pelanggan']) ?>
                                    </option>
                                <?php endforeach; ?>
                            </select>
                        </div>

                        <div class="mb-3">
                            <label>Kode Voucher</label>
                            <select class="form-select" name="kode_voucher">
                                <option value="">Pilih Voucher (Opsional)</option>
                                <?php foreach ($voucher as $v): ?>
                                    <option value="<?= $v['kode_voucher'] ?>">
                                        <?= esc($v['kode_voucher']) ?>
                                    </option>
                                <?php endforeach; ?>
                            </select>
                            <div class="form-text">Opsional: Pilih voucher jika ada</div>
                        </div>

                        <div>
                            <a href="<?= base_url('transaksi') ?>" class="btn btn-secondary">Batal</a>
                            <button type="submit" class="btn btn-primary">Simpan</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </main>
</div>

<script>
document.addEventListener('DOMContentLoaded', function() {
    // Initialize Select2 for better dropdown experience
    $('#id_karyawan, #id_pelanggan, #kode_voucher').select2({
        theme: 'bootstrap-5',
        width: '100%'
    });

    // Form validation
    const form = document.querySelector('form');
    form.addEventListener('submit', function(event) {
        let isValid = true;
        
        // Validate ID Karyawan
        const idKaryawan = document.getElementById('id_karyawan');
        if (!idKaryawan.value) {
            isValid = false;
            idKaryawan.classList.add('is-invalid');
        } else {
            idKaryawan.classList.remove('is-invalid');
        }
        
        // Validate ID Pelanggan
        const idPelanggan = document.getElementById('id_pelanggan');
        if (!idPelanggan.value) {
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

<!-- Add Select2 CSS and JS -->
<link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css" rel="stylesheet" />
<link href="https://cdn.jsdelivr.net/npm/select2-bootstrap-5-theme@1.3.0/dist/select2-bootstrap-5-theme.min.css" rel="stylesheet" />
<script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script>