<?php
require_once 'vendor/autoload.php';
require_once 'app/Config/Database.php';
require_once 'app/Models/HeroSlideshowModel.php';

// Initialize database and model
$db = \Config\Database::connect();
$model = new \App\Models\HeroSlideshowModel();

$slideshows = $model->getActiveSlideshows();

?>
<!DOCTYPE html>
<html>
<head>
    <title>Model Test</title>
    <style>
        * { margin: 0; padding: 0; }
        body { font-family: Arial; background: #f5f5f5; padding: 20px; }
        .container { max-width: 800px; margin: 0 auto; }
        .card { background: white; padding: 20px; margin: 15px 0; border-radius: 8px; }
        .success { color: #2e7d32; }
        .error { color: #c62828; }
        pre { background: #f0f0f0; padding: 10px; overflow-x: auto; }
    </style>
</head>
<body>
    <div class="container">
        <h1>🔍 Model Test - HeroSlideshowModel</h1>
        
        <div class="card">
            <h2>Test Result:</h2>
            <p class="<?= empty($slideshows) ? 'error' : 'success' ?>">
                <?= empty($slideshows) ? '❌ No slides found' : '✅ Found ' . count($slideshows) . ' slides' ?>
            </p>
        </div>
        
        <div class="card">
            <h2>Data:</h2>
            <pre><?= json_encode($slideshows, JSON_PRETTY_PRINT | JSON_UNESCAPED_SLASHES); ?></pre>
        </div>
    </div>
</body>
</html>