<?php
// CodeIgniter Router for PHP Built-in Web Server

$uri = parse_url($_SERVER['REQUEST_URI'], PHP_URL_PATH);

// If the URI doesn't start with /, add it
if (strlen($uri) === 0 || $uri[0] !== '/') {
    $uri = '/' . $uri;
}

// IMPORTANT: Check for static files FIRST before modifying REQUEST_URI
$file = __DIR__ . '/public' . $uri;

// Allow access to static files (images, css, js, etc)
if (is_file($file)) {
    return false; // Let the server serve the file directly
}

// Check if it's a directory listing request
if (is_dir($file) && is_file($file . '/index.html')) {
    return false;
}

// Now set the REQUEST_URI for CodeIgniter routing
$_SERVER['REQUEST_URI'] = $uri;
$_SERVER['SCRIPT_NAME'] = '/index.php';

// Route to CodeIgniter
require __DIR__ . '/public/index.php';
