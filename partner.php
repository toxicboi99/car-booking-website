<?php
require_once __DIR__ . '/includes/bootstrap.php';

$pageTitle = 'Partner With Us';
$pageDescription = 'Partner with ' . siteConfig('site_name') . ' for luxury travel leads and operations support.';
$currentPage = 'partner';
$copy = pageCopy('partner');
$gallery = array_slice(collection('gallery'), 0, 3);

require __DIR__ . '/includes/header.php';
?>
<section class="hero hero-banner hero-partner" style="--hero-image:url('<?php echo e($copy['hero']['image']); ?>');">
    <div class="hero-overlay"></div>
    <div class="container hero-banner-copy hero-banner-copy-wide">
        <span class="eyebrow">Partnerships</span>
        <h1><?php echo e($copy['hero']['title']); ?></h1>
        <p><?php echo e($copy['hero']['subtitle']); ?></p>
        <div class="partner-form-wrap">
            <form action="<?php echo e(appUrl('submit-partner.php')); ?>" method="post" class="partner-form">
                <label>
                    <span>Name</span>
                    <input type="text" name="name" required>
                </label>
                <label>
                    <span>Email</span>
                    <input type="email" name="email" required>
                </label>
                <label>
                    <span>Phone</span>
                    <input type="text" name="phone" required>
                </label>
                <label>
                    <span>City / Location</span>
                    <input type="text" name="city" required>
                </label>
                <label>
                    <span>Company</span>
                    <input type="text" name="company">
                </label>
                <label>
                    <span>Category</span>
                    <select name="category" required>
                        <option value="Travel Agent">Travel Agent</option>
                        <option value="Coordinator">Coordinator</option>
                        <option value="Broker">Broker</option>
                        <option value="Corporate Partner">Corporate Partner</option>
                    </select>
                </label>
                <label class="full-span">
                    <span>Comments</span>
                    <textarea name="comments" rows="4"></textarea>
                </label>
                <button type="submit" class="button button-primary">Submit</button>
            </form>
        </div>
    </div>
</section>

<section class="section section-dark">
    <div class="container centered-copy narrow">
        <span class="eyebrow">Partnership Details</span>
        <h2>Built for travel agents, coordinators, brokers, and high-intent referral partners</h2>
        <p><?php echo e($copy['info']); ?></p>
    </div>
</section>

<section class="section">
    <div class="container split-layout">
        <div class="split-copy">
            <span class="eyebrow">Why Partner With Us</span>
            <h2>Strong routes, refined vehicles, and smoother operational follow-through</h2>
            <ul class="check-list">
                <?php foreach ($copy['benefits'] as $benefit): ?>
                    <li><?php echo e($benefit); ?></li>
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
<?php require __DIR__ . '/includes/footer.php'; ?>
