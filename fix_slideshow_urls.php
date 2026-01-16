<?php
require_once FCPATH . 'vendor/autoload.php';
require_once FCPATH . 'app/Config/Database.php';

$db = \Config\Database::connect();

// Fix image URLs
$updateSQL = "UPDATE hero_slideshow 
SET image_url = 'uploads/hero/696a0cebde3e7_Biru Oranye Abstrak Minimalis Persewaan Alat Kemah Twitter Header (3).png'
WHERE is_active = 1";

$db->query($updateSQL);

echo "✅ Image URLs updated!";

// Verify
$result = $db->query("SELECT id, title, image_url FROM hero_slideshow WHERE is_active=1");
foreach($result->getResult() as $row) {
    echo "\nID: {$row->id} | Title: {$row->title}";
    echo "\nURL: {$row->image_url}";
}
?>
