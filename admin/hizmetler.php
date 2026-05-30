<?php
require_once '../includes/config.php';
require_once 'auth.php';
$page_title = 'Hizmet Yönetimi';

$basari = $hata = '';
$action  = $_GET['action']  ?? 'liste';
$edit_id = isset($_GET['id']) ? (int)$_GET['id'] : 0;

if ($action === 'sil' && $edit_id) {
    try {
        db()->prepare("DELETE FROM hizmetler WHERE id=?")->execute([$edit_id]);
        $basari = 'Hizmet silindi.';
        $action = 'liste';
    } catch (Exception $e) {
        $hata = 'Silme başarısız.';
        $action = 'liste';
    }
}

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $hizmet_adi = trim($_POST['hizmet_adi'] ?? '');
    $aciklama   = trim($_POST['aciklama']   ?? '');
    $slug       = trim($_POST['slug']       ?? '');
    $sira       = (int)($_POST['sira']      ?? 0);
    $aktif      = isset($_POST['aktif']) ? 1 : 0;
    $pid        = (int)($_POST['pid']       ?? 0);

    if (empty($hizmet_adi) || empty($slug)) {
        $hata   = 'Hizmet adı ve slug zorunludur.';
        $action = $pid ? 'duzenle' : 'ekle';
        $edit_id = $pid;
    } else {
        try {
            if ($pid) {
                db()->prepare("UPDATE hizmetler SET hizmet_adi=?,aciklama=?,slug=?,sira=?,aktif=? WHERE id=?")
                     ->execute([$hizmet_adi, $aciklama, $slug, $sira, $aktif, $pid]);
                $basari = 'Hizmet güncellendi.';
            } else {
                db()->prepare("INSERT INTO hizmetler (hizmet_adi,aciklama,slug,sira,aktif) VALUES (?,?,?,?,?)")
                     ->execute([$hizmet_adi, $aciklama, $slug, $sira, $aktif]);
                $basari = 'Hizmet eklendi.';
            }
            $action = 'liste';
        } catch (Exception $e) {
            $hata = 'Kayıt başarısız: ' . $e->getMessage();
        }
    }
}

$hizmetler   = db()->query("SELECT * FROM hizmetler ORDER BY sira,id")->fetchAll();
$duzenlenen  = null;
if ($edit_id) {
    $s = db()->prepare("SELECT * FROM hizmetler WHERE id=?");
    $s->execute([$edit_id]);
    $duzenlenen = $s->fetch();
}

include 'sidebar.php';
?>

<div class="admin-main">
    <div class="admin-topbar">
        <h1>Hizmet Yönetimi</h1>
        <a href="?action=ekle" class="btn-red" style="font-size:13px;padding:9px 18px;">
            <i class="fas fa-plus"></i> Yeni Hizmet Ekle
        </a>
    </div>

    <?php if ($basari): ?>
    <div class="alert-success-custom mb-4"><i class="fas fa-check-circle"></i> <?= $basari ?></div>
    <?php endif; ?>
    <?php if ($hata): ?>
    <div class="alert-error-custom mb-4"><i class="fas fa-exclamation-circle"></i> <?= $hata ?></div>
    <?php endif; ?>

    <?php if ($action === 'ekle' || $action === 'duzenle'): ?>
    <div class="admin-form-card mb-4">
        <h5 style="color:#fff;margin-bottom:20px;">
            <?= $action==='ekle' ? 'Yeni Hizmet Ekle' : 'Hizmet Düzenle' ?>
        </h5>
        <form method="POST">
            <input type="hidden" name="pid" value="<?= $duzenlenen['id'] ?? 0 ?>">
            <div class="row g-3">
                <div class="col-md-5">
                    <label>Hizmet Adı *</label>
                    <input type="text" class="form-control" name="hizmet_adi" required
                           value="<?= htmlspecialchars($duzenlenen['hizmet_adi'] ?? '') ?>">
                </div>
                <div class="col-md-4">
                    <label>Slug * (URL: hizmet.php?slug=...)</label>
                    <input type="text" class="form-control" name="slug" required
                           placeholder="ornek-hizmet-adi"
                           value="<?= htmlspecialchars($duzenlenen['slug'] ?? '') ?>">
                </div>
                <div class="col-md-3">
                    <label>Sıra</label>
                    <input type="number" class="form-control" name="sira" min="0"
                           value="<?= $duzenlenen['sira'] ?? 0 ?>">
                </div>
                <div class="col-12">
                    <label>Açıklama</label>
                    <textarea class="form-control" name="aciklama" rows="3"><?= htmlspecialchars($duzenlenen['aciklama'] ?? '') ?></textarea>
                </div>
                <div class="col-12">
                    <div class="form-check">
                        <input class="form-check-input" type="checkbox" name="aktif" id="aktif"
                               <?= (!isset($duzenlenen) || $duzenlenen['aktif']) ? 'checked' : '' ?>>
                        <label class="form-check-label" for="aktif" style="color:var(--gri-acik);font-family:var(--font-kalin);font-size:13px;">Aktif</label>
                    </div>
                </div>
                <div class="col-12 d-flex gap-3">
                    <button type="submit" class="btn-red"><i class="fas fa-save"></i> Kaydet</button>
                    <a href="hizmetler.php" class="btn-outline-red">İptal</a>
                </div>
            </div>
        </form>
    </div>
    <?php endif; ?>

    <div class="admin-form-card">
        <h5 style="color:#fff;margin-bottom:20px;font-size:1rem;">
            <i class="fas fa-tools" style="color:var(--kirmizi);"></i> Hizmet Listesi
        </h5>
        <div style="overflow-x:auto;">
            <table class="admin-table">
                <thead>
                    <tr><th>#</th><th>Hizmet Adı</th><th>Slug</th><th>Sıra</th><th>Durum</th><th>İşlemler</th></tr>
                </thead>
                <tbody>
                    <?php foreach ($hizmetler as $i => $h): ?>
                    <tr>
                        <td><?= $i+1 ?></td>
                        <td style="color:#ddd;"><?= htmlspecialchars($h['hizmet_adi']) ?></td>
                        <td style="font-size:12px;color:var(--gri);"><?= htmlspecialchars($h['slug']) ?></td>
                        <td><?= $h['sira'] ?></td>
                        <td>
                            <?php if ($h['aktif']): ?>
                            <span style="background:rgba(22,163,74,0.1);color:#4ade80;font-size:11px;padding:3px 8px;border-radius:10px;font-family:var(--font-kalin);">Aktif</span>
                            <?php else: ?>
                            <span style="background:rgba(255,255,255,0.05);color:var(--gri);font-size:11px;padding:3px 8px;border-radius:10px;font-family:var(--font-kalin);">Pasif</span>
                            <?php endif; ?>
                        </td>
                        <td>
                            <div style="display:flex;gap:8px;">
                                <a href="?action=duzenle&id=<?= $h['id'] ?>" style="color:var(--kirmizi);font-size:14px;"><i class="fas fa-edit"></i></a>
                                <a href="?action=sil&id=<?= $h['id'] ?>" class="btn-delete-confirm" style="color:var(--gri);font-size:14px;"><i class="fas fa-trash"></i></a>
                            </div>
                        </td>
                    </tr>
                    <?php endforeach; ?>
                </tbody>
            </table>
        </div>
    </div>
</div>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>
<script src="../assets/js/main.js"></script>
</body>
</html>
