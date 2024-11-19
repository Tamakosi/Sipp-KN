<div id="layoutSidenav_content">
    <main>
        <div class="container-fluid px-4">
            <h1 class="mt-4">Data Transaksi</h1>
            
            <div class="card mb-4">
                <div class="card-body">
                    <div class="d-flex justify-content-between align-items-center mb-3">
                        <h5 class="mb-0">Daftar Transaksi</h5>
                        <div>
                            <a href="<?= base_url('transaksi/export-excel') ?>" class="text-decoration-none me-2">Export Excel</a>
                            <a href="<?= base_url('transaksi/create') ?>" class="btn btn-primary">+ Tambah Transaksi</a>
                        </div>
                    </div>

                    <div class="row mb-3">
                        <div class="col-md-2">
                            <select class="form-select" id="entries">
                                <option value="10">10</option>
                                <option value="25">25</option>
                                <option value="50">50</option>
                                <option value="100">100</option>
                            </select>
                            <label class="form-text">entries per page</label>
                        </div>
                        <div class="col-md-4 ms-auto">
                            <input type="text" class="form-control" placeholder="Search..." id="searchInput">
                        </div>
                    </div>

                    <div class="table-responsive">
                        <table class="table">
                            <thead>
                                <tr>
                                    <th>ID Transaksi</th>
                                    <th>ID Karyawan</th>
                                    <th>ID Pelanggan</th>
                                    <th>Kode Voucher</th>
                                    <th>Aksi</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php foreach ($transaksi as $row) : ?>
                                <tr>
                                    <td><?= $row['id_transaksi'] ?></td>
                                    <td><?= $row['id_karyawan'] ?></td>
                                    <td><?= $row['id_pelanggan'] ?></td>
                                    <td><?= $row['kode_voucher'] ?? '-' ?></td>
                                    <td>
                                        <a href="<?= base_url('transaksi/detail/' . $row['id_transaksi']) ?>" 
                                        class="btn btn-info btn-sm">
                                            <i class="fas fa-eye"></i> Detail
                                        </a>
                                        <a href="<?= base_url('transaksi/edit/' . $row['id_transaksi']) ?>" 
                                           class="btn btn-warning btn-sm">
                                            <i class="fas fa-edit"></i> Edit
                                        </a>
                                        <a href="<?= base_url('transaksi/delete/' . $row['id_transaksi']) ?>" 
                                           class="btn btn-danger btn-sm">
                                            <i class="fas fa-trash"></i> Hapus
                                        </a>
                                    </td>
                                </tr>
                                <?php endforeach; ?>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </main>
</div>

<script>
$(document).ready(function() {
    // Initialize DataTables
    $('#datatablesSimple').DataTable({
        pageLength: 10,
        dom: '<"row"<"col-md-2"l><"col-md-4 ms-auto"f>>rtip'
    });
});
</script>