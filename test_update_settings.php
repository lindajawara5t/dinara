<?php
/**
 * TEST SCRIPT - Check Database Connection
 */

$host = 'localhost';
$user = 'root';
$pass = '';
$db = 'db_smart_travel';

try {
    $conn = new mysqli($host, $user, $pass, $db);
    
    if ($conn->connect_error) {
        die('Connection failed: ' . $conn->connect_error);
    }
    
    // Test query - update site_settings
    $test_key = 'hero_title';
    $test_value = 'TEST TITLE - ' . date('Y-m-d H:i:s');
    
    $sql = "INSERT INTO site_settings (setting_key, setting_value) VALUES (?, ?) 
            ON DUPLICATE KEY UPDATE setting_value = ?";
    
    $stmt = $conn->prepare($sql);
    $stmt->bind_param('sss', $test_key, $test_value, $test_value);
    
    if ($stmt->execute()) {
        echo "SUCCESS: Database updated!<br>";
        echo "Key: " . htmlspecialchars($test_key) . "<br>";
        echo "Value: " . htmlspecialchars($test_value) . "<br>";
    } else {
        echo "ERROR: " . $stmt->error . "<br>";
    }
    
    // Verify data was saved
    $result = $conn->query("SELECT * FROM site_settings WHERE setting_key = 'hero_title'");
    $row = $result->fetch_assoc();
    echo "<pre>";
    print_r($row);
    echo "</pre>";
    
    $conn->close();
    
} catch (Exception $e) {
    echo "Exception: " . $e->getMessage();
}
?>
