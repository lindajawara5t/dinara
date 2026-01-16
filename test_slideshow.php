<?php
// Test slideshow
$slideshowModel = new \App\Models\HeroSlideshowModel();
$slides = $slideshowModel->getActiveSlideshows();

echo "<pre>";
echo "Total slides: " . count($slides) . "\n";
foreach ($slides as $slide) {
    echo "ID: " . $slide['id'] . "\n";
    echo "Title: " . $slide['title'] . "\n";
    echo "Image: " . $slide['image_url'] . "\n";
    echo "Active: " . $slide['is_active'] . "\n";
    echo "---\n";
}
echo "</pre>";
