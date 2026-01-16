<?php
require_once __DIR__ . '/app/Config/Constants.php';
require_once __DIR__ . '/vendor/autoload.php';

$config = new Config\App();
echo "BaseURL from config: " . $config->baseURL . "\n";

// Also test the helper function
echo "base_url() from helper: " . base_url() . "\n";
echo "base_url('uploads/test.png'): " . base_url('uploads/test.png') . "\n";
?>
