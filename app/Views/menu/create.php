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
                                    <div class="col-md-6">
                                    <div class="form-floating mb-3 mb-md-0">
                                         <input class="form-control <?= (session('errors.id_menu')) ? 'is-invalid' : '' ?>" 
                                                    id="id_menu" 
                                                    name="id_menu" 
                                                    type="text" 
                                                    placeholder="Masukkan ID Menu"
                                                    value="<?= old('id_menu') ?>" />
                                            <label for="id_menu">ID Menu</label>
                                            <div class="invalid-feedback">
                                                <?= session('errors.id_menu') ?>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-floating">
                                            <input class="form-control <?= (session('errors.nama_menu')) ? 'is-invalid' : '' ?>" 
                                                   id="nama_menu" 
                                                   name="nama_menu" 
                                                   type="text" 
                                                   placeholder="Masukkan Nama Menu"
                                                   value="<?= old('nama_menu') ?>" />
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
                                           placeholder="Masukkan Harga Menu"
                                           value="<?= old('harga_menu') ?>" />
                                    <label for="harga_menu">Harga Menu</label>
                                    <div class="invalid-feedback">
                                        <?= session('errors.harga_menu') ?>
                                    </div>
                                </div>

                                <div class="mt-4 mb-0">
                                    <div class="d-grid gap-2 d-md-flex justify-content-md-end">
                                        <!-- Tombol Kembali -->
                                        <a class="btn btn-secondary" href="<?= base_url('menu') ?>">
                                          <i class="fas fa-arrow-left me-1"></i>Kembali
                                        </a>
                                        <!-- Tombol Simpan -->
                                        <button class="btn btn-primary" type="submit">
                                            <i class="fas fa-save me-1"></i>Simpan Menu
                                        </button>
                                    </div>
                                </div>
                            </form>
                        </div>
                        <div class="card-footer text-center py-3">
                            <!-- Icon Info -->
                            <div class="small">
                                <i class="fas fa-info-circle me-1"></i>
                                Pastikan semua data terisi dengan benar
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </main>
</div>

<style>
.card {
    margin-bottom: 2rem;
    border: none;
    box-shadow: 0 0.5rem 1rem rgba(0, 0, 0, 0.15);
}

.card-header {
    background-color: #f8f9fa;
    border-bottom: 1px solid #e3e6f0;
}

.form-floating {
    position: relative;
}

.form-floating > .form-control {
    height: calc(3.5rem + 2px);
    padding: 1rem 0.75rem;
}

.form-floating > label {
    position: absolute;
    top: 0;
    left: 0;
    height: 100%;
    padding: 1rem 0.75rem;
    pointer-events: none;
    border: 1px solid transparent;
    transform-origin: 0 0;
    transition: opacity .1s ease-in-out,transform .1s ease-in-out;
}

.btn {
    padding: 0.5rem 1rem;
    font-size: 0.9rem;
}

.btn-primary {
    background-color: #0d6efd;
    border-color: #0d6efd;
}

.btn-secondary {
    background-color: #6c757d;
    border-color: #6c757d;
}
</style>