<?php $validation = \Config\Services::validation(); ?>

<div id="layoutSidenav_content">
    <main>
        <div class="container-fluid px-4">
            <div class="row justify-content-center">
                <div class="col-lg-7">
                    <div class="card shadow-lg border-0 rounded-lg mt-5">
                        <div class="card-header">
                            <h3 class="text-center font-weight-light my-4">
                                <i class="fas fa-coffee me-2"></i>Edit Menu
                            </h3>
                        </div>
                        <div class="card-body">
                            <form action="<?= base_url('menu/update/' . $menu['id_menu']) ?>" method="post">
                                <?= csrf_field() ?>

                                <!-- Field ID Menu -->
                                <div class="mb-3">
                                    <label for="id_menu">ID Menu</label>
                                    <input
                                        class="form-control <?= ($validation->hasError('id_menu')) ? 'is-invalid' : '' ?>"
                                        id="id_menu" name="id_menu" type="text"
                                        value="<?= old('id_menu', $menu['id_menu']) ?>"
                                        pattern="^M[0-9]{3}$"
                                        title="ID Menu harus diawali huruf 'M' diikuti 3 digit angka (contoh: M001)"
                                        required />
                                    <?php if ($validation->hasError('id_menu')): ?>
                                        <div class="invalid-feedback">
                                            <?= $validation->getError('id_menu'); ?>
                                        </div>
                                    <?php endif; ?>
                                </div>

                                <!-- Field Nama Menu -->
                                <div class="mb-3">
                                    <label for="nama_menu">Nama Menu</label>
                                    <input
                                        class="form-control <?= ($validation->hasError('nama_menu')) ? 'is-invalid' : '' ?>"
                                        id="nama_menu" name="nama_menu" type="text"
                                        value="<?= old('nama_menu', $menu['nama_menu']) ?>" required />
                                    <?php if ($validation->hasError('nama_menu')): ?>
                                        <div class="invalid-feedback">
                                            <?= $validation->getError('nama_menu'); ?>
                                        </div>
                                    <?php endif; ?>
                                </div>

                                <!-- Field Harga Menu -->
                                <div class="mb-3">
                                    <label for="harga_menu">Harga Menu</label>
                                    <input
                                        class="form-control <?= ($validation->hasError('harga_menu')) ? 'is-invalid' : '' ?>"
                                        id="harga_menu" name="harga_menu" type="number"
                                        value="<?= old('harga_menu', $menu['harga_menu']) ?>" min="0" required />
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
                                            <i class="fas fa-save me-1"></i>Update Menu
                                        </button>
                                    </div>
                                </div>
                            </form>
                        </div> <!-- End of card-body -->
                    </div> <!-- End of card -->
                </div> <!-- End of col-lg-7 -->
            </div> <!-- End of row -->
        </div> <!-- End of container-fluid -->
    </main>
</div>
