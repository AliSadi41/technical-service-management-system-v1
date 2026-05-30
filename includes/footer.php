<?php

?>

<footer class="site-footer">
    <div class="footer-top">
        <div class="container">
            <div class="row g-4">
                <!-- Marka -->
                <div class="col-lg-4 col-md-6">
                    <div class="footer-brand">
                        <a href="index.php" class="footer-logo">
                            <i class="fas fa-snowflake"></i>
                            <span>SADİ TEKNİK SERVİS</span>
                        </a>
                        <p>30 yıllık deneyim ve profesyonel ekibimizle Kocaeli'nin güvenilir klima ve ısıtma sistemi uzmanıyız. Her işimde kalite ve müşteri memnuniyeti ön plandadır.</p>
                        <div class="footer-social">
                            <a href="<?= WA_LINK ?>" target="_blank" class="social-btn whatsapp" title="WhatsApp"><i class="fab fa-whatsapp"></i></a>
                            <a href="tel:+90<?= str_replace(' ', '', SITE_TEL) ?>" class="social-btn phone" title="Ara"><i class="fas fa-phone"></i></a>
                            <a href="mailto:<?= SITE_MAIL ?>" class="social-btn email" title="E-posta"><i class="fas fa-envelope"></i></a>
                        </div>
                    </div>
                </div>

                <!-- Hızlı Linkler -->
                <div class="col-lg-2 col-md-6 col-6">
                    <h5 class="footer-heading">Sayfalar</h5>
                    <ul class="footer-links">
                        <li><a href="index.php"><i class="fas fa-chevron-right"></i> Anasayfa</a></li>
                        <li><a href="hakkimizda.php"><i class="fas fa-chevron-right"></i> Hakkımızda</a></li>
                        <li><a href="fiyat-listesi.php"><i class="fas fa-chevron-right"></i> Fiyat Listesi</a></li>
                        <li><a href="iletisim.php"><i class="fas fa-chevron-right"></i> İletişim</a></li>
                    </ul>
                </div>

                <!-- Hizmetler -->
                <div class="col-lg-3 col-md-6 col-6">
                    <h5 class="footer-heading">Hizmetlerimiz</h5>
                    <ul class="footer-links">
                        <li><a href="hizmet.php?slug=klima-bakimi-ve-tamiri"><i class="fas fa-wind"></i> Klima Bakımı & Tamiri</a></li>
                        <li><a href="hizmet.php?slug=klima-montaji"><i class="fas fa-wrench"></i> Klima Montajı</a></li>
                        <li><a href="hizmet.php?slug=klima-gaz-dolumu"><i class="fas fa-fill-drip"></i> Klima Gaz Dolumu</a></li>
                        <li><a href="hizmet.php?slug=petek-temizligi"><i class="fas fa-fire"></i> Petek Temizliği</a></li>
                    </ul>
                </div>

                <!-- İletişim -->
                <div class="col-lg-3 col-md-6">
                    <h5 class="footer-heading">İletişim</h5>
                    <ul class="footer-contact-list">
                        <li>
                            <i class="fas fa-map-marker-alt"></i>
                            <span><?= SITE_ADRES ?></span>
                        </li>
                        <li>
                            <i class="fas fa-phone"></i>
                            <a href="tel:+905300749206"><?= SITE_TEL ?></a>
                        </li>
                        <li>
                            <i class="fas fa-envelope"></i>
                            <a href="mailto:<?= SITE_MAIL ?>"><?= SITE_MAIL ?></a>
                        </li>
                        <li>
                            <i class="fas fa-clock"></i>
                            <span>Pzt–Cmt: 08:00 – 18:00</span>
                        </li>
                    </ul>
                </div>
            </div>
        </div>
    </div>

    <div class="footer-bottom">
        <div class="container">
            <div class="row align-items-center">
                <div class="col-md-6">
                    <p class="mb-0">&copy; <?= date('Y') ?> Sadi Teknik Servis – Tüm hakları saklıdır.</p>
                </div>
                <div class="col-md-6 text-md-end">
                    <p class="mb-0">Kocaeli / İzmit &nbsp;|&nbsp; <a href="admin/index.php"><i class="fas fa-lock"></i> Admin</a></p>
                </div>
            </div>
        </div>
    </div>
</footer>

<!-- ======================================================
     WhatsApp Sabit Butonu
====================================================== -->
<a href="<?= WA_LINK ?>" target="_blank" class="whatsapp-float" title="WhatsApp ile iletişime geçin">
    <i class="fab fa-whatsapp"></i>
    <span class="wa-tooltip">WhatsApp'tan Yazın</span>
</a>

<!-- Bootstrap JS -->
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>
<!-- Ana JS -->
<script src="/sadi_teknik/assets/js/main.js"></script>
</body>
</html>
