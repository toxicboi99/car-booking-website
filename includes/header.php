<?php
$site = siteConfig();
$pageTitle = $pageTitle ?? $site['site_name'];
$pageDescription = $pageDescription ?? $site['tagline'];
$currentPage = $currentPage ?? 'home';
$flash = pullFlash();
$navItems = [
    'home' => ['label' => 'Home', 'url' => 'index.php'],
    'journey' => ['label' => 'Journey', 'url' => 'journey-prayagraj.php'],
    'fleet' => ['label' => 'Fleet', 'url' => 'fleet.php'],
    'reviews' => ['label' => 'Reviews', 'url' => 'reviews.php'],
    'partner' => ['label' => 'Partner', 'url' => 'partner.php'],
    'about' => ['label' => 'About', 'url' => 'about.php'],
    'urbania' => ['label' => 'Book Urbania', 'url' => 'book-force-urbania.php'],
];
$headerBookingUrl = bookingPageUrl();

if ($currentPage === 'home') {
    $headerBookingUrl = bookingPageUrl('home-booking', 'index.php');
} elseif ($currentPage === 'about') {
    $headerBookingUrl = bookingPageUrl('about-booking', 'about.php');
} elseif ($currentPage === 'urbania') {
    $headerBookingUrl = bookingPageUrl('urbania-booking');
}
?>
<!doctype html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title><?php echo e($pageTitle); ?> | <?php echo e($site['site_name']); ?></title>
    <meta name="description" content="<?php echo e($pageDescription); ?>">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Cormorant+Garamond:wght@600;700&family=Manrope:wght@400;500;600;700;800&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="<?php echo e(assetUrl('css/styles.css')); ?>">
</head>
<body>
    <header class="site-header">
        <div class="container header-row">
            <a href="<?php echo e(appUrl('index.php')); ?>" class="brand">
                <span class="brand-mark">PLT</span>
                <span class="brand-copy">
                    <strong><?php echo e($site['site_name']); ?></strong>
                    <small><?php echo e($site['tagline']); ?></small>
                </span>
            </a>
            <button class="nav-toggle" type="button" aria-label="Toggle navigation" data-nav-toggle>
                <span></span>
                <span></span>
                <span></span>
            </button>
            <nav class="site-nav" data-nav>
                <?php foreach ($navItems as $key => $item): ?>
                    <a href="<?php echo e(appUrl($item['url'])); ?>" class="<?php echo e(activePage($key, $currentPage)); ?>"><?php echo e($item['label']); ?></a>
                <?php endforeach; ?>
            </nav>
            <div class="header-actions">
                <a href="tel:<?php echo e($site['phone_raw']); ?>" class="button button-ghost">Call Us</a>
                <a href="<?php echo e($headerBookingUrl); ?>" class="button button-primary">Book Now</a>
            </div>
        </div>
    </header>
    <?php if ($flash): ?>
        <div class="flash-wrap">
            <div class="container">
                <div class="flash flash-<?php echo e($flash['type']); ?>">
                    <?php echo e($flash['message']); ?>
                </div>
            </div>
        </div>
    <?php endif; ?>
    <main>
