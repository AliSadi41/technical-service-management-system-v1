<?php

require_once 'includes/config.php';

$slug = isset($_GET['slug']) ? trim($_GET['slug']) : '';

// Statik hizmet verisi (DB'ye ek olarak detay içerikler burada)
$hizmet_detaylari = [
    'klima-bakimi-ve-tamiri' => [
        'baslik'  => 'Klima Bakımı ve Tamiri',
        'icon'    => 'fas fa-wind',
        'ozet'    => 'Klimanızın performansını zirveye taşıyın. Düzenli bakım enerji tasarrufu sağlar, cihaz ömrünü uzatır ve arıza riskini minimize eder.',
        'aciklama'=> 'Klimanız yeterince soğutmuyor, sesler çıkarıyor ya da yıllık bakımı geciktiyse doğru adrestesiniz. Uzman ekibimiz, markanızdan bağımsız olarak tüm split ve kaset tipi klimaların kapsamlı bakım ve tamir işlemlerini gerçekleştirmektedir.',
        'adimlar' => [
            ['baslik'=>'Ön Kontrol ve Arıza Tespiti', 'aciklama'=>'Cihazınız çalışırken görsel ve dijital test ekipmanlarıyla kapsamlı bir ön muayene yapılır. Hata kodları okunur, anormal sesler ve titreşimler değerlendirilir.'],
            ['baslik'=>'Filtre ve İç Ünite Temizliği', 'aciklama'=>'İç ünite filtreleri çıkarılır, basınçlı su ve özel bakım solüsyonuyla derinlemesine temizlenir. Evaporatör lamellerindeki kir ve bakteri birikintileri giderilir.'],
            ['baslik'=>'Dış Ünite Kontrolü ve Temizliği', 'aciklama'=>'Kondenser fanı, kompresör ve elektrik bağlantıları kontrol edilir. Dış ünite lamellerindeki tıkanıklıklar temizlenerek hava akışı optimize edilir.'],
            ['baslik'=>'Gaz Basıncı Kontrolü', 'aciklama'=>'Manifold manometre setiyle soğutucu gaz basıncı ölçülür. Eksiklik tespit edilirse gaz ikmali yapılır; kaçak varsa tespit edilerek giderilir.'],
            ['baslik'=>'Performans Testi', 'aciklama'=>'Tüm işlemler tamamlandıktan sonra cihaz soğutma/ısıtma modunda test edilir. Üfleme sıcaklığı ve akım değerleri ölçülerek teknik rapora eklenir.'],
        ],
        'faydalar'=>['Enerji tasarrufu sağlar (yüzde 20\'ye kadar)','Cihaz ömrünü uzatır','Hava kalitesini iyileştirir','Beklenmedik arızaları önler','Kötü kokuları giderir'],
    ],
    'klima-montaji' => [
        'baslik'  => 'Klima Montajı',
        'icon'    => 'fas fa-wrench',
        'ozet'    => 'Yeni klimanızı profesyonel ekibimizle güvenli, hızlı ve standartlara uygun şekilde monte ediyoruz.',
        'aciklama'=> 'Doğru klima montajı, cihazın verimliliğini ve ömrünü doğrudan etkiler. Yanlış konumlandırma, yetersiz yalıtım veya eksik gaz şarjı ciddi performans kayıplarına yol açar. Uzman ekibimiz, imalatçı standartlarına uygun kurulum gerçekleştirir.',
        'adimlar' => [
            ['baslik'=>'Yerinde Keşif ve Planlama', 'aciklama'=>'Montajdan önce ortam ölçülür; iç ve dış ünite konumları, boru güzergahı ve elektrik bağlantı noktaları belirlenir. Size en verimli yerleşim önerilir.'],
            ['baslik'=>'İç Ünite Montajı', 'aciklama'=>'Montaj aparatı duvara ankastre vida ile sabitlenir. İç ünite levhaya takılır, su tahliye borusu eğimli döşenir, elektrik bağlantıları TSE standartlarına göre yapılır.'],
            ['baslik'=>'Dış Ünite Yerleşimi', 'aciklama'=>'Dış ünite titreşim önleyici kauçuk altlıkla konsol ya da zemine monte edilir. Doğal hava akışını engellemeyecek şekilde konumlandırılır.'],
            ['baslik'=>'Bakır Boru ve Kablo Döşeme', 'aciklama'=>'Uygun çaplı bakır borular bükülmeden, kıvrılmadan döşenir; güneş ışığı ve mekanik darbelerden korumak için flex hortum kanalı ile kaplanır.'],
            ['baslik'=>'Vakum ve Gaz Şarjı', 'aciklama'=>'Sistem vakum pompasıyla en az 30 dakika basılır, nem ve hava tamamen boşaltılır. Ardından fabrika gaz miktarı manifold kontrolüyle doğrulanır veya tamamlanır.'],
            ['baslik'=>'Test ve Devreye Alma', 'aciklama'=>'Sistem çalıştırılarak soğutma/ısıtma performansı test edilir. Akım, basınç ve üfleme sıcaklıkları kaydedilir. Cihazın kullanımı müşteriye anlatılır.'],
        ],
        'faydalar'=>['Fabrika standartlarında kurulum','Garanti kapsamını korur','Enerji verimliliği maksimum tutulur','Uzun ömürlü performans','Güvenli elektrik bağlantısı'],
    ],
    'klima-gaz-dolumu' => [
        'baslik'  => 'Klima Gaz Dolumu',
        'icon'    => 'fas fa-fill-drip',
        'ozet'    => 'Soğutma performansı düşen klimanızı orijinal soğutucu gaz ile şarj ediyoruz. Kaçak tespiti ve gaz ikmali için uzman hizmet.',
        'aciklama'=> 'Klimalar normal çalışma koşullarında gaz kaybetmez. Eğer cihazınızın soğutma gücü belirgin şekilde düştüyse, muhtemelen bir kaçak noktası bulunmaktadır. Gazı doğrudan doldurmak geçici bir çözümdür; kaçağı tespit edip onarması esastır.',
        'adimlar' => [
            ['baslik'=>'Semptom Değerlendirmesi', 'aciklama'=>'Cihazın soğutma kapasitesi, kompresör çalışma süresi ve iç ünite buz tutma durumu incelenerek gaz eksikliği teyit edilir.'],
            ['baslik'=>'Manifold Bağlantısı ve Basınç Ölçümü', 'aciklama'=>'Dijital manifold setiyle düşük ve yüksek basınç tarafı ölçülür. Gaz tipi (R32, R410A, R22 vb.) belirlenir ve nominal değerlerle karşılaştırılır.'],
            ['baslik'=>'Kaçak Tespiti', 'aciklama'=>'Elektronik kaçak dedektörü ve UV boya yöntemiyle tüm bağlantı noktaları, ventil başlıkları ve bakır borular taranır. Kaçak noktası tespit edilirse onarılır.'],
            ['baslik'=>'Vakum ve Nem Alma', 'aciklama'=>'Sistemde gaz değişimi veya kaçak onarımı yapıldıysa vakum pompasıyla nem ve hava tamamen uzaklaştırılır.'],
            ['baslik'=>'Gaz İkmali', 'aciklama'=>'Cihazın gerektirdiği orijinal soğutucu gaz tartılı veya manifold kontrolüyle doldurulur. Aşırı dolum yapılmaz; performans düşürücü ve zararlıdır.'],
        ],
        'faydalar'=>['Soğutma gücü orijinal seviyeye döner','Elektrik tasarrufu sağlanır','Kompresör korunur','Çevre dostu uygulama','Kaçak kalıcı olarak giderilir'],
    ],
    'petek-temizligi' => [
        'baslik'  => 'Petek Temizliği',
        'icon'    => 'fas fa-fire',
        'ozet'    => 'Kalorifer ve fan-coil peteklerinizi profesyonel ekipmanlarla temizleyerek ısıtma verimliliğinizi artırıyoruz.',
        'aciklama'=> 'Yıllar içinde petek içlerinde biriken kireç, tortu ve çamur tabakası ısı transferini ciddi biçimde engeller. Bu durum hem yakıt tüketimini artırır hem de yeterli ısınmayı önler. Profesyonel petek temizliği tek seferlik harcamayla uzun vadeli tasarruf sağlar.',
        'adimlar' => [
            ['baslik'=>'Sistem Değerlendirmesi', 'aciklama'=>'Petek sayısı, yaş, tesisat tipi ve mevcut sorun değerlendirilir. Kimyasal temizlik mi yoksa mekanik yıkama mı uygulanacağı belirlenir.'],
            ['baslik'=>'Tesisat Doldurma', 'aciklama'=>'Sisteme özel kireç çözücü kimyasal solüsyon pompayla doldurulur ve belirli süre dolaştırılarak kireç ve tortuların çözülmesi sağlanır.'],
            ['baslik'=>'Basınçlı Yıkama', 'aciklama'=>'Çözülmüş kireç ve tortu yüksek basınçlı su ile dışarı atılır. İşlem su berraklaşana kadar tekrarlanır.'],
            ['baslik'=>'Petek Dışı Temizlik', 'aciklama'=>'Petek yüzeyleri toz ve kirden arındırılır. Gerekirse radyatör boyası uygulanabilir.'],
            ['baslik'=>'Sistem Testi', 'aciklama'=>'Tüm peteklerin eşit ısındığı kontrol edilir; soğuk kalan petek varsa ek purj işlemi yapılır. Sistem devreye alınır ve müşteriye teslim edilir.'],
        ],
        'faydalar'=>['Yakıt tasarrufu (yüzde 15-25)','Daha hızlı ısınma','Cihaz ömrü uzar','Eşit ısı dağılımı','Tıkalı peteklerin açılması'],
    ],
];

if (!isset($hizmet_detaylari[$slug])) {
    header('Location: index.php');
    exit;
}

$h = $hizmet_detaylari[$slug];
$page_title = $h['baslik'];
include 'includes/header.php';
?>

<!-- Hero -->
<div class="service-hero">
    <div class="container">
        <nav aria-label="breadcrumb" class="breadcrumb-custom mb-3">
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="index.php">Anasayfa</a></li>
                <li class="breadcrumb-item"><a href="#">Hizmetlerimiz</a></li>
                <li class="breadcrumb-item active"><?= htmlspecialchars($h['baslik']) ?></li>
            </ol>
        </nav>
        <div class="row align-items-center g-4">
            <div class="col-lg-8">
                <h1><i class="<?= $h['icon'] ?>" style="color:var(--kirmizi);margin-right:16px;"></i><?= htmlspecialchars($h['baslik']) ?></h1>
                <p class="mt-3"><?= htmlspecialchars($h['ozet']) ?></p>
            </div>
            <div class="col-lg-4 text-lg-end">
                <a href="tel:+905300749206" class="btn-red"><i class="fas fa-phone"></i> Hemen Ara</a>
            </div>
        </div>
    </div>
</div>

<!-- İçerik -->
<section class="section-pad">
    <div class="container">
        <div class="row g-5">
            <!-- Ana İçerik -->
            <div class="col-lg-8">
                <div class="fade-up">
                    <h3 style="font-size:1.6rem;margin-bottom:16px;">Hizmet Hakkında</h3>
                    <p style="font-size:15.5px;color:var(--gri-koyu);line-height:1.9;margin-bottom:36px;">
                        <?= htmlspecialchars($h['aciklama']) ?>
                    </p>
                </div>

                <div class="fade-up">
                    <h3 style="font-size:1.6rem;margin-bottom:24px;">Uygulama <span style="color:var(--kirmizi)">Adımları</span></h3>
                    <?php foreach ($h['adimlar'] as $idx => $adim): ?>
                    <div class="step-item">
                        <div class="step-num"><?= $idx + 1 ?></div>
                        <div class="step-body">
                            <h5><?= htmlspecialchars($adim['baslik']) ?></h5>
                            <p><?= htmlspecialchars($adim['aciklama']) ?></p>
                        </div>
                    </div>
                    <?php endforeach; ?>
                </div>
            </div>

            <!-- Yan Sütun -->
            <div class="col-lg-4 fade-up align-self-start" style="position:sticky;top:80px;">
                <!-- Faydalar -->
                <div class="service-card mb-4">
                    <h5 style="margin-bottom:16px;font-size:1.1rem;"><i class="fas fa-check-circle" style="color:var(--kirmizi);margin-right:8px;"></i>Faydaları</h5>
                    <ul style="list-style:none;padding:0;margin:0;">
                        <?php foreach ($h['faydalar'] as $fayda): ?>
                        <li style="display:flex;align-items:flex-start;gap:10px;margin-bottom:10px;font-size:14.5px;color:var(--gri-koyu);">
                            <i class="fas fa-arrow-right" style="color:var(--kirmizi);margin-top:4px;font-size:11px;flex-shrink:0;"></i>
                            <?= htmlspecialchars($fayda) ?>
                        </li>
                        <?php endforeach; ?>
                    </ul>
                </div>

                <!-- İletişim Kutusu -->
                <div style="background:var(--siyah);border-radius:var(--radius-lg);padding:28px;color:#fff;">
                    <h5 style="font-size:1.1rem;margin-bottom:16px;">Hızlı İletişim</h5>
                    <p style="font-size:14px;color:rgba(255,255,255,0.6);margin-bottom:20px;">Randevu almak veya fiyat bilgisi için hemen ulaşın.</p>
                    <a href="tel:+905300749206" class="btn-red w-100 justify-content-center mb-3">
                        <i class="fas fa-phone"></i> <?= SITE_TEL ?>
                    </a>
                    <a href="<?= WA_LINK ?>" target="_blank" class="btn-outline-red w-100 justify-content-center" style="border-color:#25D366;color:#25D366;">
                        <i class="fab fa-whatsapp"></i> WhatsApp
                    </a>
                </div>

                <!-- Fiyat Listesi Butonu -->
                <div class="mt-4 text-center">
                    <a href="fiyat-listesi.php" class="btn-outline-red w-100 justify-content-center">
                        <i class="fas fa-tags"></i> Fiyat Listesini Görüntüle
                    </a>
                </div>
            </div>
        </div>
    </div>
</section>

<!-- Diğer Hizmetler -->
<section class="section-pad-sm section-gray">
    <div class="container">
        <div class="section-title fade-up">
            <h2>DİĞER <span>HİZMETLERİMİZ</span></h2>
        </div>
        <div class="row g-3 justify-content-center">
            <?php
            foreach ($hizmet_detaylari as $s => $sd):
                if ($s === $slug) continue;
            ?>
            <div class="col-lg-3 col-md-6 fade-up">
                <a href="hizmet.php?slug=<?= $s ?>" class="service-card d-block h-100" style="text-decoration:none;">
                    <div class="service-card-icon"><i class="<?= $sd['icon'] ?>"></i></div>
                    <h4 style="font-size:1.05rem;"><?= htmlspecialchars($sd['baslik']) ?></h4>
                    <span class="service-card-link">İncele <i class="fas fa-arrow-right"></i></span>
                </a>
            </div>
            <?php endforeach; ?>
        </div>
    </div>
</section>

<?php include 'includes/footer.php'; ?>
