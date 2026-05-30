<?php
require_once '../includes/config.php';
require_once 'auth.php';
$page_title = 'Şifre Değiştir';

$basari = $hata = '';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $mevcut = $_POST['mevcut_sifre']  ?? '';
    $yeni   = $_POST['yeni_sifre']    ?? '';
    $tekrar = $_POST['yeni_tekrar']   ?? '';

    $stmt = db()->prepare("SELECT sifre FROM admin WHERE id=?");
    $stmt->execute([$_SESSION['admin_id']]);
    $admin = $stmt->fetch();

    if (!password_verify($mevcut, $admin['sifre'])) {
        $hata = 'Mevcut şifre hatalı.';
    } elseif (strlen($yeni) < 6) {
        $hata = 'Yeni şifre en az 6 karakter olmalıdır.';
    } elseif ($yeni !== $tekrar) {
        $hata = 'Yeni şifre tekrarı eşleşmiyor.';
    } else {
        $hash = password_hash($yeni, PASSWORD_DEFAULT);
        db()->prepare("UPDATE admin SET sifre=? WHERE id=?")->execute([$hash, $_SESSION['admin_id']]);
        $basari = 'Şifreniz başarıyla güncellendi.';
    }
}

include 'sidebar.php';
?>

<div class="admin-main">
    <div class="admin-topbar"><h1>Şifre Değiştir</h1></div>

    <?php if ($basari): ?>
    <div class="alert-success-custom mb-4"><i class="fas fa-check-circle"></i> <?= $basari ?></div>
    <?php endif; ?>
    <?php if ($hata): ?>
    <div class="alert-error-custom mb-4"><i class="fas fa-exclamation-circle"></i> <?= $hata ?></div>
    <?php endif; ?>

    <div class="row justify-content-center">
        <div class="col-lg-5">
            <div class="admin-form-card">
                <h5 style="color:#fff;margin-bottom:24px;"><i class="fas fa-key" style="color:var(--kirmizi);margin-right:8px;"></i>Şifre Güncelle</h5>
                <form method="POST">
                    <div class="mb-3">
                        <label>Mevcut Şifre</label>
                        <input type="password" class="form-control" name="mevcut_sifre" required>
                    </div>
                    <div class="mb-3">
                        <label>Yeni Şifre</label>
                        <input type="password" class="form-control" name="yeni_sifre" required minlength="6">
                    </div>
                    <div class="mb-4">
                        <label>Yeni Şifre Tekrar</label>
                        <input type="password" class="form-control" name="yeni_tekrar" required minlength="6">
                    </div>
                    <button type="submit" class="btn-red w-100 justify-content-center">
                        <i class="fas fa-save"></i> Şifreyi Güncelle
                    </button>
                </form>
            </div>
        </div>
    </div>
</div>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
