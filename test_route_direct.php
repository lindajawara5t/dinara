<?php
/**
 * TEST - Check if update_settings route responds
 */

echo "Testing update_settings route...<br>";

// Test 1: Check route exists
echo "<h3>Test 1: Simple POST Request</h3>";
$ch = curl_init('http://localhost/dinara/admin/update_settings');
curl_setopt($ch, CURLOPT_POST, 1);
curl_setopt($ch, CURLOPT_POSTFIELDS, 'hero_title=TESTVALUE123&announcement=TEST');
curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
curl_setopt($ch, CURLOPT_HEADER, true);

$response = curl_exec($ch);
$info = curl_getinfo($ch);
curl_close($ch);

echo "Status Code: " . $info['http_code'] . "<br>";
echo "Response starts with: " . substr($response, 0, 200) . "<br>";

// Test 2: Check database directly
echo "<h3>Test 2: Check Database</h3>";
$conn = new mysqli('localhost', 'root', '', 'db_smart_travel');

if ($conn->connect_error) {
    die('Connection error: ' . $conn->connect_error);
}

$result = $conn->query("SELECT * FROM site_settings ORDER BY updated_at DESC LIMIT 5");
echo "<table border='1'><tr><th>ID</th><th>Key</th><th>Value (first 50 chars)</th><th>Updated</th></tr>";

while ($row = $result->fetch_assoc()) {
    echo "<tr>";
    echo "<td>" . $row['id'] . "</td>";
    echo "<td>" . $row['setting_key'] . "</td>";
    echo "<td>" . substr($row['setting_value'], 0, 50) . "</td>";
    echo "<td>" . $row['updated_at'] . "</td>";
    echo "</tr>";
}

echo "</table>";

$conn->close();
?>
