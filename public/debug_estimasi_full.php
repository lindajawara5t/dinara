<?php
// Debug Settings Estimasi Controller
require_once __DIR__ . '/../app/Config/Paths.php';

$pathsConfig = new Config\Paths();
require_once SYSTEMPATH . 'Boot.php';
require_once APPPATH . 'Config/Database.php';

$dbConfig = new Config\Database();
$db = \Config\Database::connect();

echo "<h1>🔍 Debug Settings Estimasi - Full Analysis</h1>";
echo "<hr>";

// 1. CEK RAW DATA dari database
echo "<h2>1️⃣ RAW DATA dari Database</h2>";
$estimasiList = $db->table('site_content')
    ->where('page_name', 'estimasi')
    ->orderBy('id', 'ASC')
    ->get()
    ->getResultArray();

echo "<p><strong>Total Rows:</strong> " . count($estimasiList) . "</p>";
echo "<table border='1' cellpadding='5' style='border-collapse:collapse;'>";
echo "<tr><th>ID</th><th>Section Name</th><th>Content Key</th><th>Content Value</th></tr>";
foreach($estimasiList as $item) {
    echo "<tr>";
    echo "<td>{$item['id']}</td>";
    echo "<td><strong>{$item['section_name']}</strong></td>";
    echo "<td>{$item['content_key']}</td>";
    echo "<td>" . substr($item['content_value'], 0, 50) . "...</td>";
    echo "</tr>";
}
echo "</table>";

echo "<hr>";

// 2. CEK GROUPING LOGIC (sama persis dengan controller)
echo "<h2>2️⃣ GROUPING LOGIC (seperti di controller)</h2>";
$serviceInfo = [];
foreach ($estimasiList as $item) {
    if (!isset($serviceInfo[$item['section_name']])) {
        $serviceInfo[$item['section_name']] = ['id' => $item['id'], 'key_name' => $item['section_name']];
    }
    $serviceInfo[$item['section_name']][$item['content_key']] = $item['content_value'];
}

echo "<p><strong>Total Sections after grouping:</strong> " . count($serviceInfo) . "</p>";
echo "<pre>";
print_r($serviceInfo);
echo "</pre>";

echo "<hr>";

// 3. CEK ARRAY VALUES (yang dikirim ke view)
echo "<h2>3️⃣ ARRAY VALUES (dikirim ke view)</h2>";
$finalData = array_values($serviceInfo);
echo "<p><strong>Total items in array_values:</strong> " . count($finalData) . "</p>";
echo "<pre>";
print_r($finalData);
echo "</pre>";

echo "<hr>";

// 4. CEK SECTION NAMES
echo "<h2>4️⃣ LIST SECTION NAMES</h2>";
echo "<ol>";
foreach($finalData as $item) {
    $icon = '📄';
    if($item['key_name'] === 'floating_box') $icon = '🪟';
    elseif($item['key_name'] === 'transport_land') $icon = '🚐';
    elseif($item['key_name'] === 'transport_sea') $icon = '🚢';
    
    echo "<li>{$icon} <strong>{$item['key_name']}</strong> - {$item['title']}</li>";
}
echo "</ol>";

echo "<hr>";

// 5. SIMULASI VIEW RENDERING
echo "<h2>5️⃣ SIMULASI VIEW RENDERING</h2>";
if(empty($finalData)) {
    echo "<p style='color:red;'>❌ <strong>\$serviceInfo is EMPTY!</strong></p>";
} else {
    echo "<p style='color:green;'>✅ \$serviceInfo has " . count($finalData) . " items</p>";
    echo "<div style='display:flex;gap:10px;flex-wrap:wrap;'>";
    foreach($finalData as $info) {
        echo "<div style='border:1px solid #ccc;padding:10px;width:200px;'>";
        echo "<h4>{$info['title']}</h4>";
        echo "<p><small>Key: {$info['key_name']}</small></p>";
        echo "</div>";
    }
    echo "</div>";
}

echo "<hr>";
echo "<p><a href='http://localhost:8080/dinara/public/index.php/settings/estimasi-info' target='_blank'>🔗 Buka Halaman Asli</a></p>";
?>
