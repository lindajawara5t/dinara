<?php
// Quick test untuk check hero_slideshow data dari database

$db = \Config\Database::connect();
$builder = $db->table('hero_slideshow');

try {
    // Check table exists
    $tables = $db->listTables();
    $has_table = in_array('hero_slideshow', $tables);
    
    $response = [
        'status' => 'success',
        'hero_slideshow_table_exists' => $has_table,
        'timestamp' => date('Y-m-d H:i:s')
    ];
    
    if ($has_table) {
        // Get all active slideshows
        $result = $builder->where('is_active', 1)->orderBy('sort_order', 'ASC')->get();
        $slideshows = $result->getResultArray();
        
        $response['total_active_slides'] = count($slideshows);
        $response['slides'] = [];
        
        foreach ($slideshows as $slide) {
            $response['slides'][] = [
                'id' => $slide['id'],
                'title' => $slide['title'],
                'duration' => $slide['duration'],
                'image_url' => $slide['image_url'],
                'is_active' => $slide['is_active']
            ];
        }
    }
    
    header('Content-Type: application/json');
    echo json_encode($response, JSON_PRETTY_PRINT);
    
} catch (\Exception $e) {
    header('Content-Type: application/json');
    http_response_code(500);
    echo json_encode([
        'status' => 'error',
        'message' => $e->getMessage(),
        'file' => $e->getFile(),
        'line' => $e->getLine()
    ], JSON_PRETTY_PRINT);
}
?>
