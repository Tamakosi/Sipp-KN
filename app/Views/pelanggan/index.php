<div id="layoutSidenav_content">
    <main>
        <div class="container-fluid px-4">
            <h1 class="mt-4">Data Pelanggan</h1>
            
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
                    <i class="fas fa-users me-1"></i>
                    Daftar Pelanggan
                    <a href="<?= base_url('pelanggan/create') ?>" class="btn btn-primary btn-sm float-end">
                        <i class="fas fa-plus me-1"></i>Tambah Pelanggan
                    </a>
                </div>
                <div class="card-body">
                    <table id="datatablesSimple" class="table table-striped">
                        <thead>
                            <tr>
                                <th>ID Pelanggan</th>
                                <th>Nama Pelanggan</th>
                                <th>Email</th>
                                <th>Aksi</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php foreach ($pelanggan as $row) : ?>
                            <tr>
                                <td><?= $row['id_pelanggan'] ?></td>
                                <td><?= $row['nama_pelanggan'] ?></td>
                                <td><?= $row['email_pelanggan'] ?></td>
                                <td>
                                    <a href="<?= base_url('pelanggan/edit/' . $row['id_pelanggan']) ?>" 
                                       class="btn btn-warning btn-sm">
                                        <i class="fas fa-edit me-1"></i>Edit
                                    </a>
                                    <a href="<?= base_url('pelanggan/delete/' . $row['id_pelanggan']) ?>" 
                                       class="btn btn-danger btn-sm" 
                                       onclick="return confirm('Apakah Anda yakin ingin menghapus pelanggan ini?')">
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