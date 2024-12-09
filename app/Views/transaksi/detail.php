<div id="layoutSidenav_content">
    <main>
        <div class="container-fluid px-4">
            <h1 class="mt-4">Detail Transaksi</h1>

            <?php if (empty($transaction)): ?>
                <div class="alert alert-danger">
                    Data transaksi tidak ditemukan.
                </div>
            <?php else: ?>

                <div class="card mb-4">
                    <div class="card-header">
                        <i class="fas fa-info-circle me-1"></i>
                        Informasi Transaksi
                    </div>
                    <div class="card-body">
                        <!-- Tabel Informasi Transaksi -->
                        <table class="table table-bordered">
                            <tr>
                                <th>Tanggal Transaksi</th>
                                <td><?= date('d-m-Y H:i:s', strtotime($transaction[0]['tanggal_transaksi'])) ?></td>
                            </tr>
                            <tr>
                                <th>Nama Karyawan</th>
                                <td><?= $transaction[0]['nama_karyawan'] ?></td>
                            </tr>
                            <tr>
                                <th>Nama Pelanggan</th>
                                <td><?= $transaction[0]['nama_pelanggan'] ?></td>
                            </tr>
                            <!-- Baris data lainnya -->
                        </table>
                        <!-- Tambahkan Bagian Berikut untuk Detail Menu -->
                        <h5 class="mt-4">Detail Menu</h5>
                        <table class="table table-striped">
                            <thead>
                                <tr>
                                    <th>Nama Menu</th>
                                    <th>Jumlah</th>
                                    <th>Harga Satuan</th>
                                    <th>Subtotal</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php
                                $totalHarga = 0;
                                foreach ($transaction as $item):
                                    $subtotal = $item['subtotal'];
                                    $totalHarga += $subtotal;
                                    ?>
                                    <tr>
                                        <td>
                                            <?= isset($item['nama_menu']) ? $item['nama_menu'] : 'Nama menu tidak tersedia' ?>
                                            <?php if ($item['menu_dihapus']): ?>
                                                <span class="text-danger">(Menu telah dihapus)</span>
                                            <?php endif; ?>
                                        </td>
                                        <td><?= $item['jumlah_produk'] ?></td>
                                        <td>Rp <?= number_format($item['harga_satuan'], 0, ',', '.') ?></td>
                                        <td>Rp <?= number_format($subtotal, 0, ',', '.') ?></td>
                                    </tr>
                                <?php endforeach; ?>
                            </tbody>
                            <tfoot>
                                <tr>
                                    <th colspan="3" class="text-end">Total Harga</th>
                                    <th>Rp <?= number_format($totalHarga, 0, ',', '.') ?></th>
                                </tr>
                            </tfoot>
                        </table>

                        <!-- Tabel Total Harga dan Diskon -->
                        <table class="table">
                            <tr>
                                <th class="text-end">Total Harga Sebelum Diskon:</th>
                                <td class="text-end">Rp <?= number_format($totalHarga, 0, ',', '.') ?></td>
                            </tr>
                            <?php if ($transaction[0]['kode_voucher']): ?>
                                <tr>
                                    <th class="text-end">Diskon (Voucher <?= $transaction[0]['kode_voucher'] ?>):</th>
                                    <td class="text-end">Rp
                                        <?= number_format($totalHarga - $transaction[0]['total_transaksi'], 0, ',', '.') ?>
                                    </td>
                                </tr>
                            <?php endif; ?>
                            <tr>
                                <th class="text-end">Total Harga Setelah Diskon:</th>
                                <td class="text-end">Rp
                                    <?= number_format($transaction[0]['total_transaksi'], 0, ',', '.') ?>
                                </td>
                            </tr>
                            <!-- Tambahkan baris untuk Pembayaran dan Kembalian -->
                            <tr>
                                <th class="text-end">Pembayaran:</th>
                                <td class="text-end">Rp
                                    <?= number_format($transaction[0]['pembayaran_transaksi'], 0, ',', '.') ?>
                                </td>
                            </tr>
                            <tr>
                                <th class="text-end">Kembalian:</th>
                                <td class="text-end">Rp
                                    <?= number_format($transaction[0]['kembalian_transaksi'], 0, ',', '.') ?>
                                </td>
                            </tr>
                        </table>

                        <div class="mt-3">
                            <a href="<?= base_url('transaksi') ?>" class="btn btn-secondary">
                                <i class="fas fa-arrow-left"></i> Kembali
                            </a>
                        </div>
                    </div>
                </div>

            <?php endif; ?>

        </div>
    </main>
</div>