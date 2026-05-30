<?php

require_once '../includes/config.php';

if (session_status() === PHP_SESSION_NONE) session_start();


if (isset($_SESSION['admin_id'])) {
    header('Location: dashboard.php');
    exit;
}

$hata = '';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $kadi  = trim($_POST['kullanici_adi'] ?? '');
    $sifre = $_POST['sifre'] ?? '';

    if (empty($kadi) || empty($sifre)) {
        $hata = 'Kullanıcı adı ve şifre giriniz.';
    } else {
        try {
            $stmt = db()->prepare("SELECT * FROM admin WHERE kullanici_adi = ?");
            $stmt->execute([$kadi]);
            $admin = $stmt->fetch();

            if ($admin && password_verify($sifre, $admin['sifre'])) {
                session_regenerate_id(true);
                $_SESSION['admin_id']   = $admin['id'];
                $_SESSION['admin_kadi'] = $admin['kullanici_adi'];
                header('Location: dashboard.php');
                exit;
            } else {
                $hata = 'Kullanıcı adı veya şifre hatalı.';
            }
        } catch (Exception $e) {
            $hata = 'Veritabanı hatası. Lütfen tekrar deneyin.';
        }
    }
}
?>
<!DOCTYPE html>
<html lang="tr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Girişi | Sadi Teknik Servis</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css">
    <link href="https://fonts.googleapis.com/css2?family=Bebas+Neue&family=Barlow:wght@300;400;600;700&family=Barlow+Condensed:wght@500;700&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="../assets/css/style.css">
    <style>
        body { padding-top:0 !important; }
    </style>
</head>
<body class="admin-body">

<div class="admin-login-wrap">
    <div class="admin-login-card">
        <div class="logo">
            <i class="fas fa-snowflake"></i>
            <h2>SADİ TEKNİK</h2>
            <p>Admin Paneli</p>
        </div>

        <?php if ($hata): ?>
        <div class="alert-error-custom mb-4">
            <i class="fas fa-exclamation-circle"></i> <?= htmlspecialchars($hata) ?>
        </div>
        <?php endif; ?>

        <form method="POST">
            <div class="admin-form-card p-0" style="background:transparent;border:none;">
                <div class="mb-3">
                    <label>Kullanıcı Adı</label>
                    <div class="input-group">
                        <span class="input-group-text" style="background:#1a1a1a;border-color:rgba(255,255,255,0.1);color:var(--kirmizi);">
                            <i class="fas fa-user"></i>
                        </span>
                        <input type="text" class="form-control" name="kullanici_adi"
                               placeholder="admin" autocomplete="username" required
                               value="<?= htmlspecialchars($_POST['kullanici_adi'] ?? '') ?>">
                    </div>
                </div>
                <div class="mb-4">
                    <label>Şifre</label>
                    <div class="input-group">
                        <span class="input-group-text" style="background:#1a1a1a;border-color:rgba(255,255,255,0.1);color:var(--kirmizi);">
                            <i class="fas fa-lock"></i>
                        </span>
                        <input type="password" class="form-control" name="sifre"
                               placeholder="••••••••" autocomplete="current-password" required>
                    </div>
                </div>
                <button type="submit" class="btn-red w-100 justify-content-center" style="padding:13px;">
                    <i class="fas fa-sign-in-alt"></i> Giriş Yap
                </button>
            </div>
        </form>

        <div class="mt-4 text-center">
            <a href="../index.php" style="color:var(--gri);font-size:13px;font-family:var(--font-kalin);">
                <i class="fas fa-arrow-left"></i> Siteye Dön
            </a>
        </div>

        <div class="mt-4 p-3" style="background:rgba(224,16,32,0.08);border-radius:var(--radius);border:1px solid rgba(224,16,32,0.2);">
            <p style="color:var(--gri-acik);font-size:12px;font-family:var(--font-kalin);margin:0;text-align:center;letter-spacing:0.04em;">
                Varsayılan: <strong style="color:#fff;">admin</strong> / <strong style="color:#fff;">password</strong><br>
                <span style="color:var(--kirmizi);">Kurulumdan sonra değiştiriniz!</span>
            </p>
        </div>
    </div>
</div>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
