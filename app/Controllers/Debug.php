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
}
