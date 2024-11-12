<div id="layoutSidenav_content">
    <main>
        <div class="container-fluid px-4">
            <h1 class="mt-4">Edit Karyawan</h1>

            <?php if(session()->getFlashdata('error')): ?>
                <div class="alert alert-danger">
                    <?= session()->getFlashdata('error') ?>
                </div>
            <?php endif; ?>

            <div class="card mb-4">
                <div class="card-body">
                    <form action="<?= base_url('karyawan/update/' . $karyawan['id_karyawan']) ?>" method="post">
                        <div class="mb-3">
                            <label for="nama_karyawan" class="form-label">Nama Karyawan</label>
                            <input type="text" class="form-control" id="nama_karyawan" name="nama_karyawan" 
                                   value="<?= $karyawan['nama_karyawan'] ?>" required>
                        </div>
                        <div class="mb-3">
                            <label for="email_karyawan" class="form-label">Email</label>
                            <input type="email" class="form-control" id="email_karyawan" name="email_karyawan" 
                                   value="<?= $karyawan['email_karyawan'] ?>" required>
                        </div>
                        <div class="mb-3">
                            <label for="id_role" class="form-label">Role</label>
                            <input type="text" class="form-control" id="id_role" name="id_role" 
                                   value="<?= $karyawan['id_role'] ?>" required>
                        </div>
                        <button type="submit" class="btn btn-primary">Update</button>
                        <a href="<?= base_url('karyawan') ?>" class="btn btn-secondary">Kembali</a>
                    </form>
                </div>
            </div>
        </div>
    </main>
</div>