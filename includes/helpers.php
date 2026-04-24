<?php

function storagePath(string $name): string
{
    return __DIR__ . '/../storage/' . $name . '.json';
}

function readJsonFile(string $name, array $fallback = []): array
{
    $path = storagePath($name);

    if (!file_exists($path)) {
        writeJsonFile($name, $fallback);
        return $fallback;
    }

    $content = file_get_contents($path);
    if ($content === false || $content === '') {
        return $fallback;
    }

    $decoded = json_decode($content, true);
    return is_array($decoded) ? $decoded : $fallback;
}

function writeJsonFile(string $name, array $data): bool
{
    $path = storagePath($name);
    return file_put_contents($path, json_encode($data, JSON_PRETTY_PRINT | JSON_UNESCAPED_SLASHES)) !== false;
}

function bootstrapStorage(): void
{
    $seedMap = [
        'vehicles' => seedVehicles(),
        'reviews' => seedReviews(),
        'gallery' => seedGallery(),
        'destinations' => seedDestinations(),
        'bookings' => [],
        'partners' => [],
    ];

    foreach ($seedMap as $name => $seed) {
        if (!file_exists(storagePath($name))) {
            writeJsonFile($name, $seed);
        }
    }
}

function collection(string $name): array
{
    $fallbacks = [
        'vehicles' => seedVehicles(),
        'reviews' => seedReviews(),
        'gallery' => seedGallery(),
        'destinations' => seedDestinations(),
        'bookings' => [],
        'partners' => [],
    ];

    return readJsonFile($name, $fallbacks[$name] ?? []);
}

function saveCollection(string $name, array $items): bool
{
    return writeJsonFile($name, array_values($items));
}

function findById(string $name, string $id): ?array
{
    foreach (collection($name) as $item) {
        if (($item['id'] ?? '') === $id) {
            return $item;
        }
    }

    return null;
}

function upsertItem(string $name, array $payload): bool
{
    $items = collection($name);
    $updated = false;

    if (!empty($payload['id'])) {
        foreach ($items as $index => $item) {
            if (($item['id'] ?? '') === $payload['id']) {
                $items[$index] = array_merge($item, $payload);
                $updated = true;
                break;
            }
        }
    }

    if (!$updated) {
        $payload['id'] = $payload['id'] ?: uniqid($name . '_', true);
        $items[] = $payload;
    }

    return saveCollection($name, $items);
}

function deleteItem(string $name, string $id): bool
{
    $items = array_filter(collection($name), static function (array $item) use ($id): bool {
        return ($item['id'] ?? '') !== $id;
    });

    return saveCollection($name, $items);
}

function e(?string $value): string
{
    return htmlspecialchars((string) $value, ENT_QUOTES, 'UTF-8');
}

function normalizePathSlashes(string $path): string
{
    return str_replace('\\', '/', $path);
}

function appBasePath(): string
{
    static $basePath;

    if ($basePath !== null) {
        return $basePath;
    }

    $scriptName = normalizePathSlashes((string) ($_SERVER['SCRIPT_NAME'] ?? ''));
    $scriptDirectory = normalizePathSlashes((string) dirname($scriptName));
    $scriptDirectory = trim($scriptDirectory, '/.');
    $scriptDirectory = $scriptDirectory === '' ? '' : '/' . $scriptDirectory;

    $projectRoot = normalizePathSlashes((string) realpath(__DIR__ . '/..'));
    $scriptFilename = normalizePathSlashes((string) ($_SERVER['SCRIPT_FILENAME'] ?? ''));
    $scriptFileDirectory = normalizePathSlashes((string) dirname($scriptFilename));
    $relativeDirectory = '';

    if ($projectRoot !== '' && $scriptFileDirectory !== '') {
        $projectRoot = rtrim($projectRoot, '/');

        if ($scriptFileDirectory === $projectRoot) {
            $relativeDirectory = '';
        } elseif (strpos($scriptFileDirectory, $projectRoot . '/') === 0) {
            $relativeDirectory = trim(substr($scriptFileDirectory, strlen($projectRoot)), '/');
        }
    }

    if ($relativeDirectory === '') {
        $basePath = $scriptDirectory;
        return $basePath;
    }

    $webSegments = $scriptDirectory === '' ? [] : explode('/', trim($scriptDirectory, '/'));
    $relativeSegments = explode('/', $relativeDirectory);

    if (count($webSegments) >= count($relativeSegments)) {
        $webSegments = array_slice($webSegments, 0, count($webSegments) - count($relativeSegments));
    } else {
        $webSegments = [];
    }

    $basePath = empty($webSegments) ? '' : '/' . implode('/', $webSegments);
    return $basePath;
}

function appUrl(string $path = ''): string
{
    if ($path === '') {
        $basePath = appBasePath();
        return $basePath === '' ? '/' : $basePath;
    }

    if (preg_match('/^[a-z][a-z0-9+\-.]*:/i', $path) === 1 || strpos($path, '//') === 0) {
        return $path;
    }

    $basePath = appBasePath();
    $normalizedPath = '/' . ltrim($path, '/');

    return $basePath === '' ? $normalizedPath : $basePath . $normalizedPath;
}

function bookingPageUrl(string $anchor = 'urbania-booking', string $path = 'book-force-urbania.php'): string
{
    $targetPath = ltrim($path, '/');
    $targetAnchor = ltrim(trim($anchor), '#');

    if ($targetAnchor !== '') {
        $targetPath .= '#' . $targetAnchor;
    }

    return appUrl($targetPath);
}

function assetUrl(string $path): string
{
    return appUrl('assets/' . ltrim($path, '/'));
}

function currentRequestUri(): string
{
    $requestUri = trim((string) ($_SERVER['REQUEST_URI'] ?? ''));

    if ($requestUri !== '') {
        return $requestUri;
    }

    return appUrl('index.php');
}

function normalizeAppPath(?string $path, string $fallback = 'index.php'): string
{
    $fallbackPath = appUrl($fallback);

    if (!is_string($path) || trim($path) === '') {
        return $fallbackPath;
    }

    $parts = parse_url(trim($path));
    if ($parts === false || isset($parts['scheme']) || isset($parts['host'])) {
        return $fallbackPath;
    }

    $requestPath = normalizePathSlashes((string) ($parts['path'] ?? ''));
    $requestPath = preg_replace('#/+#', '/', $requestPath) ?: '';
    $query = isset($parts['query']) && $parts['query'] !== '' ? '?' . $parts['query'] : '';
    $fragment = isset($parts['fragment']) && $parts['fragment'] !== '' ? '#' . $parts['fragment'] : '';

    if ($requestPath === '' || $requestPath === '/') {
        return $fallbackPath . $query . $fragment;
    }

    $basePath = appBasePath();
    if ($basePath !== '' && ($requestPath === $basePath || strpos($requestPath, $basePath . '/') === 0)) {
        return $requestPath . $query . $fragment;
    }

    return appUrl(ltrim($requestPath, '/')) . $query . $fragment;
}

function siteConfig(?string $key = null)
{
    static $config;
    if ($config === null) {
        $config = require __DIR__ . '/../config/site.php';
    }

    return $key === null ? $config : ($config[$key] ?? null);
}

function pageCopy(?string $key = null)
{
    static $copy;
    if ($copy === null) {
        $copy = pageNarratives();
    }

    return $key === null ? $copy : ($copy[$key] ?? []);
}

function setFlash(string $type, string $message): void
{
    $_SESSION['flash'] = [
        'type' => $type,
        'message' => $message,
    ];
}

function pullFlash(): ?array
{
    if (!isset($_SESSION['flash'])) {
        return null;
    }

    $flash = $_SESSION['flash'];
    unset($_SESSION['flash']);

    return $flash;
}

function queueBrowserAction(string $type, array $payload = []): void
{
    $actions = $_SESSION['browser_actions'] ?? [];
    $actions[] = array_merge(['type' => $type], $payload);
    $_SESSION['browser_actions'] = $actions;
}

function queueBrowserAlert(string $message): void
{
    $message = trim($message);
    if ($message !== '') {
        queueBrowserAction('alert', ['message' => $message]);
    }
}

function queueBrowserOpenUrl(string $url): void
{
    $url = trim($url);
    if ($url !== '') {
        queueBrowserAction('open_url', ['url' => $url]);
    }
}

function pullBrowserActions(): array
{
    $actions = $_SESSION['browser_actions'] ?? [];
    unset($_SESSION['browser_actions']);

    return is_array($actions) ? array_values($actions) : [];
}

function redirectTo(string $path): void
{
    header('Location: ' . normalizeAppPath($path));
    exit;
}

function isPost(): bool
{
    return ($_SERVER['REQUEST_METHOD'] ?? 'GET') === 'POST';
}

function bookingVehicles(): array
{
    return array_values(array_filter(collection('vehicles'), static function (array $vehicle): bool {
        return trim((string) ($vehicle['name'] ?? '')) !== '';
    }));
}

function findVehicleByName(string $name): ?array
{
    $needle = trim($name);
    if ($needle === '') {
        return null;
    }

    foreach (bookingVehicles() as $vehicle) {
        if (strcasecmp((string) ($vehicle['name'] ?? ''), $needle) === 0) {
            return $vehicle;
        }
    }

    return null;
}

function bookingDisplayName(array $booking): string
{
    return trim((string) ($booking['name'] ?? $booking['customer_name'] ?? ''));
}

function formatDisplayDateTime(?string $value, string $fallback = 'Not provided'): string
{
    $normalized = trim((string) $value);
    if ($normalized === '') {
        return $fallback;
    }

    $timestamp = strtotime($normalized);
    if ($timestamp === false) {
        return $normalized;
    }

    return date('d M Y h:i A', $timestamp);
}

function formatDisplayDate(?string $value, string $fallback = 'Not provided'): string
{
    $normalized = trim((string) $value);
    if ($normalized === '') {
        return $fallback;
    }

    $timestamp = strtotime($normalized);
    if ($timestamp === false) {
        return $normalized;
    }

    return date('d M Y', $timestamp);
}

function formatDisplayTime(?string $value, string $fallback = 'Not provided'): string
{
    $normalized = trim((string) $value);
    if ($normalized === '') {
        return $fallback;
    }

    $timestamp = strtotime($normalized);
    if ($timestamp === false) {
        return $normalized;
    }

    return date('h:i A', $timestamp);
}

function formatBookingPickup(array $booking): string
{
    $pickupDate = formatDisplayDate($booking['pickup_date'] ?? '', '');
    $pickupTime = formatDisplayTime($booking['pickup_time'] ?? '', '');

    if ($pickupDate === '' && $pickupTime === '') {
        return 'Not provided';
    }

    if ($pickupDate === '') {
        return $pickupTime;
    }

    if ($pickupTime === '') {
        return $pickupDate;
    }

    return $pickupDate . ' at ' . $pickupTime;
}

function bookingRouteLabel(array $booking): string
{
    $fromLocation = trim((string) ($booking['from_location'] ?? ''));
    $toDestination = trim((string) ($booking['to_destination'] ?? ''));

    if ($fromLocation !== '' && $toDestination !== '') {
        return $fromLocation . ' to ' . $toDestination;
    }

    return $fromLocation !== '' ? $fromLocation : ($toDestination !== '' ? $toDestination : 'Not provided');
}

function bookingVehicleLabel(array $booking): string
{
    $vehicle = trim((string) ($booking['vehicle_name'] ?? $booking['source'] ?? ''));
    return $vehicle !== '' ? $vehicle : 'Not selected';
}

function bookingStatusLabel(string $status): string
{
    $normalized = strtolower(trim($status));
    $labels = [
        'pending' => 'Pending',
        'confirmed' => 'Confirmed',
        'cancelled' => 'Cancelled',
    ];

    return $labels[$normalized] ?? ucwords(str_replace('_', ' ', $normalized));
}

function normalizePhoneDigits(string $value): string
{
    return preg_replace('/\D+/', '', $value) ?? '';
}

function normalizeWhatsAppPhoneNumber(string $value): string
{
    $digits = normalizePhoneDigits($value);
    if ($digits === '') {
        return '';
    }

    if (strpos($digits, '00') === 0) {
        $digits = substr($digits, 2);
    }

    if (strlen($digits) === 10) {
        $digits = '91' . $digits;
    }

    return $digits;
}

function bookingStatusWhatsappMessage(array $booking, string $status): ?string
{
    $normalizedStatus = strtolower(trim($status));
    if (!in_array($normalizedStatus, ['confirmed', 'cancelled'], true)) {
        return null;
    }

    $name = bookingDisplayName($booking);
    $route = bookingRouteLabel($booking);
    $pickup = formatBookingPickup($booking);
    $vehicle = bookingVehicleLabel($booking);
    $supportNumber = '+' . normalizePhoneDigits((string) siteConfig('whatsapp_raw'));
    $siteName = (string) siteConfig('site_name');

    if ($normalizedStatus === 'confirmed') {
        return 'Hello ' . $name . ', your booking with ' . $siteName . ' is confirmed. '
            . 'Route: ' . $route . '. '
            . 'Pickup: ' . $pickup . '. '
            . 'Vehicle: ' . $vehicle . '. '
            . 'For help, contact us on ' . $supportNumber . '.';
    }

    return 'Hello ' . $name . ', your booking with ' . $siteName . ' has been cancelled. '
        . 'Route: ' . $route . '. '
        . 'Pickup: ' . $pickup . '. '
        . 'Please contact us on ' . $supportNumber . ' for help or rebooking.';
}

function bookingStatusWhatsappUrl(array $booking, string $status): ?string
{
    $message = bookingStatusWhatsappMessage($booking, $status);
    $recipient = normalizeWhatsAppPhoneNumber((string) ($booking['phone'] ?? ''));

    if ($message === null || $recipient === '') {
        return null;
    }

    return 'https://wa.me/' . $recipient . '?text=' . rawurlencode($message);
}

function reviewCategories(): array
{
    return siteConfig('review_categories');
}

function reviewCategoryLabel(string $category): string
{
    $categories = reviewCategories();
    return $categories[$category] ?? ucwords(str_replace('_', ' ', $category));
}

function groupedReviews(): array
{
    $groups = [
        'google' => [],
        'domestic' => [],
        'local' => [],
        'international' => [],
    ];

    foreach (collection('reviews') as $review) {
        $category = $review['category'] ?? 'google';
        if (!isset($groups[$category])) {
            $groups[$category] = [];
        }
        $groups[$category][] = $review;
    }

    return $groups;
}

function starString(int $rating): string
{
    return str_repeat('★', max(1, min(5, $rating)));
}

function activePage(string $page, string $current): string
{
    return $page === $current ? 'is-active' : '';
}

function isAdminLoggedIn(): bool
{
    return !empty($_SESSION['admin_logged_in']);
}

function attemptAdminLogin(string $email, string $password): bool
{
    if (!dbIsConfigured()) {
        return false;
    }

    try {
        $statement = db()->prepare('SELECT id, name, email, password_hash FROM admins WHERE email = :email LIMIT 1');
        $statement->execute([
            'email' => trim($email),
        ]);
        $admin = $statement->fetch();
    } catch (Throwable $exception) {
        return false;
    }

    if (!$admin || !password_verify($password, $admin['password_hash'])) {
        return false;
    }

    $_SESSION['admin_logged_in'] = true;
    $_SESSION['admin_id'] = (int) $admin['id'];
    $_SESSION['admin_name'] = $admin['name'];
    $_SESSION['admin_email'] = $admin['email'];

    return true;
}

function logoutAdmin(): void
{
    unset($_SESSION['admin_logged_in'], $_SESSION['admin_id'], $_SESSION['admin_name'], $_SESSION['admin_email']);
}

function requireAdmin(): void
{
    if (!isAdminLoggedIn()) {
        setFlash('warning', 'Please log in to access the admin panel.');
        redirectTo('/admin/login.php');
    }
}

function adminMetricCount(string $collectionName): int
{
    return count(collection($collectionName));
}

function countBookingsByStatus(string $status): int
{
    return count(array_filter(collection('bookings'), static function (array $booking) use ($status): bool {
        return strtolower((string) ($booking['status'] ?? 'pending')) === strtolower($status);
    }));
}

function sortByDateDesc(array $items, string $field = 'created_at'): array
{
    usort($items, static function (array $left, array $right) use ($field): int {
        return strcmp((string) ($right[$field] ?? ''), (string) ($left[$field] ?? ''));
    });

    return $items;
}

function bookingCtaDefaults(): array
{
    return [
        'title' => 'Ready to plan your next premium road journey?',
        'copy' => 'Tell us your route, dates, and passenger count. We will match the right vehicle and get back to you quickly.',
    ];
}
