<?php
// Load CodeIgniter
require_once 'app/Config/Database.php';

// Test HeroSlideshowModel
$model = new \App\Models\HeroSlideshowModel();
$slides = $model->getActiveSlideshows();

?>
<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <title>Debug - HeroSlideshowModel</title>
    <style>
        * { margin: 0; padding: 0; box-sizing: border-box; }
        body { font-family: 'Segoe UI', Tahoma; background: linear-gradient(135deg, #667eea 0%, #764ba2 100%); min-height: 100vh; padding: 30px; }
        .container { max-width: 1000px; margin: 0 auto; }
        h1 { color: white; margin-bottom: 30px; text-shadow: 0 2px 4px rgba(0,0,0,0.3); }
        .card { background: white; border-radius: 12px; padding: 25px; margin-bottom: 20px; box-shadow: 0 10px 40px rgba(0,0,0,0.2); }
        .card h2 { color: #333; margin-bottom: 15px; font-size: 1.3rem; border-bottom: 2px solid #667eea; padding-bottom: 10px; }
        .status { padding: 12px 15px; border-radius: 6px; margin-bottom: 15px; }
        .status.success { background: #e8f5e9; color: #2e7d32; border-left: 4px solid #4caf50; }
        .status.error { background: #ffebee; color: #c62828; border-left: 4px solid #f44336; }
        .slide-item { background: #f5f5f5; padding: 15px; margin: 10px 0; border-radius: 8px; border-left: 4px solid #667eea; }
        .slide-item strong { color: #667eea; }
        .slide-preview { max-width: 100%; height: 200px; margin: 10px 0; border-radius: 6px; background-size: cover; background-position: center; border: 2px solid #ddd; }
        code { background: #f5f5f5; padding: 2px 6px; border-radius: 3px; font-family: monospace; }
        .info { color: #666; font-size: 0.9rem; }
    </style>
</head>
<body>
    <div class="container">
        <h1>🔍 Debug - HeroSlideshowModel & Database</h1>
        
        <div class="card">
            <h2>Database Query Result</h2>
            
            <?php if (empty($slides)): ?>
                <div class="status error">
                    ❌ <strong>No slides found!</strong> 
                    Database might be empty or there are no active slides.
                </div>
                <p class="info">Checked with: <code>$model->getActiveSlideshows()</code></p>
            <?php else: ?>
                <div class="status success">
                    ✅ <strong>Found <?= count($slides); ?> active slide(s)!</strong>
                    Slideshow should be working.
                </div>
                
                <?php foreach ($slides as $idx => $slide): ?>
                    <div class="slide-item">
                        <strong>Slide <?= $idx + 1 ?>/<?= count($slides); ?></strong>
                        <div style="margin-top: 8px;">
                            <div><strong>ID:</strong> <?= $slide['id'] ?></div>
                            <div><strong>Title:</strong> <?= $slide['title'] ?></div>
                            <div><strong>Image URL:</strong> <code><?= $slide['image_url'] ?></code></div>
                            <div><strong>Sort Order:</strong> <?= $slide['sort_order'] ?></div>
                            <div><strong>Is Active:</strong> <?= $slide['is_active'] ? '✅ Yes' : '❌ No' ?></div>
                            
                            <div class="slide-preview" style="background-image: url('<?= $slide['image_url'] ?>');" title="<?= $slide['title'] ?>"></div>
                        </div>
                    </div>
                <?php endforeach; ?>
            <?php endif; ?>
        </div>
        
        <div class="card">
            <h2>Raw Data Output</h2>
            <pre style="background: #f5f5f5; padding: 15px; border-radius: 6px; overflow-x: auto;"><?php 
                echo htmlspecialchars(json_encode($slides, JSON_PRETTY_PRINT | JSON_UNESCAPED_SLASHES));
            ?></pre>
        </div>
        
        <div class="card" style="background: linear-gradient(135deg, #667eea 0%, #764ba2 100%); color: white;">
            <h2 style="color: white; border-bottom-color: rgba(255,255,255,0.3);">Next Steps</h2>
            <ul style="margin-left: 20px;">
                <li>If slides are shown above, the database and model are working correctly</li>
                <li>Check the landing page console (F12) for any JavaScript errors</li>
                <li>Verify CSS z-index and positioning in browser DevTools</li>
                <li>Make sure background images load without 404 errors</li>
            </ul>
        </div>
    </div>
</body>
</html>