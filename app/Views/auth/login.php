<!-- login.php -->
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <title>Login</title>
    <!-- Link CSS -->
    <link rel="stylesheet" href="<?= base_url('css/login.css') ?>">
</head>

<body>
    <div class="login-container">
        <h1>Login</h1>
        <!-- Tampilkan pesan error jika ada -->
        <?php if (session()->getFlashdata('error')): ?>
            <div class="error-message">
                <?= session()->getFlashdata('error') ?>
            </div>
        <?php endif; ?>
        <form action="<?= base_url('login') ?>" method="post">
            <?= csrf_field() ?>
            <div>
                <label for="username">Username</label>
                <input type="text" name="username" id="username" value="<?= old('username') ?>" required>
            </div>
            <div>
                <label for="password">Password</label>
                <input type="password" name="password" id="password" required>
            </div>
            <button type="submit">Login</button>
            <!-- Tambahkan link jika diperlukan -->
            <!-- <a href="<?= base_url('register') ?>">Belum punya akun? Daftar di sini</a> -->
        </form>
    </div>
    <!-- Menyertakan JavaScript -->
    <script src="<?= base_url('js/login.js') ?>"></script>
</body>

</html>