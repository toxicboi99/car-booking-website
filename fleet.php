<?php
require_once __DIR__ . '/includes/bootstrap.php';

$pageTitle = 'Our Fleet';
$pageDescription = 'Explore premium Force Urbania and Tempo Traveller options.';
$currentPage = 'fleet';
$fleet = pageCopy('fleet');
$vehicles = collection('vehicles');
$gallery = array_slice(collection('gallery'), 0, 3);

require __DIR__ . '/includes/header.php';
?>
<section class="hero hero-banner" style="--hero-image:url('<?php echo e($fleet['hero']['image']); ?>');">
    <div class="hero-overlay"></div>
    <div class="container hero-banner-copy">
        <span class="eyebrow">Fleet Introduction</span>
        <h1><?php echo e($fleet['hero']['title']); ?></h1>
        <p><?php echo e($fleet['hero']['subtitle']); ?></p>
    </div>
</section>

<?php foreach ($vehicles as $index => $vehicle): ?>
    <section class="section">
        <div class="container split-layout <?php echo $index % 2 === 1 ? 'split-reverse' : ''; ?>">
            <div class="split-copy">
                <span class="eyebrow"><?php echo e($vehicle['capacity']); ?></span>
                <h2><?php echo e($vehicle['name']); ?></h2>
                <p><?php echo e($vehicle['summary']); ?></p>
                <ul class="check-list">
                    <?php foreach ($vehicle['highlights'] as $highlight): ?>
                        <li><?php echo e($highlight); ?></li>
                    <?php endforeach; ?>
                </ul>
            </div>
            <div class="media-frame">
                <img src="<?php echo e($vehicle['image']); ?>" alt="<?php echo e($vehicle['name']); ?>">
            </div>
        </div>
    </section>
<?php endforeach; ?>

<section class="section section-sand">
    <div class="container split-layout split-reverse">
        <div class="split-copy">
            <span class="eyebrow">Why Choose Our Fleet</span>
            <h2>Every vehicle is selected to support comfort, trust, and premium presentation</h2>
            <ul class="check-list">
                <?php foreach ($fleet['why_choose'] as $point): ?>
                    <li><?php echo e($point); ?></li>
                <?php endforeach; ?>
            </ul>
        </div>
        <div class="collage-grid">
            <?php foreach ($gallery as $item): ?>
                <img src="<?php echo e($item['media_url']); ?>" alt="<?php echo e($item['title']); ?>">
            <?php endforeach; ?>
        </div>
    </div>
</section>

<section class="section section-dark">
    <div class="container centered-copy">
        <span class="eyebrow">Booking CTA</span>
        <h2>Book your vehicle today</h2>
        <p>Tell us the route, group size, and dates. We will guide you to the right vehicle without a complicated booking flow.</p>
        <a href="<?php echo e(bookingPageUrl()); ?>" class="button button-primary">Book Now</a>
    </div>
</section>
<?php require __DIR__ . '/includes/footer.php'; ?>
