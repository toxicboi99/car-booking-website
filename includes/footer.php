<?php
$site = siteConfig();
$browserActions = pullBrowserActions();
?>
    </main>
    <footer class="site-footer">
        <div class="container footer-grid">
            <div>
                <span class="eyebrow"><?php echo e($site['site_name']); ?></span>
                <h3>Luxury road experiences that feel easy from the first call.</h3>
                <p>Premium Chandigarh departures for spiritual journeys, family tours, events, and corporate movement.</p>
            </div>
            <div>
                <h4>Quick Links</h4>
                <ul class="footer-links">
                    <li><a href="<?php echo e(appUrl('journey-prayagraj.php')); ?>">Journey to Prayagraj</a></li>
                    <li><a href="<?php echo e(appUrl('fleet.php')); ?>">Our Fleet</a></li>
                    <li><a href="<?php echo e(appUrl('reviews.php')); ?>">Reviews</a></li>
                    <li><a href="<?php echo e(appUrl('partner.php')); ?>">Partner With Us</a></li>
                    <li><a href="<?php echo e(appUrl('admin/login.php')); ?>">Admin Panel</a></li>
                </ul>
            </div>
            <div>
                <h4>Contact</h4>
                <ul class="footer-links">
                    <li><a href="tel:<?php echo e($site['phone_raw']); ?>"><?php echo e($site['phone_display']); ?></a></li>
                    <li><a href="mailto:<?php echo e($site['email']); ?>"><?php echo e($site['email']); ?></a></li>
                    <li><?php echo e($site['address']); ?></li>
                </ul>
            </div>
        </div>
        <div class="container footer-meta">
            <p>&copy; <?php echo e(date('Y')); ?> <?php echo e($site['site_name']); ?>. All rights reserved.</p>
        </div>
    </footer>

    <div class="floating-actions" data-floating-actions>
        <button type="button" class="floating-toggle" data-floating-toggle aria-expanded="true" aria-controls="floating-actions-panel">
            <span data-floating-toggle-icon>X</span>
            <strong data-floating-toggle-label>Hide</strong>
        </button>
        <div class="floating-actions-panel" id="floating-actions-panel" data-floating-panel>
            <a href="https://wa.me/<?php echo e($site['whatsapp_raw']); ?>?text=<?php echo e(rawurlencode('Hello ' . $site['site_name'])); ?>" target="_blank" rel="noreferrer" class="floating-button floating-whatsapp">
                <span>WA</span>
                <strong>WhatsApp</strong>
            </a>
            <?php foreach ($site['socials'] as $social): ?>
                <a href="<?php echo e($social['url']); ?>" target="_blank" rel="noreferrer" class="floating-button">
                    <span><?php echo e($social['short']); ?></span>
                    <strong><?php echo e($social['label']); ?></strong>
                </a>
            <?php endforeach; ?>
        </div>
    </div>

    <script src="<?php echo e(assetUrl('js/main.js')); ?>"></script>
    <?php if ($browserActions): ?>
        <script>
            (() => {
                const actions = <?php echo json_encode($browserActions, JSON_UNESCAPED_SLASHES | JSON_HEX_TAG | JSON_HEX_APOS | JSON_HEX_AMP | JSON_HEX_QUOT); ?>;

                actions.forEach((action) => {
                    if (!action || typeof action !== "object") {
                        return;
                    }

                    if (action.type === "open_url" && action.url) {
                        const popup = window.open(action.url, "_blank");
                        if (!popup || popup.closed || typeof popup.closed === "undefined") {
                            window.location.href = action.url;
                        }
                        return;
                    }

                    if (action.type === "alert" && action.message) {
                        window.alert(action.message);
                    }
                });
            })();
        </script>
    <?php endif; ?>
</body>
</html>
