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

    public function hero_slideshow_debug()
    {
        // Debug hero slideshow
        $slideshowModel = new \App\Models\HeroSlideshowModel();
        
        echo "<pre style='background: #f0f0f0; padding: 20px; border-radius: 8px; overflow-x: auto;'>";
        echo "<h2>🎬 Hero Slideshow Debug</h2>\n\n";
        
        // 1. Cek data dari database
        echo "1️⃣  DATABASE RECORDS:\n";
        echo "================================\n";
        $allSlides = $slideshowModel->getAllSlideshows();
        echo "Total slides: " . count($allSlides) . "\n\n";
        
        if (!empty($allSlides)) {
            foreach ($allSlides as $slide) {
                echo "ID: {$slide['id']}\n";
                echo "  Title: {$slide['title']}\n";
                echo "  Image: {$slide['image_url']}\n";
                echo "  Active: " . ($slide['is_active'] ? '✅' : '❌') . "\n";
                echo "  Order: {$slide['sort_order']}\n";
                echo "---\n";
            }
        } else {
            echo "❌ NO SLIDES FOUND IN DATABASE!\n";
        }
        
        // 2. Cek data aktif
        echo "\n2️⃣  ACTIVE SLIDES:\n";
        echo "================================\n";
        $activeSlides = $slideshowModel->getActiveSlideshows();
        echo "Total active: " . count($activeSlides) . "\n";
        
        if (empty($activeSlides)) {
            echo "⚠️  NO ACTIVE SLIDES!\n";
        } else {
            foreach ($activeSlides as $slide) {
                echo "✅ {$slide['title']} - {$slide['image_url']}\n";
            }
        }
        
        // 3. Cek file gambar
        echo "\n3️⃣  IMAGE FILES:\n";
        echo "================================\n";
        foreach ($activeSlides as $slide) {
            $fullPath = FCPATH . ltrim(str_replace('/', DIRECTORY_SEPARATOR, $slide['image_url']), DIRECTORY_SEPARATOR);
            $exists = file_exists($fullPath);
            echo ($exists ? '✅' : '❌') . " {$slide['image_url']}\n";
            if (!$exists) {
                echo "   Full path: $fullPath\n";
            }
        }
        
        // 4. Test render view
        echo "\n4️⃣  VIEW RENDER TEST:\n";
        echo "================================\n";
        try {
            $html = view('hero_slideshow');
            $hasContainer = strpos($html, 'slideshow-background-container') !== false;
            $slideCount = substr_count($html, 'slide-bg');
            echo ($hasContainer ? '✅' : '❌') . " Container exists\n";
            echo "🖼️  Slides rendered: $slideCount\n";
            echo "📏 HTML size: " . strlen($html) . " bytes\n";
        } catch (\Exception $e) {
            echo "❌ Error: " . $e->getMessage() . "\n";
        }
        
        echo "\n" . str_repeat("=", 50) . "\n";
        echo "END DEBUG\n";
        echo "</pre>";
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
