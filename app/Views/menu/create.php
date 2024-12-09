<!-- app/Views/menu/create.php -->
<?php if (isset($errors) && !empty($errors)): ?>
    <div class="alert alert-danger">
        <ul>
            <?php foreach ($errors as $error): ?>
                <li><?= esc($error) ?></li>
            <?php endforeach; ?>
        </ul>
    </div>
<?php endif; ?>

<?php $validation = \Config\Services::validation(); ?>

<div id="layoutSidenav_content">
    <main>
        <div class="container-fluid px-4">
            <div class="row justify-content-center">
                <div class="col-lg-7">
                    <div class="card shadow-lg border-0 rounded-lg mt-5">
                        <div class="card-header">
                            <h3 class="text-center font-weight-light my-4">
                                <i class="fas fa-coffee me-2"></i>Tambah Menu Baru
                            </h3>
                        </div>
                        <div class="card-body">
                            <form action="<?= base_url('menu/save') ?>" method="post">
                                <?= csrf_field() ?>

                                <div class="row mb-3">
                                    <!-- Field ID Menu -->
                                    <div class="col-md-6">
                                        <div class="form-floating mb-3 mb-md-0">
                                            <input
                                                class="form-control <?= ($validation->hasError('id_menu')) ? 'is-invalid' : '' ?>"
                                                id="id_menu" name="id_menu" type="text" value="<?= old('id_menu') ?>"
                                                required pattern="^M[0-9]{3}$"
                                                title="ID Menu harus diawali huruf 'M' diikuti 3 digit angka (contoh: M001)" />
                                            <label for="id_menu">ID Menu</label>
                                            <small class="form-text text-muted">
                                                Masukkan ID Menu (contoh: M001, M002)
                                            </small>
                                            <?php if ($validation->hasError('id_menu')): ?>
                                                <div class="invalid-feedback">
                                                    <?= $validation->getError('id_menu'); ?>
                                                </div>
                                            <?php endif; ?>
                                        </div>
                                    </div>
                                    <!-- Field Nama Menu -->
                                    <div class="col-md-6">
                                        <div class="form-floating">
                                            <input
                                                class="form-control <?= ($validation->hasError('nama_menu')) ? 'is-invalid' : '' ?>"
                                                id="nama_menu" name="nama_menu" type="text"
                                                placeholder="Masukkan Nama Menu" value="<?= old('nama_menu') ?>"
                                                required />
                                            <label for="nama_menu">Nama Menu</label>
                                            <?php if ($validation->hasError('nama_menu')): ?>
                                                <div class="invalid-feedback">
                                                    <?= $validation->getError('nama_menu'); ?>
                                                </div>
                                            <?php endif; ?>
                                        </div>
                                    </div>
                                </div>
                                <!-- Field Harga Menu -->
                                <div class="form-floating mb-3">
                                    <input
                                        class="form-control <?= ($validation->hasError('harga_menu')) ? 'is-invalid' : '' ?>"
                                        id="harga_menu" name="harga_menu" type="number"
                                        placeholder="Masukkan Harga Menu" value="<?= old('harga_menu') ?>" min="0"
                                        required />
                                    <label for="harga_menu">Harga Menu</label>
                                    <?php if ($validation->hasError('harga_menu')): ?>
                                        <div class="invalid-feedback">
                                            <?= $validation->getError('harga_menu'); ?>
                                        </div>
                                    <?php endif; ?>
                                </div>
                                <!-- Tombol Submit -->
                                <div class="mt-4 mb-0">
                                    <div class="d-grid gap-2 d-md-flex justify-content-md-end">
                                        <a class="btn btn-secondary" href="<?= base_url('menu') ?>">
                                            <i class="fas fa-arrow-left me-1"></i>Kembali
                                        </a>
                                        <button class="btn btn-primary" type="submit">
                                            <i class="fas fa-save me-1"></i>Simpan Menu
                                        </button>
                                    </div>
                                </div>
                            </form>
                        </div>
                        <div class="card-footer text-center py-3">
                            <!-- Informasi Tambahan -->
                            <div class="small">
                                <i class="fas fa-info-circle me-1"></i>
                                Pastikan semua data terisi dengan benar sesuai format yang ditentukan
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </main>
</div>

<!-- Tambahkan CSS jika diperlukan -->
<style>
    /* Contoh styling untuk catatan panduan */
    .form-text {
        margin-top: 0.25rem;
        font-size: 0.875em;
        color: #6c757d;
    }

    /* Hapus spinner pada input number */
    input[type=number]::-webkit-inner-spin-button,
    input[type=number]::-webkit-outer-spin-button {
        -webkit-appearance: none;
        margin: 0;
    }

    input[type=number] {
        -moz-appearance: textfield;
    }
</style>

<script>
    document.getElementById('harga_menu').addEventListener('input', function (e) {
        var value = e.target.value;
        // Menghapus semua karakter non-digit
        e.target.value = value.replace(/\D/g, '');
    });

    document.getElementById('harga_menu').addEventListener('input', function (e) {
        var value = e.target.value;
        // Hapus semua karakter non-digit
        value = value.replace(/[^\d]/g, '');
        // Tambahkan ribuan separator
        value = value.replace(/\B(?=(\d{3})+(?!\d))/g, ".");
        e.target.value = value;
    });
</script>