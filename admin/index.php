<?php
$adminPageTitle = 'Dashboard';
$adminPage = 'dashboard';
require __DIR__ . '/partials/top.php';
?>
<section class="metric-grid">
    <article class="metric-card">
        <span>Total Bookings</span>
        <strong><?php echo e((string) adminMetricCount('bookings')); ?></strong>
    </article>
    <article class="metric-card">
        <span>Pending Bookings</span>
        <strong><?php echo e((string) countBookingsByStatus('pending')); ?></strong>
    </article>
    <article class="metric-card">
        <span>Vehicles</span>
        <strong><?php echo e((string) adminMetricCount('vehicles')); ?></strong>
    </article>
    <article class="metric-card">
        <span>Reviews</span>
        <strong><?php echo e((string) adminMetricCount('reviews')); ?></strong>
    </article>
    <article class="metric-card">
        <span>Gallery Items</span>
        <strong><?php echo e((string) adminMetricCount('gallery')); ?></strong>
    </article>
    <article class="metric-card">
        <span>Partner Leads</span>
        <strong><?php echo e((string) adminMetricCount('partners')); ?></strong>
    </article>
</section>

<section class="admin-grid-two">
    <article class="table-card">
        <div class="table-card-head">
            <h2>Recent Booking Requests</h2>
            <a href="<?php echo e(appUrl('admin/bookings.php')); ?>" class="button button-ghost">Manage</a>
        </div>
        <table class="admin-table">
            <thead>
                <tr>
                    <th>Name</th>
                    <th>Route</th>
                    <th>Pickup</th>
                    <th>Status</th>
                </tr>
            </thead>
            <tbody>
                <?php foreach (array_slice(sortByDateDesc(collection('bookings')), 0, 5) as $booking): ?>
                    <tr>
                        <td><?php echo e(bookingDisplayName($booking)); ?></td>
                        <td><?php echo e($booking['from_location'] . ' to ' . $booking['to_destination']); ?></td>
                        <td><?php echo e(formatBookingPickup($booking)); ?></td>
                        <td><span class="status-pill status-<?php echo e(strtolower($booking['status'])); ?>"><?php echo e($booking['status']); ?></span></td>
                    </tr>
                <?php endforeach; ?>
            </tbody>
        </table>
    </article>

    <article class="table-card">
        <div class="table-card-head">
            <h2>Recent Partner Leads</h2>
            <a href="<?php echo e(appUrl('admin/partners.php')); ?>" class="button button-ghost">Manage</a>
        </div>
        <table class="admin-table">
            <thead>
                <tr>
                    <th>Name</th>
                    <th>City</th>
                    <th>Status</th>
                </tr>
            </thead>
            <tbody>
                <?php foreach (array_slice(sortByDateDesc(collection('partners')), 0, 5) as $lead): ?>
                    <tr>
                        <td><?php echo e($lead['name']); ?></td>
                        <td><?php echo e($lead['city']); ?></td>
                        <td><span class="status-pill status-<?php echo e(strtolower($lead['status'])); ?>"><?php echo e($lead['status']); ?></span></td>
                    </tr>
                <?php endforeach; ?>
            </tbody>
        </table>
    </article>
</section>

<section class="table-card">
    <div class="table-card-head">
        <h2>Admin Notes</h2>
    </div>
    <p>This panel is functional with JSON storage for local preview, while <code>/database/schema.sql</code> includes the MySQL structure needed for production deployment. Vehicle, review, gallery, destination, booking, and partner data all feed the public site dynamically.</p>
</section>
<?php require __DIR__ . '/partials/bottom.php'; ?>
