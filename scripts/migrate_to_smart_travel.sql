-- ========================================
-- MIGRASI DATA: dinara -> db_smart_travel
-- ========================================

-- 1. Cek data di database dinara
USE dinara;
SELECT * FROM site_content WHERE page_name = 'estimasi';

-- 2. Copy semua data estimasi dari dinara ke db_smart_travel
INSERT INTO db_smart_travel.site_content 
    (page_name, section_name, content_key, content_value, created_at, updated_at)
SELECT 
    page_name, section_name, content_key, content_value, created_at, updated_at
FROM dinara.site_content 
WHERE page_name = 'estimasi'
ON DUPLICATE KEY UPDATE 
    content_value = VALUES(content_value),
    updated_at = VALUES(updated_at);

-- 3. Verifikasi data di db_smart_travel
USE db_smart_travel;
SELECT * FROM site_content WHERE page_name = 'estimasi' ORDER BY section_name, content_key;

-- 4. Hapus database dinara (HATI-HATI!)
-- DROP DATABASE dinara;
