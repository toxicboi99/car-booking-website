<?php

$sessionPath = __DIR__ . '/../storage/sessions';
if (!is_dir($sessionPath)) {
    mkdir($sessionPath, 0777, true);
}

if (session_status() !== PHP_SESSION_ACTIVE) {
    session_save_path($sessionPath);
    session_start();
}

require_once __DIR__ . '/db.php';
require_once __DIR__ . '/content.php';
require_once __DIR__ . '/helpers.php';

bootstrapStorage();
