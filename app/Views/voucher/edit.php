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
                        <div class="mb-3">
                            <label for="kode_voucher" class="form-label">Kode Voucher</label>
                            <input type="text" class="form-control" id="kode_voucher" name="kode_voucher" 
                                   value="<?= $voucher['kode_voucher'] ?>" readonly>
                            <div class="form-text">Kode voucher tidak dapat diubah</div>
                        </div>

                        <div class="mb-3">
                            <label for="jumlah_poin" class="form-label">Jumlah Poin</label>
                            <div class="input-group">
                                <input type="number" class="form-control" id="jumlah_poin" name="jumlah_poin" 
                                       value="<?= $voucher['jumlah_poin'] ?>" required min="1">
                                <span class="input-group-text">poin</span>
                            </div>
                            <div class="form-text">Minimal 1 poin</div>
                        </div>

                        <div class="mb-3">
                            <button type="submit" class="btn btn-primary">
                                <i class="fas fa-save me-1"></i>Simpan Perubahan
                            </button>
                            <a href="<?= base_url('voucher') ?>" class="btn btn-secondary">
                                <i class="fas fa-arrow-left me-1"></i>Kembali
                            </a>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </main>
</div>

<script>
// Validasi form
document.querySelector('form').addEventListener('submit', function(e) {
    let jumlahPoin = document.getElementById('jumlah_poin').value;

    if (jumlahPoin < 1) {
        e.preventDefault();
        alert('Jumlah poin minimal 1');
    }
});
</script>