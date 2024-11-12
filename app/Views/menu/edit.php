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

                                <div class="row mb-3">
                                    <div class="col-md-6">
                                        <div class="form-floating mb-3 mb-md-0">
                                            <input class="form-control" 
                                                   type="text" 
                                                   value="<?= $menu['id_menu'] ?>" 
                                                   readonly />
                                            <label>ID Menu</label>
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-floating">
                                            <input class="form-control <?= (session('errors.nama_menu')) ? 'is-invalid' : '' ?>" 
                                                   id="nama_menu" 
                                                   name="nama_menu" 
                                                   type="text" 
                                                   value="<?= old('nama_menu', $menu['nama_menu']) ?>" />
                                            <label for="nama_menu">Nama Menu</label>
                                            <div class="invalid-feedback">
                                                <?= session('errors.nama_menu') ?>
                                            </div>
                                        </div>
                                    </div>
                                </div>

                                <div class="form-floating mb-3">
                                    <input class="form-control <?= (session('errors.harga_menu')) ? 'is-invalid' : '' ?>" 
                                           id="harga_menu" 
                                           name="harga_menu" 
                                           type="number" 
                                           value="<?= old('harga_menu', $menu['harga_menu']) ?>" />
                                    <label for="harga_menu">Harga Menu</label>
                                    <div class="invalid-feedback">
                                        <?= session('errors.harga_menu') ?>
                                    </div>
                                </div>

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
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </main>
</div>