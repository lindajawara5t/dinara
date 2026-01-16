-- Insert Sample Wisata Darat Data
INSERT IGNORE INTO wisata_darat (name, description, location, price_publish, price_net, is_active, created_at, updated_at) VALUES
('Taman Laut Karimunjawa', 'Snorkeling dan melihat terumbu karang', 'Karimunjawa', 200000, 150000, 1, NOW(), NOW()),
('Pulau Kemujan', 'Jelajahi pulau dengan pantai pasir putih', 'Karimunjawa', 250000, 180000, 1, NOW(), NOW()),
('Museum Laut Karimunjawa', 'Koleksi biota laut dan sejarah maritim', 'Karimunjawa', 75000, 50000, 1, NOW(), NOW()),
('Bukit Genting', 'Pemandangan laut dari ketinggian', 'Karimunjawa', 100000, 70000, 1, NOW(), NOW()),
('Pantai Legon Boyo', 'Pantai indah untuk berfoto', 'Karimunjawa', 150000, 100000, 1, NOW(), NOW());

-- Insert Sample Wisata Laut Data
INSERT IGNORE INTO wisata_laut (name, description, location, price_publish, price_net, is_active, created_at, updated_at) VALUES
('Island Hopping Siang', 'Snorkeling ke 4 pulau dengan makan siang', 'Karimunjawa', 400000, 300000, 1, NOW(), NOW()),
('Diving Spot 1', 'Diving profesional ke spot terkenal', 'Karimunjawa', 600000, 450000, 1, NOW(), NOW()),
('Sunset Cruise', 'Cruise santai menyaksikan matahari terbenam', 'Karimunjawa', 300000, 200000, 1, NOW(), NOW()),
('Fishing Trip', 'Memancing ikan di laut lepas', 'Karimunjawa', 500000, 350000, 1, NOW(), NOW()),
('Snorkeling Morning', 'Snorkeling pagi hari ke spot terbaik', 'Karimunjawa', 350000, 250000, 1, NOW(), NOW());
