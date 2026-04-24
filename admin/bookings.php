<?php
$adminPageTitle = 'Booking Management';
$adminPage = 'bookings';

require_once __DIR__ . '/../includes/bootstrap.php';
requireAdmin();

if (isPost()) {
    $bookingId = trim($_POST['booking_id'] ?? '');
    $status = trim($_POST['status'] ?? 'pending');
    $allowedStatuses = ['pending', 'confirmed', 'cancelled'];
    if (!in_array($status, $allowedStatuses, true)) {
        $status = 'pending';
    }

    $bookings = collection('bookings');
    $bookingFound = false;
    $flashType = 'success';
    $flashMessage = 'Booking status updated.';

    foreach ($bookings as &$booking) {
        if (($booking['id'] ?? '') === $bookingId) {
            $bookingFound = true;
            $previousStatus = strtolower(trim((string) ($booking['status'] ?? 'pending')));
            $booking['status'] = $status;
            $booking['status_updated_at'] = date('c');

            if ($previousStatus === $status) {
                $flashMessage = 'Status was unchanged.';
            } else {
                $whatsAppUrl = bookingStatusWhatsappUrl($booking, $status);

                if ($whatsAppUrl !== null) {
                    queueBrowserOpenUrl($whatsAppUrl);
                    queueBrowserAlert('Booking status updated. WhatsApp chat opened for the customer.');
                    $flashMessage = 'Booking status updated. WhatsApp opened for the customer.';
                } elseif (in_array($status, ['confirmed', 'cancelled'], true)) {
                    $flashType = 'warning';
                    $flashMessage = 'Booking status updated, but the customer phone number is not valid for WhatsApp.';
                }
            }

            break;
        }
    }
    unset($booking);

    saveCollection('bookings', $bookings);

    if (!$bookingFound) {
        setFlash('warning', 'Booking not found.');
        redirectTo('/admin/bookings.php');
    }

    setFlash($flashType, $flashMessage);
    redirectTo('/admin/bookings.php');
}

$bookings = sortByDateDesc(collection('bookings'));
require __DIR__ . '/partials/top.php';
?>
<section class="table-card">
    <div class="table-card-head">
        <h2>All Booking Requests</h2>
    </div>
    <table class="admin-table">
        <thead>
            <tr>
                <th>Name</th>
                <th>Phone</th>
                <th>Route</th>
                <th>Pickup</th>
                <th>Vehicle</th>
                <th>Status</th>
            </tr>
        </thead>
        <tbody>
            <?php foreach ($bookings as $booking): ?>
                <tr>
                    <td><?php echo e(bookingDisplayName($booking)); ?></td>
                    <td><?php echo e($booking['phone']); ?></td>
                    <td><?php echo e(bookingRouteLabel($booking)); ?></td>
                    <td><?php echo e(formatBookingPickup($booking)); ?></td>
                    <td><?php echo e(bookingVehicleLabel($booking)); ?></td>
                    <td>
                        <form method="post" class="inline-form">
                            <input type="hidden" name="booking_id" value="<?php echo e($booking['id']); ?>">
                            <select name="status">
                                <?php foreach (['pending', 'confirmed', 'cancelled'] as $status): ?>
                                    <option value="<?php echo e($status); ?>" <?php echo ($booking['status'] ?? 'pending') === $status ? 'selected' : ''; ?>><?php echo e(ucfirst($status)); ?></option>
                                <?php endforeach; ?>
                            </select>
                            <button type="submit" class="button button-ghost">Update</button>
                        </form>
                    </td>
                </tr>
            <?php endforeach; ?>
        </tbody>
    </table>
</section>
<?php require __DIR__ . '/partials/bottom.php'; ?>
