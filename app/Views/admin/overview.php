<div id="layoutSidenav_content">
    <main>
        <div class="container-fluid px-4">
            <h1 class="mt-4">Dashboard</h1>
            <ol class="breadcrumb mb-4">
                <li class="breadcrumb-item active">Dashboard</li>
            </ol>

            <div class="card mb-4">
                <div class="card-header">
                    <i class="fas fa-table me-1"></i>
                    Data Menu
                </div>
                <div class="card-body">
                    <table id="datatablesSimple" class="table table-bordered">
                        <thead>
                            <tr>
                                <th>No</th>
                                <th>ID Menu</th>
                                <th>Nama Menu</th>
                                <th>Harga</th>
                                <th>Aksi</th>
                            </tr>
                        </thead>
                        <tbody>
                        <?php if(isset($menu) && is_array($menu)): ?>
                            <?php $i = 1; ?>
                            <?php foreach($menu as $m): ?>
                            <tr>
                                <td><?= $i++ ?></td>
                                <td><?= esc($m['id_menu']) ?></td>
                                <td><?= esc($m['nama_menu']) ?></td>
                                <td>Rp <?= number_format($m['harga_menu'],0,',','.') ?></td>
                                <td>
                                    <a href="<?= base_url('menu/edit/'.$m['id_menu']) ?>" class="btn btn-warning btn-sm">Edit</a>
                                    <form action="<?= base_url('menu/delete/'.$m['id_menu']) ?>" method="post" class="d-inline">
                                        <?= csrf_field() ?>
                                        <button type="submit" class="btn btn-danger btn-sm" onclick="return confirm('Yakin hapus?')">Delete</button>
                                    </form>
                                </td>
                            </tr>
                            <?php endforeach; ?>
                        <?php endif; ?>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </main>
</div>