<?php
namespace App\Controllers;

use CodeIgniter\Controller;

class Test extends Controller
{
    public function hero_slideshow_view()
    {
        // Test render hero_slideshow view langsung
        return view('hero_slideshow');
    }
    
    public function hero_slideshow_raw()
    {
        // Test raw HTML dari hero_slideshow
        $slideshowModel = new \App\Models\HeroSlideshowModel();
        $slideshows = $slideshowModel->getActiveSlideshows();
        
        echo "<h2>Hero Slideshow Raw Test</h2>";
        echo "<p>Slides from model: " . count($slideshows) . "</p>";
        
        echo "<pre>";
        echo htmlspecialchars(view('hero_slideshow'));
        echo "</pre>";
    }
}
?>
