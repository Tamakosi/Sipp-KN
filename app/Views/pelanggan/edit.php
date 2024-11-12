<!-- views/pelanggan/edit.php -->
<div id="layoutSidenav_content">
    <main>
        <div class="container-fluid px-4">
            <h1 class="mt-4">Edit Pelanggan</h1>

            <?php if(session()->getFlashdata('error')): ?>
                <div class="alert alert-danger">
                    <?= session()->getFlashdata('error') ?>
                </div>
            <?php endif; ?>

            <div class="card mb-4">
                <div class="card-body">
                    <form action="<?= base_url('pelanggan/update/' . $pelanggan['id_pelanggan']) ?>" method="post">
                        <div class="mb-3">
                            <label for="nama_pelanggan" class="form-label">Nama Pelanggan</label>
                            <input type="text" class="form-control" id="nama_pelanggan" name="nama_pelanggan" 
                                   value="<?= $pelanggan['nama_pelanggan'] ?>" required>
                        </div>
                        <div class="mb-3">
                            <label for="email_pelanggan" class="form-label">Email</label>
                            <input type="email" class="form-control" id="email_pelanggan" name="email_pelanggan" 
                                   value="<?= $pelanggan['email_pelanggan'] ?>" required>
                        </div>
                        <button type="submit" class="btn btn-primary">Update</button>
                        <a href="<?= base_url('pelanggan') ?>" class="btn btn-secondary">Kembali</a>
                    </form>
                </div>
            </div>
        </div>
    </main>
</div>