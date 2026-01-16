<?php
// Quick script to insert wisata data
require_once 'app/Config/Database.php';

$db = \Config\Database::connect();

// Wisata Darat
$wisataDarat = [
    ['name' => 'Taman Laut Karimunjawa', 'description' => 'Snorkeling dan melihat terumbu karang', 'location' => 'Karimunjawa', 'price_publish' => 200000, 'price_net' => 150000, 'is_active' => 1],
    ['name' => 'Pulau Kemujan', 'description' => 'Jelajahi pulau dengan pantai pasir putih', 'location' => 'Karimunjawa', 'price_publish' => 250000, 'price_net' => 180000, 'is_active' => 1],
    ['name' => 'Museum Laut Karimunjawa', 'description' => 'Koleksi biota laut dan sejarah maritim', 'location' => 'Karimunjawa', 'price_publish' => 75000, 'price_net' => 50000, 'is_active' => 1],
    ['name' => 'Bukit Genting', 'description' => 'Pemandangan laut dari ketinggian', 'location' => 'Karimunjawa', 'price_publish' => 100000, 'price_net' => 70000, 'is_active' => 1],
    ['name' => 'Pantai Legon Boyo', 'description' => 'Pantai indah untuk berfoto', 'location' => 'Karimunjawa', 'price_publish' => 150000, 'price_net' => 100000, 'is_active' => 1],
];

// Wisata Laut
$wisataLaut = [
    ['name' => 'Island Hopping Siang', 'description' => 'Snorkeling ke 4 pulau dengan makan siang', 'location' => 'Karimunjawa', 'price_publish' => 400000, 'price_net' => 300000, 'is_active' => 1],
    ['name' => 'Diving Spot 1', 'description' => 'Diving profesional ke spot terkenal', 'location' => 'Karimunjawa', 'price_publish' => 600000, 'price_net' => 450000, 'is_active' => 1],
    ['name' => 'Sunset Cruise', 'description' => 'Cruise santai menyaksikan matahari terbenam', 'location' => 'Karimunjawa', 'price_publish' => 300000, 'price_net' => 200000, 'is_active' => 1],
    ['name' => 'Fishing Trip', 'description' => 'Memancing ikan di laut lepas', 'location' => 'Karimunjawa', 'price_publish' => 500000, 'price_net' => 350000, 'is_active' => 1],
    ['name' => 'Snorkeling Morning', 'description' => 'Snorkeling pagi hari ke spot terbaik', 'location' => 'Karimunjawa', 'price_publish' => 350000, 'price_net' => 250000, 'is_active' => 1],
];

// Insert Wisata Darat
foreach($wisataDarat as $item) {
    $exists = $db->table('wisata_darat')->where('name', $item['name'])->first();
    if(!$exists) {
        $db->table('wisata_darat')->insert($item);
        echo "✓ Inserted: " . $item['name'] . "\n";
    }
}

// Insert Wisata Laut
foreach($wisataLaut as $item) {
    $exists = $db->table('wisata_laut')->where('name', $item['name'])->first();
    if(!$exists) {
        $db->table('wisata_laut')->insert($item);
        echo "✓ Inserted: " . $item['name'] . "\n";
    }
}

echo "\n✅ All wisata data inserted successfully!";
