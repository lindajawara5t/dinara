-- Create hero_slideshow table for managing hero slider images
CREATE TABLE IF NOT EXISTS `hero_slideshow` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `title` varchar(255) DEFAULT NULL COMMENT 'Judul slide (opsional)',
  `description` text DEFAULT NULL COMMENT 'Deskripsi slide (opsional)',
  `image_url` varchar(500) NOT NULL COMMENT 'Path ke gambar slideshow',
  `sort_order` int(11) DEFAULT 0 COMMENT 'Urutan tampilan slide',
  `is_active` tinyint(1) DEFAULT 1 COMMENT '1=aktif, 0=nonaktif',
  `duration` int(11) DEFAULT 5000 COMMENT 'Durasi tampil dalam millisecond',
  `button_label` varchar(100) DEFAULT NULL COMMENT 'Label tombol CTA',
  `button_url` varchar(500) DEFAULT NULL COMMENT 'URL atau JavaScript untuk tombol',
  `button_class` varchar(50) DEFAULT 'btn-warning' COMMENT 'Class CSS untuk tombol',
  `created_at` timestamp NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` timestamp NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`),
  KEY `idx_active_order` (`is_active`, `sort_order`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci COMMENT='Tabel untuk menyimpan slideshow hero section';

-- Insert sample data (contoh slideshow dengan gambar dari Unsplash)
-- Anda bisa mengganti dengan gambar lokal setelah upload di admin panel
INSERT INTO `hero_slideshow` (`title`, `description`, `image_url`, `sort_order`, `is_active`, `duration`, `button_label`, `button_url`, `button_class`) VALUES
('Selamat Datang di Karimunjawa', 'Nikmati keindahan pulau tropis dengan pantai yang menakjubkan', 'https://images.unsplash.com/photo-1559827260-dc66d52bef19?w=1920&h=600&fit=crop', 0, 1, 5000, 'Lihat Paket', 'javascript:showSection(''estimasi'')', 'btn-warning'),
('Jelajahi Keindahan Alam', 'Snorkeling, diving, dan island hopping terbaik di Indonesia', 'https://images.unsplash.com/photo-1506744038136-46273834b3fb?w=1920&h=600&fit=crop', 1, 1, 6000, 'Hubungi Kami', 'https://wa.me/6281234567890', 'btn-success'),
('Liburan Tak Terlupakan', 'Paket wisata lengkap dengan harga terjangkau', 'https://images.unsplash.com/photo-1473496169904-658ba7c44d8a?w=1920&h=600&fit=crop', 2, 1, 5000, 'Booking Sekarang', 'javascript:showSection(''estimasi'')', 'btn-primary');
