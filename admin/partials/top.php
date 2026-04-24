<?php
require_once __DIR__ . '/../../includes/bootstrap.php';
requireAdmin();

$adminPageTitle = $adminPageTitle ?? 'Admin Panel';
$adminPage = $adminPage ?? 'dashboard';
$adminLinks = [
    'dashboard' => ['label' => 'Dashboard', 'url' => 'admin/index.php'],
    'bookings' => ['label' => 'Bookings', 'url' => 'admin/bookings.php'],
    'vehicles' => ['label' => 'Vehicles', 'url' => 'admin/vehicles.php'],
    'reviews' => ['label' => 'Reviews', 'url' => 'admin/reviews.php'],
    'gallery' => ['label' => 'Gallery', 'url' => 'admin/gallery.php'],
    'destinations' => ['label' => 'Destinations', 'url' => 'admin/destinations.php'],
    'partners' => ['label' => 'Partner Leads', 'url' => 'admin/partners.php'],
];
$flash = pullFlash();
?>
<!doctype html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title><?php echo e($adminPageTitle); ?> | Admin</title>
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Cormorant+Garamond:wght@600;700&family=Manrope:wght@400;500;600;700;800&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="<?php echo e(assetUrl('css/styles.css')); ?>">
</head>
<body class="admin-body">
    <div class="admin-shell">
        <aside class="admin-sidebar">
            <a href="<?php echo e(appUrl('admin/index.php')); ?>" class="brand brand-admin">
                <span class="brand-mark">PLT</span>
                <span class="brand-copy">
                    <strong>Admin Panel</strong>
                    <small><?php echo e(siteConfig('site_name')); ?></small>
                </span>
            </a>
            <nav class="admin-nav">
                <?php foreach ($adminLinks as $key => $link): ?>
                    <a href="<?php echo e(appUrl($link['url'])); ?>" class="<?php echo e(activePage($key, $adminPage)); ?>"><?php echo e($link['label']); ?></a>
                <?php endforeach; ?>
            </nav>
            <a href="<?php echo e(appUrl('admin/logout.php')); ?>" class="button button-ghost">Logout</a>
        </aside>
        <main class="admin-main">
            <header class="admin-topbar">
                <div>
                    <span class="eyebrow">Welcome back</span>
                    <h1><?php echo e($adminPageTitle); ?></h1>
                </div>
                <div class="admin-user">
                    <strong><?php echo e($_SESSION['admin_name'] ?? 'Admin'); ?></strong>
                    <span><?php echo e($_SESSION['admin_email'] ?? siteConfig('email')); ?></span>
                </div>
            </header>
            <?php if ($flash): ?>
                <div class="flash flash-<?php echo e($flash['type']); ?>">
                    <?php echo e($flash['message']); ?>
                </div>
            <?php endif; ?>
