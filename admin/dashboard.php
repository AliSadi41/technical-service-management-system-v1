<?php
require_once '../includes/config.php';
require_once 'auth.php';
$page_title = 'Dashboard';

// İstatistikler
try {
    $toplam_fiyat    = db()->query("SELECT COUNT(*) FROM fiyatlar WHERE aktif=1")->fetchColumn();
    $toplam_hizmet   = db()->query("SELECT COUNT(*) FROM hizmetler WHERE aktif=1")->fetchColumn();
    $toplam_mesaj    = db()->query("SELECT COUNT(*) FROM mesajlar")->fetchColumn();
    $okunmayan_mesaj = db()->query("SELECT COUNT(*) FROM mesajlar WHERE okundu=0")->fetchColumn();
    $son_mesajlar    = db()->query("SELECT * FROM mesajlar ORDER BY created_at DESC LIMIT 5")->fetchAll();
} catch (Exception $e) {
    $toplam_fiyat = $toplam_hizmet = $toplam_mesaj = $okunmayan_mesaj = 0;
    $son_mesajlar = [];
}

include 'sidebar.php';
?>

<div class="admin-main">
    <!-- Topbar -->
    <div class="admin-topbar">
        <h1>Dashboard</h1>
        <div style="display:flex;align-items:center;gap:12px;">
            <span style="color:var(--gri);font-size:13px;font-family:var(--font-kalin);">
                <i class="fas fa-user" style="color:var(--kirmizi);"></i>
                <?= htmlspecialchars($_SESSION['admin_kadi']) ?>
            </span>
            <a href="cikis.php" style="color:var(--kirmizi);font-size:13px;font-family:var(--font-kalin);">
                <i class="fas fa-sign-out-alt"></i> Çıkış
            </a>
        </div>
    </div>

    <!-- İstatistik Kartları -->
    <div class="row g-3 mb-4">
        <div class="col-lg-3 col-md-6">
            <div class="stat-card">
                <div class="stat-card-icon"><i class="fas fa-tags"></i></div>
                <h3><?= $toplam_fiyat ?></h3>
                <p>Aktif Fiyat</p>
            </div>
        </div>
        <div class="col-lg-3 col-md-6">
            <div class="stat-card">
                <div class="stat-card-icon"><i class="fas fa-tools"></i></div>
                <h3><?= $toplam_hizmet ?></h3>
                <p>Aktif Hizmet</p>
            </div>
        </div>
        <div class="col-lg-3 col-md-6">
            <div class="stat-card">
                <div class="stat-card-icon"><i class="fas fa-envelope"></i></div>
                <h3><?= $toplam_mesaj ?></h3>
                <p>Toplam Mesaj</p>
            </div>
        </div>
        <div class="col-lg-3 col-md-6">
            <div class="stat-card" style="border-color:<?= $okunmayan_mesaj > 0 ? 'var(--kirmizi)' : '' ?>;">
                <div class="stat-card-icon"><i class="fas fa-bell"></i></div>
                <h3><?= $okunmayan_mesaj ?></h3>
                <p>Okunmayan Mesaj</p>
            </div>
        </div>
    </div>

    <!-- Hızlı İşlemler -->
    <div class="row g-3 mb-4">
        <div class="col-12">
            <div class="admin-form-card">
                <h5 style="color:#fff;margin-bottom:16px;font-size:1rem;">
                    <i class="fas fa-bolt" style="color:var(--kirmizi);"></i> Hızlı İşlemler
                </h5>
                <div class="d-flex flex-wrap gap-3">
                    <a href="fiyatlar.php?action=ekle" class="btn-red" style="font-size:13px;padding:9px 18px;">
                        <i class="fas fa-plus"></i> Fiyat Ekle
                    </a>
                    <a href="mesajlar.php" class="btn-outline-red" style="font-size:13px;padding:9px 18px;">
                        <i class="fas fa-envelope"></i> Mesajları Gör
                    </a>
                    <a href="../index.php" target="_blank" class="btn-outline-red" style="font-size:13px;padding:9px 18px;border-color:var(--gri);color:var(--gri-acik);">
                        <i class="fas fa-eye"></i> Siteyi Görüntüle
                    </a>
                </div>
            </div>
        </div>
    </div>

    <!-- Son Mesajlar -->
    <div class="admin-form-card">
        <div class="d-flex justify-content-between align-items-center mb-4">
            <h5 style="color:#fff;margin:0;font-size:1rem;">
                <i class="fas fa-envelope" style="color:var(--kirmizi);"></i> Son Mesajlar
            </h5>
            <a href="mesajlar.php" style="color:var(--kirmizi);font-size:13px;font-family:var(--font-kalin);">
                Tümünü Gör <i class="fas fa-arrow-right"></i>
            </a>
        </div>
        <?php if (!empty($son_mesajlar)): ?>
        <div style="overflow-x:auto;">
            <table class="admin-table">
                <thead>
                    <tr>
                        <th>Ad Soyad</th>
                        <th>Telefon</th>
                        <th>Mesaj</th>
                        <th>Tarih</th>
                        <th>Durum</th>
                    </tr>
                </thead>
                <tbody>
                    <?php foreach ($son_mesajlar as $m): ?>
                    <tr>
                        <td style="color:#ddd;"><?= htmlspecialchars($m['ad_soyad']) ?></td>
                        <td><?= htmlspecialchars($m['telefon'] ?? '-') ?></td>
                        <td style="max-width:220px;white-space:nowrap;overflow:hidden;text-overflow:ellipsis;">
                            <?= htmlspecialchars(mb_substr($m['mesaj'], 0, 60)) ?>...
                        </td>
                        <td style="font-size:12px;color:var(--gri);">
                            <?= date('d.m.Y H:i', strtotime($m['created_at'])) ?>
                        </td>
                        <td>
                            <?php if ($m['okundu']): ?>
                            <span style="background:rgba(22,163,74,0.12);color:#4ade80;font-size:11px;padding:3px 8px;border-radius:10px;font-family:var(--font-kalin);">Okundu</span>
                            <?php else: ?>
                            <span style="background:rgba(224,16,32,0.12);color:var(--kirmizi);font-size:11px;padding:3px 8px;border-radius:10px;font-family:var(--font-kalin);">Yeni</span>
                            <?php endif; ?>
                        </td>
                    </tr>
                    <?php endforeach; ?>
                </tbody>
            </table>
        </div>
        <?php else: ?>
        <p style="color:var(--gri);font-size:14px;text-align:center;padding:20px 0;">
            <i class="fas fa-inbox" style="font-size:2rem;display:block;margin-bottom:10px;"></i>
            Henüz mesaj bulunmuyor.
        </p>
        <?php endif; ?>
    </div>
</div>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
