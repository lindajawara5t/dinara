<?php

namespace App\Controllers;

class SlideshowDebug extends BaseController
{
    public function index()
    {
        $model = model('HeroSlideshowModel');
        $slideshows = $model->getActiveSlideshows();
        
        return view('slideshow_debug', [
            'slideshows' => $slideshows,
            'count' => count($slideshows)
        ]);
    }
    
    public function json()
    {
        $model = model('HeroSlideshowModel');
        $slideshows = $model->getActiveSlideshows();
        
        return $this->response->setJSON([
            'success' => true,
            'count' => count($slideshows),
            'slides' => $slideshows
        ]);
    }
}
