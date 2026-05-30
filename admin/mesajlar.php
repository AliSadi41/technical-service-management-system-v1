<?php
require_once '../includes/config.php';
require_once 'auth.php';
$page_title = 'Mesajlar';

$sil_id = isset($_GET['sil']) ? (int)$_GET['id'] : 0;
$oku_id = isset($_GET['oku']) ? (int)$_GET['id'] : 0;
$basari = '';

if ($sil_id) {
    db()->prepare("DELETE FROM mesajlar WHERE id=?")->execute([$sil_id]);
    $basari = 'Mesaj silindi.';
}
if ($oku_id) {
    db()->prepare("UPDATE mesajlar SET okundu=1 WHERE id=?")->execute([$oku_id]);
}

$mesajlar = db()->query("SELECT * FROM mesajlar ORDER BY created_at DESC")->fetchAll();


$detay_id = isset($_GET['detay']) ? (int)$_GET['id'] : 0;
$detay = null;
if ($detay_id) {
    $stmt = db()->prepare("SELECT * FROM mesajlar WHERE id=?");
    $stmt->execute([$detay_id]);
    $detay = $stmt->fetch();
    if ($detay) {
        db()->prepare("UPDATE mesajlar SET okundu=1 WHERE id=?")->execute([$detay_id]);
    }
}

include 'sidebar.php';
?>

<div class="admin-main">
    <div class="admin-topbar">
        <h1>Mesajlar</h1>
    </div>

    <?php if ($basari): ?>
    <div class="alert-success-custom mb-4"><i class="fas fa-check-circle"></i> <?= $basari ?></div>
    <?php endif; ?>

    <?php if ($detay): ?>
    <div class="admin-form-card mb-4">
        <div class="d-flex justify-content-between align-items-start mb-3">
            <h5 style="color:#fff;margin:0;">Mesaj Detayı</h5>
            <a href="mesajlar.php" style="color:var(--gri);font-size:13px;"><i class="fas fa-times"></i> Kapat</a>
        </div>
        <div style="background:#111;border-radius:var(--radius);padding:20px;border:1px solid rgba(224,16,32,0.1);">
            <div class="row g-3 mb-3">
                <div class="col-md-4">
                    <small style="color:var(--gri);font-family:var(--font-kalin);letter-spacing:0.08em;text-transform:uppercase;font-size:11px;">Ad Soyad</small>
                    <div style="color:#ddd;margin-top:4px;"><?= htmlspecialchars($detay['ad_soyad']) ?></div>
                </div>
                <div class="col-md-4">
                    <small style="color:var(--gri);font-family:var(--font-kalin);letter-spacing:0.08em;text-transform:uppercase;font-size:11px;">Telefon</small>
                    <div style="color:#ddd;margin-top:4px;">
                        <?php if ($detay['telefon']): ?>
                        <a href="tel:<?= $detay['telefon'] ?>" style="color:var(--kirmizi);"><?= htmlspecialchars($detay['telefon']) ?></a>
                        <?php else: echo '-'; endif; ?>
                    </div>
                </div>
                <div class="col-md-4">
                    <small style="color:var(--gri);font-family:var(--font-kalin);letter-spacing:0.08em;text-transform:uppercase;font-size:11px;">Tarih</small>
                    <div style="color:#ddd;margin-top:4px;"><?= date('d.m.Y H:i', strtotime($detay['created_at'])) ?></div>
                </div>
            </div>
            <small style="color:var(--gri);font-family:var(--font-kalin);letter-spacing:0.08em;text-transform:uppercase;font-size:11px;">Mesaj</small>
            <div style="color:#ddd;margin-top:8px;line-height:1.8;white-space:pre-wrap;"><?= htmlspecialchars($detay['mesaj']) ?></div>
        </div>
        <?php if ($detay['telefon']): ?>
        <div class="mt-3 d-flex gap-3">
            <a href="tel:<?= $detay['telefon'] ?>" class="btn-red" style="font-size:13px;padding:9px 18px;">
                <i class="fas fa-phone"></i> Geri Ara
            </a>
            <a href="https://wa.me/90<?= preg_replace('/[^0-9]/', '', $detay['telefon']) ?>" target="_blank" class="btn-outline-red" style="font-size:13px;padding:9px 18px;border-color:#25D366;color:#25D366;">
                <i class="fab fa-whatsapp"></i> WhatsApp
            </a>
        </div>
        <?php endif; ?>
    </div>
    <?php endif; ?>

    <div class="admin-form-card">
        <h5 style="color:#fff;margin-bottom:20px;font-size:1rem;">
            <i class="fas fa-inbox" style="color:var(--kirmizi);"></i> Tüm Mesajlar (<?= count($mesajlar) ?>)
        </h5>
        <?php if (!empty($mesajlar)): ?>
        <div style="overflow-x:auto;">
            <table class="admin-table">
                <thead>
                    <tr>
                        <th>#</th>
                        <th>Ad Soyad</th>
                        <th>Telefon</th>
                        <th>Mesaj Önizleme</th>
                        <th>Tarih</th>
                        <th>Durum</th>
                        <th>İşlemler</th>
                    </tr>
                </thead>
                <tbody>
                    <?php foreach ($mesajlar as $i => $m): ?>
                    <tr style="<?= !$m['okundu'] ? 'background:rgba(224,16,32,0.04);' : '' ?>">
                        <td><?= $i+1 ?></td>
                        <td style="color:<?= !$m['okundu'] ? '#fff' : '#ccc' ?>;font-weight:<?= !$m['okundu'] ? '700' : '400' ?>;">
                            <?= htmlspecialchars($m['ad_soyad']) ?>
                        </td>
                        <td style="font-size:13px;"><?= htmlspecialchars($m['telefon'] ?? '-') ?></td>
                        <td style="font-size:13px;max-width:200px;white-space:nowrap;overflow:hidden;text-overflow:ellipsis;">
                            <?= htmlspecialchars(mb_substr($m['mesaj'],0,60)) ?>
                        </td>
                        <td style="font-size:12px;color:var(--gri);"><?= date('d.m.Y H:i', strtotime($m['created_at'])) ?></td>
                        <td>
                            <?php if ($m['okundu']): ?>
                            <span style="background:rgba(22,163,74,0.1);color:#4ade80;font-size:11px;padding:3px 8px;border-radius:10px;font-family:var(--font-kalin);">Okundu</span>
                            <?php else: ?>
                            <span style="background:rgba(224,16,32,0.12);color:var(--kirmizi);font-size:11px;padding:3px 8px;border-radius:10px;font-family:var(--font-kalin);">Yeni</span>
                            <?php endif; ?>
                        </td>
                        <td>
                            <div style="display:flex;gap:8px;">
                                <a href="?detay&id=<?= $m['id'] ?>" style="color:var(--kirmizi);font-size:14px;" title="Görüntüle"><i class="fas fa-eye"></i></a>
                                <a href="?sil&id=<?= $m['id'] ?>" class="btn-delete-confirm" style="color:var(--gri);font-size:14px;" title="Sil"><i class="fas fa-trash"></i></a>
                            </div>
                        </td>
                    </tr>
                    <?php endforeach; ?>
                </tbody>
            </table>
        </div>
        <?php else: ?>
        <p style="color:var(--gri);text-align:center;padding:30px 0;">Henüz mesaj bulunmuyor.</p>
        <?php endif; ?>
    </div>
</div>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>
<script src="../assets/js/main.js"></script>
</body>
</html>
