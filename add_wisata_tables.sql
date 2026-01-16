-- Tambahan Tabel untuk Wisata Darat dan Wisata Laut
USE db_smart_travel;

-- Table: wisata_darat (Wisata yang bisa diakses dari darat)
CREATE TABLE IF NOT EXISTS wisata_darat (
  id INT AUTO_INCREMENT PRIMARY KEY,
  name VARCHAR(255) NOT NULL,
  description LONGTEXT,
  image_url VARCHAR(500),
  location VARCHAR(255),
  lat DECIMAL(10, 8),
  lng DECIMAL(11, 8),
  price_publish DECIMAL(15, 2) DEFAULT 0,
  price_net DECIMAL(15, 2) DEFAULT 0,
  is_active INT DEFAULT 1,
  created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
  updated_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Table: wisata_laut (Wisata yang bisa diakses dari laut)
CREATE TABLE IF NOT EXISTS wisata_laut (
  id INT AUTO_INCREMENT PRIMARY KEY,
  name VARCHAR(255) NOT NULL,
  description LONGTEXT,
  image_url VARCHAR(500),
  location VARCHAR(255),
  lat DECIMAL(10, 8),
  lng DECIMAL(11, 8),
  price_publish DECIMAL(15, 2) DEFAULT 0,
  price_net DECIMAL(15, 2) DEFAULT 0,
  is_active INT DEFAULT 1,
  created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
  updated_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Insert Sample Data (Wisata Darat)
INSERT INTO wisata_darat (name, description, location, price_publish) VALUES
('Candi Borobudur', 'Candi Buddha terbesar di Indonesia', 'Magelang', 750000),
('Prambanan', 'Candi Hindu yang megah dan indah', 'Yogyakarta', 450000),
('Pantai Parangtritis', 'Pantai pasir hitam yang terkenal', 'Yogyakarta', 250000);

-- Insert Sample Data (Wisata Laut)
INSERT INTO wisata_laut (name, description, location, price_publish) VALUES
('Snorkeling Karimun', 'Snorkeling di terumbu karang Karimunjawa', 'Karimunjawa', 350000),
('Diving Terumbu Karang', 'Diving dengan view terumbu karang menakjubkan', 'Karimunjawa', 500000),
('Island Hopping', 'Jelajahi pulau-pulau eksotis di Karimunjawa', 'Karimunjawa', 450000);
