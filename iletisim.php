<?php

require_once 'includes/config.php';
$page_title = 'İletişim';

$basari = $hata = '';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $ad_soyad = trim(htmlspecialchars($_POST['ad_soyad'] ?? ''));
    $telefon  = trim(htmlspecialchars($_POST['telefon']  ?? ''));
    $mesaj    = trim(htmlspecialchars($_POST['mesaj']    ?? ''));

    if (empty($ad_soyad) || empty($mesaj)) {
        $hata = 'Lütfen Ad Soyad ve Mesaj alanlarını doldurunuz.';
    } else {
        try {
            $stmt = db()->prepare("INSERT INTO mesajlar (ad_soyad, telefon, mesaj) VALUES (?, ?, ?)");
            $stmt->execute([$ad_soyad, $telefon, $mesaj]);
            $basari = 'Mesajınız başarıyla iletildi. En kısa sürede size döneceğiz.';
        } catch (Exception $e) {
            $hata = 'Mesaj gönderilirken bir hata oluştu. Lütfen telefonla ulaşın.';
        }
    }
}

include 'includes/header.php';
?>

<div class="page-header">
    <div class="container">
        <nav aria-label="breadcrumb" class="breadcrumb-custom mb-3">
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="index.php">Anasayfa</a></li>
                <li class="breadcrumb-item active">İletişim</li>
            </ol>
        </nav>
        <h1>İLETİ<span>ŞİM</span></h1>
    </div>
</div>

<section class="section-pad">
    <div class="container">
        <div class="row g-5">

            <!-- İletişim Bilgileri -->
            <div class="col-lg-4 fade-up">
                <div class="contact-info-card">
                    <h4 style="font-size:1.5rem;margin-bottom:28px;color:#fff;">Bize Ulaşın</h4>

                    <div class="contact-info-item">
                        <div class="contact-info-icon"><i class="fas fa-phone"></i></div>
                        <div class="contact-info-text">
                            <strong>Telefon</strong>
                            <a href="tel:+905300749206"><?= SITE_TEL ?></a>
                        </div>
                    </div>

                    <div class="contact-info-item">
                        <div class="contact-info-icon"><i class="fas fa-envelope"></i></div>
                        <div class="contact-info-text">
                            <strong>E-posta</strong>
                            <a href="mailto:<?= SITE_MAIL ?>"><?= SITE_MAIL ?></a>
                        </div>
                    </div>

                    <div class="contact-info-item">
                        <div class="contact-info-icon"><i class="fas fa-map-marker-alt"></i></div>
                        <div class="contact-info-text">
                            <strong>Adres</strong>
                            <span><?= SITE_ADRES ?></span>
                        </div>
                    </div>

                    <div class="contact-info-item">
                        <div class="contact-info-icon"><i class="fas fa-clock"></i></div>
                        <div class="contact-info-text">
                            <strong>Çalışma Saatleri</strong>
                            <span>Pazartesi – Cumartesi<br>08:00 – 18:00</span>
                        </div>
                    </div>

                    <div class="mt-4 pt-4" style="border-top:1px solid rgba(255,255,255,0.1);">
                        <a href="<?= WA_LINK ?>" target="_blank" class="btn-red w-100 justify-content-center" style="background:#25D366;">
                            <i class="fab fa-whatsapp"></i> WhatsApp ile Yazın
                        </a>
                    </div>
                </div>
            </div>

            <!-- Form -->
            <div class="col-lg-8 fade-up">
                <h4 style="font-size:1.5rem;margin-bottom:24px;">Mesaj <span style="color:var(--kirmizi)">Gönderin</span></h4>

                <?php if ($basari): ?>
                <div class="alert-success-custom mb-4"><i class="fas fa-check-circle"></i> <?= $basari ?></div>
                <?php endif; ?>
                <?php if ($hata): ?>
                <div class="alert-error-custom mb-4"><i class="fas fa-exclamation-circle"></i> <?= $hata ?></div>
                <?php endif; ?>

                <form method="POST" id="contactForm" class="contact-form">
                    <div class="row g-4">
                        <div class="col-md-6">
                            <label for="ad_soyad">Ad Soyad *</label>
                            <input type="text" class="form-control" id="ad_soyad" name="ad_soyad"
                                   placeholder="Adınızı giriniz" required
                                   value="<?= htmlspecialchars($_POST['ad_soyad'] ?? '') ?>">
                        </div>
                        <div class="col-md-6">
                            <label for="telefon">Telefon</label>
                            <input type="tel" class="form-control" id="telefon" name="telefon"
                                   placeholder="0530 000 00 00"
                                   value="<?= htmlspecialchars($_POST['telefon'] ?? '') ?>">
                        </div>
                        <div class="col-12">
                            <label for="mesaj">Mesajınız *</label>
                            <textarea class="form-control" id="mesaj" name="mesaj" rows="6"
                                      placeholder="Mesajınızı yazın..." required><?= htmlspecialchars($_POST['mesaj'] ?? '') ?></textarea>
                        </div>
                        <div class="col-12">
                            <button type="submit" class="btn-red">
                                <i class="fas fa-paper-plane"></i> Mesajı Gönder
                            </button>
                        </div>
                    </div>
                </form>
            </div>
        </div>

        <!-- Harita -->
        <div class="mt-5 fade-up">
            <h4 style="font-size:1.4rem;margin-bottom:20px;">Konumumuz</h4>
            <div class="map-wrapper">
                <iframe
                    src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d3019.5!2d29.9200!3d40.7654!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x0%3A0x0!2zNDDCsDQ1JzU1LjQiTiAyOcKwNTUnMTIuMCJF!5e0!3m2!1str!2str!4v1700000000000!5m2!1str!2str"
                    width="100%" height="380" style="border:0;display:block;" allowfullscreen=""
                    loading="lazy" referrerpolicy="no-referrer-when-downgrade"
                    title="Sadi Teknik Servis Konumu – İzmit / Kocaeli">
                </iframe>
            </div>
        </div>
    </div>
</section>

<?php include 'includes/footer.php'; ?>
