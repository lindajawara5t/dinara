-- Sample data untuk testing slideshow dengan URL eksternal (tidak perlu upload gambar)
-- Jalankan query ini setelah tabel hero_slideshow dibuat

INSERT INTO `hero_slideshow` (`title`, `description`, `image_url`, `sort_order`, `is_active`) VALUES
('Selamat Datang di Karimunjawa', 'Nikmati keindahan pulau tropis dengan pantai yang menakjubkan', 'https://images.unsplash.com/photo-1559827260-dc66d52bef19?w=1920&h=600&fit=crop', 0, 1),
('Jelajahi Keindahan Alam', 'Snorkeling, diving, dan island hopping terbaik di Indonesia', 'https://images.unsplash.com/photo-1506744038136-46273834b3fb?w=1920&h=600&fit=crop', 1, 1),
('Liburan Tak Terlupakan', 'Paket wisata lengkap dengan harga terjangkau untuk keluarga', 'https://images.unsplash.com/photo-1473496169904-658ba7c44d8a?w=1920&h=600&fit=crop', 2, 1),
('Petualangan Menanti', 'Temukan spot-spot tersembunyi di kepulauan Karimunjawa', 'https://images.unsplash.com/photo-1505142468610-359e7d316be0?w=1920&h=600&fit=crop', 3, 1);
