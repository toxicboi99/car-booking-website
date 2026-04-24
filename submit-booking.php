<?php

require_once __DIR__ . '/includes/bootstrap.php';

if (!isPost()) {
    redirectTo('/index.php');
}

$name = trim($_POST['name'] ?? '');
$phone = trim($_POST['phone'] ?? '');
$fromLocation = trim($_POST['from_location'] ?? '');
$toDestination = trim($_POST['to_destination'] ?? '');
$pickupDate = trim($_POST['pickup_date'] ?? '');
$pickupTime = trim($_POST['pickup_time'] ?? ($_POST['from_time'] ?? ''));
$returnDate = trim($_POST['return_date'] ?? '');
$vehicleName = trim($_POST['vehicle_name'] ?? '');
$context = trim($_POST['context'] ?? 'website');
$returnUrl = trim($_POST['return_url'] ?? '/index.php');
$vehicle = findVehicleByName($vehicleName);

if (
    $name === ''
    || $phone === ''
    || $fromLocation === ''
    || $toDestination === ''
    || $pickupDate === ''
    || $pickupTime === ''
    || $vehicle === null
) {
    setFlash('warning', 'Please fill in all required booking fields, including pickup time, and choose a vehicle.');
    redirectTo($returnUrl);
}

if (preg_match('/^\d{2}:\d{2}$/', $pickupTime) !== 1) {
    setFlash('warning', 'Please enter a valid pickup time.');
    redirectTo($returnUrl);
}

if ($returnDate !== '' && $returnDate < $pickupDate) {
    setFlash('warning', 'Return date cannot be earlier than the pickup date.');
    redirectTo($returnUrl);
}

$bookings = collection('bookings');
$bookings[] = [
    'id' => uniqid('booking_', true),
    'name' => $name,
    'phone' => $phone,
    'from_location' => $fromLocation,
    'to_destination' => $toDestination,
    'pickup_date' => $pickupDate,
    'pickup_time' => $pickupTime,
    'return_date' => $returnDate,
    'vehicle_name' => $vehicle['name'],
    'source' => $vehicle['name'],
    'context' => $context,
    'status' => 'pending',
    'created_at' => date('c'),
];

saveCollection('bookings', $bookings);
queueBrowserAlert('Your booking submitted successfully.');
setFlash('success', 'Your booking submitted successfully.');
redirectTo($returnUrl);
