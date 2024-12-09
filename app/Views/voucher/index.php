<!-- app/Views/voucher/index.php -->

<div id="layoutSidenav_content">
    <main>
        <div class="container-fluid px-4">
            <h1 class="mt-4">Data Voucher</h1>

            <?php if(session()->getFlashdata('success')): ?>
                <div class="alert alert-success">
                    <?= session()->getFlashdata('success') ?>
                </div>
            <?php endif; ?>

            <?php if(session()->getFlashdata('error')): ?>
                <div class="alert alert-danger">
                    <?= session()->getFlashdata('error') ?>
                </div>
            <?php endif; ?>

            <div class="card mb-4">
                <div class="card-header">
                    <i class="fas fa-ticket-alt me-1"></i>
                    Data Voucher
                </div>
                <div class="card-body">
                    <a href="<?= base_url('voucher/create') ?>" class="btn btn-primary mb-3">
                        <i class="fas fa-plus me-1"></i> Tambah Voucher
                    </a>
                    <table class="table table-bordered table-hover">
                        <thead>
                            <tr>
                                <th>Kode Voucher</th>
                                <th>Diskon</th>
                                <th>Dibuat Pada</th>
                                <th>Aksi</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php foreach($vouchers as $voucher): ?>
                            <tr>
                                <td><?= $voucher['kode_voucher'] ?></td>
                                <td>Rp <?= number_format($voucher['diskon'], 0, ',', '.') ?></td>
                                <td><?= date('d-m-Y H:i:s', strtotime($voucher['created_at'])) ?></td>
                                <td>
                                    <a href="<?= base_url('voucher/edit/' . $voucher['kode_voucher']) ?>" class="btn btn-warning btn-sm">
                                        <i class="fas fa-edit me-1"></i> Edit
                                    </a>
                                    <a href="<?= base_url('voucher/delete/' . $voucher['kode_voucher']) ?>" class="btn btn-danger btn-sm" onclick="return confirm('Apakah Anda yakin ingin menghapus voucher ini?')">
                                        <i class="fas fa-trash me-1"></i> Hapus
                                    </a>
                                    <a href="<?= base_url('voucher/history/' . $voucher['kode_voucher']) ?>" class="btn btn-info btn-sm">
                                        <i class="fas fa-history me-1"></i> Riwayat
                                    </a>
                                </td>
                            </tr>
                            <?php endforeach; ?>
                            <?php if(empty($vouchers)): ?>
                            <tr>
                                <td colspan="4" class="text-center">Data voucher tidak ditemukan</td>
                            </tr>
                            <?php endif; ?>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </main>
</div>