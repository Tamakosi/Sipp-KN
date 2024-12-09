<div id="layoutSidenav_content">
    <main>
        <div class="container-fluid px-4">
            <h1 class="mt-4">Tambah Karyawan</h1>

            <?php if (session()->getFlashdata('error')): ?>
                <div class="alert alert-danger">
                    <?= session()->getFlashdata('error') ?>
                </div>
            <?php endif; ?>

            <div class="card mb-4">
                <div class="card-header">
                    <i class="fas fa-user-plus me-1"></i>
                    Form Tambah Karyawan
                </div>
                <div class="card-body">
                    <form action="<?= base_url('karyawan/save') ?>" method="post">

                        <?php $validation = \Config\Services::validation(); ?>

                        <!-- Kode input ID Karyawan -->
                        <div class="mb-3">
                            <label for="id_karyawan" class="form-label">ID Karyawan</label>
                            <input type="text"
                                class="form-control <?= ($validation->hasError('id_karyawan')) ? 'is-invalid' : ''; ?>"
                                id="id_karyawan" name="id_karyawan" value="<?= old('id_karyawan') ?>" required
                                placeholder="Contoh: K001">
                            <div class="invalid-feedback">
                                <?= $validation->getError('id_karyawan'); ?>
                            </div>
                        </div>


                        <!-- Kode input Nama Karyawan -->
                        <div class="mb-3">
                            <label for="nama_karyawan" class="form-label">Nama Karyawan</label>
                            <input type="text"
                                class="form-control <?= ($validation->hasError('nama_karyawan')) ? 'is-invalid' : ''; ?>"
                                id="nama_karyawan" name="nama_karyawan" value="<?= old('nama_karyawan') ?>" required>
                            <div class="invalid-feedback">
                                <?= $validation->getError('nama_karyawan'); ?>
                            </div>
                        </div>

                        <!-- Kode input Email Karyawan -->
                        <div class="mb-3">
                            <label for="email_karyawan" class="form-label">Email</label>
                            <input type="email"
                                class="form-control <?= ($validation->hasError('email_karyawan')) ? 'is-invalid' : ''; ?>"
                                id="email_karyawan" name="email_karyawan" value="<?= old('email_karyawan') ?>" required>
                            <div class="invalid-feedback">
                                <?= $validation->getError('email_karyawan'); ?>
                            </div>
                        </div>

                        <div class="mb-3">
                            <label for="id_role" class="form-label">Role</label>
                            <select class="form-control <?= ($validation->hasError('id_role')) ? 'is-invalid' : ''; ?>"
                                id="id_role" name="id_role" required>
                                <option value="">-- Pilih Role --</option>
                                <option value="R001" <?= (old('id_role') == 'R001') ? 'selected' : ''; ?>>Owner</option>
                                <option value="R003" <?= (old('id_role') == 'R003') ? 'selected' : ''; ?>>Manajer</option>
                                <option value="R004" <?= (old('id_role') == 'R004') ? 'selected' : ''; ?>>Operator</option>
                            </select>
                            <div class="invalid-feedback">
                                <?= $validation->getError('id_role'); ?>
                            </div>
                        </div>

                        <div class="mt-4">
                            <button type="submit" class="btn btn-primary">
                                <i class="fas fa-save me-1"></i>
                                Simpan
                            </button>
                            <a href="<?= base_url('karyawan') ?>" class="btn btn-secondary">
                                <i class="fas fa-arrow-left me-1"></i>
                                Kembali
                            </a>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </main>
</div>