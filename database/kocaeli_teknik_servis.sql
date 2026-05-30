

CREATE DATABASE IF NOT EXISTS kocaeli_teknik_servis
  CHARACTER SET utf8mb4
  COLLATE utf8mb4_turkish_ci;

USE kocaeli_teknik_servis;


CREATE TABLE IF NOT EXISTS admin (
    id INT AUTO_INCREMENT PRIMARY KEY,
    kullanici_adi VARCHAR(50) NOT NULL UNIQUE,
    sifre VARCHAR(255) NOT NULL,
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;


INSERT INTO admin (kullanici_adi, sifre) VALUES
('admin', '$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi');



CREATE TABLE IF NOT EXISTS hizmetler (
    id INT AUTO_INCREMENT PRIMARY KEY,
    hizmet_adi VARCHAR(150) NOT NULL,
    aciklama TEXT,
    slug VARCHAR(100) NOT NULL UNIQUE,
    aktif TINYINT(1) DEFAULT 1,
    sira INT DEFAULT 0,
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

INSERT INTO hizmetler (hizmet_adi, aciklama, slug, sira) VALUES
('Klima Bakımı ve Tamiri',
 'Klimanızın performansını zirveye taşıyın. Filtre temizliği, iç-dış ünite kontrolü, gaz seviyesi ölçümü ve kapsamlı performans testleri ile cihazınızın ömrünü uzatıyoruz.',
 'klima-bakimi-ve-tamiri', 1),
('Klima Montajı',
 'Profesyonel ekibimizle klimanızı hızlı, güvenli ve kurallara uygun şekilde monte ediyoruz. Doğru konumlandırma ve kaliteli malzeme kullanımı ile uzun ömürlü kurulum sağlıyoruz.',
 'klima-montaji', 2),
('Klima Gaz Dolumu',
 'Soğutma veriminiz düştüyse klima gazı şarjı gerekiyor olabilir. Orijinal soğutucu gazlar kullanarak sisteminizin soğutma gücünü orijinal seviyesine getiriyoruz.',
 'klima-gaz-dolumu', 3),
('Petek Temizliği',
 'Kalorifer ve fan-coil peteklerinizin iç yüzeylerindeki kireç, tortu ve birikintileri özel ekipmanlarla temizleyerek ısıtma veriminizi artırıyoruz.',
 'petek-temizligi', 4);


CREATE TABLE IF NOT EXISTS fiyatlar (
    id INT AUTO_INCREMENT PRIMARY KEY,
    hizmet_adi VARCHAR(150) NOT NULL,
    fiyat DECIMAL(10,2) NOT NULL,
    birim VARCHAR(30) DEFAULT 'Başlangıç Fiyatı',
    aciklama VARCHAR(255),
    aktif TINYINT(1) DEFAULT 1,
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    updated_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

INSERT INTO fiyatlar (hizmet_adi, fiyat, birim, aciklama) VALUES
('Klima Bakımı',       1000.00, 'Başlangıç Fiyatı', 'Filtre temizliği, iç/dış ünite kontrolü, performans testi'),
('Klima Tamiri',       1500.00, 'Başlangıç Fiyatı', 'Arıza tespiti ve onarımı, yedek parça hariç'),
('Klima Montajı',      4500.00, 'Başlangıç Fiyatı', 'Standart montaj, malzeme dahil'),
('Klima Gaz Dolumu',   2500.00, 'Başlangıç Fiyatı', 'Orijinal soğutucu gaz ile şarj'),
('Petek Temizliği',    2000.00, 'Başlangıç Fiyatı', 'Kimyasal temizlik, basınçlı yıkama');


CREATE TABLE IF NOT EXISTS mesajlar (
    id INT AUTO_INCREMENT PRIMARY KEY,
    ad_soyad VARCHAR(100) NOT NULL,
    telefon VARCHAR(20),
    mesaj TEXT NOT NULL,
    okundu TINYINT(1) DEFAULT 0,
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;
