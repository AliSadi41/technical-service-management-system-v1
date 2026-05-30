<?php

require_once 'includes/config.php';
$page_title = 'Fiyat Listesi';

try {
    $fiyatlar = db()->query("SELECT * FROM fiyatlar WHERE aktif=1 ORDER BY id")->fetchAll();
} catch (Exception $e) {
    $fiyatlar = [];
}

include 'includes/header.php';
?>

<div class="page-header">
    <div class="container">
        <nav aria-label="breadcrumb" class="breadcrumb-custom mb-3">
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="index.php">Anasayfa</a></li>
                <li class="breadcrumb-item active">Fiyat Listesi</li>
            </ol>
        </nav>
        <h1>FİYAT <span>LİSTESİ</span></h1>
    </div>
</div>

<section class="section-pad">
    <div class="container">
        <div class="section-title fade-up">
            <h2>HİZMET <span>FİYATLARIMIZ</span></h2>
            <p>Tüm fiyatlarımız başlangıç fiyatı olup işin kapsamına göre değişebilir. Kesin fiyat için bizi arayın.</p>
        </div>

        <!-- Fiyat Tablosu -->
        <div class="fade-up" style="overflow-x:auto;">
            <table class="price-table">
                <thead>
                    <tr>
                        <th>#</th>
                        <th>Hizmet Adı</th>
                        <th>Fiyat</th>
                        <th>Birim</th>
                        <th>Açıklama</th>
                        <th>İşlem</th>
                    </tr>
                </thead>
                <tbody>
                    <?php if (!empty($fiyatlar)): ?>
                    <?php foreach ($fiyatlar as $i => $f): ?>
                    <tr>
                        <td style="color:var(--gri);font-size:13px;"><?= $i+1 ?></td>
                        <td><?= htmlspecialchars($f['hizmet_adi']) ?></td>
                        <td><span class="price-badge"><?= number_format($f['fiyat'], 0, ',', '.') ?> ₺</span></td>
                        <td style="font-size:13px;color:var(--gri);"><?= htmlspecialchars($f['birim']) ?></td>
                        <td style="font-size:13px;color:var(--gri-koyu);"><?= htmlspecialchars($f['aciklama'] ?? '') ?></td>
                        <td>
                            <a href="iletisim.php" class="btn-red" style="padding:7px 14px;font-size:12px;">
                                <i class="fas fa-phone"></i> Randevu
                            </a>
                        </td>
                    </tr>
                    <?php endforeach; ?>
                    <?php else: ?>
                    <!-- Statik fallback -->
                    <?php
                    $statik = [
                        ['hizmet_adi'=>'Klima Bakımı','fiyat'=>1000,'birim'=>'Başlangıç Fiyatı','aciklama'=>'Filtre temizliği, iç/dış ünite kontrolü, performans testi'],
                        ['hizmet_adi'=>'Klima Tamiri','fiyat'=>1500,'birim'=>'Başlangıç Fiyatı','aciklama'=>'Arıza tespiti ve onarımı, yedek parça hariç'],
                        ['hizmet_adi'=>'Klima Montajı','fiyat'=>4500,'birim'=>'Başlangıç Fiyatı','aciklama'=>'Standart montaj, malzeme dahil'],
                        ['hizmet_adi'=>'Klima Gaz Dolumu','fiyat'=>2500,'birim'=>'Başlangıç Fiyatı','aciklama'=>'Orijinal soğutucu gaz ile şarj'],
                        ['hizmet_adi'=>'Petek Temizliği','fiyat'=>2000,'birim'=>'Başlangıç Fiyatı','aciklama'=>'Kimyasal temizlik, basınçlı yıkama'],
                    ];
                    foreach ($statik as $i => $f): ?>
                    <tr>
                        <td style="color:var(--gri);font-size:13px;"><?= $i+1 ?></td>
                        <td><?= $f['hizmet_adi'] ?></td>
                        <td><span class="price-badge"><?= number_format($f['fiyat'], 0, ',', '.') ?> ₺</span></td>
                        <td style="font-size:13px;color:var(--gri);"><?= $f['birim'] ?></td>
                        <td style="font-size:13px;color:var(--gri-koyu);"><?= $f['aciklama'] ?></td>
                        <td>
                            <a href="iletisim.php" class="btn-red" style="padding:7px 14px;font-size:12px;">
                                <i class="fas fa-phone"></i> Randevu
                            </a>
                        </td>
                    </tr>
                    <?php endforeach; endif; ?>
                </tbody>
            </table>
        </div>

        <!-- Not -->
        <div class="fade-up mt-5 p-4" style="background:rgba(224,16,32,0.06);border:1px solid rgba(224,16,32,0.2);border-left:4px solid var(--kirmizi);border-radius:var(--radius);">
            <h6 style="font-family:var(--font-kalin);letter-spacing:0.06em;text-transform:uppercase;color:var(--kirmizi);margin-bottom:10px;">
                <i class="fas fa-info-circle"></i> Önemli Bilgi
            </h6>
            <p style="font-size:14.5px;color:var(--gri-koyu);margin:0;line-height:1.8;">
                Yukarıdaki fiyatlar <strong>başlangıç fiyatlarıdır</strong> ve işin kapsamına, kullanılacak parça ve malzemelere göre değişebilir.
                Kesin fiyat teklifi için lütfen bizi arayın ya da WhatsApp'tan iletişime geçin. Uzak mesafeler için servis bedeli uygulanabilir.
            </p>
        </div>
    </div>
</section>

<!-- CTA -->
<section class="cta-section">
    <div class="container text-center fade-up">
        <h2>RANDEVU <span style="color:var(--kirmizi)">ALIN</span></h2>
        <p>Fiyat ve randevu için hemen ulaşın.</p>
        <div class="d-flex justify-content-center flex-wrap gap-3">
            <a href="tel:+905300749206" class="btn-red"><i class="fas fa-phone"></i> <?= SITE_TEL ?></a>
            <a href="<?= WA_LINK ?>" target="_blank" class="btn-outline-red" style="border-color:#25D366;color:#25D366;">
                <i class="fab fa-whatsapp"></i> WhatsApp
            </a>
        </div>
    </div>
</section>

<?php include 'includes/footer.php'; ?>
