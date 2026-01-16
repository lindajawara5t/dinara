<?php

namespace App\Controllers;

use CodeIgniter\Controller;

class Debug extends Controller
{
    public function slideshow()
    {
        $slideshowModel = new \App\Models\HeroSlideshowModel();
        $slideshows = $slideshowModel->getActiveSlideshows();
        
        return $this->response->setJSON([
            'total' => count($slideshows),
            'slides' => $slideshows
        ]);
    }

    public function slideshow_test()
    {
        $slideshowModel = new \App\Models\HeroSlideshowModel();
        $slideshows = $slideshowModel->getActiveSlideshows();
        
        return view('debug_slideshow', ['slideshows' => $slideshows]);
    }

    public function slideshow_hero_test()
    {
        // Render file test_hero_slideshow.php langsung
        return view('test_hero_slideshow');
    }

    public function slideshow_simple()
    {
        // Render file test_slideshow_simple.html langsung
        return view('test_slideshow_simple');
    }

    public function check()
    {
        $slideshowModel = new \App\Models\HeroSlideshowModel();
        $slideshows = $slideshowModel->getActiveSlideshows();
        
        echo "<pre>";
        echo "=== SLIDESHOW DEBUG CHECK ===\n\n";
        
        echo "1. DATABASE:\n";
        echo "   Total active slides: " . count($slideshows) . "\n";
        foreach ($slideshows as $s) {
            echo "   - ID: {$s['id']}, Title: {$s['title']}\n";
            echo "     Image: {$s['image_url']}\n";
        }
        
        echo "\n2. FILES:\n";
        foreach ($slideshows as $s) {
            $fullPath = FCPATH . str_replace('/', DIRECTORY_SEPARATOR, $s['image_url']);
            $exists = file_exists($fullPath) ? "✓" : "✗";
            echo "   $exists {$s['image_url']}\n";
        }
        
        echo "\n3. VIEWS:\n";
        $viewPath = APPPATH . 'Views' . DIRECTORY_SEPARATOR . 'hero_slideshow.php';
        echo "   hero_slideshow.php: " . (file_exists($viewPath) ? "✓" : "✗") . "\n";
        
        echo "\n4. HTML RENDER:\n";
        try {
            $html = view('hero_slideshow');
            $hasContainer = strpos($html, 'slideshow-background-container') !== false;
            echo "   Container in HTML: " . ($hasContainer ? "✓" : "✗") . "\n";
            echo "   HTML length: " . strlen($html) . " bytes\n";
            $slideCount = substr_count($html, 'class="slide-bg');
            echo "   Slides found: $slideCount\n";
            
            if ($hasContainer) {
                echo "\n5. RENDERED HTML:\n";
                echo htmlspecialchars(substr($html, 0, 500)) . "...\n";
            }
        } catch (\Exception $e) {
            echo "   Error: " . $e->getMessage() . "\n";
        }
        
        echo "\n=== END CHECK ===\n";
        echo "</pre>";
    }
}
