<div id="layoutSidenav_content">
    <main>
        <div class="container-fluid px-4">
            <h1 class="mt-4">Tambah Karyawan</h1>

            <?php if(session()->getFlashdata('error')): ?>
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
                        <div class="mb-3">
                            <label for="id_karyawan" class="form-label">ID Karyawan</label>
                            <input type="text" class="form-control" id="id_karyawan" name="id_karyawan" 
                                   value="<?= old('id_karyawan') ?>" required>
                        </div>
                        
                        <div class="mb-3">
                            <label for="nama_karyawan" class="form-label">Nama Karyawan</label>
                            <input type="text" class="form-control" id="nama_karyawan" name="nama_karyawan" 
                                   value="<?= old('nama_karyawan') ?>" required>
                        </div>
                        
                        <div class="mb-3">
                            <label for="email_karyawan" class="form-label">Email</label>
                            <input type="email" class="form-control" id="email_karyawan" name="email_karyawan" 
                                   value="<?= old('email_karyawan') ?>" required>
                        </div>
                        
                        <div class="mb-3">
                            <label for="id_role" class="form-label">Role</label>
                            <input type="text" class="form-control" id="id_role" name="id_role" 
                                   value="<?= old('id_role') ?>" required>
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