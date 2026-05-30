<?php
if (session_status() === PHP_SESSION_NONE) session_start();
$current_page = basename($_SERVER['PHP_SELF'], '.php');
function aktif(string $sayfa, string $current): string {
    return $sayfa === $current ? 'active' : '';
}
?>
<!DOCTYPE html>
<html lang="tr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?php echo isset($page_title) ? htmlspecialchars($page_title) . " | " : ""; ?>Sadi Teknik Servis</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css">
    <link href="https://fonts.googleapis.com/css2?family=Bebas+Neue&family=Barlow:ital,wght@0,300;0,400;0,600;0,700;1,400&family=Barlow+Condensed:wght@500;700&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="/sadi_teknik/assets/css/style.css">
</head>
<body>
<div class="topbar"><div class="container"><div class="topbar-inner">
<div class="topbar-left">
<span><i class="fas fa-envelope"></i> <?php echo SITE_MAIL; ?></span>
<span><i class="fas fa-phone"></i> <?php echo SITE_TEL; ?></span>
</div>
<div class="topbar-right"><span><i class="fas fa-map-marker-alt"></i> <?php echo SITE_ADRES; ?></span></div>
</div></div></div>
<nav class="navbar navbar-expand-lg navbar-dark sticky-top main-navbar">
<div class="container">
<a class="navbar-brand" href="/sadi_teknik/index.php">
<span class="brand-icon"><i class="fas fa-snowflake"></i></span>
<span class="brand-text"><span class="brand-main">SADİ</span><span class="brand-sub">TEKNİK SERVİS</span></span>
</a>
<button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#mainNav"><span class="navbar-toggler-icon"></span></button>
<div class="collapse navbar-collapse" id="mainNav">
<ul class="navbar-nav ms-auto align-items-lg-center">
<li class="nav-item"><a class="nav-link <?php echo aktif("index", $current_page); ?>" href="/sadi_teknik/index.php"><i class="fas fa-home"></i> Anasayfa</a></li>
<li class="nav-item"><a class="nav-link <?php echo aktif("hakkimizda", $current_page); ?>" href="/sadi_teknik/hakkimizda.php"><i class="fas fa-users"></i> Hakkimizda</a></li>
<li class="nav-item dropdown">
<a class="nav-link dropdown-toggle" href="#" role="button" data-bs-toggle="dropdown"><i class="fas fa-tools"></i> Hizmetlerimiz</a>
<ul class="dropdown-menu dropdown-menu-dark-custom">
<li><a class="dropdown-item" href="/sadi_teknik/hizmet.php?slug=klima-bakimi-ve-tamiri"><i class="fas fa-wind"></i> Klima Bakimi ve Tamiri</a></li>
<li><a class="dropdown-item" href="/sadi_teknik/hizmet.php?slug=klima-montaji"><i class="fas fa-wrench"></i> Klima Montaji</a></li>
<li><a class="dropdown-item" href="/sadi_teknik/hizmet.php?slug=klima-gaz-dolumu"><i class="fas fa-fill-drip"></i> Klima Gaz Dolumu</a></li>
<li><a class="dropdown-item" href="/sadi_teknik/hizmet.php?slug=petek-temizligi"><i class="fas fa-fire"></i> Petek Temizligi</a></li>
</ul>
</li>
<li class="nav-item"><a class="nav-link <?php echo aktif("fiyat-listesi", $current_page); ?>" href="/sadi_teknik/fiyat-listesi.php"><i class="fas fa-tags"></i> Fiyat Listesi</a></li>
<li class="nav-item"><a class="nav-link <?php echo aktif("iletisim", $current_page); ?>" href="/sadi_teknik/iletisim.php"><i class="fas fa-envelope"></i> Iletisim</a></li>
<li class="nav-item ms-lg-2"><a class="nav-link nav-admin-btn" href="/sadi_teknik/admin/index.php"><i class="fas fa-lock"></i> Admin</a></li>
</ul>
</div>
</div>
</nav>
