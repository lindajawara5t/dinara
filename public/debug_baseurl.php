<?php
// Get current URL
$protocol = isset($_SERVER['HTTPS']) && $_SERVER['HTTPS'] === 'on' ? 'https' : 'http';
$host = $_SERVER['HTTP_HOST'] ?? $_SERVER['SERVER_NAME'];
$scriptPath = dirname($_SERVER['SCRIPT_NAME']);

echo "Current URL: " . $protocol . "://" . $host . $_SERVER['REQUEST_URI'] . "\n";
echo "Script path: " . $scriptPath . "\n";

// Try to read .env
$envFile = __DIR__ . '/.env';
if (file_exists($envFile)) {
    echo ".env exists\n";
    $lines = file($envFile);
    foreach ($lines as $line) {
        if (strpos($line, 'baseURL') !== false) {
            echo "From .env: " . trim($line) . "\n";
        }
    }
}
?>
