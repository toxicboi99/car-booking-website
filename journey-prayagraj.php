<?php
require_once __DIR__ . '/includes/bootstrap.php';

$pageTitle = 'Journey To Prayagraj';
$pageDescription = 'Luxury Chandigarh to Prayagraj journey planning for spiritual and family travel.';
$currentPage = 'journey';
$journey = pageCopy('journey');

require __DIR__ . '/includes/header.php';
?>
<section class="hero hero-banner" style="--hero-image:url('<?php echo e($journey['hero']['image']); ?>');">
    <div class="hero-overlay"></div>
    <div class="container hero-banner-copy">
        <span class="eyebrow">Spiritual Travel</span>
        <h1><?php echo e($journey['hero']['title']); ?></h1>
        <p><?php echo e($journey['hero']['subtitle']); ?></p>
    </div>
</section>

<?php foreach ($journey['sections'] as $section): ?>
    <section class="section">
        <div class="container split-layout <?php echo !empty($section['reverse']) ? 'split-reverse' : ''; ?>">
            <div class="split-copy">
                <span class="eyebrow">Journey Detail</span>
                <h2><?php echo e($section['title']); ?></h2>
                <p><?php echo e($section['content']); ?></p>
            </div>
            <div class="collage-grid">
                <?php foreach ($section['images'] as $image): ?>
                    <img src="<?php echo e($image); ?>" alt="<?php echo e($section['title']); ?>">
                <?php endforeach; ?>
            </div>
        </div>
    </section>
<?php endforeach; ?>

<section class="section section-sand">
    <div class="container centered-copy">
        <span class="eyebrow">Event Dates</span>
        <h2>Seasonal spiritual travel windows can be highlighted here</h2>
        <?php foreach ($journey['event_dates'] as $line): ?>
            <p><?php echo e($line); ?></p>
        <?php endforeach; ?>
    </div>
</section>

<section class="section">
    <div class="container split-layout">
        <div class="split-copy">
            <span class="eyebrow">Booking CTA</span>
            <h2><?php echo e($journey['cta']['title']); ?></h2>
            <p><?php echo e($journey['cta']['content']); ?></p>
            <a href="<?php echo e(bookingPageUrl()); ?>" class="button button-primary">Book Now</a>
        </div>
        <div class="media-frame">
            <img src="<?php echo e($journey['cta']['image']); ?>" alt="Journey to Prayagraj booking">
        </div>
    </div>
</section>
<?php require __DIR__ . '/includes/footer.php'; ?>
