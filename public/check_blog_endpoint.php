<?php
// Test blog endpoint to see what's happening
header('Content-Type: application/json');

// Check if blog controller exists
$blog_controller = __DIR__ . '/../app/Controllers/Blog.php';
$blog_model = __DIR__ . '/../app/Models/BlogModel.php';

$response = [
    'blog_controller_exists' => file_exists($blog_controller),
    'blog_model_exists' => file_exists($blog_model),
    'timestamp' => date('Y-m-d H:i:s'),
    'base_url' => 'http://localhost:8080/dinara',
    'test_endpoints' => [
        'landing' => 'http://localhost:8080/dinara/',
        'blog_all' => 'http://localhost:8080/dinara/blog/all',
        'blog_single' => 'http://localhost:8080/dinara/blog/1',
    ]
];

echo json_encode($response, JSON_PRETTY_PRINT);
?>
