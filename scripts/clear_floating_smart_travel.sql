-- Kosongkan floating box description di db_smart_travel
UPDATE db_smart_travel.site_content 
SET content_value = '', 
    updated_at = NOW() 
WHERE page_name = 'estimasi' 
  AND section_name = 'floating_box' 
  AND content_key = 'description';

-- Verifikasi
SELECT * FROM db_smart_travel.site_content 
WHERE page_name = 'estimasi' 
  AND section_name = 'floating_box';
