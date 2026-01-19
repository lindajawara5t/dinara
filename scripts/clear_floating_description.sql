-- 1. Hapus isi deskripsi floating box (kosongkan)
UPDATE site_content 
SET content_value = '', 
    updated_at = NOW()
WHERE page_name = 'estimasi' 
  AND section_name = 'floating_box' 
  AND content_key = 'description';

-- 2. Verifikasi hasil
SELECT * FROM site_content 
WHERE page_name = 'estimasi' 
  AND section_name = 'floating_box';
