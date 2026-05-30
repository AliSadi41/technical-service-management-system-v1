<?php

require_once '../includes/config.php';
require_once 'auth.php';
$page_title = 'Fiyat Yönetimi';

$basari = $hata = '';
$action  = $_GET['action']  ?? 'liste';
$edit_id = isset($_GET['id']) ? (int)$_GET['id'] : 0;


if ($action === 'sil' && $edit_id) {
    try {
        db()->prepare("DELETE FROM fiyatlar WHERE id=?")->execute([$edit_id]);
        $basari = 'Fiyat silindi.';
        $action = 'liste';
    } catch (Exception $e) {
        $hata   = 'Silme işlemi başarısız.';
        $action = 'liste';
    }
}

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $hizmet_adi = trim($_POST['hizmet_adi'] ?? '');
    $fiyat      = str_replace(',', '.', $_POST['fiyat'] ?? '');
    $birim      = trim($_POST['birim']      ?? 'Başlangıç Fiyatı');
    $aciklama   = trim($_POST['aciklama']   ?? '');
    $aktif      = isset($_POST['aktif']) ? 1 : 0;
    $pid        = (int)($_POST['pid']       ?? 0);

    if (empty($hizmet_adi) || !is_numeric($fiyat)) {
        $hata   = 'Hizmet adı ve geçerli bir fiyat giriniz.';
        $action = $pid ? 'duzenle' : 'ekle';
        $edit_id = $pid;
    } else {
        try {
            if ($pid) {
                db()->prepare("UPDATE fiyatlar SET hizmet_adi=?,fiyat=?,birim=?,aciklama=?,aktif=? WHERE id=?")
                     ->execute([$hizmet_adi, $fiyat, $birim, $aciklama, $aktif, $pid]);
                $basari = 'Fiyat güncellendi.';
            } else {
                db()->prepare("INSERT INTO fiyatlar (hizmet_adi,fiyat,birim,aciklama,aktif) VALUES (?,?,?,?,?)")
                     ->execute([$hizmet_adi, $fiyat, $birim, $aciklama, $aktif]);
                $basari = 'Yeni fiyat eklendi.';
            }
            $action = 'liste';
        } catch (Exception $e) {
            $hata   = 'Kaydetme işlemi başarısız.';
            $action = $pid ? 'duzenle' : 'ekle';
            $edit_id = $pid;
        }
    }
}


$fiyatlar = db()->query("SELECT * FROM fiyatlar ORDER BY id")->fetchAll();
$duzenlenen = $edit_id ? db()->prepare("SELECT * FROM fiyatlar WHERE id=?")->execute([$edit_id]) : null;
if ($edit_id) {
    $stmt = db()->prepare("SELECT * FROM fiyatlar WHERE id=?");
    $stmt->execute([$edit_id]);
    $duzenlenen = $stmt->fetch();
}

include 'sidebar.php';
?>

<div class="admin-main">
    <div class="admin-topbar">
        <h1>Fiyat Yönetimi</h1>
        <a href="?action=ekle" class="btn-red" style="font-size:13px;padding:9px 18px;">
            <i class="fas fa-plus"></i> Yeni Fiyat Ekle
        </a>
    </div>

    <?php if ($basari): ?>
    <div class="alert-success-custom mb-4"><i class="fas fa-check-circle"></i> <?= $basari ?></div>
    <?php endif; ?>
    <?php if ($hata): ?>
    <div class="alert-error-custom mb-4"><i class="fas fa-exclamation-circle"></i> <?= $hata ?></div>
    <?php endif; ?>

    <?php if ($action === 'ekle' || $action === 'duzenle'): ?>
    <!-- FORM -->
    <div class="admin-form-card mb-4">
        <h5 style="color:#fff;margin-bottom:20px;">
            <i class="fas fa-<?= $action==='ekle' ? 'plus' : 'edit' ?>" style="color:var(--kirmizi);"></i>
            <?= $action==='ekle' ? 'Yeni Fiyat Ekle' : 'Fiyatı Düzenle' ?>
        </h5>
        <form method="POST">
            <input type="hidden" name="pid" value="<?= $duzenlenen['id'] ?? 0 ?>">
            <div class="row g-3">
                <div class="col-md-4">
                    <label>Hizmet Adı *</label>
                    <input type="text" class="form-control" name="hizmet_adi" required
                           value="<?= htmlspecialchars($duzenlenen['hizmet_adi'] ?? '') ?>">
                </div>
                <div class="col-md-2">
                    <label>Fiyat (₺) *</label>
                    <input type="number" class="form-control" name="fiyat" step="0.01" min="0" required
                           value="<?= $duzenlenen['fiyat'] ?? '' ?>">
                </div>
                <div class="col-md-2">
                    <label>Birim</label>
                    <input type="text" class="form-control" name="birim"
                           value="<?= htmlspecialchars($duzenlenen['birim'] ?? 'Başlangıç Fiyatı') ?>">
                </div>
                <div class="col-md-4">
                    <label>Açıklama</label>
                    <input type="text" class="form-control" name="aciklama"
                           value="<?= htmlspecialchars($duzenlenen['aciklama'] ?? '') ?>">
                </div>
                <div class="col-12">
                    <div class="form-check">
                        <input class="form-check-input" type="checkbox" name="aktif" id="aktif"
                               <?= (!isset($duzenlenen) || $duzenlenen['aktif']) ? 'checked' : '' ?>>
                        <label class="form-check-label" for="aktif" style="color:var(--gri-acik);font-family:var(--font-kalin);font-size:13px;">Aktif</label>
                    </div>
                </div>
                <div class="col-12 d-flex gap-3">
                    <button type="submit" class="btn-red">
                        <i class="fas fa-save"></i> <?= $action==='ekle' ? 'Ekle' : 'Güncelle' ?>
                    </button>
                    <a href="fiyatlar.php" class="btn-outline-red">İptal</a>
                </div>
            </div>
        </form>
    </div>
    <?php endif; ?>

    <!-- LİSTE -->
    <div class="admin-form-card">
        <h5 style="color:#fff;margin-bottom:20px;font-size:1rem;">
            <i class="fas fa-list" style="color:var(--kirmizi);"></i> Mevcut Fiyatlar
        </h5>
        <div style="overflow-x:auto;">
            <table class="admin-table">
                <thead>
                    <tr>
                        <th>#</th>
                        <th>Hizmet Adı</th>
                        <th>Fiyat</th>
                        <th>Birim</th>
                        <th>Açıklama</th>
                        <th>Durum</th>
                        <th>İşlemler</th>
                    </tr>
                </thead>
                <tbody>
                    <?php foreach ($fiyatlar as $i => $f): ?>
                    <tr>
                        <td><?= $i+1 ?></td>
                        <td style="color:#ddd;font-weight:600;"><?= htmlspecialchars($f['hizmet_adi']) ?></td>
                        <td><span style="color:var(--kirmizi);font-family:var(--font-baslik);font-size:1.2rem;"><?= number_format($f['fiyat'],0,',','.') ?> ₺</span></td>
                        <td style="font-size:12px;color:var(--gri);"><?= htmlspecialchars($f['birim']) ?></td>
                        <td style="font-size:12px;max-width:180px;white-space:nowrap;overflow:hidden;text-overflow:ellipsis;"><?= htmlspecialchars($f['aciklama'] ?? '') ?></td>
                        <td>
                            <?php if ($f['aktif']): ?>
                            <span style="background:rgba(22,163,74,0.12);color:#4ade80;font-size:11px;padding:3px 8px;border-radius:10px;font-family:var(--font-kalin);">Aktif</span>
                            <?php else: ?>
                            <span style="background:rgba(255,255,255,0.06);color:var(--gri);font-size:11px;padding:3px 8px;border-radius:10px;font-family:var(--font-kalin);">Pasif</span>
                            <?php endif; ?>
                        </td>
                        <td>
                            <div style="display:flex;gap:8px;">
                                <a href="?action=duzenle&id=<?= $f['id'] ?>" style="color:var(--kirmizi);font-size:14px;" title="Düzenle"><i class="fas fa-edit"></i></a>
                                <a href="?action=sil&id=<?= $f['id'] ?>" class="btn-delete-confirm" style="color:var(--gri);font-size:14px;" title="Sil"><i class="fas fa-trash"></i></a>
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
