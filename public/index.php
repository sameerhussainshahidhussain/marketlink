<?php

use Illuminate\Http\Request;

define('LARAVEL_START', microtime(true));

// 1. If Composer vendor autoloader exists, run standard Laravel 11/10
if (file_exists(__DIR__ . '/../vendor/autoload.php')) {
    require __DIR__ . '/../vendor/autoload.php';

    if (file_exists($maintenance = __DIR__ . '/../storage/framework/maintenance.php')) {
        require $maintenance;
    }

    if (file_exists(__DIR__ . '/../bootstrap/app.php')) {
        (require_once __DIR__ . '/../bootstrap/app.php')
            ->handleRequest(Request::capture());
        exit;
    }
}

// 2. Standalone Frontend PHP / Blade Preview Engine
// This enables instant testing with 'php -S localhost:8000 -t public' without requiring composer install first!
$uri = parse_url($_SERVER['REQUEST_URI'], PHP_URL_PATH);
$uri = rtrim($uri, '/');
if ($uri === '') {
    $uri = '/';
}

// Static asset serving if run with built-in server
$filePath = __DIR__ . $uri;
if ($uri !== '/' && file_exists($filePath) && !is_dir($filePath)) {
    return false; // let built-in server serve static file
}

// Route mapping
$routes = [
    '/' => 'index.blade.php',
    '/home' => 'index.blade.php',
    '/markets' => 'pages/markets.blade.php',
    '/market-details' => 'pages/market-details.blade.php',
    '/farmers' => 'pages/farmers.blade.php',
    '/farmer-profile' => 'pages/farmer-profile.blade.php',
    '/products' => 'pages/products.blade.php',
    '/product-details' => 'pages/product-details.blade.php',
    '/cart' => 'pages/cart.blade.php',
    '/checkout' => 'pages/checkout.blade.php',
    '/order-confirmation' => 'pages/order-confirmation.blade.php',
    '/order-tracking' => 'pages/order-tracking.blade.php',
    '/favorites' => 'pages/favorites.blade.php',
    '/map' => 'pages/map.blade.php',
    '/about' => 'pages/about.blade.php',
    '/contact' => 'pages/contact.blade.php',
    '/login' => 'pages/login.blade.php',
    '/register' => 'pages/register.blade.php',
    '/forgot-password' => 'pages/forgot-password.blade.php',
];

$viewFile = null;

if (isset($routes[$uri])) {
    $viewFile = $routes[$uri];
} elseif (preg_match('#^/customer/([a-zA-Z0-9_-]+)$#', $uri, $matches)) {
    $viewFile = 'customer/' . $matches[1] . '.blade.php';
} elseif (preg_match('#^/farmer/([a-zA-Z0-9_-]+)$#', $uri, $matches)) {
    $viewFile = 'farmer/' . $matches[1] . '.blade.php';
} elseif (preg_match('#^/admin/([a-zA-Z0-9_-]+)$#', $uri, $matches)) {
    $viewFile = 'admin/' . $matches[1] . '.blade.php';
}

$viewsPath = realpath(__DIR__ . '/../resources/views');
$targetView = $viewsPath . '/' . $viewFile;

if ($viewFile && file_exists($targetView)) {
    $content = file_get_contents($targetView);

    // Simple blade directive render for preview
    // 1. Replace {{ asset('...') }} with base relative asset URL
    $content = preg_replace_callback("/\{\{\s*asset\(['\"]([^'\"]+)['\"]\)\s*\}\}/", function ($m) {
        return '/' . ltrim($m[1], '/');
    }, $content);

    // 2. Replace {{ url('...') }} with clean URL
    $content = preg_replace_callback("/\{\{\s*url\(['\"]([^'\"]+)['\"]\)\s*\}\}/", function ($m) {
        return $m[1];
    }, $content);

    // 3. Handle @include('partials.navbar') and @include('partials.footer')
    $content = preg_replace_callback("/@include\(['\"]([^'\"]+)['\"]\)/", function ($m) use ($viewsPath) {
        $partialPath = str_replace('.', '/', $m[1]) . '.blade.php';
        $fullPath = $viewsPath . '/' . $partialPath;
        if (file_exists($fullPath)) {
            $partialContent = file_get_contents($fullPath);
            $partialContent = preg_replace_callback("/\{\{\s*asset\(['\"]([^'\"]+)['\"]\)\s*\}\}/", function ($m2) {
                return '/' . ltrim($m2[1], '/');
            }, $partialContent);
            $partialContent = preg_replace_callback("/\{\{\s*url\(['\"]([^'\"]+)['\"]\)\s*\}\}/", function ($m2) {
                return $m2[1];
            }, $partialContent);
            return $partialContent;
        }
        return '';
    }, $content);

    header('Content-Type: text/html; charset=utf-8');
    echo $content;
    exit;
}

// 404 Not Found
http_response_code(404);
?>
<!DOCTYPE html>
<html>
<head>
  <title>404 - Page Not Found | MarketLink</title>
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
  <link rel="stylesheet" href="/assets/css/style.css">
</head>
<body class="bg-light d-flex align-items-center justify-content-center min-vh-100">
  <div class="text-center p-5 bg-white rounded-4 shadow-sm" style="max-width:500px;">
    <h1 class="display-3 font-serif text-forest mb-2">404</h1>
    <h4 class="mb-3">Page Not Found</h4>
    <p class="text-muted mb-4">The route <code><?= htmlspecialchars($uri) ?></code> does not exist in the MarketLink Laravel view mapping.</p>
    <a href="/" class="btn btn-forest rounded-pill px-4">Back to Marketplace</a>
  </div>
</body>
</html>
