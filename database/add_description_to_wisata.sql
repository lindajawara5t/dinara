-- Script untuk menambahkan kolom description jika belum ada di tabel wisata_laut dan wisata_darat

-- Cek dan tambahkan kolom description di wisata_laut
ALTER TABLE `wisata_laut` 
ADD COLUMN IF NOT EXISTS `description` TEXT NULL AFTER `name`;

-- Cek dan tambahkan kolom description di wisata_darat
ALTER TABLE `wisata_darat` 
ADD COLUMN IF NOT EXISTS `description` TEXT NULL AFTER `name`;

-- Update data sample jika description masih NULL (opsional)
UPDATE `wisata_laut` SET `description` = 'Tiket masuk dan dokumentasi +guide' WHERE `description` IS NULL OR `description` = '';
UPDATE `wisata_darat` SET `description` = 'Tiket masuk dan dokumentasi +guide' WHERE `description` IS NULL OR `description` = '';

-- Verifikasi struktur tabel
SHOW COLUMNS FROM `wisata_laut`;
SHOW COLUMNS FROM `wisata_darat`;
