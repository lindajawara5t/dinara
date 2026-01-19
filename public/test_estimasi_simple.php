<?php
// Simple test - no session, no framework
$mysqli = new mysqli('localhost', 'root', '', 'dinara');

if ($mysqli->connect_error) {
    die('Connection failed: ' . $mysqli->connect_error);
}

echo "<h1>Test Estimasi Data</h1>";

$result = $mysqli->query("SELECT * FROM site_content WHERE page_name='estimasi' ORDER BY id");

if (!$result) {
    die('Query failed: ' . $mysqli->error);
}

echo "<p><strong>Total rows:</strong> " . $result->num_rows . "</p>";

// Group by section
$serviceInfo = [];
while ($row = $result->fetch_assoc()) {
    $section = $row['section_name'];
    if (!isset($serviceInfo[$section])) {
        $serviceInfo[$section] = ['id' => $row['id'], 'key_name' => $section];
    }
    $serviceInfo[$section][$row['content_key']] = $row['content_value'];
}

echo "<p><strong>Total sections after grouping:</strong> " . count($serviceInfo) . "</p>";

echo "<h2>Sections:</h2><ol>";
foreach (array_values($serviceInfo) as $info) {
    echo "<li><strong>{$info['key_name']}</strong> - {$info['title']}</li>";
}
echo "</ol>";

echo "<h2>Full Data:</h2>";
echo "<pre>";
print_r(array_values($serviceInfo));
echo "</pre>";

$mysqli->close();
?>
