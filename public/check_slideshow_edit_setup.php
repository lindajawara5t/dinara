<?php
// Check apakah edit button ada dan bekerja
// Return diagnostic info tentang slideshow items

$db = \Config\Database::connect();

$response = [
    'status' => 'ok',
    'slideshows' => []
];

try {
    // Get slideshows
    $slideshowModel = new \App\Models\HeroSlideshowModel();
    $slideshows = $slideshowModel->getAllSlideshows();
    
    $response['total'] = count($slideshows);
    
    foreach ($slideshows as $s) {
        $response['slideshows'][] = [
            'id' => $s['id'],
            'title' => $s['title'] ?: 'Untitled',
            'status' => 'SHOULD HAVE EDIT BUTTON: onclick="editSlideshow(' . $s['id'] . ')"',
            'image_url' => $s['image_url'],
            'duration' => $s['duration'],
            'is_active' => $s['is_active']
        ];
    }
    
    // Also check if JS functions should be available
    $response['required_functions'] = [
        'editSlideshow(id)',
        'saveEditSlideshow()',
        'deleteSlideshowItem(id)',
        'toggleSlideshowActive(id)',
    ];
    
    $response['required_endpoints'] = [
        'GET /admin/get_slideshows',
        'POST /admin/update_slideshow',
        'GET /admin/delete_slideshow/:id',
        'POST /admin/toggle_slideshow_active/:id'
    ];
    
} catch (\Exception $e) {
    $response['status'] = 'error';
    $response['error'] = $e->getMessage();
}

header('Content-Type: application/json');
echo json_encode($response, JSON_PRETTY_PRINT);
?>
