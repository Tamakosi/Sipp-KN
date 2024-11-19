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
                    Daftar Voucher
                    <a href="<?= base_url('voucher/create') ?>" class="btn btn-primary btn-sm float-end">
                        <i class="fas fa-plus me-1"></i>Tambah Voucher
                    </a>
                </div>
                <div class="card-body">
                    <table id="datatablesSimple" class="table table-striped">
                        <thead>
                            <tr>
                                <th>Kode Voucher</th>
                                <th>Jumlah Poin</th>
                                <th>Aksi</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php foreach ($voucher as $row) : ?>
                            <tr>
                                <td><?= $row['kode_voucher'] ?></td>
                                <td><?= number_format($row['jumlah_poin'], 0, ',', '.') ?> poin</td>
                                <td>
                                    <a href="<?= base_url('voucher/edit/' . $row['kode_voucher']) ?>" 
                                       class="btn btn-warning btn-sm">
                                        <i class="fas fa-edit me-1"></i>Edit
                                    </a>
                                    <a href="<?= base_url('voucher/delete/' . $row['kode_voucher']) ?>" 
                                       class="btn btn-danger btn-sm" 
                                       onclick="return confirm('Apakah Anda yakin ingin menghapus voucher ini?')">
                                        <i class="fas fa-trash me-1"></i>Hapus
                                    </a>
                                </td>
                            </tr>
                            <?php endforeach; ?>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </main>
</div>