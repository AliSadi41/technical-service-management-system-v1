<?php


define('DB_HOST',    getenv('MYSQLHOST')     ?: '127.0.0.1');
define('DB_PORT',    getenv('MYSQLPORT')     ?: '3306');
define('DB_NAME',    getenv('MYSQLDATABASE') ?: 'kocaeli_teknik_servis');
define('DB_USER',    getenv('MYSQLUSER')     ?: 'root');
define('DB_PASS',    getenv('MYSQLPASSWORD') ?: '');
define('DB_CHARSET', 'utf8mb4');


define('SITE_ADI',   'Sadi Teknik Servis');
define('SITE_TEL',   '530 074 92 06');
define('SITE_MAIL',  'Ertacs.75@gmail.com');
define('SITE_ADRES', 'Turan Güneş Cd. / Yeşilova / İzmit / Kocaeli');
define('WA_LINK',    'https://wa.me/905300749206');

function db(): PDO {
    static $pdo = null;
    if ($pdo === null) {
        $dsn = "mysql:host=" . DB_HOST . ";port=" . DB_PORT . ";dbname=" . DB_NAME . ";charset=" . DB_CHARSET;
        $options = [
            PDO::ATTR_ERRMODE            => PDO::ERRMODE_EXCEPTION,
            PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC,
            PDO::ATTR_EMULATE_PREPARES   => false,
        ];
        try {
            $pdo = new PDO($dsn, DB_USER, DB_PASS, $options);
        } catch (PDOException $e) {
            die('<div style="font-family:sans-serif;padding:30px;background:#1a0000;color:#ff4444;border:1px solid #ff0000;margin:20px;border-radius:8px;">
                <h3>⚠️ Veritabanı Bağlantı Hatası</h3>
                <p>Lütfen XAMPP\'ın çalıştığından ve veritabanının kurulu olduğundan emin olun.</p>
                <code>' . htmlspecialchars($e->getMessage()) . '</code>
            </div>');
        }
    }
    return $pdo;
}
