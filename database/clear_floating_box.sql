-- Hapus isi deskripsi floating box dan kosongkan
UPDATE site_content 
SET content_value = '', updated_at = NOW()
WHERE page_name = 'estimasi' 
  AND section_name = 'floating_box' 
  AND content_key = 'description';

-- Verifikasi hasil
SELECT * FROM site_content WHERE page_name = 'estimasi' AND section_name = 'floating_box';
