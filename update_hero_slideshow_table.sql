-- Update tabel hero_slideshow untuk menambah kolom durasi dan button
-- Jalankan query ini jika tabel sudah ada sebelumnya

ALTER TABLE `hero_slideshow`
ADD COLUMN `duration` int(11) DEFAULT 5000 COMMENT 'Durasi tampil dalam millisecond' AFTER `is_active`,
ADD COLUMN `button_label` varchar(100) DEFAULT NULL COMMENT 'Label tombol CTA' AFTER `duration`,
ADD COLUMN `button_url` varchar(500) DEFAULT NULL COMMENT 'URL atau JavaScript untuk tombol' AFTER `button_label`,
ADD COLUMN `button_class` varchar(50) DEFAULT 'btn-warning' COMMENT 'Class CSS untuk tombol' AFTER `button_url`;
