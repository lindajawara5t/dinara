<?php
// Test Hero Slideshow View Rendering
// File: public/test_hero_slideshow_view.php

// Bootstrap CodeIgniter
require_once __DIR__ . '/../app/Config/Constants.php';
require_once __DIR__ . '/../vendor/autoload.php';

// Load environment
$dotenv = \Dotenv\Dotenv::createImmutable(ROOTPATH);
$dotenv->safeLoad();

// Init CodeIgniter
$app = \Config\Services::codeigniter();
$app->initialize();

// Get model
$slideshowModel = new \App\Models\HeroSlideshowModel();
$slideshows = $slideshowModel->getActiveSlideshows();

?>
<!DOCTYPE html>
<html>
<head>
    <title>Test Hero Slideshow View</title>
    <style>
        body { font-family: Arial; background: #f0f0f0; }
        .debug { background: white; padding: 20px; margin: 20px; border-radius: 8px; }
        .hero-section { position: relative; width: 100%; height: 500px; background: #ddd; margin: 20px; }
        code { background: #f5f5f5; padding: 10px; display: block; overflow-x: auto; margin: 10px 0; }
    </style>
</head>
<body>
    <div class="debug">
        <h2>Test Hero Slideshow View</h2>
        
        <h3>1. Database Check:</h3>
        <p>Total slides: <strong><?= count($slideshows) ?></strong></p>
        <?php if (!empty($slideshows)): ?>
            <ul>
            <?php foreach ($slideshows as $slide): ?>
                <li><?= $slide['title'] ?> - <?= $slide['image_url'] ?></li>
            <?php endforeach; ?>
            </ul>
        <?php else: ?>
            <p style="color: red;">No slides found!</p>
        <?php endif; ?>
        
        <h3>2. View Render Test:</h3>
        <p>Rendering hero_slideshow view...</p>
        <code>
<?php
try {
    $html = view('hero_slideshow');
    echo htmlspecialchars($html);
} catch (\Exception $e) {
    echo "ERROR: " . $e->getMessage();
}
?>
        </code>
    </div>
    
    <h3>3. Console Log Test:</h3>
    <p>Buka F12 Console untuk melihat log dari slideshow script</p>
    
    <?php
    try {
        echo view('hero_slideshow');
    } catch (\Exception $e) {
        echo "ERROR: " . $e->getMessage();
    }
    ?>
</body>
</html>
