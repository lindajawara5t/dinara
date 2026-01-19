CREATE TABLE IF NOT EXISTS itinerary (
    id INT AUTO_INCREMENT PRIMARY KEY,
    duration_day INT NOT NULL COMMENT '2, 3, atau 4 hari',
    day_number INT NOT NULL COMMENT 'Hari ke berapa (1, 2, 3, dst)',
    title VARCHAR(255) NOT NULL COMMENT 'Judul aktivitas (contoh: Perjalanan & Tiba di Pulau)',
    description LONGTEXT COMMENT 'Deskripsi detail kegiatan',
    time_start VARCHAR(10) COMMENT 'Waktu mulai (HH:MM)',
    time_end VARCHAR(10) COMMENT 'Waktu selesai (HH:MM)',
    location VARCHAR(255) COMMENT 'Lokasi aktivitas',
    icon VARCHAR(50) COMMENT 'Bootstrap icon class (bi-ship, bi-utensils, dst)',
    is_active TINYINT DEFAULT 1,
    created_at DATETIME DEFAULT CURRENT_TIMESTAMP,
    updated_at DATETIME DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
    UNIQUE KEY unique_schedule (duration_day, day_number, time_start)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Sample data untuk 3H2M (3 hari)
INSERT INTO itinerary (duration_day, day_number, title, description, time_start, time_end, location, icon, is_active) VALUES
(3, 1, 'Penjemputan & Perjalanan ke Jepara', 'Kami akan menjemput Anda dari titik kumpul dan melakukan perjalanan darat ke Jepara. Tiba di pelabuhan sekitar siang.', '08:00', '12:00', 'Jepara Port', 'bi-car-front', 1),
(3, 1, 'Istirahat & Makan Siang', 'Check-in hotel dan istirahat sebentar. Makan siang di restoran lokal dekat pelabuhan.', '12:00', '13:30', 'Hotel', 'bi-utensils', 1),
(3, 1, 'Perjalanan ke Karimunjawa', 'Berangkat naik kapal menuju Pulau Karimunjawa. Perjalanan memakan waktu sekitar 2 jam dengan pemandangan laut yang indah.', '14:00', '16:00', 'Kapal', 'bi-ship', 1),
(3, 1, 'Tiba & Check-in', 'Tiba di Karimunjawa, check-in penginapan, istirahat dan persiapan untuk kegiatan malam hari.', '16:00', '17:30', 'Penginapan Karimun', 'bi-door-open', 1),
(3, 1, 'Makan Malam & Rekreasi Malam', 'Makan malam bersama dengan menu seafood segar. Bisa jalan-jalan santai di dermaga atau di dekat penginapan.', '18:00', '21:00', 'Restoran & Dermaga', 'bi-moon-stars', 1),

(3, 2, 'Sarapan Pagi', 'Sarapan pagi dengan menu Indonesia yang lezat. Persiapan untuk hari penuh petualangan.', '07:00', '08:00', 'Penginapan', 'bi-cup-hot', 1),
(3, 2, 'Wisata Alam & Snorkeling', 'Petualangan snorkeling di spot-spot terbaik Karimunjawa. Lihat keindahan terumbu karang dan ikan-ikan warna-warni.', '08:30', '12:00', 'Laut Karimun', 'bi-water', 1),
(3, 2, 'Makan Siang', 'Istirahat sejenak dan makan siang fresh seafood di tepi pantai.', '12:00', '13:30', 'Pantai', 'bi-utensils', 1),
(3, 2, 'Eksplorasi Pulau & Aktivitas Pantai', 'Jelajahi keindahan alam pulau, kunjungi pantai-pantai eksotis, atau aktivitas air lainnya.', '14:00', '17:00', 'Pulau-pulau', 'bi-tree', 1),
(3, 2, 'Makan Malam & Aktivitas Malam', 'Makan malam istimewa dengan pemandangan sunset. Malam hari bisa bonfire atau aktivitas rekreasi lainnya.', '18:00', '21:00', 'Pantai/Penginapan', 'bi-fire', 1),

(3, 3, 'Sarapan & Persiapan Pulang', 'Sarapan pagi terakhir di Karimunjawa. Packing barang dan persiapan untuk pulang.', '07:00', '08:30', 'Penginapan', 'bi-cup-hot', 1),
(3, 3, 'Aktivitas Pagi atau Snorkeling Tambahan', 'Kesempatan terakhir untuk snorkeling atau melihat spot-spot favorit sebelum pulang.', '09:00', '11:00', 'Laut', 'bi-binoculars', 1),
(3, 3, 'Makan Siang Perpisahan', 'Makan siang perpisahan dengan makanan special di Karimunjawa.', '11:30', '12:30', 'Restoran', 'bi-utensils', 1),
(3, 3, 'Perjalanan Kembali ke Jepara', 'Naik kapal menuju Jepara. Waktu tempuh sekitar 2 jam.', '13:00', '15:00', 'Kapal', 'bi-ship', 1),
(3, 3, 'Perjalanan Pulang & Pengantaran', 'Tiba di Jepara dan perjalanan darat kembali ke titik asal. Kami akan mengantarkan Anda sampai titik keberangkatan.', '15:30', '20:00', 'Jepara - Titik Asal', 'bi-car-front', 1);
