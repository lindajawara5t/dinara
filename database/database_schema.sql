-- Buat Database
CREATE DATABASE IF NOT EXISTS db_smart_travel;
USE db_smart_travel;

-- Table: destinations
CREATE TABLE IF NOT EXISTS destinations (
  id INT AUTO_INCREMENT PRIMARY KEY,
  name VARCHAR(255) NOT NULL,
  slug VARCHAR(255),
  description LONGTEXT,
  image_url VARCHAR(500),
  is_active INT DEFAULT 1,
  created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
  updated_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Table: ref_cities
CREATE TABLE IF NOT EXISTS ref_cities (
  id INT AUTO_INCREMENT PRIMARY KEY,
  name VARCHAR(255) NOT NULL,
  lat DECIMAL(10, 8),
  lng DECIMAL(11, 8),
  created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Table: service_categories
CREATE TABLE IF NOT EXISTS service_categories (
  id INT AUTO_INCREMENT PRIMARY KEY,
  name VARCHAR(255) NOT NULL,
  type VARCHAR(100),
  description LONGTEXT,
  long_description LONGTEXT,
  image_url VARCHAR(500),
  price_publish DECIMAL(15, 2) DEFAULT 0,
  price_net DECIMAL(15, 2) DEFAULT 0,
  created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
  updated_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Table: bookings
CREATE TABLE IF NOT EXISTS bookings (
  id INT AUTO_INCREMENT PRIMARY KEY,
  booking_code VARCHAR(50) UNIQUE,
  name VARCHAR(255),
  email VARCHAR(255),
  phone VARCHAR(20),
  destination_id INT,
  departure_city VARCHAR(255),
  departure_date DATE,
  duration INT,
  pax INT,
  total_revenue DECIMAL(15, 2),
  profit DECIMAL(15, 2),
  status VARCHAR(50),
  created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
  updated_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  FOREIGN KEY (destination_id) REFERENCES destinations(id)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Table: migrations
CREATE TABLE IF NOT EXISTS migrations (
  id INT AUTO_INCREMENT PRIMARY KEY,
  version INT,
  class VARCHAR(255),
  `group` VARCHAR(255),
  namespace VARCHAR(255),
  time INT,
  batch INT
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Table: site_settings
CREATE TABLE IF NOT EXISTS site_settings (
  id INT AUTO_INCREMENT PRIMARY KEY,
  setting_key VARCHAR(255) UNIQUE NOT NULL,
  setting_value LONGTEXT,
  setting_group VARCHAR(100) DEFAULT 'general',
  created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
  updated_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Table: site_content
CREATE TABLE IF NOT EXISTS site_content (
  id INT AUTO_INCREMENT PRIMARY KEY,
  page_name VARCHAR(255),
  section_name VARCHAR(255),
  content_key VARCHAR(255),
  content_value LONGTEXT,
  created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
  updated_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Table: gallery
CREATE TABLE IF NOT EXISTS gallery (
  id INT AUTO_INCREMENT PRIMARY KEY,
  destination_id INT,
  image_url VARCHAR(500),
  title VARCHAR(255),
  description LONGTEXT,
  created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
  FOREIGN KEY (destination_id) REFERENCES destinations(id)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Table: service_gallery
CREATE TABLE IF NOT EXISTS service_gallery (
  id INT AUTO_INCREMENT PRIMARY KEY,
  service_id INT,
  image_url VARCHAR(500),
  created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Table: service_inventory
CREATE TABLE IF NOT EXISTS service_inventory (
  id INT AUTO_INCREMENT PRIMARY KEY,
  service_id INT,
  item_name VARCHAR(255),
  quantity INT,
  unit_price DECIMAL(15, 2),
  created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Table: transport_routes
CREATE TABLE IF NOT EXISTS transport_routes (
  id INT AUTO_INCREMENT PRIMARY KEY,
  from_location VARCHAR(255),
  to_location VARCHAR(255),
  distance DECIMAL(8, 2),
  duration_minutes INT,
  created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Table: booking_expenses
CREATE TABLE IF NOT EXISTS booking_expenses (
  id INT AUTO_INCREMENT PRIMARY KEY,
  booking_id INT,
  expense_type VARCHAR(100),
  amount DECIMAL(15, 2),
  created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
  FOREIGN KEY (booking_id) REFERENCES bookings(id)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Table: cost_components
CREATE TABLE IF NOT EXISTS cost_components (
  id INT AUTO_INCREMENT PRIMARY KEY,
  destination_id INT,
  component_name VARCHAR(255),
  base_cost DECIMAL(15, 2),
  markup_percent DECIMAL(5, 2),
  created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
  FOREIGN KEY (destination_id) REFERENCES destinations(id)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Wisata Darat Table
CREATE TABLE IF NOT EXISTS wisata_darat (
  id INT AUTO_INCREMENT PRIMARY KEY,
  name VARCHAR(255) NOT NULL,
  description TEXT,
  image_url VARCHAR(255),
  location VARCHAR(255),
  lat DECIMAL(10, 8),
  lng DECIMAL(11, 8),
  price_publish DECIMAL(15, 2) DEFAULT 0,
  price_net DECIMAL(15, 2) DEFAULT 0,
  is_active TINYINT(1) DEFAULT 1,
  created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
  updated_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Wisata Laut Table
CREATE TABLE IF NOT EXISTS wisata_laut (
  id INT AUTO_INCREMENT PRIMARY KEY,
  name VARCHAR(255) NOT NULL,
  description TEXT,
  image_url VARCHAR(255),
  location VARCHAR(255),
  lat DECIMAL(10, 8),
  lng DECIMAL(11, 8),
  price_publish DECIMAL(15, 2) DEFAULT 0,
  price_net DECIMAL(15, 2) DEFAULT 0,
  is_active TINYINT(1) DEFAULT 1,
  created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
  updated_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Insert sample data untuk testing
INSERT INTO ref_cities (name, lat, lng) VALUES
('Jepara (Alun-alun)', -6.5818, 110.6784),
('Semarang', -6.9667, 110.4167),
('Solo', -7.5606, 110.8166),
('Yogyakarta', -7.7956, 110.3695);

INSERT INTO destinations (name, slug, description, is_active) VALUES
('Karimunjawa', 'karimunjawa', 'Kepulauan Karimunjawa yang indah', 1),
('Lombok', 'lombok', 'Pulau Lombok dengan pantai yang menawan', 1);

-- Sample Wisata Darat (City Tour)
INSERT INTO wisata_darat (name, description, location, price_publish, price_net, is_active) VALUES
('Taman Laut Karimunjawa', 'Snorkeling dan melihat terumbu karang', 'Karimunjawa', 200000, 150000, 1),
('Pulau Kemujan', 'Jelajahi pulau dengan pantai pasir putih', 'Karimunjawa', 250000, 180000, 1),
('Museum Laut Karimunjawa', 'Koleksi biota laut dan sejarah maritim', 'Karimunjawa', 75000, 50000, 1),
('Bukit Genting', 'Pemandangan laut dari ketinggian', 'Karimunjawa', 100000, 70000, 1),
('Pantai Legon Boyo', 'Pantai indah untuk berfoto', 'Karimunjawa', 150000, 100000, 1);

-- Sample Wisata Laut (Island Hopping)
INSERT INTO wisata_laut (name, description, location, price_publish, price_net, is_active) VALUES
('Island Hopping Siang', 'Snorkeling ke 4 pulau dengan makan siang', 'Karimunjawa', 400000, 300000, 1),
('Diving Spot 1', 'Diving profesional ke spot terkenal', 'Karimunjawa', 600000, 450000, 1),
('Sunset Cruise', 'Cruise santai menyaksikan matahari terbenam', 'Karimunjawa', 300000, 200000, 1),
('Fishing Trip', 'Memancing ikan di laut lepas', 'Karimunjawa', 500000, 350000, 1),
('Snorkeling Morning', 'Snorkeling pagi hari ke spot terbaik', 'Karimunjawa', 350000, 250000, 1);

-- Insert site settings
INSERT INTO site_settings (setting_key, setting_value) VALUES
('app_name', 'Dinara Travel'),
('hero_title', 'Liburan Impian Anda Dimulai di Sini'),
('announcement', 'Promo spesial liburan impian - pesan sekarang dan dapatkan diskon!'),
('logo_image', 'logo.png');

-- Insert estimasi info settings (8 items matching the estimation breakdown)
INSERT INTO site_content (page_name, section_name, content_key, content_value) VALUES
-- 1. Transportasi Darat
('estimasi', 'transport_land', 'title', 'Transportasi Darat'),
('estimasi', 'transport_land', 'description', 'Biaya transportasi darat dari titik jemput ke Jepara PP'),
-- 1b. Transportasi Laut
('estimasi', 'transport_sea', 'title', 'Transportasi Laut'),
('estimasi', 'transport_sea', 'description', 'Harga tiket kapal PP dari Jepara ke Karimunjawa'),
-- 2. Penginapan
('estimasi', 'hotel', 'title', 'Penginapan'),
('estimasi', 'hotel', 'description', 'Harga per kamar per malam (sharing room)'),
-- 3. Wisata Laut
('estimasi', 'wisata_laut', 'title', 'Wisata Laut'),
('estimasi', 'wisata_laut', 'description', 'Paket Island Hopping dengan snorkeling dan aktivitas laut'),
-- 4. Wisata Darat
('estimasi', 'wisata_darat', 'title', 'Wisata Darat'),
('estimasi', 'wisata_darat', 'description', 'Paket City Tour dengan tiket masuk dan pemandu lokal'),
-- 5. Guide Lokal
('estimasi', 'guide', 'title', 'Guide Lokal'),
('estimasi', 'guide', 'description', 'Jasa pemandu wisata profesional (1 guide per 8 orang)'),
-- 6. Transport Lokal
('estimasi', 'transport', 'title', 'Transport Lokal'),
('estimasi', 'transport', 'description', 'Biaya sewa motor/mobil lokal per hari di Karimunjawa'),
-- 7. Konsumsi
('estimasi', 'food', 'title', 'Konsumsi'),
('estimasi', 'food', 'description', 'Biaya makan 3x sehari (breakfast, lunch, dinner)');
