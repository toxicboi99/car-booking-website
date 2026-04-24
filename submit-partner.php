<?php

require_once __DIR__ . '/includes/bootstrap.php';

if (!isPost()) {
    redirectTo('/partner.php');
}

$payload = [
    'id' => uniqid('partner_', true),
    'name' => trim($_POST['name'] ?? ''),
    'email' => trim($_POST['email'] ?? ''),
    'phone' => trim($_POST['phone'] ?? ''),
    'city' => trim($_POST['city'] ?? ''),
    'company' => trim($_POST['company'] ?? ''),
    'category' => trim($_POST['category'] ?? ''),
    'comments' => trim($_POST['comments'] ?? ''),
    'status' => 'new',
    'created_at' => date('c'),
];

if ($payload['name'] === '' || $payload['email'] === '' || $payload['phone'] === '' || $payload['city'] === '' || $payload['category'] === '') {
    setFlash('warning', 'Please complete the partner form before submitting.');
    redirectTo('/partner.php');
}

$partners = collection('partners');
$partners[] = $payload;

saveCollection('partners', $partners);
setFlash('success', 'Thank you for your interest. Our partnership team will get in touch soon.');
redirectTo('/partner.php');
