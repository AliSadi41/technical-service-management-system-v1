<?php
require_once 'includes/config.php';
$page_title = 'Anasayfa';

try {
    $hizmetler = db()->query("SELECT * FROM hizmetler WHERE aktif=1 ORDER BY sira")->fetchAll();
} catch (Exception $e) {
    $hizmetler = [];
}

include 'includes/header.php';
?>

<section class="hero-section">
    <div class="hero-bg"></div>
    <div class="hero-grid-lines"></div>
    <div class="container">
        <div class="row align-items-center g-5">
            <div class="col-lg-7 hero-content">
                <div class="hero-badge fade-up">
                    <i class="fas fa-certificate"></i> 30 Yillik Guvenilir Hizmet
                </div>
                <h1 class="fade-up">
                    KOCAELInin
                    <span>UZMAN TEKNIK</span>
                    SERVISi
                </h1>
                <p class="fade-up">
                    Klima bakim, montaj, gaz dolumu ve petek temizliginde profesyonel cozumler.
                    Izmit ve cevresinde hizli, guvenilir ve uygun fiyatli hizmet sunuyoruz.
                </p>
                <div class="d-flex flex-wrap gap-3 fade-up">
                    <a href="iletisim.php" class="btn-red"><i class="fas fa-phone"></i> Hemen Ara</a>
                    <a href="fiyat-listesi.php" class="btn-outline-red"><i class="fas fa-tags"></i> Fiyat Listesi</a>
                </div>
                <div class="hero-stats fade-up">
                    <div class="hero-stat">
                        <div class="hero-stat-num" data-target="30">0</div>
                        <div class="hero-stat-label">Yil Deneyim</div>
                    </div>
                    <div class="hero-stat">
                        <div class="hero-stat-num" data-target="2500">0</div>
                        <div class="hero-stat-label">Mutlu Musteri</div>
                    </div>
                    <div class="hero-stat">
                        <div class="hero-stat-num" data-target="4">0</div>
                        <div class="hero-stat-label">Hizmet Cesidi</div>
                    </div>
                </div>
            </div>
            <div class="col-lg-5 d-none d-lg-flex justify-content-center">
                <div class="hero-visual">
                    <div class="hero-icon-circle">
                        <div class="hero-orbit"><div class="orbit-dot"></div></div>
                        <i class="fas fa-snowflake"></i>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>

<section class="stats-bar">
    <div class="container">
        <div class="row text-center g-4">
            <div class="col-6 col-md-3"><div class="stat-item"><span class="stat-number" data-target="30">0</span><span class="stat-label">Yil Deneyim</span></div></div>
            <div class="col-6 col-md-3"><div class="stat-item"><span class="stat-number" data-target="2500">0</span><span class="stat-label">Tamamlanan Is</span></div></div>
            <div class="col-6 col-md-3"><div class="stat-item"><span class="stat-number" data-target="98">0</span><span class="stat-label">% Memnuniyet</span></div></div>
            <div class="col-6 col-md-3"><div class="stat-item"><span class="stat-number" data-target="24">0</span><span class="stat-label">Saat Icinde Servis</span></div></div>
        </div>
    </div>
</section>

<section class="section-pad section-gray">
    <div class="container">
        <div class="section-title fade-up">
            <h2>HIZMETLERI<span>MIZ</span></h2>
            <p>Klima ve isitma sistemleriniz icin kapsamli, profesyonel teknik servis cozumleri.</p>
        </div>
        <div class="row g-4">
<?php
$icons = ["fas fa-wind","fas fa-wrench","fas fa-fill-drip","fas fa-fire"];
$i = 0;
foreach ($hizmetler as $h):
?>
            <div class="col-lg-3 col-md-6 fade-up">
                <div class="service-card h-100">
                    <div class="service-card-icon"><i class="<?php echo $icons[$i % 4]; ?>"></i></div>
                    <h4><?php echo htmlspecialchars($h["hizmet_adi"]); ?></h4>
                    <p><?php echo htmlspecialchars(mb_substr($h["aciklama"], 0, 110)); ?>...</p>
                    <a href="hizmet.php?slug=<?php echo $h["slug"]; ?>" class="service-card-link">Detayli Bilgi <i class="fas fa-arrow-right"></i></a>
                </div>
            </div>
<?php $i++; endforeach; ?>
<?php if (empty($hizmetler)): ?>
<?php
$fallback = [
    ["icon"=>"fas fa-wind","title"=>"Klima Bakimi ve Tamiri","desc"=>"Filtre temizligi, ic-dis unite kontrolu, gaz seviyesi olcumu.","slug"=>"klima-bakimi-ve-tamiri"],
    ["icon"=>"fas fa-wrench","title"=>"Klima Montaji","desc"=>"Profesyonel ekibimizle klimanizi hizli ve guvenli monte ediyoruz.","slug"=>"klima-montaji"],
    ["icon"=>"fas fa-fill-drip","title"=>"Klima Gaz Dolumu","desc"=>"Orijinal sogutcu gazlar kullanarak sisteminizi sarja getiriyoruz.","slug"=>"klima-gaz-dolumu"],
    ["icon"=>"fas fa-fire","title"=>"Petek Temizligi","desc"=>"Peteklerinizi ozel ekipmanlarla temizleyerek veriminizi artiriyoruz.","slug"=>"petek-temizligi"],
];
foreach ($fallback as $f):
?>
            <div class="col-lg-3 col-md-6 fade-up">
                <div class="service-card h-100">
                    <div class="service-card-icon"><i class="<?php echo $f["icon"]; ?>"></i></div>
                    <h4><?php echo $f["title"]; ?></h4>
                    <p><?php echo $f["desc"]; ?></p>
                    <a href="hizmet.php?slug=<?php echo $f["slug"]; ?>" class="service-card-link">Detayli Bilgi <i class="fas fa-arrow-right"></i></a>
                </div>
            </div>
<?php endforeach; endif; ?>
        </div>
    </div>
</section>

<section class="section-pad section-dark">
    <div class="container">
        <div class="row align-items-center g-5">
            <div class="col-lg-5 fade-up">
                <div class="section-title text-start mb-4">
                    <h2 style="text-align:left">NEDEN <span>SADI</span><br>TEKNIK SERVIS?</h2>
                </div>
                <p style="color:rgba(255,255,255,0.6);font-size:15px;line-height:1.85;">30 yili asan sektor deneyimimiz, uzman ekibimiz ve musteri odakli hizmet anlayisimizla Kocaelinin en guvenilir teknik servis markasiyiz.</p>
                <a href="hakkimizda.php" class="btn-red mt-3"><i class="fas fa-users"></i> Hakkimizda</a>
            </div>
            <div class="col-lg-7 fade-up">
                <div class="why-card"><div class="why-card-icon"><i class="fas fa-medal"></i></div><div class="why-card-body"><h5>30 Yillik Tecrube</h5><p>Sektorde 30 yili asan deneyimimizle her marka ve model klimaniza guvenle hizmet veriyoruz.</p></div></div>
                <div class="why-card"><div class="why-card-icon"><i class="fas fa-clock"></i></div><div class="why-card-body"><h5>Hizli Servis</h5><p>Talebinizi aldiktan sonra en kisa surede, genellikle 24 saat icinde kapinızdayiz.</p></div></div>
                <div class="why-card"><div class="why-card-icon"><i class="fas fa-shield-alt"></i></div><div class="why-card-body"><h5>Guvenli ve Garantili Is</h5><p>Tum iscilik ve kullandigimiz orijinal parcalar icin garanti veriyoruz.</p></div></div>
                <div class="why-card"><div class="why-card-icon"><i class="fas fa-tag"></i></div><div class="why-card-body"><h5>Seffaf Fiyatlandirma</h5><p>Gizli ucret yoktur. Ise baslamadan once net fiyat bilgisi sunuyoruz.</p></div></div>
            </div>
        </div>
    </div>
</section>

<section class="cta-section">
    <div class="container text-center fade-up">
        <h2>BUGUN RANDEVU <span style="color:var(--kirmizi)">ALIN</span></h2>
        <p>Klima bakimi, montaj veya tamirat icin hemen iletisime gecin.</p>
        <div class="d-flex justify-content-center flex-wrap gap-3">
            <a href="tel:+905300749206" class="btn-red"><i class="fas fa-phone"></i> 530 074 92 06</a>
            <a href="<?php echo WA_LINK; ?>" target="_blank" class="btn-outline-red" style="border-color:#25D366;color:#25D366;"><i class="fab fa-whatsapp"></i> WhatsApp</a>
        </div>
    </div>
</section>

<?php include "includes/footer.php"; ?>
