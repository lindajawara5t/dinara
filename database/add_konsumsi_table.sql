-- Tambahan Tabel untuk Konsumsi
USE db_smart_travel;

-- Table: konsumsi (Menu konsumsi/makan)
CREATE TABLE IF NOT EXISTS konsumsi (
  id INT AUTO_INCREMENT PRIMARY KEY,
  name VARCHAR(255) NOT NULL,
  description LONGTEXT,
  price_per_person DECIMAL(15, 2) NOT NULL,
  meal_type VARCHAR(100),
  is_active INT DEFAULT 1,
  created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
  updated_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Insert Sample Data
INSERT INTO konsumsi (name, description, meal_type, price_per_person) VALUES
('Paket Makan 3x Sehari (Standar)', 'Sarapan, Makan Siang, Makan Malam dengan menu standar', 'full-day', 25000),
('Paket Makan 3x Sehari (Deluxe)', 'Sarapan, Makan Siang, Makan Malam dengan menu premium', 'full-day', 35000),
('Paket Snack & Minuman', 'Snack dan minuman sepanjang hari', 'snack', 15000);
