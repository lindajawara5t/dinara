<?php
// Debug Settings Estimasi - Akses: http://localhost:8080/dinara/public/debug_estimasi.php

require_once __DIR__ . '/../app/Config/Paths.php';
$paths = new Config\Paths();
require_once SYSTEMPATH . 'bootstrap.php';

$db = \Config\Database::connect();

echo "<h2>Debug: Settings Estimasi Data</h2>";

// Get data
$estimasiList = $db->table('site_content')
    ->where('page_name', 'estimasi')
    ->orderBy('id', 'ASC')
    ->get()
    ->getResultArray();

echo "<h3>Raw Data from DB (" . count($estimasiList) . " rows):</h3>";
echo "<pre>";
print_r($estimasiList);
echo "</pre>";

// Group by section
$serviceInfo = [];
foreach ($estimasiList as $item) {
    if (!isset($serviceInfo[$item['section_name']])) {
        $serviceInfo[$item['section_name']] = ['id' => $item['id'], 'key_name' => $item['section_name']];
    }
    $serviceInfo[$item['section_name']][$item['content_key']] = $item['content_value'];
}

echo "<h3>Grouped Data (" . count($serviceInfo) . " sections):</h3>";
echo "<pre>";
print_r($serviceInfo);
echo "</pre>";

echo "<h3>Array Values (untuk view):</h3>";
$viewData = array_values($serviceInfo);
echo "<pre>";
print_r($viewData);
echo "</pre>";

// Check floating_box
echo "<h3>Floating Box Data:</h3>";
if (isset($serviceInfo['floating_box'])) {
    echo "<p style='color:green;'>✓ floating_box FOUND!</p>";
    echo "<pre>";
    print_r($serviceInfo['floating_box']);
    echo "</pre>";
} else {
    echo "<p style='color:red;'>✗ floating_box NOT FOUND!</p>";
}
