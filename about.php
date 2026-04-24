<?php
require_once __DIR__ . '/includes/bootstrap.php';

$pageTitle = 'About ' . siteConfig('site_name');
$pageDescription = 'Discover the ' . siteConfig('site_name') . ' story, gallery, destinations, and traveler testimonials.';
$currentPage = 'about';
$copy = pageCopy('about');
$gallery = collection('gallery');
$destinations = array_slice(collection('destinations'), 0, 6);
$googleReviews = array_slice(groupedReviews()['google'] ?? [], 0, 3);
$aboutBookingFormId = 'about-booking';

require __DIR__ . '/includes/header.php';
?>
<section class="hero hero-banner hero-about" style="--hero-image:url('<?php echo e($copy['hero']['image']); ?>');">
    <div class="hero-overlay"></div>
    <div class="container hero-about-grid">
        <div class="hero-copy">
            <span class="eyebrow"><?php echo e(siteConfig('site_name')); ?></span>
            <h1><?php echo e($copy['hero']['title']); ?></h1>
            <p><?php echo e($copy['hero']['subtitle']); ?></p>
            <a href="#discover-more" class="button button-primary">Discover More</a>
        </div>
        <?php
        $bookingTitle = 'Plan Your Next Trip';
        $bookingContext = 'about_page';
        $bookingClass = 'hero-booking hero-booking-compact';
        $bookingFormId = $aboutBookingFormId;
        $bookingReturnUrl = bookingPageUrl($aboutBookingFormId, 'about.php');
        include __DIR__ . '/includes/booking-form.php';
        ?>
    </div>
</section>

<section class="section" id="discover-more">
    <div class="container split-layout">
        <div class="split-copy">
            <span class="eyebrow">Company Introduction</span>
            <h2><?php echo e($copy['intro']['title']); ?></h2>
            <p><?php echo e($copy['intro']['content']); ?></p>
        </div>
        <div class="media-frame">
            <img src="<?php echo e($gallery[0]['media_url'] ?? $copy['hero']['image']); ?>" alt="<?php echo e(siteConfig('site_name')); ?>">
        </div>
    </div>
</section>

<section class="section section-sand">
    <div class="container">
        <div class="section-head section-head-center">
            <span class="eyebrow">Why Choose Us</span>
            <h2>Feature cards that explain the premium experience clearly</h2>
        </div>
        <div class="feature-grid">
            <?php foreach ($copy['cards'] as $card): ?>
                <article class="feature-card feature-card-light">
                    <span class="feature-icon"><?php echo e(substr($card['title'], 0, 1)); ?></span>
                    <h3><?php echo e($card['title']); ?></h3>
                    <p><?php echo e($card['content']); ?></p>
                </article>
            <?php endforeach; ?>
        </div>
    </div>
</section>

<section class="section">
    <div class="container">
        <div class="section-head section-head-center">
            <span class="eyebrow">Our Gallery</span>
            <h2>Vehicle interiors, road moments, and premium presentation</h2>
        </div>
        <div class="gallery-grid">
            <?php foreach ($gallery as $item): ?>
                <article class="gallery-card">
                    <img src="<?php echo e($item['media_url']); ?>" alt="<?php echo e($item['title']); ?>">
                    <span><?php echo e($item['title']); ?></span>
                </article>
            <?php endforeach; ?>
        </div>
        <div class="section-actions">
            <a href="<?php echo e(bookingPageUrl()); ?>" class="button button-primary">Book Now</a>
        </div>
    </div>
</section>

<section class="section section-sand">
    <div class="container">
        <div class="section-head section-head-center">
            <span class="eyebrow">Top Vacation Destinations</span>
            <h2>Popular routes from Chandigarh for premium group movement</h2>
        </div>
        <div class="destination-grid compact-grid">
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

<section class="section">
    <div class="container">
        <div class="section-head section-head-center">
            <span class="eyebrow">What Our Clients Say</span>
            <h2>Testimonials that support the booking decision</h2>
        </div>
        <div class="slider-shell">
            <div class="slider-actions">
                <button type="button" class="slider-button" data-scroll-target="about-testimonial-track" data-scroll-direction="prev">Prev</button>
                <button type="button" class="slider-button" data-scroll-target="about-testimonial-track" data-scroll-direction="next">Next</button>
            </div>
            <div class="slider-track" id="about-testimonial-track">
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
<?php require __DIR__ . '/includes/footer.php'; ?>
