<?php
require_once __DIR__ . '/../includes/bootstrap.php';

if (isAdminLoggedIn()) {
    redirectTo('/admin/index.php');
}

$flash = pullFlash();
$email = '';

if (isPost()) {
    $email = trim($_POST['email'] ?? '');
    $password = $_POST['password'] ?? '';

    if (attemptAdminLogin($email, $password)) {
        setFlash('success', 'Welcome to the admin panel.');
        redirectTo('/admin/index.php');
    }

    $flash = ['type' => 'warning', 'message' => 'Invalid admin credentials.'];
}
?>
<!doctype html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Admin Login | <?php echo e(siteConfig('site_name')); ?></title>
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Cormorant+Garamond:wght@600;700&family=Manrope:wght@400;500;600;700;800&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="<?php echo e(assetUrl('css/styles.css')); ?>">
</head>
<body class="login-body">
    <div class="login-card">
        <span class="eyebrow">Admin Authentication</span>
        <h1>Sign in to manage the website</h1>
        <p>Sign in with an admin account stored in the <code>admins</code> database table.</p>
        <?php if ($flash): ?>
            <div class="flash flash-<?php echo e($flash['type']); ?>">
                <?php echo e($flash['message']); ?>
            </div>
        <?php endif; ?>
        <form method="post" class="admin-form-grid">
            <label>
                <span>Email</span>
                <input type="email" name="email" value="<?php echo e($email); ?>" required>
            </label>
            <label>
                <span>Password</span>
                <input type="password" name="password" required>
            </label>
            <button type="submit" class="button button-primary">Login</button>
        </form>
    </div>
</body>
</html>
