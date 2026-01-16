<?php
require_once 'app/Config/Database.php';

$db = \Config\Database::connect();

echo "=== Checking Wisata Data ===\n\n";

// Check wisata_darat
$darat = $db->table('wisata_darat')->get()->getResultArray();
echo "Wisata Darat count: " . count($darat) . "\n";
if(count($darat) > 0) {
    foreach($darat as $d) {
        echo "  - " . $d['name'] . " (Rp " . $d['price_publish'] . ")\n";
    }
} else {
    echo "  [KOSONG] Insert data sekarang...\n";
    $insert_darat = [
        ['name' => 'Taman Laut Karimunjawa', 'description' => 'Snorkeling', 'location' => 'Karimunjawa', 'price_publish' => 200000, 'price_net' => 150000, 'is_active' => 1],
        ['name' => 'Pulau Kemujan', 'description' => 'Pantai', 'location' => 'Karimunjawa', 'price_publish' => 250000, 'price_net' => 180000, 'is_active' => 1],
        ['name' => 'Museum Laut', 'description' => 'Museum', 'location' => 'Karimunjawa', 'price_publish' => 75000, 'price_net' => 50000, 'is_active' => 1],
    ];
    foreach($insert_darat as $item) {
        $db->table('wisata_darat')->insert($item);
    }
    echo "  ✓ Inserted " . count($insert_darat) . " wisata darat records\n";
}

echo "\n";

// Check wisata_laut
$laut = $db->table('wisata_laut')->get()->getResultArray();
echo "Wisata Laut count: " . count($laut) . "\n";
if(count($laut) > 0) {
    foreach($laut as $l) {
        echo "  - " . $l['name'] . " (Rp " . $l['price_publish'] . ")\n";
    }
} else {
    echo "  [KOSONG] Insert data sekarang...\n";
    $insert_laut = [
        ['name' => 'Island Hopping', 'description' => 'Snorkeling 4 pulau', 'location' => 'Karimunjawa', 'price_publish' => 400000, 'price_net' => 300000, 'is_active' => 1],
        ['name' => 'Diving Spot', 'description' => 'Diving profesional', 'location' => 'Karimunjawa', 'price_publish' => 600000, 'price_net' => 450000, 'is_active' => 1],
        ['name' => 'Sunset Cruise', 'description' => 'Cruise santai', 'location' => 'Karimunjawa', 'price_publish' => 300000, 'price_net' => 200000, 'is_active' => 1],
    ];
    foreach($insert_laut as $item) {
        $db->table('wisata_laut')->insert($item);
    }
    echo "  ✓ Inserted " . count($insert_laut) . " wisata laut records\n";
}

echo "\n✅ Done!\n";
