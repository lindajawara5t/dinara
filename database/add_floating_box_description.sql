-- Add floating box description to site_content table
-- Run this SQL in your database

-- Check if floating_box already exists
DELETE FROM site_content WHERE page_name = 'estimasi' AND section_name = 'floating_box';

-- Insert floating_box description
INSERT INTO site_content (page_name, section_name, content_key, content_value, created_at, updated_at) VALUES
('estimasi', 'floating_box', 'title', 'Deskripsi Box Total', NOW(), NOW()),
('estimasi', 'floating_box', 'description', '<span style="color:#ffe082;">Ini total estimasi termurah</span> liburan ke Karimunjawa 3H2M.<br>Kamu bisa <b>upgrade</b> dengan klik pilihan yang ada. Buat liburanmu makin seru dan sesuai keinginan!', NOW(), NOW());

-- Verify
SELECT * FROM site_content WHERE page_name = 'estimasi' ORDER BY section_name, content_key;
