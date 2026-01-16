<?php
echo "<pre>";
echo "=== SLIDESHOW DEBUG ===\n\n";

// 1. Check database
$db = \Config\Database::connect();
$slides = $db->table('hero_slideshow')->where('is_active', 1)->orderBy('sort_order')->get()->getResultArray();

echo "1. DATABASE CHECK:\n";
echo "   Total active slides: " . count($slides) . "\n";
foreach ($slides as $s) {
    echo "   - ID: {$s['id']}, Title: {$s['title']}, Image: {$s['image_url']}\n";
}

// 2. Check file exists
echo "\n2. FILE CHECK:\n";
foreach ($slides as $s) {
    $path = FCPATH . $s['image_url'];
    $exists = file_exists($path) ? "✓" : "✗";
    echo "   $exists {$s['image_url']}\n";
    echo "      Full path: $path\n";
}

// 3. Check view file
echo "\n3. VIEW FILE CHECK:\n";
$viewPath = APPPATH . 'Views/hero_slideshow.php';
echo "   hero_slideshow.php exists: " . (file_exists($viewPath) ? "✓" : "✗") . "\n";
echo "   Path: $viewPath\n";

// 4. Check model
echo "\n4. MODEL CHECK:\n";
$modelPath = APPPATH . 'Models/HeroSlideshowModel.php';
echo "   HeroSlideshowModel.php exists: " . (file_exists($modelPath) ? "✓" : "✗") . "\n";
try {
    $model = new \App\Models\HeroSlideshowModel();
    echo "   Model loaded: ✓\n";
    $active = $model->getActiveSlideshows();
    echo "   getActiveSlideshows() returned: " . count($active) . " slides\n";
} catch (Exception $e) {
    echo "   Model error: " . $e->getMessage() . "\n";
}

// 5. Test rendering
echo "\n5. RENDERING TEST:\n";
echo "   Attempting to render view...\n";
try {
    $html = view('hero_slideshow');
    if (strpos($html, 'slideshow-background-container') !== false) {
        echo "   ✓ Container found in rendered HTML\n";
        echo "   HTML length: " . strlen($html) . " bytes\n";
        // Count slides in HTML
        $slideCount = substr_count($html, 'class="slide-bg');
        echo "   Slides in HTML: $slideCount\n";
    } else {
        echo "   ✗ Container NOT found in HTML\n";
    }
} catch (Exception $e) {
    echo "   Error rendering view: " . $e->getMessage() . "\n";
}

echo "\n=== END DEBUG ===\n";
echo "</pre>";
