<div id="layoutSidenav_content">
    <main>
        <div class="container-fluid px-4">
            <h1 class="mt-4">Edit Karyawan</h1>

            <?php if (session()->getFlashdata('error')): ?>
                <div class="alert alert-danger">
                    <?= session()->getFlashdata('error') ?>
                </div>
            <?php endif; ?>

            <?php $validation = \Config\Services::validation(); ?>

            <div class="card mb-4">
                <div class="card-body">
                    <form action="<?= base_url('karyawan/update/' . $karyawan['id_karyawan']) ?>" method="post">
                        <div class="mb-3">
                            <label for="nama_karyawan" class="form-label">Nama Karyawan</label>
                            <input type="text"
                                class="form-control <?= ($validation->hasError('nama_karyawan')) ? 'is-invalid' : ''; ?>"
                                id="nama_karyawan" name="nama_karyawan"
                                value="<?= old('nama_karyawan', $karyawan['nama_karyawan']) ?>" required>
                            <div class="invalid-feedback">
                                <?= $validation->getError('nama_karyawan'); ?>
                            </div>
                        </div>
                        <div class="mb-3">
                            <label for="email_karyawan" class="form-label">Email</label>
                            <input type="email" 
                                class="form-control" <?= ($validation->hasError('email_karyawan')) ? 'is-invalid' : ''; ?>"
                                id="email_karyawan" name="email_karyawan"
                                value="<?= old('email_karyawan', $karyawan['email_karyawan']) ?>" required>
                            <div class="invalid-feedback">
                                <?= $validation->getError('email_karyawan'); ?>
                            </div>
                        </div>
                        <div class="mb-3">
                            <label for="id_role" class="form-label">Role</label>
                            <select class="form-control <?= ($validation->hasError('id_role')) ? 'is-invalid' : ''; ?>"
                                id="id_role" name="id_role" required>
                                <option value="">-- Pilih Role --</option>
                                <option value="R001" <?= ($karyawan['id_role'] == 'R001') ? 'selected' : ''; ?>>Owner
                                </option>
                                <option value="R003" <?= ($karyawan['id_role'] == 'R003') ? 'selected' : ''; ?>>Manajer
                                </option>
                                <option value="R004" <?= ($karyawan['id_role'] == 'R004') ? 'selected' : ''; ?>>Operator
                                </option>
                            </select>
                            <div class="invalid-feedback">
                                <?= $validation->getError('id_role'); ?>
                            </div>
                        </div>
                        <button type="submit" class="btn btn-primary">Update</button>
                        <a href="<?= base_url('karyawan') ?>" class="btn btn-secondary">Kembali</a>
                    </form>
                </div>
            </div>
        </div>
    </main>
</div>