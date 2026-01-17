<?php
// Test database connection dan slideshow data
require_once 'app/Config/Database.php';

// Create database connection
$db = \Config\Database::connect();

// Query slideshow data
$query = $db->query("
    SELECT id, image_url, title, is_active, sort_order 
    FROM hero_slideshow 
    WHERE is_active = 1 
    ORDER BY sort_order ASC
");

$results = $query->getResult('array');

?>
<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <title>Test Database - Hero Slideshow</title>
    <style>
        body { font-family: Arial; margin: 20px; background: #f5f5f5; }
        .container { max-width: 1200px; margin: 0 auto; }
        h1 { color: #333; }
        .card { background: white; padding: 20px; margin: 15px 0; border-radius: 8px; box-shadow: 0 2px 8px rgba(0,0,0,0.1); }
        .slide-preview { margin: 20px 0; }
        .slide-preview img { max-width: 100%; height: auto; border-radius: 8px; max-height: 300px; }
        .slide-info { background: #f9f9f9; padding: 10px; margin: 10px 0; border-left: 4px solid #0d6efd; }
        .error { color: #d32f2f; background: #ffebee; padding: 10px; border-radius: 4px; }
        .success { color: #388e3c; background: #e8f5e9; padding: 10px; border-radius: 4px; }
    </style>
</head>
<body>
    <div class="container">
        <h1>🔍 Test Database - Hero Slideshow Data</h1>
        
        <?php if (empty($results)): ?>
            <div class="card">
                <div class="error">❌ Tidak ada data slideshow! Database kosong atau tidak ada slide yang aktif.</div>
            </div>
        <?php else: ?>
            <div class="card">
                <div class="success">✅ Ditemukan <?= count($results); ?> slide aktif</div>
                
                <?php foreach ($results as $idx => $slide): ?>
                    <div class="slide-preview">
                        <h3>Slide <?= $idx + 1 ?> - <?= $slide['title'] ?></h3>
                        <div class="slide-info">
                            <strong>ID:</strong> <?= $slide['id'] ?><br>
                            <strong>Image URL:</strong> <?= $slide['image_url'] ?><br>
                            <strong>Full URL:</strong> <code><?= base_url($slide['image_url']) ?></code><br>
                            <strong>Sort Order:</strong> <?= $slide['sort_order'] ?><br>
                            <strong>Active:</strong> <?= $slide['is_active'] ? '✅ Yes' : '❌ No' ?>
                        </div>
                        
                        <!-- Test if image can load -->
                        <img src="<?= $slide['image_url'] ?>" alt="<?= $slide['title'] ?>" onerror="this.style.border='3px solid red'; this.title='Image failed to load';">
                    </div>
                    <hr>
                <?php endforeach; ?>
            </div>
        <?php endif; ?>
        
        <div class="card">
            <h2>📋 Raw Database Query Result:</h2>
            <pre><?php var_dump($results); ?></pre>
        </div>
    </div>
</body>
</html>