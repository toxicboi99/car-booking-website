<?php

function databaseConfig(): array
{
    static $config;

    if ($config !== null) {
        return $config;
    }

    $defaults = require __DIR__ . '/../config/database.php';
    $config = is_array($defaults) ? $defaults : [];

    $envMap = [
        'driver' => 'DB_DRIVER',
        'host' => 'DB_HOST',
        'port' => 'DB_PORT',
        'database' => 'DB_DATABASE',
        'username' => 'DB_USERNAME',
        'password' => 'DB_PASSWORD',
        'charset' => 'DB_CHARSET',
        'collation' => 'DB_COLLATION',
    ];

    foreach ($envMap as $key => $envName) {
        $value = getenv($envName);
        if ($value === false || $value === '') {
            continue;
        }

        $config[$key] = $key === 'port' ? (int) $value : $value;
    }

    $config['driver'] = trim((string) ($config['driver'] ?? 'mysql'));
    $config['host'] = trim((string) ($config['host'] ?? '127.0.0.1'));
    $config['port'] = (int) ($config['port'] ?? 3306);
    $config['database'] = trim((string) ($config['database'] ?? ''));
    $config['username'] = trim((string) ($config['username'] ?? ''));
    $config['password'] = (string) ($config['password'] ?? '');
    $config['charset'] = trim((string) ($config['charset'] ?? 'utf8mb4'));
    $config['collation'] = trim((string) ($config['collation'] ?? 'utf8mb4_unicode_ci'));

    return $config;
}

function databaseDsn(): string
{
    $config = databaseConfig();

    return sprintf(
        '%s:host=%s;port=%d;dbname=%s;charset=%s',
        $config['driver'],
        $config['host'],
        $config['port'],
        $config['database'],
        $config['charset']
    );
}

function dbIsConfigured(): bool
{
    $config = databaseConfig();

    return $config['database'] !== '' && $config['username'] !== '';
}

function db(): PDO
{
    static $pdo;

    if ($pdo instanceof PDO) {
        return $pdo;
    }

    $config = databaseConfig();

    if ($config['database'] === '') {
        throw new RuntimeException('Database name is missing in config/database.php or DB_DATABASE.');
    }

    try {
        $pdo = new PDO(databaseDsn(), $config['username'], $config['password'], [
            PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION,
            PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC,
            PDO::ATTR_EMULATE_PREPARES => false,
        ]);
    } catch (PDOException $exception) {
        throw new RuntimeException('Database connection failed: ' . $exception->getMessage(), 0, $exception);
    }

    return $pdo;
}

function dbTestConnection(): array
{
    try {
        $pdo = db();
        $statement = $pdo->query('SELECT 1');

        return [
            'ok' => $statement !== false,
            'message' => 'Database connection successful.',
        ];
    } catch (Throwable $exception) {
        return [
            'ok' => false,
            'message' => $exception->getMessage(),
        ];
    }
}
