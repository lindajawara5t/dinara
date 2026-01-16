<?php
/**
 * TEST SCRIPT - Submit Update Settings Form
 */

$ch = curl_init();
curl_setopt($ch, CURLOPT_URL, 'http://localhost/dinara/admin/update_settings');
curl_setopt($ch, CURLOPT_POST, 1);
curl_setopt($ch, CURLOPT_POSTFIELDS, http_build_query([
    'hero_title' => 'TEST JUDUL DARI CURL - ' . date('H:i:s'),
    'announcement' => 'TEST ANNOUNCEMENT DARI CURL'
]));
curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
curl_setopt($ch, CURLOPT_FOLLOWLOCATION, true);

$response = curl_exec($ch);
$http_code = curl_getinfo($ch, CURLINFO_HTTP_CODE);
curl_close($ch);

echo "HTTP Code: " . $http_code . "<br>";
echo "Response Length: " . strlen($response) . " bytes<br>";
echo "<hr>";

// Verify if data was saved
$conn = new mysqli('localhost', 'root', '', 'db_smart_travel');
$result = $conn->query("SELECT * FROM site_settings WHERE setting_key = 'hero_title' LIMIT 1");
$row = $result->fetch_assoc();
echo "Database Result:<br>";
echo "<pre>";
print_r($row);
echo "</pre>";

?>
