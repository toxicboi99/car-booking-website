<?php
require_once __DIR__ . '/../includes/bootstrap.php';

logoutAdmin();
setFlash('success', 'You have been logged out.');
redirectTo('/admin/login.php');
