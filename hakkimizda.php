<?php
require_once 'includes/config.php';
$page_title = 'Hakkımızda';
include 'includes/header.php';
?>

<div class="page-header">
    <div class="container">
        <nav aria-label="breadcrumb" class="breadcrumb-custom mb-3">
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="index.php">Anasayfa</a></li>
                <li class="breadcrumb-item active">Hakkımızda</li>
            </ol>
        </nav>
        <h1>HAKKIMIZ<span>DA</span></h1>
    </div>
</div>

<!-- ── Hikayemiz ──────────────────────────────────────── -->
<section class="section-pad">
    <div class="container">
        <div class="row align-items-center g-5">
            <div class="col-lg-6 fade-up">
                <div class="section-title text-start mb-4">
                    <h2 style="text-align:left">30 YILLIK <span>BAŞARI</span> HİKAYESİ</h2>
                </div>
                <p style="font-size:15.5px;color:var(--gri-koyu);line-height:1.9;margin-bottom:18px;">
                    <strong>Sadi Teknik Servis</strong>, 1994 yılında Ertaç Sadi tarafından Kocaeli'nin
                    İzmit ilçesinde kurulmuştur. Kuruluşundan bu yana müşteri memnuniyetini ve kaliteli
                    işçiliği ilke edinen firmamız, bugün bölgenin en köklü teknik servis markalarından
                    biri haline gelmiştir.
                </p>
                <p style="font-size:15.5px;color:var(--gri-koyu);line-height:1.9;margin-bottom:18px;">
                    Klima bakım ve tamiri, klima montajı, gaz dolumu ve petek temizliği alanlarında
                    uzmanlaşmış ekibimizle yılda binlerce müşteriye hizmet sunmaktayız. Her işimizde
                    orijinal yedek parça kullanıyor, işçiliğimize garanti veriyoruz.
                </p>
                <p style="font-size:15.5px;color:var(--gri-koyu);line-height:1.9;">
                    Tüm marka ve modellere hizmet veriyor, zamanında ve söz verilen fiyatta işi
                    tamamlamayı taahhüt ediyoruz.
                </p>
            </div>
            <div class="col-lg-6 fade-up">
                <div class="row g-3">
                    <?php
                    $rakamlar = [
                        ['num'=>'30+','label'=>'Yıl Deneyim','icon'=>'fas fa-calendar-alt'],
                        ['num'=>'2500+','label'=>'Tamamlanan Proje','icon'=>'fas fa-check-circle'],
                        ['num'=>'%98','label'=>'Müşteri Memnuniyeti','icon'=>'fas fa-heart'],
                        ['num'=>'24s','label'=>'Servis Süresi','icon'=>'fas fa-clock'],
                    ];
                    foreach ($rakamlar as $r): ?>
                    <div class="col-6">
                        <div class="service-card text-center p-4">
                            <i class="<?= $r['icon'] ?>" style="font-size:2rem;color:var(--kirmizi);margin-bottom:12px;display:block;"></i>
                            <div style="font-family:var(--font-baslik);font-size:2.5rem;color:var(--siyah);line-height:1;"><?= $r['num'] ?></div>
                            <div style="font-family:var(--font-kalin);font-size:11px;letter-spacing:0.1em;text-transform:uppercase;color:var(--gri);margin-top:6px;"><?= $r['label'] ?></div>
                        </div>
                    </div>
                    <?php endforeach; ?>
                </div>
            </div>
        </div>
    </div>
</section>

<!-- ── Vizyon / Misyon / Kalite ───────────────────────── -->
<section class="section-pad section-gray">
    <div class="container">
        <div class="section-title fade-up">
            <h2>VİZYON, MİSYON & <span>KALİTE</span></h2>
        </div>
        <div class="row g-4">
            <div class="col-lg-4 col-md-6 fade-up">
                <div class="service-card h-100">
                    <div class="service-card-icon"><i class="fas fa-eye"></i></div>
                    <h4>Vizyonumuz</h4>
                    <p>Kocaeli ve çevre illerde teknik servis sektörünün lider markası olmak; teknoloji, eğitim ve müşteri memnuniyetine yatırım yaparak sürdürülebilir büyümeyi hedeflemek.</p>
                </div>
            </div>
            <div class="col-lg-4 col-md-6 fade-up">
                <div class="service-card h-100">
                    <div class="service-card-icon"><i class="fas fa-bullseye"></i></div>
                    <h4>Misyonumuz</h4>
                    <p>Müşterilerimize hızlı, güvenilir ve kaliteli teknik servis hizmeti sunmak. Her işimizde doğruluğu, şeffaflığı ve iş güvenliğini ön planda tutmak.</p>
                </div>
            </div>
            <div class="col-lg-4 col-md-6 fade-up">
                <div class="service-card h-100">
                    <div class="service-card-icon"><i class="fas fa-award"></i></div>
                    <h4>Kalite Politikası</h4>
                    <p>Orijinal yedek parça kullanımı, eğitimli teknisyen kadrosu ve işçilik garantisi ile her müşterimize aynı yüksek standartta hizmet sunmayı taahhüt ediyoruz.</p>
                </div>
            </div>
        </div>
    </div>
</section>

<!-- ── Ekibimiz ───────────────────────────────────────── -->
<section class="section-pad">
    <div class="container">
        <div class="section-title fade-up">
            <h2>PROFESYONEL <span>EKİBİMİZ</span></h2>
            <p>Uzman ve deneyimli ekibimizle hizmetinizdeyiz.</p>
        </div>
        <div class="row g-4 justify-content-center">
            <div class="col-lg-4 col-md-6 fade-up">
                <div class="team-card">
                    <div class="team-avatar">ES</div>
                    <h4>Ertaç Sadi</h4>
                    <div class="role">Kurucu & Baş Teknisyen</div>
                    <p>30 yılı aşkın sektör deneyimiyle tüm marka ve model klimaların bakım, tamir ve montaj işlemlerinde uzman. Firmamızın kurucusu ve teknik lideri.</p>
                    <div class="mt-3 d-flex justify-content-center gap-2">
                        <span style="background:rgba(224,16,32,0.08);color:var(--kirmizi);font-family:var(--font-kalin);font-size:11px;letter-spacing:0.06em;padding:4px 10px;border-radius:20px;">30 Yıl Deneyim</span>
                        <span style="background:rgba(224,16,32,0.08);color:var(--kirmizi);font-family:var(--font-kalin);font-size:11px;letter-spacing:0.06em;padding:4px 10px;border-radius:20px;">Tüm Markalar</span>
                    </div>
                </div>
            </div>
            <div class="col-lg-4 col-md-6 fade-up">
                <div class="team-card">
                    <div class="team-avatar">AS</div>
                    <h4>Ali Sadi</h4>
                    <div class="role">Kalfa Teknisyen</div>
                    <p>Klima montajı ve bakım işlemlerinde deneyimli kalfa teknisyen. Titiz çalışma anlayışı ve müşteri memnuniyetine verdiği önem ile ekibimizin değerli üyesi.</p>
                    <div class="mt-3 d-flex justify-content-center gap-2">
                        <span style="background:rgba(224,16,32,0.08);color:var(--kirmizi);font-family:var(--font-kalin);font-size:11px;letter-spacing:0.06em;padding:4px 10px;border-radius:20px;">Montaj Uzmanı</span>
                        <span style="background:rgba(224,16,32,0.08);color:var(--kirmizi);font-family:var(--font-kalin);font-size:11px;letter-spacing:0.06em;padding:4px 10px;border-radius:20px;">Kalfa</span>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>

<!-- ── Değerlerimiz ───────────────────────────────────── -->
<section class="section-pad section-dark">
    <div class="container">
        <div class="row align-items-center g-5">
            <div class="col-lg-5 fade-up">
                <div class="section-title text-start mb-2">
                    <h2 style="text-align:left">DEĞERLERİ<span>MİZ</span></h2>
                </div>
                <p style="color:rgba(255,255,255,0.6);font-size:15px;line-height:1.85;">
                    Her işimizde rehber edindiğimiz değerler, müşterilerimize olan bağlılığımızın
                    ve mesleki sorumluluğumuzun yansımasıdır.
                </p>
            </div>
            <div class="col-lg-7 fade-up">
                <div class="value-item">
                    <h5><i class="fas fa-handshake" style="color:var(--kirmizi);margin-right:8px;"></i> Dürüstlük & Şeffaflık</h5>
                    <p>Fiyatlarımız nettir, gizli ücret yoktur. Yapılacak işi ve maliyeti önceden açıkça bildiririz.</p>
                </div>
                <div class="value-item">
                    <h5><i class="fas fa-star" style="color:var(--kirmizi);margin-right:8px;"></i> Kalite & Mükemmellik</h5>
                    <p>Orijinal yedek parça ve modern ekipmanlarla her işi en yüksek standartta tamamlarız.</p>
                </div>
                <div class="value-item">
                    <h5><i class="fas fa-user-check" style="color:var(--kirmizi);margin-right:8px;"></i> Müşteri Memnuniyeti</h5>
                    <p>Müşterimiz memnun olmadan işi bitirmiş saymayız. Geri bildirimleriniz bizim için değerlidir.</p>
                </div>
                <div class="value-item">
                    <h5><i class="fas fa-leaf" style="color:var(--kirmizi);margin-right:8px;"></i> Çevre Duyarlılığı</h5>
                    <p>Eski gazları ve atık parçaları çevre mevzuatına uygun şekilde bertaraf ediyor, enerji verimli çözümler öneriyoruz.</p>
                </div>
            </div>
        </div>
    </div>
</section>

<!-- CTA -->
<section class="cta-section">
    <div class="container text-center fade-up">
        <h2>BİZİMLE <span style="color:var(--kirmizi)">İLETİŞİME</span> GEÇİN</h2>
        <p>Sorularınız için bizi arayın ya da whatsapp'tan yazın.</p>
        <div class="d-flex justify-content-center flex-wrap gap-3">
            <a href="iletisim.php" class="btn-red"><i class="fas fa-envelope"></i> İletişim Formu</a>
            <a href="tel:+905300749206" class="btn-outline-red"><i class="fas fa-phone"></i> <?= SITE_TEL ?></a>
        </div>
    </div>
</section>

<?php include 'includes/footer.php'; ?>
