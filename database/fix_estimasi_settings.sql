-- Quick fix untuk settings estimasi
-- Jalankan query ini di phpMyAdmin atau MySQL client

-- 1. Cek apakah table site_content ada
SHOW TABLES LIKE 'site_content';

-- 2. Jika ada, cek struktur table
DESCRIBE site_content;

-- 3. Hapus data lama (jika ada)
DELETE FROM site_content WHERE page_name = 'estimasi';

-- 4. Insert data baru untuk settings estimasi
INSERT INTO site_content (page_name, section_name, content_key, content_value, created_at, updated_at) VALUES
('estimasi', 'floating_box', 'title', 'Deskripsi Box Total', NOW(), NOW()),
('estimasi', 'floating_box', 'description', '<span style="color:#ffe082;">Ini total estimasi termurah</span> liburan ke Karimunjawa 3H2M.<br>Kamu bisa <b>upgrade</b> dengan klik pilihan yang ada. Buat liburanmu makin seru dan sesuai keinginan!', NOW(), NOW()),
('estimasi', 'transport_land', 'title', 'Transportasi Darat', NOW(), NOW()),
('estimasi', 'transport_land', 'description', 'Biaya transportasi darat dari titik jemput ke Jepara PP', NOW(), NOW()),
('estimasi', 'transport_sea', 'title', 'Transportasi Laut', NOW(), NOW()),
('estimasi', 'transport_sea', 'description', 'Harga tiket kapal PP dari Jepara ke Karimunjawa', NOW(), NOW()),
('estimasi', 'hotel', 'title', 'Penginapan', NOW(), NOW()),
('estimasi', 'hotel', 'description', 'Harga per kamar per malam (sharing room)', NOW(), NOW()),
('estimasi', 'activity', 'title', 'Wisata Laut', NOW(), NOW()),
('estimasi', 'activity', 'description', 'Paket snorkeling, diving, dan aktivitas water sports', NOW(), NOW()),
('estimasi', 'guide', 'title', 'Guide Lokal', NOW(), NOW()),
('estimasi', 'guide', 'description', 'Jasa pemandu wisata profesional (1 guide per 8 orang)', NOW(), NOW()),
('estimasi', 'transport', 'title', 'Transport Lokal', NOW(), NOW()),
('estimasi', 'transport', 'description', 'Biaya sewa motor/mobil lokal per hari di Karimunjawa', NOW(), NOW()),
('estimasi', 'food', 'title', 'Konsumsi', NOW(), NOW()),
('estimasi', 'food', 'description', 'Biaya makan 3x sehari (breakfast, lunch, dinner)', NOW(), NOW()),
('estimasi', 'facility', 'title', 'Fasilitas Tambahan', NOW(), NOW()),
('estimasi', 'facility', 'description', 'Fasilitas optional seperti dokumentasi, BBQ, dll', NOW(), NOW());

-- 5. Verify data sudah masuk
SELECT * FROM site_content WHERE page_name = 'estimasi' ORDER BY section_name, content_key;

-- Output seharusnya menampilkan 18 baris data
