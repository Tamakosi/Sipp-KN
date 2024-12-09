<!-- app/Views/voucher/history.php -->

<div id="layoutSidenav_content">
    <main>
        <div class="container-fluid px-4">
            <h1 class="mt-4">Riwayat Pemakaian Voucher: <?= $voucher['kode_voucher'] ?></h1>

            <div class="card mb-4">
                <div class="card-header">
                    <i class="fas fa-history me-1"></i>
                    Riwayat Pemakaian Voucher
                </div>
                <div class="card-body">
                    <table class="table table-bordered table-hover">
                        <thead>
                            <tr>
                                <th>ID Transaksi</th>
                                <th>Tanggal</th>
                                <th>Nama Pelanggan</th>
                                <th>Nama Karyawan</th>
                                <th>Total Transaksi</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php if(!empty($transactions)): ?>
                                <?php foreach($transactions as $transaksi): ?>
                                <tr>
                                    <td><?= $transaksi['id_transaksi'] ?></td>
                                    <td><?= date('d-m-Y H:i:s', strtotime($transaksi['created_at'])) ?></td>
                                    <td><?= $transaksi['nama_pelanggan'] ?></td>
                                    <td><?= $transaksi['nama_karyawan'] ?></td>
                                    <td>Rp <?= number_format($transaksi['harga_total'], 0, ',', '.') ?></td>
                                </tr>
                                <?php endforeach; ?>
                            <?php else: ?>
                            <tr>
                                <td colspan="5" class="text-center">Belum ada transaksi yang menggunakan voucher ini.</td>
                            </tr>
                            <?php endif; ?>
                        </tbody>
                    </table>

                    <a href="<?= base_url('voucher') ?>" class="btn btn-secondary mt-3">
                        <i class="fas fa-arrow-left me-1"></i> Kembali
                    </a>
                </div>
            </div>
        </div>
    </main>
</div>