<?= $this->extend('layout/template') ?>

<?= $this->section('content') ?>
<!-- <main>
    <div class="container-fluid px-4">
        <!-- Header Section -->
        <div class="d-flex justify-content-between align-items-center mt-4 mb-4">
            <div>
                <h1 class="mb-0">Data Menu</h1>
                <ol class="breadcrumb">
                    <li class="breadcrumb-item active">Daftar Menu Kopi</li>
                </ol>
            </div>
            <div>
                <a href="<?= base_url('menu/create') ?>" class="btn btn-primary">
                    <i class="fas fa-plus me-2"></i>Tambah Menu
                </a>
            </div>
        </div>

        <!-- Alert Section -->
        <?php if (session()->getFlashdata('pesan')) : ?>
            <div class="alert alert-success alert-dismissible fade show" role="alert">
                <i class="fas fa-check-circle me-2"></i>
                <?= session()->getFlashdata('pesan'); ?>
                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
            </div>
        <?php endif; ?>

        <!-- Table Section -->
        <div class="card shadow-sm">
            <div class="card-header bg-white py-3">
                <h5 class="card-title mb-0">
                    <i class="fas fa-coffee me-2"></i>
                    Tabel Menu
                </h5>
            </div>
            <div class="card-body">
                <table id="datatablesSimple" class="table table-striped table-hover">
                    <thead class="table-light">
                        <tr>
                            <th width="5%">No</th>
                            <th width="15%">ID Menu</th>
                            <th width="35%">Nama Menu</th>
                            <th width="25%">Harga</th>
                            <th width="20%">Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php $i = 1; ?>
                        <?php foreach ($menu as $m) : ?>
                            <tr>
                                <td class="text-center"><?= $i++; ?></td>
                                <td><?= esc($m['id_menu']); ?></td>
                                <td><?= esc($m['nama_menu']); ?></td>
                                <td>Rp <?= number_format($m['harga_menu'], 0, ',', '.'); ?></td>
                                <td>
                                    <div class="btn-group" role="group">
                                        <a href="<?= base_url('menu/edit/' . $m['id_menu']) ?>" 
                                           class="btn btn-warning btn-sm">
                                            <i class="fas fa-edit me-1"></i>Edit
                                        </a>
                                        <form action="<?= base_url('menu/delete/' . $m['id_menu']) ?>" 
                                              method="post" 
                                              class="d-inline">
                                            <?= csrf_field(); ?>
                                            <input type="hidden" name="_method" value="DELETE">
                                            <button type="submit" 
                                                    class="btn btn-danger btn-sm" 
                                                    onclick="return confirm('Apakah anda yakin ingin menghapus menu ini?');">
                                                <i class="fas fa-trash me-1"></i>Delete
                                            </button>
                                        </form>
                                    </div>
                                </td>
                            </tr>
                        <?php endforeach; ?>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</main> -->
<?= $this->endSection() ?>