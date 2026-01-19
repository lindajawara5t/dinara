<?php
// Test direct access ke Settings controller
// Akses via: http://localhost:8080/test_estimasi_settings.php

// Load CodeIgniter
require_once __DIR__ . '/app/Config/Paths.php';
$paths = new Config\Paths();
require_once SYSTEMPATH . 'bootstrap.php';

// Get database connection
$db = \Config\Database::connect();

// Test query
echo "<h2>Test Database - site_content table</h2>";

$query = $db->query("SELECT * FROM site_content WHERE page_name='estimasi' ORDER BY section_name, content_key");
$results = $query->getResultArray();

echo "<pre>";
print_r($results);
echo "</pre>";

echo "<hr>";
echo "<h3>Data count: " . count($results) . "</h3>";

// Test jika data kosong
if (empty($results)) {
    echo "<p style='color:red;'>❌ Data kosong! Perlu insert default data.</p>";
} else {
    echo "<p style='color:green;'>✅ Data tersedia!</p>";
    
    // Group by section
    $grouped = [];
    foreach ($results as $row) {
        $section = $row['section_name'];
        if (!isset($grouped[$section])) {
            $grouped[$section] = [];
        }
        $grouped[$section][$row['content_key']] = $row['content_value'];
    }
    
    echo "<h3>Grouped Data:</h3>";
    echo "<pre>";
    print_r($grouped);
    echo "</pre>";
}
