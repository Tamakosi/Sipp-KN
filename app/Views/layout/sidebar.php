<?php $session = session(); ?>
<div id="layoutSidenav">
    <div id="layoutSidenav_nav">
        <nav class="sb-sidenav accordion sb-sidenav-dark" id="sidenavAccordion">
            <div class="sb-sidenav-menu">
                <div class="nav">
                    <!-- Dashboard -->
                    <div class="sb-sidenav-menu-heading">Core</div>
                    <a class="nav-link" href="<?= base_url() ?>">
                        <div class="sb-nav-link-icon"><i class="fas fa-tachometer-alt"></i></div>
                        Dashboard
                    </a>

                    <?php if ($session->get('logged_in')): ?>
                        <!-- Menu untuk Owner dan Operator -->
                        <?php if ($session->get('role') == 'owner' || $session->get('role') == 'operator'): ?>
                            <!-- Menu Interface -->
                            <a class="nav-link collapsed" href="#" data-bs-toggle="collapse" data-bs-target="#collapseLayouts"
                                aria-expanded="false" aria-controls="collapseLayouts">
                                <div class="sb-nav-link-icon"><i class="fas fa-columns"></i></div>
                                Menu
                                <div class="sb-sidenav-collapse-arrow"><i class="fas fa-angle-down"></i></div>
                            </a>
                            <div class="collapse" id="collapseLayouts" aria-labelledby="headingOne"
                                data-bs-parent="#sidenavAccordion">
                                <nav class="sb-sidenav-menu-nested nav">
                                    <a class="nav-link" href="<?= base_url('menu') ?>">Data Menu</a>
                                    <a class="nav-link" href="<?= base_url('menu/create') ?>">Tambah Menu</a>
                                </nav>
                            </div>
                        <?php endif; ?>

                        <!-- Pelanggan Interface -->
                        <?php if ($session->get('role') == 'owner' || $session->get('role') == 'operator'): ?>
                            <a class="nav-link collapsed" href="#" data-bs-toggle="collapse" data-bs-target="#collapsePelanggan"
                                aria-expanded="false" aria-controls="collapsePelanggan">
                                <div class="sb-nav-link-icon"><i class="fas fa-users"></i></div>
                                Pelanggan
                                <div class="sb-sidenav-collapse-arrow"><i class="fas fa-angle-down"></i></div>
                            </a>
                            <div class="collapse" id="collapsePelanggan" aria-labelledby="headingTwo"
                                data-bs-parent="#sidenavAccordion">
                                <nav class="sb-sidenav-menu-nested nav">
                                    <a class="nav-link" href="<?= base_url('pelanggan') ?>">Data Pelanggan</a>
                                    <a class="nav-link" href="<?= base_url('pelanggan/create') ?>">Tambah Pelanggan</a>
                                </nav>
                            </div>
                        <?php endif; ?>

                        <!-- Karyawan Interface -->
                        <?php if ($session->get('role') == 'owner' || $session->get('role') == 'operator'): ?>
                            <a class="nav-link collapsed" href="#" data-bs-toggle="collapse" data-bs-target="#collapseKaryawan"
                                aria-expanded="false" aria-controls="collapseKaryawan">
                                <div class="sb-nav-link-icon"><i class="fas fa-user-tie"></i></div>
                                Karyawan
                                <div class="sb-sidenav-collapse-arrow"><i class="fas fa-angle-down"></i></div>
                            </a>
                            <div class="collapse" id="collapseKaryawan" aria-labelledby="headingThree"
                                data-bs-parent="#sidenavAccordion">
                                <nav class="sb-sidenav-menu-nested nav">
                                    <a class="nav-link" href="<?= base_url('karyawan') ?>">Data Karyawan</a>
                                    <a class="nav-link" href="<?= base_url('karyawan/create') ?>">Tambah Karyawan</a>
                                </nav>
                            </div>
                        <?php endif; ?>

                        <!-- Transaksi Interface -->
                        <?php if ($session->get('role') == 'owner' || $session->get('role') == 'manajer'): ?>
                            <a class="nav-link collapsed" href="#" data-bs-toggle="collapse" data-bs-target="#collapseTransaksi"
                                aria-expanded="false" aria-controls="collapseTransaksi">
                                <div class="sb-nav-link-icon"><i class="fas fa-shopping-cart"></i></div>
                                Transaksi
                                <div class="sb-sidenav-collapse-arrow"><i class="fas fa-angle-down"></i></div>
                            </a>
                            <div class="collapse" id="collapseTransaksi" aria-labelledby="headingFour"
                                data-bs-parent="#sidenavAccordion">
                                <nav class="sb-sidenav-menu-nested nav">
                                    <a class="nav-link" href="<?= base_url('transaksi') ?>">Data Transaksi</a>
                                    <a class="nav-link" href="<?= base_url('transaksi/create') ?>">Tambah Transaksi</a>
                                </nav>
                            </div>
                        <?php endif; ?>

                        <!-- Voucher Interface (Jika diperlukan oleh Owner) -->
                        <?php if ($session->get('role') == 'owner'): ?>
                            <a class="nav-link collapsed" href="#" data-bs-toggle="collapse" data-bs-target="#collapseVoucher"
                                aria-expanded="false" aria-controls="collapseVoucher">
                                <div class="sb-nav-link-icon"><i class="fas fa-ticket-alt"></i></div>
                                Voucher
                                <div class="sb-sidenav-collapse-arrow"><i class="fas fa-angle-down"></i></div>
                            </a>
                            <div class="collapse" id="collapseVoucher" aria-labelledby="headingFive"
                                data-bs-parent="#sidenavAccordion">
                                <nav class="sb-sidenav-menu-nested nav">
                                    <a class="nav-link" href="<?= base_url('voucher') ?>">Data Voucher</a>
                                    <a class="nav-link" href="<?= base_url('voucher/create') ?>">Tambah Voucher</a>
                                </nav>
                            </div>
                        <?php endif; ?>

                        <!-- Laporan Penjualan -->
                        <?php if ($session->get('role') == 'owner' || $session->get('role') == 'manajer'): ?>
                            <a class="nav-link" href="<?= base_url('laporan/penjualan') ?>">
                                <div class="sb-nav-link-icon"><i class="fas fa-file-alt"></i></div>
                                Laporan Penjualan
                            </a>
                        <?php endif; ?>

                    <?php else: ?>
                        <div class="nav">
                            <a class="nav-link" href="<?= base_url('login') ?>">Login</a>
                        </div>
                    <?php endif; ?>
                </div>
            </div>
            <?php
            $username = $session->get('username') ?? '';
            $role = $session->get('role') ?? '';
            ?>
            <div class="sb-sidenav-footer">
                <div class="small">Logged in as:</div>
                <?php
                $username = $session->get('username') ?? 'Guest';
                $role = $session->get('role') ?? 'Guest';
                ?>
                <?= ucfirst($username) ?> (<?= ucfirst($role) ?>)
            </div>
        </nav>
    </div>
</div>