<?php
require_once __DIR__ . '/includes/bootstrap.php';

$pageTitle = 'Reviews';
$pageDescription = 'Read ' . siteConfig('site_name') . ' reviews, Google feedback, and video testimonials.';
$currentPage = 'reviews';
$copy = pageCopy('reviews');
$reviewGroups = groupedReviews();

require __DIR__ . '/includes/header.php';
?>
<section class="hero hero-banner" style="--hero-image:url('<?php echo e($copy['hero']['image']); ?>');">
    <div class="hero-overlay"></div>
    <div class="container hero-banner-copy">
        <span class="eyebrow">Customer Stories</span>
        <h1><?php echo e($copy['hero']['title']); ?></h1>
        <p><?php echo e($copy['hero']['subtitle']); ?></p>
    </div>
</section>

<section class="section">
    <div class="container">
        <div class="section-head section-head-center">
            <span class="eyebrow">Google Reviews</span>
            <h2>Verified-style feedback from real bookings</h2>
        </div>
        <div class="slider-shell">
            <div class="slider-actions">
                <button type="button" class="slider-button" data-scroll-target="reviews-page-google" data-scroll-direction="prev">Prev</button>
                <button type="button" class="slider-button" data-scroll-target="reviews-page-google" data-scroll-direction="next">Next</button>
            </div>
            <div class="slider-track" id="reviews-page-google">
                <?php foreach (($reviewGroups['google'] ?? []) as $review): ?>
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

<section class="section section-sand">
    <div class="container centered-copy narrow">
        <span class="eyebrow">Trust Statement</span>
        <h2><?php echo e($copy['trust_heading']); ?></h2>
    </div>
</section>

<?php foreach (['domestic', 'local', 'international'] as $category): ?>
    <section class="section">
        <div class="container">
            <div class="section-head section-head-center">
                <span class="eyebrow">Video Reviews</span>
                <h2><?php echo e(reviewCategoryLabel($category)); ?></h2>
            </div>
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
                                <li>Traveler: <?php echo e($review['name']); ?></li>
                                <li>Route: <?php echo e($review['route']); ?></li>
                                <li>Date: <?php echo e($review['date']); ?></li>
                            </ul>
                        </div>
                    </article>
                <?php endforeach; ?>
            </div>
        </div>
    </section>
<?php endforeach; ?>
<?php require __DIR__ . '/includes/footer.php'; ?>
