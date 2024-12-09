<?php $session = session(); ?>
<nav class="sb-topnav navbar navbar-expand navbar-dark bg-dark">
    <!-- Navbar Brand-->
    <a class="navbar-brand ps-3" href="<?= base_url() ?>">SB Admin</a>
    <!-- Sidebar Toggle-->
    <button class="btn btn-link btn-sm order-1 order-lg-0 me-4 me-lg-0" id="sidebarToggle" href="#!">
        <i class="fas fa-bars"></i>
    </button>
    <!-- Navbar Search-->
    <form class="d-none d-md-inline-block form-inline ms-auto me-0 me-md-3 my-2 my-md-0">
        <div class="input-group">
            <input class="form-control" type="text" placeholder="Search for..." aria-label="Search for..."
                aria-describedby="btnNavbarSearch" />
            <button class="btn btn-primary" id="btnNavbarSearch" type="button">
                <i class="fas fa-search"></i>
            </button>
        </div>
    </form>
    <!-- Navbar-->
    <ul class="navbar-nav ms-auto ms-md-0 me-3 me-lg-4">
        <?php if ($session->get('logged_in')): ?>
            <?php
            $username = $session->get('username') ?? 'User';
            $role = $session->get('role') ?? '';
            ?>
            <li class="nav-item dropdown">
                <a class="nav-link dropdown-toggle" id="userDropdown" href="#" role="button" data-bs-toggle="dropdown"
                    aria-expanded="false">
                    <?= ucfirst($username) ?>     <?= $role ? '(' . ucfirst($role) . ')' : '' ?>
                </a>
                <ul class="dropdown-menu dropdown-menu-end" aria-labelledby="userDropdown">
                    <li><a class="dropdown-item" href="#!">Settings</a></li>
                    <li><a class="dropdown-item" href="#!">Activity Log</a></li>
                    <li>
                        <hr class="dropdown-divider">
                    </li>
                    <li><a class="dropdown-item" href="<?= base_url('logout') ?>">Logout</a></li>
                </ul>
            </li>
        <?php else: ?>
            <!-- Jika belum login -->
            <li class="nav-item">
                <a class="nav-link" href="<?= base_url('login') ?>">Login</a>
            </li>
        <?php endif; ?>
    </ul>
</nav>