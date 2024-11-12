<div id="layoutSidenav_content">
    <main>
        <div class="container-fluid px-4">
            <h1 class="mt-4">Data Karyawan</h1>
            
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
                    <i class="fas fa-user-tie me-1"></i>
                    Daftar Karyawan
                    <a href="<?= base_url('karyawan/create') ?>" class="btn btn-primary btn-sm float-end">
                        <i class="fas fa-plus me-1"></i>Tambah Karyawan
                    </a>
                </div>
                <div class="card-body">
                    <table id="datatablesSimple" class="table table-striped">
                        <thead>
                            <tr>
                                <th>ID Karyawan</th>
                                <th>Nama Karyawan</th>
                                <th>Email</th>
                                <th>Role</th>
                                <th>Aksi</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php foreach ($karyawan as $row) : ?>
                            <tr>
                                <td><?= $row['id_karyawan'] ?></td>
                                <td><?= $row['nama_karyawan'] ?></td>
                                <td><?= $row['email_karyawan'] ?></td>
                                <td><?= $row['id_role'] ?></td>
                                <td>
                                    <a href="<?= base_url('karyawan/edit/' . $row['id_karyawan']) ?>" 
                                       class="btn btn-warning btn-sm">
                                        <i class="fas fa-edit me-1"></i>Edit
                                    </a>
                                    <a href="<?= base_url('karyawan/delete/' . $row['id_karyawan']) ?>" 
                                       class="btn btn-danger btn-sm" 
                                       onclick="return confirm('Apakah Anda yakin ingin menghapus karyawan ini?')">
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