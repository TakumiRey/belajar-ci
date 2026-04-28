<?= $this->extend('layout') ?>
<?= $this->section('content') ?>
<div class="card">
    <div class="card-body">
        <h3 class="card-title">Profil Pengguna</h3>
        <ul>
            <li><strong>Username:</strong> <?= session()->get('username'); ?></li>
            <li><strong>Role:</strong> <?= session()->get('role'); ?></li>
            <li><strong>Email:</strong> <?= session()->get('email'); ?></li>
            <li><strong>Waktu Login:</strong> <?= session()->get('waktu_login'); ?></li>
            <li><strong>Status Login:</strong> <?= session()->get('isLoggedIn') ? 'Sudah Login' : 'Belum Login'; ?></li>
        </ul>
    </div>
</div>
<?= $this->endSection() ?>