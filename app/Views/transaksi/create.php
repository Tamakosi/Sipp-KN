<link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css" rel="stylesheet">
<div id="layoutSidenav_content">
    <main>
        <div class="container-fluid px-4">
            <h1 class="mt-4">Tambah Transaksi</h1>

            <?php if(session()->getFlashdata('error')): ?>
                <div class="alert alert-danger">
                    <?= session()->getFlashdata('error') ?>
                </div>
            <?php endif; ?>

            <div class="card mb-4">
                <div class="card-header">
                    <i class="fas fa-shopping-cart me-1"></i>
                    Form Tambah Transaksi
                </div>
                <div class="card-body">
                    <form action="<?= base_url('transaksi/store') ?>" method="post" id="transaksiForm">
                        <!-- Karyawan & Pelanggan Section -->
                        <div class="row">
                            <div class="col-md-6">
                                <div class="mb-3">
                                    <label class="form-label">Karyawan</label>
                                    <select name="id_karyawan" class="form-select" required>
                                        <option value="">Pilih Karyawan</option>
                                        <?php foreach ($karyawan as $k): ?>
                                            <option value="<?= $k['id'] ?>"><?= $k['nama'] ?></option>
                                        <?php endforeach; ?>
                                    </select>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="mb-3">
                                    <label class="form-label">Pelanggan</label>
                                    <select name="id_pelanggan" class="form-select" required>
                                        <option value="">Pilih Pelanggan</option>
                                        <?php foreach ($pelanggan as $p): ?>
                                            <option value="<?= $p['id'] ?>"><?= $p['nama'] ?></option>
                                        <?php endforeach; ?>
                                    </select>
                                </div>
                            </div>
                        </div>

                        <!-- Menu Selection Section -->
                        <div class="row">
                            <div class="col-md-6">
                                <div class="mb-3">
                                    <label class="form-label">Menu</label>
                                    <select id="menuSelect" class="form-select">
                                        <option value="">Pilih Menu</option>
                                        <?php foreach ($menu as $m): ?>
                                            <option value="<?= $m['id'] ?>" data-harga="<?= $m['harga_menu'] ?>">
                                                <?= $m['nama_menu'] ?>
                                            </option>
                                        <?php endforeach; ?>
                                    </select>
                                </div>
                            </div>
                            <div class="col-md-3">
                                <div class="mb-3">
                                    <label class="form-label">Kuantitas</label>
                                    <input type="number" id="quantityInput" class="form-control" min="1" value="1">
                                </div>
                            </div>
                            <div class="col-md-3">
                                <div class="mb-3">
                                    <label class="form-label">&nbsp;</label>
                                    <button type="button" class="btn btn-primary w-100" onclick="tambahMenu()">
                                        <i class="fas fa-plus me-1"></i>Tambah Menu
                                    </button>
                                </div>
                            </div>
                        </div>

                        <!-- Table Section -->
                        <div class="table-responsive mb-3">
                            <table class="table table-bordered table-striped" id="menuTable">
                                <thead>
                                    <tr>
                                        <th>Menu</th>
                                        <th>Harga</th>
                                        <th>Kuantitas</th>
                                        <th>Subtotal</th>
                                        <th width="100">Aksi</th>
                                    </tr>
                                </thead>
                                <tbody></tbody>
                                <tfoot>
                                    <tr>
                                        <th colspan="3" class="text-end">Total</th>
                                        <th colspan="2" id="totalHarga">Rp 0</th>
                                    </tr>
                                </tfoot>
                            </table>
                        </div>

                        <!-- Voucher Code Section -->
                        <div class="row">
                            <div class="col-md-6">
                                <div class="mb-3">
                                    <label class="form-label">Kode Voucher</label>
                                    <input type="text" id="kodeVoucherInput" class="form-control" placeholder="Masukkan Kode Voucher">
                                </div>
                            </div>
                            <div class="col-md-3">
                                <div class="mb-3">
                                    <label class="form-label">&nbsp;</label>
                                    <button type="button" class="btn btn-primary w-100" onclick="applyVoucher()">
                                        <i class="fas fa-check me-1"></i> Terapkan Voucher
                                    </button>
                                </div>
                            </div>
                            <div class="col-md-3">
                                <div class="mb-3">
                                    <label class="form-label">Diskon</label>
                                    <input type="text" id="diskonDisplay" class="form-control" value="Rp 0" readonly>
                                    <input type="hidden" name="diskon" id="diskonInput" value="0">
                                    <input type="hidden" name="kode_voucher" id="kodeVoucherInputHidden" value="">
                                </div>
                            </div>
                        </div>

                        <!-- Payment Section -->
                        <div class="row">
                            <div class="col-md-6">
                                <div class="mb-3">
                                    <label class="form-label">Pembayaran</label>
                                    <input type="number" name="pembayaran" id="pembayaran" class="form-control" required>
                                    <div id="pembayaranError" class="invalid-feedback" style="display: none;"></div>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="mb-3">
                                    <label class="form-label">Kembalian</label>
                                    <input type="text" id="kembalian" class="form-control" readonly>
                                </div>
                            </div>
                        </div>

                        <!-- Hidden inputs -->
                        <input type="hidden" name="total_harga" id="total_harga_input" value="0">
                        <input type="hidden" name="kembalian" id="kembalian_input" value="0">

                        <!-- Submit Buttons -->
                        <div class="mt-4">
                            <button type="submit" class="btn btn-primary">
                                <i class="fas fa-save me-1"></i>Simpan
                            </button>
                            <a href="<?= base_url('transaksi') ?>" class="btn btn-secondary">
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
function tambahMenu() {
    const menuSelect = document.getElementById('menuSelect');
    const quantity = parseInt(document.getElementById('quantityInput').value) || 0;
    
    if (!menuSelect.value) {
        alert('Pilih menu terlebih dahulu!');
        return;
    }

    if (quantity <= 0) {
        alert('Kuantitas harus lebih dari 0!');
        return;
    }

    const selectedOption = menuSelect.options[menuSelect.selectedIndex];
    const menuId = menuSelect.value;
    const menuNama = selectedOption.text;
    const menuHarga = parseInt(selectedOption.getAttribute('data-harga')) || 0;
    const subtotal = menuHarga * quantity;

    // Debugging
    console.log('Menu Harga:', menuHarga);
    console.log('Subtotal:', subtotal);

    const tbody = document.querySelector('#menuTable tbody');
    const tr = document.createElement('tr');
    tr.innerHTML = `
        <td class="px-2 py-2">
            ${menuNama}
            <input type="hidden" name="menu[]" value="${menuId}">
        </td>
        <td class="px-2 py-2">${formatRupiah(menuHarga)}</td>
        <td class="px-2 py-2">
            <input type="number" name="quantity[]" value="${quantity}" class="form-control form-control-sm" readonly>
        </td>
        <td class="px-2 py-2" data-subtotal="${subtotal}">${formatRupiah(subtotal)}</td>
        <td class="px-2 py-2 text-center">
            <button type="button" class="btn btn-danger btn-sm" onclick="hapusMenu(this)">
                <i class="fas fa-trash"></i>
            </button>
        </td>
    `;

    tbody.appendChild(tr);

    // Update total
    totalHarga += subtotal;
    updateTotal();

    // Reset input
    menuSelect.value = '';
    document.getElementById('quantityInput').value = 1;
}

function formatRupiah(angka) {
    return new Intl.NumberFormat('id-ID', {
        style: 'currency',
        currency: 'IDR'
    }).format(angka).replace(/\s/g, '');
}

function applyVoucher() {
    const kodeVoucher = document.getElementById('kodeVoucherInput').value.trim();

    if (!kodeVoucher) {
        alert('Masukkan kode voucher!');
        return;
    }

    // AJAX request to validate voucher
    fetch('<?= base_url('transaksi/validateVoucher') ?>', {
        method: 'POST',
        headers: {
            'Content-Type': 'application/json',
            'X-Requested-With': 'XMLHttpRequest',
            'X-CSRF-TOKEN': '<?= csrf_hash() ?>'
        },
        body: JSON.stringify({ kode_voucher: kodeVoucher })
    })
    .then(response => response.json())
    .then(data => {
        if (data.success) {
            const diskon = parseInt(data.diskon) || 0;
            document.getElementById('diskonDisplay').value = formatRupiah(diskon);
            document.getElementById('diskonInput').value = diskon;
            document.getElementById('kodeVoucherInputHidden').value = kodeVoucher;
            updateTotalWithDiscount();
        } else {
            alert(data.message || 'Kode voucher tidak valid');
            // Reset voucher inputs
            document.getElementById('diskonDisplay').value = 'Rp 0';
            document.getElementById('diskonInput').value = 0;
            document.getElementById('kodeVoucherInputHidden').value = '';
            updateTotalWithDiscount();
        }
    })
    .catch(error => {
        console.error('Error:', error);
        alert('Terjadi kesalahan saat memproses voucher');
    });
}

// Modifikasi fungsi hitungKembalian()
function hitungKembalian() {
    const totalHargaInput = document.getElementById('total_harga_input');
    const pembayaranInput = document.getElementById('pembayaran');
    const kembalianDisplay = document.getElementById('kembalian');
    const kembalianInput = document.getElementById('kembalian_input');
    const pembayaranError = document.getElementById('pembayaranError');

    const totalHarga = parseInt(totalHargaInput.value) || 0;
    const pembayaran = parseInt(pembayaranInput.value) || 0;

    if (pembayaran < totalHarga) {
        // Tampilkan pesan error
        pembayaranError.textContent = 'Pembayaran kurang dari total harga.';
        pembayaranError.style.display = 'block';
        pembayaranInput.classList.add('is-invalid');

        // Reset kembalian
        kembalianDisplay.value = '';
        kembalianInput.value = 0;
        return false;
    } else {
        // Sembunyikan pesan error
        pembayaranError.textContent = '';
        pembayaranError.style.display = 'none';
        pembayaranInput.classList.remove('is-invalid');

        // Hitung kembalian
        const kembalian = pembayaran - totalHarga;
        kembalianDisplay.value = formatRupiah(kembalian);
        kembalianInput.value = kembalian;
        return true;
    }
}

// Tambahkan event listener untuk form submit
document.getElementById('transaksiForm').addEventListener('submit', function(event) {
    if (!hitungKembalian()) {
        event.preventDefault();
        alert('Pembayaran kurang dari total harga. Silakan periksa kembali.');
    }
});

// Tambahkan event listener untuk input pembayaran
document.getElementById('pembayaran').addEventListener('input', function() {
    hitungKembalian();
});

function updateTotalWithDiscount() {
    const totalHargaElement = document.getElementById('totalHarga');
    const totalHargaInput = document.getElementById('total_harga_input');
    const totalHargaOriginal = totalHarga; // Gunakan totalHarga sebelum diskon
    const diskon = parseInt(document.getElementById('diskonInput').value) || 0;

    let totalHargaSetelahDiskon = totalHargaOriginal - diskon;
    if (totalHargaSetelahDiskon < 0) totalHargaSetelahDiskon = 0;

    totalHargaElement.textContent = formatRupiah(totalHargaSetelahDiskon);
    totalHargaInput.value = totalHargaSetelahDiskon;

    hitungKembalian();
}

// Modifikasi fungsi updateTotal()
function updateTotal() {
    const totalInput = document.getElementById('total_harga_input');
    
    let total = 0;
    const subtotals = document.querySelectorAll('#menuTable tbody td[data-subtotal]');
    subtotals.forEach(function(cell) {
        total += parseInt(cell.dataset.subtotal) || 0;
    });

    totalHarga = total; // Update global totalHarga
    totalInput.value = total;

    // Terapkan diskon
    updateTotalWithDiscount();
}

document.getElementById('transaksiForm').addEventListener('submit', function(event) {
    const pembayaranInput = document.getElementById('pembayaran');
    const totalHargaInput = document.getElementById('total_harga_input');
    const pembayaranError = document.getElementById('pembayaranError');

    const totalHarga = parseInt(totalHargaInput.value) || 0;
    const pembayaran = parseInt(pembayaranInput.value) || 0;

    if (pembayaran < totalHarga) {
        event.preventDefault(); // Mencegah form disubmit
        pembayaranError.textContent = 'Pembayaran kurang dari total harga.';
        pembayaranError.style.display = 'block';
        pembayaranInput.classList.add('is-invalid');
        alert('Pembayaran kurang dari total harga. Silakan periksa kembali.');
    }
});
</script>

<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js"></script>