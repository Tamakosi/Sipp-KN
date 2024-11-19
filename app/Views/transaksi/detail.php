<!-- File: app/Views/transaksi/detail.php -->
<div id="layoutSidenav_content">
    <main>
        <div class="container-fluid px-4">
            <h1 class="mt-4">Detail Transaksi</h1>
            
            <div class="card mb-4">
                <div class="card-header">
                    <i class="fas fa-info-circle me-1"></i>
                    Informasi Transaksi
                </div>
                <div class="card-body">
                    <div class="table-responsive">
                        <table class="table table-bordered">
                            <tr>
                                <th width="200">ID Transaksi</th>
                                <td><?= $transaksi['id_transaksi'] ?></td>
                            </tr>
                            <tr>
                                <th>ID Menu</th>
                                <td><?= $transaksi['id_menu'] ?></td>
                            </tr>
                            <tr>
                                <th>Jumlah Produk</th>
                                <td><?= $transaksi['jumlah_produk'] ?></td>
                            </tr>
                            <tr>
                                <th>Harga Satuan</th>
                                <td>Rp <?= number_format($transaksi['harga_satuan'], 0, ',', '.') ?></td>
                            </tr>
                            <tr>
                                <th>Harga Total</th>
                                <td>Rp <?= number_format($transaksi['harga_total'], 0, ',', '.') ?></td>
                            </tr>
                        </table>
                    </div>
                    <div class="mt-3">
                        <a href="<?= base_url('transaksi') ?>" class="btn btn-secondary">Kembali</a>
                    </div>
                </div>
            </div>
        </div>
    </main>
</div>