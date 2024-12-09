<div id="layoutSidenav_content">
    <main>
        <div class="container-fluid px-4">
            <h1 class="mt-4">Data Menu</h1>

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
                <div class="card-header">
                    <i class="fas fa-table me-1"></i>
                    Daftar Menu
                    <a href="<?= base_url('menu/create') ?>" class="btn btn-primary btn-sm float-end">
                        <i class="fas fa-plus me-1"></i>Tambah Menu
                    </a>
                </div>
                <div class="card-body">
                    <table id="datatablesSimple" class="table table-striped">
                        <thead>
                            <tr>
                                <th>ID Menu</th>
                                <th>Nama Menu</th>
                                <th>Harga</th>
                                <th>Aksi</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php foreach ($menu as $row): ?>
                                <tr>
                                    <td><?= $row['id_menu'] ?></td>
                                    <td><?= $row['nama_menu'] ?></td>
                                    <td>Rp <?= number_format($row['harga_menu'], 0, ',', '.') ?></td>
                                    <td>
                                        <a href="<?= base_url('menu/edit/' . $row['id_menu']) ?>"
                                            class="btn btn-warning btn-sm">
                                            <i class="fas fa-edit me-1"></i>Edit
                                        </a>
                                        <a href="<?= base_url('menu/delete/' . $row['id_menu']) ?>"
                                            class="btn btn-danger btn-sm"
                                            onclick="return confirm('Apakah Anda yakin ingin menghapus menu ini?')">
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