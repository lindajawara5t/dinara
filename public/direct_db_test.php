<?php
// Direct database test
$host = 'localhost';
$user = 'root';
$pass = '';
$db = 'db_smart_travel';

try {
    $conn = new mysqli($host, $user, $pass, $db);
    
    if ($conn->connect_error) {
        die("Connection failed: " . $conn->connect_error);
    }
    
    // Query slideshow data
    $sql = "SELECT id, title, image_url, is_active, sort_order FROM hero_slideshow WHERE is_active = 1 ORDER BY sort_order ASC";
    $result = $conn->query($sql);
    
    if (!$result) {
        die("Query error: " . $conn->error);
    }
    
    $slides = [];
    while ($row = $result->fetch_assoc()) {
        $slides[] = $row;
    }
    
    $conn->close();
    
?>
<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <title>Database Test - Hero Slideshow</title>
    <style>
        * { margin: 0; padding: 0; box-sizing: border-box; }
        body { font-family: 'Segoe UI'; background: linear-gradient(135deg, #667eea 0%, #764ba2 100%); min-height: 100vh; padding: 30px; }
        .container { max-width: 1200px; margin: 0 auto; }
        h1 { color: white; margin-bottom: 30px; }
        .card { background: white; border-radius: 12px; padding: 25px; margin-bottom: 20px; box-shadow: 0 10px 40px rgba(0,0,0,0.2); }
        .status { padding: 15px; border-radius: 6px; margin-bottom: 15px; }
        .status.success { background: #e8f5e9; color: #2e7d32; border-left: 4px solid #4caf50; }
        .status.error { background: #ffebee; color: #c62828; border-left: 4px solid #f44336; }
        .slide-item { background: #f5f5f5; padding: 15px; margin: 10px 0; border-radius: 8px; border-left: 4px solid #667eea; }
        .slide-preview { height: 200px; margin: 10px 0; border-radius: 6px; background-size: cover; background-position: center; border: 2px solid #ddd; }
        code { background: #f5f5f5; padding: 2px 6px; border-radius: 3px; }
    </style>
</head>
<body>
    <div class="container">
        <h1>🔍 Direct Database Test - Hero Slideshow</h1>
        
        <div class="card">
            <h2>Query Result</h2>
            
            <?php if (empty($slides)): ?>
                <div class="status error">
                    ❌ <strong>No slides found in database!</strong>
                </div>
                <p>Query: <code>SELECT * FROM hero_slideshow WHERE is_active = 1</code></p>
            <?php else: ?>
                <div class="status success">
                    ✅ <strong>Found <?= count($slides); ?> active slide(s)!</strong>
                </div>
                
                <?php foreach ($slides as $idx => $slide): ?>
                    <div class="slide-item">
                        <strong>Slide <?= $idx + 1 ?> (ID: <?= $slide['id'] ?>)</strong>
                        <div style="margin-top: 10px;">
                            <div><strong>Title:</strong> <?= $slide['title'] ?></div>
                            <div><strong>Image URL:</strong> <code><?= $slide['image_url'] ?></code></div>
                            <div><strong>Sort Order:</strong> <?= $slide['sort_order'] ?></div>
                            <div><strong>Active:</strong> <?= $slide['is_active'] ?></div>
                            
                            <div class="slide-preview" style="background-image: url('<?= $slide['image_url'] ?>');" title="<?= $slide['title'] ?>"></div>
                        </div>
                    </div>
                <?php endforeach; ?>
            <?php endif; ?>
        </div>
        
        <div class="card">
            <h2>Raw JSON Output</h2>
            <pre><?= json_encode($slides, JSON_PRETTY_PRINT | JSON_UNESCAPED_SLASHES); ?></pre>
        </div>
    </div>
</body>
</html>
<?php
} catch (Exception $e) {
    die("Error: " . $e->getMessage());
}
?>