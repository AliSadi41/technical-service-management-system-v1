# Technical Service Management System

Bu proje, teknik servis süreçlerinin dijital ortamda verimli, hızlı ve şeffaf bir şekilde yönetilmesi amacıyla geliştirilmiş web tabanlı bir yönetim sistemidir. PHP ve MySQL altyapısı kullanılarak tasarlanan sistem; müşteri kayıtları, arıza bildirimleri, cihaz takibi, personel atamaları ve servis raporlamalarını tek bir merkezden yönetme imkanı sunar.

## Temel Özellikler

* **Cihaz ve Arıza Takibi:** Müşterilerden gelen arızalı cihazların durumunu (Beklemede, Tamir Aşamasında, Tamamlandı, Teslim Edildi) anlık olarak izleme.
* **Müşteri İlişkileri Yönetimi (CRM):** Müşteri bilgilerini, geçmiş servis kayıtlarını ve cihaz geçmişlerini güvenli bir şekilde saklama.
* **Gelişmiş Yönetim Paneli (Admin):** Yetkili kullanıcılar için dinamik istatistikler, personel yönetimi ve sistem ayarlarını barındıran kontrol paneli.
* **Veritabanı Altyapısı:** PHPMyAdmin tabanlı, ilişkisel ve optimize edilmiş MySQL veritabanı tasarımı.
* **Kurumsal Web Arayüzü:** Hizmetler, fiyat listesi, hakkımızda ve dinamik iletişim formu içeren kullanıcı dostu ön yüz.

## Teknolojiler ve Gereksinimler

* **Dil:** PHP (Sürüm 7.4 veya üzeri önerilir)
* **Veritabanı:** MySQL / PHPMyAdmin
* **Arayüz:** HTML5, CSS3, Bootstrap, JavaScript / jQuery
* **Sunucu Gereksinimi:** Yerel çalışma için XAMPP, WampServer veya MAMP; canlı yayın için Linux tabanlı Web Hosting (cPanel).

## Kurulum ve Devreye Alma

1. Bu depodaki tüm dosyaları yerel sunucunuzun (XAMPP kullanıyorsanız `htdocs` klasörünün) içine aktarın.
2. `database` klasörünün içinde yer alan `.sql` uzantılı veritabanı dosyasını PHPMyAdmin panelinizden içeri aktarın (Import).
3. Veritabanı bağlantı ayarlarını projenizin yapılandırma dosyasından (genellikle `baglan.php` veya `config.
