<?php
/**
 * DIRECT DATABASE UPDATE TEST
 * Simulating what update_settings should do
 */

$conn = new mysqli('localhost', 'root', '', 'db_smart_travel');

if ($conn->connect_error) {
    die('Connection error: ' . $conn->connect_error);
}

// Test data
$updates = [
    'hero_title' => 'UPDATED VIA SCRIPT - ' . date('Y-m-d H:i:s'),
    'announcement' => 'ANNOUNCEMENT UPDATED'
];

echo "Updating database directly...<br>";

foreach ($updates as $key => $value) {
    $sql = "INSERT INTO site_settings (setting_key, setting_value) VALUES (?, ?) 
            ON DUPLICATE KEY UPDATE setting_value = ?, updated_at = CURRENT_TIMESTAMP";
    
    $stmt = $conn->prepare($sql);
    
    if (!$stmt) {
        echo "Prepare failed: " . $conn->error . "<br>";
        continue;
    }
    
    $stmt->bind_param('sss', $key, $value, $value);
    
    if ($stmt->execute()) {
        echo "✓ Updated '$key' successfully<br>";
    } else {
        echo "✗ Error updating '$key': " . $stmt->error . "<br>";
    }
    
    $stmt->close();
}

// Verify
echo "<h3>Current Database Values:</h3>";
$result = $conn->query("SELECT * FROM site_settings WHERE setting_key IN ('hero_title', 'announcement')");

echo "<table border='1' style='border-collapse: collapse'>";
echo "<tr style='background: #f0f0f0'><th>Key</th><th>Value</th><th>Updated</th></tr>";

while ($row = $result->fetch_assoc()) {
    echo "<tr>";
    echo "<td>" . htmlspecialchars($row['setting_key']) . "</td>";
    echo "<td>" . htmlspecialchars(substr($row['setting_value'], 0, 100)) . "</td>";
    echo "<td>" . $row['updated_at'] . "</td>";
    echo "</tr>";
}

echo "</table>";

$conn->close();

echo "<br><br><strong>✓ Direct database update works. Now we need to test why form submission doesn't trigger the controller.</strong>";
?>
