<?php
require_once __DIR__ . '/includes/bootstrap.php';

$pageTitle = 'Book Force Urbania';
$pageDescription = 'Book premium Force Urbania and luxury Tempo Traveller travel with ' . siteConfig('site_name') . '.';
$currentPage = 'urbania';
$copy = pageCopy('urbania');
$destinations = collection('destinations');
$gallery = collection('gallery');
$googleReviews = array_slice(groupedReviews()['google'] ?? [], 0, 3);

require __DIR__ . '/includes/header.php';
?>
<section class="hero hero-banner" style="--hero-image:url('<?php echo e($copy['hero']['image']); ?>');">
    <div class="hero-overlay"></div>
    <div class="container hero-banner-copy">
        <span class="eyebrow">Booking Banner</span>
        <h1><?php echo e($copy['hero']['title']); ?></h1>
        <p><?php echo e($copy['hero']['subtitle']); ?></p>
        <a href="#urbania-booking" class="button button-primary">Book Now</a>
    </div>
</section>

<section class="section section-sand">
    <div class="container">
        <div class="section-head section-head-center">
            <span class="eyebrow">Why Choose Us</span>
            <h2>Service advantages that make premium road travel easier to choose</h2>
        </div>
        <div class="feature-grid">
            <?php foreach ($copy['features'] as $feature): ?>
                <article class="feature-card feature-card-light">
                    <span class="feature-icon"><?php echo e(substr($feature, 0, 1)); ?></span>
                    <h3><?php echo e($feature); ?></h3>
                    <p>Built around smooth booking, cleaner travel planning, and better on-road comfort.</p>
                </article>
            <?php endforeach; ?>
        </div>
    </div>
</section>

<section class="section">
    <div class="container">
        <div class="section-head section-head-center">
            <span class="eyebrow">Top Vacation Destinations</span>
            <h2>Explore route cards for North India leisure, spiritual, and event travel</h2>
        </div>
        <div class="destination-grid">
            <?php foreach ($destinations as $destination): ?>
                <article class="destination-card">
                    <img src="<?php echo e($destination['image']); ?>" alt="<?php echo e($destination['route']); ?>">
                    <div class="destination-copy">
                        <span class="eyebrow"><?php echo e($destination['tag']); ?></span>
                        <h3><?php echo e($destination['route']); ?></h3>
                        <p><?php echo e($destination['summary']); ?></p>
                    </div>
                </article>
            <?php endforeach; ?>
        </div>
    </div>
</section>

<section class="section section-sand">
    <div class="container">
        <div class="section-head section-head-center">
            <span class="eyebrow">Gallery</span>
            <h2>Interior and exterior highlights from our premium fleet presentation</h2>
        </div>
        <div class="gallery-grid">
            <?php foreach ($gallery as $item): ?>
                <article class="gallery-card">
                    <img src="<?php echo e($item['media_url']); ?>" alt="<?php echo e($item['title']); ?>">
                    <span><?php echo e($item['title']); ?></span>
                </article>
            <?php endforeach; ?>
        </div>
    </div>
</section>

<section class="section">
    <div class="container">
        <div class="section-head section-head-center">
            <span class="eyebrow">What Our Clients Say</span>
            <h2>Testimonials that reinforce confidence before booking</h2>
        </div>
        <div class="slider-shell">
            <div class="slider-actions">
                <button type="button" class="slider-button" data-scroll-target="urbania-review-track" data-scroll-direction="prev">Prev</button>
                <button type="button" class="slider-button" data-scroll-target="urbania-review-track" data-scroll-direction="next">Next</button>
            </div>
            <div class="slider-track" id="urbania-review-track">
                <?php foreach ($googleReviews as $review): ?>
                    <article class="review-card">
                        <div class="rating"><?php echo e(starString((int) $review['rating'])); ?></div>
                        <h3><?php echo e($review['name']); ?></h3>
                        <p><?php echo e($review['content']); ?></p>
                        <div class="review-meta">
                            <strong><?php echo e($review['route']); ?></strong>
                            <span><?php echo e($review['date']); ?></span>
                        </div>
                    </article>
                <?php endforeach; ?>
            </div>
        </div>
    </div>
</section>

<section class="section section-dark" id="urbania-booking">
    <div class="container centered-copy narrow">
        <span class="eyebrow">Book Force Urbania</span>
        <h2>Share your route and dates for a fast response</h2>
    </div>
    <div class="container form-center">
        <?php
        $bookingTitle = 'Urbania Booking';
        $bookingTheme = 'dark';
        $bookingContext = 'urbania_page';
        $bookingFormId = 'urbania-booking';
        $bookingReturnUrl = bookingPageUrl('urbania-booking');
        include __DIR__ . '/includes/booking-form.php';
        ?>
    </div>
</section>
<?php require __DIR__ . '/includes/footer.php'; ?>
