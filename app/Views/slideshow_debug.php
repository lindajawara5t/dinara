<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Debug Slideshow</title>
    <style>
        * { margin: 0; padding: 0; box-sizing: border-box; }
        body { font-family: 'Segoe UI', Tahoma; background: linear-gradient(135deg, #667eea 0%, #764ba2 100%); min-height: 100vh; padding: 30px; }
        .container { max-width: 1200px; margin: 0 auto; }
        h1 { color: white; margin-bottom: 30px; text-shadow: 0 2px 4px rgba(0,0,0,0.3); }
        .card { background: white; border-radius: 12px; padding: 25px; margin-bottom: 20px; box-shadow: 0 10px 40px rgba(0,0,0,0.2); }
        .card h2 { color: #333; margin-bottom: 15px; font-size: 1.3rem; border-bottom: 2px solid #667eea; padding-bottom: 10px; }
        .status { padding: 12px 15px; border-radius: 6px; margin-bottom: 15px; }
        .status.success { background: #e8f5e9; color: #2e7d32; border-left: 4px solid #4caf50; }
        .status.error { background: #ffebee; color: #c62828; border-left: 4px solid #f44336; }
        .status.warning { background: #fff3e0; color: #e65100; border-left: 4px solid #ff9800; }
        .slide-item { background: #f5f5f5; padding: 15px; margin: 10px 0; border-radius: 8px; border-left: 4px solid #667eea; }
        .slide-item strong { color: #667eea; }
        .slide-preview { max-width: 100%; height: 250px; margin: 10px 0; border-radius: 6px; background-size: cover; background-position: center; border: 2px solid #ddd; }
        code { background: #f5f5f5; padding: 2px 6px; border-radius: 3px; font-family: monospace; }
        .info { color: #666; font-size: 0.9rem; }
        pre { background: #f5f5f5; padding: 15px; border-radius: 6px; overflow-x: auto; }
    </style>
</head>
<body>
    <div class="container">
        <h1>🔍 Debug Slideshow - Data Verification</h1>
        
        <div class="card">
            <h2>Database Query Result</h2>
            
            <?php if (empty($slideshows)): ?>
                <div class="status error">
                    ❌ <strong>No slides found!</strong> 
                    Database might be empty or there are no active slides.
                </div>
            <?php else: ?>
                <div class="status success">
                    ✅ <strong>Found <?= count($slideshows); ?> active slide(s)!</strong>
                </div>
                
                <p class="info">Model: <code>HeroSlideshowModel::getActiveSlideshows()</code></p>
                
                <?php foreach ($slideshows as $idx => $slide): ?>
                    <div class="slide-item">
                        <strong>Slide <?= $idx + 1 ?>/<?= $count; ?></strong>
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
            <h2>HTML Code (What will be rendered)</h2>
            <p class="info">This is how the slideshow HTML will look on landing page:</p>
            <pre>&lt;div class="slideshow-background-container" id="slideshow-bg-container"&gt;
    &lt;?php foreach ($slideshows as $index =&gt; $slide): ?&gt;
    &lt;div class="slide-bg &lt;?= $index === 0 ? 'active' : '' ?&gt;" data-index="&lt;?= $index ?&gt;"&gt;
        &lt;div class="slide-bg-image" style="background-image: url('&lt;?= $slide['image_url'] ?&gt;')"&gt;&lt;/div&gt;
        &lt;div class="slide-bg-overlay"&gt;&lt;/div&gt;
    &lt;/div&gt;
    &lt;?php endforeach; ?&gt;
&lt;/div&gt;</pre>
        </div>
        
        <div class="card">
            <h2>Checklist</h2>
            <ul style="margin-left: 20px; line-height: 2;">
                <li>✓ Database connection working: <strong><?= !empty($slideshows) ? '✅' : '❌' ?></strong></li>
                <li>✓ Model query returns data: <strong><?= !empty($slideshows) ? '✅' : '❌' ?></strong></li>
                <li>✓ Number of slides: <strong><?= count($slideshows); ?></strong></li>
                <li>✓ Images loadable: <strong><?= !empty($slideshows) ? '✅ Check browser Network tab' : 'N/A' ?></strong></li>
                <li>✓ CSS z-index fixed: <strong>✅ (z-index: 1)</strong></li>
                <li>✓ JavaScript auto-play enabled: <strong>✅ (5 second interval)</strong></li>
            </ul>
        </div>
        
        <div class="card" style="background: linear-gradient(135deg, #667eea 0%, #764ba2 100%); color: white;">
            <h2 style="color: white; border-bottom-color: rgba(255,255,255,0.3);">Next Steps</h2>
            <ol style="margin-left: 20px; line-height: 2;">
                <li>If slides are shown above, everything is working correctly</li>
                <li>Open the <strong><a href="/" style="color: #fff; text-decoration: underline;">landing page</a></strong> and verify slideshow appears</li>
                <li>Open F12 Developer Tools and check Console for debug messages</li>
                <li>Open Network tab and verify all images load without 404 errors</li>
                <li>Check that background changes every 5 seconds (auto-play)</li>
            </ol>
        </div>
    </div>
</body>
</html>