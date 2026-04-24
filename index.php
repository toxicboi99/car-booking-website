<?php
require_once __DIR__ . '/includes/bootstrap.php';

$pageTitle = 'Luxury Travel From Chandigarh';
$pageDescription = 'Book premium Urbania and Tempo Traveller travel with ' . siteConfig('site_name') . '.';
$currentPage = 'home';
$home = pageCopy('home');
$reviewGroups = groupedReviews();
$googleReviews = $reviewGroups['google'] ?? [];
$videoCategories = ['domestic', 'local', 'international'];
$destinations = array_slice(collection('destinations'), 0, 8);
$vehicles = array_slice(collection('vehicles'), 0, 3);
$homeBookingFormId = 'home-booking';

require __DIR__ . '/includes/header.php';
?>
<section class="hero hero-home">
    <video class="hero-video" autoplay muted loop playsinline poster="<?php echo e($home['offer']['image']); ?>">
        <source src="<?php echo e(siteConfig('hero_video')); ?>" type="video/mp4">
    </video>
    <div class="hero-overlay"></div>
    <div class="container hero-grid">
        <div class="hero-copy">
            <span class="eyebrow"><?php echo e($home['hero']['eyebrow']); ?></span>
            <h1><?php echo e($home['hero']['title']); ?></h1>
            <p><?php echo e($home['hero']['subtitle']); ?></p>
            <div class="hero-actions">
                <a href="#<?php echo e($homeBookingFormId); ?>" class="button button-primary">Book Your Journey</a>
                <a href="<?php echo e(appUrl('fleet.php')); ?>" class="button button-ghost button-light">Explore Fleet</a>
            </div>
            <ul class="hero-stats">
                <?php foreach ($home['hero']['stats'] as $stat): ?>
                    <li><?php echo e($stat); ?></li>
                <?php endforeach; ?>
            </ul>
        </div>
        <?php
        $bookingTitle = 'Book Now';
        $bookingContext = 'homepage';
        $bookingClass = 'hero-booking';
        $bookingFormId = $homeBookingFormId;
        $bookingReturnUrl = bookingPageUrl($homeBookingFormId, 'index.php');
        include __DIR__ . '/includes/booking-form.php';
        ?>
    </div>
</section>

<section class="section">
    <div class="container">
        <div class="section-head section-head-center">
            <span class="eyebrow">Google Reviews</span>
            <h2>Real feedback from travelers who booked with confidence</h2>
            <p>Verified-style review cards, star ratings, and an easy path to explore more social proof.</p>
        </div>
        <div class="slider-shell">
            <div class="slider-actions">
                <button type="button" class="slider-button" data-scroll-target="google-review-track" data-scroll-direction="prev">Prev</button>
                <button type="button" class="slider-button" data-scroll-target="google-review-track" data-scroll-direction="next">Next</button>
            </div>
            <div class="slider-track" id="google-review-track">
                <?php foreach ($googleReviews as $review): ?>
                    <article class="review-card">
                        <div class="rating"><?php echo e(starString((int) $review['rating'])); ?></div>
                        <h3><?php echo e($review['title']); ?></h3>
                        <p><?php echo e($review['content']); ?></p>
                        <div class="review-meta">
                            <strong><?php echo e($review['name']); ?></strong>
                            <span><?php echo e($review['route']); ?></span>
                        </div>
                    </article>
                <?php endforeach; ?>
            </div>
        </div>
        <div class="section-actions">
            <a href="<?php echo e(appUrl('reviews.php')); ?>" class="button button-ghost">View All Reviews</a>
        </div>
    </div>
</section>

<section class="section section-sand">
    <div class="container">
        <div class="section-head section-head-center">
            <span class="eyebrow">Video Testimonials</span>
            <h2>Domestic, local, and international journeys in travelers’ own words</h2>
            <p>These sections are powered from admin-managed review categories and can be extended any time.</p>
        </div>
        <div class="tab-buttons" data-tab-group="home-testimonials">
            <?php foreach ($videoCategories as $index => $category): ?>
                <button type="button" class="tab-button <?php echo $index === 0 ? 'is-active' : ''; ?>" data-tab-button="<?php echo e($category); ?>" data-tab-group-name="home-testimonials">
                    <?php echo e(reviewCategoryLabel($category)); ?>
                </button>
            <?php endforeach; ?>
        </div>
        <?php foreach ($videoCategories as $index => $category): ?>
            <div class="tab-panel <?php echo $index === 0 ? 'is-active' : ''; ?>" data-tab-panel="<?php echo e($category); ?>" data-tab-group-name="home-testimonials">
                <div class="video-grid">
                    <?php foreach (($reviewGroups[$category] ?? []) as $review): ?>
                        <article class="video-card">
                            <video controls preload="metadata">
                                <source src="<?php echo e($review['media_url']); ?>" type="video/mp4">
                            </video>
                            <div class="video-copy">
                                <h3><?php echo e($review['title']); ?></h3>
                                <p><?php echo e($review['content']); ?></p>
                                <ul class="info-list">
                                    <li>Traveler From: <?php echo e($review['traveler_from']); ?></li>
                                    <li>Trip Route: <?php echo e($review['route']); ?></li>
                                    <li>Date: <?php echo e($review['date']); ?></li>
                                </ul>
                            </div>
                        </article>
                    <?php endforeach; ?>
                </div>
            </div>
        <?php endforeach; ?>
    </div>
</section>

<section class="section section-image-feature" style="--feature-image:url('<?php echo e($home['offer']['image']); ?>');">
    <div class="container">
        <div class="image-feature-card">
            <span class="eyebrow">What We Offer</span>
            <h2><?php echo e($home['offer']['title']); ?></h2>
            <p><?php echo e($home['offer']['content']); ?></p>
        </div>
    </div>
</section>

<section class="section">
    <div class="container split-layout">
        <div class="split-copy">
            <span class="eyebrow">Service Description</span>
            <h2><?php echo e($home['service']['title']); ?></h2>
            <p><?php echo e($home['service']['content']); ?></p>
            <ul class="check-list">
                <?php foreach ($home['service']['highlights'] as $highlight): ?>
                    <li><?php echo e($highlight); ?></li>
                <?php endforeach; ?>
            </ul>
        </div>
        <div class="showcase-panel">
            <div class="showcase-stat">
                <strong>Fleet-ready</strong>
                <span>Urbania and Tempo Traveller options for varied passenger counts.</span>
            </div>
            <div class="showcase-stat">
                <strong>Route coverage</strong>
                <span>Popular spiritual, hill, wedding, city, and long-distance circuits.</span>
            </div>
            <div class="showcase-stat">
                <strong>Booking support</strong>
                <span>Quick WhatsApp and phone coordination for cleaner travel planning.</span>
            </div>
        </div>
    </div>
</section>

<section class="section section-sand">
    <div class="container">
        <div class="section-head">
            <span class="eyebrow">Popular Destinations</span>
            <h2>Chandigarh departures for routes travelers request most often</h2>
            <p>Select a route, review the travel vibe, and move into booking in a few taps.</p>
        </div>
        <div class="chip-list">
            <?php foreach ($destinations as $destination): ?>
                <span class="chip"><?php echo e($destination['route']); ?></span>
            <?php endforeach; ?>
        </div>
        <div class="destination-grid">
            <?php foreach ($destinations as $destination): ?>
                <article class="destination-card">
                    <img src="<?php echo e($destination['image']); ?>" alt="<?php echo e($destination['route']); ?>">
                    <div class="destination-copy">
                        <span class="eyebrow"><?php echo e($destination['tag']); ?></span>
                        <h3><?php echo e($destination['route']); ?></h3>
                        <p><?php echo e($destination['summary']); ?></p>
                        <a href="<?php echo e(bookingPageUrl()); ?>" class="button button-ghost">Book Now</a>
                    </div>
                </article>
            <?php endforeach; ?>
        </div>
    </div>
</section>

<section class="section">
    <div class="container">
        <div class="section-head">
            <span class="eyebrow">Premium Vehicles</span>
            <h2>Urbania and Tempo Traveller options for every kind of premium group trip</h2>
        </div>
        <div class="card-grid">
            <?php foreach ($vehicles as $vehicle): ?>
                <article class="vehicle-card">
                    <img src="<?php echo e($vehicle['image']); ?>" alt="<?php echo e($vehicle['name']); ?>">
                    <div class="vehicle-copy">
                        <span class="eyebrow"><?php echo e($vehicle['accent']); ?></span>
                        <h3><?php echo e($vehicle['name']); ?></h3>
                        <p><?php echo e($vehicle['summary']); ?></p>
                        <ul class="check-list compact">
                            <?php foreach ($vehicle['highlights'] as $highlight): ?>
                                <li><?php echo e($highlight); ?></li>
                            <?php endforeach; ?>
                        </ul>
                    </div>
                </article>
            <?php endforeach; ?>
        </div>
    </div>
</section>

<section class="section section-dark">
    <div class="container">
        <div class="section-head section-head-center">
            <span class="eyebrow">Features and Benefits</span>
            <h2>Why travelers keep coming back to <?php echo e(siteConfig('site_name')); ?></h2>
        </div>
        <div class="feature-grid">
            <?php foreach ($home['benefits'] as $benefit): ?>
                <article class="feature-card">
                    <span class="feature-icon"><?php echo e(substr($benefit, 0, 1)); ?></span>
                    <h3><?php echo e($benefit); ?></h3>
                    <p>Designed to keep booking simple and the journey feeling polished across every stop.</p>
                </article>
            <?php endforeach; ?>
        </div>
    </div>
</section>
<?php require __DIR__ . '/includes/footer.php'; ?>
