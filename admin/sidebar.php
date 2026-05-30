<?php

$admin_page = basename($_SERVER['PHP_SELF'], '.php');
?>
<!DOCTYPE html>
<html lang="tr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?= isset($page_title) ? htmlspecialchars($page_title) . ' | ' : '' ?>Admin – Sadi Teknik Servis</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css">
    <link href="https://fonts.googleapis.com/css2?family=Bebas+Neue&family=Barlow:wght@300;400;600;700&family=Barlow+Condensed:wght@500;700&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="../assets/css/style.css">
    <style> body { padding-top: 0 !important; } </style>
</head>
<body class="admin-body">

<div class="admin-sidebar">
    <div class="admin-sidebar-logo">
        <a href="dashboard.php">
            <i class="fas fa-snowflake"></i>
            <span>SADİ TEKNİK</span>
        </a>
    </div>

    <nav class="admin-nav">
        <div class="admin-nav-label">Genel</div>
        <a href="dashboard.php" class="<?= $admin_page==='dashboard' ? 'active' : '' ?>">
            <i class="fas fa-tachometer-alt"></i> Dashboard
        </a>

        <div class="admin-nav-label">Yönetim</div>
        <a href="fiyatlar.php" class="<?= $admin_page==='fiyatlar' ? 'active' : '' ?>">
            <i class="fas fa-tags"></i> Fiyat Yönetimi
        </a>
        <a href="hizmetler.php" class="<?= $admin_page==='hizmetler' ? 'active' : '' ?>">
            <i class="fas fa-tools"></i> Hizmet Yönetimi
        </a>
        <a href="mesajlar.php" class="<?= $admin_page==='mesajlar' ? 'active' : '' ?>">
            <i class="fas fa-envelope"></i> Mesajlar
            <?php
            try {
                $okunmayanlar = \db()->query("SELECT COUNT(*) FROM mesajlar WHERE okundu=0")->fetchColumn();
                if ($okunmayanlar > 0) echo "<span style='background:var(--kirmizi);color:#fff;border-radius:10px;padding:1px 7px;font-size:11px;margin-left:auto;'>$okunmayanlar</span>";
            } catch(Exception $e) {}
            ?>
        </a>

        <div class="admin-nav-label">Hesap</div>
        <a href="sifre-degistir.php" class="<?= $admin_page==='sifre-degistir' ? 'active' : '' ?>">
            <i class="fas fa-key"></i> Şifre Değiştir
        </a>
        <a href="../index.php" target="_blank">
            <i class="fas fa-external-link-alt"></i> Siteyi Görüntüle
        </a>
        <a href="cikis.php" style="margin-top:auto;">
            <i class="fas fa-sign-out-alt"></i> Çıkış Yap
        </a>
    </nav>
</div>
