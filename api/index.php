<?php

use Illuminate\Foundation\Application;
use Illuminate\Http\Request;

define('LARAVEL_START', microtime(true));

// 1. Prepare writable storage directories in /tmp for Vercel
$tmpStorage = '/tmp/storage';
@mkdir($tmpStorage . '/framework/views', 0777, true);
@mkdir($tmpStorage . '/framework/cache/data', 0777, true);
@mkdir($tmpStorage . '/framework/sessions', 0777, true);
@mkdir($tmpStorage . '/logs', 0777, true);

// 2. Configure environment fallbacks
putenv('APP_ENV=production');
putenv('APP_DEBUG=true');
$_ENV['APP_DEBUG'] = 'true';

if (!getenv('APP_KEY')) {
    $fallbackKey = 'base64:' . base64_encode(random_bytes(32));
    putenv('APP_KEY=' . $fallbackKey);
    $_ENV['APP_KEY'] = $fallbackKey;
}

putenv('VIEW_COMPILED_PATH=' . $tmpStorage . '/framework/views');
putenv('SESSION_DRIVER=cookie');
putenv('CACHE_STORE=array');
putenv('LOG_CHANNEL=stderr');

// 3. Database fallback to SQLite in /tmp if MySQL 127.0.0.1 is specified
if (!getenv('DB_CONNECTION') || getenv('DB_CONNECTION') === 'mysql') {
    putenv('DB_CONNECTION=sqlite');
    putenv('DB_DATABASE=' . $tmpStorage . '/database.sqlite');
    $_ENV['DB_CONNECTION'] = 'sqlite';
    $_ENV['DB_DATABASE'] = $tmpStorage . '/database.sqlite';
    if (!file_exists($tmpStorage . '/database.sqlite')) {
        @touch($tmpStorage . '/database.sqlite');
    }
}

// 4. Require composer autoloader & bootstrap Laravel
require __DIR__ . '/../vendor/autoload.php';

/** @var Application $app */
$app = require_once __DIR__ . '/../bootstrap/app.php';

// 5. Explicitly override storage path to writable /tmp/storage
$app->useStoragePath($tmpStorage);

// 6. Handle HTTP request
$app->handleRequest(Request::capture());
