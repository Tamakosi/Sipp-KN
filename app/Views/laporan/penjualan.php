<!-- app/Views/laporan/penjualan.php -->
<div id="layoutSidenav_content">
    <main>
        <div class="container-fluid px-4">
            <h1 class="mt-4">Laporan Penjualan</h1>
            <?php
            $no = 1;
            $totalPenjualan = 0;
            foreach ($laporan as $row):
                $totalPenjualan += $row['total_belanja'];
                ?>
                <!-- Baris tabel -->
            <?php endforeach; ?>

            <!-- Menampilkan Total Penjualan -->
            <div class="mt-3">
                <h5>Total Penjualan: Rp <?= number_format($totalPenjualan, 0, ',', '.') ?></h5>
            </div>
            <!-- Flashdata Messages -->
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

            <!-- Form Filter Tanggal -->
            <div class="card mb-4">
                <div class="card-header">
                    <form method="get" action="">
                        <div class="row align-items-end">
                            <div class="col-md-3">
                                <label for="start_date" class="form-label">Tanggal Mulai</label>
                                <input type="date" id="start_date" name="start_date" class="form-control"
                                    value="<?= isset($start_date) ? $start_date : '' ?>">
                            </div>
                            <div class="col-md-3">
                                <label for="end_date" class="form-label">Tanggal Akhir</label>
                                <input type="date" id="end_date" name="end_date" class="form-control"
                                    value="<?= isset($end_date) ? $end_date : '' ?>">
                            </div>
                            <div class="col-md-3">
                                <button type="submit" class="btn btn-primary mt-3">Filter</button>
                                <a href="<?= base_url('laporan/penjualan') ?>" class="btn btn-secondary mt-3">Reset</a>
                            </div>
                            <div class="col-md-3">
                                <a href="<?= base_url('laporan/cetakSemua') . '?start_date=' . $start_date . '&end_date=' . $end_date ?>"
                                    class="btn btn-danger mt-3" target="_blank">
                                    <i class="fas fa-print"></i> Cetak Laporan
                                </a>
                            </div>
                        </div>
                    </form>
                </div>
                <div class="card-body">
                    <!-- Tabel Laporan Penjualan -->
                    <table id="datatablesSimple" class="table table-striped">
                        <thead>
                            <tr>
                                <th>No</th>
                                <th>Tanggal</th>
                                <th>Pelanggan</th>
                                <th>Total Barang</th>
                                <th>Total Belanja (Rp)</th>
                                <th>Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php
                            $no = 1;
                            $totalPenjualan = 0;
                            foreach ($laporan as $row):
                                $totalPenjualan += $row['total_belanja'];
                                ?>
                                <tr>
                                    <td><?= $no++; ?></td>
                                    <td><?= date('d-m-Y', strtotime($row['tanggal'])); ?></td>
                                    <td><?= $row['nama_pelanggan']; ?></td>
                                    <td><?= $row['total_barang']; ?></td>
                                    <td><?= number_format($row['total_belanja'], 0, ',', '.'); ?></td>
                                    <td>
                                        <a href="<?= base_url('laporan/cetak/' . $row['id_transaksi']) ?>"
                                            class="btn btn-sm btn-primary" target="_blank">
                                            <i class="fas fa-print"></i> Cetak
                                        </a>
                                    </td>
                                </tr>
                            <?php endforeach; ?>
                        </tbody>
                    </table>

                    <!-- Menampilkan Total Keseluruhan Penjualan -->
                    <div class="mt-3">
                        <h5>Total Penjualan: Rp <?= number_format($totalPenjualan, 0, ',', '.') ?></h5>
                    </div>
                </div>
            </div>
        </div>
    </main>
</div>

<!-- Inisialisasi DataTables -->
<script>
    $(document).ready(function () {
        $('#datatablesSimple').DataTable();
    });
</script>