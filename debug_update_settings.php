<?php
/**
 * Debug endpoint to test form submission
 */

// Create simple logging
file_put_contents('writable/logs/debug.log', 
    date('Y-m-d H:i:s') . " - REQUEST_METHOD: " . $_SERVER['REQUEST_METHOD'] . "\n" . 
    "POST DATA: " . json_encode($_POST) . "\n" .
    "FILES: " . json_encode(array_keys($_FILES)) . "\n" .
    "---\n",
    FILE_APPEND
);

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Direct database update
    $conn = new mysqli('localhost', 'root', '', 'db_smart_travel');
    
    if (!$conn->connect_error) {
        // Update hero_title if provided
        if (!empty($_POST['hero_title'])) {
            $hero_title = $_POST['hero_title'];
            $conn->query("INSERT INTO site_settings (setting_key, setting_value) VALUES ('hero_title', '$hero_title') 
                         ON DUPLICATE KEY UPDATE setting_value = '$hero_title'");
        }
        
        // Update announcement if provided
        if (!empty($_POST['announcement'])) {
            $announcement = $_POST['announcement'];
            $conn->query("INSERT INTO site_settings (setting_key, setting_value) VALUES ('announcement', '$announcement') 
                         ON DUPLICATE KEY UPDATE setting_value = '$announcement'");
        }
        
        $conn->close();
        
        echo json_encode(['success' => true, 'message' => 'Settings updated']);
    } else {
        echo json_encode(['success' => false, 'error' => 'DB connection failed']);
    }
} else {
    echo json_encode(['success' => false, 'error' => 'Only POST allowed']);
}
?>
