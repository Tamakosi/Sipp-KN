<div id="layoutSidenav_content">
    <main>
        <div class="container-fluid px-4">
            <h1 class="mt-4">Data Transaksi</h1>
            
            <?php if (session()->getFlashdata('success')): ?>
                <div class="alert alert-success">
                    <?= session()->getFlashdata('success') ?>
                </div>
            <?php endif; ?>

            <?php if (session()->getFlashdata('error')): ?>
                <div class="alert alert-danger">
                    <?= session()->getFlashdata('error') ?>
                </div>
            <?php endif; ?>
            <div class="card mb-4">
                <div class="card-body">
                    <div class="d-flex justify-content-between align-items-center mb-3">
                        <h5 class="mb-0">Daftar Transaksi</h5>
                        <div>
                            <a href="<?= base_url('transaksi/create') ?>" class="btn btn-primary">+ Tambah Transaksi</a>
                        </div>
                    </div>
                    <div class="table-responsive">
                    <table class="table table-striped" id="datatablesSimple">
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
                                <?php foreach ($transaksi as $row): ?>
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
$(document).ready(function () {
        // Inisialisasi DataTables
        $('#datatablesSimple').DataTable({
            pageLength: 10,
            dom: '<"row mb-3"<"col-md-6"l><"col-md-6"f>>' + // Kontrol length dan search
                 'rt' + // Tabel
                 '<"row"<"col-md-6"i><"col-md-6"p>>', // Informasi dan paginasi
            language: {
                "info": "Menampilkan _START_ sampai _END_ dari _TOTAL_ entri",
                "infoEmpty": "Menampilkan 0 sampai 0 dari 0 entri",
                "infoFiltered": "(disaring dari total _MAX_ entri)",
                "lengthMenu": "Tampilkan _MENU_ entri",
                "search": "Cari:",
                "paginate": {
                    "first": "Pertama",
                    "last": "Terakhir",
                    "next": "Berikutnya",
                    "previous": "Sebelumnya"
                },
                "zeroRecords": "Tidak ada data yang cocok",
            },
            "pagingType": "simple_numbers"
        });
    });
</script>