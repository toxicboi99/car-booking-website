<?php
$bookingTitle = $bookingTitle ?? 'Quick Booking';
$bookingTheme = $bookingTheme ?? 'light';
$bookingContext = $bookingContext ?? 'website';
$bookingClass = $bookingClass ?? '';
$bookingSelectedVehicle = $bookingSelectedVehicle ?? '';
$bookingFormId = $bookingFormId ?? 'booking-form';
$bookingReturnUrl = $bookingReturnUrl ?? (currentRequestUri() . '#' . $bookingFormId);
$vehicles = bookingVehicles();
?>
<div id="<?php echo e($bookingFormId); ?>" class="booking-card <?php echo e($bookingTheme === 'dark' ? 'booking-card-dark' : ''); ?> <?php echo e($bookingClass); ?>">
    <div class="booking-card-head">
        <span class="eyebrow">Fast enquiry</span>
        <h3><?php echo e($bookingTitle); ?></h3>
        <p>Share your travel plan and our team will help with route and vehicle recommendations.</p>
    </div>
    <form action="<?php echo e(appUrl('submit-booking.php')); ?>" method="post" class="booking-form">
        <input type="hidden" name="return_url" value="<?php echo e($bookingReturnUrl); ?>">
        <input type="hidden" name="context" value="<?php echo e($bookingContext); ?>">
        <label>
            <span>Name</span>
            <input type="text" name="name" placeholder="Your full name" required>
        </label>
        <label>
            <span>Phone / WhatsApp</span>
            <input type="text" name="phone" placeholder="+91 98xxxxxx" required>
        </label>
        <label>
            <span>From</span>
            <input type="text" name="from_location" placeholder="Pickup city" required>
        </label>
        <label>
            <span>To</span>
            <input type="text" name="to_destination" placeholder="Destination" required>
        </label>
        <label>
            <span>Pickup date</span>
            <input type="date" name="pickup_date" required>
        </label>
        <label>
            <span>Pickup time</span>
            <input type="time" name="pickup_time" required>
        </label>
        <label>
            <span>Return date</span>
            <input type="date" name="return_date">
        </label>
        <label>
            <span>Vehicle Name</span>
            <select name="vehicle_name" required>
                <option value="">Choose vehicle</option>
                <?php foreach ($vehicles as $vehicle): ?>
                    <option value="<?php echo e($vehicle['name']); ?>" <?php echo $bookingSelectedVehicle === ($vehicle['name'] ?? '') ? 'selected' : ''; ?>>
                        <?php echo e($vehicle['name']); ?>
                    </option>
                <?php endforeach; ?>
            </select>
        </label>
        <button type="submit" class="button button-primary">Book Now</button>
    </form>
</div>
